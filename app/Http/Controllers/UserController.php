<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil seluruh data di tabel user
        $datas = User::all();

         // Pergi k etampilan dengan membawa data yang telah dideklarasikan
        return view('dashboard.user.user', [
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5|confirmed',
            'role' => 'required'
        ]);

        // Meng-enkripsi password
        $validate['password'] = Hash::make($request->password);

        // Memasukkan inputan user ke database (table user)
        User::create($validate);

        // Kembali ke Halaman Awal di dashboard_user
        return redirect('user')->with('success', 'Berhasil Menambah User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Memvalidasi Inputan user
        $validate = $request->validate([
            'name' => 'required',
            'role' => 'required'
        ]);
        
        // Mengecek ketika kondisi email sama dengan email yang lama
        if($request->email == $user->email){
            // deklarasi validasi['email'] menggunakan data yang dulu
            $validate['email'] = $request->email;
        }else{
            // Memvalidasi Inputan user
            $validate['email'] = $request->validate([
                'email' => 'required|unique:users'
            ]);
        }

        // Mengecek ketika kondisi password akan diubah
        if(isset($request->password)){
            // Memvalidasi Inputan user
            $validate['password'] = $request->validate([
                'password' => 'required|min:5|confirmed'
            ]);

            // Meng-enkripsi password
            $validate['password'] = Hash::make($request->password);
    
            // mengubah data di database (table user)
            $user->update($validate);
        }else{
            // mengubah data di database (table user)
            $user->update($validate);
        }

        // Kembali ke Halaman Awal di dashboard_user
        return redirect('user')->with('success', 'Berhasil Mengubah Data User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // menghapus data di database (table user)
        $user->delete();

        // Kembali ke Halaman Awal di dashboard_user
        return redirect('user')->with('success', 'Berhasil Menghapus Data User');
    }
}
