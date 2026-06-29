<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller {
    public function index(){ $users = User::latest()->get(); return view('user.index', compact('users')); }
    public function create(){ return view('user.create'); }
    public function store(Request $r){
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'nip'=>'nullable|string|unique:users,nip',
            'password'=>'required|min:6',
            'role'=>'required|in:admin,auditor'
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('success','Pengguna berhasil ditambahkan.');
    }
    public function edit(User $user){ return view('user.edit', compact('user')); }
    public function update(Request $r, User $user){
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'email'=>['required','email',Rule::unique('users','email')->ignore($user->id)],
            'nip'=>['nullable','string',Rule::unique('users','nip')->ignore($user->id)],
            'password'=>'nullable|min:6',
            'role'=>'required|in:admin,auditor'
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $user->update($data);
        return redirect()->route('user.index')->with('success','Pengguna berhasil diperbarui.');
    }
    public function destroy(User $user){ $user->delete(); return back()->with('success','Pengguna berhasil dihapus.'); }
    public function profil(){ return view('profil', ['user'=>auth()->user()]); }
    public function updateProfil(Request $r){
        $user = auth()->user();
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'email'=>['required','email',Rule::unique('users','email')->ignore($user->id)],
            'nip'=>['nullable','string',Rule::unique('users','nip')->ignore($user->id)],
            'password'=>'nullable|min:6'
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $user->update($data);
        return back()->with('success','Profil berhasil diperbarui.');
    }
}
