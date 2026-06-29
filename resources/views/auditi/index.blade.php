@extends('layouts.app')
@section('title', 'Data Auditi')
@section('content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-bold text-gray-900 font-sans">Data Auditi (Objek Pemeriksaan)</h2>
        <p class="text-sm text-gray-500 font-medium">Kelola instansi atau objek pemeriksaan di Kabupaten Deli Serdang.</p>
    </div>
    <a href="{{ route('auditi.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Auditi
    </a>
</div>

<!-- Table Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 w-16">#</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Kecamatan</th>
                    <th class="px-6 py-4">Penanggung Jawab</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($auditis as $a)
                <tr class="hover:bg-gray-55/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $a->nama }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $a->kecamatan }}</td>
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $a->penanggung_jawab }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="inline-flex items-center gap-2">
                            <a href="{{ route('auditi.edit', $a) }}" class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-55 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form class="inline" method="POST" action="{{ route('auditi.destroy', $a) }}" onsubmit="return confirm('Hapus data Auditi ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium">
                        Belum ada data Auditi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
