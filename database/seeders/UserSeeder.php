<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => fake()->name(),
            'username' => fake()->name(),
            'email' => "admin@example.net",
            'email_verified_at' => now(),
            'store_id' => Store::first()->id,
            'uuid' => Str::uuid(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        UserStore::create([
            'user_id' => $user->id,
            'store_id' => Store::first()->id,
        ]);
    }
}
