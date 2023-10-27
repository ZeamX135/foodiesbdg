<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageResepController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/pageresep', [PageResepController::class, 'index'])->name('resep');
Route::get('/detail/{id}', [WelcomeController::class, 'detail'])->name('detailmakanan');
Route::get('/detailresep/{id}', [PageResepController::class, 'detail'])->name('detailresep');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

//route resource
Route::resource('/makanan', MakananController::class);
Route::resource('/resep', ResepController::class);

//Search Feature
Route::get('/searchm', [MakananController::class, 'cari'])->name('makanan.cari');
Route::get('/searchr', [ResepController::class, 'cari'])->name('resep.cari');
