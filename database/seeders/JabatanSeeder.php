<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatan = [
            ['nama' => 'Ketua SPI', 'keterangan' => 'Ketua Satuan Pengawas Internal'],
            ['nama' => 'Kepala Bagian Administrasi & Keuangan', 'keterangan' => 'Kabag Adm & Keuangan'],
            ['nama' => 'Kepala Bagian Produksi & Distribusi', 'keterangan' => 'Kabag Produksi & Distribusi'],
            ['nama' => 'Kepala Bagian Perencanaan & Perawatan', 'keterangan' => 'Kabag Perencanaan & Perawatan'],
            ['nama' => 'Kepala Cabang', 'keterangan' => 'Kepala Cabang'],
            ['nama' => 'Kasubag Hukum & IT', 'keterangan' => 'Kepala Sub Bagian Hukum & IT'],
            ['nama' => 'Direksi', 'keterangan' => 'Direktur / Wakil Direktur'],
        ];

        foreach ($jabatan as $j) {
            Jabatan::create($j);
        }
    }
}
