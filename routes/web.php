<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Config\AllowedIpController;
use App\Http\Controllers\Config\LateLimitController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::resource('guru', TeacherController::class);

    Route::get('/teacher/{teacherId}/jadwal/', [TeacherScheduleController::class, 'index'])->name('jadwal.index');
    Route::get('/teacher/{teacherId}/jadwal/create', [TeacherScheduleController::class, 'create'])->name('jadwal.create');
    Route::resource('jadwal', TeacherScheduleController::class)->except('index', 'create', 'show');

    Route::get('/limit', [LateLimitController::class, 'index'])->name('limit.index');
    Route::post('/limit', [LateLimitController::class, 'update'])->name('limit.update');

    Route::get('/allowed-ip', [AllowedIpController::class, 'index'])->name('allowed-ip.index');
    Route::post('/allowed-ip', [AllowedIpController::class, 'update'])->name('allowed-ip.update');
});