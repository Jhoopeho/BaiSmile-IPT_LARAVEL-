<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    private const STATUSES = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];

    public function index(): View
    {
        return view('appointments.index', ['appointments' => Appointment::with(['patient', 'dentist'])->orderByDesc('appointment_date')->get()]);
    }

    public function create(): View
    {
        return view('appointments.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        Appointment::create($request->validate($this->rules()));

        return to_route('appointments.index')->with('success', 'Appointment added successfully.');
    }

    public function show(Appointment $appointment): View
    {
        $appointment->load('patient', 'dentist', 'treatments.payments');

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment): View
    {
        return view('appointments.edit', ['appointment' => $appointment] + $this->formData());
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update($request->validate($this->rules()));

        return to_route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        if ($appointment->treatments()->exists()) {
            return to_route('appointments.index')->with('error', 'This appointment has treatments and cannot be deleted.');
        }

        $appointment->delete();

        return to_route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    private function formData(): array
    {
        return [
            'patients' => Patient::orderBy('full_name')->get(),
            'dentists' => Dentist::orderBy('name')->get(),
            'statuses' => self::STATUSES,
        ];
    }

    private function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:patients,id'],
            'dentist_id' => ['required', 'exists:dentists,id'],
            'appointment_date' => ['required', 'date'],
            'reason' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', Rule::in(self::STATUSES)],
        ];
    }
}
