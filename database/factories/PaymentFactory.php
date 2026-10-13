<?php

namespace Database\Factories;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'treatment_id' => Treatment::factory(),
            'amount' => fake()->randomFloat(2, 50, 500),
            'payment_date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'method' => fake()->randomElement(['Cash', 'Card', 'Bank transfer', 'Insurance']),
            'status' => fake()->randomElement(['Paid', 'Partial', 'Pending']),
        ];
    }
}
