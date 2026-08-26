@php
    $isLightPage = request()->routeIs('login', 'register');
@endphp

<header id="main-navbar" 
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 {{ $isLightPage ? 'navbar-scrolled bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs' : 'navbar-transparent bg-transparent border-b border-transparent shadow-none' }}" 
        data-transparent="{{ $isLightPage ? 'false' : 'true' }}">
    <nav class="container-custom" aria-label="Main navigation">
        <div class="flex h-20 items-center justify-between transition-all duration-300" id="navbar-container">
            <!-- Brand Logo -->
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center group" aria-label="RentalMobilku Home">
                    <div>
                        <span class="nav-brand-title font-extrabold text-2xl tracking-tight leading-none block transition-colors duration-300">
                            Rental<span class="nav-brand-accent transition-colors duration-300">Mobilku</span>
                        </span>
                    </div>
                </a>
                
                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link-inactive' }}">Beranda</a>
                    <a href="{{ route('cars.index') }}" class="px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('cars.*') ? 'nav-link-active' : 'nav-link-inactive' }}">Armada Mobil</a>
                    <a href="{{ route('home') }}#layanan" class="nav-link-inactive px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200">Layanan</a>
                    <a href="{{ route('home') }}#cara-kerja" class="nav-link-inactive px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200">Cara Kerja</a>
                    <a href="{{ route('home') }}#testimoni" class="nav-link-inactive px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200">Testimoni</a>
                    <a href="{{ route('home') }}#faq" class="nav-link-inactive px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200">FAQ</a>
                </div>
            </div>
            
            <!-- Auth / Profile Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    <!-- User is Logged In -->
                    <div class="relative" id="user-dropdown-container">
                        <button onclick="toggleUserDropdown()" class="nav-user-btn flex items-center gap-2.5 p-1.5 pr-3.5 rounded-xl border transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div class="text-left hidden sm:block">
                                <p class="nav-user-name text-xs font-bold leading-tight transition-colors duration-300">{{ auth()->user()->name }}</p>
                                <p class="nav-user-role text-[10px] transition-colors duration-300">{{ auth()->user()->isAdmin() ? 'Administrator' : 'Customer' }}</p>
                            </div>
                            <svg class="nav-user-icon w-4 h-4 ml-1 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl border border-slate-200 shadow-xl py-2 z-50 animate-fade-in">
                            <div class="px-4 py-2.5 border-b border-slate-100">
                                <p class="text-xs font-bold text-slate-900">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-slate-400 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-blue-600 hover:bg-blue-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Admin Panel
                                </a>
                            @endif

                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard Pelanggan
                            </a>

                            <a href="{{ route('cars.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 5h8m-8 5h8M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/></svg>
                                Sewa Mobil Baru
                            </a>

                            <div class="border-t border-slate-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="nav-login-btn hidden sm:inline-flex px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary btn-sm shadow-md shadow-blue-500/20">
                        Daftar Sekarang
                    </a>
                @endauth
                
                <!-- Mobile Menu Hamburger Button -->
                <button id="mobile-menu-btn" class="nav-mobile-toggle lg:hidden p-2 rounded-xl transition-all duration-300" aria-label="Toggle menu" onclick="toggleMobileNav()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Dropdown Navigation -->
        <div id="mobile-menu" class="lg:hidden hidden border border-slate-200/80 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl py-4 px-3 mb-3 space-y-1 animate-fade-in">
            <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600">Beranda</a>
            <a href="{{ route('cars.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600">Armada Mobil</a>
            <a href="{{ route('home') }}#layanan" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600">Layanan</a>
            <a href="{{ route('home') }}#cara-kerja" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600">Cara Kerja</a>
            <a href="{{ route('home') }}#testimoni" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600">Testimoni</a>
            <a href="{{ route('home') }}#faq" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600">FAQ</a>

            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary btn-sm text-center">Buka Admin Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-primary btn-sm text-center">Dashboard Saya</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full btn-secondary btn-sm text-center">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary btn-sm text-center">Masuk ke Akun</a>
                    <a href="{{ route('register') }}" class="btn-primary btn-sm text-center">Daftar Akun Baru</a>
                @endauth
            </div>
        </div>
    </nav>
</header>

<script>
(function() {
    function initNavbar() {
        const navbar = document.getElementById('main-navbar');
        if (!navbar) return;

        const isTransparentAllowed = navbar.getAttribute('data-transparent') === 'true';

        function handleScroll() {
            if (!isTransparentAllowed) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.remove('navbar-transparent');
                return;
            }

            if (window.scrollY > 20) {
                if (!navbar.classList.contains('navbar-scrolled')) {
                    navbar.classList.add('navbar-scrolled');
                    navbar.classList.remove('navbar-transparent');
                }
            } else {
                if (!navbar.classList.contains('navbar-transparent')) {
                    navbar.classList.remove('navbar-scrolled');
                    navbar.classList.add('navbar-transparent');
                }
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavbar);
    } else {
        initNavbar();
    }
})();

function toggleUserDropdown() {
    const dropdown = document.getElementById('user-dropdown');
    if (dropdown) dropdown.classList.toggle('hidden');
}

function toggleMobileNav() {
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) mobileMenu.classList.toggle('hidden');
}

// Close dropdown on outside click
document.addEventListener('click', function(event) {
    const container = document.getElementById('user-dropdown-container');
    const dropdown = document.getElementById('user-dropdown');
    if (container && dropdown && !container.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
