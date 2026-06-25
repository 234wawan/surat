<?php

namespace Database\Seeders;

use App\Models\MasterSurat;
use Illuminate\Database\Seeder;

class MasterSuratSeeder extends Seeder
{
    public function run(): void
    {
        MasterSurat::create([
            'kode' => 'PERDIR',
            'nama' => 'Peraturan Direktur',
            'pola_nomor' => 'PERDIR/{no_urut}/PDAM/{bulan_romawi}/{tahun}',
        ]);

        MasterSurat::create([
            'kode' => 'SK',
            'nama' => 'Surat Keputusan',
            'pola_nomor' => 'SK/{no_urut}/PDAM/{bulan_romawi}/{tahun}',
        ]);

        MasterSurat::create([
            'kode' => 'UMUM',
            'nama' => 'Surat Umum',
            'pola_nomor' => '{no_urut}/PDAM/{bulan_romawi}/{tahun}',
        ]);
    }
}
