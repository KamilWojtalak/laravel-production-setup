<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Services\Models\OrderService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Stripe;

class StripeService
{
    private $checkoutSession;

    public function setApiKey(): void
    {
        Stripe::setApiKey(config('payments.stripe.secret'));
    }

    public function createCheckoutSession(): void
    {
        $this->setApiKey();

        $body = $this->getBody();

        $this->checkoutSession = \Stripe\Checkout\Session::create($body);

        $this->createOrder();
    }

    public function getRedirectUrl(): string
    {
        return $this->checkoutSession->url;
    }

    public function handleFallbackLogic(Request $request): Response|ResponseFactory
    {
        $this->setApiKey();

        try {
            $event = $this->constructEvent($request);
        } catch (\UnexpectedValueException $e) {
            return $this->handleUnexpectedValueException($e);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return $this->handleSignatureVerificationException($e);
        }

        $this->handleCompletedEvent($event);

        return response('', 200);
    }

    private function createOrder(): void
    {
        Order::create([
            'payment_session_id' => $this->checkoutSession->id,
            'price' => 2.00,
            'payment_provider' => Order::PAYMENT_PROVIDER_STRIPE
        ]);
    }

    private function handleCompletedEvent(\Stripe\Event $event): void
    {
        if ($this->isCheckoutSessionCompleted($event)) {

            $order = Order::getByPaymentSessionId($event->data->object->id);

            $orderService = new OrderService($order);

            $orderService
                ->verify()
                ->save();
        }
    }

    private function isCheckoutSessionCompleted(\Stripe\Event  $event): bool
    {
        return $event->type == 'checkout.session.completed';
    }

    private function constructEvent(Request $request): \Stripe\Event
    {
        $endpointSecret = $this->getWebhookSecret();

        $payload = $request->getContent();

        $sigHeader = $request->header('Stripe-Signature');

        $event = \Stripe\Webhook::constructEvent(
            $payload,
            $sigHeader,
            $endpointSecret
        );

        return $event;
    }

    private function getWebhookSecret(): string
    {
        $endpointSecret = config('payments.stripe.webhook_secret');

        return $endpointSecret;
    }


    private function handleUnexpectedValueException(\UnexpectedValueException $e): Response|ResponseFactory
    {
        \Log::info('STRIPE FALLBACK | UnexpectedValueException');
        \Log::info($e->getMessage());

        return response('Invalid payload', 400);
    }

    private function handleSignatureVerificationException(\Stripe\Exception\SignatureVerificationException $e): Response|ResponseFactory
    {
        \Log::info('STRIPE FALLBACK | SignatureVerificationException');
        \Log::info($e->getMessage());

        return response('Invalid signature', 400);
    }

    private function getBody(): array
    {
        $domain = config('app.url');

        return [
            'line_items' => [[
                'price_data' => [
                    'currency' => 'PLN',
                    // 'currency' => 'USD',
                    // Kasa, minimum 2zł
                    'unit_amount_decimal' => 200.00,
                    'product_data' => [
                        'name' => 'Nazwa wyświetlana produktu dla użytkownika',
                        'description' => 'Opis wyświetlany dla użytkownika',
                        'images' => [
                            'https://place-hold.it/100',
                            'https://place-hold.it/50',
                            'https://place-hold.it/100/50',
                        ],
                        'metadata' => [
                            'metadatakey1' => 'value1',
                            'metadatakey2' => 'value2',
                            'metadatakey3' => 'value3',
                        ]
                    ],
                ],
                'quantity' => 1,
            ]],
            // NOTE może też być subscription
            'mode' => 'payment',
            'success_url' => $domain . '/stripe/success',
            'cancel_url' => $domain . '/stripe/cancel',
        ];
    }
}
