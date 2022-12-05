<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil seluruh data di tabel menu
        $datas = Menu::all();

        // Mengambil seluruh data di tabel kategori
        $datas1 = Kategori::all();

        // Pergi ke tampilan dengan membawa data yang telah dideklarasikan
        return view('dashboard.menu.menu', [
            'items' => $datas,
            'datas' => $datas1
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
            'nama' => 'required',
            'foto' => 'required|image|max:10000',
            'harga' => 'required|integer',
            'keterangan' => 'required',
            'kategori_id' => 'required'
        ]);

        // Menyimpan gambar di storage
        $validate['foto'] = $request->file('foto')->store('artikel/foto');

        // Memasukkan inputan user ke database (table menu)
        Menu::create($validate);

        // Kembali ke Halaman Awal di dashboard_menu
        return redirect('menu')->with('success', 'Berhasil Menambah Menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        if(isset($request->foto)){
            // Memvalidasi Inputan user
            $validate = $request->validate([
                'nama' => 'required',
                'foto' => 'image|max:10000',
                'harga' => 'required|integer',
                'keterangan' => 'required',
                'kategori_id' => 'required'
            ]);

            // Menyimpan gambar di storage
            $validate['foto'] = $request->file('foto')->store('artikel/foto');

            // Menghapus foto lama
            unlink('storage/'.$menu->foto);

            // Memasukkan inputan user ke database (table menu)
            $menu->update($validate);
        }else{
            // Memvalidasi Inputan user
            $validate = $request->validate([
                'nama' => 'required',
                'harga' => 'required|integer',
                'keterangan' => 'required',
                'kategori_id' => 'required'
            ]);

            // Memasukkan inputan user ke database (table menu)
            $menu->update($validate);
        }

        // Kembali ke Halaman Awal di dashboard_menu
        return redirect('menu')->with('success', 'Berhasil Mengubah Menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // Menghapus foto dari storage
        unlink('storage/'.$menu->foto);

        // Menghapus data dari database (table menu)
        $menu->delete();

        // Kembali ke Halaman Awal di dashboard_menu
        return redirect('menu')->with('success', 'Berhasil Menghapus Menu');
    }
}
