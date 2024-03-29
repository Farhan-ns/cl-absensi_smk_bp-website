<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Config\AllowedIpController;
use App\Http\Controllers\Config\LateLimitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/change-password', [ChangePasswordController::class, 'showForm'])->name('change-password');
Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password.post');

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/kehadiran/statistik', [StatisticController::class, 'index'])->name('attendance.statistics');
    Route::post('/kehadiran/statistik', [StatisticController::class, 'index'])->name('attendance.statistics.post');

    Route::resource('guru', TeacherController::class);
    Route::resource('kehadiran', AttendanceController::class);
    Route::resource('izin', LeaveController::class);
    Route::resource('admin', AdminController::class);

    Route::get('/izin/{leaveId}/download', [LeaveController::class, 'downloadDocument'])->name('izin.download');
    Route::post('/izin/approve', [LeaveController::class, 'approve'])->name('izin.approve');
    Route::post('/izin/reject', [LeaveController::class, 'reject'])->name('izin.reject');

    Route::get('/teacher/{teacherId}/jadwal/', [TeacherScheduleController::class, 'index'])->name('jadwal.index');
    Route::get('/teacher/{teacherId}/jadwal/create', [TeacherScheduleController::class, 'create'])->name('jadwal.create');
    Route::resource('jadwal', TeacherScheduleController::class)->except('index', 'create', 'show');

    Route::get('/limit', [LateLimitController::class, 'index'])->name('limit.index');
    Route::post('/limit', [LateLimitController::class, 'update'])->name('limit.update');

    Route::get('/allowed-ip', [AllowedIpController::class, 'index'])->name('allowed-ip.index');
    Route::post('/allowed-ip', [AllowedIpController::class, 'update'])->name('allowed-ip.update');

    Route::post('/import/guru', [TeacherController::class, 'import'])->name('import.teacher');
    Route::get('/export/guru', [TeacherController::class, 'export'])->name('export.teacher');

    Route::get('/backup', [BackupController::class, 'backupDB'])->name('backup');
    Route::get('/restore', [BackupController::class, 'restoreDB'])->name('restore');
});