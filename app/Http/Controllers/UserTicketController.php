<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)->get();

        return view('user.u_tickets', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tickets = Ticket::all();

        return view('user.hello', compact('tickets'));
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
            'priority' => 'nullable|in:low,medium,high',
            'status' => 'nullable|in:open,closed',
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

        $ticket->save();

        $user = Auth::user();
        $tickets = $user->tickets;


        return view('user.u_tickets', compact('tickets'))->with('success', 'Ticket created successfully.');

    }

// ...

public function uTickets()
{
    $user = Auth::user();
    $tickets = $user->tickets;

    return view('user.u_tickets', compact('tickets'));
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
