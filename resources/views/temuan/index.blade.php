@extends('layouts.app')
@section('title', 'Temuan')
@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-bold text-gray-900 font-sans">Daftar Temuan</h2>
        <p class="text-sm text-gray-500 font-medium">Kelola dan lihat rincian temuan pemeriksaan yang dikelompokkan berdasarkan LHP.</p>
    </div>
    <a href="{{ route('temuan.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Temuan
    </a>
</div>

<!-- Accordion Grouped by LHP -->
<div class="space-y-4">
    @forelse($temuansGrouped as $lhpId => $temuans)
        @php 
            $lhp = $temuans->first()->lhp; 
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
            <!-- Accordion Header -->
            <button onclick="toggleAccordion('lhp-{{ $lhpId }}')" class="w-full flex items-center justify-between p-6 hover:bg-gray-55/50 transition-colors text-left focus:outline-none">
                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-8 flex-1">
                    <div>
                        <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Laporan Hasil Pemeriksaan (LHP)</span>
                        <h3 class="text-base font-bold text-gray-950 mt-0.5">{{ $lhp->no_lhp }}</h3>
                    </div>
                    <div class="h-8 w-px bg-gray-200 hidden md:block"></div>
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Auditi (Objek Pemeriksaan)</span>
                        <p class="text-sm font-semibold text-gray-700 mt-0.5">{{ $lhp->auditi->nama ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 ml-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $temuans->count() }} Temuan
                    </span>
                    <div class="p-1 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors border border-gray-100">
                        <svg id="icon-lhp-{{ $lhpId }}" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </div>
                </div>
            </button>
            
            <!-- Accordion Content -->
            <div id="content-lhp-{{ $lhpId }}" class="hidden border-t border-gray-100 bg-[#fafbfe]/30">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/60 border-b border-gray-100 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-4 w-16">#</th>
                                <th class="px-6 py-4">Uraian Temuan</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Nilai (Rp)</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                            @foreach($temuans as $index => $t)
                            <tr class="hover:bg-gray-55/35 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-400">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 max-w-xl">
                                    <div class="leading-relaxed whitespace-pre-line">
                                        {{ $t->uraian }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-semibold">{{ $t->kategori ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-900 font-bold">
                                    Rp {{ number_format($t->nilai, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center justify-end gap-2">
                                        <a href="{{ route('temuan.show', $t) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm">
                                            Kelola
                                        </a>
                                        <a href="{{ route('temuan.edit', $t) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-gray-600 bg-gray-55 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('temuan.destroy', $t) }}" onsubmit="return confirm('Hapus temuan ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white p-12 text-center rounded-2xl border border-dashed border-gray-300 text-gray-400 font-medium">
            Belum ada data temuan.
        </div>
    @endforelse
</div>

<script>
function toggleAccordion(id) {
    const content = document.getElementById('content-' + id);
    const icon = document.getElementById('icon-' + id);
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>

@endsection
