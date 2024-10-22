@extends('layouts.app')

@section('content')
<div class="container">
    <h1>AMC Contracts</h1>
    <a href="{{ route('amc-contracts.create') }}" class="btn btn-primary">Create New Contract</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Reference No</th>
                <th>Type</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contracts as $contract)
                <tr>
                    <td>{{ $contract->ref_no }}</td>
                    <td>{{ $contract->type }}</td>
                    <td>{{ $contract->location }}</td>
                    <td>{{ $contract->status }}</td>
                    <td>
                        <a href="{{ route('amc-contracts.show', $contract->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('amc-contracts.edit', $contract->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('amc-contracts.destroy', $contract->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('amc-contracts.download', $contract->id) }}" class="btn btn-success">Download PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
