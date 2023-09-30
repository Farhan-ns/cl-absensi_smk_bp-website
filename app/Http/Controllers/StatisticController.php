<?php

namespace App\Http\Controllers;

use App\Constants\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $months = [
        '1' => 'Januari',
        '2' => 'Febuari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    // Unholy clusterfuck of unoptimized & minimally readable codes
    public function index(Request $request)
    {
        $now = now()->setTimezone('Asia/Jakarta');
        $selectedMonth = $request->bulan ?? $now->month;
        $selectedYear = $request->tahun ?? $now->year;

        $data['teachers'] = Teacher::orderBy('name')->get();
        $data['months'] = $this->months;
        $data['selectedMonth'] = $selectedMonth;
        $data['selectedYear'] = $selectedYear;
        $data['selectedTeacher'] = $request->guru ?? -1;

        $selectedDate = Carbon::parse("$selectedYear-$selectedMonth-01");

        $datas = [];
        if ($request->guru > 0) {
            $datas = $this->getIndividualStatistics($selectedDate, $request->guru);
        } else {
            $datas = $this->getAllStatistics($selectedDate);
        }
        $data = array_merge($data, $datas);

        return view('admin.attendance-statistics.index', $data);
    }

    public function getIndividualStatistics($selectedDate, $teacherId) 
    {
        $allAttendance = [];
        $teacher = Teacher::find($teacherId);
        $allAttendance = $teacher->attendances()->whereMonth('submit_time', $selectedDate->month)->get();
        
        $workdaysCount = 0;
        for ($i = 1;$i <= $selectedDate->daysInMonth;$i++) {
            if ($selectedDate->isWeekday()) $workdaysCount++;

            $selectedDate->addDay();
        }

        $attendanceGroupedByDate = $allAttendance->groupBy(function ($item, int $key) {
            return substr($item['submit_time'], 0, 10);
        });

        $workdayAttendance = $attendanceGroupedByDate->reject(function ($item, $key) {
            return Carbon::parse($key)->dayOfWeekIso >= 6; //Saturday & Sunday
        });

        // Separate the late attendance and not late
        [$lateAttendance, $nonLateWorkdayAttendance] =  $workdayAttendance->partition(function ($item, $key) {
            $isLate = false;
            $item->each(function ($item, $key) use (&$isLate) {
                if ($item->attendance_status == AttendanceStatus::$LATE_CHECKIN) {
                    $isLate = true;
                }
            });
            
            return $isLate;
        });
        
        // Full attendance means have checked in & checked out
        $workdayAttendanceWithFullAttendance = $nonLateWorkdayAttendance->filter(function ($item, $key) {
            if (count($item) < 2) return false; // No checkin and/or checkout.

            if ($item[0]->submit_type == 'checkin' && $item[1]->submit_type == 'checkout') {
                return true;
            }

            return false;
        });

        $percentageWorkdayAttendanceWithFullAttendance = count($workdayAttendanceWithFullAttendance) * 100 / $workdaysCount;
        $percentageLateWorkdayAttendance = count($lateAttendance) * 100 / $workdaysCount;
        
        $data['attendancePercentage'] = round($percentageWorkdayAttendanceWithFullAttendance);
        $data['latePercentage'] = round($percentageLateWorkdayAttendance);
        $data['restPercentage'] = 100 - $data['attendancePercentage'] - $data['latePercentage'];

        return $data;
    }

    public function getAllStatistics($selectedDate)
    {
        $allAttendance = Attendance::whereMonth('submit_time', $selectedDate->month)->get();
        
        $workdaysCount = 0;
        for ($i = 1;$i <= $selectedDate->daysInMonth;$i++) {
            if ($selectedDate->isWeekday()) $workdaysCount++;

            $selectedDate->addDay(); 
        }

        $attendanceGroupedByDate = $allAttendance->groupBy(['teacher_id', function ($item, int $key) {
            return substr($item['submit_time'], 0, 10);
        }]);

        $attendanceStatistics = [];
        $attendanceGroupedByDate->each(function ($item, $key) use (&$attendanceStatistics) {
            $workdayAttendance = $item->reject(function ($item, $key) {
                return Carbon::parse($key)->dayOfWeekIso >= 6; //Saturday & Sunday
            });
            [$lateAttendance, $nonLateWorkdayAttendance] =  $workdayAttendance->partition(function ($item, $key) {
                $isLate = false;
                $item->each(function ($item, $key) use (&$isLate) {
                    if ($item->attendance_status == AttendanceStatus::$LATE_CHECKIN) {
                        $isLate = true;
                    }
                });
                
                return $isLate;
            });
            
            $workdayAttendanceWithFullAttendance = $nonLateWorkdayAttendance->filter(function ($item, $key) {
                if (count($item) < 2) return false; // No checkin and/or checkout.

                if ($item[0]->submit_type == 'checkin' && $item[1]->submit_type == 'checkout') {
                    return true;
                }

                return false;
            });
            
            array_push($attendanceStatistics, [$key => [
                'total_attendance' => count($workdayAttendanceWithFullAttendance),
                'total_late_attendance' => count($lateAttendance),
            ]]);
        });

        $attendanceStatistics = collect($attendanceStatistics)->flatten(1);

        $overallTeachersAttendance = $attendanceStatistics->reduce(function (int $carry, $item, $key) use ($workdaysCount) {
            $attendanceRate = $item['total_attendance'] * 100 / $workdaysCount;
            return $carry + round($attendanceRate);
        }, 0);
        
        $overallTeachersLateAttendance = $attendanceStatistics->reduce(function (int $carry, $item) use ($workdaysCount) {
            $attendanceRate = $item['total_late_attendance'] * 100 / $workdaysCount;
            return $carry + round($attendanceRate);
        }, 0);

        $averageTeachersAttendancePercentage = $overallTeachersAttendance / count($attendanceStatistics);
        $averageTeachersLateAttendancePercentage = $overallTeachersLateAttendance / count($attendanceStatistics);

        $data['attendancePercentage'] = $averageTeachersAttendancePercentage;
        $data['latePercentage'] = $averageTeachersLateAttendancePercentage;
        $data['restPercentage'] = 100 - $data['attendancePercentage'] - $data['latePercentage'];

        return $data;
    }
}
