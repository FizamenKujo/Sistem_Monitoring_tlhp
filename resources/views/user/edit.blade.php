@extends('layouts.app')
@section('title', 'Edit Pengguna')
@section('content')

<div class="max-w-xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Edit Pengguna</h2>
            <p class="text-sm text-gray-500 font-medium">Ubah informasi akun pengguna (Administrator atau Auditor).</p>
        </div>
        <a href="{{ route('user.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('user.update', $user) }}" class="space-y-6">
            @csrf 
            @method('PUT')
            
            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- NIP -->
            <div>
                <label for="nip" class="block text-sm font-semibold text-gray-700 mb-1.5">NIP (Nomor Induk Pegawai)</label>
                <input id="nip" name="nip" type="text" value="{{ old('nip', $user->nip) }}" placeholder="Masukkan NIP (opsional)"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Kata Sandi -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Kata Sandi</label>
                <input id="password" name="password" type="password" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                <span class="text-xs text-gray-400 mt-1 block">Biarkan kosong jika Anda tidak ingin mengganti kata sandi.</span>
            </div>

            <!-- Peran -->
            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-1.5">Peran</label>
                <select id="role" name="role" required
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                    <option value="auditor" {{ old('role', $user->role) === 'auditor' ? 'selected' : '' }}>Auditor</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('user.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
