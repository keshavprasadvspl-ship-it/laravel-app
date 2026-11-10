<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index(Request $request)
    {
        $query = Redirect::latest();

        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where(function ($q) use ($s) {
                $q->where('source_pattern', 'like', "%{$s}%")
                  ->orWhere('destination_url', 'like', "%{$s}%");
            });
        }

        $redirects = $query->paginate(25)->withQueryString();

        return view('admin.redirects.index', compact('redirects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_pattern' => 'required|string|max:255|unique:redirects,source_pattern',
            'destination_url' => 'required|string|max:255',
            'status_code' => 'required|integer|in:301,302',
        ]);

        $validated['source_pattern'] = ltrim($validated['source_pattern'], '/');

        Redirect::create($validated);

        return back()->with('success', 'URL Redirect rule created successfully!');
    }

    public function update(Request $request, Redirect $redirect)
    {
        $validated = $request->validate([
            'source_pattern' => 'required|string|max:255|unique:redirects,source_pattern,' . $redirect->id,
            'destination_url' => 'required|string|max:255',
            'status_code' => 'required|integer|in:301,302',
        ]);

        $validated['source_pattern'] = ltrim($validated['source_pattern'], '/');

        $redirect->update($validated);

        return back()->with('success', 'URL Redirect rule updated successfully!');
    }

    public function destroy(Redirect $redirect)
    {
        $redirect->delete();
        return back()->with('success', 'URL Redirect rule deleted successfully!');
    }
}
