<?php

namespace App\Http\Controllers;

use App\Constants\ApprovalStatus;
use App\Constants\AttendanceSubmitType;
use App\Models\Leave;
use App\Models\Teacher;
use App\Notifications\LeaveSubmitted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['leaves'] = Leave::orderBy('created_at', 'desc')->get();

        return view('admin.leave.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['leave'] = Leave::find($id);
        $data['isApproved'] = $data['leave']->approval_status === ApprovalStatus::$APPROVED;
        $data['isRejected'] = $data['leave']->approval_status === ApprovalStatus::$REJECTED;

        return view('admin.leave.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadDocument(Request $request, string $id)
    {
        $leave = Leave::find($id);
        return Response::download(storage_path("app/leave_documents/$leave->absence_document"));
    }

    public function approve(Request $request)
    {
        $leave = Leave::find($request->id);
        $leave->approval_status = ApprovalStatus::$APPROVED;
        $leave->save();

        $leaveFromDate = Carbon::parse($leave->from_date);
        $leaveToDate = Carbon::parse($leave->to_date);

        $diffInDays = $leaveFromDate->diffInDays($leaveToDate, false);

        $now = now()->setTimezone('Asia/Jakarta');
        $leaveFromDate->hour($now->hour);
        $leaveFromDate->minute($now->minute);
        $leaveFromDate->second($now->second);
        
        for ($i = 0; $i <= $diffInDays; $i++) { 
            $leave->attendance()->create([
                'teacher_id' => $leave->teacher_id,
                'is_leave' => true,
                'leave_id' => $leave->id,
                'submit_time' => $leaveFromDate,
                'submit_type' => AttendanceSubmitType::$LEAVE,
                'attendance_status' => $leave->leave_type,
            ]);
            $leaveFromDate->addDays(1);
        }
    
        $teacher = $leave->teacher->get();
        $teacher->notify(new LeaveSubmitted($leave, 'Permohonan izin anda sudah disetujui!'));

        return redirect()->route('izin.index')->with('message', 'Berhasil meng-approve pengajuan');
    }

    public function reject(Request $request)
    {
        $leave = Leave::find($request->id);
        $leave->approval_status = ApprovalStatus::$REJECTED;
        $leave->save();

        $teacher = $leave->teacher;
        $teacher->notify(new LeaveSubmitted($leave, 'Permohonan izin anda ditolak.'));

        return redirect()->route('izin.index')->with('message', 'Berhasil me-reject pengajuan');
    }
}
