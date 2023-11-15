<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = "Nama: Faza Shafa Azizah";
    $email = "Email: fazashafa.ua@gmail.com";
    $bio = "Biodata: Saya mahasiswi semester 5 yang sedang berkuliah di Universitas Muhammadiyah Jakarta. Umur saya 20 tahun dan saya bertempat tinggal di bekasi";
    return view('hello', compact('name', 'email', 'bio'));
});

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
