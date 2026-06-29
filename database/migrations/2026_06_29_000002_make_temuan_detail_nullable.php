<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('temuans', function (Blueprint $table) {
            $table->text('kondisi')->nullable()->change();
            $table->text('sebab')->nullable()->change();
            $table->text('akibat')->nullable()->change();
            $table->text('kriteria')->nullable()->change();
            $table->decimal('nilai', 18, 2)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temuans', function (Blueprint $table) {
            $table->text('kondisi')->nullable(false)->change();
            $table->text('sebab')->nullable(false)->change();
            $table->text('akibat')->nullable(false)->change();
            $table->text('kriteria')->nullable(false)->change();
            $table->decimal('nilai', 18, 2)->nullable(false)->default(null)->change();
        });
    }
};
