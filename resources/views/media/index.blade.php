@extends('layouts.app')
@section('title', 'Dokumentasi Kegiatan – KAJI Indonesia')

@section('content')
{{-- ── HERO ── --}}
<section class="bg-primary py-16 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-2xl">
            <h1 class="font-serif text-4xl font-bold sm:text-5xl uppercase">Dokumentasi Kegiatan</h1>
            <p class="mt-4 text-lg text-white/90">Rekam jejak perjalanan KAJI Indonesia dalam mendampingi dan memberdayakan UMKM Indonesia.</p>
        </div>
        <div class="hidden md:flex flex-shrink-0 items-center justify-center">
    <img src="{{ asset('storage/logo/logo_kaji.png') }}"
         alt="Logo KAJI Indonesia"
         class="w-32 md:w-40 object-contain">
</div>
    </div>
</section>

{{-- ── FILTER ── --}}
<section class="sticky top-[65px] z-40 bg-white border-b border-gray-100 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-3">
        <form method="GET" action="{{ route('media') }}" id="filter-form" class="flex flex-wrap gap-3 items-center">
            {{-- Search --}}
            <div class="relative flex-1 min-w-[200px]">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="q" id="search-input" value="{{ request('q') }}"
                       placeholder="Cari kegiatan..."
                       autocomplete="off"
                       class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>

            {{-- Filter Kategori --}}
            <div class="flex gap-2">
                @foreach([''=>'Semua','foto'=>'📷 Foto','video'=>'🎥 Video'] as $val => $label)
                <a href="{{ route('media', array_merge(request()->except('kategori','page'), $val ? ['kategori'=>$val] : [])) }}"
                   class="px-4 py-2 rounded-xl text-sm font-semibold border transition
                          {{ request('kategori') === $val ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </form>
    </div>
</section>

{{-- ── GRID ── --}}
<section class="mx-auto max-w-7xl px-4 py-12">
    @if($items->isEmpty())
    <div class="text-center py-24">
        <div class="text-6xl mb-4">📭</div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada dokumentasi</h3>
        <p class="text-gray-400 text-sm">Dokumentasi kegiatan akan segera ditampilkan di sini.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($items as $item)
        <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer"
             onclick="openLightbox({{ $item->id }})">

            <div class="relative aspect-video overflow-hidden bg-gray-100">
                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                <div class="absolute top-3 left-3">
                    @if($item->kategori === 'video')
                    <span class="inline-flex items-center gap-1 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">▶ Video</span>
                    @else
                    <span class="inline-flex items-center gap-1 bg-primary text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">📷 Foto</span>
                    @endif
                </div>

                @if($item->kategori === 'foto' && $item->foto && count($item->foto) > 1)
                <div class="absolute bottom-3 right-3 bg-black/60 text-white text-xs font-bold px-2 py-1 rounded-lg">
                    +{{ count($item->foto) }} foto
                </div>
                @endif

                @if($item->kategori === 'video')
                <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition">
                    <div class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-red-500 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                @endif
            </div>

            <div class="p-4">
                <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-2">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    {{ $item->tanggal_kegiatan->translatedFormat('d F Y') }}
                </div>
                <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 group-hover:text-primary transition-colors">
                    {{ $item->judul }}
                </h3>
                @if($item->deskripsi)
                <p class="text-xs text-gray-400 mt-1.5 line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</p>
                @endif
            </div>
        </div>

        {{-- Data lightbox per item — HARUS di dalam foreach, di luar @push --}}
        <script>
        window.__dok = window.__dok || {};
        window.__dok[{{ $item->id }}] = {
            judul:      @json($item->judul),
            deskripsi:  @json($item->deskripsi),
            tanggal:    "{{ $item->tanggal_kegiatan->translatedFormat('d F Y') }}",
            kategori:   "{{ $item->kategori }}",
            foto:       @json($item->foto ? array_map(fn($f) => asset('storage/'.$f), $item->foto) : []),
            youtube_id: @json($item->youtube_id),
            video_file: @json($item->video_file ? asset('storage/'.$item->video_file) : null),
            cover_video:@json($item->cover_video ? asset('storage/'.$item->cover_video) : null),
            thumbnail:  @json($item->thumbnail_url),
        };
        </script>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $items->links() }}
    </div>
    @endif
</section>

{{-- ── LIGHTBOX ── --}}
<div id="lightbox" class="fixed inset-0 z-[9999] bg-black/90 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="relative bg-white rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto shadow-2xl">
        <button onclick="closeLightbox()"
                class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-gray-100 hover:bg-red-100 hover:text-red-500 flex items-center justify-center text-gray-500 font-bold text-lg transition">
            ×
        </button>
        <div id="lightbox-content" class="p-6"></div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentFotos = [];
let currentIndex = 0;

function openLightbox(id) {
    const d = window.__dok[id];
    if (!d) return;

    currentFotos = d.foto || [];
    currentIndex = 0;

    let mediaHtml = '';

    if (d.kategori === 'video') {
        if (d.youtube_id) {
            mediaHtml = `
                <div class="aspect-video w-full rounded-xl overflow-hidden bg-black mb-5">
                    <iframe src="https://www.youtube.com/embed/${d.youtube_id}?autoplay=1"
                            class="w-full h-full" frameborder="0" allowfullscreen
                            allow="autoplay; encrypted-media"></iframe>
                </div>`;
        } else if (d.video_file) {
            mediaHtml = `
                <div class="aspect-video w-full rounded-xl overflow-hidden bg-black mb-5">
                    <video src="${d.video_file}"
                           poster="${d.cover_video || d.thumbnail || ''}"
                           controls autoplay
                           class="w-full h-full"
                           controlslist="nodownload"></video>
                </div>`;
        } else {
            mediaHtml = `<img src="${d.thumbnail}" class="w-full rounded-xl object-cover mb-5">`;
        }
    } else if (currentFotos.length > 0) {
        mediaHtml = `
            <div class="relative aspect-video w-full rounded-xl overflow-hidden bg-gray-100 mb-3">
                <img id="lb-img" src="${currentFotos[0]}" class="w-full h-full object-contain">
                ${currentFotos.length > 1 ? `
                <button onclick="prevFoto()" class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-black/50 text-white flex items-center justify-center hover:bg-black/80 transition text-lg">‹</button>
                <button onclick="nextFoto()" class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-black/50 text-white flex items-center justify-center hover:bg-black/80 transition text-lg">›</button>
                <div id="lb-counter" class="absolute bottom-3 right-3 bg-black/60 text-white text-xs font-bold px-2 py-1 rounded-lg">1 / ${currentFotos.length}</div>
                ` : ''}
            </div>
            ${currentFotos.length > 1 ? `
            <div class="flex gap-2 overflow-x-auto pb-2 mb-4">
                ${currentFotos.map((f,i) => `
                    <img src="${f}" onclick="goToFoto(${i})"
                         class="lb-thumb h-14 w-20 object-cover rounded-lg cursor-pointer border-2 ${i===0?'border-primary':'border-transparent'} hover:border-primary transition flex-shrink-0">
                `).join('')}
            </div>` : ''}`;
    } else {
        mediaHtml = `<img src="${d.thumbnail}" class="w-full rounded-xl object-cover mb-5">`;
    }

    document.getElementById('lightbox-content').innerHTML = `
        ${mediaHtml}
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-xs font-bold px-2.5 py-1 rounded-full ${d.kategori==='video'?'bg-red-100 text-red-600':'bg-emerald-100 text-emerald-700'}">
                    ${d.kategori==='video'?'▶ Video':'📷 Foto'}
                </span>
                <span class="text-xs text-gray-400">📅 ${d.tanggal}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">${d.judul}</h2>
            ${d.deskripsi ? `<p class="text-sm text-gray-500 leading-relaxed">${d.deskripsi}</p>` : ''}
        </div>`;

    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = '';
    const iframe = document.querySelector('#lightbox iframe');
    if (iframe) iframe.src = iframe.src;
    const video = document.querySelector('#lightbox video');
    if (video) { video.pause(); video.src = ''; }
}

function goToFoto(i) {
    currentIndex = i;
    document.getElementById('lb-img').src = currentFotos[i];
    document.getElementById('lb-counter').textContent = `${i+1} / ${currentFotos.length}`;
    document.querySelectorAll('.lb-thumb').forEach((el,idx) => {
        el.classList.toggle('border-primary', idx === i);
        el.classList.toggle('border-transparent', idx !== i);
    });
}
function prevFoto() { goToFoto((currentIndex - 1 + currentFotos.length) % currentFotos.length); }
function nextFoto() { goToFoto((currentIndex + 1) % currentFotos.length); }

document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') prevFoto();
    if (e.key === 'ArrowRight') nextFoto();
});

// Auto search dengan debounce
const searchInput = document.getElementById('search-input');
const filterForm  = document.getElementById('filter-form');
let searchTimer;

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        filterForm.submit();
    }, 500); // delay 500ms setelah berhenti mengetik
});
</script>
@endpush