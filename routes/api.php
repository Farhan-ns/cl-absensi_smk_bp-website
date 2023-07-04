<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\Auth\LoginController;
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

    Route::get('/schedules', [TeacherScheduleController::class, 'getSchedules']);
    Route::get('/check-today-attendance', [AttendanceController::class, 'checkTodaysAttendanceStatus']);

    Route::get('/attendances', [AttendanceController::class, 'getAttendances']);
    
    Route::post('/checkin', [AttendanceController::class, 'checkin']);
    Route::post('/checkout', [AttendanceController::class, 'checkout']);
});

Route::post('/login', LoginController::class);
