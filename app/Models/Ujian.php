<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = ['mata_pelajaran_id', 'kelas_id', 'guru_id', 'kode_ujian', 'nama_ujian', 'tanggal_ujian', 'waktu_mulai', 'waktu_selesai', 'durasi', 'soal', 'status'];
    protected $casts = [
        'soal' => 'array',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
