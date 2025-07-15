<?php


namespace App\Application\Order;

use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;

class OrderHandler
{
    public function __construct(private OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(
        string $user_id,
        string $name,
        string $phone_number,
        string $address,
        int $total_price,
        string $status,
        string $payment_method,
    ) {
        $newOrder = new Order(
            $user_id,
            $name,
            $phone_number,
            $address,
            $total_price,
            $status,
            $payment_method,
        );

        $this->orderRepository->create($newOrder);
    }
}
