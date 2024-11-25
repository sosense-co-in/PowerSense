@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h2 class="mb-0">Tickets</h2>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary float-right">Create Ticket</a>
                    </div>
                    <div class="card-body">
                        @include('utils.alerts')

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Category</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Agent</th>
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
                                        <td>{{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $tickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
