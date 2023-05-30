<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Teacher;
use App\Models\TeacherSchedule;
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $teacherId)
    {
        $teacher = Teacher::find($teacherId);
        $schedules = $teacher->schedules();

        return view('admin.teacher-schedule.index', compact('teacher', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $teacherId)
    {
        $days = Day::all();

        return view('admin.teacher-schedule.create', compact('teacherId', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id);

        $validated = $request->validate([
            'day_id' => ['required', 'numeric'],
            'checkin_time' => ['required'],
            'checkout_time' => ['required'],
            'subject' => ['nullable'],
            'class_grade' => ['nullable'],
        ]);

        $teacher->schedules()->create($validated);

        return redirect()->route('jadwal.index', $teacher->id)->with('message', 'Berhasil menambahkan jadwal.');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = TeacherSchedule::find($id); 
        $days = Day::all();

        $teacherId = $id;

        return view('admin.teacher-schedule.edit', compact('schedule', 'days', 'teacherId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $schedule = TeacherSchedule::find($id);

        $validated = $request->validate([
            'day_id' => ['required', 'numeric'],
            'checkin_time' => ['required'],
            'checkout_time' => ['required'],
            'subject' => ['nullable'],
            'class_grade' => ['nullable'],
        ]);

        $schedule->update($validated);
        $schedule->save();

        return redirect()->route('jadwal.index', $schedule->teacher->id)->with('message', 'Berhasil mengubah jadwal.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = TeacherSchedule::find($id);
        $schedule->delete();
        
        return redirect()->route('jadwal.index', $schedule->teacher->id)->with('message', 'Berhasil menghaous jadwal.');
    }
}
