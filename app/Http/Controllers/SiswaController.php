<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

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
        // $kelas = Kelas::all();
        // $spp = Spp::all();
        return view('Content.dashboard-siswa');
        //, compact('siswa', 'kelas', 'spp'));
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
