<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        if (Appointment::query()->exists()) {
            return;
        }

        $patients = Patient::all();
        $dentists = Dentist::all();

        foreach (range(0, 11) as $index) {
            $status = ['Confirmed', 'Pending', 'Completed', 'Completed'][$index % 4];

            Appointment::factory()->create([
                'patient_id' => $patients[$index % $patients->count()]->id,
                'dentist_id' => $dentists[$index % $dentists->count()]->id,
                'appointment_date' => $status === 'Completed' ? now()->subDays($index + 1) : now()->addDays($index + 1),
                'status' => $status,
            ]);
        }
    }
}
