<?php

namespace App\Http\Controllers;

use App\Models\RefPengguna;
use App\Models\RefProduk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getData()
    {
        $jumlah_produk = RefProduk::count();
        $jumlah_user = RefPengguna::count();

        $jumlah_produk_aktif = RefProduk::where('status_id', 2)->count();
        $jumlah_user_aktif = RefPengguna::where('status_id', 2)->count();

        $data_produk = RefProduk::orderBy('created_at', 'desc')->with('status')->limit(10)->get();

        $data_response = [
            'jml_produk' => $jumlah_produk,
            'jml_user'   => $jumlah_user,
            'jml_produk_aktif' => $jumlah_produk_aktif,
            'jml_user_aktif' => $jumlah_user_aktif,
            'data_produk' => $data_produk
        ];

        return $data_response;
    }

    public function index()
    {
        $data = $this->getData();
        return view('dashboard', compact('data'));
    }
}
