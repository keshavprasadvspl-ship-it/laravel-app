<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;

class EnsureTrailingSlash
{
    /**
     * Handle an incoming request.
     * Enforce trailing slashes on all page URLs (matching WordPress/SD International behavior).
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only enforce for GET and HEAD requests
        if (!in_array($request->method(), ['GET', 'HEAD'], true)) {
            return $next($request);
        }

        $path = $request->getPathInfo(); // e.g. "/about-us", "/about-us/", "/"

        // If root '/', already has trailing slash
        if ($path === '/' || $path === '') {
            return $next($request);
        }

        // Exclude static assets with file extensions (e.g. .css, .js, .png, .jpg, .svg, .webp, .xml, .txt, .pdf, .json, .ico, etc.)
        if (preg_match('/\.[a-zA-Z0-9]{2,5}$/', $path)) {
            return $next($request);
        }

        // Exclude specific system prefixes: api, webhook, system, admin, uploads, wp-content, up
        if ($request->is([
            'api/*',
            'api',
            'webhook/*',
            'webhook',
            'system/*',
            'system',
            'admin/*',
            'admin',
            'uploads/*',
            'wp-content/*',
            'up',
        ])) {
            return $next($request);
        }

        // If path does not end with '/', redirect with 301 Moved Permanently
        if (!str_ends_with($path, '/')) {
            $queryString = $request->getQueryString();
            $redirectUrl = $path . '/' . ($queryString ? '?' . $queryString : '');
            return new RedirectResponse($redirectUrl, 301);
        }

        return $next($request);
    }
}
