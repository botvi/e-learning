<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
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
        return view('pageadmin.mata_pelajarans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pelajaran' => 'required|string|max:255|unique:mata_pelajarans,kode_pelajaran',
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        MataPelajaran::create($request->all());
        Alert::toast('Mata Pelajaran berhasil ditambahkan', 'success');
        return redirect()->route('mata_pelajarans.index');
    }

    public function edit($id)
    {
        $mataPelajaran = MataPelajaran::find($id);
        return view('pageadmin.mata_pelajarans.edit', compact('mataPelajaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_pelajaran' => 'required|string|max:255|unique:mata_pelajarans,kode_pelajaran,' . $id,
            'nama_pelajaran' => 'required|string|max:255',
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
