<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['admins'] = User::all()->except(Auth::id());

        return view('admin.admins.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $validated['user_role_id'] = 1;

        User::create($validated);

        return redirect()->route('admin.index')->with('message', 'Berhasil menambahkan admin.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['admin'] = User::find($id);

        return view('admin.admins.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::find($id);

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['nullable'],
        ]);

        if (!$validated['password']) unset($validated['password']);

        $admin->update($validated);

        if ($validated['password'] ?? false) $admin->password = bcrypt($validated['password']);
        
        $admin->save();

        return redirect()->route('admin.index')->with('message', 'Berhasil mengedit admin.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);

        $admin->delete();

        return redirect()->route('admin.index')->with('message', 'Berhasil menghapus admin.');
    }
}
