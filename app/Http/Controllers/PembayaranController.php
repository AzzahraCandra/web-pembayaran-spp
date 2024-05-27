<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::join('siswa', 'pembayaran.id', '=', 'siswa.id')
            ->join('users', 'pembayaran.id', '=', 'users.id')
            ->get();
        // $siswa = Siswa::all();
        $pembayaran = Pembayaran::with('siswa', 'user')->get();
        $siswa = Siswa::all();
        $user = User::all();
        return view('Content.dashboard-pembayaran', compact('siswa', 'user', 'pembayaran'));
    }

    // public function create()
    // {
    //     $siswa = Siswa::all();
    //     $user = User::all();
    //     return view('Content.dashboard-pembayaran', compact('siswa', 'users'));
    // }

    public function create()
    {
        $siswa = Siswa::all();
        return view('Content.dashboard-pembayaran', compact('siswa'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $input['petugas'] = $user->name . ' (' . ucfirst($user->level) . ')';
        Pembayaran::create($input);
        return redirect('dashboard-pembayaran')->with('success', 'Pembayaran berhasil ditambahkan.');
    }


    // public function store(Request $request)
    // {
    //     $input = $request->all();
    //     Pembayaran::create($input);
    //     return redirect('dashboard-pembayaran');
    // }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        // $kelas = Kelas::all();
        // $spp = Spp::all();
        return view('Content.dashboard-pembayaran');
        //, compact('siswa', 'kelas', 'spp'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $input = $request->all();
        $pembayaran->update($input);
        return redirect('dashboard-pembayaran');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect('dashboard-pembayaran');
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolecek:admin,bendahara')->only(['create', 'store']);
    }
}
