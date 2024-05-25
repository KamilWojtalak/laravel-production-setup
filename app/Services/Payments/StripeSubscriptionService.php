<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Services\Models\OrderService;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Stripe\StripeObject;

// TODO do refactora, bo są code repetetion, ale to zrobie dopiero jak subscription zaczną mi działać
class StripeSubscriptionService
{
    private $checkoutSession;

    public function setApiKey(): void
    {
        Stripe::setApiKey(config('payments.stripe.secret'));
    }

    public function getRedirectUrl(): string
    {
        return $this->checkoutSession->url;
    }


    public function createCheckoutSession(string $lookUpKey): void
    {
        $this->setApiKey();

        try {
            $successUrl = url(route('stripe.subscription.success'), ['session_id' => '{CHECKOUT_SESSION_ID}']);
            $cancelUrl = url(route('stripe.subscription.cancel'));

            $order = $this->createOrderSubscription();

            $prices = \Stripe\Price::all([
                'lookup_keys' => [$lookUpKey],
                'expand' => ['data.product']
            ]);

            $this->checkoutSession = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price' => $prices->data[0]->id,
                    'quantity' => 1,
                ]],
                'subscription_data' => [
                    'metadata' => [
                        'order_id' => $order->id,
                    ],
                ],
                'mode' => 'subscription',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }

        $orderService = new OrderService($order);

        \Log::info('TWORZENIE CHECKOUT SESSION ID');
        \Log::info($this->checkoutSession->id);

        $orderService
            ->setPaymentSessionId($this->checkoutSession->id)
            ->save();
    }

    public function createPortalSessionId(string $sessionId): string
    {
        $this->setApiKey();

        // TODO refactor
        $successUrl = url(route('stripe.subscription.success'));

        try {
            $this->checkoutSession = \Stripe\Checkout\Session::retrieve($sessionId);

            // Authenticate your user.
            $session = \Stripe\BillingPortal\Session::create([
                'customer' => $this->checkoutSession->customer,
                'return_url' => $successUrl,
            ]);

            return $session->url;
        } catch (\Throwable $e) {
            http_response_code(500);
            throw $e;
        }
    }

    public function handleFallbackLogic(Request $request): Response|ResponseFactory
    {
        \Log::info('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
        $this->setApiKey();

        $endpointSecret = $this->getWebhookSecret();
        $sigHeader = $request->header('Stripe-Signature');

        $payload = $request->getContent();

        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true),
            );
        } catch (\UnexpectedValueException $e) {
            \Log::error('handleSubscriptionWebhooks | UnexpectedValueException');
            \Log::error($e->getMessage());

            return response('', 422);
        }

        $this->handleEventType($event);

        return response('', 200);
    }

    private function handleEventType(StripeObject $event): void
    {
        switch ($event->type) {
            case 'customer.subscription.created':
                $this->handleCreatedEvent($event);

                break;
            case 'customer.subscription.deleted':
                $this->handleDeletedEvent($event);

                break;
            case 'customer.subscription.updated':
                $this->handleUpdatedEvent($event);

                break;
            default:
                // Unexpected event type
                echo 'Received unknown event type';
        }
    }

    private function handleCreatedEvent(StripeObject $event): void
    {
        /**
         * zapisz tutaj za pomocą OderService subscription id
         */
        // NOTE Zapisujesz id subscription, czyli musisz mieć zapisane id pierwsze z checkout session i drugie z eventa

        $subscription = $event->data->object;

        $subscriptionId = $subscription->id;

        $orderId = $subscription->metadata->order_id;

        $order = Order::find($orderId);

        $orderService = new OrderService($order);

        $orderService
            ->setSubscriptionId($subscriptionId)
            ->save();
    }

    private function handleDeletedEvent(StripeObject $event): void
    {
        // Cancel
    }

    private function handleUpdatedEvent(StripeObject $event): void
    {
        $subscription = $event->data->object;

        $subscriptionId = $subscription->id;

        $order = Order::getBySubscriptionId($subscriptionId);

        $orderService = new OrderService($order);

        $orderService
            ->markPaid()
            ->save();
    }

    private function createOrderSubscription(): Order
    {
        return Order::create([
            'price' => 2.00,
            'payment_provider' => Order::PAYMENT_PROVIDER_STRIPE_SUBSCRIPTION,
            'plan_id' => 1,
            'payed_at' => null,
            'user_id' => auth()->id()
        ]);
    }

    private function getWebhookSecret(): string
    {
        $endpointSecret = config('payments.stripe.webhook_secret');

        return $endpointSecret;
    }
}
