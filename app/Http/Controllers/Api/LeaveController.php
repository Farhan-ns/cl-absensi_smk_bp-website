<?php

namespace App\Http\Controllers\Api;

use App\Constants\ApprovalStatus;
use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Notifications\LeaveSubmitted;
use App\Services\APIService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LeaveController extends Controller
{
    private $service;

    public function __construct(APIService $service)
    {
        $this->service = $service;
    }

    public function getLeaves(Request $request)
    {
        $teacher = $request->user();

        $leaves = $teacher->leaves()
            ->orderBy('created_at', 'desc')
            ->get()
            ->makeHidden(['teacher_id', 'updated_at']);

        return $this->service->responseSuccess($leaves);
    }

    public function proposeLeave(Request $request)
    {
        $teacher = $request->user();

        $validated = $request->validate([
            'leave_type' => ['required'],
            'absence_reason' => ['required'],
            'absence_note' => ['nullable'],
            'absence_document' => ['required', 'file'],
            'from_date' => ['required'],
            'to_date' => ['required'],
        ]);

        $leaveFromDate = Carbon::parse($request->from_date);
        $leaveToDate = Carbon::parse($request->to_date);
        $diffInDays = $leaveFromDate->diffInDays($leaveToDate, false);


        if ($diffInDays < 0) return $this->service->responseFailed('Tanggal "Ke" tidak boleh lebih awal dari tanggal "Dari",');

        $directory = 'leave_documents';
        File::ensureDirectoryExists(storage_path("app/$directory"));

        $fileExt = $request->file('absence_document')->extension();
        $randomizedFileName = Str::random(25) . ".$fileExt";
        $request->file('absence_document')->storeAs($directory, "$randomizedFileName");

        $validated['absence_document'] = $randomizedFileName;
        $validated['teacher_id'] = $teacher->id;
        $validated['approval_status'] = ApprovalStatus::$PENDING;

        $leave = Leave::create($validated);

        $teacher->notify(new LeaveSubmitted($leave, 'Permohonan izin anda sedang diproses!'));

        return $this->service->responseSuccess($leave);
    }

    public function getAbsenceDocType(Request $request)
    {
        $request->validate([
            'leave_id' => ['required']
        ]);

        $teacher = $request->user();
        $leave = $teacher->leaves()->find($request->leave_id);

        $path = storage_path("app/leave_documents/$leave->absence_document");
        $mime = File::mimeType($path);

        return $this->service->responseSuccess([
            'is_image' => $mime != 'application/pdf'
        ]);
    }

    public function getAbsenceDoc(Request $request, string $leave_id)
    {
        // $request->validate([
        //     'leave_id' => ['required']
        // ]);

        $teacher = $request->user();
        $leave = $teacher->leaves()->find($leave_id);
        
        $path = storage_path("app/leave_documents/$leave->absence_document");
        $file = File::get($path);
        
        return response($file, 200)->header('Content-Type', File::mimeType($path));
    }
}
