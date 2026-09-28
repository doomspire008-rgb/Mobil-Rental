<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - RentalMobilku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-neutral-900 bg-neutral-50 antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col" style="background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);">
            <div class="relative aurora-field opacity-30">
                <div class="aurora-blob aurora-blob-1 w-56 h-56 -top-10 -left-10"></div>
                <div class="aurora-blob aurora-blob-2 w-56 h-56 bottom-0 right-0"></div>
            </div>
            <div class="relative z-10 flex flex-col h-full">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-6 h-16 border-b border-white/10 flex-shrink-0">
                    <svg class="w-8 h-8 text-primary-500" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="8" fill="currentColor"/><path d="M8 20H24M10 20V14C10 11.79 11.79 10 14 10H18C20.21 10 22 11.79 22 14V20" stroke="white" stroke-width="2.5" stroke-linecap="round"/><circle cx="11" cy="20" r="2" fill="white"/><circle cx="21" cy="20" r="2" fill="white"/></svg>
                    <div>
                        <span class="font-bold text-white text-base block leading-tight">RentalMobilku</span>
                        <span class="text-xs text-slate-400">Admin Panel</span>
                    </div>
                </a>

                <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
                    @php
                        $navItems = [
                            ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['route' => 'admin.cars.index', 'label' => 'Mobil', 'icon' => 'M8 17h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4zM3 7h13l3 5v5h-2M3 7v9h2M3 7l1.5-3h9L16 7'],
                            ['route' => 'admin.bookings.index', 'label' => 'Booking', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            ['route' => 'admin.users.index', 'label' => 'Pengguna', 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs($item['route'].'*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                        {{ $item['label'] }}
                    </a>
                    @endforeach
                </nav>

                <div class="p-3 border-t border-white/10 flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Lihat Website
                    </a>
                    <div class="flex items-center gap-3 px-3 py-3 mt-1">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold gradient-primary flex-shrink-0">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-300 hover:text-white hover:bg-red-500/20 transition-colors">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div id="admin-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden"></div>

        <!-- Main content -->
        <div class="flex-1 lg:ml-64 min-w-0">
            <header class="sticky top-0 z-20 h-16 bg-white/95 backdrop-blur-xl border-b border-neutral-200 flex items-center gap-4 px-4 sm:px-6">
                <button id="admin-menu-btn" class="lg:hidden p-2 -ml-2 rounded-xl text-neutral-600 hover:bg-neutral-100" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-semibold text-neutral-900">@yield('title', 'Dashboard')</h1>
            </header>

            <main class="p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-primary-200 bg-primary-50 p-4 text-sm text-primary-800">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="font-medium mb-1">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-overlay');
        const menuBtn = document.getElementById('admin-menu-btn');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
        menuBtn?.addEventListener('click', openSidebar);
        overlay?.addEventListener('click', closeSidebar);
    </script>
    @stack('scripts')
</body>
</html>
