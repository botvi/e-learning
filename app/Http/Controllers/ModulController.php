<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::with('mata_pelajaran', 'kelas')->get();
        return view('pageadmin.modul.index', compact('moduls'));
    }

    public function create()
    {
        $mataPelajarans = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('pageadmin.modul.create', compact('mataPelajarans', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'nama_modul' => 'required',
            'kode_modul' => 'required|unique:moduls,kode_modul',
            'deskripsi' => 'required',
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        if (!$file || !$file->isValid()) {
            Alert::toast('File upload failed or file is missing', 'error');
            return back()->withErrors('File upload failed or file is missing');
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('modul'), $filename);

        Modul::create([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'nama_modul' => $request->nama_modul,
            'kode_modul' => $request->kode_modul,
            'deskripsi' => $request->deskripsi,
            'file' => $filename,
        ]);

        Alert::toast('Modul berhasil ditambahkan', 'success');
        return redirect()->route('modul.index');
    }

    public function edit($id)
    {
        $modul = Modul::find($id);
        $mataPelajarans = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('pageadmin.modul.edit', compact('modul', 'mataPelajarans', 'kelas'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_pelajaran_id' => 'required',
            'kelas_id' => 'required',
            'nama_modul' => 'required',
            'kode_modul' => 'required|unique:moduls,kode_modul,' . $id,
            'deskripsi' => 'required',
            'file' => 'nullable|file',
        ]);

        $modul = Modul::findOrFail($id);

        $filename = $modul->file; // Default ke file yang sudah ada

        $file = $request->file('file');
        if ($file) {
            if (!$file->isValid()) {
                Alert::toast('File upload failed', 'error');
                return back()->withErrors('File upload failed');
            }

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('modul'), $filename);

            // Hapus file lama jika ada
            if (file_exists(public_path('modul/' . $modul->file))) {
                unlink(public_path('modul/' . $modul->file));
            }
        }

        $modul->update([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'nama_modul' => $request->nama_modul,
            'kode_modul' => $request->kode_modul,
            'deskripsi' => $request->deskripsi,
            'file' => $filename,
        ]);

        Alert::toast('Modul berhasil diubah', 'success');
        return redirect()->route('modul.index');
    }


    public function destroy($id)
    {
        $modul = Modul::find($id);
        $modul->delete();
        Alert::toast('Modul berhasil dihapus', 'success');
        return redirect()->route('modul.index');
    }
}
