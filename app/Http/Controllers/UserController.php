<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Pass role enum for select options to the view.
     */
    public function index()
    {
        // Example: Define role enum here or get from config/model
        $roles = ['admin', 'user']; // Adjust as needed

        return view('users.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json(['success' => true, 'message' => 'User created successfully.', 'data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     * Return JSON for modal.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|string|max:50',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json(['success' => true, 'message' => 'User updated successfully.', 'data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'role','created_at')->get();
        return response()->json(['data' => $users]);
    }
}
