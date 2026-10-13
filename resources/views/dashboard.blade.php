@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4"><div><p class="text-primary fw-semibold text-uppercase small mb-1">Clinic overview</p><h1 class="h2 mb-1">Welcome to BaiSmile</h1><p class="text-secondary mb-0">Manage your patients, care team, appointments, treatments, and payments.</p></div><a href="{{ route('appointments.create') }}" class="btn btn-primary">+ New appointment</a></div>
<div class="row g-3 mb-4">
    @foreach([['Patients', $patientCount, 'patients.index', 'Registered patients'], ['Dentists', $dentistCount, 'dentists.index', 'Care team members'], ['Appointments', $appointmentCount, 'appointments.index', 'All clinic visits'], ['Treatments', $treatmentCount, 'treatments.index', 'Recorded procedures']] as [$label, $count, $route, $hint])
        <div class="col-12 col-sm-6 col-xl-3"><a href="{{ route($route) }}" class="text-decoration-none text-reset"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="small text-secondary">{{ $label }}</div><div class="display-6 fw-semibold text-primary">{{ $count }}</div><div class="small text-secondary">{{ $hint }}</div></div></div></a></div>
    @endforeach
    <div class="col-12 col-sm-6 col-xl-3"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="small text-secondary">Payments received</div><div class="h2 fw-semibold text-success mt-2">₱{{ number_format((float) $paymentTotal, 2) }}</div><a href="{{ route('payments.index') }}" class="small">View payments</a></div></div></div>
</div>
<div class="card border-0 shadow-sm"><div class="card-header bg-white d-flex justify-content-between align-items-center py-3"><h2 class="h5 mb-0">Upcoming appointments</h2><a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">All appointments</a></div><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>Patient</th><th>Dentist</th><th>Date and time</th><th>Status</th><th></th></tr></thead><tbody>
    @forelse($upcomingAppointments as $appointment)<tr><td>{{ $appointment->patient->full_name }}</td><td>{{ $appointment->dentist->name }}</td><td>{{ $appointment->appointment_date->format('M j, Y · g:i A') }}</td><td><span class="badge text-bg-info">{{ $appointment->status }}</span></td><td><a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-outline-secondary">Details</a></td></tr>@empty<tr><td colspan="5" class="text-center text-secondary py-4">No upcoming appointments scheduled.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
