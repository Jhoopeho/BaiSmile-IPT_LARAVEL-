<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(): View
    {
        return view('patients.index', ['patients' => Patient::withCount('appointments')->orderBy('full_name')->get()]);
    }

    public function create(): View
    {
        return view('patients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Patient::create($request->validate($this->rules()));

        return to_route('patients.index')->with('success', 'Patient added successfully.');
    }

    public function show(Patient $patient): View
    {
        $patient->load('appointments.dentist', 'appointments.treatments');

        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient): View
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $patient->update($request->validate($this->rules($patient)));

        return to_route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        if ($patient->appointments()->exists()) {
            return to_route('patients.index')->with('error', 'This patient has appointments and cannot be deleted.');
        }

        $patient->delete();

        return to_route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    private function rules(?Patient $patient = null): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'patient_number' => ['nullable', 'string', 'max:255', Rule::unique('patients', 'patient_number')->ignore($patient)],
            'date_of_birth' => ['nullable', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', Rule::in(['Female', 'Male', 'Other', 'Prefer not to say'])],
            'contact_number' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('patients', 'email')->ignore($patient)],
            'address' => ['nullable', 'string', 'max:1000'],
            'medical_history' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
