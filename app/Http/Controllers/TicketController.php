<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use App\Notifications\TicketReplyNotification;

class TicketController extends Controller
{
    // Display a listing of the tickets
    public function index(Request $request)
    {
        $query = Ticket::with('replies');

        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $tickets = $query->get();
        return view('tickets.index', compact('tickets'));
    }

    // Show the form for creating a new ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Store a newly created ticket in the database
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => auth()->id() // Assuming ticket is created by a logged-in user
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    }

    // Update the specified ticket in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
    }

    // Display the specified ticket
    public function show($id)
    {
        $ticket = Ticket::with('replies')->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    // Show the form for editing the specified ticket
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    // Add a reply to the ticket
    public function reply(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string']);

        $ticket = Ticket::findOrFail($id);

        TicketReply::create([
            'ticket_id' => $id,
            'reply' => $request->reply,
            'user_id' => auth()->id(),
        ]);

        // Send notification to the user who created the ticket
        $ticket->user->notify(new TicketReplyNotification($ticket));

        return redirect()->route('tickets.show', $id)->with('success', 'Reply added successfully.');
    }
}
