@extends('layouts.app')

@section('title', 'Profil Trainer – ' . $trainer->name)

@section('content')

{{-- Header --}}
<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
        <a href="{{ route('pelatihan.pembimbing') }}"
   class="flex items-center justify-center w-8 h-8 rounded-full
          hover:bg-white/20 transition-colors">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="font-serif text-2xl font-bold">Profil Trainer</h1>
        </div>
    </div>
</section>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 space-y-5">

    {{-- ── Kartu Utama ─────────────────────────────────────── --}}
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">

    {{-- Foto header full width di mobile, sidebar di desktop --}}
    <div class="flex flex-col sm:flex-row">

        {{-- Foto --}}
        <div class="w-full sm:w-44 sm:min-h-full bg-green-100 flex-shrink-0 overflow-hidden"
             style="min-height: 180px;">
            @if($trainer->foto)
                <img src="{{ asset('storage/' . $trainer->foto) }}"
                     alt="{{ $trainer->name }}"
                     class="w-full h-full object-cover object-top"
                     style="min-height:180px">
            @elseif($trainer->profile_photo_path)
                <img src="{{ asset('storage/' . $trainer->profile_photo_path) }}"
                     alt="{{ $trainer->name }}"
                     class="w-full h-full object-cover object-top"
                     style="min-height:180px">
            @else
                <div class="w-full h-full flex items-center justify-center
                            text-5xl font-bold text-green-800"
                     style="min-height:180px">
                    {{ strtoupper(substr($trainer->name, 0, 2)) }}
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="p-6 flex-1 min-w-0">
                @if($trainer->bidang_keahlian)
<div class="flex flex-wrap gap-1.5 mb-3">
    @foreach(array_filter(array_map('trim', explode(',', $trainer->bidang_keahlian))) as $keahlian)
    <span class="inline-block bg-green-100 text-green-700 text-xs font-bold
                 px-3 py-1 rounded-full">
        {{ $keahlian }}
    </span>
    @endforeach
</div>
@endif

<h2 class="text-xl font-bold text-gray-900 mb-1">
    {{ $trainer->academic_degree ?? $trainer->name }}
</h2>
                    <p class="text-sm text-gray-400 mb-3">Trainer Profesional · KAJI INDONESIA</p>

                    {{-- Rating ringkasan --}}
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'text-amber-400' : 'text-gray-200' }}"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-gray-800">{{ number_format($avgRating, 1) }}</span>
                        <span class="text-xs text-gray-400">({{ $totalUlasan }} ulasan)</span>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                        <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.75L2.25 6.75"/>
                        </svg>
                        {{ $trainer->email }}
                    </div>

                    {{-- No. HP --}}
                    @if($trainer->phone)
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                        <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 6.338c0-.414.336-.75.75-.75h2.25a.75.75 0 01.75.645l.75 4.5a.75.75 0 01-.54.852l-1.5.5a11.025 11.025 0 005.557 5.557l.5-1.5a.75.75 0 01.852-.54l4.5.75a.75.75 0 01.645.75v2.25a.75.75 0 01-.75.75C10.556 21.75 2.25 13.444 2.25 6.338z"/>
                        </svg>
                        {{ $trainer->phone }}
                    </div>
                    @endif

                    {{-- Tombol WA --}}
                    @if($trainer->phone)
                    @php
                        $waPhone = preg_replace('/[^0-9]/', '', $trainer->phone);
                        $waText  = urlencode('Halo ' . $trainer->name . ', saya ingin berkonsultasi mengenai pelatihan.');
                    @endphp
                    <a href="https://wa.me/{{ $waPhone }}?text={{ $waText }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600
                              text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                    @endif

{{-- Sosial Media --}}
@if($trainer->sosmed)
@php
    $sosmed = is_array($trainer->sosmed) ? $trainer->sosmed : json_decode($trainer->sosmed, true);
@endphp
<div class="flex flex-wrap gap-2 mt-4">
    @if(!empty($sosmed['instagram']))
    <a href="https://instagram.com/{{ $sosmed['instagram'] }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-pink-50
              border border-pink-200 text-pink-600 text-xs font-semibold
              hover:bg-pink-100 transition-colors">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.975.975 1.246 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.975.975-2.242 1.246-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.975-.975-1.246-2.242-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608.975-.975 2.242-1.246 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.333.014 7.053.072 5.197.157 3.355.673 2.014 2.014.673 3.355.157 5.197.072 7.053.014 8.333 0 8.741 0 12c0 3.259.014 3.667.072 4.947.085 1.856.601 3.698 1.942 5.039 1.341 1.341 3.183 1.857 5.039 1.942C8.333 23.986 8.741 24 12 24s3.667-.014 4.947-.072c1.856-.085 3.698-.601 5.039-1.942 1.341-1.341 1.857-3.183 1.942-5.039.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.085-1.856-.601-3.698-1.942-5.039C20.645.673 18.803.157 16.947.072 15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
        </svg>
        {{ $sosmed['instagram'] }}
    </a>
    @endif

    @if(!empty($sosmed['twitter']))
    <a href="https://x.com/{{ $sosmed['twitter'] }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-50
              border border-gray-200 text-gray-700 text-xs font-semibold
              hover:bg-gray-100 transition-colors">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
        </svg>
        {{ $sosmed['twitter'] }}
    </a>
    @endif

    @if(!empty($sosmed['linkedin']))
    <a href="{{ $sosmed['linkedin'] }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50
              border border-blue-200 text-blue-700 text-xs font-semibold
              hover:bg-blue-100 transition-colors">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
        </svg>
        LinkedIn
    </a>
    @endif

    @if(!empty($sosmed['youtube']))
    <a href="{{ $sosmed['youtube'] }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50
              border border-red-200 text-red-600 text-xs font-semibold
              hover:bg-red-100 transition-colors">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
        </svg>
        YouTube
    </a>
    @endif

    @if(!empty($sosmed['facebook']))
    <a href="{{ $sosmed['facebook'] }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50
              border border-blue-200 text-blue-800 text-xs font-semibold
              hover:bg-blue-100 transition-colors">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
        Facebook
    </a>
    @endif
</div>
@endif

</div>
</div>
</div>

        {{-- ── Bio ─────────────────────────────────────────────────── --}}
        @if($trainer->bio)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-gray-900 mb-3 pb-3 border-b border-gray-100">
                Tentang Trainer
            </h3>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $trainer->bio }}</p>
        </div>
        @endif

        {{-- ── Program / Kurikulum ─────────────────────────────────── --}}
        @php
            $programs = \App\Models\Program::where('trainer_id', $trainer->id)
                ->where('tipe', 'kurikulum')
                ->where('status', 'approved')
                ->latest()->get();
        @endphp
        @if($programs->count() > 0)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">
                Program / Kurikulum
                <span class="text-sm font-normal text-gray-400 ml-2">{{ $programs->count() }} program</span>
            </h3>
            <div class="space-y-3">
                @foreach($programs as $prog)
                <a href="{{ route('pelatihan.detail', $prog->id) }}"
                   class="flex items-center gap-4 p-3 rounded-xl border border-gray-100
                          hover:border-green-200 hover:bg-green-50 transition group">
                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-green-100 flex-shrink-0
                                flex items-center justify-center text-xl">
                        @if($prog->gambar)
                            <img src="{{ asset('storage/' . $prog->gambar) }}" alt="{{ $prog->judul }}"
                                 class="w-full h-full object-cover">
                        @else 📚 @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold text-gray-900 group-hover:text-green-700 truncate transition">
                            {{ $prog->judul }}
                        </div>
                        <div class="text-xs text-gray-400 mt-0.5 flex gap-3">
                            @if($prog->metode) <span>{{ ucfirst($prog->metode) }}</span> @endif
                            @if($prog->tingkat) <span>{{ ucfirst($prog->tingkat) }}</span> @endif
                            @if($prog->total_jam) <span>⏱ {{ (int)$prog->total_jam }} jam</span> @endif
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-green-500 flex-shrink-0 transition"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ── Event ───────────────────────────────────────────────── --}}
        @php
            $trainerEvents = \App\Models\Event::where('trainer_id', $trainer->id)
                ->where('status', 'approved')
                ->latest()->get();
        @endphp
        @if($trainerEvents->count() > 0)
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">
                Event
                <span class="text-sm font-normal text-gray-400 ml-2">{{ $trainerEvents->count() }} event</span>
            </h3>
            <div class="space-y-3">
                @foreach($trainerEvents as $ev)
                <a href="{{ route('pelatihan.event.detail', $ev->id) }}"
                   class="flex items-center gap-4 p-3 rounded-xl border border-gray-100
                          hover:border-orange-200 hover:bg-orange-50 transition group">
                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-orange-100 flex-shrink-0
                                flex items-center justify-center text-xl">
                        @if($ev->gambar)
                            <img src="{{ asset('storage/' . $ev->gambar) }}" alt="{{ $ev->judul }}"
                                 class="w-full h-full object-cover">
                        @else 🎪 @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-semibold text-gray-900 group-hover:text-orange-600 truncate transition">
                            {{ $ev->judul }}
                        </div>
                        <div class="text-xs text-gray-400 mt-0.5">
                            📅 {{ \Carbon\Carbon::parse($ev->tanggal)->translatedFormat('d F Y') }}
                            @if($ev->lokasi) · 📍 {{ $ev->lokasi }} @endif
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-orange-400 flex-shrink-0 transition"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ── Daftar Ulasan ───────────────────────────────────────── --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">
                Ulasan
                <span class="text-sm font-normal text-gray-400 ml-2">{{ $totalUlasan }} ulasan</span>
            </h3>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-4">
                ✅ {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl px-4 py-3 mb-4">
                ⚠️ {{ session('error') }}
            </div>
            @endif

            @forelse($ulasan as $item)
            <div class="py-4 border-b border-gray-100 last:border-0">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center
                                text-sm font-bold text-green-800 flex-shrink-0">
                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-semibold text-gray-900">
                                {{ $item->user->name ?? 'Pengguna' }}
                            </span>
                            <span class="text-xs text-gray-400">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <div class="flex gap-0.5 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-3.5 h-3.5 {{ $i <= $item->rating ? 'text-amber-400' : 'text-gray-200' }}"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        @if($item->komentar)
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $item->komentar }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-gray-400">
                <div class="text-4xl mb-3">⭐</div>
                <p class="text-sm">Belum ada ulasan untuk trainer ini.</p>
            </div>
            @endforelse
        </div>

        {{-- ── Form Ulasan ─────────────────────────────────────────── --}}
        @auth
            @if(!$sudahUlasan)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h3 class="font-serif text-lg font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">
                    Tulis Ulasan
                </h3>
                <form action="{{ route('pelatihan.mentor.ulasan', $trainer->id) }}" method="POST">
                    @csrf

                    {{-- Rating bintang interaktif --}}
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Rating <span class="text-red-400">*</span>
                        </label>
                        <div class="flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button"
                                    data-value="{{ $i }}"
                                    class="star-btn text-4xl text-gray-200 hover:text-amber-400
                                           transition-colors duration-100 focus:outline-none leading-none">
                                ★
                            </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input" value="">
                        @error('rating')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Komentar --}}
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Komentar
                        </label>
                        <textarea name="komentar" rows="3"
                            placeholder="Ceritakan pengalaman Anda bersama trainer ini..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm
                                   text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400
                                   resize-none bg-gray-50 focus:bg-white transition">{{ old('komentar') }}</textarea>
                        @error('komentar')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold
                                   px-6 py-2.5 rounded-xl transition-colors">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
            @else
            <div class="bg-green-50 border border-green-200 rounded-2xl p-5 text-center">
                <p class="text-sm text-green-700 font-semibold">
                    ✅ Anda sudah memberikan ulasan untuk trainer ini.
                </p>
            </div>
            @endif
        @else
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 text-center">
            <p class="text-sm text-gray-500 mb-3">Login untuk memberikan ulasan</p>
            <a href="{{ route('login') }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm
                      font-semibold px-6 py-2.5 rounded-xl transition-colors">
                Login Sekarang
            </a>
        </div>
        @endauth

    </div>
</div>

@endsection

@push('scripts')
<script>
function setRating(val) {
    document.getElementById('rating-input').value = val;
    document.querySelectorAll('.star-btn').forEach(function(btn) {
        btn.style.color = parseInt(btn.dataset.value) <= val ? '#f59e0b' : '#e5e7eb';
    });
}

document.querySelectorAll('.star-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        setRating(parseInt(this.dataset.value));
    });
    btn.addEventListener('mouseenter', function() {
        var hovered = parseInt(this.dataset.value);
        document.querySelectorAll('.star-btn').forEach(function(b) {
            b.style.color = parseInt(b.dataset.value) <= hovered ? '#fbbf24' : '#e5e7eb';
        });
    });
    btn.addEventListener('mouseleave', function() {
        var current = parseInt(document.getElementById('rating-input').value) || 0;
        document.querySelectorAll('.star-btn').forEach(function(b) {
            b.style.color = parseInt(b.dataset.value) <= current ? '#f59e0b' : '#e5e7eb';
        });
    });
});
</script>
@endpush