<?php
namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller {
    public function store(Request $r, Rekomendasi $rekomendasi){
        $data = $r->validate([
            'status' => 'required|in:Belum,Proses,Selesai',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string'
        ]);
        
        $newStatus = $data['status'];
        
        // State Machine Cleanup Logic
        if ($newStatus === 'Belum') {
            // Reverted to Belum: delete all Proses and Selesai history
            $rekomendasi->tindakLanjuts()->whereIn('status', ['Proses', 'Selesai'])->delete();
        } elseif ($newStatus === 'Proses') {
            // Reverted to Proses: delete all Selesai history
            $rekomendasi->tindakLanjuts()->where('status', 'Selesai')->delete();
        }
        
        // Log the new state
        $data['rekomendasi_id'] = $rekomendasi->id;
        TindakLanjut::create($data);
        
        return back()->with('success', 'Tindak lanjut berhasil dicatat.');
    }
}
