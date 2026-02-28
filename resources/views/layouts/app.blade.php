<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EasyColoc') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f8fafc]">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col h-screen sticky top-0">
            <div class="p-8">
                <h1 class="text-2xl font-bold text-indigo-600 tracking-tight italic">EasyColoc</h1>
            </div>
            <nav class="mt-4 px-4 space-y-2 flex-1">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-gray-500' }} rounded-xl transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/coloc" class="flex items-center px-4 py-3 {{ request()->is('coloc*') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-gray-500' }} hover:bg-gray-50 rounded-xl transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Colocations
                </a>
                <a href="/admin" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    Administration
                </a>
                <a href="/profil" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Profile
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-wider">@yield('page_title')</h2>
                </div>
                <div class="flex items-center gap-4">
                    @yield('header_actions')
                    <div class="flex items-center bg-white p-1 pr-4 rounded-full border border-gray-100 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold">U</div>
                        <div class="ml-3 text-left">
                            <p class="text-xs font-bold text-gray-900">USER 2</p>
                            <p class="text-[10px] text-green-500 font-bold uppercase tracking-tighter italic">En ligne</p>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center">
                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></span>
                <p class="text-sm font-semibold italic uppercase">{{ session('success') }}</p>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>