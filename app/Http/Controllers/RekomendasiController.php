<?php
namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use App\Models\Lhp;
use App\Models\Temuan;
use Illuminate\Http\Request;

class RekomendasiController extends Controller {
    public function index(){
        $rekomendasisGrouped = Rekomendasi::with('lhp.auditi', 'tindakLanjuts')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('lhp_id');
        return view('rekomendasi.index', compact('rekomendasisGrouped'));
    }

    public function create(Request $r){
        $lhp_id = $r->query('lhp_id');
        $temuan_id = $r->query('temuan_id');
        
        // If temuan_id is passed, get its lhp_id automatically
        if ($temuan_id) {
            $temuan = Temuan::find($temuan_id);
            if ($temuan) {
                $lhp_id = $temuan->lhp_id;
            }
        }
        
        $lhps = Lhp::orderBy('no_lhp')->get();
        $temuans = Temuan::orderBy('id')->get();
        
        return view('rekomendasi.create', compact('lhp_id', 'temuan_id', 'lhps', 'temuans'));
    }
    
    public function store(Request $r){
        $data = $r->validate([
            'lhp_id' => 'required|exists:lhps,id',
            'temuan_id' => 'nullable|exists:temuans,id',
            'ditujukan_kepada' => 'required|string|max:255',
            'uraian_rekomendasi' => 'required|string',
            'target_waktu' => 'nullable|date'
        ]);
        
        $rek = Rekomendasi::create($data);
        return redirect()->route('lhp.show', $rek->lhp_id)->with('success', 'Rekomendasi berhasil ditambahkan.');
    }
    
    public function show(Rekomendasi $rekomendasi){
        $rekomendasi->load('lhp', 'temuan', 'tindakLanjuts');
        return view('rekomendasi.show', compact('rekomendasi'));
    }
    
    public function edit(Rekomendasi $rekomendasi){
        $lhps = Lhp::orderBy('no_lhp')->get();
        $temuans = Temuan::orderBy('id')->get();
        return view('rekomendasi.edit', compact('rekomendasi', 'lhps', 'temuans'));
    }
    
    public function update(Request $r, Rekomendasi $rekomendasi){
        $data = $r->validate([
            'lhp_id' => 'required|exists:lhps,id',
            'temuan_id' => 'nullable|exists:temuans,id',
            'ditujukan_kepada' => 'required|string|max:255',
            'uraian_rekomendasi' => 'required|string',
            'target_waktu' => 'nullable|date'
        ]);
        
        $rekomendasi->update($data);
        return redirect()->route('lhp.show', $rekomendasi->lhp_id)->with('success', 'Rekomendasi berhasil diperbarui.');
    }
    
    public function destroy(Rekomendasi $rekomendasi){
        $lhp_id = $rekomendasi->lhp_id;
        $rekomendasi->delete();
        return redirect()->route('lhp.show', $lhp_id)->with('success', 'Rekomendasi berhasil dihapus.');
    }
}
