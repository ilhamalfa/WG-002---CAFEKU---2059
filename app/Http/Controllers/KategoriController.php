<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil seluruh data di tabel kategori
        $datas = Kategori::all();

        // Pergi ketampilan dengan membawa data yang telah dideklarasikan
        return view('dashboard.kategori.kategori', [
            'items' => $datas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Memvalidasi Inputan user
        $validate = $request->validate([
            'nama' => 'required'
        ]);

        // Memasukkan inputan user ke database (table kategori)
        Kategori::create($validate);

        // Kembali ke Halaman Awal di dashboard_kategori
        return redirect('kategori')->with('success', 'Berhasil Menambah Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Memvalidasi Inputan user
        $validate = $request->validate([
            'nama' => 'required'
        ]);

        // Mengupdate data di database (table kategori)
        $kategori->update($validate);

        return redirect('kategori')->with('success', 'Berhasil Mengubah Kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        // menghapus data di database (table kategori)
        $kategori->delete();

        return redirect('kategori')->with('success', 'Berhasil Menghapus Kategori');
    }
}
