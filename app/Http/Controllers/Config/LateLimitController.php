<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\LateLimit;
use Illuminate\Http\Request;

class LateLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lateLimitModel = LateLimit::first();
        $lateLimit = $lateLimitModel->late_limit_in_minutes;

        return view('admin.config.late-limit.show', compact('lateLimit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $lateLimit = LateLimit::first();

        $lateLimit->late_limit_in_minutes = $request->late_limit;
        $lateLimit->save();

        return back()->with('message', 'Limit terlambat berhasil diubah');
    }
}
