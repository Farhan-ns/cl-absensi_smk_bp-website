<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function showForm()
    {
        
        return view('admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => ['current_password:web'],
            'new_password' => ['confirmed'],
        ], [
            'password' => 'Password salah',
            'new_password' => 'Password konfirmasi tidak cocok dengan password baru'
        ]);

        $user = Auth::user();
        $user->password = bcrypt($validated['new_password']);
        $user->save();

        return redirect()->route('change-password')->with('message', 'Berhasil mengubah password');
    }
}
