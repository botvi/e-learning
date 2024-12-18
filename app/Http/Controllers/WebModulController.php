<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
class WebModulController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $siswa = Siswa::where('user_id', $user->id)->first();
            $modul = Modul::where('kelas_id', $siswa->kelas_id)->get();
            return view('pageweb.modul', compact('modul'));
        } else {
            return redirect()->route('login');
        }
    }

}
