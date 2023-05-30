<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\AllowedIp;
use App\Services\AllowedIpService;
use Illuminate\Http\Request;

class AllowedIpController extends Controller
{
    private $service;

    public function __construct(AllowedIpService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allowedIp = $this->service->index()[0];
        $expAllowedIp = explode('.', $allowedIp);

        return view('admin.config.allowed-ip.show', compact('expAllowedIp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $allowedIp = AllowedIp::first();

        $validated = $request->validate([
            'ip_address_1' => 'required|digits_between:0,255',
            'ip_address_2' => 'required|digits_between:0,255',
            'ip_address_3' => 'required|digits_between:0,255',
            'ip_address_4' => 'required|digits_between:0,255',
        ]);
        
        // Replace zero with wildcard (*)
        foreach ($validated as $key => $value) {
            if ($value === '0') $validated[$key] = '*';
        }
        
        $validated = [
            'ip_address' => "$validated[ip_address_1].$validated[ip_address_2].$validated[ip_address_3].$validated[ip_address_4]"
        ];

        $this->service->update($validated, $allowedIp);

        return back()->with('message', 'Alamat IP Absensi berhasil diubah');
    }
}
