<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::all();
        return view('Content.dashboard-pengguna', $data);
    }

    public function create()
    {
        return view('Content.dashboard-pengguna');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
            'level' => 'required|in:kepsek,admin,bendahara,siswa',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->input('password'));

        User::create($input);

        return redirect('/dashboard-pengguna');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Content.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'level' => 'required|in:kepsek,admin,bendahara,siswa',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('/dashboard-pengguna');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/dashboard-pengguna');
    }
}
