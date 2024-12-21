<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
class HasilUjianController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $kelasId = $request->get('kelas');
        $mataPelajaranId = $request->get('mataPelajaran');
    
        $hasilUjianQuery = HasilUjian::query();
    
        $hasilUjianQuery->whereHas('ujian', function ($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        });
    
        if ($kelasId) {
            $hasilUjianQuery->whereHas('ujian.kelas', function ($query) use ($kelasId) {
                $query->where('id', $kelasId);
            });
        }
    
        if ($mataPelajaranId) {
            $hasilUjianQuery->whereHas('ujian.mataPelajaran', function ($query) use ($mataPelajaranId) {
                $query->where('id', $mataPelajaranId);
            });
        }
    
        $hasilUjian = $hasilUjianQuery->with(['siswa', 'ujian.kelas', 'ujian.mataPelajaran'])->orderBy('created_at', 'desc')->get();
        $kelasList = Kelas::all();
        $mataPelajaranList = MataPelajaran::where('guru_id', $guru->id)->get();
    
        return view('pageadmin.hasil_ujian.index', compact('hasilUjian', 'kelasList', 'mataPelajaranList'));
    }

}
