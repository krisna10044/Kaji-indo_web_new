@extends('layouts.app')

@section('content')

{{-- Header --}}
<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
        <a href="{{ route('umkm.produk') }}" class="text-white/80 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="font-serif text-2xl font-bold">Detail Produk</h1>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-12 px-4 min-h-screen">
    <h2 class="font-serif text-center text-2xl font-bold text-gray-900 mb-10">Detail Produk</h2>

    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KOLOM KIRI: Foto Produk Item Unggulan --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-4 rounded-2xl border shadow-sm text-center">
                <h4 class="font-serif font-bold text-lg text-gray-900 mb-1">{{ $item->nama }}</h4>
                <p class="text-xs text-green-700 font-semibold mb-4">{{ $produk->nama }}</p>

                <div class="relative rounded-xl overflow-hidden shadow-md bg-gray-50 border border-gray-100" style="aspect-ratio: 3/4;">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             class="w-full h-full object-cover object-top"
                             alt="{{ $item->nama }}">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Foto belum tersedia</span>
                        </div>
                    @endif

                    @if($produk->logo)
                        <img src="{{ asset('storage/' . $produk->logo) }}"
                             alt="Logo {{ $produk->nama }}"
                             class="absolute top-3 right-3 w-16 h-16 object-contain bg-white/95 rounded-xl p-1.5 shadow-md border border-gray-200/50">
                    @endif
                </div>
            </div>
        </div>

        {{-- KOLOM TENGAH: Info & Tombol --}}
        <div class="flex flex-col gap-6">

            {{-- Info Box --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex-1">

                @if ($item->harga)
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Harga</p>
                    <p class="text-green-600 font-semibold text-lg">{{ $item->harga_format }}</p>
                </div>
                @endif

                @if ($item->kategori)
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Kategori</p>
                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full mt-1">
                        {{ $item->kategori }}
                    </span>
                </div>
                @endif

                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Keterangan</p>
                    <p class="text-gray-600 text-sm leading-relaxed mt-1">{{ $item->deskripsi }}</p>
                </div>

                @if ($item->stok)
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Stok</p>
                    <p class="text-gray-600 text-sm mt-1">{{ $item->stok }} {{ $item->satuan }}</p>
                </div>
                @endif

                @if ($produk->alamat)
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Alamat</p>
                    <p class="text-gray-600 text-sm mt-1">{{ $produk->alamat }}</p>
                </div>
                @endif

                @php
                    $nomorWa = preg_replace('/[^0-9]/', '', $produk->whatsapp ?? $produk->kontak ?? '');
                    if ($nomorWa && str_starts_with($nomorWa, '0')) {
                        $nomorWa = '62' . substr($nomorWa, 1);
                    }
                    $pesanWa = urlencode('Halo UMKM ' . $produk->nama . ', saya tertarik dengan produk ' . $item->nama . ' setelah melihatnya di website KAJI Indonesia.' . "\n" . 'Boleh tanya-tanya lebih lanjut atau pesan produknya? Terima kasih!');
                @endphp

            </div>

            {{-- Tombol --}}
            <div class="flex flex-col gap-3">
                @if ($nomorWa)
                <a href="https://wa.me/{{ $nomorWa }}?text={{ $pesanWa }}"
                   target="_blank"
                   class="flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold text-center py-4 rounded-xl transition-colors duration-200 text-base shadow-sm">
                    Chat WhatsApp
                </a>
                @endif

                @if ($produk->alamat)
                <a href="https://maps.google.com/?q={{ urlencode($produk->alamat) }}"
                   target="_blank"
                   class="bg-orange-400 hover:bg-orange-500 text-white font-semibold text-center py-4 rounded-xl transition-colors duration-200 text-base shadow-sm">
                    Lihat Alamat
                </a>
                @endif
            </div>

        </div>

        {{-- KOLOM KANAN: Produk Lain dari UMKM yang Sama --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h3 class="font-serif font-bold text-gray-900 text-lg text-center mb-1">Produk Lainnya</h3>
            <p class="text-xs text-green-700 text-center mb-4">dari {{ $produk->nama }}</p>

            <div class="flex flex-col gap-4 max-h-[600px] overflow-y-auto pr-1">
                @forelse ($itemLainnya as $lain)
                <a href="{{ route('produk.show', $lain->id) }}"
                   class="flex flex-col items-center gap-2 group border-b border-gray-100 pb-3 last:border-0">
                    @if ($lain->foto)
                        <img src="{{ asset('storage/' . $lain->foto) }}"
                             alt="{{ $lain->nama }}"
                             class="w-full h-28 object-cover rounded-xl group-hover:opacity-90 transition shadow-sm">
                    @else
                        <div class="w-full h-24 bg-gray-200 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400 text-xs">Tidak ada foto</span>
                        </div>
                    @endif
                    <p class="text-sm text-gray-700 font-medium text-center group-hover:text-green-600 transition truncate w-full px-2">
                        {{ $lain->nama }}
                    </p>
                    @if($lain->harga)
                    <p class="text-xs text-green-600 font-semibold">{{ $lain->harga_format }}</p>
                    @endif
                </a>
                @empty
                <div class="text-center text-gray-400 text-sm py-10">
                    Tidak ada produk lain dari UMKM ini.
                </div>
                @endforelse
            </div>
        </div>

    </div>

</section>

@endsection