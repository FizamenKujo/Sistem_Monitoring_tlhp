<?php
namespace App\Http\Controllers;
use App\Models\Auditi;
use Illuminate\Http\Request;
class AuditiController extends Controller {
    public function index(){ $auditis = Auditi::latest()->get(); return view('auditi.index', compact('auditis')); }
    public function create(){ return view('auditi.create'); }
    public function store(Request $r){
        $data = $r->validate(['nama'=>'required|string|max:255','kecamatan'=>'nullable|string|max:255','penanggung_jawab'=>'nullable|string|max:255']);
        Auditi::create($data);
        return redirect()->route('auditi.index')->with('success','Data auditi berhasil ditambahkan.');
    }
    public function edit(Auditi $auditi){ return view('auditi.edit', compact('auditi')); }
    public function update(Request $r, Auditi $auditi){
        $data = $r->validate(['nama'=>'required|string|max:255','kecamatan'=>'nullable|string|max:255','penanggung_jawab'=>'nullable|string|max:255']);
        $auditi->update($data);
        return redirect()->route('auditi.index')->with('success','Data auditi berhasil diperbarui.');
    }
    public function destroy(Auditi $auditi){ $auditi->delete(); return back()->with('success','Data auditi berhasil dihapus.'); }
}
