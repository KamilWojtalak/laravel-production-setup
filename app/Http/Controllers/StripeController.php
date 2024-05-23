<?php

namespace App\Http\Controllers;

use App\Services\Payments\StripeService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use \Illuminate\Contracts\View\Factory as ViewFactory;
use \Illuminate\Contracts\View\View;

class StripeController extends Controller
{
    public function index(): View|ViewFactory
    {
        return view('stripe.index');
    }

    public function store(): RedirectResponse
    {
        $stripe = new StripeService();

        $stripe->createCheckoutSession();

        $redirectUrl = $stripe->getRedirectUrl();

        return redirect()->away($redirectUrl);
    }

    public function fallback(Request $request): Response|ResponseFactory
    {
        $stripe = new StripeService();

        $response = $stripe->handleFallbackLogic($request);

        return $response;
    }

    public function success()
    {
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}
