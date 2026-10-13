<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Treatment;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'patientCount' => Patient::count(),
            'dentistCount' => Dentist::count(),
            'appointmentCount' => Appointment::count(),
            'treatmentCount' => Treatment::count(),
            'paymentTotal' => Payment::where('status', 'Paid')->sum('amount'),
            'upcomingAppointments' => Appointment::with('patient', 'dentist')
                ->where('appointment_date', '>=', now())
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->orderBy('appointment_date')
                ->take(6)
                ->get(),
        ]);
    }
}
