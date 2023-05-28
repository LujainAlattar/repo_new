<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\DB;


class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::where('role_id', 3)->latest()->paginate(5);
        return view('agent.index', compact('agents'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('agent.create', compact('roles'));
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
             'name' => 'required',
             'salary' => 'required',
             'position' => 'required',
             'email' => 'required|email|unique:agents,email',
             'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'], // Password must contain at least one lowercase letter, one uppercase letter, and one digit
         ]);

         try {
             DB::beginTransaction();

             $agent = new Agent;
             $agent->name = $request->input('name');
             $agent->salary = $request->input('salary');
             $agent->position = $request->input('position');
             $agent->email = $request->input('email');
             $agent->password = bcrypt($request->input('password'));
             $agent->role_id = 3; // Set the default role_id to 3
             $agent->save();

             $user = new User;
             $user->name = $request->input('name');
             $user->email = $request->input('email');
             $user->password = bcrypt($request->input('password'));
             $user->role_id = 3; // Set the role_id to 3
             $user->save();

             DB::commit();

             return redirect()->route('agent.index')->with('success', 'Agent created successfully.');
         } catch (\Exception $e) {
             DB::rollback();

             // Handle the exception, return an error response, or redirect to an error page
         }
     }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = Agent::find($id);
        return view('agent.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        return view('agent.edit', compact('agent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:agents,email,'.$id,
            'password' => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'], // Password must contain at least one lowercase letter, one uppercase letter, and one digit
        ]);

        $agent = Agent::findOrFail($id);
        $agent->name = $request->input('name');
        $agent->salary = $request->input('salary');
        $agent->position = $request->input('position');
        $agent->email = $request->input('email');
        if ($request->has('password')) {
            $agent->password = bcrypt($request->input('password'));
        }
        $agent->update();

        return redirect()->route('agent.index')->with('success', 'Agent updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        // Find the user by ID
        $agent = Agent::findOrFail($id);

        // Delete the user
        $agent->delete();

        // Redirect to the index page with success message
        return redirect()->route('agent.index')->with('success', 'Agent deleted successfully');
    }
}
