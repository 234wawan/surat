<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratKeluar extends Model
{
    use SoftDeletes;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'no_agenda',
        'no_urut',
        'no_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'lampiran',
        'isi_ringkas',
        'user_id',
        'master_surat_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function masterSurat()
    {
        return $this->belongsTo(MasterSurat::class, 'master_surat_id');
    }
}
