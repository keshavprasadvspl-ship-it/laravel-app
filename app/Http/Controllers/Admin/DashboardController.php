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

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentProducts'));
    }
}
