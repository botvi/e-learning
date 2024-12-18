<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class WebHasilUjianController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $siswa = Siswa::where('user_id', $user->id)->first();
            $hasilUjian = HasilUjian::where('siswa_id', $siswa->id)->with('ujian', 'siswa', 'mataPelajaran')->orderBy('created_at', 'desc')->get();
            return view('pageweb.hasil_ujian', compact('hasilUjian'));
        } else {
            return redirect()->route('login');
        }
    }
}
