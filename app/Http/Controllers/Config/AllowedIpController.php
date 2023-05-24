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
        // TODO index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ip_address' => 'required'
        ]);

        $this->service->create($validated);

        // TODO return index view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TODO edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'ip_address' => 'required'
        ]);

        $allowedIp = AllowedIp::find($id);

        $this->service->update($validated, $allowedIp);

        // TODO return index view
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $allowedIp = AllowedIp::find($id);

        $this->service->destroy($allowedIp);

        // TODO return index view
    }
}
