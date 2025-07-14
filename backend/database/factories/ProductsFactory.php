<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Products::class;

    public function definition(): array
    {

        return [
            'id' => $this->faker->unique()->randomNumber(6),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['pizza', 'drink', 'dessert']),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'price' => $this->faker->randomFloat(2, 10),
            'image' => 'image.webp',
            'is_available' => $this->faker->boolean(),
        ];
    }
}
