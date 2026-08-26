<footer class="bg-slate-950 text-slate-400 border-t border-slate-900" role="contentinfo" id="kontak">
    <div class="container-custom pt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8 pb-12 border-b border-slate-800/80">
            <!-- Brand & Bio (2 Cols) -->
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 10.9 2 11.4 2 12v4c0 .6.4 1 1 1h2"/>
                            <circle cx="7" cy="17" r="2"/>
                            <path d="M9 17h6"/>
                            <circle cx="17" cy="17" r="2"/>
                        </svg>
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-white">Rental<span class="text-blue-500">Mobilku</span></span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed mb-6 max-w-sm">
                    Platform persewaan mobil terdepan di Indonesia. Menghadirkan armada berkualitas prima, asuransi all-risk inklusif, dan driver berpengalaman untuk segala kebutuhan mobilitas Anda.
                </p>
                <div class="flex items-center gap-3">
                    <span class="badge-neutral bg-slate-900 border-slate-800 text-slate-300 text-xs py-1 px-3">
                        ⭐ 4.9/5 Rating Kepuasan
                    </span>
                    <span class="badge-neutral bg-slate-900 border-slate-800 text-slate-300 text-xs py-1 px-3">
                        🛡️ 100% Asuransi All-Risk
                    </span>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-white text-sm mb-4">Navigasi Cepat</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('cars.index') }}" class="hover:text-white transition-colors">Semua Armada Mobil</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-white transition-colors">Pilihan Layanan</a></li>
                    <li><a href="{{ route('home') }}#cara-kerja" class="hover:text-white transition-colors">Cara Kerja</a></li>
                    <li><a href="{{ route('home') }}#testimoni" class="hover:text-white transition-colors">Testimoni Pelanggan</a></li>
                    <li><a href="{{ route('home') }}#faq" class="hover:text-white transition-colors">Pertanyaan Umum (FAQ)</a></li>
                </ul>
            </div>
            
            <!-- Popular Fleet Categories -->
            <div>
                <h3 class="font-bold text-white text-sm mb-4">Kategori Populer</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('cars.index', ['category' => 'mpv']) }}" class="hover:text-white transition-colors">MPV Keluarga (Avanza, Zenix)</a></li>
                    <li><a href="{{ route('cars.index', ['category' => 'suv']) }}" class="hover:text-white transition-colors">SUV Tangguh (Fortuner, Xpander)</a></li>
                    <li><a href="{{ route('cars.index', ['category' => 'sedan']) }}" class="hover:text-white transition-colors">Sedan Sporty (Civic RS)</a></li>
                    <li><a href="{{ route('cars.index', ['category' => 'luxury']) }}" class="hover:text-white transition-colors">Luxury Executive (BMW 5 Series)</a></li>
                    <li><a href="{{ route('cars.index', ['category' => 'electric']) }}" class="hover:text-white transition-colors">Mobil Listrik EV (Tesla, Ioniq)</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h3 class="font-bold text-white text-sm mb-4">Hubungi Kami</h3>
                <div class="space-y-3 text-sm">
                    <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Seteran+Tengah+No.9,+Semarang" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="flex items-start gap-2.5 text-slate-300 hover:text-blue-400 transition-colors group"
                       title="Buka rute di Google Maps">
                        <svg class="w-4 h-4 text-blue-500 mt-1 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="underline-offset-2 group-hover:underline leading-relaxed">Jl. Seteran Tengah No. 9, Semarang</span>
                    </a>
                    <p class="flex items-center gap-2.5 text-slate-300">
                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="https://wa.me/6281299779053" target="_blank" class="hover:text-emerald-400 transition-colors">0812-9977-9053</a>
                    </p>
                    <p class="flex items-center gap-2.5 text-slate-300">
                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:doomspire008@gmail.com" class="hover:text-blue-400 transition-colors">doomspire008@gmail.com</a>
                    </p>
                    <p class="flex items-center gap-2.5 text-slate-300">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Senin - Minggu: 24 Jam Siaga</span>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Bottom Row -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} RentalMobilku Indonesia. Seluruh hak cipta dilindungi undang-undang.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-slate-400 transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-slate-400 transition-colors">Kebijakan Privasi</a>
                <a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors">Login Karyawan / Admin</a>
            </div>
        </div>
    </div>
</footer>
