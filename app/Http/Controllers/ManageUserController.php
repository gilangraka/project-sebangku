<?php

namespace App\Http\Controllers;

use App\Models\RefPengguna;
use App\Models\User;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $normal_user = RefPengguna::select('ref_pengguna.*', 'users.name', 'users.email')
            ->join('users', 'ref_pengguna.user_id', '=', 'users.id')
            ->with('status')
            ->paginate(10);

        return view('manage-user.index', compact('normal_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $ref_pengguna = RefPengguna::find($id);

        if ($ref_pengguna) {
            $ref_pengguna->status_id = 2;
            $ref_pengguna->save();

            flash()->success('Berhasil approve pengguna!');
        } else {
            flash()->error('Data tidak ditemukan!');
        }

        return back();
    }
}
