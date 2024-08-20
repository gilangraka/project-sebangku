<?php

namespace App\Http\Controllers;

use App\Models\RefProduk;
use App\Models\RefStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use function Flasher\Prime\flash;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = RefProduk::with('status')->paginate(10);
        $ref_status = RefStatus::all();
        return view('manage-produk.index', compact('produk', 'ref_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'gambar_produk' => 'required|mimes:jpg,png,jpeg',
            'status_id' => 'exists:ref_status,id'
        ]);

        $file = $request->file('gambar_produk');
        if ($file) {
            $nama_file = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gambar_produk'), $nama_file);

            $produk = new RefProduk();
            $produk->nama = $validatedData['nama'];
            $produk->harga = $validatedData['harga'];
            $produk->gambar_produk = $nama_file;
            $produk->status_id = $validatedData['status_id'];
            $produk->save();

            flash()->success('Berhasil menambah produk');
        } else {
            flash()->error('Lengkapi semua data');
        }

        return back();
    }

    public function edit(string $id)
    {
        $produk = RefProduk::with('status')
            ->find($id);
        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'gambar_produk' => 'mimes:jpg,png,jpeg',
            'status_id' => 'exists:ref_status,id'
        ]);

        $produk = RefProduk::find($id);
        if ($produk) {
            if ($request->hasFile('gambar_produk')) {
                File::delete(public_path('gambar_produk/' . $produk->gambar_produk));
                $file = $request->gambar_produk;
                $nama_file = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('gambar_produk'), $nama_file);
                $produk->gambar_produk = $nama_file;
            }

            $produk->nama = $validatedData['nama'];
            $produk->harga = $validatedData['harga'];
            $produk->status_id = $validatedData['status_id'];
            $produk->save();

            flash()->success('Berhasil mengupdate produk');
        } else {
            flash()->error('Produk tidak ditemukan!');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = RefProduk::find($id);
        if ($produk) {
            $produk->delete();
            flash()->success('Produk berhasil dihapus');
        } else {
            flash()->error('Produk tidak ditemukan!');
        }

        return back();
    }
}
