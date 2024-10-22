@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Contact</h1>

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="form-group">
            <label for="account_id">Account</label>
            <select name="account_id" class="form-control">
                <option value="">Select Account</option>
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Contact</button>
    </form>
</div>
@endsection
