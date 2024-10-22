@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Account</h1>

    <form action="{{ route('account.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Account Name</label>
            <input type="text" name="name" class="form-control" value="{{ $account->name }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $account->phone }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $account->email }}">
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" value="{{ $account->website }}">
        </div>

        <div class="form-group">
            <label for="type">Account Type</label>
            <input type="text" name="type" class="form-control" value="{{ $account->type }}">
        </div>

        <div class="form-group">
            <label for="industry">Industry</label>
            <input type="text" name="industry" class="form-control" value="{{ $account->industry }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Account</button>
    </form>
</div>
@endsection
