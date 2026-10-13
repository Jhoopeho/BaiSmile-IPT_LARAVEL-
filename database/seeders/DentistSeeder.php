<?php

namespace Database\Seeders;

use App\Models\Dentist;
use Illuminate\Database\Seeder;

class DentistSeeder extends Seeder
{
    public function run(): void
    {
        if (! Dentist::query()->exists()) {
            Dentist::factory(4)->create();
        }
    }
}
