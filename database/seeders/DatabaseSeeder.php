<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Auditi;
use App\Models\Lhp;
use App\Models\Temuan;
use App\Models\Rekomendasi;
use App\Models\TindakLanjut;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create(['name'=>'Administrator','email'=>'admin@inspektorat.go.id','nip'=>'198001012005011001','password'=>Hash::make('password'),'role'=>'admin']);
        User::create(['name'=>'Auditor Satu','email'=>'auditor@inspektorat.go.id','nip'=>'198501012010011002','password'=>Hash::make('password'),'role'=>'auditor']);
        $auditi = Auditi::create(['nama'=>'UPT SPF SD Negeri 104186 Tanjung Selamat','kecamatan'=>'Sunggal','penanggung_jawab'=>'Kepala Sekolah']);
        $lhp = Lhp::create(['no_lhp'=>'700.1.2.1/LHP.200/INSP/2025','tanggal'=>'2025-11-26','jenis_pemeriksaan'=>'PDTT','auditi_id'=>$auditi->id,'periode'=>'10-14 November 2025','batas_tindak_lanjut'=>'2025-12-26']);
        $t1 = Temuan::create(['lhp_id'=>$lhp->id,'uraian'=>'PPN belum disetor ke kas negara','kategori'=>'Keuangan','nilai'=>1446846,'kondisi'=>'Terdapat PPN yang belum disetorkan ke kas negara']);
        Rekomendasi::create(['temuan_id'=>$t1->id,'uraian_rekomendasi'=>'Menyetorkan PPN sebesar Rp1.446.846 ke kas negara','target_waktu'=>'2025-12-26']);
        $t2 = Temuan::create(['lhp_id'=>$lhp->id,'uraian'=>'Belanja tanpa bukti pertanggungjawaban','kategori'=>'Keuangan','nilai'=>3000000]);
        $r2 = Rekomendasi::create(['temuan_id'=>$t2->id,'uraian_rekomendasi'=>'Melengkapi bukti pertanggungjawaban belanja sebesar Rp3.000.000','target_waktu'=>'2025-12-26']);
        TindakLanjut::create(['rekomendasi_id'=>$r2->id,'status'=>'Proses','tanggal'=>'2025-12-10','keterangan'=>'Sedang melengkapi dokumen pertanggungjawaban']);
        $t3 = Temuan::create(['lhp_id'=>$lhp->id,'uraian'=>'Selisih pencatatan BKU dengan SPJ','kategori'=>'Administrasi','nilai'=>3794000,'kondisi'=>'BKU Rp30.674.500 tidak sesuai SPJ Rp34.468.500']);
        Rekomendasi::create(['temuan_id'=>$t3->id,'uraian_rekomendasi'=>'Memperbaiki pencatatan BKU agar sesuai dengan SPJ','target_waktu'=>'2025-12-26']);
    }
}
