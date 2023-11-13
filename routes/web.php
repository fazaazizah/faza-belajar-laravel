<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = "Nama: Faza Shafa Azizah";
    $email = "Email: fazashafa.ua@gmail.com";
    $bio = "Biodata: Saya mahasiswi semester 5 yang sedang berkuliah di Universitas Muhammadiyah Jakarta. Umur saya 20 tahun dan saya bertempat tinggal di bekasi";
    return view('hello', compact('name', 'email', 'bio'));
});

Route::get('/dashboard',[DashboardController::class, 'index']);
