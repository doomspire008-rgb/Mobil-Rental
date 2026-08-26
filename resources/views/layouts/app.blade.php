<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RentalMobilku - Platform rental mobil terpercaya di Indonesia. Sewa mobil harian, bulanan, lepas kunci atau dengan supir profesional.">
    <meta name="keywords" content="rental mobil, sewa mobil murah, sewa mobil lepas kunci, rental innova zenix, rental avanza, rental fortuner, rental mobil jakarta">
    <meta name="author" content="RentalMobilku">
    <title>@yield('title', 'RentalMobilku - Sewa Mobil Terpercaya & Terjangkau')</title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans text-slate-900 bg-slate-50 antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen">
    @include('partials.navigation')
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed bottom-6 right-6 z-50 max-w-md bg-emerald-600 text-white px-5 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-fade-in" id="flash-success">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
            <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-white/80 hover:text-white">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-6 right-6 z-50 max-w-md bg-red-600 text-white px-5 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-fade-in" id="flash-error">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
            <button onclick="document.getElementById('flash-error').remove()" class="ml-auto text-white/80 hover:text-white">&times;</button>
        </div>
    @endif
    
    <main class="flex-grow">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    @stack('scripts')
    
    <script>
        // Auto dismiss flash after 5 seconds
        setTimeout(() => {
            const successMsg = document.getElementById('flash-success');
            if (successMsg) successMsg.style.display = 'none';
            const errorMsg = document.getElementById('flash-error');
            if (errorMsg) errorMsg.style.display = 'none';
        }, 5000);
    </script>
</body>
</html>