<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\APIService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, APIService $service)
    {
        $validatedCredentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::guard('teacher')->attempt($validatedCredentials)) {
            return $service->responseFailed('Email atau password salah.', 401);
        }

        try {
            $user = Auth::guard('teacher')->user();
            
            // Regenerate token
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $service->responseSuccess([
                'token' => $token
            ]);

        } catch (ModelNotFoundException $ex) {
            return $service->responseFailed('User tidak ditemukan');
        }
    }
}
