@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contract Details</h1>

    <p><strong>Reference No:</strong> {{ $contract->ref_no }}</p>
    <p><strong>Type:</strong> {{ $contract->type }}</p>
    <p><strong>Location:</strong> {{ $contract->location }}</p>
    <p><strong>Status:</strong> {{ $contract->status }}</p>

    <!-- More contract details -->

    <a href="{{ route('amc-contracts.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
