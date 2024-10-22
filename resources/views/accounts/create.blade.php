@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Account</h1>

    <form action="{{ route('account.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Account Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" name="website" class="form-control">
        </div>

        <div class="form-group">
            <label for="type">Account Type</label>
            <input type="text" name="type" class="form-control">
        </div>

        <div class="form-group">
            <label for="industry">Industry</label>
            <input type="text" name="industry" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
</div>
@endsection
