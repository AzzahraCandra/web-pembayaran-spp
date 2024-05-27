<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use Illuminate\Http\Request;


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

