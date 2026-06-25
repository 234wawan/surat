<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('master_surat')->where('kode', 'PERDIR')->update([
            'pola_nomor' => 'PERDIR/{no_urut}/PDAM/{bulan_romawi}/{tahun}',
        ]);
        DB::table('master_surat')->where('kode', 'SK')->update([
            'pola_nomor' => 'SK/{no_urut}/PDAM/{bulan_romawi}/{tahun}',
        ]);
        DB::table('master_surat')->where('kode', 'UMUM')->update([
            'pola_nomor' => '{no_urut}/PDAM/{bulan_romawi}/{tahun}',
        ]);
    }

    public function down(): void
    {
        DB::table('master_surat')->where('kode', 'PERDIR')->update([
            'pola_nomor' => 'PERDIR/{no}/{Romawi}/PDAM/{tahun}',
        ]);
        DB::table('master_surat')->where('kode', 'SK')->update([
            'pola_nomor' => 'SK/{no}/PDAM/{tahun}',
        ]);
        DB::table('master_surat')->where('kode', 'UMUM')->update([
            'pola_nomor' => '{no}/PDAM/{tahun}',
        ]);
    }
};
