<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Spatie\Permission\Models\Role;

use function Flasher\Prime\flash;

class LoginAdminController extends Controller
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

        if ($user && $user->hasRole('administrator')) {
            $credential = $request->only('email', 'password');
            if (FacadesAuth::attempt($credential)) {
                return redirect('dashboard');
            }
            flash()->error('Email atau password salah!');
        } else {
            flash()->error('User tidak ditemukan / role tidak sesuai!');
        }

        return back();
    }
}
