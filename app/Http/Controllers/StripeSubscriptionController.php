<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Services\Payments\StripeSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Contracts\View\Factory as ViewFactory;
use \Illuminate\Contracts\View\View;

class StripeSubscriptionController extends Controller
{
    public function index(): View|ViewFactory
    {
        $plans = Plan::get();

        return view('stripe.subscription.index', [
            'plans' => $plans
        ]);
    }

    public function store(Request $request, StripeSubscriptionService $stripe): RedirectResponse
    {
        $redirectUrl = $this->getStripePaymentUrl($request, $stripe);

        return redirect()->away($redirectUrl);
    }

    public function success(): View|ViewFactory
    {
        return view('stripe.subscription.success');
    }

    public function cancel(): View|ViewFactory
    {
        return view('stripe.subscription.cancel');
    }

    public function createPortalSession(Request $request, StripeSubscriptionService $stripe): RedirectResponse
    {
        $redirectUrl = $this->createPortalSessionUrl($request, $stripe);

        return redirect()->away($redirectUrl);
    }

    public function fallback(Request $request, StripeSubscriptionService $stripe): void
    {
        $stripe->handleFallbackLogic($request);
    }

    private function getStripePaymentUrl(Request $request, StripeSubscriptionService $stripe): string
    {
        $lookUpKey = $request->get('lookup_key');

        $stripe->createCheckoutSession($lookUpKey);

        $redirectUrl = $stripe->getRedirectUrl();

        return $redirectUrl;
    }

    private function createPortalSessionUrl(Request $request, StripeSubscriptionService $stripe): string
    {
        $sessionId = $request->get('session_id');

        $redirectUrl = $stripe->createPortalSessionId($sessionId);

        return $redirectUrl;
    }

}
