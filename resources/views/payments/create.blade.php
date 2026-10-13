@extends('layouts.app')
@section('title', 'Record payment')
@section('content')
<div class="row justify-content-center"><div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h1 class="h4 mb-0">Record payment</h1></div><div class="card-body p-4">
    @include('shared.errors')
    @if($treatments->isEmpty())<div class="alert alert-warning">Record a treatment before accepting a payment.</div>@endif
    <form action="{{ route('payments.store') }}" method="POST">@csrf @include('payments._form')<div class="d-flex gap-2 mt-4"><button class="btn btn-primary" @disabled($treatments->isEmpty())>Save payment</button><a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Cancel</a></div></form>
</div></div></div></div>
@endsection

