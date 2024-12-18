<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('pageadmin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('pageadmin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required|string|max:255|unique:kelas,kode_kelas',
            'nama_kelas' => 'required|string|max:255',
        ]);

        Kelas::create($request->all());
        Alert::toast('Kelas berhasil ditambahkan', 'success');
        return redirect()->route('kelas.index');
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('pageadmin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kelas' => 'required|string|max:255|unique:kelas,kode_kelas,' . $id,
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        Alert::toast('Kelas berhasil diubah', 'success');
        return redirect()->route('kelas.index');
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        Alert::toast('Kelas berhasil dihapus', 'success');
        return redirect()->route('kelas.index');
    }
}
