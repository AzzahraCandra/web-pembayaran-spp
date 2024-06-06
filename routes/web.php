<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

Route::get('/', function () {
    return view('content.login');
});

Route::get('/login', function () {
    return view('content.login');
})->name('login')->middleware('guest');

Route::post('/post-login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:5|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/main-page', [DashboardController::class, 'index'])->name('main-page')->middleware('rolecek:admin');
    Route::get('/bendahara-page', [DashboardController::class, 'index'])->name('bendahara-page')->middleware('rolecek:bendahara');
    Route::get('/kepsek-page', [DashboardController::class, 'index'])->name('kepsek-page')->middleware('rolecek:kepsek');

    Route::middleware(['rolecek:admin'])->group(function () {
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
        Route::get('/cetakspp', [SppController::class, 'cetakspp']);
        Route::get('/exportspp', [SppController::class, 'sppexport'])->name('exportspp');
        Route::post('/importspp', [SppController::class, 'sppimport'])->name('importspp');

        Route::get('/dashboard-kelas', [KelasController::class, 'index']);
        Route::get('/dashboard-kelas-tambah', [KelasController::class, 'create']);
        Route::post('/dashboard-kelas-tambah', [KelasController::class, 'store']);
        Route::get('/dashboard-kelas-edit/{id}', [KelasController::class, 'edit']);
        Route::put('/dashboard-kelas-edit/{id}', [KelasController::class, 'update']);
        Route::delete('/dashboard-delete-kelas/{id}', [KelasController::class, 'destroy']);
        Route::get('/cetakkelas', [KelasController::class, 'cetakkelas']);
        Route::get('/exportkelas', [KelasController::class, 'kelasexport'])->name('exportkelas');
        Route::post('/importkelas', [KelasController::class, 'kelasimport'])->name('importkelas');

        Route::get('/dashboard-siswa', [SiswaController::class, 'index']);
        Route::get('/dashboard-siswa-tambah', [SiswaController::class, 'create']);
        Route::post('/dashboard-siswa-tambah', [SiswaController::class, 'store']);
        Route::get('/dashboard-siswa-edit/{id}', [SiswaController::class, 'edit']);
        Route::put('/dashboard-siswa-edit/{id}', [SiswaController::class, 'update']);
        Route::delete('/dashboard-delete-siswa/{id}', [SiswaController::class, 'destroy']);
        Route::get('/cetaksiswa', [SiswaController::class, 'cetaksiswa']);
        Route::get('/exportsiswa', [SiswaController::class, 'siswaexport'])->name('exportsiswa');
        Route::post('/importsiswa', [SiswaController::class, 'siswaimport'])->name('importsiswa');
    });

    Route::middleware(['rolecek:admin,bendahara'])->group(function () {
        Route::get('/dashboard-pembayaran', [PembayaranController::class, 'index']);
        Route::get('/dashboard-pembayaran-tambah', [PembayaranController::class, 'create']);
        Route::post('/dashboard-pembayaran-tambah', [PembayaranController::class, 'store']);
        Route::get('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'edit']);
        Route::put('/dashboard-pembayaran-edit/{id}', [PembayaranController::class, 'update']);
        Route::delete('/dashboard-delete-pembayaran/{id}', [PembayaranController::class, 'destroy']);
        Route::get('/cetakdatapembayaran', [PembayaranController::class, 'cetakdatapembayaran']);
        Route::get('/exportpembayaran', [PembayaranController::class, 'pembayaranexport'])->name('exportpembayaran');
        Route::post('/importpembayaran', [PembayaranController::class, 'pembayaranimport'])->name('importpembayaran');    
        Route::get('/cetakpembayaran/{id}', [PembayaranController::class, 'cetakpembayaran']);
    });

    Route::middleware(['rolecek:admin,bendahara,kepsek'])->group(function () {
        Route::get('/dashboard-pembayaran', [PembayaranController::class, 'index']);
        Route::get('/dashboard-kelas', [KelasController::class, 'index']);
        Route::get('/dashboard-siswa', [SiswaController::class, 'index']);
        Route::get('/dashboard-spp', [SppController::class, 'index']);
        Route::get('/dashboard-pengguna', [UserController::class, 'index']);
        Route::get('/history-pembayaran', [PembayaranController::class, 'history']);
        
    });



});
