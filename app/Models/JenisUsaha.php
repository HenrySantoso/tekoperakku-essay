<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    protected $table = 'jenis_usaha';
    protected $fillable = [
        'kode_jenis_usaha',
        'nama_jenis_usaha',
    ];

    /* ================= RELATIONS ================= */

    public function usahaJenis()
    {
        return $this->hasMany(UsahaJenis::class, 'jenis_usaha_id');
    }
}
