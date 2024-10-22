@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $contact->name }}</h5>
            <p class="card-text">Email: {{ $contact->email }}</p>
            <p class="card-text">Phone: {{ $contact->phone }}</p>
            <p class="card-text">Account: {{ $contact->account ? $contact->account->name : 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    <a href="{{ route('contact.index') }}" class="btn btn-secondary">Back to Contacts</a>
</div>
@endsection
