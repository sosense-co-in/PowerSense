@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit AMC Contract</h1>

    <form action="{{ route('amc-contracts.update', $contract->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Reference Number -->
        <div class="form-group">
            <label for="ref_no">Reference No</label>
            <input type="text" name="ref_no" class="form-control" value="{{ $contract->ref_no }}" readonly>
        </div>

        <!-- Contract Type -->
        <div class="form-group">
            <label for="type">Contract Type</label>
            <select name="type" class="form-control">
                <option value="comp" {{ $contract->type == 'Comprehensive' ? 'selected' : '' }}>Comprehensive</option>
                <option value="non-comp" {{ $contract->type == 'Non Comprehensive' ? 'selected' : '' }}>Non Comprehensive</option>
            </select>
        </div>

        <!-- Contract Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $contract->location }}">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Contract</button>
    </form>
</div>
@endsection
