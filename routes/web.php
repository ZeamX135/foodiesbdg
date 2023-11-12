<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomenController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/detail/{id}', [WelcomeController::class, 'detail'])->name('detailmakanan');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('komen.destroy');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route resource
Route::resource('/makanan', MakananController::class);

//Search Feature
Route::get('/searchm', [MakananController::class, 'cari'])->name('makanan.cari');
Route::get('/search', [WelcomeController::class, 'cari'])->name('welcome.cari');

Route::post('komen', [KomenController::class, 'store'])->name('komen.store');

require __DIR__.'/auth.php';
