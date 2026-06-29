@extends('layouts.app')
@section('title', 'Masuk')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#1e3a5f] px-4 py-12 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-2xl border border-blue-900/10">
        <!-- Brand Header -->
        <div class="text-center">
            <!-- Shield Icon SVG -->
            <div class="mx-auto h-14 w-14 flex items-center justify-center rounded-xl bg-blue-50 text-[#1e3a5f]">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-bold tracking-tight text-gray-900">
                Monitoring TLHP
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Inspektorat Kabupaten Deli Serdang
            </p>
        </div>

        <!-- Session Errors -->
        @if($errors->any())
        <div class="p-3.5 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg font-medium" role="alert">
            {{ $errors->first() }}
        </div>
        @endif

        <form class="mt-6 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="space-y-4">
                <!-- NIP / Email Input -->
                <div>
                    <label for="login" class="block text-sm font-semibold text-gray-700 mb-1.5">NIP atau Email</label>
                    <div class="relative">
                        <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                            placeholder="Masukkan NIP atau Email"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all text-sm">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                            placeholder="••••••••"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white transition-all text-sm">
                    </div>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-md cursor-pointer">
                    <label for="remember" class="ml-2 block text-sm font-medium text-gray-600 cursor-pointer select-none">
                        Ingat saya
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-[#1e3a5f] hover:bg-[#152943] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
