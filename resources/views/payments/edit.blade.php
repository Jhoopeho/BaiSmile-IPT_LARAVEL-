@extends('layouts.app')
@section('title', 'Edit payment')
@section('content')
<div class="row justify-content-center"><div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h1 class="h4 mb-0">Edit payment</h1></div><div class="card-body p-4">
    @include('shared.errors')
    <form action="{{ route('payments.update', $payment) }}" method="POST">@csrf @method('PUT') @include('payments._form')<div class="d-flex gap-2 mt-4"><button class="btn btn-primary">Update payment</button><a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">Cancel</a></div></form>
</div></div></div></div>
@endsection

