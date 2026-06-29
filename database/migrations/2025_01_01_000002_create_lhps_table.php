<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('lhps', function (Blueprint $table) {
            $table->id();
            $table->string('no_lhp')->unique();
            $table->date('tanggal');
            $table->string('jenis_pemeriksaan')->nullable();
            $table->foreignId('auditi_id')->constrained('auditis')->cascadeOnDelete();
            $table->string('periode')->nullable();
            $table->date('batas_tindak_lanjut')->nullable();
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('lhps'); }
};
