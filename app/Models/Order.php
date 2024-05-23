<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    CONST PAYMENT_PROVIDER_STRIPE = 'stripe';

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
