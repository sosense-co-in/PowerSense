@extends('layouts.app')

@section('content')
<h1>Tickets</h1>
<a href="{{ route('tickets.create') }}" class="btn btn-primary">Create Ticket</a>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Customer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{ $ticket->title }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->customer->name }}</td>
            <td>
                <a href="{{ route('tickets.show', $ticket) }}">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
