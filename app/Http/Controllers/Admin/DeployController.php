<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\BufferedOutput;

class DeployController extends Controller
{
    /**
     * Show the Git Deployment dashboard page.
     */
    public function index()
    {
        $gitInfo = $this->getGitInfo();
        $deployLog = $this->readDeployLog();

        return view('admin.deploy.index', compact('gitInfo', 'deployLog'));
    }

    /**
     * Run git sync + post-deploy tasks from the admin panel.
     */
    public function deploy(Request $request)
    {
        @set_time_limit(300);
        @ignore_user_abort(true);

        $output = [];
        $startTime = microtime(true);

        $this->log("=== Manual Deploy Started by Admin ===");
        $this->log("Time: " . now()->format('Y-m-d H:i:s'));
        $this->log("User: " . (auth()->user()->name ?? 'Admin'));
        $this->log("IP: " . $request->ip());
        $this->log("---");

        try {
            $branchRes = $this->runCommand('git branch --show-current 2>&1');
            $branch = ($branchRes['code'] === 0 && !empty(trim($branchRes['output'])))
                ? trim($branchRes['output'])
                : 'master';

            $lockBeforeRes = $this->runCommand('git rev-parse HEAD:composer.lock 2>&1');
            $lockBefore = ($lockBeforeRes['code'] === 0) ? trim($lockBeforeRes['output']) : '';

            // 1. Git Sync (fetch + hard reset to match remote cleanly, ignoring untracked .env/uploads/db)
            $this->log("▶ Syncing branch origin/{$branch}...");
            @putenv('GIT_TERMINAL_PROMPT=0');
            $fetchCmd = "git fetch origin " . escapeshellarg($branch) . " 2>&1 && git reset --hard " . escapeshellarg("origin/{$branch}") . " 2>&1";
            $pullResult = $this->runCommand($fetchCmd);
            $this->log($pullResult['output']);
            $output[] = ['step' => "Git Sync (origin/{$branch})", 'result' => $pullResult['output'], 'ok' => $pullResult['code'] === 0];

            if ($pullResult['code'] !== 0) {
                throw new \RuntimeException("Git sync failed. Check Deploy Log for details.");
            }

            $lockAfterRes = $this->runCommand('git rev-parse HEAD:composer.lock 2>&1');
            $lockAfter = ($lockAfterRes['code'] === 0) ? trim($lockAfterRes['output']) : '';

            // 2. Composer Install (only if composer.lock changed or vendor missing)
            $vendorExists = file_exists(base_path('vendor/autoload.php'));
            if ($vendorExists && $lockBefore !== '' && $lockBefore === $lockAfter) {
                $msg = "Skipped: composer.lock unchanged (vendor/ already up to date).";
                $this->log("▶ Composer Install: {$msg}");
                $output[] = ['step' => 'Composer Install', 'result' => $msg, 'ok' => true];
            } else {
                $this->log("▶ Running composer install...");
                $composerBin = $this->findComposerBinary();
                if ($composerBin) {
                    if (PHP_OS_FAMILY !== 'Windows' && empty(getenv('HOME'))) {
                        @putenv('HOME=' . sys_get_temp_dir());
                        @putenv('COMPOSER_HOME=' . sys_get_temp_dir() . '/.composer');
                    }
                    $composerCmd = "{$composerBin} install --no-dev --optimize-autoloader --no-interaction 2>&1";
                    $composerResult = $this->runCommand($composerCmd);
                    $this->log($composerResult['output']);
                    $output[] = ['step' => 'Composer Install', 'result' => $composerResult['output'], 'ok' => $composerResult['code'] === 0];
                } else {
                    $msg = "Skipped: composer CLI not found on server PATH (existing vendor/ kept).";
                    $this->log("▶ Composer Install: {$msg}");
                    $output[] = ['step' => 'Composer Install', 'result' => $msg, 'ok' => true];
                }
            }

            // 3. Clear stale caches before rebuilding
            $this->log("▶ Clearing old caches...");
            $clearOut = $this->runArtisan('optimize:clear');
            $this->log($clearOut['output']);
            $output[] = ['step' => 'Clear Stale Caches (optimize:clear)', 'result' => $clearOut['output'], 'ok' => $clearOut['ok']];

            // 4. Config Cache (must run in fresh CLI subprocess so .env is freshly loaded)
            $phpCli = $this->findPhpCliBinary();
            if ($phpCli) {
                $this->log("▶ Caching config via CLI ({$phpCli})...");
                $cfgRes = $this->runCommand(escapeshellarg($phpCli) . ' artisan config:cache 2>&1');
                $this->log($cfgRes['output']);
                $output[] = ['step' => 'Config Cache', 'result' => $cfgRes['output'], 'ok' => $cfgRes['code'] === 0];
            } else {
                $msg = "Skipped config:cache (using live .env directly; PHP CLI binary not detected).";
                $this->log("▶ Config Cache: {$msg}");
                $output[] = ['step' => 'Config Cache', 'result' => $msg, 'ok' => true];
            }

            // 5. Route Cache
            $this->log("▶ Caching routes...");
            $routeOut = $this->runArtisan('route:cache');
            $this->log($routeOut['output']);
            $output[] = ['step' => 'Route Cache', 'result' => $routeOut['output'], 'ok' => $routeOut['ok']];

            // 6. View Cache
            $this->log("▶ Caching views...");
            $viewOut = $this->runArtisan('view:cache');
            $this->log($viewOut['output']);
            $output[] = ['step' => 'View Cache', 'result' => $viewOut['output'], 'ok' => $viewOut['ok']];

            // 7. Run DB migrations (safe)
            $this->log("▶ Running migrations...");
            $migrateOut = $this->runArtisan('migrate', ['--force' => true]);
            $this->log($migrateOut['output']);
            $output[] = ['step' => 'DB Migrate', 'result' => $migrateOut['output'], 'ok' => $migrateOut['ok']];

            // 8. Storage link (safe if already linked)
            $this->log("▶ Checking storage link...");
            if (file_exists(public_path('storage'))) {
                $output[] = ['step' => 'Storage Link', 'result' => 'The [public/storage] link already exists.', 'ok' => true];
            } else {
                $storageOut = $this->runArtisan('storage:link');
                $this->log($storageOut['output']);
                $output[] = ['step' => 'Storage Link', 'result' => $storageOut['output'], 'ok' => true];
            }

            $elapsed = round(microtime(true) - $startTime, 2);
            $this->log("✅ Deploy completed in {$elapsed}s");

            return back()->with('deploy_success', true)
                         ->with('deploy_output', $output)
                         ->with('deploy_time', $elapsed);

        } catch (\Throwable $e) {
            $this->log("❌ Deploy FAILED: " . $e->getMessage());
            Log::error('Deploy failed: ' . $e->getMessage());

            return back()->with('deploy_error', $e->getMessage())
                         ->with('deploy_output', $output);
        }
    }

    /**
     * GitHub / GitLab Webhook endpoint — auto deploy on push.
     * Set your webhook secret in .env as DEPLOY_WEBHOOK_SECRET
     */
    public function webhook(Request $request)
    {
        $secret = config('app.deploy_webhook_secret') ?: env('DEPLOY_WEBHOOK_SECRET');

        // Verify GitHub signature
        if ($secret) {
            $signature = $request->header('X-Hub-Signature-256')
                      ?? $request->header('X-Hub-Signature')
                      ?? '';

            if (str_starts_with($signature, 'sha256=')) {
                $hash = 'sha256=' . hash_hmac('sha256', $request->getContent(), $secret);
            } else {
                $hash = 'sha1=' . hash_hmac('sha1', $request->getContent(), $secret);
            }

            if (!hash_equals($hash, $signature)) {
                $this->log("❌ Webhook: Invalid signature from " . $request->ip());
                return response()->json(['error' => 'Invalid signature'], 403);
            }
        }

        // Only deploy on push to main/master
        $payload = $request->json()->all();
        $branchRef = data_get($payload, 'ref', '');
        $allowedBranches = ['refs/heads/main', 'refs/heads/master'];

        if (!empty($branchRef) && !in_array($branchRef, $allowedBranches)) {
            return response()->json(['message' => "Skipped: branch {$branchRef} not in deploy list"]);
        }

        $branchName = !empty($branchRef) ? basename($branchRef) : 'master';
        $pusher  = data_get($payload, 'pusher.name', 'GitHub');
        $commits = count(data_get($payload, 'commits', []));
        $this->log("=== Webhook Deploy: {$commits} commit(s) pushed by {$pusher} on {$branchRef} ===");

        // Run deploy steps in background
        $basePath = base_path();
        $phpBin   = PHP_BINARY;
        $artisan  = $basePath . '/artisan';
        $logFile  = storage_path('logs/deploy.log');

        $script = implode(' && ', [
            "cd " . escapeshellarg($basePath),
            "GIT_TERMINAL_PROMPT=0 git fetch origin " . escapeshellarg($branchName) . " >> " . escapeshellarg($logFile) . " 2>&1",
            "git reset --hard " . escapeshellarg("origin/{$branchName}") . " >> " . escapeshellarg($logFile) . " 2>&1",
            escapeshellcmd("{$phpBin} {$artisan} optimize:clear >> " . escapeshellarg($logFile) . " 2>&1"),
            escapeshellcmd("{$phpBin} {$artisan} config:cache >> " . escapeshellarg($logFile) . " 2>&1"),
            escapeshellcmd("{$phpBin} {$artisan} route:cache >> " . escapeshellarg($logFile) . " 2>&1"),
            escapeshellcmd("{$phpBin} {$artisan} view:cache >> " . escapeshellarg($logFile) . " 2>&1"),
            escapeshellcmd("{$phpBin} {$artisan} migrate --force >> " . escapeshellarg($logFile) . " 2>&1"),
        ]);

        // Fire-and-forget (background)
        if (PHP_OS_FAMILY === 'Windows') {
            pclose(popen("start /B {$script}", 'r'));
        } else {
            exec("({$script}) > /dev/null 2>&1 &");
        }

        $this->log("✅ Webhook deploy triggered.");

        return response()->json(['message' => 'Deploy triggered', 'pusher' => $pusher, 'commits' => $commits]);
    }

    /**
     * Clear all Laravel caches from admin.
     */
    public function clearCache()
    {
        $steps = ['config:clear', 'route:clear', 'view:clear', 'cache:clear'];
        $output = [];

        foreach ($steps as $cmd) {
            $res = $this->runArtisan($cmd);
            $output[] = ['step' => $cmd, 'result' => $res['output'], 'ok' => $res['ok']];
        }

        return back()->with('cache_output', $output)->with('cache_cleared', true);
    }

    /**
     * Clear deploy log file.
     */
    public function clearLog()
    {
        $logPath = storage_path('logs/deploy.log');
        if (file_exists($logPath)) {
            @unlink($logPath);
        }

        return back()->with('log_cleared', true);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function getGitInfo(): array
    {
        try {
            $branchRes = $this->runCommand('git branch --show-current 2>&1');
            $branch = ($branchRes['code'] === 0 && !empty(trim($branchRes['output'])))
                ? trim($branchRes['output'])
                : 'master';

            $logRes = $this->runCommand('git log -1 --format="%H|%h|%s|%an|%ci" 2>&1');
            if ($logRes['code'] === 0 && !empty(trim($logRes['output']))) {
                $parts = explode('|', trim($logRes['output']), 5);
                $commit   = $parts[0] ?? '—';
                $shortSha = $parts[1] ?? '—';
                $message  = $parts[2] ?? '—';
                $author   = $parts[3] ?? '—';
                $date     = $parts[4] ?? '—';
            } else {
                $commit   = 'No commits yet';
                $shortSha = 'none';
                $message  = 'Initial state (no commits recorded yet)';
                $author   = '—';
                $date     = '—';
            }

            $remoteRes = $this->runCommand('git remote get-url origin 2>&1');
            $remote = ($remoteRes['code'] === 0) ? trim($remoteRes['output']) : 'Not configured (run: git remote add origin <url>)';

            $statusRes = $this->runCommand('git status --short 2>&1');
            $status = ($statusRes['code'] === 0) ? trim($statusRes['output']) : '';

            return compact('branch', 'commit', 'shortSha', 'message', 'author', 'date', 'remote', 'status');
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function readDeployLog(): string
    {
        $logPath = storage_path('logs/deploy.log');
        if (!file_exists($logPath)) return '';

        $content = file_get_contents($logPath);
        $lines = array_slice(explode("\n", $content), -100);
        return implode("\n", $lines);
    }

    private function runCommand(string $cmd): array
    {
        if (!function_exists('exec')) {
            return ['output' => 'PHP exec() function is disabled on this server.', 'code' => 1];
        }
        $output = [];
        $code   = 0;
        $basePath = escapeshellarg(base_path());
        $fullCmd = "cd {$basePath} && {$cmd}";
        exec($fullCmd, $output, $code);
        return ['output' => implode("\n", $output), 'code' => $code];
    }

    private function runArtisan(string $command, array $parameters = []): array
    {
        try {
            $buffer = new BufferedOutput();
            $exitCode = Artisan::call($command, $parameters, $buffer);
            $text = trim($buffer->fetch());
            return [
                'output' => $text !== '' ? $text : "Completed {$command}.",
                'ok'     => $exitCode === 0,
            ];
        } catch (\Throwable $e) {
            return [
                'output' => $e->getMessage(),
                'ok'     => false,
            ];
        }
    }

    private function findPhpCliBinary(): ?string
    {
        $candidates = array_filter([
            PHP_BINDIR . DIRECTORY_SEPARATOR . (PHP_OS_FAMILY === 'Windows' ? 'php.exe' : 'php'),
            (stripos(PHP_BINARY, 'fpm') === false && stripos(PHP_BINARY, 'cgi') === false && stripos(PHP_BINARY, 'lsphp') === false) ? PHP_BINARY : null,
            'php',
            '/usr/bin/php',
            '/usr/local/bin/php',
        ]);

        foreach ($candidates as $bin) {
            $check = $this->runCommand(escapeshellarg($bin) . ' -r "echo php_sapi_name();" 2>&1');
            if ($check['code'] === 0 && trim($check['output']) === 'cli') {
                return $bin;
            }
        }
        return null;
    }

    private function findComposerBinary(): ?string
    {
        $finder = PHP_OS_FAMILY === 'Windows' ? 'where' : 'command -v';
        $candidates = [
            'composer',
            '/usr/local/bin/composer',
            '/usr/bin/composer',
            'composer2',
            '/opt/cpanel/composer/bin/composer',
        ];
        foreach ($candidates as $bin) {
            $check = $this->runCommand("{$finder} " . escapeshellarg($bin) . " 2>&1");
            if ($check['code'] === 0 && !empty(trim($check['output']))) {
                $lines = preg_split('/\r?\n/', trim($check['output']));
                return trim($lines[0]);
            }
        }
        if (file_exists(base_path('composer.phar'))) {
            $phpCli = $this->findPhpCliBinary() ?: 'php';
            return escapeshellarg($phpCli) . ' ' . escapeshellarg(base_path('composer.phar'));
        }
        return null;
    }

    private function log(string $message): void
    {
        $logPath = storage_path('logs/deploy.log');
        $line    = '[' . now()->format('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
        @file_put_contents($logPath, $line, FILE_APPEND | LOCK_EX);
    }
}
