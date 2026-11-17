<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\Page;
use App\Models\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
            'quoted_inquiries' => Inquiry::where('status', 'quoted')->count(),
            'total_posts' => Post::count(),
            'total_pages' => Page::count(),
            'total_redirects' => Redirect::count(),
        ];

        $recentInquiries = Inquiry::latest()->take(6)->get();
        $recentProducts = Product::latest()->take(6)->get();

        // Git repository status for quick deployment widget
        $gitInfo = [
            'branch' => 'master',
            'shortSha' => '—',
            'message' => '—',
            'date' => '—',
            'author' => '—',
            'isClean' => true,
        ];

        try {
            $basePath = escapeshellarg(base_path());
            $branchOut = @shell_exec("cd {$basePath} && git branch --show-current 2>&1");
            if ($branchOut && trim($branchOut) !== '') {
                $gitInfo['branch'] = trim($branchOut);
            }

            $logOut = @shell_exec("cd {$basePath} && git log -1 --format=\"%h|%s|%an|%ci\" 2>&1");
            if ($logOut && str_contains($logOut, '|')) {
                $parts = explode('|', trim($logOut), 4);
                $gitInfo['shortSha'] = $parts[0] ?? '—';
                $gitInfo['message'] = $parts[1] ?? '—';
                $gitInfo['author'] = $parts[2] ?? '—';
                $gitInfo['date'] = $parts[3] ?? '—';
            }

            $statusOut = @shell_exec("cd {$basePath} && git status --short 2>&1");
            $gitInfo['isClean'] = empty(trim($statusOut ?? ''));
        } catch (\Throwable $e) {
            // Silently fallback to defaults
        }

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentProducts', 'gitInfo'));
    }
}
