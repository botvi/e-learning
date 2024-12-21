<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\HasilUjian;
use RealRashid\SweetAlert\Facades\Alert;
class WebUjianController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $siswa = Siswa::where('user_id', $user->id)->first();
            $ujian = Ujian::where('kelas_id', $siswa->kelas_id)->get();
            return view('pageweb.ujian', compact('ujian'));
        } else {
            return redirect()->route('login');
        }
    }

    public function mulaiUjian($id)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        // Check if the siswa has already taken the ujian
        $hasilUjianExists = HasilUjian::where('siswa_id', $siswa->id)->where('ujian_id', $id)->exists();

        if ($hasilUjianExists) {
          Alert::error('Error', 'Anda sudah mengikuti ujian ini');
          return redirect()->route('web.ujian');
        }

        $ujian = Ujian::find($id);
        $soal = $ujian->soal; 
        return view('pageweb.ujian_mulai', compact('soal', 'ujian'));
    }

    public function simpanHasilUjian(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
    
        $jawabanUser = $request->jawaban;
        $kunciJawaban = $request->kunci_jawaban;
        $guruId = $request->guru_id;

        $totalSoal = count($kunciJawaban); // Hitung jumlah total soal
        $benar = 0;
        $salah = 0;
    
        foreach ($kunciJawaban as $key => $jawabanBenar) {
            if (isset($jawabanUser[$key])) {
                if ($jawabanUser[$key] == $jawabanBenar) {
                    $benar++;
                } else {
                    $salah++;
                }
            } else {
                // Jika jawaban tidak diisi, anggap salah
                $salah++;
            }
        }
    
        // Simpan hasil ujian ke database
        $hasilUjian = new HasilUjian([
            'ujian_id' => $ujian->id,
            'siswa_id' => $siswa->id,
            'guru_id' => $guruId,
            'total_soal' => $totalSoal, // Simpan total soal
            'benar' => $benar,
            'salah' => $salah,
        ]);
        $hasilUjian->save();
    
        Alert::success('Success', 'Hasil ujian berhasil disimpan. Jawaban benar: ' . $benar . ', salah: ' . $salah . ', total soal: ' . $totalSoal);
        return redirect()->route('web.hasilUjian');
    }
    
    
}
