<?php

namespace App\Http\Controllers;

use App\Services\Payments\StripeService;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        return view('stripe.index');
    }

    public function store(Request $request)
    {
        $stripe = new StripeService();

        $stripe->setApiKey();

        $stripe->createCheckoutSession();

        $redirectUrl = $stripe->getRedirectUrl();

        return redirect()->away($redirectUrl);
    }

    public function success()
    {
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
