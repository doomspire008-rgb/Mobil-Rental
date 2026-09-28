<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rental Mobil Terpercaya - Sewa mobil dengan harga terjangkau, armada lengkap, dan layanan 24 jam. Booking online mudah dan cepat.">
    <meta name="keywords" content="rental mobil, sewa mobil, rental mobil murah, sewa mobil harian, sewa mobil bulanan">
    <meta name="author" content="RentalMobilku">
    <title>@yield('title', 'RentalMobilku - Sewa Mobil Terpercaya & Terjangkau')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans text-neutral-900 bg-neutral-50 antialiased">
    @include('partials.navigation')
    
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    @stack('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    const expanded = mobileMenuBtn.getAttribute('aria-expanded') === 'true';
                    mobileMenuBtn.setAttribute('aria-expanded', !expanded);
                });
            }
            
            const dropdownTriggers = document.querySelectorAll('[data-dropdown-trigger]');
            dropdownTriggers.forEach(trigger => {
                const dropdown = document.getElementById(trigger.getAttribute('data-dropdown-trigger'));
                if (!dropdown) return;
                
                let timeout;
                
                const show = () => {
                    clearTimeout(timeout);
                    dropdown.classList.remove('opacity-0', 'invisible', 'translate-y-2');
                    dropdown.classList.add('opacity-100', 'visible', 'translate-y-0');
                };
                
                const hide = () => {
                    timeout = setTimeout(() => {
                        dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
                        dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    }, 150);
                };
                
                trigger.addEventListener('mouseenter', show);
                trigger.addEventListener('mouseleave', hide);
                dropdown.addEventListener('mouseenter', show);
                dropdown.addEventListener('mouseleave', hide);
            });
            
            const scrollRevealElements = document.querySelectorAll('[data-reveal]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-slide-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px' });
            
            scrollRevealElements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>