<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas', 'user')->get();
        return view('pageadmin.siswas.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $user = User::all();
        return view('pageadmin.siswas.create', compact('kelas', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
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
            'role' => 'siswa',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
            'user_id' => $user->id,
        ]);

        Alert::toast('Siswa berhasil ditambahkan', 'success');
        return redirect()->route('siswas.index');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $user = User::findOrFail($siswa->user_id);
        return view('pageadmin.siswas.edit', compact('siswa', 'kelas', 'user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Update dosen
        $siswa = Siswa::findOrFail($id);
        $user = User::findOrFail($siswa->user_id);

        $siswa->update([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
           
        ]);

        // Update User
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        Alert::toast('Siswa berhasil diubah', 'success');
        return redirect()->route('siswas.index');
    }

    

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $user = User::find($siswa->user_id);
        $user->delete();
        $siswa->delete();
        Alert::toast('Siswa berhasil dihapus', 'success');
        return redirect()->route('siswas.index');
    }
}
