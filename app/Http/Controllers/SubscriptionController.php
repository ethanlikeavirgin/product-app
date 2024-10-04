<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;
use Mollie\Laravel\Facades\Mollie;
use Laravel\Cashier\Mollie\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function showSubscribePage()
    {
        // Fetch active payment methods from Mollie
        $methods = Mollie::api()->methods->allActive();

        return view('subscribe', compact('methods'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'mollie_payment_method' => 'required', // Only need the payment method
        ]);

        $user = Auth::user(); // Get the authenticated user

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to subscribe.');
        }
        $subscription = $user->newSubscription('default', 'example-1')->create();
        return redirect()->route('subscription.invoices', $subscription->id)->with('status', 'Subscription created successfully!');
    }
}
