<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\APIService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $service;

    public function __construct(APIService $service)
    {
        $this->service = $service;
    }

    public function getProfile(Request $request) 
    {
        return $this->service->responseSuccess($request->user()); 
    }

    public function editProfile(Request $request) 
    {
        $validated = $request->validate([
            'name' => ['nullable'],
            'phone' => ['nullable', 'numeric'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable'],
            'birthdate' => ['nullable'],
        ]);

        $user = $request->user();
        $user->update($validated);
        $user->save();

        return $this->service->responseSuccess($user); 
    }
}
