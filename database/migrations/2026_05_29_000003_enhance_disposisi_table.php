<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('disposisi')->cascadeOnDelete()->after('id');
            $table->string('instruksi_jenis')->nullable()->after('instruksi');
            $table->text('catatan_direksi')->nullable()->after('catatan');
        });

        Schema::create('disposisi_penerima', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disposisi_id')->constrained('disposisi')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi_penerima');

        Schema::table('disposisi', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'instruksi_jenis', 'catatan_direksi']);
        });
    }
};
