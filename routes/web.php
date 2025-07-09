<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ProdukController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


// Route::get('/{any}', function () {
//     return view('app'); // atau nama blade utama Vue-mu
// })->where('any', '.*');


// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// // Route fallback untuk semua path agar ditangani oleh Vue
// Route::get('/{any}', function () {
//     return Inertia::render('Biodata');
// })->where('any', '.*');
// Route::get('/dashboard', function () {
//     return view('app');
// })->where('any', '.*');
Route::get('/', function () {
    return Inertia::render('Home');
});

Route::resource('biodata', BiodataController::class);
Route::resource('produk', ProdukController::class);



require __DIR__.'/auth.php';
