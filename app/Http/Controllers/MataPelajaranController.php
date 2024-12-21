<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Guru;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajarans = MataPelajaran::all();
        return view('pageadmin.mata_pelajarans.index', compact('mataPelajarans'));
    }

    public function create()
    {
        $gurus = Guru::all();
        return view('pageadmin.mata_pelajarans.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pelajaran' => 'required|string|max:255|unique:mata_pelajarans,kode_pelajaran',
            'nama_pelajaran' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
        ]);

        MataPelajaran::create($request->all());
        Alert::toast('Mata Pelajaran berhasil ditambahkan', 'success');
        return redirect()->route('mata_pelajarans.index');
    }

    public function edit($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        $gurus = Guru::all();
        return view('pageadmin.mata_pelajarans.edit', compact('mataPelajaran', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_pelajaran' => 'required|string|max:255|unique:mata_pelajarans,kode_pelajaran,' . $id,
            'nama_pelajaran' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
        ]);

        $mataPelajaran = MataPelajaran::find($id);
        $mataPelajaran->update($request->all());
        Alert::toast('Mata Pelajaran berhasil diubah', 'success');
        return redirect()->route('mata_pelajarans.index');
    }

    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        $mataPelajaran->delete();
        Alert::toast('Mata Pelajaran berhasil dihapus', 'success');
        return redirect()->route('mata_pelajarans.index');
    }
}
