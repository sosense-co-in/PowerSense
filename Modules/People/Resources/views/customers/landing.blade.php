@extends('layouts.app')

@section('title', 'Welcome, Customer!')

@section('content')
<div class="container">
    <div class="text-center my-5">
        <h1>Welcome to Our Service</h1>
        <p class="lead">Explore our offerings and stay updated with your account activities.</p>
        <a href="{{ route('tickets.index') }}" class="btn btn-primary">View Your Tickets</a>
        <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">Explore Services</a>
    </div>
</div>
@endsection
