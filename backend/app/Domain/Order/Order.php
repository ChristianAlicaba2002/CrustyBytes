<?php

namespace App\Domain\Order;

class Order
{
    public function __construct(
        private string $user_id,
        private string $name,
        private string $phone_number,
        private string $address,
        private int $total_price,
        private string $status,
        private string $payment_method,
    ) {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->total_price = $total_price;
        $this->status = $status;
        $this->payment_method = $payment_method;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPaymentMethod(): string
    {
        return $this->payment_method;
    }
}
