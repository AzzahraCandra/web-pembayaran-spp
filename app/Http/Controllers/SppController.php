<?php

namespace App\Http\Controllers;
use App\Models\Spp;
use Illuminate\Http\Request;

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

