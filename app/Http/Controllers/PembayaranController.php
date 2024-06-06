<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Imports\PembayaranImport;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Facades\Excel;

// use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade as PDF;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::join('siswa', 'pembayaran.id', '=', 'siswa.id')
            // ->join('spp', 'siswa.id_spp', '=', 'spp.id_spp')
            ->join('users', 'pembayaran.id', '=', 'users.id')

            ->get();
        // $siswa = Siswa::all();
        $pembayaran = Pembayaran::with('siswa', 'user')->get();
        $siswa = Siswa::all();
        $user = User::all();
        $spp = Spp::all();  // Ambil data SPP
        return view('Content.dashboard-pembayaran', compact('siswa', 'user', 'pembayaran', 'spp'));
    }


    public function cetakdatapembayaran()
    {
        $pembayaran = Pembayaran::join('siswa', 'pembayaran.id', '=', 'siswa.id')
            ->join('users', 'pembayaran.id', '=', 'users.id')

            ->first();
        $pembayaran = Pembayaran::with('siswa', 'user')->get();
        $siswa = Siswa::all();
        $user = User::all();
        $spp = Spp::all();
        $pdf = PDF::loadView('pdf.print-pembayaran', compact('siswa', 'user', 'pembayaran', 'spp'));
        return $pdf->stream();
    }

    public function cetakpembayaran($id)
    {
        $pembayaran = Pembayaran::join('siswa', 'pembayaran.id', '=', 'siswa.id')
            ->join('users', 'pembayaran.id', '=', 'users.id')

            ->first();
        $pembayaran = Pembayaran::with('siswa', 'user')->get();
        $siswa = Siswa::all();
        $user = User::all();
        $spp = Spp::all();
        $pdf = PDF::loadView('pdf.bukti-pembayaran', compact('siswa', 'user', 'pembayaran', 'spp'));
        return $pdf->stream();
    }

    public function pembayaranexport()
    {
        return Excel::download(new PembayaranExport, 'pembayaran.xlsx');
    }

    public function pembayaranimport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new PembayaranImport(), $request->file('file'));

            return redirect()->back()->with('success', 'Data Pembayaran berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function history()
    {
        $pembayaran = Pembayaran::with('siswa.spp')->get();
        $siswa = Siswa::all();
        return view('Content.history-pembayaran', compact('pembayaran', 'siswa'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $user = User::all();
        return view('Content.dashboard-pembayaran-create', compact('siswa', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'jarak_bulan' => 'required|numeric',
        ]);

        $siswa = Siswa::where('nisn', $request->nisn)->first();

        if ($siswa) {
            $nominalSPP = $siswa->spp->nominal;
            $jumlahBayar = $request->jarak_bulan * $nominalSPP;

            Pembayaran::create([
                'petugas' => $request->petugas,
                'nisn' => $request->nisn,
                'tgl_byr' => $request->tgl_byr,
                'bulan_awal' => $request->bulan_awal,
                'bulan_akhir' => $request->bulan_akhir,
                'tahun_dibayar' => $request->tahun_dibayar,
                'jumlah_bayar' => $jumlahBayar,
            ]);

            return redirect('dashboard-pembayaran')->with('success', 'Pembayaran berhasil disimpan');
        } else {
            return redirect('dashboard-pembayaran')->with('error', 'Siswa tidak ditemukan');
        }
    }

    public function edit($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $siswa = Siswa::all();
            $user = User::all();
            return view('Content.dashboard-pembayaran-edit', compact('pembayaran', 'siswa', 'user'));
        } catch (\Exception $e) {
            return redirect('dashboard-pembayaran')->with('error', 'Gagal menemukan data pembayaran.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'jarak_bulan' => 'required|numeric',
            'petugas' => 'required',
            'tgl_byr' => 'required|date',
            'bulan_awal' => 'required',
            'bulan_akhir' => 'required',
            'tahun_dibayar' => 'required|numeric',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->nisn = $request->input('nisn');
        $pembayaran->petugas = $request->input('petugas');
        $pembayaran->tgl_byr = $request->input('tgl_byr');
        $pembayaran->bulan_awal = $request->input('bulan_awal');
        $pembayaran->bulan_akhir = $request->input('bulan_akhir');
        $pembayaran->tahun_dibayar = $request->input('tahun_dibayar');

        $siswa = Siswa::where('nisn', $request->nisn)->first();
        if ($siswa) {
            $nominalSPP = $siswa->spp->nominal;
            $pembayaran->jumlah_bayar = $request->jarak_bulan * $nominalSPP;
            $pembayaran->save();
            return redirect('dashboard-pembayaran')->with('success', 'Data pembayaran berhasil diperbarui.');
        } else {
            return redirect('dashboard-pembayaran')->with('error', 'Siswa tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect('dashboard-pembayaran')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
