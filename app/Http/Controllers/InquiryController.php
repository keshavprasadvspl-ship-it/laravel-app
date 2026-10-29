<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'product_name' => 'nullable|string|max:200',
            'product_slug' => 'nullable|string|max:200',
            'message' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'product_name' => $validated['product_name'] ?? null,
            'product_slug' => $validated['product_slug'] ?? null,
            'message' => $validated['message'] ?? null,
            'ip_address' => $request->ip(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been submitted. Our export sales team will reach out promptly.',
            ]);
        }

        return back()->with('success', 'Thank you! Your inquiry has been submitted successfully.');
    }
}
