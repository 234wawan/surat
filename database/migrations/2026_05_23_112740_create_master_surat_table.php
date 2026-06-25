<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_surat', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('pola_nomor')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        DB::table('master_surat')->insert([
            [
                'kode' => 'PERDIR',
                'nama' => 'Peraturan Direktur',
                'pola_nomor' => 'PERDIR/{no_urut}/PDAM/{bulan_romawi}/{tahun}',
                'keterangan' => 'Surat peraturan yang dikeluarkan oleh Direktur',
                'created_at' => now(),
            ],
            [
                'kode' => 'SK',
                'nama' => 'Surat Keputusan',
                'pola_nomor' => 'SK/{no_urut}/PDAM/{bulan_romawi}/{tahun}',
                'keterangan' => 'Surat keputusan direktur tentang kebijakan',
                'created_at' => now(),
            ],
            [
                'kode' => 'UMUM',
                'nama' => 'Surat Umum',
                'pola_nomor' => '{no_urut}/PDAM/{bulan_romawi}/{tahun}',
                'keterangan' => 'Surat dinas umum',
                'created_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_surat');
    }
};
