<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;

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

// Route::get('/', function () {
//     return view('template.layout');
// });

//login
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/auth',[LoginController::class,'auth'])->name('auth');

//pelanggan
Route::Resource('pelanggan', PelangganController::class);

//laporan
Route::get('/export_pdf_pelanggan', [PelangganController::class, 'export_pdf'])->name('export_pdf_pelanggan');
Route::get('/export_excel_pelanggan', [PelangganController::class, 'export_excel'])->name('export_excel_pelanggan');
Route::post('/import_excel_pelanggan', [PelangganController::class, 'import_excel'])->name('import_excel_pelanggan');

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::Resource('produk', ProdukController::class);
Route::Resource('penjualan', PenjualanController::class);
Route::Resource('detail', DetailController::class);