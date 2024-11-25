@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h2 class="mb-0">Ticket Details</h2>
                    </div>
                    <div class="card-body">
                        @include('utils.alerts')

                        <div class="mb-4">
                            <h5><strong>Subject:</strong> {{ $ticket->subject }}</h5>
                            <p><strong>Category:</strong> {{ $ticket->category ? $ticket->category->name : 'N/A' }}</p>
                            <p><strong>Priority:</strong> {{ $ticket->priority ? $ticket->priority->name : 'N/A' }}</p>
                            <p><strong>Status:</strong> {{ $ticket->status ? $ticket->status->name : 'N/A' }}</p>
                            <p><strong>Assigned Agent:</strong> {{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</p>
                        </div>

                        <div class="mb-4">
                            <h5><strong>Ticket Content:</strong></h5>
                            <p>{{ $ticket->content }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary ml-2">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
