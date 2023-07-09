<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TeacherScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'editProfile'])->name('profile.update');
    Route::put('/profile-picture', [ProfileController::class, 'editProfilePicture'])->name('profile-picture.update');

    Route::get('/schedules', [TeacherScheduleController::class, 'getSchedules']);
    Route::get('/check-today-attendance', [AttendanceController::class, 'checkTodaysAttendanceStatus']);

    Route::get('/attendances', [AttendanceController::class, 'getAttendances']);
    
    Route::middleware('ip-restrict')->group(function () {
        Route::post('/checkin', [AttendanceController::class, 'checkin']);
        Route::post('/checkout', [AttendanceController::class, 'checkout']);
    }); 

    Route::get('/leave', [LeaveController::class, 'getLeaves']);
    Route::post('/leave', [LeaveController::class, 'proposeLeave']);

    Route::get('/leave/doc/{leave_id}', [LeaveController::class, 'getAbsenceDoc']);
    Route::post('/leave/doc/type', [LeaveController::class, 'getAbsenceDocType']);

    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
});

Route::post('/login', LoginController::class);
