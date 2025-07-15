<?php

namespace Tests\Feature;

use App\Models\Orders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    /**@test */
    public function test_create_a_order()
    {

        $data = [
            'user_id' => 'asd212379a8sd12e12',
            'name' => 'Christian Alicaba',
            'phone_number' => '09565376522',
            'address' => 'Liloan Cebu',
            'total_price' => 99.99,
            'status' => 'pending',
            'payment_method' => 'Cash on Delivery',
        ];

        $response = $this->postJson(route('order.store'), $data);
        $response->assertStatus(200);
    }
}
