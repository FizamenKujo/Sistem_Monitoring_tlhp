@extends('layouts.app')
@section('title', 'Tambah LHP')
@section('content')

<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Tambah LHP</h2>
            <p class="text-sm text-gray-500 font-medium">Buat dokumen Laporan Hasil Pemeriksaan (LHP) baru.</p>
        </div>
        <a href="{{ route('lhp.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('lhp.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf 
            
            <!-- Nomor LHP -->
            <div>
                <label for="no_lhp" class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor LHP</label>
                <input id="no_lhp" name="no_lhp" type="text" value="{{ old('no_lhp','') }}" required placeholder="Contoh: LHP/01/XII/2023"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal LHP -->
                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal LHP</label>
                    <input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal','') }}" required
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                </div>

                <!-- Batas Tindak Lanjut -->
                <div>
                    <label for="batas_tindak_lanjut" class="block text-sm font-semibold text-gray-700 mb-1.5">Batas Tindak Lanjut</label>
                    <input id="batas_tindak_lanjut" name="batas_tindak_lanjut" type="date" value="{{ old('batas_tindak_lanjut','') }}"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Auditi -->
            <div>
                <label for="auditi_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Auditi (Objek Pemeriksaan)</label>
                <select id="auditi_id" name="auditi_id" required
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                    <option value="">- Pilih Auditi -</option>
                    @foreach($auditis as $au)
                    <option value="{{ $au->id }}" {{ (string)old('auditi_id','') === (string)$au->id ? 'selected' : '' }}>
                        {{ $au->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jenis Pemeriksaan -->
                <div>
                    <label for="jenis_pemeriksaan" class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Pemeriksaan</label>
                    <input id="jenis_pemeriksaan" name="jenis_pemeriksaan" type="text" value="{{ old('jenis_pemeriksaan','') }}" placeholder="mis. PDTT, Reguler, Investigasi"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                </div>

                <!-- Periode -->
                <div>
                    <label for="periode" class="block text-sm font-semibold text-gray-700 mb-1.5">Periode Pemeriksaan</label>
                    <input id="periode" name="periode" type="text" value="{{ old('periode','') }}" placeholder="mis. Tahun Anggaran 2023"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                </div>
            </div>

            <!-- File PDF LHP (opsional) -->
            <div>
                <label for="file_pdf" class="block text-sm font-semibold text-gray-700 mb-1.5">File PDF LHP (opsional)</label>
                <input id="file_pdf" name="file_pdf" type="file" accept="application/pdf"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all border border-gray-300 rounded-xl bg-gray-50 p-2 focus:outline-none">
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('lhp.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
                    Simpan LHP
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
