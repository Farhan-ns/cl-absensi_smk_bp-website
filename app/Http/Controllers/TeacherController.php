<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        
        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'birthdate' => ['nullable'], 
            'phone' => ['nullable'], 
            'email' => ['nullable'], 
            'address' => ['nullable'],
            'subject' => ['nullable'],
            'class_grade' => ['nullable'],
        ]);

        $validated['password'] = bcrypt($validated['password']);
        Teacher::create($validated);

        return redirect()->route('guru.index')->with('message', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('jadwal.index', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::find($id);

        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'password' => ['nullable'],
            'birthdate' => ['nullable'], 
            'phone' => ['nullable'], 
            'email' => ['nullable'], 
            'address' => ['nullable'],
            'subject' => ['nullable'],
            'class_grade' => ['nullable'],
        ]);

        if (!$validated['password']) unset($validated['password']);
        
        $teacher = Teacher::find($id);
        $teacher->update($validated);

        if ($validated['password'] ?? false) $teacher->password = bcrypt($validated['password']);
        $teacher->save();

        return redirect()->route('guru.index')->with('message', 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();

        return redirect()->route('guru.index')->with('message', 'Berhasil menghapus data.');
    }
}
