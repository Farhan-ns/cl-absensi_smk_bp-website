<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LateToleranceLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO display view for config value
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $newLateLimit = $request->late_limit;

        config(['ABSENSI_LATE_LIMIT_IN_MINUTES' => $newLateLimit]);

        return back()->with('success', 'Limit terlambat berhasil diubah');
    }
}
