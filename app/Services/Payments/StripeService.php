<?php

namespace App\Services\Payments;

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
        $body = $this->getBody();

        $this->checkoutSession = \Stripe\Checkout\Session::create($body);
    }

    public function getRedirectUrl(): string
    {
        return $this->checkoutSession->url;
    }

    private function getBody(): array
    {
        $domain = 'http://localhost';

        return [
            'line_items' => [[
                'price_data' => [
                    // 'currency' => 'PLN',
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => 'Nazwa wyświetlana produktu dla użytkownika',
                        'description' => 'Opis wyświetlany dla użytkownika',
                        'images' => [
                            'https://place-hold.it/50',
                            'https://place-hold.it/100',
                            'https://place-hold.it/100/50',
                        ],
                        'metadata' => [
                            'metadatakey1' => 'value1',
                            'metadatakey2' => 'value2',
                            'metadatakey3' => 'value3',
                        ]
                    ],
                ],
                // 'price' => 'pr_1234',
                'quantity' => 1,
            ]],
            // NOTE może też być subscription
            'mode' => 'payment',
            'success_url' => $domain . '/stripe/success',
            'cancel_url' => $domain . '/stripe/cancel',
        ];
    }
}
