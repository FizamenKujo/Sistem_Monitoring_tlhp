@extends('layouts.app')
@section('title', 'Data LHP')
@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-bold text-gray-900 font-sans">Data Laporan Hasil Pemeriksaan (LHP)</h2>
        <p class="text-sm text-gray-500 font-medium font-sans">Kelola dokumen Laporan Hasil Pemeriksaan beserta temuan dan rekomendasinya.</p>
    </div>
    <a href="{{ route('lhp.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-[#1e3a5f] hover:bg-[#152a46] rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah LHP
    </a>
</div>

<!-- Table Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-55 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 w-16">#</th>
                    <th class="px-6 py-4">No. LHP</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Auditi</th>
                    <th class="px-6 py-4">Jenis Pemeriksaan</th>
                    <th class="px-6 py-4">Temuan & Rekomendasi</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($lhps as $l)
                <tr class="hover:bg-gray-55/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $l->no_lhp }}</td>
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $l->tanggal?->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $l->auditi->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $l->jenis_pemeriksaan }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button onclick="toggleLhpTemuans({{ $l->id }})" 
                                    class="inline-flex items-center justify-between gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 transition-colors focus:outline-none">
                                <span>{{ $l->temuans->count() }} Temuan</span>
                                <svg id="arrow-temuans-{{ $l->id }}" class="w-3.5 h-3.5 text-amber-700 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>
                            <button onclick="toggleLhpRekomendasis({{ $l->id }})" 
                                    class="inline-flex items-center justify-between gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 hover:bg-blue-100 text-blue-800 border border-blue-200 transition-colors focus:outline-none">
                                <span>{{ $l->rekomendasis->count() }} Rekomendasi</span>
                                <svg id="arrow-rekomendasis-{{ $l->id }}" class="w-3.5 h-3.5 text-blue-700 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="inline-flex items-center gap-2">
                            <a href="{{ route('lhp.show', $l) }}" class="px-3 py-1.5 text-xs font-semibold text-white bg-[#1e3a5f] hover:bg-[#152a46] rounded-lg transition-colors shadow-sm">
                                Detail
                            </a>
                            <a href="{{ route('lhp.edit', $l) }}" class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-55 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form class="inline" method="POST" action="{{ route('lhp.destroy', $l) }}" onsubmit="return confirm('Hapus LHP ini beserta semua temuannya?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                
                <!-- Collapsible Sub-row for Temuans -->
                <tr id="temuans-lhp-{{ $l->id }}" class="hidden bg-gray-50/50">
                    <td colspan="7" class="px-8 py-5 border-l-4 border-amber-400">
                        <div class="space-y-2">
                            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                Daftar Temuan ({{ $l->temuans->count() }})
                            </h4>
                            @if($l->temuans->count())
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($l->temuans as $idx => $t)
                                <div class="bg-white p-3.5 rounded-xl border border-gray-150 shadow-xs">
                                    <div class="flex items-start gap-2">
                                        <span class="text-xs font-bold text-gray-400">{{ $idx + 1 }}.</span>
                                        <div class="space-y-1">
                                            <p class="text-xs font-semibold text-gray-800 leading-relaxed">{{ $t->uraian }}</p>
                                            <div class="flex items-center gap-2 flex-wrap text-[10px] text-gray-400 font-bold">
                                                <span class="bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded border border-gray-200/50">{{ $t->kategori }}</span>
                                                <span>•</span>
                                                <span>Nilai: <span class="text-gray-900">Rp {{ number_format($t->nilai, 0, ',', '.') }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-xs text-gray-400 italic">Belum ada temuan pada LHP ini.</p>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- Collapsible Sub-row for Rekomendasis -->
                <tr id="rekomendasis-lhp-{{ $l->id }}" class="hidden bg-gray-55/10">
                    <td colspan="7" class="px-8 py-5 border-l-4 border-blue-400">
                        <div class="space-y-2">
                            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                Daftar Rekomendasi ({{ $l->rekomendasis->count() }})
                            </h4>
                            @if($l->rekomendasis->count())
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($l->rekomendasis as $idx => $r)
                                <div class="bg-white p-3.5 rounded-xl border border-gray-150 shadow-xs">
                                    <div class="flex items-start gap-2">
                                        <span class="text-xs font-bold text-gray-400">{{ chr(97 + $idx) }}.</span>
                                        <div class="space-y-1">
                                            <p class="text-xs font-semibold text-gray-800 leading-relaxed whitespace-pre-line">{{ $r->uraian_rekomendasi }}</p>
                                            <div class="flex items-center gap-2 flex-wrap text-[10px] text-gray-400 font-bold">
                                                <span>Ditujukan Kepada: <span class="text-blue-900">{{ $r->ditujukan_kepada ?: 'Umum' }}</span></span>
                                                @if($r->target_waktu)
                                                <span>•</span>
                                                <span>Target: <span class="text-gray-600">{{ $r->target_waktu->format('d/m/Y') }}</span></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-xs text-gray-400 italic">Belum ada rekomendasi pada LHP ini.</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-400 font-medium">
                        Belum ada data LHP.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleLhpTemuans(id) {
    const detailsRow = document.getElementById('temuans-lhp-' + id);
    const arrowIcon = document.getElementById('arrow-temuans-' + id);
    
    if (detailsRow) {
        if (detailsRow.classList.contains('hidden')) {
            detailsRow.classList.remove('hidden');
            if (arrowIcon) {
                arrowIcon.classList.add('rotate-180');
            }
        } else {
            detailsRow.classList.add('hidden');
            if (arrowIcon) {
                arrowIcon.classList.remove('rotate-180');
            }
        }
    }
}

function toggleLhpRekomendasis(id) {
    const detailsRow = document.getElementById('rekomendasis-lhp-' + id);
    const arrowIcon = document.getElementById('arrow-rekomendasis-' + id);
    
    if (detailsRow) {
        if (detailsRow.classList.contains('hidden')) {
            detailsRow.classList.remove('hidden');
            if (arrowIcon) {
                arrowIcon.classList.add('rotate-180');
            }
        } else {
            detailsRow.classList.add('hidden');
            if (arrowIcon) {
                arrowIcon.classList.remove('rotate-180');
            }
        }
    }
}
</script>

@endsection
