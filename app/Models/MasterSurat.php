<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSurat extends Model
{
    protected $table = 'master_surat';

    protected $fillable = [
        'kode',
        'nama',
        'pola_nomor',
        'keterangan',
    ];

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'master_surat_id');
    }
}
