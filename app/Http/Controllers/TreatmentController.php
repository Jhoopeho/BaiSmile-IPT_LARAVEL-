<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TreatmentController extends Controller
{
    public function index(): View
    {
        return view('treatments.index', ['treatments' => Treatment::with('appointment.patient', 'appointment.dentist')->orderByDesc('treated_at')->get()]);
    }

    public function create(Request $request): View
    {
        return view('treatments.create', $this->formData() + [
            'selectedAppointmentId' => $request->query('appointment_id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Treatment::create($request->validate($this->rules()));

        return to_route('treatments.index')->with('success', 'Treatment added successfully.');
    }

    public function show(Treatment $treatment): View
    {
        $treatment->load('appointment.patient', 'appointment.dentist', 'payments');

        return view('treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment): View
    {
        return view('treatments.edit', ['treatment' => $treatment] + $this->formData());
    }

    public function update(Request $request, Treatment $treatment): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $amountAlreadyPaid = (int) round((float) $treatment->payments()->sum('amount') * 100);
        $updatedCost = (int) round((float) $validated['cost'] * 100);

        if ($updatedCost < $amountAlreadyPaid) {
            return back()->withInput()->withErrors(['cost' => 'The treatment cost cannot be lower than payments already recorded.']);
        }

        $treatment->update($validated);

        return to_route('treatments.index')->with('success', 'Treatment updated successfully.');
    }

    public function destroy(Treatment $treatment): RedirectResponse
    {
        if ($treatment->payments()->exists()) {
            return to_route('treatments.index')->with('error', 'This treatment has payments and cannot be deleted.');
        }

        $treatment->delete();

        return to_route('treatments.index')->with('success', 'Treatment deleted successfully.');
    }

    private function formData(): array
    {
        return ['appointments' => Appointment::with('patient', 'dentist')->orderByDesc('appointment_date')->get()];
    }

    private function rules(): array
    {
        return [
            'appointment_id' => ['required', 'exists:appointments,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'cost' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
            'treated_at' => ['required', 'date'],
        ];
    }
}
