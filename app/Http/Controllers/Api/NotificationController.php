<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\APIService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $service;

    public function __construct(APIService $service)
    {
        $this->service = $service;
    }
    
    public function getNotifications(Request $request)
    {
        $teacher = $request->user();

        return $this->service->responseSuccess($teacher->notifications);
    }
}
