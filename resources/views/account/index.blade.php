@extends('layouts.app')

@section('content')
<div class="container bg-white">
    <h1 class="mb-4">Accounts</h1>

    @include('utils.alerts')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Industry</th>
                    <th>Employees</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->phone }}</td>
                    <td>{{ $account->email }}</td>
                    <td>{{ $account->type }}</td>
                    <td>{{ $account->industry }}</td>
                    <td>{{ $account->no_of_emp }}</td>
                    <td>
                        <a href="{{ route('account.show', $account->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('account.edit', $account->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('account.destroy', $account->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
