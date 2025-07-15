<?php

namespace App\Infrastructure\Eloquent\Order;
use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;
use App\Models\Orders;

class EloquentOrderRepository implements OrderRepository
{
    public function create(Order $order)
    {
        $OrderModel = Orders::find($order->getUserId()) ?? new Orders;
        $OrderModel->user_id = $order->getUserId();
        $OrderModel->name = $order->getName();
        $OrderModel->phone_number = $order->getPhoneNumber();
        $OrderModel->address = $order->getAddress();
        $OrderModel->total_price = $order->getTotalPrice();
        $OrderModel->status = $order->getStatus();
        $OrderModel->payment_method = $order->getPaymentMethod();
        $OrderModel->save();
    }
}