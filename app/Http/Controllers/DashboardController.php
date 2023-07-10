<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data['teacherCount'] = Teacher::all()->count();
        $data['adminCount'] = User::whereRelation('role', 'id', 1)->count();
        $data['leaveCount'] = Leave::all()->count();

        return view('admin.dashboard', $data);
    }
}
