@extends('layouts.app')
@section('title', 'Detail Rekomendasi')
@section('content')

<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Detail Rekomendasi</h2>
            <p class="text-sm text-gray-500 font-medium">Informasi lengkap rekomendasi dan riwayat tindak lanjut.</p>
        </div>
        <a href="{{ route('lhp.show', $rekomendasi->lhp_id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali ke LHP
        </a>
    </div>

    <!-- Recommendation Card -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
            <span class="text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full uppercase tracking-wider">
                Ditujukan Kepada: {{ $rekomendasi->ditujukan_kepada }}
            </span>
            @php 
                $s = $rekomendasi->status_terkini; 
                $badgeClass = $s === 'Selesai' 
                    ? 'bg-green-100 text-green-800 border-green-200' 
                    : ($s === 'Proses' 
                        ? 'bg-yellow-100 text-yellow-800 border-yellow-200' 
                        : 'bg-red-100 text-red-800 border-red-200'); 
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border uppercase tracking-wider {{ $badgeClass }}">
                {{ $s }}
            </span>
        </div>

        <div class="space-y-4">
            <div>
                <span class="text-xs font-semibold text-gray-400 block mb-1">Uraian Rekomendasi</span>
                <p class="text-gray-900 text-base font-semibold leading-relaxed whitespace-pre-line">{{ $rekomendasi->uraian_rekomendasi }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-gray-50">
                <div>
                    <span class="text-xs font-semibold text-gray-400 block">Nomor LHP</span>
                    <span class="text-sm font-bold text-gray-800">{{ $rekomendasi->lhp->no_lhp }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-gray-400 block">Target Waktu Penyelesaian</span>
                    <span class="text-sm font-bold text-gray-800">{{ $rekomendasi->target_waktu ? $rekomendasi->target_waktu->format('d F Y') : '-' }}</span>
                </div>
            </div>

            @if($rekomendasi->temuan)
            <div class="pt-4 border-t border-gray-50">
                <span class="text-xs font-semibold text-gray-400 block mb-1">Terkait Temuan</span>
                <p class="text-xs font-medium text-gray-600 bg-gray-50 p-3 rounded-lg border border-gray-100 leading-relaxed">{{ $rekomendasi->temuan->uraian }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Follow Up History Section -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-md font-bold text-gray-800 mb-4">Riwayat Tindak Lanjut</h3>
        
        @if($rekomendasi->tindakLanjuts->count())
        <div class="relative pl-6 border-l-2 border-blue-100 space-y-6">
            @foreach($rekomendasi->tindakLanjuts()->latest('tanggal')->get() as $tl)
            <div class="relative">
                <!-- Dot indicator -->
                <div class="absolute -left-[31px] top-1.5 w-4.5 h-4.5 rounded-full border-2 border-white {{ $tl->status === 'Selesai' ? 'bg-green-500' : ($tl->status === 'Proses' ? 'bg-yellow-500' : 'bg-red-500') }} shadow-sm"></div>
                
                <div class="space-y-1 bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <span class="text-xs font-bold text-gray-500">{{ $tl->tanggal?->format('d F Y') }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-extrabold uppercase tracking-wide border {{ $tl->status === 'Selesai' ? 'bg-green-100 text-green-700 border-green-200' : ($tl->status === 'Proses' ? 'bg-yellow-100 text-yellow-700 border-yellow-200' : 'bg-red-100 text-red-700 border-red-200') }}">
                            {{ $tl->status }}
                        </span>
                    </div>
                    <p class="text-sm font-medium text-gray-700 leading-relaxed">{{ $tl->keterangan }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-6 text-gray-400 font-medium border border-dashed border-gray-300 rounded-2xl">
            Belum ada tindak lanjut yang dicatat untuk rekomendasi ini.
        </div>
        @endif

        <!-- Add follow up form -->
        <div class="border-t border-gray-100 pt-6 mt-6">
            <h4 class="text-sm font-bold text-gray-800 mb-3">Catat Tindak Lanjut Baru</h4>
            <form class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end" method="POST" action="{{ route('tindak-lanjut.store', $rekomendasi) }}">
                @csrf
                
                <div class="sm:col-span-3">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Status Tindak Lanjut</label>
                    <select name="status" required
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                        <option value="Belum">Belum</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tanggal Pelaporan</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all font-medium">
                </div>

                <div class="sm:col-span-4">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Keterangan / Uraian</label>
                    <input name="keterangan" type="text" required placeholder="Catatan tindak lanjut..."
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all">
                </div>

                <div class="sm:col-span-2">
                    <button type="submit" class="w-full py-2.5 px-4 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors shadow-sm text-center">
                        Catat TL
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
