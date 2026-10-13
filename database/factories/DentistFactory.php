<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DentistFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'specialization' => fake()->randomElement(['General Dentistry', 'Orthodontics', 'Endodontics', 'Oral Surgery', 'Pediatric Dentistry']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
