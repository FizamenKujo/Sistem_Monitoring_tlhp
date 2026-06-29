<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditiController;
use App\Http\Controllers\LhpController;
use App\Http\Controllers\TemuanController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\UserController;

Route::get('/', function() {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('welcome');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('lhp', LhpController::class);
    Route::resource('temuan', TemuanController::class);
    Route::resource('rekomendasi', RekomendasiController::class);
    Route::post('rekomendasi/{rekomendasi}/tindak-lanjut', [TindakLanjutController::class, 'store'])->name('tindak-lanjut.store');
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::put('/profil', [UserController::class, 'updateProfil'])->name('profil.update');
    Route::middleware('role:admin')->group(function () {
        Route::resource('auditi', AuditiController::class);
        Route::resource('user', UserController::class);
    });
});
