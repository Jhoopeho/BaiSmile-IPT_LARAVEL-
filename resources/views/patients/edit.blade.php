@extends('layouts.app')
@section('title', 'Edit patient')
@section('content')
<div class="row justify-content-center"><div class="col-lg-9"><div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h1 class="h4 mb-0">Edit patient</h1></div><div class="card-body p-4">
    @include('shared.errors')
    <form action="{{ route('patients.update', $patient) }}" method="POST">@csrf @method('PUT') @include('patients._form')<div class="d-flex gap-2 mt-4"><button class="btn btn-primary">Update patient</button><a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Cancel</a></div></form>
</div></div></div></div>
@endsection

