<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Treatment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PaymentController extends Controller
{
    private const METHODS = ['Cash', 'Card', 'Bank transfer', 'Insurance'];

    private const STATUSES = ['Paid', 'Partial', 'Pending'];

    public function index(): View
    {
        return view('payments.index', ['payments' => Payment::with('treatment.appointment.patient')->orderByDesc('payment_date')->get()]);
    }

    public function create(Request $request): View
    {
        return view('payments.create', $this->formData() + [
            'selectedTreatmentId' => $request->query('treatment_id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $treatment = Treatment::findOrFail($validated['treatment_id']);

        if ($this->wouldExceedBalance($treatment, (float) $validated['amount'])) {
            return back()->withInput()->withErrors(['amount' => 'The payment cannot exceed the remaining treatment balance.']);
        }

        Payment::create($validated);

        return to_route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment): View
    {
        $payment->load('treatment.appointment.patient', 'treatment.appointment.dentist');

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment): View
    {
        return view('payments.edit', ['payment' => $payment] + $this->formData());
    }

    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $treatment = Treatment::findOrFail($validated['treatment_id']);

        if ($this->wouldExceedBalance($treatment, (float) $validated['amount'], $payment)) {
            return back()->withInput()->withErrors(['amount' => 'The payment cannot exceed the remaining treatment balance.']);
        }

        $payment->update($validated);

        return to_route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return to_route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    private function formData(): array
    {
        return [
            'treatments' => Treatment::with('appointment.patient')->orderByDesc('treated_at')->get(),
            'methods' => self::METHODS,
            'statuses' => self::STATUSES,
        ];
    }

    private function rules(): array
    {
        return [
            'treatment_id' => ['required', 'exists:treatments,id'],
            'amount' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
            'payment_date' => ['required', 'date'],
            'method' => ['required', Rule::in(self::METHODS)],
            'status' => ['required', Rule::in(self::STATUSES)],
        ];
    }

    private function wouldExceedBalance(Treatment $treatment, float $amount, ?Payment $ignore = null): bool
    {
        $payments = $treatment->payments();

        if ($ignore !== null) {
            $payments->where('id', '!=', $ignore->id);
        }

        $alreadyPaid = (int) round((float) $payments->sum('amount') * 100);
        $newAmount = (int) round($amount * 100);
        $treatmentCost = (int) round((float) $treatment->cost * 100);

        return $alreadyPaid + $newAmount > $treatmentCost;
    }
}
