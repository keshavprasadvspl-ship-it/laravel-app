<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * Run git pull + post-deploy tasks from the admin panel.
     */
    public function deploy(Request $request)
    {
        $output = [];
        $startTime = microtime(true);

        $this->log("=== Manual Deploy Started by Admin ===");
        $this->log("Time: " . now()->format('Y-m-d H:i:s'));
        $this->log("User: " . (auth()->user()->name ?? 'Admin'));
        $this->log("IP: " . $request->ip());
        $this->log("---");

        try {
            // 1. Git Pull
            $this->log("▶ Running git pull...");
            $pullResult = $this->runCommand('git pull origin HEAD 2>&1');
            $this->log($pullResult['output']);
            $output[] = ['step' => 'Git Pull', 'result' => $pullResult['output'], 'ok' => $pullResult['code'] === 0];

            // 2. Composer Install (no dev, optimize)
            $this->log("▶ Running composer install...");
            $composerResult = $this->runCommand('composer install --no-dev --optimize-autoloader 2>&1');
            $this->log($composerResult['output']);
            $output[] = ['step' => 'Composer Install', 'result' => $composerResult['output'], 'ok' => $composerResult['code'] === 0];

            // 3. Clear and cache config
            $this->log("▶ Clearing caches...");
            $clearResult = $this->runCommand('php artisan config:cache 2>&1');
            $this->log($clearResult['output']);
            $output[] = ['step' => 'Config Cache', 'result' => $clearResult['output'], 'ok' => $clearResult['code'] === 0];

            // 4. Route cache
            $routeResult = $this->runCommand('php artisan route:cache 2>&1');
            $this->log($routeResult['output']);
            $output[] = ['step' => 'Route Cache', 'result' => $routeResult['output'], 'ok' => $routeResult['code'] === 0];

            // 5. View cache
            $viewResult = $this->runCommand('php artisan view:cache 2>&1');
            $this->log($viewResult['output']);
            $output[] = ['step' => 'View Cache', 'result' => $viewResult['output'], 'ok' => $viewResult['code'] === 0];

            // 6. Run DB migrations (safe)
            $this->log("▶ Running migrations...");
            $migrateResult = $this->runCommand('php artisan migrate --force 2>&1');
            $this->log($migrateResult['output']);
            $output[] = ['step' => 'DB Migrate', 'result' => $migrateResult['output'], 'ok' => $migrateResult['code'] === 0];

            // 7. Storage link
            $storageResult = $this->runCommand('php artisan storage:link 2>&1');
            $this->log($storageResult['output']);
            $output[] = ['step' => 'Storage Link', 'result' => $storageResult['output'], 'ok' => true];

            $elapsed = round(microtime(true) - $startTime, 2);
            $this->log("✅ Deploy completed in {$elapsed}s");

            return back()->with('deploy_success', true)
                         ->with('deploy_output', $output)
                         ->with('deploy_time', $elapsed);

        } catch (\Exception $e) {
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
        $branch  = data_get($payload, 'ref', '');
        $allowedBranches = ['refs/heads/main', 'refs/heads/master'];

        if (!empty($branch) && !in_array($branch, $allowedBranches)) {
            return response()->json(['message' => "Skipped: branch {$branch} not in deploy list"]);
        }

        $pusher  = data_get($payload, 'pusher.name', 'GitHub');
        $commits = count(data_get($payload, 'commits', []));
        $this->log("=== Webhook Deploy: {$commits} commit(s) pushed by {$pusher} on {$branch} ===");

        // Run deploy steps in background
        $basePath = base_path();
        $phpBin   = PHP_BINARY;
        $artisan  = $basePath . '/artisan';
        $logFile  = storage_path('logs/deploy.log');

        $script = implode(' && ', [
            "cd " . escapeshellarg($basePath),
            "git pull origin HEAD >> " . escapeshellarg($logFile) . " 2>&1",
            "composer install --no-dev --optimize-autoloader >> " . escapeshellarg($logFile) . " 2>&1",
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
            $result = $this->runCommand("php artisan {$cmd} 2>&1");
            $output[] = ['step' => $cmd, 'result' => $result['output'], 'ok' => $result['code'] === 0];
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
        // Return last 100 lines
        $lines = array_slice(explode("\n", $content), -100);
        return implode("\n", $lines);
    }

    private function runCommand(string $cmd): array
    {
        $output = [];
        $code   = 0;
        exec($cmd, $output, $code);
        return ['output' => implode("\n", $output), 'code' => $code];
    }

    private function log(string $message): void
    {
        $logPath = storage_path('logs/deploy.log');
        $line    = '[' . now()->format('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
        file_put_contents($logPath, $line, FILE_APPEND | LOCK_EX);
    }
}
