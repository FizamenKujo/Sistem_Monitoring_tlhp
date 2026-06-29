@extends('layouts.app')
@section('title', 'Detail LHP')
@section('content')

<!-- Header & Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Detail Laporan Hasil Pemeriksaan (LHP)</h2>
        <p class="text-sm text-gray-500 font-medium">Informasi lengkap, daftar temuan, dan rekomendasi hasil pemeriksaan.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('lhp.index') }}" class="px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            Kembali
        </a>
        <a href="{{ route('temuan.create', ['lhp_id' => $lhp->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Temuan
        </a>
    </div>
</div>

<!-- LHP Information Card -->
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
    <div class="border-b border-gray-100 pb-4 mb-6 flex items-center justify-between">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            {{ $lhp->no_lhp }}
        </h3>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
            {{ $lhp->jenis_pemeriksaan }}
        </span>
    </div>

    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 text-sm">
        <div>
            <dt class="text-gray-400 font-semibold mb-1">Auditi (Objek Pemeriksaan)</dt>
            <dd class="text-gray-900 font-bold text-base">{{ $lhp->auditi->nama ?? '-' }}</dd>
        </div>
        <div>
            <dt class="text-gray-400 font-semibold mb-1">Tanggal LHP</dt>
            <dd class="text-gray-900 font-semibold">{{ $lhp->tanggal?->format('d F Y') }}</dd>
        </div>
        <div>
            <dt class="text-gray-400 font-semibold mb-1">Batas Tindak Lanjut</dt>
            <dd class="text-gray-900 font-semibold">{{ $lhp->batas_tindak_lanjut?->format('d F Y') ?? '-' }}</dd>
        </div>
        <div>
            <dt class="text-gray-400 font-semibold mb-1">Periode Pemeriksaan</dt>
            <dd class="text-gray-900 font-semibold">{{ $lhp->periode ?? '-' }}</dd>
        </div>
        @if($lhp->file_pdf)
        <div class="md:col-span-2">
            <dt class="text-gray-400 font-semibold mb-1">Dokumen LHP</dt>
            <dd>
                <a target="_blank" href="{{ asset('storage/' . $lhp->file_pdf) }}" 
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    Lihat PDF LHP
                </a>
            </dd>
        </div>
        @endif
    </dl>
</div>

<!-- List of Findings (Collapsible) -->
<div class="mb-10">
    <h3 class="text-md font-bold text-gray-800 mb-4">Daftar Temuan Hasil Pemeriksaan</h3>
    
    <div class="space-y-3">
        @forelse($lhp->temuans as $t)
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm transition-all duration-300 hover:shadow-md">
            <!-- Collapsible Header -->
            <button onclick="toggleSection('temuan-{{ $t->id }}')" class="w-full flex items-center justify-between p-5 hover:bg-gray-50/50 transition-colors text-left focus:outline-none">
                <div class="flex items-center gap-3 flex-wrap flex-1">
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded border border-blue-100">
                        Temuan #{{ $loop->iteration }}
                    </span>
                    @if($t->kategori)
                    <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2.5 py-1 rounded border border-gray-200/50">
                        {{ $t->kategori }}
                    </span>
                    @endif
                    <span class="text-xs font-bold text-gray-400">
                        Nilai: Rp {{ number_format($t->nilai, 0, ',', '.') }}
                    </span>
                </div>
                <div class="p-1 rounded-lg bg-gray-50 border border-gray-100 transition-colors">
                    <svg id="icon-temuan-{{ $t->id }}" class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </div>
            </button>
            
            <!-- Collapsible Content -->
            <div id="content-temuan-{{ $t->id }}" class="hidden border-t border-gray-100 bg-[#fafbfe]/20 p-5 space-y-4">
                <p class="text-sm font-medium text-gray-800 leading-relaxed">{{ $t->uraian }}</p>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-50">
                    <a href="{{ route('temuan.show', $t) }}" class="inline-flex items-center gap-1 px-3-5 py-1.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm">
                        Kelola Detail Temuan
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-8 text-center rounded-2xl border border-dashed border-gray-300 text-gray-400 font-medium">
            Belum ada temuan yang ditambahkan pada LHP ini.
        </div>
        @endforelse
    </div>
</div>

<!-- Section Rekomendasi per-LHP (Collapsible Groups) -->
<div class="mt-12">
    <div class="border-b border-gray-200 pb-3 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-900">Daftar Rekomendasi Hasil Pemeriksaan</h3>
            <p class="text-sm text-gray-500 font-medium">Daftar rekomendasi yang dikelompokkan berdasarkan pihak yang dituju.</p>
        </div>
        <a href="{{ route('rekomendasi.create', ['lhp_id' => $lhp->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Rekomendasi
        </a>
    </div>

    @php
        $groupedRekomendasi = $lhp->rekomendasis->groupBy(function($item) {
            return $item->ditujukan_kepada ?: 'Umum / Tidak Ditentukan';
        });
    @endphp

    @forelse($groupedRekomendasi as $ditujukan => $reks)
    <div class="mb-4 bg-white rounded-2xl border border-gray-150 overflow-hidden shadow-sm transition-all duration-300 hover:shadow-md">
        <!-- Collapsible Header -->
        <button onclick="toggleSection('rekomendasi-group-{{ $loop->index }}')" class="w-full flex items-center justify-between p-5 hover:bg-gray-50/50 transition-colors text-left focus:outline-none">
            <h4 class="text-base font-bold text-gray-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 bg-blue-600 rounded-full"></span>
                Ditujukan Kepada: <span class="text-blue-950 font-extrabold">{{ $ditujukan }}</span>
            </h4>
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                    {{ $reks->count() }} Rekomendasi
                </span>
                <div class="p-1 rounded-lg bg-gray-50 border border-gray-100">
                    <svg id="icon-rekomendasi-group-{{ $loop->index }}" class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </div>
            </div>
        </button>
        
        <!-- Collapsible Content -->
        <div id="content-rekomendasi-group-{{ $loop->index }}" class="hidden border-t border-gray-100 bg-[#fafbfe]/10 p-5 space-y-4">
            @foreach($reks as $index => $r)
            @php 
                $s = $r->status_terkini; 
                $badgeClass = $s === 'Selesai' 
                    ? 'bg-green-100 text-green-800 border-green-200' 
                    : ($s === 'Proses' 
                        ? 'bg-yellow-100 text-yellow-800 border-yellow-200' 
                        : 'bg-red-100 text-red-800 border-red-200'); 
            @endphp
            <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <div class="space-y-1.5 flex-1">
                        <div class="flex items-start gap-2">
                            <span class="text-sm font-bold text-gray-400">{{ chr(97 + $loop->index) }}.</span>
                            <div class="space-y-1">
                                <p class="text-sm font-semibold text-gray-800 leading-relaxed whitespace-pre-line">{{ $r->uraian_rekomendasi }}</p>
                                <div class="flex items-center gap-2 flex-wrap text-xs font-semibold text-gray-400">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold border uppercase tracking-wider {{ $badgeClass }}">
                                        {{ $s }}
                                    </span>
                                    @if($r->target_waktu)
                                    <span>•</span>
                                    <span>Target Waktu: {{ $r->target_waktu->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 self-end sm:self-start">
                        <a href="{{ route('rekomendasi.show', $r) }}" class="px-2.5 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-100 rounded-lg transition-colors">
                            Riwayat & Detil
                        </a>
                        <a href="{{ route('rekomendasi.edit', $r) }}" class="px-2.5 py-1.5 text-xs font-semibold text-gray-600 bg-gray-55 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">
                            Edit
                        </a>
                        <form class="inline" method="POST" action="{{ route('rekomendasi.destroy', $r) }}" onsubmit="return confirm('Hapus rekomendasi ini beserta seluruh riwayat tindak lanjutnya?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Follow-up log history (if any) -->
                @if($r->tindakLanjuts->count())
                <div class="bg-gray-50/80 p-3.5 rounded-lg border border-gray-100 text-xs">
                    <h5 class="font-bold text-gray-500 uppercase tracking-wider mb-2">Riwayat Tindak Lanjut:</h5>
                    <ul class="space-y-1.5 text-gray-700">
                        @foreach($r->tindakLanjuts as $tl)
                        <li class="flex items-start gap-1.5">
                            <span class="text-gray-400 font-semibold whitespace-nowrap">{{ $tl->tanggal?->format('d/m/Y') }}</span>
                            <span>-</span>
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-extrabold uppercase tracking-wide border {{ $tl->status === 'Selesai' ? 'bg-green-100 text-green-700 border-green-200' : ($tl->status === 'Proses' ? 'bg-yellow-100 text-yellow-700 border-yellow-200' : 'bg-red-100 text-red-700 border-red-200') }}">
                                {{ $tl->status }}
                            </span>
                            <span class="text-gray-600">{{ $tl->keterangan }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Inline form for logging new follow-up action -->
                <div class="border-t border-gray-100 pt-3 mt-1">
                    <form class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end" method="POST" action="{{ route('tindak-lanjut.store', $r) }}">
                        @csrf
                        <div class="sm:col-span-3">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Catat TL</label>
                            <select name="status" required
                                class="block w-full px-2 py-1.5 bg-gray-50 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                                <option value="Belum">Belum</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="sm:col-span-3">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                                class="block w-full px-2 py-1.5 bg-gray-50 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                        </div>
                        <div class="sm:col-span-4">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Keterangan</label>
                            <input name="keterangan" type="text" required placeholder="Tulis keterangan..."
                                class="block w-full px-2 py-1.5 bg-gray-50 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="w-full py-1.5 px-3 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors shadow-sm text-center">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="bg-white p-8 text-center rounded-2xl border border-dashed border-gray-300 text-gray-400 font-medium">
        Belum ada rekomendasi yang ditambahkan pada LHP ini.
    </div>
    @endforelse
</div>

<script>
function toggleSection(id) {
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
