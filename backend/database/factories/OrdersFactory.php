<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Orders;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Orders::class;
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->word(),
            'name' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(11),
            'address' => $this->faker->word(),
            'total_price' => $this->faker->randomFloat(2,8),
            'status' => $this->faker->randomElement(['pending', 'processing', 'out_for_delivery', 'cancelled']),
            'payment_method' => $this->faker->word(),
        ];
    }
}
