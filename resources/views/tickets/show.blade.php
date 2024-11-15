@extends('layouts.app')

@section('content')
    <div class="container bg-white">
        <h1>{{ $ticket->subject }}</h1>
        <p><strong>Description:</strong></p>
        <p>{{ $ticket->description }}</p>
        <p><strong>Created At:</strong> {{ $ticket->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $ticket->updated_at }}</p>

        <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back to Tickets</a>
        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning">Edit Ticket</a>

        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Ticket</button>
        </form>
    </div>
@endsection
