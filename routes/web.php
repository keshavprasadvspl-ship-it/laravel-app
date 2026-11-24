<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\FallbackController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\InquiryController as AdminInquiry;
use App\Http\Controllers\Admin\PostController as AdminPost;
use App\Http\Controllers\Admin\PageController as AdminPage;
use App\Http\Controllers\Admin\RedirectController as AdminRedirect;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\DeployController as AdminDeploy;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AdminAuth::class, 'showLogin'])->name('login');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuth::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuth::class, 'logout'])->name('admin.logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [AdminDashboard::class, 'index']);

        // Products CRUD
        Route::resource('products', AdminProduct::class, ['as' => 'admin']);

        // Categories CRUD
        Route::resource('categories', AdminCategory::class, ['as' => 'admin'])->only(['index', 'store', 'update', 'destroy']);

        // CMS Pages Management
        Route::resource('pages', AdminPage::class, ['as' => 'admin']);

        // 301/302 URL Redirects Management
        Route::resource('redirects', AdminRedirect::class, ['as' => 'admin'])->only(['index', 'store', 'update', 'destroy']);

        // Inquiries Management & Export
        Route::get('inquiries/export', [AdminInquiry::class, 'export'])->name('admin.inquiries.export');
        Route::patch('inquiries/{inquiry}/status', [AdminInquiry::class, 'updateStatus'])->name('admin.inquiries.update_status');
        Route::resource('inquiries', AdminInquiry::class, ['as' => 'admin'])->only(['index', 'show', 'destroy']);

        // Posts / Blogs Management
        Route::resource('posts', AdminPost::class, ['as' => 'admin'])->only(['index', 'store', 'destroy']);

        // Website Global Settings
        Route::get('settings', [AdminSetting::class, 'index'])->name('admin.settings.index');
        Route::post('settings', [AdminSetting::class, 'update'])->name('admin.settings.update');

        // Git Deployment Management
        Route::get('deploy', [AdminDeploy::class, 'index'])->name('admin.deploy.index');
        Route::post('deploy', [AdminDeploy::class, 'deploy'])->name('admin.deploy.run');
        Route::post('deploy/clear-cache', [AdminDeploy::class, 'clearCache'])->name('admin.deploy.cache');
        Route::post('deploy/clear-log', [AdminDeploy::class, 'clearLog'])->name('admin.deploy.clear_log');
    });
});

// Auto-Deploy Webhook Endpoint (GitHub / GitLab / Bitbucket)
Route::post('/webhook/git-deploy', [AdminDeploy::class, 'webhook'])->name('webhook.git-deploy');

// Direct migration & cache clear helper (useful on shared hosting without terminal)
Route::get('/system/run-migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $migrateOutput = \Illuminate\Support\Facades\Artisan::output();
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return response()->json([
        'success' => true,
        'migrate_output' => $migrateOutput,
        'timestamp' => now()->toDateTimeString(),
    ]);
});

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/
// Media / Uploads Fallback (redirect missing assets to live CDN)
Route::get('/uploads/{path}', function ($path) {
    $localPath = public_path('uploads/' . $path);
    if (file_exists($localPath)) {
        return response()->file($localPath);
    }
    return redirect('https://sdinternational.com/wp-content/uploads/' . $path, 302);
})->where('path', '.*');

Route::get('/wp-content/uploads/{path}', function ($path) {
    $localPath = public_path('uploads/' . $path);
    if (file_exists($localPath)) {
        return response()->file($localPath);
    }
    return redirect('https://sdinternational.com/wp-content/uploads/' . $path, 302);
})->where('path', '.*');

// 1. Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Catalog & Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}/tds', [ProductController::class, 'tds'])->name('products.tds');
Route::get('/product/{slug}', function ($slug) {
    $parts = explode('/', trim($slug, '/'));
    $productSlug = array_pop($parts);
    return redirect('/' . $productSlug, 301);
})->where('slug', '.*');
Route::get('/api/products/search', [ProductController::class, 'searchApi'])->name('api.products.search');

// 3. Category legacy paths
Route::get('/product-category/{slug}', [CategoryController::class, 'show'])->name('category.legacy');

// 4. Commercial Quote & Sample Requests
Route::get('/request-quote', [PageController::class, 'requestQuote'])->name('quote.request');
Route::get('/sample-request', [PageController::class, 'requestQuote'])->name('sample.request');

// 5. Blogs & News
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/page/{page}', function($page) {
    if ((int)$page <= 1) {
        return redirect()->route('blogs.index', [], 301);
    }
    request()->merge(['page' => $page]);
    return app(BlogController::class)->index();
})->where('page', '[0-9]+');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blog/{slug}', function($slug) {
    return redirect('/blogs/' . trim($slug, '/'), 301);
});
Route::get('/blog', function() {
    return redirect()->route('blogs.index', [], 301);
});
Route::get('/uncategorized/{slug}', function($slug) {
    return redirect('/blogs/' . trim($slug, '/'), 301);
});

// 6. Inquiries Form submissions (Contact, Quote, Sample)
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::post('/api/inquiries', [InquiryController::class, 'store'])->name('api.inquiries.store');

// 7. Sitemaps & Search Engines (Rank Math SEO Compatibility)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap_index.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-products.xml', [SitemapController::class, 'products']);
Route::get('/sitemap-categories.xml', [SitemapController::class, 'categories']);
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages']);
Route::get('/sitemap-posts.xml', [SitemapController::class, 'posts']);
Route::get('/robots.txt', [SitemapController::class, 'robots']);

// 8. Core CMS Pages & Applications
Route::get('/applications', [PageController::class, 'applications'])->name('applications.index');
Route::get('/applications/{slug}', [PageController::class, 'showApplication'])->name('applications.show');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.index');
Route::get('/about', [PageController::class, 'aboutUs']);
Route::get('/certifications', [PageController::class, 'certifications'])->name('certifications.index');
Route::get('/sustainability', [PageController::class, 'sustainability'])->name('sustainability.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');

// 8b. International Country Landing Pages (5 Families x 39 Countries)
Route::get('/dyes/{slug}', function ($slug) {
    return app(PageController::class)->showCountryPage('dyes', $slug);
})->where('slug', '[^/]+');

Route::get('/pigments/{slug}', function ($slug) {
    return app(PageController::class)->showCountryPage('pigments', $slug);
})->where('slug', '[^/]+');

Route::get('/f-d-c-colours/{slug}', function ($slug) {
    return app(PageController::class)->showCountryPage('f-d-c-colours', $slug);
})->where('slug', '[^/]+');

Route::get('/naphthols-fast-bases-fast-salts/{slug}', function ($slug) {
    return app(PageController::class)->showCountryPage('naphthols-fast-bases-fast-salts', $slug);
})->where('slug', '[^/]+');

Route::get('/intermediates/{slug}', function ($slug) {
    return app(PageController::class)->showCountryPage('intermediates', $slug);
})->where('slug', '[^/]+');

// 9. Universal Dynamic Slug Resolver (Must be last)
Route::get('/{slug}', [FallbackController::class, 'resolve'])->where('slug', '^(?!admin).*$')->name('fallback.resolve');
