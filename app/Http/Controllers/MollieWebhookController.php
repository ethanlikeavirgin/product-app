<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class MollieWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $paymentId = $request->input('id');

        $payment = Mollie::api()->payments()->get($paymentId);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
            // Handle successful payment
        }

        // Handle other webhook events like failed payment, refunds, etc.
    }
}
