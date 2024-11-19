@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Customer Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $customer->customer_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $customer->customer_email }}</p>
            <p class="card-text"><strong>Phone:</strong> {{ $customer->customer_phone }}</p>
            <p class="card-text"><strong>City:</strong> {{ $customer->city }}</p>
            <p class="card-text"><strong>Country:</strong> {{ $customer->country }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $customer->address }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
