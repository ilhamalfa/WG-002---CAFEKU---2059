<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $datas = Menu::all();
        return view('dashboard.dashboard', [
            'menus' => $datas
        ]);
    }

    public function submit(Request $request){
        // dd($request);
        // melooping nilai array untuk mengambil nilai nama dan harga dari menu
        foreach($request->menu as $id_menu){
            $menu = Menu::find($id_menu);

            $nama_menu[] = $menu->nama;
            $harga_menu[] =  $menu->harga;
        }

        // Mendeklarasikan 
        $data['nama'] = $request->nama;
        $data['jumlah_pesanan'] = count($nama_menu);
        $data['total_pesanan'] = array_sum($harga_menu);
        $data['status'] = $request->status;
        
        // Pengecekan untuk outout
        if($data['status'] == 'Member' && $data['total_pesanan'] >= 100000){
            $data['diskon'] = '20%';
        }else if($data['status'] == 'Member' && $data['total_pesanan'] < 100000){
            $data['diskon'] = '10%';
        }else {
            $data['diskon'] = 'Tidak Mendapat Diskon';
        }

        // Pembuatan Objek dari kelas hitungakhir (Membawa parameter status dan total pesanan)
        $hasil = new hitungAkhir($data['status'], $data['total_pesanan']);

        // Menggunakan method total dari kelas hitungAkhir
        $data['total'] = $hasil->total();

        $datas = Menu::all();

        return view('dashboard.dashboard', [
            'data' => $data,
            'menus' => $datas
        ]);
    }
}

// Interface hitung yang mempunyai method diskon
interface hitung{
    public function diskon();
}

// Class hitung akhir yang mana turunan (Implementasi) dari interface hitung
class hitungAkhir implements hitung{
    public function __construct($status, $total)
    {
        $this->status = $status;
        $this->total = $total;
    }

    public function diskon()
    {
        if($this->status == 'Member' && $this->total >= 100000){
            return $this->total * 0.2;
        }else if($this->status == 'Member' && $this->total < 100000){
            return $this->total * 0.1;
        }else {
            return 0;
        }
    }

    public function total(){
        return $this->total - $this->diskon();
    }
}