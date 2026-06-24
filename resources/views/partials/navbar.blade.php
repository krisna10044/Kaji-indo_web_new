<header class="sticky top-0 z-[9999] bg-white/95 backdrop-blur-md shadow-sm" x-data="{ mobileOpen: false }">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8" aria-label="Navigasi utama">

        {{-- Logo (kiri) --}}
        <div class="flex shrink-0 items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded-xl">
                <img
                    src="{{ asset('storage/logo/logo.png') }}"
                    alt="Logo KAJI Indonesia"
                    class="h-10 w-auto object-contain"
                />
                <span class="font-serif text-xl font-bold text-primary">KAJI Indonesia</span>
            </a>
        </div>

        {{-- Menu Tengah (hanya desktop) --}}
        <div class="hidden md:flex items-center gap-1">

            {{-- Beranda (tanpa dropdown) --}}
            <a href="{{ route('home') }}"
            class="relative rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-200
                {{ Request::routeIs('home') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-primary/10 hover:text-primary' }}">
                @if (Request::routeIs('home'))
                    <span class="absolute inset-x-2 bottom-1.5 h-0.5 rounded-full bg-primary"></span>
                @endif
                Beranda
            </a>

            {{-- Dropdown Pelatihan --}}
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); timer = setTimeout(() => open = true, 100)"
                 @mouseleave="clearTimeout(timer); open = false">
                <button class="flex items-center gap-1.5 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-200
                               {{ Request::routeIs('pelatihan.index') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-primary/10 hover:text-primary' }}">
                    Pelatihan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     x-cloak
                     class="absolute left-0 mt-1 w-64 origin-top-left rounded-2xl bg-white shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-5 py-3 border-b border-gray-100">
                        <p class="text-xs font-semibold text-primary uppercase tracking-wider">Program Pelatihan</p>
                    </div>
                    <a href="{{ route('pelatihan.program') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                       <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 group-hover/item:bg-emerald-100 transition-colors duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Program</p>
                            <p class="text-xs text-gray-400">Kurikulum & Materi Pelatihan</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('pelatihan.event') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Event</p>
                            <p class="text-xs text-gray-400">Acara Diluar Pelatihan</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('pelatihan.pembimbing') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Trainer</p>
                            <p class="text-xs text-gray-400">Instruktur</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="https://kamilatih.com/" target="_blank" rel="noopener noreferrer" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Selengkapnya</p>
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-1.5 py-0.5 text-xs font-medium text-primary ring-1 ring-primary/20">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">kamilatih.com</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="bg-gray-50/80 px-5 py-2.5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 text-center">KAJI Indonesia © {{ date('Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Dropdown UMKM --}}
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); timer = setTimeout(() => open = true, 100)"
                 @mouseleave="clearTimeout(timer); open = false">
                <button class="flex items-center gap-1.5 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-200
                               {{ Request::routeIs('umkm') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-primary/10 hover:text-primary' }}">
                    UMKM
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     x-cloak
                     class="absolute left-0 mt-1 w-64 origin-top-left rounded-2xl bg-white shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-5 py-3 border-b border-gray-100">
                        <p class="text-xs font-semibold text-primary uppercase tracking-wider">Pendampingan UMKM</p>
                    </div>
                    <a href="{{ route('umkm.produk') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">UMKM</p>
                            <p class="text-xs text-gray-400">Profile UMKM</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('umkm.pembimbing') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Mentor</p>
                            <p class="text-xs text-gray-400">Pendamping dan Fasilitator</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('umkm.lokasi') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Lokasi</p>
                            <p class="text-xs text-gray-400">Sebaran lokasi UMKM</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('umkm') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Selengkapnya</p>
                            <p class="text-xs text-gray-400">Semua layanan UMKM</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="bg-gray-50/80 px-5 py-2.5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 text-center">KAJI Indonesia © {{ date('Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Dropdown Halal Center --}}
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); timer = setTimeout(() => open = true, 100)"
                 @mouseleave="clearTimeout(timer); open = false">
                <button class="flex items-center gap-1.5 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-200
                               {{ Request::routeIs('halal-center') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-primary/10 hover:text-primary' }}">
                    Halal Center
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     x-cloak
                     class="absolute left-0 mt-1 w-64 origin-top-left rounded-2xl bg-white shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-5 py-3 border-b border-gray-100">
                        <p class="text-xs font-semibold text-primary uppercase tracking-wider">Sertifikasi Halal</p>
                    </div>
                    <a href="{{ route('halal-center.gratis') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 group-hover/item:bg-emerald-100 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Self-Diclare</p>
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-1.5 py-0.5 text-xs font-medium text-emerald-600 ring-1 ring-emerald-200">Free</span>
                            </div>
                            <p class="text-xs text-gray-400">Sertifikasi halal tanpa biaya</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('halal-center.berbayar') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Reguler</p>
                            <p class="text-xs text-gray-400">Layanan sertifikasi premium</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="https://halalcenter.co.id/" target="_blank" rel="noopener noreferrer" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Selengkapnya</p>
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-1.5 py-0.5 text-xs font-medium text-primary ring-1 ring-primary/20">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">Semua layanan halal center</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="bg-gray-50/80 px-5 py-2.5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 text-center">KAJI Indonesia © {{ date('Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Dropdown Konsultan --}}
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); timer = setTimeout(() => open = true, 100)"
                 @mouseleave="clearTimeout(timer); open = false">
                <button class="flex items-center gap-1.5 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-200
                               {{ Request::routeIs('konsultan') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-primary/10 hover:text-primary' }}">
                    Konsultan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     x-cloak
                     class="absolute left-0 mt-1 w-64 origin-top-left rounded-2xl bg-white shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-5 py-3 border-b border-gray-100">
                        <p class="text-xs font-semibold text-primary uppercase tracking-wider">Layanan Konsultan</p>
                    </div>
                    <a href="{{ route('konsultan.layanan') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Layanan</p>
                            <p class="text-xs text-gray-400">Jenis layanan konsultasi</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="{{ route('konsultan.paket') }}" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Paket</p>
                            <p class="text-xs text-gray-400">Pilihan paket konsultasi</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>
                    <a href="https://kopigaya.com/" target="_blank" rel="noopener noreferrer" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Konsultan Bisnis</p>
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-1.5 py-0.5 text-xs font-medium text-primary ring-1 ring-primary/20">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">kopigaya.com</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="https://sertifikatin.com/" target="_blank" rel="noopener noreferrer" @click="open = false"
                       class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Konsultan Legalitas</p>
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-1.5 py-0.5 text-xs font-medium text-primary ring-1 ring-primary/20">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">sertifikatin.com</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="bg-gray-50/80 px-5 py-2.5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 text-center">KAJI Indonesia © {{ date('Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Dropdown Media --}}
            <div class="relative" x-data="{ open: false, timer: null }"
                @mouseenter="clearTimeout(timer); timer = setTimeout(() => open = true, 100)"
                @mouseleave="clearTimeout(timer); open = false">
                <button class="flex items-center gap-1.5 rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-200
                            {{ Request::routeIs('media') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:bg-primary/10 hover:text-primary' }}">
                    Media
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                    x-cloak
                    class="absolute left-0 mt-1 w-64 origin-top-left rounded-2xl bg-white shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-5 py-3 border-b border-gray-100">
                        <p class="text-xs font-semibold text-primary uppercase tracking-wider">Kanal Media</p>
                    </div>

                    {{-- Dokumentasi Kegiatan --}}
<a href="{{ route('media') }}" @click="open = false"
   class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
   {{-- BARU --}}
<div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary/10 group-hover/item:bg-primary/20 transition-colors duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg>
</div>
    <div>
        <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Dokumentasi Kegiatan</p>
        <p class="text-xs text-gray-400">Foto & video kegiatan KAJI</p>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary group-hover/item:translate-x-0.5 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
</a>
<div class="mx-5 border-t border-gray-100"></div>

                    {{-- Info Jawa Timur --}}
                    <a href="https://www.infojawatimur.com/" target="_blank" rel="noopener noreferrer" @click="open = false"
                    class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 group-hover/item:bg-emerald-100 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Info Jawa Timur</p>
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-1.5 py-0.5 text-xs font-medium text-emerald-600 ring-1 ring-emerald-200">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">www.infojawatimur.com</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>

                    {{-- Ini Jawa Timur --}}
                    <a href="https://www.inijawatimur.com/" target="_blank" rel="noopener noreferrer" @click="open = false"
                    class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 group-hover/item:bg-emerald-100 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Ini Jawa Timur</p>
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-1.5 py-0.5 text-xs font-medium text-emerald-600 ring-1 ring-emerald-200">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">www.inijawatimur.com</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="mx-5 border-t border-gray-100"></div>

                    {{-- Donasi --}}
                    <a href="https://berkahin.id/" target="_blank" rel="noopener noreferrer" @click="open = false"
                    class="group/item flex items-center gap-3 px-5 py-3.5 transition-all duration-200 hover:bg-primary/5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 group-hover/item:bg-emerald-100 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <p class="text-sm font-semibold text-gray-800 group-hover/item:text-primary transition-colors duration-200">Donasi</p>
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-1.5 py-0.5 text-xs font-medium text-emerald-600 ring-1 ring-emerald-200">Eksternal</span>
                            </div>
                            <p class="text-xs text-gray-400">berkahin.id</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-4 w-4 text-gray-300 group-hover/item:text-primary transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <div class="bg-gray-50/80 px-5 py-2.5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 text-center">KAJI Indonesia © {{ date('Y') }}</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ============================================================
             KANAN: Desktop profile + Mobile hamburger SAJA
             ============================================================ --}}
        <div class="flex shrink-0 items-center gap-3">

            {{-- Desktop: Avatar + divider + logout --}}
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('profile') }}" class="group flex flex-col items-center gap-1">
                        <div class="h-11 w-11 flex items-center justify-center rounded-xl bg-white text-white font-bold text-base shadow-sm transition group-hover:scale-105 border-2 border-white ring-2 ring-primary/20 overflow-hidden">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                     alt="Foto Profil"
                                     class="w-full h-full object-cover">
                            @else
                                <span class="text-primary">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                            @endif
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-[0.15em] text-gray-400 group-hover:text-primary transition-colors">
                        {{-- Sesudahnya --}}
{{ match(Auth::user()->role) {
    'trainer' => 'TRAINER',
    'mentor'  => 'MENTOR',
    'umkm'    => 'UMKM',
    'admin'   => 'ADMIN',
    'umum'    => 'MEMBER',
    default   => strtoupper(Auth::user()->role),
} }}
                        </span>
                    </a>
                    <div class="h-8 w-[1px] bg-gray-200"></div>
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-all hover:bg-red-50 rounded-lg" title="Keluar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-xl border-2 border-primary px-5 py-2.5 text-sm font-semibold text-primary transition hover:bg-primary/10">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:bg-primary-dark">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile: Hamburger SAJA (avatar + logout pindah ke drawer) --}}
            <div class="flex md:hidden items-center">
                <button type="button"
                        class="flex h-10 w-10 items-center justify-center rounded-xl text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary"
                        aria-label="Buka menu"
                        :aria-expanded="mobileOpen"
                        @click="mobileOpen = !mobileOpen">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileOpen">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileOpen" x-cloak style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>

    </nav>

    {{-- ============================================================
         MOBILE DRAWER
         ============================================================ --}}
    <div class="border-t border-gray-200/80 bg-white/95 backdrop-blur-md md:hidden"
         x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         style="display: none;"
         @click.away="mobileOpen = false">
        <div class="mx-auto max-w-7xl space-y-0.5 px-4 py-3 pb-4">

            {{-- ── PROFIL SECTION (hanya saat login) ── --}}
            @auth
            <div class="mb-2 flex items-center gap-3 rounded-2xl bg-primary/5 px-4 py-3 border border-primary/10">
                <div class="h-10 w-10 shrink-0 flex items-center justify-center rounded-xl overflow-hidden ring-2 ring-primary/20">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                             alt="Foto Profil"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-primary font-bold text-sm bg-primary/10 w-full h-full flex items-center justify-center">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-primary font-medium">
                        {{ match(Auth::user()->role) {
                            'trainer' => 'Trainer',
                            'mentor'  => 'Mentor',
                            'umkm'    => 'Mitra UMKM',
                            'admin'   => 'Admin',
                            default   => 'Member',
                        } }}
                    </p>
                </div>
                <a href="{{ route('profile') }}"
                   @click="mobileOpen = false"
                   class="shrink-0 rounded-lg bg-white border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-600 hover:text-primary hover:border-primary transition">
                    Edit Profil
                </a>
            </div>
            @endauth

            {{-- ── MENU NAVIGASI ── --}}
            <a href="{{ route('home') }}"
               class="block rounded-xl px-4 py-3 text-sm font-medium {{ Request::routeIs('home') ? 'bg-primary/15 text-primary' : 'text-gray-700 hover:bg-gray-100' }}"
               @click="mobileOpen = false">
                Beranda
            </a>

            {{-- Mobile Accordion: Pelatihan --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Pelatihan
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': sub }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="sub" x-cloak class="pl-4 pb-1">
                    <a href="{{ route('pelatihan.program') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Program</a>
                    <a href="{{ route('pelatihan.event') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Event</a>
                    <a href="{{ route('pelatihan.pembimbing') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Trainer</a>
                    <a href="https://kamilatih.com/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Selengkapnya ↗</a>
                </div>
            </div>

            {{-- Mobile Accordion: UMKM --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    UMKM
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': sub }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="sub" x-cloak class="pl-4 pb-1">
                    <a href="{{ route('umkm.produk') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">UMKM</a>
                    <a href="{{ route('umkm.pembimbing') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Mentor</a>
                    <a href="{{ route('umkm.lokasi') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Lokasi</a>
                    <a href="{{ route('umkm') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Selengkapnya</a>
                </div>
            </div>

            {{-- Mobile Accordion: Halal Center --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Halal Center
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': sub }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="sub" x-cloak class="pl-4 pb-1">
                    <a href="{{ route('halal-center.gratis') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Self Diclare</a>
                    <a href="{{ route('halal-center.berbayar') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Reguler</a>
                    <a href="https://halalcenter.co.id/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Selengkapnya ↗</a>
                </div>
            </div>

            {{-- Mobile Accordion: Konsultan --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Konsultan
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': sub }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="sub" x-cloak class="pl-4 pb-1">
                    <a href="{{ route('konsultan.layanan') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Layanan</a>
                    <a href="{{ route('konsultan.paket') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Paket</a>
                    <a href="https://kopigaya.com/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Konsultan Bisnis ↗</a>
                    <a href="https://sertifikatin.com/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Konsultan Legalitas ↗</a>
                </div>
            </div>

           {{-- Mobile Accordion: Media --}}
<div x-data="{ sub: false }">
    <button @click="sub = !sub" class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100">
        Media
        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': sub }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="sub" x-cloak class="pl-4 pb-1">
        <a href="{{ route('media') }}" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Dokumentasi Kegiatan</a>
        <a href="https://www.infojawatimur.com/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Info Jawa Timur ↗</a>
        <a href="https://www.inijawatimur.com/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Ini Jawa Timur ↗</a>
        <a href="https://berkahin.id/" target="_blank" rel="noopener noreferrer" class="block pl-4 py-2.5 text-sm text-gray-600 hover:text-primary" @click="mobileOpen = false">Donasi ↗</a>
    </div>
</div>
            {{-- ── FOOTER DRAWER: Login/Daftar (guest) atau Logout (auth) ── --}}
            @guest
                <div class="mt-3 flex flex-col gap-2 border-t border-gray-200 pt-3">
                    <a href="{{ route('login') }}" class="rounded-xl border-2 border-primary px-4 py-3 text-center text-sm font-semibold text-primary" @click="mobileOpen = false">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-xl bg-primary px-4 py-3 text-center text-sm font-semibold text-white" @click="mobileOpen = false">Daftar</a>
                </div>
            @else
                {{-- ── TOMBOL LOGOUT di paling bawah drawer ── --}}
                <div class="mt-3 border-t border-gray-200 pt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-red-500 hover:bg-red-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar dari Akun
                        </button>
                    </form>
                </div>
            @endauth

        </div>
    </div>
</header>