<?php

namespace App\Services\Models;

use App\Models\Order;

class OrderService
{
    public function __construct(protected Order $order)
    {
        //
    }

    public function setPaymentStatus(string $paymentStatus): self
    {
        $this->order->status = $paymentStatus;

        return $this;
    }

    public function setPaymentSessionId(string $paymentSessionId): self
    {
        $this->order->payment_session_id = $paymentSessionId;

        return $this;
    }

    public function verify(): self
    {
        $this->setPaymentStatus(Order::PAYMENT_STATUS_VERIFIED);

        return $this;
    }

    public function markPaid(): self
    {
        $this->order->payed_at = now();

        return $this;
    }

    public function save(): self
    {
        $this->order->save();

        return $this;
    }
}
