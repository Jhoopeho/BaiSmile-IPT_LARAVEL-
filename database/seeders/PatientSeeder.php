<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        if (! Patient::query()->exists()) {
            Patient::factory(12)->create();
        }
    }
}
