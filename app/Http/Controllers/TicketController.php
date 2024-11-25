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

    public function edit(Ticket $ticket)
    {
        $categories = TktCategory::all();
        $priorities = Priority::all();
        $statuses = Status::all();
        $agents = User::where('role', 'service_engineer')->get();

        return view('tickets.edit', compact('ticket', 'categories', 'priorities', 'statuses', 'agents'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'tkt_category_id' => 'required|exists:tkt_categories,id',
            'status_id' => 'required|exists:statuses,id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    public function indexComplete()
    {
        $tickets = Ticket::with(['priority', 'status', 'category', 'agent'])
            ->where('status_id', Status::where('name', 'Completed')->first()->id)
            ->latest()
            ->get();

        return view('tickets.completed', compact('tickets'));
    }
    public function assigned()
    {
        $this->authorize('view_assigned_tickets');

        $tickets = Ticket::with(['priority', 'status', 'category', 'agent'])
            ->where('agent_id', auth()->id())
            ->get();

        return view('tickets.assigned', compact('tickets'));
    }

    public function editStatus(Ticket $ticket)
    {
        return view('tickets.edit-status', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in-progress,closed',
        ]);

        $ticket->update(['status' => $request->status]);

        return redirect()->route('tickets.index')->with('success', 'Ticket status updated successfully.');
    }
}
