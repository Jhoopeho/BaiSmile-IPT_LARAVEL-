<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientAppointmentCrudTest extends TestCase
{
    use RefreshDatabase;

    private function patientData(array $overrides = []): array
    {
        return array_merge([
            'student_id' => '2024-0001',
            'name' => 'Juan Dela Cruz',
            'course' => 'BSIT',
            'year_level' => 2,
        ], $overrides);
    }

    public function test_patient_pages_load(): void
    {
        $patient = Patient::create($this->patientData());

        $this->get(route('patients.index'))->assertOk()->assertSee('Juan Dela Cruz');
        $this->get(route('patients.create'))->assertOk();
        $this->get(route('patients.edit', $patient))->assertOk()->assertSee('2024-0001');
    }

    public function test_patient_can_be_created_updated_and_deleted(): void
    {
        $this->post(route('patients.store'), $this->patientData())
            ->assertRedirect(route('patients.index'))
            ->assertSessionHas('success');
        $this->assertDatabaseHas('patients', ['student_id' => '2024-0001']);

        $patient = Patient::first();

        $this->put(route('patients.update', $patient), $this->patientData(['name' => 'Maria Santos']))
            ->assertRedirect(route('patients.index'));
        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'name' => 'Maria Santos']);

        $this->delete(route('patients.destroy', $patient))->assertRedirect(route('patients.index'));
        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
    }

    public function test_patient_validation_and_unique_student_id(): void
    {
        $this->post(route('patients.store'), [])
            ->assertSessionHasErrors(['student_id', 'name', 'course', 'year_level']);

        $existing = Patient::create($this->patientData());
        $this->post(route('patients.store'), $this->patientData())
            ->assertSessionHasErrors('student_id');

        // Updating a patient while keeping its own student_id must pass.
        $this->put(route('patients.update', $existing), $this->patientData(['course' => 'BSCS']))
            ->assertSessionHasNoErrors();
    }

    public function test_appointment_crud(): void
    {
        $patient = Patient::create($this->patientData());
        $doctor = Doctor::factory()->create();

        $this->get(route('appointments.create'))->assertOk();

        $payload = [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2026-11-01',
            'status' => 'Pending',
        ];

        $this->post(route('appointments.store'), $payload)
            ->assertRedirect(route('appointments.index'))
            ->assertSessionHas('success');

        $appointment = Appointment::first();
        $this->assertNotNull($appointment);

        $this->get(route('appointments.index'))
            ->assertOk()
            ->assertSee('Juan Dela Cruz')
            ->assertSee($doctor->name);
        $this->get(route('appointments.edit', $appointment))->assertOk();

        $this->put(route('appointments.update', $appointment), array_merge($payload, ['status' => 'Confirmed']))
            ->assertRedirect(route('appointments.index'));
        $this->assertDatabaseHas('appointments', ['id' => $appointment->id, 'status' => 'Confirmed']);

        $this->delete(route('appointments.destroy', $appointment))
            ->assertRedirect(route('appointments.index'));
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }

    public function test_appointment_validation(): void
    {
        $this->post(route('appointments.store'), [])
            ->assertSessionHasErrors(['patient_id', 'doctor_id', 'appointment_date', 'status']);

        $this->post(route('appointments.store'), [
            'patient_id' => 999,
            'doctor_id' => 999,
            'appointment_date' => '2026-11-01',
            'status' => 'Nonsense',
        ])->assertSessionHasErrors(['patient_id', 'doctor_id', 'status']);
    }
}
