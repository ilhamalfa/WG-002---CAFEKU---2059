<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $datas = Menu::all();
    
    return view('beranda', [
        'items' => $datas
    ]);
});

// hanya yang sudah login yang bisa masuk
Route::middleware(['auth'])->group(function () {
    // Route ke Dashboard
    Route::get('dashboard-admin/', [DashboardController::class, 'index']);

    // Route Submit
    Route::post('dashboard-admin/submit', [DashboardController::class, 'submit']);

    // Route resource ke halaman dashboard_kategori
    Route::resource('kategori', KategoriController::class);

    // Route resource ke halaman dashboard_menu
    Route::resource('menu', MenuController::class);
});

// hanya owner yang bisa masuk
Route::middleware(['auth', 'owner'])->group(function () {
    // Route resource ke halaman dashboard_user
    Route::resource('user', UserController::class);
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
