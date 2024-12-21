<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $ujians = Ujian::where('guru_id', $guru->id)->orderBy('created_at', 'desc')->get();

        return view('pageadmin.ujian.index', compact('ujians'));
    }

    public function create()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $mataPelajarans = MataPelajaran::where('guru_id', $guru->id)->get();
        $kelas = Kelas::all();  
        return view('pageadmin.ujian.create', compact('mataPelajarans', 'kelas'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $validated = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'kode_ujian' => 'required|string|max:255',
            'nama_ujian' => 'required|string|max:255',
            'tanggal_ujian' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'soal' => 'required|array',
            'soal.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'soal.*.pertanyaan' => 'required|string|max:255',
            'soal.*.pilihan.a' => 'required|string|max:255',
            'soal.*.pilihan.b' => 'required|string|max:255',
            'soal.*.pilihan.c' => 'required|string|max:255',
            'soal.*.pilihan.d' => 'required|string|max:255',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);

        $soalProcessed = [];

        foreach ($validated['soal'] as $soal) {
            $gambarPath = null;

            // Periksa apakah gambar diunggah
            if (isset($soal['gambar']) && $soal['gambar'] instanceof \Illuminate\Http\UploadedFile) {
                $gambarPath = $soal['gambar']->move(public_path('uploads/soal-gambar'), $soal['gambar']->getClientOriginalName());
                $gambarPath = 'uploads/soal-gambar/' . $soal['gambar']->getClientOriginalName();
            }

            // Tambahkan soal yang diproses ke array
            $soalProcessed[] = [
                'pertanyaan' => $soal['pertanyaan'],
                'gambar' => $gambarPath,
                'pilihan' => [
                    'a' => $soal['pilihan']['a'],
                    'b' => $soal['pilihan']['b'],
                    'c' => $soal['pilihan']['c'],
                    'd' => $soal['pilihan']['d'],
                ],
                'jawaban' => $soal['jawaban'],
            ];
        }

        // Simpan ujian
        $ujian = Ujian::create([
            'mata_pelajaran_id' => $validated['mata_pelajaran_id'],
            'kelas_id' => $validated['kelas_id'],
            'guru_id' => $guru->id,
            'kode_ujian' => $validated['kode_ujian'],
            'nama_ujian' => $validated['nama_ujian'],
            'tanggal_ujian' => $validated['tanggal_ujian'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'soal' => $soalProcessed, // Simpan soal yang telah diproses
            'status' => 'belum mulai',
        ]);

        Alert::toast('Ujian berhasil dibuat', 'success');
        return redirect()->route('ujian.index');
    }




    public function edit($id)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $mataPelajarans = MataPelajaran::where('guru_id', $guru->id)->get();
        $kelas = Kelas::all();
        $ujian = Ujian::find($id);
        return view('pageadmin.ujian.edit', compact('ujian', 'mataPelajarans', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        $ujian = Ujian::findOrFail($id);
    
        // Validation rules
        $validated = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'kode_ujian' => 'required|string|max:255',
            'nama_ujian' => 'required|string|max:255',
            'tanggal_ujian' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'soal' => 'required|array',
            'soal.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'soal.*.pertanyaan' => 'required|string|max:255',
            'soal.*.pilihan.a' => 'required|string|max:255',
            'soal.*.pilihan.b' => 'required|string|max:255',
            'soal.*.pilihan.c' => 'required|string|max:255',
            'soal.*.pilihan.d' => 'required|string|max:255',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);
    
        // Process soal
        $soalProcessed = [];
        foreach ($validated['soal'] as $key => $soal) {
            // Check if the 'soal' data exists for the given key in the existing 'ujian' record
            $gambarPath = null;
            if (isset($ujian->soal[$key]) && isset($ujian->soal[$key]['gambar'])) {
                // If the old image exists, use it as the default
                $gambarPath = $ujian->soal[$key]['gambar'];
            }
    
            // If the new image is uploaded, store it
            if (isset($soal['gambar']) && $soal['gambar'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete the old image if it exists
                if ($gambarPath && file_exists(public_path($gambarPath))) {
                    unlink(public_path($gambarPath));
                }
    
                // Store the new image using move
                $gambarPath = 'uploads/soal-gambar/' . time() . '-' . $soal['gambar']->getClientOriginalName();
                $soal['gambar']->move(public_path('uploads/soal-gambar'), $gambarPath);
            }
    
            // Add the processed soal to the array
            $soalProcessed[] = [
                'pertanyaan' => $soal['pertanyaan'],
                'gambar' => $gambarPath,
                'pilihan' => $soal['pilihan'],
                'jawaban' => $soal['jawaban'],
            ];
        }
    
        // Update the ujian record with the new data
        $ujian->update([
            'mata_pelajaran_id' => $validated['mata_pelajaran_id'],
            'kelas_id' => $validated['kelas_id'],
            'guru_id' => $guru->id,
            'kode_ujian' => $validated['kode_ujian'],
            'nama_ujian' => $validated['nama_ujian'],
            'tanggal_ujian' => $validated['tanggal_ujian'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'soal' => $soalProcessed,
        ]);

        // Success message and redirect
        Alert::toast('Ujian berhasil diperbarui', 'success');
        return redirect()->route('ujian.index');
    }
    
    



    public function destroy($id)
    {
        $ujian = Ujian::find($id);
        $ujian->delete();
        Alert::success('Success', 'Ujian berhasil dihapus');
        return redirect()->route('ujian.index');
    }

    public function updateStatus($id)
    {
        $ujian = Ujian::find($id);
        // Toggle status between 'sudah mulai' and 'belum mulai'
        $newStatus = $ujian->status === 'sudah mulai' ? 'belum mulai' : 'sudah mulai';
        $ujian->update(['status' => $newStatus]);

        Alert::success('Success', 'Status ujian berhasil diupdate');
        return redirect()->route('ujian.index');
    }

    public function viewSoal($id)
    {
        $ujian = Ujian::find($id);  // Find the 'ujian' by its ID
        $soal = $ujian->soal;        // Assuming 'soal' is a JSON field or an array within the 'ujian' record
        
        return view('pageadmin.ujian.view_soal', compact('soal'));
    }
    
}
