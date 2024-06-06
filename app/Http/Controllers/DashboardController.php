<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahPengguna = User::count();
        $jumlahPembayaran = Pembayaran::sum('jumlah_bayar'); // Menghitung total nilai jumlah_byr

        return view('content.main-page', compact('jumlahSiswa', 'jumlahKelas', 'jumlahPengguna', 'jumlahPembayaran'));
    }
}
