<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $table = User::class;
    public function definition(): array
    {
        return [
            'uId' => $this->faker->word(),
            'name' => $this->faker->word(),
            'phone_number' => $this->faker->word(),
            'city' => $this->faker->word(),
            'barangay' => $this->faker->word(),
            'purok' => $this->faker->word(),
            'email' => $this->faker->unique()->email(),
            'password' => $this->faker->password(),
            'image' => 'image.webp',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
