<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'patient_number' => strtoupper(fake()->unique()->bothify('PT-####')),
            'full_name' => fake()->name(),
            'date_of_birth' => fake()->dateTimeBetween('-75 years', '-5 years')->format('Y-m-d'),
            'gender' => fake()->randomElement(['Female', 'Male', 'Other']),
            'contact_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'medical_history' => fake()->optional(0.35)->randomElement([
                'Reports sensitivity to cold in a lower-left molar; no known medication allergies.',
                'Reports penicillin allergy (rash); takes lisinopril for hypertension.',
                'Reports asthma and uses a rescue inhaler as needed; no known medication allergies.',
                'Reports type 2 diabetes and takes metformin; no known medication allergies.',
                'Reports latex allergy (skin irritation); no chronic conditions reported.',
                'Reports seasonal allergies and takes cetirizine as needed.',
            ]),
        ];
    }
}
