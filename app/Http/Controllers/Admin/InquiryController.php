<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::latest();

        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('company', 'like', "%{$s}%")
                  ->orWhere('country', 'like', "%{$s}%")
                  ->orWhere('product_name', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('type') && $request->input('type') !== 'all') {
            $query->where('inquiry_type', $request->input('type'));
        }

        $inquiries = $query->paginate(20)->withQueryString();

        $statusCounts = [
            'all' => Inquiry::count(),
            'new' => Inquiry::where('status', 'new')->count(),
            'in_progress' => Inquiry::where('status', 'in_progress')->count(),
            'quoted' => Inquiry::where('status', 'quoted')->count(),
            'sample_sent' => Inquiry::where('status', 'sample_sent')->count(),
            'closed' => Inquiry::where('status', 'closed')->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'statusCounts'));
    }

    public function show(Inquiry $inquiry)
    {
        return response()->json($inquiry);
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:new,in_progress,quoted,sample_sent,closed',
        ]);

        $inquiry->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Inquiry #' . $inquiry->id . ' status updated to ' . ucfirst(str_replace('_', ' ', $validated['status'])) . '!');
    }

    public function export(Request $request)
    {
        $query = Inquiry::latest();

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $filename = 'export-inquiries-' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($query) {
            $file = fopen('php://output', 'w');
            // Add UTF-8 BOM
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'Inquiry ID',
                'Date (UTC)',
                'Full Name',
                'Corporate Email',
                'Phone / WhatsApp',
                'Company Name',
                'Country',
                'Inquiry Purpose',
                'Product of Interest',
                'Status',
                'Client IP',
                'Detailed Message',
            ]);

            $query->chunk(100, function ($rows) use ($file) {
                foreach ($rows as $inq) {
                    fputcsv($file, [
                        $inq->id,
                        $inq->created_at ? $inq->created_at->format('Y-m-d H:i:s') : '',
                        $inq->name,
                        $inq->email,
                        $inq->phone,
                        $inq->company,
                        $inq->country,
                        strtoupper($inq->inquiry_type ?: 'QUOTE'),
                        $inq->product_name ?: ($inq->product_slug ?: 'General'),
                        strtoupper(str_replace('_', ' ', $inq->status ?: 'NEW')),
                        $inq->ip_address,
                        $inq->message,
                    ]);
                }
            });

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return back()->with('success', 'Inquiry #' . $inquiry->id . ' deleted successfully!');
    }
}
