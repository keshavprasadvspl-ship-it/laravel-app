<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Redirect;

class HandleRankMathRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = trim($request->path(), '/');

        // Check if legacy /product/{slug}
        if (str_starts_with($path, 'product/')) {
            $productSlug = substr($path, strlen('product/'));
            return redirect('/' . trim($productSlug, '/') . '/', 301);
        }

        // Check against redirects database
        $redirect = Redirect::where('source_pattern', $path)
            ->orWhere('source_pattern', '/' . $path)
            ->orWhere('source_pattern', $path . '/')
            ->first();

        if ($redirect) {
            $destination = $redirect->destination_url;
            if (!str_starts_with($destination, 'http://') && !str_starts_with($destination, 'https://')) {
                $destination = '/' . ltrim($destination, '/');
            }
            if (!str_ends_with($destination, '/') && !preg_match('/\.[a-zA-Z0-9]{2,5}$/', parse_url($destination, PHP_URL_PATH) ?? '')) {
                $destination = rtrim($destination, '/') . '/';
            }
            return redirect($destination, $redirect->status_code ?: 301);
        }

        return $next($request);
    }
}
