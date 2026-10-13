<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('doctors') && ! Schema::hasTable('dentists')) {
            Schema::rename('doctors', 'dentists');
        } elseif (! Schema::hasTable('dentists')) {
            Schema::create('dentists', function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->string('specialization');
                $table->string('email')->unique();
                $table->string('phone');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
