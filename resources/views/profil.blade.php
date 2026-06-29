@extends('layouts.app')
@section('title', 'Profil')
@section('content')

<div class="max-w-xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Profil Saya</h2>
        <p class="text-sm text-gray-500 font-medium">Perbarui informasi profil pribadi dan kata sandi Anda.</p>
    </div>

    <!-- Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('profil.update') }}" class="space-y-6">
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
                <input id="nip" name="nip" type="text" value="{{ old('nip', $user->nip) }}" placeholder="Masukkan NIP Anda"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Kata Sandi Baru -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Kata Sandi Baru</label>
                <input id="password" name="password" type="password" placeholder="Kosongkan jika tidak diubah"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                <span class="text-xs text-gray-400 mt-1 block">Biarkan kosong jika Anda tidak ingin mengganti kata sandi.</span>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end border-t border-gray-100 pt-6">
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
