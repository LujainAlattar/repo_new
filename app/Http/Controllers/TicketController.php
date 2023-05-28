<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


            $status = $request->query('status');
            $priority = $request->query('priority');

            $tickets = Ticket::when($status, function ($query, $status) {
                return $query->where('status', $status);
            })->when($priority, function ($query, $priority) {
                return $query->where('priority', $priority);
            })->paginate(5);

            return view('ticket.index', compact('tickets'));

        // $tickets = Ticket::latest()->paginate(5);
        // return view('ticket.index', compact('tickets'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();

        return view('ticket.create', compact('agents'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'priority' => 'nullable|in:low,medium,high', // Allow null or one of the specified values
            'status' => 'nullable|in:open,closed', // Allow null or either open or closed
            'agent_id' => 'nullable|exists:agents,id',
        ]);

        // Set default values if priority or status is not provided in the request
        $priority = $request->input('priority', 'low');
        $status = $request->input('status', 'open');

        // Create the new ticket
        $ticket = new Ticket;
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $priority;
        $ticket->status = $status;
        $ticket->user_id = Auth::id(); // Set the user_id from the currently logged-in user

        if (!empty($request->agent_id)) {
            $ticket->agent_id = $request->agent_id;
        } else {
            $ticket->agent_id = null; // Set agent_id to null if not provided
        }


        $ticket->save();

        return redirect()->route('ticket.index')->with('success', 'Ticket Created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agents = Agent::all(); // Fetch all agents from the database
        $users = User::all();
        $ticket = Ticket::find($id);
        return view('ticket.edit', compact('ticket', 'agents', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,closed',
            'agent_id' => 'nullable|exists:agents,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Find the ticket by its ID
        $ticket = Ticket::find($id);

        // Update the ticket attributes
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;

        // Check if agent_id is provided in the request and update it accordingly
        if (!empty($request->agent_id)) {
            $ticket->agent_id = $request->agent_id;
        } else {
            $ticket->agent_id = null; // Set agent_id to null if not provided
        }

        // Save the updated ticket
        $ticket->save();

        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        // Find the user by ID
        $ticket = Ticket::findOrFail($id);

        // Delete the user
        $ticket->delete();

        // Redirect to the index page with success message
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully');
    }
}
