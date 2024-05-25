<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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
        $plans = Plan::get();

        return view('stripe.index', [
            'plans' => $plans
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $redirectUrl = $this->getStripePaymentUrl($request);

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

    private function getStripePaymentUrl(Request $request): string
    {
        $planId = $request->get('plan_id');

        $plan = Plan::findOrFail($planId);

        $stripe = new StripeService();

        $stripe->createCheckoutSession($plan);

        $redirectUrl = $stripe->getRedirectUrl();

        return $redirectUrl;
    }

}
