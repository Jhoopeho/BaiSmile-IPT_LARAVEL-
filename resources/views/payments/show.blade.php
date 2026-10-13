@extends('layouts.app')
@section('title', 'Payment details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><a href="{{ route('payments.index') }}" class="small text-decoration-none">← Payments</a><h1 class="h2 mt-2 mb-0">Payment details</h1></div><a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning">Edit payment</a></div>
<div class="card border-0 shadow-sm"><div class="card-header bg-white"><h2 class="h5 mb-0">Receipt information</h2></div><div class="card-body row g-3"><div class="col-md-6"><div class="small text-secondary">Patient</div>{{ $payment->treatment->appointment->patient->full_name }}</div><div class="col-md-6"><div class="small text-secondary">Treatment</div><a href="{{ route('treatments.show', $payment->treatment) }}">{{ $payment->treatment->name }}</a></div><div class="col-md-4"><div class="small text-secondary">Amount</div><span class="h4 text-success">₱{{ number_format((float) $payment->amount, 2) }}</span></div><div class="col-md-4"><div class="small text-secondary">Payment date</div>{{ $payment->payment_date->format('M j, Y') }}</div><div class="col-md-4"><div class="small text-secondary">Method / status</div>{{ $payment->method }} · {{ $payment->status }}</div></div></div>
@endsection

