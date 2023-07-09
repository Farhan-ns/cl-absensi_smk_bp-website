<?php

use App\Constants\ApprovalStatus;
use App\Constants\AttendanceStatus;
use App\Constants\LeaveType;
use Carbon\Carbon;

if (!function_exists('getIndonesianTodaysDayName')) {
    function getIndonesianTodaysDayName()
    {
        return Carbon::today()->locale('id-ID')->dayName;
    }
}

if (!function_exists('getApprovalStatusLabel')) {
    /** @var int $approvalStatusId ApprovalStatus value */
    function getApprovalStatusLabel(int $approvalStatusId): string
    {
        switch ($approvalStatusId) {
            case ApprovalStatus::$PENDING:
                return 'Pending';
                break;
            case ApprovalStatus::$REJECTED:
                return 'Ditolak';
                break;
            case ApprovalStatus::$APPROVED:
                return 'Diterima';
                break;
            default:
                return '-';
                break;
        }
    }
}

if (!function_exists('getApprovalStatusChip')) {
    /** @var int $approvalStatusId ApprovalStatus value */
    function getApprovalStatusChip(int $approvalStatusId): string
    {
        switch ($approvalStatusId) {
            case ApprovalStatus::$PENDING:
                return '<span class="badge bg-label-primary me-1">Pending</span>';
                break;
            case ApprovalStatus::$REJECTED:
                return '<span class="badge bg-label-danger me-1">Ditolak</span>';
                break;
            case ApprovalStatus::$APPROVED:
                return '<span class="badge bg-label-success me-1">Diterima</span>';
                break;
            default:
                return '-';
                break;
        }
    }
}

if (!function_exists('getLeaveTypeLabel')) {
    /** @var int $leaveTypeId LeaveType value */
    function getLeaveTypeLabel(int $leaveTypeId): string
    {
        switch ($leaveTypeId) {
            case LeaveType::$OFFICIAL_LEAVE:
                return 'Pengajuan Dinas';
                break;
            case LeaveType::$OTHER_LEAVE:
                return 'Izin Kehadiran';
                break;
            case LeaveType::$PTO_LEAVE:
                return 'Izin Cuti';
                break;
            case LeaveType::$SICK_LEAVE:
                return 'Izin Sakit';
                break;
            default:
                return '-';
                break;
        }
    }
}

if (!function_exists('getAttendanceStatusLabel')) {
    /** @var int $attendanceStatusId AttendanceStatus value */
    function getAttendanceStatusLabel(int $attendanceStatusId): string
    {
        switch ($attendanceStatusId) {
            case AttendanceStatus::$ABSENT:
                return 'Tidak Hadir';
                break;
            case AttendanceStatus::$CHECKOUT:
                return 'Checkout';
                break;
            case AttendanceStatus::$EARLY_CHECKOUT:
                return 'Checkout lebih awal';
                break;
            case AttendanceStatus::$LATE_CHECKIN:
                return 'Terlambat checkin';
                break;
            case AttendanceStatus::$LATE_CHECKOUT:
                return 'Terlambat checkout';
                break;
            case AttendanceStatus::$OFFICIAL_LEAVE:
                return 'Pengajuan Dinas';
                break;
            case AttendanceStatus::$OTHER_LEAVE:
                return 'Izin Kehadiran';
                break;
            case AttendanceStatus::$PRESENT:
                return 'Hadir';
                break;
            case AttendanceStatus::$PTO_LEAVE:
                return 'Izin Cuti';
                break;
            case AttendanceStatus::$SICK_LEAVE:
                return 'Izin Sakit';
                break;
            default:
                return '-';
                break;
        }
    }
}
