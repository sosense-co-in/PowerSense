<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TktCategory;
use App\Models\Priority;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['priority', 'status', 'category', 'agent'])
            ->latest()
            ->paginate(10); // Paginate the results
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TktCategory::all();
        $priorities = Priority::all();
        $statuses = Status::all();

        $agents = User::where('role', 'service_engineer')->get();

        return view('tickets.create', compact('categories', 'priorities', 'statuses', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'tkt_category_id' => 'required|exists:tkt_categories,id', // Ensure using tkt_categories
            'status_id' => 'required|exists:statuses,id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        $validated['user_id'] = auth()->id(); // Store the authenticated user ID

        Ticket::create($validated); // Create a new ticket record

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // Load relationships to avoid N+1 query problem
        $ticket->load(['priority', 'status', 'category', 'agent']);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // Fetch necessary data for editing the ticket
        $categories = TktCategory::all(); // Fetching from tkt_categories table
        $priorities = Priority::all();
        $statuses = Status::all();
        $agents = User::where('role', 'service_engineer')->get();

        return view('tickets.edit', compact('ticket', 'categories', 'priorities', 'statuses', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'tkt_category_id' => 'required|exists:tkt_categories,id', // Ensure using tkt_categories
            'status_id' => 'required|exists:statuses,id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        $ticket->update($validated); // Update the ticket with validated data

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete(); // Delete the ticket

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    /**
     * Display completed tickets.
     */
    public function indexComplete()
    {
        // Fetch all tickets with 'Completed' status
        $tickets = Ticket::with(['priority', 'status', 'category', 'agent'])
            ->where('status_id', Status::where('name', 'Completed')->first()->id)
            ->latest()
            ->get();

        return view('tickets.completed', compact('tickets'));
    }
}
