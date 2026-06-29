<?php
namespace App\Http\Controllers;

use App\Models\Temuan;
use App\Models\Lhp;
use Illuminate\Http\Request;

class TemuanController extends Controller {
    public function index(){ 
        $temuansGrouped = Temuan::with(['lhp.auditi', 'rekomendasis'])->orderBy('id', 'asc')->get()->groupBy('lhp_id'); 
        return view('temuan.index', compact('temuansGrouped')); 
    }

    public function create(Request $r){ 
        $lhps = Lhp::with('auditi')->orderBy('no_lhp')->get(); 
        $lhp_id = $r->query('lhp_id'); 
        return view('temuan.create', compact('lhps','lhp_id')); 
    }

    public function store(Request $r){
        $data = $r->validate([
            'lhp_id'=>'required|exists:lhps,id',
            'uraian'=>'required|string',
            'kategori'=>'required|in:Keuangan,Administrasi,Aset,Tata Kelola',
            'nilai'=>'nullable|numeric',
        ]);

        $data['nilai'] = $data['nilai'] ?? 0;

        $temuan = Temuan::create($data);

        return redirect()->route('temuan.show', $temuan)->with('success','Temuan berhasil ditambahkan.');
    }

    public function show(Temuan $temuan){ 
        $temuan->load('lhp','rekomendasis.tindakLanjuts'); 
        return view('temuan.show', compact('temuan')); 
    }

    public function edit(Temuan $temuan){ 
        $lhps = Lhp::with('auditi')->orderBy('no_lhp')->get(); 
        return view('temuan.edit', compact('temuan','lhps')); 
    }

    public function update(Request $r, Temuan $temuan){ 
        $data = $this->validateData($r);
        $data['nilai'] = $data['nilai'] ?? 0;
        $temuan->update($data); 
        return redirect()->route('temuan.show', $temuan)->with('success','Temuan berhasil diperbarui.'); 
    }

    public function destroy(Temuan $temuan){ 
        $temuan->delete(); 
        return redirect()->route('temuan.index')->with('success','Temuan berhasil dihapus.'); 
    }

    private function validateData(Request $r){
        return $r->validate([
            'lhp_id'=>'required|exists:lhps,id',
            'uraian'=>'required|string',
            'kategori'=>'required|in:Keuangan,Administrasi,Aset,Tata Kelola',
            'nilai'=>'nullable|numeric',
        ]);
    }
}
