<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'name' => fake()->randomElement(['Dental cleaning', 'Tooth filling', 'Tooth extraction', 'Root canal', 'Teeth whitening']),
            'description' => fake()->optional()->sentence(),
            'cost' => fake()->randomFloat(2, 500, 15000),
            'treated_at' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
        ];
    }
}
