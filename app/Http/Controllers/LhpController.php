<?php
namespace App\Http\Controllers;

use App\Models\Lhp;
use App\Models\Auditi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LhpController extends Controller {
    public function index(){ $lhps = Lhp::with(['auditi', 'temuans', 'rekomendasis'])->latest()->get(); return view('lhp.index', compact('lhps')); }
    
    public function create(){ $auditis = Auditi::orderBy('nama')->get(); return view('lhp.create', compact('auditis')); }
    
    public function store(Request $r){
        $data = $this->validateData($r);
        
        if ($r->hasFile('file_pdf')) {
            $file = $r->file('file_pdf');
            if (!$file->isValid()) {
                return back()->withErrors(['file_pdf' => 'File PDF tidak valid: ' . $file->getErrorMessage()])->withInput();
            }
            
            $realPath = $file->getRealPath();
            if ($realPath === false || empty($realPath)) {
                $pathname = $file->getPathname();
                if (file_exists($pathname)) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $destinationPath = storage_path('app/public/lhp/' . $fileName);
                    if (!file_exists(dirname($destinationPath))) {
                        mkdir(dirname($destinationPath), 0777, true);
                    }
                    if (copy($pathname, $destinationPath)) {
                        $data['file_pdf'] = 'lhp/' . $fileName;
                    } else {
                        return back()->withErrors(['file_pdf' => 'Gagal menyalin file dari path sementara.'])->withInput();
                    }
                } else {
                    return back()->withErrors(['file_pdf' => 'File sementara tidak ditemukan di disk server. Silakan coba unggah kembali.'])->withInput();
                }
            } else {
                $data['file_pdf'] = $file->store('lhp', 'public');
            }
        }
        
        Lhp::create($data);
        return redirect()->route('lhp.index')->with('success','LHP berhasil ditambahkan.');
    }
    
    public function show(Lhp $lhp){ $lhp->load('auditi','temuans.rekomendasis.tindakLanjuts'); return view('lhp.show', compact('lhp')); }
    
    public function edit(Lhp $lhp){ $auditis = Auditi::orderBy('nama')->get(); return view('lhp.edit', compact('lhp','auditis')); }
    
    public function update(Request $r, Lhp $lhp){
        $data = $this->validateData($r, $lhp->id);
        
        // Prevent overwriting existing PDF file path in DB with NULL if no new file is uploaded
        unset($data['file_pdf']);
        
        if ($r->hasFile('file_pdf')) {
            $file = $r->file('file_pdf');
            if (!$file->isValid()) {
                return back()->withErrors(['file_pdf' => 'File PDF tidak valid: ' . $file->getErrorMessage()])->withInput();
            }
            
            $realPath = $file->getRealPath();
            if ($realPath === false || empty($realPath)) {
                $pathname = $file->getPathname();
                if (file_exists($pathname)) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $destinationPath = storage_path('app/public/lhp/' . $fileName);
                    if (!file_exists(dirname($destinationPath))) {
                        mkdir(dirname($destinationPath), 0777, true);
                    }
                    if (copy($pathname, $destinationPath)) {
                        if ($lhp->file_pdf) Storage::disk('public')->delete($lhp->file_pdf);
                        $data['file_pdf'] = 'lhp/' . $fileName;
                    } else {
                        return back()->withErrors(['file_pdf' => 'Gagal menyalin file dari path sementara.'])->withInput();
                    }
                } else {
                    return back()->withErrors(['file_pdf' => 'File sementara tidak ditemukan di disk server. Silakan coba unggah kembali.'])->withInput();
                }
            } else {
                if ($lhp->file_pdf) Storage::disk('public')->delete($lhp->file_pdf);
                $data['file_pdf'] = $file->store('lhp', 'public');
            }
        }
        
        $lhp->update($data);
        return redirect()->route('lhp.index')->with('success','LHP berhasil diperbarui.');
    }
    
    public function destroy(Lhp $lhp){
        if ($lhp->file_pdf) Storage::disk('public')->delete($lhp->file_pdf);
        $lhp->delete();
        return back()->with('success','LHP berhasil dihapus.');
    }
    
    private function validateData(Request $r, $id=null){
        return $r->validate([
            'no_lhp'=>'required|string|max:255|unique:lhps,no_lhp'.($id?(',').$id:''),
            'tanggal'=>'required|date',
            'jenis_pemeriksaan'=>'nullable|string|max:255',
            'auditi_id'=>'required|exists:auditis,id',
            'periode'=>'nullable|string|max:255',
            'batas_tindak_lanjut'=>'nullable|date',
            'file_pdf'=>'nullable|file|mimes:pdf|max:10240',
        ]);
    }
}
