@extends('layouts.app')
@section('title', 'Tambah Rekomendasi')
@section('content')

<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Tambah Rekomendasi</h2>
            <p class="text-sm text-gray-500 font-medium">Buat rekomendasi tindak lanjut baru di tingkat LHP.</p>
        </div>
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('rekomendasi.store') }}" class="space-y-6">
            @csrf 
            
            <!-- LHP Selection -->
            <div>
                <label for="lhp_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Laporan Hasil Pemeriksaan (LHP)</label>
                <select id="lhp_id" name="lhp_id" required
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                    <option value="">- Pilih LHP -</option>
                    @foreach($lhps as $l)
                    <option value="{{ $l->id }}" {{ (string)old('lhp_id', $lhp_id ?? '') === (string)$l->id ? 'selected' : '' }}>
                        {{ $l->no_lhp }} (Auditi: {{ $l->auditi->nama ?? '-' }})
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Ditujukan Kepada -->
            <div>
                <label for="ditujukan_kepada" class="block text-sm font-semibold text-gray-700 mb-1.5">Ditujukan Kepada</label>
                <input id="ditujukan_kepada" name="ditujukan_kepada" type="text" required value="{{ old('ditujukan_kepada') }}"
                    placeholder="misal: Kepala Desa, Camat, Plt. Kepala Desa"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
            </div>

            <!-- Uraian Rekomendasi -->
            <div>
                <label for="uraian_rekomendasi" class="block text-sm font-semibold text-gray-700 mb-1.5">Uraian Rekomendasi</label>
                <textarea id="uraian_rekomendasi" name="uraian_rekomendasi" rows="4" required placeholder="Masukkan uraian rekomendasi..."
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">{{ old('uraian_rekomendasi') }}</textarea>
            </div>

            <!-- Target Waktu -->
            <div>
                <label for="target_waktu" class="block text-sm font-semibold text-gray-700 mb-1.5">Target Waktu Penyelesaian</label>
                <input id="target_waktu" name="target_waktu" type="date" value="{{ old('target_waktu') }}"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ url()->previous() }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
                    Simpan Rekomendasi
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
