<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('temuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lhp_id')->constrained('lhps')->cascadeOnDelete();
            $table->text('uraian');
            $table->string('kategori')->nullable();
            $table->decimal('nilai', 15, 2)->default(0);
            $table->text('kondisi')->nullable();
            $table->text('sebab')->nullable();
            $table->text('akibat')->nullable();
            $table->text('kriteria')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('temuans'); }
};
