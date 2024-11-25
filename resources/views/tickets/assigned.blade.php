@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Assigned Tickets</h2>
                    </div>
                    <div class="card-body">
                        @include('utils.alerts')

                        @if ($tickets->isEmpty())
                            <p>No tickets assigned to you.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Category</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>{{ $ticket->category ? $ticket->category->name : 'N/A' }}</td>
                                            <td>{{ $ticket->priority ? $ticket->priority->name : 'N/A' }}</td>
                                            <td>{{ $ticket->status ? $ticket->status->name : 'N/A' }}</td>
                                            <td>{{ $ticket->user ? $ticket->user->name : 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
