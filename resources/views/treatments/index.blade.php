@extends('layouts.app')
@section('title', 'Treatments')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4"><div><h1 class="h2 mb-1">Treatments</h1><p class="text-secondary mb-0">Procedures recorded for patient visits.</p></div><a href="{{ route('treatments.create') }}" class="btn btn-primary">+ Record treatment</a></div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>Treatment</th><th>Patient</th><th>Dentist</th><th>Date</th><th>Cost</th><th>Paid</th><th class="text-end">Actions</th></tr></thead><tbody>
    @forelse($treatments as $treatment)<tr><td><a href="{{ route('treatments.show', $treatment) }}" class="fw-semibold text-decoration-none">{{ $treatment->name }}</a></td><td>{{ $treatment->appointment->patient->full_name }}</td><td>{{ $treatment->appointment->dentist->name }}</td><td>{{ $treatment->treated_at->format('M j, Y') }}</td><td>₱{{ number_format((float) $treatment->cost, 2) }}</td><td>₱{{ number_format((float) $treatment->payments->sum('amount'), 2) }}</td><td class="text-end text-nowrap"><a href="{{ route('treatments.edit', $treatment) }}" class="btn btn-warning btn-sm">Edit</a> <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" onclick="return confirm('Delete this treatment? Treatments with payments cannot be deleted.')">Delete</button></form></td></tr>@empty<tr><td colspan="7" class="text-center text-secondary py-5">No treatments recorded yet.</td></tr>@endforelse
</tbody></table></div></div>
@endsection

