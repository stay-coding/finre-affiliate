<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingMateriController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReferalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->back();
    }
    return redirect('/login');
});

Route::prefix('dashboard')->group(function () {
    // Hanya bisa diakses oleh user yang sudah login dan memiliki role afiiator
    Route::group(['middleware' => ['role:afiliator']], function () {
        Route::get('afiliator', [PagesController::class, 'dashboard_afiliator']);
        Route::get('referal', [PagesController::class, 'referal']);
        Route::get('marketing-materi', [PagesController::class, 'marketing_materi']);
        Route::get('download-materi/{id}', [MarketingMateriController::class, 'download_materi']);
        Route::get('riwayat-pembayaran', [PagesController::class, 'riwayat_pembayaran']);
        Route::resource('referal-link', ReferalController::class);
    });

    // Hanya bisa diakses oleh user yang sudah login dan memiliki role admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('admin', [PagesController::class, 'dashboard_admin']);
        Route::get('pembayaran', [PagesController::class, 'pembayaran']);
        Route::get('detail-pembayaran/{id}', [PagesController::class, 'detail_pembayaran']);
        Route::get('buat-materi', [PagesController::class, 'buat_materi']);
        Route::resource('payment', PaymentController::class);
        Route::resource('materi',  MarketingMateriController::class);
    });

    // Hanya bisa diakses oleh user yang sudah login dan memiliki role admin atau afiliator
    Route::group(['middleware' => ['role:afiliator|admin']], function () {
        Route::post('update-profile', [AuthController::class, 'update_profile']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('pengaturan', [PagesController::class, 'pengaturan']);
    });
});

// Hanya bisa diakses oleh user yang belum login
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');

    // Method Login dan Register Afiliator
    Route::prefix('auth')->group(function () {
        Route::post('afiliator/register-process', [AuthController::class, 'afiliator_register']);
        Route::post('login-process', [AuthController::class, 'login_process']);
    });
});
