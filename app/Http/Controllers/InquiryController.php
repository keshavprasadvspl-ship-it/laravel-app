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
            'company' => 'nullable|string|max:200',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'inquiry_type' => 'nullable|string|in:quote,sample,tds,msds,general',
            'product_name' => 'nullable|string|max:200',
            'product_slug' => 'nullable|string|max:200',
            'message' => 'nullable|string|max:3000',
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
            'company' => $validated['company'] ?? null,
            'country' => $validated['country'] ?? null,
            'inquiry_type' => $validated['inquiry_type'] ?? 'quote',
            'product_name' => $validated['product_name'] ?? null,
            'product_slug' => $validated['product_slug'] ?? null,
            'message' => !empty($validated['city']) 
                ? ("City: " . $validated['city'] . ($validated['message'] ? ("\n\n" . $validated['message']) : '')) 
                : ($validated['message'] ?? null),
            'ip_address' => $request->ip(),
            'status' => Inquiry::STATUS_NEW,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your export inquiry has been submitted. Our technical sales division in Mumbai will review your specifications and contact you shortly.',
            ]);
        }

        return back()->with('success', 'Thank you! Your export inquiry has been submitted successfully. Our sales team will get back to you shortly.');
    }
}
