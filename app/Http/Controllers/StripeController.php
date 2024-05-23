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

    public function fallback(Request $request)
    {
        // TODO refactor
        \Stripe\Stripe::setApiKey(
            'sk_test_51JuHUlBkAPUOBJWwMS2d70lMN78eU0SpfcMyAU77wpdyxxs9CorYxWzXtRFM6hkj68Glni3fJe91rqtWCg0Mw9uE00wjLWxeIC'
        );

        // You can find your endpoint's secret in your webhook settings
        $endpoint_secret = 'whsec_e378967533ccbe5d370e24c958fc888922ef865af176154b2753e24f006c792c';

        $payload = $request->all();
        $sig_header = $request->header('HTTP_STRIPE_SIGNATURE');
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            \Log::info('UnexpectedValueException');
            \Log::info(json_encode($e->getMessage()));

            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {

            \Log::info('SignatureVerificationException');
            \Log::info(json_encode($e->getMessage()));

            return response('Invalid signature', 400);
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {

            // TODO potrzebuje jakiegoś indefyikatora tego zamówienia
            // $order->payment_session_id = $event->data->object->id;
            // $order->save()
            \Log::info($event->data->object->id);
        }

        return response('', 200);
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
