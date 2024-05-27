<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Uncomment these if you need them
Route::get('/main-page', function () {
    return view('content.main-page');
})->name('main-page');

Route::get('/bendahara-page', function () {
    return view('content.bendahara-page');
})->name('bendahara-page');

// Route::get('/other-page', function () {
//     return view('content.other-page');
// })->name('other-page');

Route::get('/login', function () {
    return view('content.login');
})->name('login')->middleware('guest');

Route::post('/post-login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

// Route::middleware(['auth', 'rolecek:admin,user'])->group(function () {
//     Route::get('/home', function () {
//         return view('content.main-page');
//     })->name('home');


    //////////////////////////////////////
    
    Route::group(['middleware' => 'auth', 'rolecek:admin'], function () {
        Route::get('/dashboard-pengguna', [UserController::class, 'index']);
        Route::get('/dashboard-pengguna-tambah', [UserController::class, 'create']);
        Route::post('/dashboard-pengguna-tambah', [UserController::class, 'store']);
        Route::get('/dashboard-pengguna-edit/{id}', [UserController::class, 'edit']);
        Route::put('/dashboard-pengguna-edit/{id}', [UserController::class, 'update']);
        Route::delete('/dashboard-delete-pengguna/{id}', [UserController::class, 'destroy']);

        Route::get('/dashboard-spp', [SppController::class, 'index']);
        Route::get('/dashboard-spp-tambah', [SppController::class, 'create']);
        Route::post('/dashboard-spp-tambah', [SppController::class, 'store']);
        Route::get('/dashboard-spp-edit/{id}', [SppController::class, 'edit']);
        Route::put('/dashboard-spp-edit/{id}', [SppController::class, 'update']);
        Route::delete('/dashboard-delete-spp/{id}', [SppController::class, 'destroy']);

        Route::get('/dashboard-kelas', [KelasController::class, 'index']);
        Route::get('/dashboard-kelas-tambah', [KelasController::class, 'create']);
        Route::post('/dashboard-kelas-tambah', [KelasController::class, 'store']);
        Route::get('/dashboard-kelas-edit/{id}', [KelasController::class, 'edit']);
        Route::put('/dashboard-kelas-edit/{id}', [KelasController::class, 'update']);
        Route::delete('/dashboard-delete-kelas/{id}', [KelasController::class, 'destroy']);

        Route::get('/dashboard-siswa', [SiswaController::class, 'index']);
        Route::get('/dashboard-siswa-tambah', [SiswaController::class, 'create']);
        Route::post('/dashboard-siswa-tambah', [SiswaController::class, 'store']);
        Route::get('/dashboard-siswa-edit/{id}', [SiswaController::class, 'edit']);
        Route::put('/dashboard-siswa-edit/{id}', [SiswaController::class, 'update']);
        Route::delete('/dashboard-delete-siswa/{id}', [SiswaController::class, 'destroy']);

        Route::get('/dashboard-pembayaran', [PembayaranController::class, 'index']);
        Route::get('/dashboard-pembayaran-tambah', [PembayaranController::class, 'create']);
        Route::post('/dashboard-pembayaran-tambah', [PembayaranController::class, 'store']);
        Route::get('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'edit']);
        Route::put('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'update']);
        Route::delete('/dashboard-delete-pembayaran/{id}', [PembayaranController::class, 'destroy']);
    });

    /////////////////////////////////////

    Route::group(['middleware' => 'auth', 'rolecek:bendahara'], function () {
        Route::get('/dashboard-pembayaran', [PembayaranController::class, 'index']);
        Route::get('/dashboard-pembayaran-tambah', [PembayaranController::class, 'create']);
        Route::post('/dashboard-pembayaran-tambah', [PembayaranController::class, 'store']);
        Route::get('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'edit']);
        Route::put('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'update']);
        Route::delete('/dashboard-delete-pembayaran/{id}', [PembayaranController::class, 'destroy']);
    });

    /////////////////////////////////////
    
//     Route::get('/dashboard-pengguna', [UserController::class, 'index']);
//     Route::get('/dashboard-pengguna-tambah', [UserController::class, 'create']);
//     Route::post('/dashboard-pengguna-tambah', [UserController::class, 'store']);
//     Route::get('/dashboard-pengguna-edit/{id}', [UserController::class, 'edit']);
//     Route::put('/dashboard-pengguna-edit/{id}', [UserController::class, 'update']);
//     Route::delete('/dashboard-delete-pengguna/{id}', [UserController::class, 'destroy']);

//     Route::get('/dashboard-spp', [SppController::class, 'index']);
//     Route::get('/dashboard-spp-tambah', [SppController::class, 'create']);
//     Route::post('/dashboard-spp-tambah', [SppController::class, 'store']);
//     Route::get('/dashboard-spp-edit/{id}', [SppController::class, 'edit']);
//     Route::put('/dashboard-spp-edit/{id}', [SppController::class, 'update']);
//     Route::delete('/dashboard-delete-spp/{id}', [SppController::class, 'destroy']);

//     Route::get('/dashboard-kelas', [KelasController::class, 'index']);
//     Route::get('/dashboard-kelas-tambah', [KelasController::class, 'create']);
//     Route::post('/dashboard-kelas-tambah', [KelasController::class, 'store']);
//     Route::get('/dashboard-kelas-edit/{id}', [KelasController::class, 'edit']);
//     Route::put('/dashboard-kelas-edit/{id}', [KelasController::class, 'update']);
//     Route::delete('/dashboard-delete-kelas/{id}', [KelasController::class, 'destroy']);

//     Route::get('/dashboard-siswa', [SiswaController::class, 'index']);
//     Route::get('/dashboard-siswa-tambah', [SiswaController::class, 'create']);
//     Route::post('/dashboard-siswa-tambah', [SiswaController::class, 'store']);
//     Route::get('/dashboard-siswa-edit/{id}', [SiswaController::class, 'edit']);
//     Route::put('/dashboard-siswa-edit/{id}', [SiswaController::class, 'update']);
//     Route::delete('/dashboard-delete-siswa/{id}', [SiswaController::class, 'destroy']);

//     Route::get('/dashboard-pembayaran', [PembayaranController::class, 'index']);
//     Route::get('/dashboard-pembayaran-tambah', [PembayaranController::class, 'create']);
//     Route::post('/dashboard-pembayaran-tambah', [PembayaranController::class, 'store']);
//     Route::get('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'edit']);
//     Route::put('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'update']);
//     Route::delete('/dashboard-delete-pembayaran/{id}', [PembayaranController::class, 'destroy']);
// });
