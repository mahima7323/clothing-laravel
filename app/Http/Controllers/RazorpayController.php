<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;


class RazorpayController extends Controller
{
    public function index()
    {
        return view('razorpay');
    }
    public function payment(Request $request)
    {
        $amount = $request->input('amount');
        echo $amount;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);
        if ($payment->status == 'authorized') {
            $payment->capture(['amount' => $payment->amount]);
            return back()->with('success', 'Payment successful!');
        } else {
            return back()->with('error', 'Payment failed!');
        }
    }
}
