@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create Ticket</a>

        <!-- Display success messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>
                            @if ($ticket->status == 'open')
                                <span class="badge bg-success">Open</span>
                            @elseif ($ticket->status == 'in_progress')
                                <span class="badge bg-warning">In Progress</span>
                            @else
                                <span class="badge bg-danger">Closed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No tickets available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
