@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

@php $tot = max($belum + $proses + $selesai, 1); @endphp

<!-- Stat Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card 1: Total Auditi -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <span class="text-sm font-semibold text-gray-500 block mb-1">Total Auditi</span>
            <span class="text-3xl font-bold text-gray-900">{{ $totalAuditi }}</span>
        </div>
        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
            <!-- Building/Auditi SVG Icon -->
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
            </svg>
        </div>
    </div>

    <!-- Card 2: Total LHP -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <span class="text-sm font-semibold text-gray-500 block mb-1">Total LHP</span>
            <span class="text-3xl font-bold text-gray-900">{{ $totalLhp }}</span>
        </div>
        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
            <!-- File SVG Icon -->
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
        </div>
    </div>

    <!-- Card 3: Total Temuan -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <span class="text-sm font-semibold text-gray-500 block mb-1">Total Temuan</span>
            <span class="text-3xl font-bold text-gray-900">{{ $totalTemuan }}</span>
        </div>
        <div class="p-3 bg-red-50 text-red-600 rounded-xl">
            <!-- Warning SVG Icon -->
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
        </div>
    </div>

    <!-- Card 4: Nilai Temuan -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <span class="text-sm font-semibold text-gray-500 block mb-1">Nilai Temuan</span>
            <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalNilai, 0, ',', '.') }}</span>
        </div>
        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
            <!-- Currency IDR/Dollar SVG Icon -->
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.214-.13a2.235 2.235 0 00.786-1.745c0-.663-.338-1.282-.907-1.625l-1.026-.62c-.569-.34-.907-.96-.907-1.623 0-.908.647-1.688 1.545-1.815l.3-.043M12 6.75V4.5m0 2.25c.786 0 1.518.306 2.062.812m0 0a2.25 2.25 0 010 3.182m0 0L12 13.5m3.658 3.34c-.544.506-1.276.812-2.062.812M12 18v2.25m0-2.25c-.786 0-1.518-.306-2.062-.812M12 13.5c-.786 0-1.518-.306-2.062-.812M12 13.5v-1.5m0 4.5V13.5"/>
            </svg>
        </div>
    </div>
</div>

<!-- Status Counts Grid -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <!-- Belum -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="w-2.5 h-12 bg-red-500 rounded-full"></div>
        <div>
            <span class="text-sm font-semibold text-gray-500 block">Belum Ditindaklanjuti</span>
            <span class="text-2xl font-bold text-red-600">{{ $belum }}</span>
        </div>
    </div>
    
    <!-- Proses -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="w-2.5 h-12 bg-yellow-500 rounded-full"></div>
        <div>
            <span class="text-sm font-semibold text-gray-500 block">Dalam Proses</span>
            <span class="text-2xl font-bold text-yellow-600">{{ $proses }}</span>
        </div>
    </div>

    <!-- Selesai -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="w-2.5 h-12 bg-green-500 rounded-full"></div>
        <div>
            <span class="text-sm font-semibold text-gray-500 block">Selesai</span>
            <span class="text-2xl font-bold text-green-600">{{ $selesai }}</span>
        </div>
    </div>
</div>

<!-- Progress Bar Visualisation -->
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    <h3 class="text-sm font-bold text-gray-700 mb-4">Status Penyelesaian Tindak Lanjut Rekomendasi</h3>
    <div class="w-full bg-gray-100 rounded-full h-5 overflow-hidden flex">
        <div class="bg-green-500 text-white text-xs font-bold flex items-center justify-center transition-all duration-500" style="width: {{ round($selesai / $tot * 100) }}%">
            {{ round($selesai / $tot * 100) }}%
        </div>
        <div class="bg-yellow-500 text-white text-xs font-bold flex items-center justify-center transition-all duration-500" style="width: {{ round($proses / $tot * 100) }}%">
            {{ round($proses / $tot * 100) }}%
        </div>
        <div class="bg-red-500 text-white text-xs font-bold flex items-center justify-center transition-all duration-500" style="width: {{ round($belum / $tot * 100) }}%">
            {{ round($belum / $tot * 100) }}%
        </div>
    </div>
    <div class="flex items-center justify-center gap-6 mt-4 text-xs font-semibold text-gray-500">
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 bg-green-500 rounded-full inline-block"></span> Selesai ({{ $selesai }})</span>
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 bg-yellow-500 rounded-full inline-block"></span> Proses ({{ $proses }})</span>
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 bg-red-500 rounded-full inline-block"></span> Belum ({{ $belum }})</span>
    </div>
</div>

<!-- Charts Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Doughnut Chart: Status distribution -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
        <h3 class="text-sm font-bold text-gray-700 self-start mb-6">Persentase Status Tindak Lanjut</h3>
        <div class="w-full max-w-[280px]">
            <canvas id="statusDoughnutChart"></canvas>
        </div>
    </div>

    <!-- Bar Chart: Temuan per Kategori -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
        <h3 class="text-sm font-bold text-gray-700 mb-6">Jumlah Temuan per Kategori</h3>
        <div class="w-full flex-1 min-h-[280px] flex items-center">
            <canvas id="kategoriBarChart"></canvas>
        </div>
    </div>
</div>

<!-- Load Local Chart.js -->
<script src="{{ asset('vendor/chartjs/chart.umd.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Doughnut Chart
    const statusCtx = document.getElementById('statusDoughnutChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Belum Ditindaklanjuti', 'Dalam Proses', 'Selesai'],
            datasets: [{
                data: [{{ $belum }}, {{ $proses }}, {{ $selesai }}],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 15,
                        font: {
                            family: "'Instrument Sans', sans-serif",
                            size: 11
                        }
                    }
                }
            },
            cutout: '65%'
        }
    });

    // 2. Bar Chart
    const kategoriCtx = document.getElementById('kategoriBarChart').getContext('2d');
    const kategoriData = @json($temuanPerKategori);
    const labels = Object.keys(kategoriData);
    const data = Object.values(kategoriData);

    new Chart(kategoriCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Temuan',
                data: data,
                backgroundColor: '#1e3a5f',
                hoverBackgroundColor: '#2563eb',
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: {
                            family: "'Instrument Sans', sans-serif"
                        }
                    },
                    grid: {
                        color: '#f3f4f6'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: "'Instrument Sans', sans-serif",
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
});
</script>

@endsection
