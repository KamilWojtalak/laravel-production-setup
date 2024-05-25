<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    const PAYMENT_PROVIDER_STRIPE = 'stripe';

    const PAYMENT_STATUS_VERIFIED = 'payment_verified';

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public static function getByPaymentSessionId(string $paymentSessionId): Order
    {
        $order = static::query()
            ->where('payment_session_id', $paymentSessionId)
            ->firstOrFail();

        return $order;
    }

    public function getPriceForPaymentProvider(): int
    {
        return (int) $this->price * 100;
    }
}
