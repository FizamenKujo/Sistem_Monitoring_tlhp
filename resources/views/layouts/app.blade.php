<!DOCTYPE html>
<html lang="id" class="h-full bg-[#f4f6f9]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Monitoring TLHP') - Inspektorat Deli Serdang</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231e3a5f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'></path><path d='m9 11 2 2 4-4'></path></svg>">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">

@auth
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#1e3a5f] text-white flex flex-col shadow-xl flex-shrink-0 z-20 transition-all duration-300">
        <!-- Brand Header -->
        <div class="h-16 flex items-center px-6 border-b border-white/10 bg-[#172e4c]">
            <span class="flex items-center gap-2.5 font-bold text-lg tracking-wide">
                <!-- Shield Icon -->
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
                Monitoring TLHP
            </span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <!-- 1. Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
                Dashboard
            </a>

            <!-- 2. Data Auditi -->
            <a href="{{ route('auditi.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('auditi.*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('auditi.*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                </svg>
                Data Auditi
            </a>

            <!-- 3. Data LHP -->
            <a href="{{ route('lhp.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('lhp.*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('lhp.*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                Data LHP
            </a>

            <!-- 4. Temuan -->
            <a href="{{ route('temuan.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('temuan.*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('temuan.*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
                Temuan
            </a>

            <!-- 5. Rekomendasi -->
            <a href="{{ route('rekomendasi.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('rekomendasi.*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('rekomendasi.*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Rekomendasi
            </a>

            <!-- 5. Profil -->
            <a href="{{ route('profil') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('profil*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('profil*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Profil
            </a>

            <!-- 6. Manajemen Pengguna (Admin Only, placed bottom) -->
            @if(auth()->user()->isAdmin())
            <a href="{{ route('user.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('user.*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('user.*') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A2.25 2.25 0 0112.75 21.5h-1.5a2.25 2.25 0 01-2.25-2.263v-.109m0 0A9.39 9.39 0 0112 18.75c1.03 0 2.022.166 2.953.477m-4.174-3.07a9.31 9.31 0 00-4.122.951 4.125 4.125 0 007.533 2.493m-7.533-2.493c-.501-.91-.786-1.957-.786-3.07v-.003m-2.251-3.07A9.041 9.041 0 001.5 15.01a4.125 4.125 0 007.533 2.493M15 9.75a3 3 0 11-6 0 3 3 0 016 0zm6.25 2.25a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-12 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                </svg>
                Manajemen Pengguna
            </a>
            @endif
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-white/10 text-center text-xs text-blue-200/60 bg-[#172e4c]">
            Inspektorat Deli Serdang
        </div>
    </aside>

    <!-- Main Content Panel -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Navbar -->
        <header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-6 z-10">
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ auth()->user()->role }}
                </span>
                
                <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                    <!-- User Avatar Placeholder SVG -->
                    <svg class="w-7 h-7 text-gray-400 bg-gray-100 rounded-full p-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.67-5.33-4-8-4z"/>
                    </svg>
                    <span>{{ auth()->user()->name }}</span>
                </div>

                <div class="h-6 w-px bg-gray-200"></div>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Alert Success -->
                @if(session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border-l-4 border-green-500 bg-green-50 rounded-r-lg" role="alert">
                    <svg class="flex-shrink-0 inline w-4.5 h-4.5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="sr-only">Success</span>
                    <div class="font-medium">{{ session('success') }}</div>
                </div>
                @endif

                <!-- Alert Errors -->
                @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 border-l-4 border-red-500 bg-red-50 rounded-r-lg" role="alert">
                    <div class="flex items-center mb-2">
                        <svg class="flex-shrink-0 inline w-4.5 h-4.5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                        <span class="font-semibold">Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside ml-6 space-y-1">
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</div>
@else
    @yield('content')
@endauth

</body>
</html>
