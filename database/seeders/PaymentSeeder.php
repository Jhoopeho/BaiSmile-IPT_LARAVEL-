<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        if (Payment::query()->exists()) {
            return;
        }

        Treatment::all()->each(function (Treatment $treatment): void {
            $treatment->payments()->create([
                'amount' => $treatment->cost,
                'payment_date' => now()->toDateString(),
                'method' => 'Cash',
                'status' => 'Paid',
            ]);
        });
    }
}
