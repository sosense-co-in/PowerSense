@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contacts</h1>
    <a href="{{ route('contact.create') }}" class="btn btn-primary">Add New Contact</a>

    @if (session('flash_message'))
        <div class="alert alert-success">{{ session('flash_message') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Account</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->account ? $contact->account->name : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
