<?php

namespace App\Http\Controllers;

use App\Models\WebsiteInquiry;
use Illuminate\Http\Request;

class WebsiteInquiryController extends Controller
{
    /**
     * Store a new guest website inquiry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:120',
            'business_name' => 'nullable|string|max:150',
            'email'         => 'required|email|max:150',
            'phone'         => 'nullable|string|max:30',
            'wa_number'     => 'required|string|max:30',
            'message'       => 'nullable|string|max:2000',
        ]);

        $inquiry = WebsiteInquiry::create([
            'name'          => $validated['name'],
            'business_name' => $validated['business_name'] ?? null,
            'email'         => $validated['email'],
            'phone'         => $validated['phone'] ?? null,
            'wa_number'     => $validated['wa_number'],
            'message'       => $validated['message'] ?? null,
            'status'        => 'pending',
        ]);

        $successMsg = 'Thank you! Your website request has been submitted. Our team will contact your WhatsApp soon.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'inquiry' => $inquiry,
            ]);
        }

        return redirect()->to(url()->previous() . '#website-inquiry')
            ->with('inquiry_success', $successMsg);
    }
}
