<?php

namespace App\Http\Controllers;

use App\Exports\SppExport;
use App\Imports\SppImport;
use App\Models\Spp;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::with('siswa')->get()->map(function ($sppData) {
            $sppData->is_used = $sppData->siswa->isNotEmpty();
            return $sppData;
        });

        return view('Content.dashboard-spp', compact('spp'));
    }

    public function sppexport()
    {
        return Excel::download(new SppExport, 'data-spp.xlsx');
    }

    public function sppimport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new SppImport(), $request->file('file'));

            return redirect()->back()->with('success', 'Data SPP berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakspp()
    {
        $spp = Spp::get();
        $pdf = PDF::loadView('pdf.print-spp', compact('spp'));
        return $pdf->stream();
    }


    public function create()
    {
        return view('Content.dashboard-spp');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Spp::create($input);
        return redirect('dashboard-spp');
    }

    public function edit($id)
    {
        $produk = Spp::findOrFail($id);
        return view('Content.dashboard-spp', compact('spp'));
    }
    
    public function update(Request $request, $id)
    {
        $produk = Spp::findOrFail($id); 
        $input = $request->all();
        $produk->update($input);
        return redirect('dashboard-spp');
    }
    
    public function destroy($id)
    {
        $produk = SPP::where('id_spp', $id)->first();  
        $produk->delete();
        return redirect('dashboard-spp');
    }
}

