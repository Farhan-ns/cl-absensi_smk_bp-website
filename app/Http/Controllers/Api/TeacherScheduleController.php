<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\APIService;
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    private $service;

    public function __construct(APIService $service)
    {
        $this->service = $service;
    }
    
    public function getSchedules(Request $request) 
    {
        $teacher = $request->user();

        $schedules = $teacher->schedules()->with('day')->get();

        return $this->service->responseSuccess($schedules);
    }
}
