<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_masuk_id')->constrained('surat_masuk')->cascadeOnDelete();
            $table->foreignId('dari')->constrained('users');
            $table->foreignId('kepada')->constrained('users');
            $table->text('instruksi')->nullable();
            $table->text('catatan')->nullable();
            $table->date('batas_waktu')->nullable();
            $table->enum('status', ['belum', 'dibaca'])->default('belum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
