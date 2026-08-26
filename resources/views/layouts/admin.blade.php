<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - RentalMobilku</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans text-slate-900 bg-slate-100 antialiased min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col min-h-screen fixed lg:static z-40 transition-transform duration-300 -translate-x-full lg:translate-x-0" id="admin-sidebar">
        <!-- Brand Logo -->
        <div class="h-16 px-6 flex items-center justify-between border-b border-slate-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                <div>
                    <span class="font-extrabold text-white tracking-tight text-lg block leading-none">Rental<span class="text-blue-500">Mobilku</span></span>
                    <span class="text-[10px] text-slate-400 font-medium uppercase tracking-wider block mt-1">Admin Center</span>
                </div>
            </a>
            <button class="lg:hidden text-slate-400 hover:text-white" onclick="toggleSidebar()">&times;</button>
        </div>

        <!-- Navigation Menu -->
        <div class="p-4 space-y-1 flex-1 overflow-y-auto">
            <div class="px-3 py-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.cars.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.cars.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-8 5h8M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/></svg>
                <span>Kelola Armada</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Data Booking</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Data Pengguna</span>
            </a>

            <div class="pt-6 px-3 py-2 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Akses Publik</div>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Lihat Landing Page</span>
            </a>
        </div>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-3 overflow-hidden">
                <div class="w-9 h-9 rounded-xl bg-slate-800 text-blue-400 font-bold flex items-center justify-center border border-slate-700 flex-shrink-0">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="truncate">
                    <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-slate-400 truncate">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar" class="p-2 text-slate-400 hover:text-red-400 hover:bg-slate-800 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-bold text-slate-800">@yield('header', 'Admin Panel')</h1>
            </div>

            <div class="flex items-center gap-3">
                <span class="badge-success">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Sistem Aktif
                </span>
                <a href="{{ route('home') }}" class="btn-secondary btn-sm hidden sm:inline-flex">
                    Buka Website
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1 overflow-y-auto">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
    @stack('scripts')
</body>
</html>
