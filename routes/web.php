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
Route::get('/',[LoginController::class,'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/auth',[LoginController::class,'auth'])->name('auth');

//pelanggan
Route::Resource('pelanggan', PelangganController::class)->middleware('auth');

//laporan pelanggan
Route::get('/export_pdf_pelanggan', [PelangganController::class, 'export_pdf'])->name('export_pdf_pelanggan');
Route::get('/export_excel_pelanggan', [PelangganController::class, 'export_excel'])->name('export_excel_pelanggan');
Route::post('/import_excel_pelanggan', [PelangganController::class, 'import_excel'])->name('import_excel_pelanggan');

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::Resource('produk', ProdukController::class)->middleware('auth');
Route::Resource('penjualan', PenjualanController::class)->middleware('auth');
Route::Resource('detail', DetailController::class)->middleware('auth');

//laporan penjualan
Route::get('/export_pdf_penjualan', [PenjualanController::class, 'export_pdf'])->name('export_pdf_penjualan');
Route::get('/export_excel_penjualan', [PenjualanController::class, 'export_excel'])->name('export_excel_penjualan');

//laporan detail
Route::get('/export_pdf_detail', [DetailController::class, 'export_pdf'])->name('export_pdf_detail');
Route::get('/export_excel_detail', [DetailController::class, 'export_excel'])->name('export_excel_detail');

//laporan pelanggan
Route::get('/export_pdf_produk', [ProdukController::class, 'export_pdf'])->name('export_pdf_produk');
Route::get('/export_excel_produk', [ProdukController::class, 'export_excel'])->name('export_excel_produk');
Route::post('/import_excel_produk', [ProdukController::class, 'import_excel'])->name('import_excel_produk');