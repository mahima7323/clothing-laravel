<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripePaymentController extends Controller
{
    public function index()
    {
        return view('stripe');
    }

    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => 'College Project Test Product',
                    ],
                    'unit_amount' => 10000, // ₹100 in paise
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/stripe-success'),
            'cancel_url' => url('/stripe-cancel'),
        ]);

        return redirect($session->url);
    }
    public function stripeCancel()
{
    return redirect()->route('cart.index')->with('error', 'Payment was cancelled. Please try again.');
}

}
