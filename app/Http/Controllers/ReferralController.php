<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referral;

class ReferralController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ref' => 'required|string',
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        Referral::create([
            'ref' => $request->ref,
            'business_id' => $request->business_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Referral submitted successfully.');
    }
}
