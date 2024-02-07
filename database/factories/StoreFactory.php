<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->unique()->slug(),
            'code' => $this->faker->unique()->slug(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
