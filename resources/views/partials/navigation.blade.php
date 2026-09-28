<header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-xl border-b border-neutral-200 transition-all duration-300">
    <nav class="container-custom" aria-label="Main navigation">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-neutral-900" aria-label="RentalMobilku Home">
                    <svg class="w-8 h-8 text-primary-600" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect width="32" height="32" rx="8" fill="currentColor"/>
                        <path d="M8 20H24M10 20V14C10 11.7909 11.7909 10 14 10H18C20.2091 10 22 11.7909 22 14V20" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="11" cy="20" r="2" fill="white"/>
                        <circle cx="21" cy="20" r="2" fill="white"/>
                    </svg>
                    <span class="font-bold text-xl tracking-tight">RentalMobilku</span>
                </a>
                
                <div class="hidden md:flex items-center gap-1" role="navigation" aria-label="Main menu">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Beranda</a>
                    <a href="#armada" class="px-4 py-2 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Armada</a>
                    <a href="#harga" class="px-4 py-2 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Harga</a>
                    <a href="#tentang" class="px-4 py-2 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Tentang</a>
                    <a href="#kontak" class="px-4 py-2 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Kontak</a>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Admin Panel
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="hidden sm:block px-5 py-2.5 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-primary btn-sm">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2.5 rounded-xl text-sm font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary btn-sm hidden sm:block">Daftar</a>
                @endauth
                
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-xl text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900 transition-colors" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="mobile-menu" class="md:hidden hidden overflow-hidden transition-all duration-300 bg-white border-t border-neutral-200">
            <div class="container-custom py-6 space-y-4">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Beranda</a>
                <a href="#armada" class="block px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Armada</a>
                <a href="#harga" class="block px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Harga</a>
                <a href="#tentang" class="block px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Tentang</a>
                <a href="#kontak" class="block px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors">Kontak</a>
                <div class="pt-4 border-t border-neutral-200 flex flex-col gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors text-center">Admin Panel</a>
                        @else
                        <a href="{{ route('dashboard') }}" class="px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors text-center">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-primary btn-sm w-full text-center">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-3 rounded-xl text-base font-medium text-neutral-600 hover:text-primary-600 hover:bg-primary-50 transition-colors text-center">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary btn-sm text-center">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>