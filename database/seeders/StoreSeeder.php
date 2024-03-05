<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'name' => fake()->company(),
            'slug' => fake()->unique()->slug(),
            'code' => fake()->unique()->slug(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'country' => fake()->country(),
            'postal_code' => fake()->postcode(),
            'image' => fake()->imageUrl(),
            'is_active' => fake()->boolean(),
        ]);
    }
}
