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
        if (Schema::hasColumn('patients', 'student_id')) {
            Schema::table('patients', function (Blueprint $table): void {
                $table->renameColumn('student_id', 'patient_number');
                $table->renameColumn('name', 'full_name');
            });
        }

        Schema::table('patients', function (Blueprint $table): void {
            if (! Schema::hasColumn('patients', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (! Schema::hasColumn('patients', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (! Schema::hasColumn('patients', 'contact_number')) {
                $table->string('contact_number')->default('');
            }
            if (! Schema::hasColumn('patients', 'email')) {
                $table->string('email')->nullable()->unique();
            }
            if (! Schema::hasColumn('patients', 'address')) {
                $table->text('address')->nullable();
            }
            if (! Schema::hasColumn('patients', 'medical_history')) {
                $table->text('medical_history')->nullable();
            }
        });

        if (Schema::hasColumn('appointments', 'doctor_id')) {
            Schema::table('appointments', function (Blueprint $table): void {
                $table->renameColumn('doctor_id', 'dentist_id');
            });
        }

        Schema::table('appointments', function (Blueprint $table): void {
            if (! Schema::hasColumn('appointments', 'reason')) {
                $table->text('reason')->nullable();
            }
            if (Schema::hasColumn('appointments', 'appointment_date')) {
                $table->dateTime('appointment_date')->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('appointments', 'dentist_id')) {
            Schema::table('appointments', function (Blueprint $table): void {
                $table->renameColumn('dentist_id', 'doctor_id');
            });
        }

        if (Schema::hasColumn('patients', 'patient_number')) {
            Schema::table('patients', function (Blueprint $table): void {
                $table->renameColumn('patient_number', 'student_id');
                $table->renameColumn('full_name', 'name');
            });
        }
    }
};
