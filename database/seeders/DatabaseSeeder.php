<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PatientSeeder::class,
            DentistSeeder::class,
            AppointmentSeeder::class,
            TreatmentSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
