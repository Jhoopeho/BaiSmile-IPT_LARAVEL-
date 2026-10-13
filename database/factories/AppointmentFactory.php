<?php

namespace Database\Factories;

use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'dentist_id' => Dentist::factory(),
            'appointment_date' => fake()->dateTimeBetween('-30 days', '+30 days'),
            'reason' => fake()->randomElement(['Routine check-up', 'Toothache', 'Cleaning', 'Consultation', 'Follow-up']),
            'status' => fake()->randomElement(['Pending', 'Confirmed', 'Completed', 'Cancelled']),
        ];
    }
}
