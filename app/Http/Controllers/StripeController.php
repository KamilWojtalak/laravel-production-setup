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

    public function store(Request $request, StripeService $stripe): RedirectResponse
    {
        $redirectUrl = $this->getStripePaymentUrl($request, $stripe);

        return redirect()->away($redirectUrl);
    }

    public function fallback(Request $request, StripeService $stripe): Response|ResponseFactory
    {
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

    private function getStripePaymentUrl(Request $request, StripeService $stripe): string
    {
        $planId = $request->get('plan_id');

        $plan = Plan::findOrFail($planId);

        $stripe->createCheckoutSession($plan);

        $redirectUrl = $stripe->getRedirectUrl();

        return $redirectUrl;
    }
}
