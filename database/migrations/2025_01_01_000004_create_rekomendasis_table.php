<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temuan_id')->constrained('temuans')->cascadeOnDelete();
            $table->text('uraian_rekomendasi');
            $table->date('target_waktu')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('rekomendasis'); }
};
