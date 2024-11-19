<?php

namespace Modules\Ticket\Http\Controllers;

use Modules\Ticket\Entities\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $tickets = Ticket::with(['customer', 'assignee'])->get();
        return view('ticket::index', compact('tickets'));
    }

    public function create() {
        return view('ticket::create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'customer_id' => auth()->id(),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket) {
        return view('ticket::show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket) {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }
}
