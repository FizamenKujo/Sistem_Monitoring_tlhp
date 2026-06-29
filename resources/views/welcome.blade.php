<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring TLHP - Inspektorat Kabupaten Deli Serdang</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231e3a5f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'></path><path d='m9 11 2 2 4-4'></path></svg>">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="antialiased bg-gray-50">
    <div class="relative min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div class="bg-[#1e3a5f] p-1.5 rounded-lg">
                            <!-- Shield Check Icon -->
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900 tracking-tight">Monitoring TLHP Inspektorat Deli Serdang</span>
                    </div>
                    <div class="flex items-center gap-6 text-sm font-medium text-gray-600">
                        <a href="#" class="hover:text-[#1e3a5f] transition">Beranda</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-[#1e3a5f] text-white rounded-lg hover:bg-[#152943] transition shadow-lg shadow-[#1e3a5f]/20">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2.5 bg-[#1e3a5f] text-white rounded-lg hover:bg-[#152943] transition shadow-lg shadow-[#1e3a5f]/20">Login Pegawai</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-[#1e3a5f]/10 text-[#1e3a5f] text-sm font-semibold">
                            <span class="w-2 h-2 bg-[#1e3a5f] rounded-full mr-2"></span>
                            Portal Resmi Inspektorat Kab. Deli Serdang
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                            Sistem Informasi<br>
                            <span class="text-[#1e3a5f]">Monitoring TLHP</span>
                        </h1>
                        <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                            Kelola dan pantau tindak lanjut hasil pemeriksaan di lingkungan Kabupaten Deli Serdang secara efisien, aman, dan mudah diakses. Solusi digital terintegrasi untuk pengawasan pembangunan daerah yang transparan.
                        </p>
                        <div class="flex gap-4 flex-wrap">
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-[#1e3a5f] text-white font-semibold rounded-xl hover:bg-[#152943] transition shadow-lg shadow-[#1e3a5f]/20 flex items-center justify-center gap-2 min-w-[200px]">
                                    Dashboard Pegawai
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-8 py-4 bg-[#1e3a5f] text-white font-semibold rounded-xl hover:bg-[#152943] transition shadow-lg shadow-[#1e3a5f]/20 flex items-center justify-center gap-2 min-w-[200px]">
                                    Login Pegawai
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @endif
                            <a href="#fitur-unggulan" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-gray-700 font-semibold text-center rounded-xl border border-gray-200 hover:bg-gray-50 transition min-w-[200px] hover:translate-y-0.5 duration-200">
                                Pelajari Lebih Lanjut
                                <svg class="w-4 h-4 text-gray-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="relative flex flex-col items-center justify-center mt-8 lg:mt-0">
                        <!-- Logos: Size and translations optimized for standard Tailwind v4 classes -->
                        <div class="flex items-center justify-center gap-10 md:gap-16">
                            <img src="{{ asset('logo-deli-serdang.png') }}" alt="Logo Kabupaten Deli Serdang" class="h-48 md:h-60 lg:h-72 w-auto object-contain mix-blend-multiply drop-shadow-xl hover:scale-105 transition duration-300 translate-y-6 md:translate-y-8 lg:translate-y-10">
                            <img src="{{ asset('logo-inspektorat.png') }}" alt="Logo Inspektorat" class="h-40 md:h-52 lg:h-64 w-auto object-contain mix-blend-multiply drop-shadow-xl hover:scale-105 transition duration-300">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div id="fitur-unggulan" class="bg-gray-50 py-24 border-t border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <span class="text-[#1e3a5f] font-semibold tracking-wide uppercase text-sm">Fitur Unggulan</span>
                        <h2 class="mt-2 text-3xl font-bold text-gray-900">Transformasi Monitoring Pengawasan</h2>
                        <p class="mt-4 max-w-2xl mx-auto text-gray-500">Layanan Monitoring TLHP Inspektorat Kabupaten Deli Serdang hadir dengan fitur modern untuk mendukung akuntabilitas tindak lanjut pemeriksaan.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                            <div class="w-12 h-12 bg-[#1e3a5f] rounded-xl flex items-center justify-center text-white mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Manajemen Data LHP</h3>
                            <p class="text-gray-500 leading-relaxed">Penyimpanan dan pencatatan berkas Laporan Hasil Pemeriksaan secara rapi dan terstruktur untuk kemudahan akses.</p>
                        </div>
                        <!-- Feature 2 -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                            <div class="w-12 h-12 bg-[#1e3a5f] rounded-xl flex items-center justify-center text-white mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Temuan & Rekomendasi</h3>
                            <p class="text-gray-500 leading-relaxed">Pencatatan rincian temuan beserta butir rekomendasi awal secara komprehensif bagi objek pemeriksaan.</p>
                        </div>
                        <!-- Feature 3 -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                            <div class="w-12 h-12 bg-[#1e3a5f] rounded-xl flex items-center justify-center text-white mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Monitoring Tindak Lanjut</h3>
                            <p class="text-gray-500 leading-relaxed">Visualisasi riwayat tindak lanjut temuan beserta persentase penyelesaian real-time (Belum / Proses / Selesai).</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white py-8 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-gray-600">Monitoring TLHP</span>
                </div>
                <div class="text-xs text-gray-400 font-medium text-center md:text-right">
                    <p>&copy; {{ date('Y') }} Inspektorat Kabupaten Deli Serdang. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
