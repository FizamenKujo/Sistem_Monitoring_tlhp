<?php
namespace App\Http\Controllers;

use App\Models\Auditi;
use App\Models\Lhp;
use App\Models\Temuan;
use App\Models\Rekomendasi;

class DashboardController extends Controller {
    public function index() {
        $totalAuditi = Auditi::count();
        $totalLhp = Lhp::count();
        $totalTemuan = Temuan::count();
        $totalRekomendasi = Rekomendasi::count();
        $totalNilai = Temuan::sum('nilai');
        
        $belum = 0; $proses = 0; $selesai = 0;
        foreach (Rekomendasi::with('tindakLanjuts')->get() as $r) {
            $s = $r->status_terkini;
            if ($s === 'Selesai') $selesai++;
            elseif ($s === 'Proses') $proses++;
            else $belum++;
        }

        // Fetch count of temuans per kategori
        $temuanPerKategori = Temuan::selectRaw('kategori, count(*) as total')
            ->whereNotNull('kategori')
            ->where('kategori', '<>', '')
            ->groupBy('kategori')
            ->get()
            ->pluck('total', 'kategori')
            ->toArray();

        // If category is empty, set default categories so the chart doesn't look blank
        if (empty($temuanPerKategori)) {
            $temuanPerKategori = ['Keuangan' => 0, 'Administrasi' => 0];
        }

        return view('dashboard', compact(
            'totalAuditi',
            'totalLhp',
            'totalTemuan',
            'totalRekomendasi',
            'totalNilai',
            'belum',
            'proses',
            'selesai',
            'temuanPerKategori'
        ));
    }
}
