<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // 🟢 Show Plans Page
    public function create(Request $request)
    {
        if (auth()->user()->role !== 'jobseeker') {
            abort(403);
        }

        return view('dashboard.pages.candidate.payments');
    }

    // 🟢 Store Payment (After Razorpay Success)
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'jobseeker') {
            abort(403);
        }

        // ✅ Plan pricing
        $plans = [
            'basic' => 1100,
            'pro' => 2700,
            'premium' => 5500,
        ];

        $plan = $request->plan;

        if (!isset($plans[$plan])) {
            return back()->with('error', 'Invalid plan selected');
        }

        // ✅ Razorpay payment ID check
        if (!$request->razorpay_payment_id) {
            return back()->with('error', 'Payment failed');
        }

        // ✅ (Optional but better) Verify payment from Razorpay
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $payment = $api->payment->fetch($request->razorpay_payment_id);

            if ($payment->status !== 'captured') {
                return back()->with('error', 'Payment not verified');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Payment verification failed');
        }

        // ✅ Save Payment
        Payment::create([
            'user_id' => $user->id,
            'payment_id' => $request->razorpay_payment_id,
            'plan_name' => $plan,
            'amount' => $plans[$plan],
            'status' => 'success',
            'paid_at' => now(),
        ]);

        // ✅ Set expiry based on plan
        $days = match ($plan) {
            'basic' => 15,
            'pro' => 30,
            'premium' => 90,
        };

        // ✅ Activate Premium
        $user->update([
            'is_premium' => true,
            'premium_expires_at' => now()->addDays($days),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Payment successful! Premium activated 🚀');
    }
}
