<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('user')->get();
        return view('pageadmin.gurus.index', compact('gurus'));
    }

    public function create()
    {
        $user = User::all();
        return view('pageadmin.gurus.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'user_id' => $user->id,
        ]);

        Alert::toast('Guru berhasil ditambahkan', 'success');
        return redirect()->route('gurus.index');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $user = User::findOrFail($guru->user_id);
        return view('pageadmin.gurus.edit', compact('guru', 'user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Update dosen
        $guru = Guru::findOrFail($id);
        $user = User::findOrFail($guru->user_id);

        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
           
        ]);

        // Update User
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        Alert::toast('Guru berhasil diubah', 'success');
        return redirect()->route('gurus.index');
    }

    

    public function destroy($id)
    {
        $guru = Guru::find($id);
        $user = User::find($guru->user_id);
        $user->delete();
        $guru->delete();
        Alert::toast('Guru berhasil dihapus', 'success');
        return redirect()->route('gurus.index');
    }
}
