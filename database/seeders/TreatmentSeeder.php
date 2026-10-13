<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        if (Treatment::query()->exists()) {
            return;
        }

        Appointment::where('status', 'Completed')->get()->each(function (Appointment $appointment): void {
            Treatment::factory()->create([
                'appointment_id' => $appointment->id,
                'treated_at' => min($appointment->appointment_date->toDateString(), now()->toDateString()),
            ]);
        });
    }
}
