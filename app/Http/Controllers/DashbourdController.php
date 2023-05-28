<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;



class DashbourdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 2)->latest()->paginate(5);
        return view('dashboard.index', compact('users'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
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
             'email' => 'required|email',
             'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
             'role_id' => 'required|in:1,2,3', // Validate role_id to be either 1 or 2
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);

         // Handle the file upload
         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imagePath = $image->move('/images');
         }

         // Create the new user
         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = bcrypt($request->password);
         $user->role_id = $request->role_id;

         // Assign the image path to the user if it was uploaded
         if (isset($imagePath)) {
             $user->image = $imagePath;
         }

         $user->save();

         return redirect()->route('dashboard.index')->with('success', 'User created successfully.');
     }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): Factory|View
    {
        $user = User::find($id);
        return view('dashboard.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Factory|View
    {
        $user = User::find($id);
        return view('dashboard.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable', // Password is optional during update
            'role_id' => 'required|in:1,2',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find($id);

        // Update the user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $user->image = $imagePath;
        }

        $user->update();

        return redirect()->route('dashboard.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect to the index page with success message
        return redirect()->route('dashboard.index')->with('success', 'User deleted successfully');
    }
}
