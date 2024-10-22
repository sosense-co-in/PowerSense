@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $account->name }}</h1>

    <p><strong>Email:</strong> {{ $account->email }}</p>
    <p><strong>Phone:</strong> {{ $account->phone }}</p>
    <p><strong>Website:</strong> {{ $account->website }}</p>
    <p><strong>Type:</strong> {{ $account->type }}</p>
    <p><strong>Industry:</strong> {{ $account->industry }}</p>

    <a href="{{ route('account.edit', $account->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('account.destroy', $account->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('account.index') }}" class="btn btn-secondary">Back to Accounts</a>
</div>
@endsection
