<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = 'disposisi';

    protected $fillable = [
        'parent_id',
        'surat_masuk_id',
        'dari',
        'kepada',
        'instruksi',
        'instruksi_jenis',
        'catatan',
        'catatan_direksi',
        'batas_waktu',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'batas_waktu' => 'date',
        ];
    }

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'dari');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'kepada');
    }

    public function parent()
    {
        return $this->belongsTo(Disposisi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Disposisi::class, 'parent_id');
    }

    public function penerimaLainnya()
    {
        return $this->belongsToMany(User::class, 'disposisi_penerima', 'disposisi_id', 'user_id');
    }
}
