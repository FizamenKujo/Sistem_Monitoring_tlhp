@extends('layouts.app')
@section('title', 'Kelola Temuan')
@section('content')

<!-- Header & Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Kelola Temuan</h2>
        <p class="text-sm text-gray-500 font-medium">Lihat rincian temuan pemeriksaan.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('lhp.show', $temuan->lhp_id) }}" class="px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-55 transition-colors shadow-sm">
            Kembali ke LHP
        </a>
    </div>
</div>

<!-- Temuan Detail Card -->
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
    <div class="border-b border-gray-100 pb-4 mb-4 flex items-center justify-between">
        <span class="text-sm font-bold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full uppercase tracking-wider">
            Temuan {{ $temuan->kategori ? ' - ' . $temuan->kategori : '' }}
        </span>
        <div class="flex items-center gap-2">
            <a href="{{ route('temuan.edit', $temuan) }}" class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">
                Edit
            </a>
            <form class="inline" method="POST" action="{{ route('temuan.destroy', $temuan) }}" onsubmit="return confirm('Hapus temuan ini?')">
                @csrf 
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    
    <p class="text-gray-800 text-base font-medium mb-4 leading-relaxed">{{ $temuan->uraian }}</p>
    
    <div class="flex flex-wrap gap-y-2 gap-x-6 text-sm text-gray-400 font-semibold border-t border-gray-50 pt-4">
        <span>No. LHP: <span class="text-gray-700">{{ $temuan->lhp->no_lhp ?? '-' }}</span></span>
        <span>•</span>
        <span>Nilai: <span class="text-gray-900 font-bold">Rp {{ number_format($temuan->nilai, 0, ',', '.') }}</span></span>
    </div>
</div>

@endsection
