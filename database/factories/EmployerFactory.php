<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => fake()->company(),
        'user_id' => User::firstOrCreate([
            'email' => fake()->unique()->email,
        ], [
            'name' => fake()->name,
            'password' => Hash::make('secret'),
        ])->id,
    ];
}
}