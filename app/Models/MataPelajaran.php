<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajarans';
    protected $fillable = ['kode_pelajaran', 'nama_pelajaran', 'guru_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
