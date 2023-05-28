<?php

namespace App\Http\Controllers;

use App\Models\Appointment; // Import the Appointment model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Retrieve the user ID from the session
        $userId = session('user_id');

        // Create the appointment and associate it with the user ID
        Appointment::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $appointment->update($validatedData);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
