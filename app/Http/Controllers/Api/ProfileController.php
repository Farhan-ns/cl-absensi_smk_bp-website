<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\APIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function editProfilePicture(Request $request)
    {
        $request->validate([
            'image' => ['required', 'file', 'mimes:jpg,png,jpeg'],
        ]);

        $directory = public_path('/profile_pictures/teachers');
        File::ensureDirectoryExists($directory);

        $imageName = $request->file('image')->hashName();
        $request->file('image')->move($directory, $imageName);

        $teacher = $request->user();

        // Delete previous profile picture
        if (File::exists("$directory/$teacher->profile_picture")) {
            File::delete("$directory/$teacher->profile_picture");
        }

        $teacher->profile_picture = $imageName;
        $teacher->save();

        return  $this->service->responseSuccess([], 'Berhasil mengubah foto profil');
    }
}
