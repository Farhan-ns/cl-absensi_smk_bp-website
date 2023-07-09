<?php

namespace App\Http\Controllers\Api;

use App\Constants\AttendanceStatus;
use App\Constants\AttendanceSubmitType;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\LateLimit;
use App\Models\Teacher;
use App\Services\APIService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $service;

    public function __construct(APIService $service)
    {
        $this->service = $service;
    }

    public function getAttendances(Request $request)
    {
        $sortBy = $request->query('sortBy', 'asc');

        $teacher = $request->user();

        $attendances = $teacher->attendances()->orderBy('submit_time', $sortBy)->get();

        return $this->service->responseSuccess($attendances);
    }

    public function checkin(Request $request)
    {
        $teacher = $request->user();

        if ($this->hasCheckinToday($teacher)) {
            return $this->service->responseFailed('Anda sudah checkin untuk hari ini.', 403);
        }

        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        // $todaysName = getIndonesianTodaysDayName();
        $todaysName = 'Senin';

        $scheduleToday = $teacher->schedules()
            ->with('day')
            ->whereRelation('day', 'name', $todaysName)
            ->get()
            ->first();
        $hasScheduleToday = $scheduleToday?->count() === 1;

        $attendanceStatus = AttendanceStatus::$PRESENT;

        // If has no schedule, just normal checkin regardless of lateness.
        if (!$hasScheduleToday) {
            $checkinAttendanceToday = $teacher->attendances()->create([
                'submit_time' => $now,
                'submit_type' => AttendanceSubmitType::$CHECKIN,
                'attendance_status' => $attendanceStatus,
            ]);

            return $this->service->responseSuccess($checkinAttendanceToday);
        }

        // If has schedule, check whether they're late or not.
        $checkinTimeToday = Carbon::parse($scheduleToday->checkin_time)->shiftTimezone('Asia/Jakarta');
        $latelimit = LateLimit::first()->late_limit_in_minutes;

        if ($now->diffInMinutes($checkinTimeToday) > $latelimit) {
            $attendanceStatus = AttendanceStatus::$LATE_CHECKIN;
        }

        $checkinAttendanceToday = $teacher->attendances()->create([
            'submit_time' => $now,
            'submit_type' => AttendanceSubmitType::$CHECKIN,
            'attendance_status' => $attendanceStatus,
        ]);

        return $this->service->responseSuccess($checkinAttendanceToday);
    }

    public function checkout(Request $request)
    {
        $teacher = $request->user();

        if (!$this->hasCheckinToday($teacher)) {
            return $this->service->responseFailed('Anda belum melakukan checkin untuk hari ini.', 403);
        }

        if ($this->hasCheckoutToday($teacher)) {
            return $this->service->responseFailed('Anda telah melakukan checkout untuk hari ini.', 403);
        }

        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        // $todaysName = getIndonesianTodaysDayName();
        $todaysName = 'Senin';

        $scheduleToday = $teacher->schedules()
            ->with('day')
            ->whereRelation('day', 'name', $todaysName)
            ->get()
            ->first();
        $hasScheduleToday = $scheduleToday?->count() === 1;

        $attendanceStatus = AttendanceStatus::$CHECKOUT;

        // If has no schedule, just normal checkout regardless of lateness.
        if (!$hasScheduleToday) {
            $checkoutAttendanceToday = $teacher->attendances()->create([
                'submit_time' => $now,
                'submit_type' => AttendanceSubmitType::$CHECKOUT,
                'attendance_status' => $attendanceStatus,
            ]);

            return $this->service->responseSuccess($checkoutAttendanceToday);
        }

        // If has schedule, check whether they're late or not.
        $checkoutTimeToday = Carbon::parse($scheduleToday->checkout_time)->shiftTimezone('Asia/Jakarta');
        $latelimit = LateLimit::first()->late_limit_in_minutes;

        if ($now->diffInMinutes($checkoutTimeToday, false) + $latelimit < 0) {
            $attendanceStatus = AttendanceStatus::$LATE_CHECKOUT;
        }

        $checkinAttendanceToday = $teacher->attendances()->create([
            'submit_time' => $now,
            'submit_type' => AttendanceSubmitType::$CHECKOUT,
            'attendance_status' => $attendanceStatus,
        ]);

        return $this->service->responseSuccess($checkinAttendanceToday);
    }

    public function checkTodaysAttendanceStatus(Request $request)
    {
        $teacher = $request->user();

        $hasCheckinToday = $this->hasCheckinToday($teacher);
        $hasCheckoutToday = $this->hasCheckoutToday($teacher);

        return $this->service->responseSuccess([
            'hasCheckinToday' => $hasCheckinToday,
            'hasCheckoutToday' => $hasCheckoutToday
        ]);
    }

    private function hasCheckinToday(Teacher $user)
    {
        return $user->attendances()
            ->whereDay('submit_time', Carbon::now()->setTimezone('Asia/Jakarta')->day)
            ->where('submit_type', AttendanceSubmitType::$CHECKIN)
            ->get()
            ?->count() >= 1;
    }

    private function hasCheckoutToday(Teacher $user)
    {
        return $user->attendances()
            ->whereDay('submit_time', Carbon::now()->setTimezone('Asia/Jakarta')->day)
            ->where('submit_type', AttendanceSubmitType::$CHECKOUT)
            ->get()
            ?->count() >= 1;
    }
}
