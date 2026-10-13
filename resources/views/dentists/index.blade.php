@extends('layouts.app')
@section('title', 'Dentists')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4"><div><h1 class="h2 mb-1">Dentists</h1><p class="text-secondary mb-0">Manage your dental care team and specialties.</p></div><a href="{{ route('dentists.create') }}" class="btn btn-primary">+ Add dentist</a></div>
<div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>Dentist</th><th>Specialization</th><th>Contact</th><th>Appointments</th><th class="text-end">Actions</th></tr></thead><tbody>
    @forelse($dentists as $dentist)<tr><td><a href="{{ route('dentists.show', $dentist) }}" class="fw-semibold text-decoration-none">{{ $dentist->name }}</a></td><td>{{ $dentist->specialization }}</td><td>{{ $dentist->email }}<div class="small text-secondary">{{ $dentist->phone }}</div></td><td>{{ $dentist->appointments_count }}</td><td class="text-end text-nowrap"><a href="{{ route('dentists.edit', $dentist) }}" class="btn btn-warning btn-sm">Edit</a> <form action="{{ route('dentists.destroy', $dentist) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" onclick="return confirm('Delete this dentist? Dentists with appointments cannot be deleted.')">Delete</button></form></td></tr>@empty<tr><td colspan="5" class="text-center text-secondary py-5">No dentists yet. Add a dentist to your care team.</td></tr>@endforelse
</tbody></table></div></div>
@endsection

