<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->hasRole('normal_user')) {
            $credential = $request->only('email', 'password');
            if (Auth::attempt($credential)) {
                return redirect('/');
            }
            flash()->error('Email atau password salah!');
        } else {
            flash()->error('User tidak ditemukan / role tidak sesuai!');
        }

        return back();
    }
}
