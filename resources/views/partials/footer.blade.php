<footer class="border-t border-gray-200 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            {{-- Brand --}}
            <div class="lg:col-span-1">
               <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
    <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo Kaji Indonesia" class="h-10 w-auto object-contain" />
    <span class="font-serif text-xl font-bold text-primary">KAJI Indonesia</span>
</a>
                <p class="mt-3 text-sm text-gray-600">
                    Membangun Indonesia melalui kajian, pelatihan, dan pendampingan UMKM serta layanan halal & konsultan.
                </p>
            </div>
            {{-- Links --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Layanan</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="{{ route('pelatihan.index') }}" class="text-sm text-gray-600 hover:text-primary">Pelatihan</a></li>
                    <li><a href="{{ route('umkm') }}" class="text-sm text-gray-600 hover:text-primary">UMKM</a></li>
                    <li><a href="{{ route('halal-center') }}" class="text-sm text-gray-600 hover:text-primary">Halal Center</a></li>
                    <li><a href="{{ route('konsultan') }}" class="text-sm text-gray-600 hover:text-primary">Konsultan</a></li>
                    <li><a href="{{ route('media') }}" class="text-sm text-gray-600 hover:text-primary">Media</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Perusahaan</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="{{ route('home') }}#tentang-kami" class="text-sm text-gray-600 hover:text-primary">Tentang Kami</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="text-sm text-gray-600 hover:text-primary">Layanan Unggulan</a></li>
                    <li><a href="{{ route('home') }}#kontak" class="text-sm text-gray-600 hover:text-primary">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Kontak</h3>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li>info@kajiindonesia.com</li>
                    <li>+62 812 3456 7890</li>
                    <li>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-gray-200 pt-8 sm:flex-row">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} KAJI Indonesia. Hak cipta dilindungi.</p>
            <div class="flex gap-6 text-sm text-gray-500">
                <a href="#" class="hover:text-primary">Kebijakan Privasi</a>
                <a href="#" class="hover:text-primary">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
