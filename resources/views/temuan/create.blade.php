@extends('layouts.app')
@section('title', 'Tambah Temuan')
@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Tambah Temuan</h2>
            <p class="text-sm text-gray-500">Buat data temuan pemeriksaan baru.</p>
        </div>
        <a href="{{ route('temuan.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('temuan.store') }}" class="space-y-6">
            @csrf 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- LHP Selection -->
                <div class="md:col-span-2">
                    <label for="lhp_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Laporan Hasil Pemeriksaan (LHP)</label>
                    <select id="lhp_id" name="lhp_id" required
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                        <option value="">- Pilih LHP -</option>
                        @foreach($lhps as $l)
                        <option value="{{ $l->id }}" {{ (string)old('lhp_id', ($lhp_id ?? '')) === (string)$l->id ? 'selected' : '' }}>
                            {{ $l->no_lhp }} (Auditi: {{ $l->auditi->nama ?? '-' }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Uraian Temuan -->
                <div class="md:col-span-2">
                    <label for="uraian" class="block text-sm font-semibold text-gray-700 mb-1.5">Uraian Temuan</label>
                    <textarea id="uraian" name="uraian" rows="3" required placeholder="Tuliskan uraian temuan pemeriksaan..."
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">{{ old('uraian','') }}</textarea>
                </div>

                <!-- Kategori Dropdown -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                    <select id="kategori" name="kategori" required
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                        <option value="">- Pilih Kategori -</option>
                        @foreach(['Keuangan', 'Administrasi', 'Aset', 'Tata Kelola'] as $cat)
                        <option value="{{ $cat }}" {{ old('kategori','') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nilai (Rp) -->
                <div>
                    <label for="nilai_display" class="block text-sm font-semibold text-gray-700 mb-1.5">Nilai (Rp)</label>
                    <input id="nilai_display" type="text" placeholder="0"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                    <input type="hidden" name="nilai" id="nilai_raw" value="{{ old('nilai', '') }}">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('temuan.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm font-medium">
                    Simpan Temuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const displayInput = document.getElementById('nilai_display');
    const rawInput = document.getElementById('nilai_raw');

    function formatRupiah(val) {
        if (!val) return '';
        let number_string = val.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

    // Initialize display value
    if (rawInput.value) {
        displayInput.value = formatRupiah(rawInput.value);
    }

    displayInput.addEventListener('input', function(e) {
        let cleanVal = e.target.value.replace(/[^0-9]/g, '');
        rawInput.value = cleanVal;
        e.target.value = formatRupiah(cleanVal);
    });
});
</script>

