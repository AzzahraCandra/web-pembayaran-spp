<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                ->join('spp', 'siswa.id_spp', '=', 'spp.id_spp')
                ->get();
        // $siswa = Siswa::all();
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('Content.dashboard-siswa', compact('kelas', 'spp', 'siswa'));
    }
    
    public function siswaexport()
    {
        return Excel::download(new SiswaExport, 'data-siswa.xlsx');
    }

    public function siswaimport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new SiswaImport(), $request->file('file'));

            return redirect()->back()->with('success', 'Data siswa berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetaksiswa()
    {
        $siswa = Siswa::join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                ->join('spp', 'siswa.id_spp', '=', 'spp.id_spp')
                ->get();
        // $siswa = Siswa::all();
        $kelas = Kelas::all();
        $spp = Spp::all();
        $pdf = PDF::loadView('pdf.print-siswa', compact('kelas', 'spp', 'siswa'));
        return $pdf->stream();
    }

    public function create()
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('Content.dashboard-siswa', compact('kelas', 'spp'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Siswa::create($input);
        return redirect('dashboard-siswa');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('Content.dashboard-siswa', compact('siswa', 'kelas', 'spp'));
    }
    
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id); 
        $input = $request->all();
        $siswa->update($input);
        return redirect('dashboard-siswa');
    }
    
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id); 
        $siswa->delete();
        return redirect('dashboard-siswa');
    }
}
