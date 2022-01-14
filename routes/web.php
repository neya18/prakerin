<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('profil', function () {
//     return view('profil');
// });

Auth::routes(
    [
        'register' => false,
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Hak akses admin dan petugas dibatasi melalui controller langsung!!!

Route::group(['middleware' => 'auth'], function () {

    Route::resource('supplier', SupplierController::class);
    Route::get('/cetak-supplier', [SupplierController::class, 'cetakSupplierPDF'])->name('exportPDF.suppliersAll');

    Route::resource('customer', CustomerController::class);
    Route::get('/cetak-customer', [CustomerController::class, 'cetakCustomerPDF'])->name('exportPDF.customersAll');

    Route::resource('barang', BarangController::class);

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('/laporan-barangkeluar-all', [BarangKeluarController::class, 'laporanBarangKeluarAll']);
    Route::get('/laporan-barangkeluar/{id}', [BarangKeluarController::class, 'laporanBarangKeluar'])->name('laporanBarangKeluar');
    Route::get('/cetak-pdf-all', [BarangKeluarController::class, 'cetakPDF_all'])->name('exportPDF.barangKeluarAll');
    Route::get('/cetak-pdf/{id}', [BarangKeluarController::class, 'cetakPDF'])->name('exportPDF.barangKeluar');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/laporan-barangmasuk-all', [BarangMasukController::class, 'laporanBarangMasukAll']);
    Route::get('/laporan-barangmasuk/{id}', [BarangMasukController::class, 'laporanBarangMasuk'])->name('laporanBarangMasuk');
    Route::get('/cetak-pdf-all', [BarangMasukController::class, 'cetakPDF_all'])->name('exportPDF.barangMasukAll');
    Route::get('/cetak-pdf/{id}', [BarangMasukController::class, 'cetakPDF'])->name('exportPDF.barangMasuk');
});
