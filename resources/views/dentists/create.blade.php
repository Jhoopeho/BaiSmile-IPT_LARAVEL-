@extends('layouts.app')
@section('title', 'Add dentist')
@section('content')
<div class="row justify-content-center"><div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h1 class="h4 mb-0">Add dentist</h1></div><div class="card-body p-4">
    @include('shared.errors')
    <form action="{{ route('dentists.store') }}" method="POST">@csrf @include('dentists._form')<div class="d-flex gap-2 mt-4"><button class="btn btn-primary">Save dentist</button><a href="{{ route('dentists.index') }}" class="btn btn-outline-secondary">Cancel</a></div></form>
</div></div></div></div>
@endsection

