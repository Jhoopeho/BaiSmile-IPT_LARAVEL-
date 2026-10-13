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
        if (Schema::hasColumn('patients', 'course')) {
            Schema::table('patients', function (Blueprint $table): void {
                $table->string('course')->nullable()->change();
            });
        }

        if (Schema::hasColumn('patients', 'year_level')) {
            Schema::table('patients', function (Blueprint $table): void {
                $table->integer('year_level')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
