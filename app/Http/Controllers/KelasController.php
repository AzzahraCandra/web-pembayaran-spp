<?php

namespace App\Http\Controllers;

use App\Exports\KelasExport;
use App\Imports\KelasImport;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('siswa')->get()->map(function ($kls) {
            $kls->is_used = $kls->siswa->isNotEmpty();
            return $kls;
        });

        return view('Content.dashboard-kelas', compact('kelas'));
    }

    public function kelasexport()
    {
        return Excel::download(new KelasExport, 'data-kelas.xlsx');
    }

    public function kelasimport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new KelasImport(), $request->file('file'));

            return redirect()->back()->with('success', 'Data Kelas berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakkelas()
    {
        $kelas = Kelas::get();
        $pdf = PDF::loadView('pdf.print-kelas', compact('kelas'));
        return $pdf->stream();
    }

    public function create()
    {
        return view('Content.dashboard-kelas');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Kelas::create($input);
        return redirect('dashboard-kelas');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('Content.dashboard-kelas', compact('kelas'));
    }
    
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id); 
        $input = $request->all();
        $kelas->update($input);
        return redirect('dashboard-kelas');
    }
    
    public function destroy($id)
    {
        $kelas = Kelas::where('id_kelas', $id)->first(); 
        $kelas->delete();
        return redirect('dashboard-kelas');
    }
}

