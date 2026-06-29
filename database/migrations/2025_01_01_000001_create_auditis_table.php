<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('auditis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kecamatan')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('auditis'); }
};
