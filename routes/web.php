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

        // Inquiries Management
        Route::resource('inquiries', AdminInquiry::class, ['as' => 'admin'])->only(['index', 'destroy']);

        // Posts / Blogs Management
        Route::resource('posts', AdminPost::class, ['as' => 'admin'])->only(['index', 'store', 'destroy']);

        // Git Deployment Management
        Route::get('deploy', [AdminDeploy::class, 'index'])->name('admin.deploy.index');
        Route::post('deploy', [AdminDeploy::class, 'deploy'])->name('admin.deploy.run');
        Route::post('deploy/clear-cache', [AdminDeploy::class, 'clearCache'])->name('admin.deploy.cache');
        Route::post('deploy/clear-log', [AdminDeploy::class, 'clearLog'])->name('admin.deploy.clear_log');
    });
});

// Auto-Deploy Webhook Endpoint (GitHub / GitLab / Bitbucket)
Route::post('/webhook/git-deploy', [AdminDeploy::class, 'webhook'])->name('webhook.git-deploy');

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/
// 1. Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Catalog & Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', function ($slug) {
    return redirect('/' . $slug, 301);
});

// 3. Category legacy paths
Route::get('/product-category/{slug}', [CategoryController::class, 'show'])->name('category.legacy');

// 4. Blogs & News
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// 5. Inquiries (Contact & Quote Modal Form submissions)
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// 6. Sitemaps & Search Engines (Rank Math SEO Compatibility)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap_index.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-products.xml', [SitemapController::class, 'products']);
Route::get('/sitemap-categories.xml', [SitemapController::class, 'categories']);
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages']);
Route::get('/sitemap-posts.xml', [SitemapController::class, 'posts']);
Route::get('/robots.txt', [SitemapController::class, 'robots']);

// 7. Core Static CMS Pages
Route::get('/about-us', [PageController::class, 'show'])->defaults('slug', 'about-us');
Route::get('/applications', [PageController::class, 'show'])->defaults('slug', 'applications');
Route::get('/certifications', [PageController::class, 'show'])->defaults('slug', 'certifications');
Route::get('/sustainability', [PageController::class, 'show'])->defaults('slug', 'sustainability');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');

// 8. Universal Dynamic Slug Resolver (Must be last)
Route::get('/{slug}', [FallbackController::class, 'resolve'])->where('slug', '^(?!admin).*$')->name('fallback.resolve');
