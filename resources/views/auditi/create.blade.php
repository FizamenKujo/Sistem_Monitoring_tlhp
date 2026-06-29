@extends('layouts.app')
@section('title', 'Tambah Auditi')
@section('content')

<div class="max-w-xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Tambah Auditi</h2>
            <p class="text-sm text-gray-500 font-medium">Buat data objek pemeriksaan baru.</p>
        </div>
        <a href="{{ route('auditi.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('auditi.store') }}" class="space-y-6">
            @csrf 
            
            <!-- Nama Auditi -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Auditi</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama','') }}" required placeholder="Nama Instansi/Dinas/Desa"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Kecamatan -->
            <div>
                <label for="kecamatan" class="block text-sm font-semibold text-gray-700 mb-1.5">Kecamatan</label>
                <input id="kecamatan" name="kecamatan" type="text" value="{{ old('kecamatan','') }}" placeholder="Nama Kecamatan"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Penanggung Jawab -->
            <div>
                <label for="penanggung_jawab" class="block text-sm font-semibold text-gray-700 mb-1.5">Penanggung Jawab</label>
                <input id="penanggung_jawab" name="penanggung_jawab" type="text" value="{{ old('penanggung_jawab','') }}" placeholder="Nama Kepala Dinas / Kepala Desa"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('auditi.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
                    Simpan Auditi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
