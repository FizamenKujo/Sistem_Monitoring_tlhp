<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::table('rekomendasis', function (Blueprint $table) {
            $table->foreignId('lhp_id')->nullable()->constrained('lhps')->cascadeOnDelete();
            $table->string('ditujukan_kepada')->nullable();
            $table->unsignedBigInteger('temuan_id')->nullable()->change();
        });

        // Migrate existing recommendations data by pulling lhp_id from their related temuan
        $rekomendasis = DB::table('rekomendasis')->get();
        foreach ($rekomendasis as $rek) {
            if ($rek->temuan_id) {
                $temuan = DB::table('temuans')->where('id', $rek->temuan_id)->first();
                if ($temuan) {
                    DB::table('rekomendasis')->where('id', $rek->id)->update([
                        'lhp_id' => $temuan->lhp_id,
                    ]);
                }
            }
        }
    }

    public function down(): void {
        Schema::table('rekomendasis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('lhp_id');
            $table->dropColumn('ditujukan_kepada');
            $table->unsignedBigInteger('temuan_id')->nullable(false)->change();
        });
    }
};
