@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Accounts</h1>
    <a href="{{ route('account.create') }}" class="btn btn-primary">Create New Account</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->name }}</td>
                <td>{{ $account->email }}</td>
                <td>{{ $account->phone }}</td>
                <td>
                    <a href="{{ route('account.show', $account->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('account.edit', $account->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('account.destroy', $account->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
