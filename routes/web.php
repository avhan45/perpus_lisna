<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/',[HomeController::class,'index']);

// User Register
// Route::get('/user-register', [UserController::class, 'create']);
// Route::post('/user-register', [UserController::class, 'store']);
// Route::get('/user-edit/{id}', [UserController::class, 'edit']);

Route::resource('user', UserController::class);
Route::resource('anggota',AnggotaController::class);
Route::resource('buku', BukuController::class);
Route::resource('transaksi', TransaksiController::class);
Route::get('/laporan/trs', [LaporanController::class, 'transaksi']);
Route::get('/laporan/trs/pdf',[LaporanController::class, 'transaksiPdf']);
Route::get('laporan/buku',[LaporanController::class, 'buku']);
Route::get('laporan/buku/pdf',[LaporanController::class, 'bukuPdf']);
