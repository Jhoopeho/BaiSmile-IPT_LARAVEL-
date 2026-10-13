@extends('layouts.app')
@section('title', 'Add appointment')
@section('content')
<div class="row justify-content-center"><div class="col-lg-9"><div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h1 class="h4 mb-0">Schedule appointment</h1></div><div class="card-body p-4">
    @include('shared.errors')
    @if($patients->isEmpty() || $dentists->isEmpty())<div class="alert alert-warning">Add at least one patient and one dentist before scheduling an appointment.</div>@endif
    <form action="{{ route('appointments.store') }}" method="POST">@csrf @include('appointments._form')<div class="d-flex gap-2 mt-4"><button class="btn btn-primary" @disabled($patients->isEmpty() || $dentists->isEmpty())>Save appointment</button><a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">Cancel</a></div></form>
</div></div></div></div>
@endsection

