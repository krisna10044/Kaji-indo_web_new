{{-- resources/views/pages/pelatihan-event-detail.blade.php --}}
@extends('layouts.app')

@section('title', $event->judul . ' - KAJI INDONESIA')

@section('content')

    {{-- Header --}}
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-10 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}" class="text-white/80 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="font-serif text-2xl font-bold">Detail Event</h1>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-12 px-4 min-h-screen">
        <div class="max-w-3xl mx-auto space-y-6">

            {{-- ── Hero Card ───────────────────────────────────────── --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200">

                {{-- Gambar Banner --}}
                @if($event->gambar)
                    <img src="{{ asset('storage/' . $event->gambar) }}"
                         alt="{{ $event->judul }}"
                         class="w-full object-cover max-h-64">
                @else
                    <div class="w-full h-48 flex items-center justify-center text-7xl bg-gradient-to-br from-green-100 to-green-300">
                        🎪
                    </div>
                @endif

                <div class="p-6">
                    {{-- Judul --}}
                    <h1 class="font-serif text-2xl font-bold text-gray-900 mb-5">
                        {{ $event->judul }}
                    </h1>

                    {{-- Info grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

                        {{-- Tanggal --}}
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-0.5">Tanggal</div>
                                <div class="text-sm font-bold text-green-800">
                                    {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d F Y') }}
                                </div>
                            </div>
                        </div>

                        {{-- Waktu --}}
                        @if($event->waktu_mulai && $event->waktu_selesai)
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-0.5">Waktu</div>
                                <div class="text-sm font-bold text-green-800">{{ $event->jam }}</div>
                            </div>
                        </div>
                        @endif

                        {{-- Lokasi --}}
                        @if($event->lokasi)
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-0.5">Lokasi</div>
                                <div class="text-sm font-bold text-green-800">{{ $event->lokasi }}</div>
                            </div>
                        </div>
                        @endif

                        {{-- Kapasitas --}}
                        @if($event->kapasitas)
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-0.5">Kapasitas</div>
                                <div class="text-sm font-bold text-green-800">{{ $event->kapasitas }} Peserta</div>
                            </div>
                        </div>
                        @endif

                        {{-- Biaya --}}
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-0.5">Biaya</div>
                                <div class="text-sm font-bold {{ $event->biaya_label === 'Gratis' ? 'text-green-600' : 'text-orange-600' }}">
                                    {{ $event->biaya_label }}
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Tombol Daftar --}}
                    @php
                    $waPhone = $event->phone ?? $event->trainer?->phone ?? '6281234567890';
                        $waText  = urlencode('Halo, saya ingin mendaftar event: ' . $event->judul . ' pada ' . \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y'));
                    @endphp
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/{{ $waPhone }}?text={{ $waText }}"
                           target="_blank"
                           class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-6 py-3 rounded-xl transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Daftar via WhatsApp
                        </a>
                        <a href="{{ route('pelatihan.event') }}"
                           class="border border-green-600 text-green-700 hover:bg-green-50 text-sm font-bold px-5 py-3 rounded-xl transition-colors">
                            ← Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Deskripsi ─────────────────────────────────────── --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">
                    Tentang Event Ini
                </h2>
                <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $event->deskripsi }}
                </div>
            </div>

            {{-- ── Informasi Teknis ──────────────────────────────── --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">
                    Informasi Teknis
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Nama Event</div>
                        <div class="text-sm font-semibold text-green-900">{{ $event->judul }}</div>
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Tanggal</div>
                        <div class="text-sm font-semibold text-green-900">
                            {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d F Y') }}
                        </div>
                    </div>
                    @if($event->waktu_mulai && $event->waktu_selesai)
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Waktu</div>
                        <div class="text-sm font-semibold text-green-900">{{ $event->jam }}</div>
                    </div>
                    @endif
                    @if($event->lokasi)
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Lokasi</div>
                        <div class="text-sm font-semibold text-green-900">{{ $event->lokasi }}</div>
                    </div>
                    @endif
                    @if($event->kapasitas)
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Kapasitas</div>
                        <div class="text-sm font-semibold text-green-900">{{ $event->kapasitas }} Peserta</div>
                    </div>
                    @endif
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Biaya</div>
                        <div class="text-sm font-semibold {{ $event->biaya_label === 'Gratis' ? 'text-green-600' : 'text-orange-600' }}">
                            {{ $event->biaya_label }}
                        </div>
                    </div>
                    <div>
    <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">Penyelenggara</div>
    <div class="text-sm font-semibold text-green-900">
        {{ \App\Models\Trainer::where('user_id', $event->trainer_id)->value('academic_degree') ?? $event->trainer?->name ?? 'KAJI INDONESIA' }}
    </div>
</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection