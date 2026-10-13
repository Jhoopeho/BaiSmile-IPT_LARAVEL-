@extends('layouts.app')
@section('title', 'Add treatment')
@section('content')
<div class="row justify-content-center"><div class="col-lg-9"><div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h1 class="h4 mb-0">Record treatment</h1></div><div class="card-body p-4">
    @include('shared.errors')
    @if($appointments->isEmpty())<div class="alert alert-warning">Schedule an appointment before recording a treatment.</div>@endif
    <form action="{{ route('treatments.store') }}" method="POST">@csrf @include('treatments._form')<div class="d-flex gap-2 mt-4"><button class="btn btn-primary" @disabled($appointments->isEmpty())>Save treatment</button><a href="{{ route('treatments.index') }}" class="btn btn-outline-secondary">Cancel</a></div></form>
</div></div></div></div>
@endsection

