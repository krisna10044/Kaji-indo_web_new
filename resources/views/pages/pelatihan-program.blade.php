@extends('layouts.app')

@section('title', 'Program Pelatihan - KAJI Indonesia')

@section('content')

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">PROGRAM KAMI LATIH</h1>
                <p class="mt-4 text-lg text-white/90">Kurikulum dan materi pelatihan untuk penguatan kapasitas Usaha.</p>
            </div>
            <div>
                <img src="{{ asset('storage/logo/KAMILATIH.png') }}" alt="Logo Karya Kami" class="w-32 md:w-40 object-contain">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16 px-6 min-h-screen">

        <h2 class="font-serif text-center text-3xl font-bold text-gray-900 sm:text-4xl mb-6">
            Kurikulum Pelatihan UMKM
        </h2>

        {{-- Search Bar (Live Search, tanpa form submit) --}}
        <div class="max-w-xl mx-auto mb-10">
            <div class="flex gap-2 items-center">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </span>
                    <input
                        id="live-search-input"
                        type="text"
                        placeholder="Cari nama kurikulum..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        autocomplete="off"
                    >
                </div>
                <span id="search-count" class="text-sm text-gray-400 whitespace-nowrap px-1"></span>
            </div>
        </div>

        {{-- Semua Kartu (hidden, dikelola JavaScript) --}}
        <div id="all-cards-data" class="hidden">
            @foreach($programsDB as $program)
            <div
    class="program-card-data"
    data-id="{{ $program->id }}"
    data-title="{{ strtolower($program->judul) }}"
    data-desc="{{ strtolower($program->deskripsi ?? '') }}"
    data-judul="{{ $program->judul }}"
    data-deskripsi="{{ $program->deskripsi ?? '' }}"
    data-gambar="{{ $program->gambar ? asset('storage/' . $program->gambar) : '' }}"
    data-trainer="{{ $program->trainer_academic_degree }}"
    data-phone="{{ !empty($program->phone) ? $program->phone : (!empty($program->trainer->phone) ? $program->trainer->phone : '6281234567890') }}"
    data-detail-url="{{ route('pelatihan.detail', $program->id) }}"
    data-program-mulai="{{ $program->program_mulai ?? '' }}"
    data-program-selesai="{{ $program->program_selesai ?? '' }}"
    data-biaya="{{ $program->biaya ?? '' }}"
></div>
            @endforeach
        </div>

        {{-- Grid Kartu (dirender oleh JS) --}}
        <div id="program-grid" class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            {{-- Kartu diisi oleh JavaScript --}}
        </div>

        {{-- Empty State --}}
        <div id="empty-state" class="hidden max-w-6xl mx-auto text-center py-20 text-gray-400">
            <div class="text-5xl mb-4">🔍</div>
            <p id="empty-message" class="text-lg font-semibold text-gray-500">Belum ada kurikulum tersedia.</p>
        </div>

        {{-- Pagination --}}
        <div id="pagination-wrapper" class="max-w-6xl mx-auto mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">

            {{-- Info halaman --}}
            <p id="pagination-info" class="text-sm text-gray-500 order-2 sm:order-1"></p>

            {{-- Tombol prev/next/angka --}}
            <div id="pagination-controls" class="flex items-center gap-1 order-1 sm:order-2"></div>

        </div>

    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Konfigurasi ──────────────────────────────────────────
    const PER_PAGE = 8; // jumlah kartu per halaman

    // ── Ambil semua data dari DOM ────────────────────────────
    const rawNodes = document.querySelectorAll('.program-card-data');
    const allPrograms = Array.from(rawNodes).map(el => ({
        id:        el.dataset.id,
        title:     el.dataset.title,
        desc:      el.dataset.desc,
        judul:     el.dataset.judul,
        deskripsi: el.dataset.deskripsi,
        gambar:    el.dataset.gambar,
        trainer:   el.dataset.trainer,
        phone:     el.dataset.phone,
        detailUrl: el.dataset.detailUrl,
        programMulai:  el.dataset.programMulai,
    programSelesai: el.dataset.programSelesai,
    biaya:         el.dataset.biaya,
    }));

    // ── State ────────────────────────────────────────────────
    let filtered   = [...allPrograms];
    let currentPage = 1;

    // ── Elemen ──────────────────────────────────────────────
    const grid       = document.getElementById('program-grid');
    const emptyState = document.getElementById('empty-state');
    const emptyMsg   = document.getElementById('empty-message');
    const countEl    = document.getElementById('search-count');
    const infoEl     = document.getElementById('pagination-info');
    const ctrlEl     = document.getElementById('pagination-controls');
    const searchInput = document.getElementById('live-search-input');

    // ── Build card HTML ──────────────────────────────────────
    // ── Build card HTML ──────────────────────────────────────
// ── Build card HTML ──────────────────────────────────────
function buildCard(p) {
    // Label status program
    let statusLabel = '';
    const now = Date.now();
    const mulai   = p.programMulai   ? new Date(p.programMulai).getTime()   : null;
    const selesai = p.programSelesai ? new Date(p.programSelesai).getTime() : null;

    if (mulai) {
        if (now < mulai) {
            statusLabel = `<span style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;">⏳ Belum Dibuka</span>`;
        } else if (!selesai || now <= selesai) {
            statusLabel = `<span style="background:#f0fdf4;color:#16a34a;border:1px solid #86efac;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;">✅ Berlangsung</span>`;
        } else {
            statusLabel = `<span style="background:#f8fafc;color:#64748b;border:1px solid #cbd5e1;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;">🔒 Selesai</span>`;
        }
    }

    const isGratis = !p.biaya || p.biaya.toLowerCase() === 'gratis';
    const biayaLabel = isGratis
        ? `<span style="background:#f0fdf4;color:#16a34a;border:1px solid #86efac;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;">🎁 Gratis</span>`
        : `<span style="background:#fff7ed;color:#ea580c;border:1px solid #fed7aa;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;">💳 Berbayar</span>`;

    const imgHtml = p.gambar
        ? `<img src="${p.gambar}" alt="${p.judul}" class="w-full h-full object-cover">`
        : `<span class="text-5xl">🎓</span>`;

    const waText = encodeURIComponent(`Halo, saya ingin tahu lebih lanjut tentang ${p.judul}`);

    return `
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200 flex flex-col duration-300 hover:shadow-lg hover:-translate-y-1 cursor-pointer"
         onclick="window.location='${p.detailUrl}'">
        <div class="relative w-full h-44 flex items-center justify-center overflow-hidden bg-green-50">
            ${imgHtml}
            <img src="/storage/logo/KAMILATIH.png" alt="Logo"
                 class="absolute top-2 right-2 w-20 h-10 object-contain rounded-md p-1 bg-white/80">
        </div>
        <div class="bg-green-100 px-4 py-2">
            <h3 class="font-serif font-bold text-gray-900 text-lg text-center truncate">${p.judul}</h3>
        </div>
        <div class="px-4 py-3 flex-1 flex flex-col">
            <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:center;margin-bottom:8px;">
                ${biayaLabel}
                ${statusLabel}
            </div>
            <p style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;min-height:3.75rem;font-size:0.875rem;color:#4b5563;text-align:center;line-height:1.625;">${p.deskripsi}</p>
            ${p.trainer ? `<p style="font-size:0.75rem;color:#9ca3af;text-align:center;margin-top:auto;padding-top:8px;">oleh ${p.trainer}</p>` : ''}
        </div>
        <div class="grid grid-cols-2">
            <span onclick="event.stopPropagation(); window.open('https://wa.me/${p.phone}?text=${waText}', '_blank')"
                  class="flex items-center justify-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-3 transition-colors duration-200 cursor-pointer">
                WhatsApp
            </span>
            <span class="flex items-center justify-center bg-orange-400 hover:bg-orange-500 text-gray-900 text-sm font-semibold py-3 transition-colors duration-200">
                Detail
            </span>
        </div>
    </div>`;
}

    // ── Render kartu sesuai halaman ──────────────────────────
    function renderPage() {
        const totalPages = Math.ceil(filtered.length / PER_PAGE);
        if (currentPage > totalPages) currentPage = totalPages || 1;

        const start = (currentPage - 1) * PER_PAGE;
        const slice = filtered.slice(start, start + PER_PAGE);

        if (filtered.length === 0) {
            grid.classList.add('hidden');
            emptyState.classList.remove('hidden');
            emptyMsg.textContent = searchInput.value.trim()
                ? `Kurikulum "${searchInput.value.trim()}" tidak ditemukan.`
                : 'Belum ada kurikulum tersedia.';
            countEl.textContent = '';
            infoEl.textContent  = '';
            ctrlEl.innerHTML    = '';
            return;
        }

        grid.classList.remove('hidden');
        emptyState.classList.add('hidden');
        grid.innerHTML = slice.map(buildCard).join('');

        // Info
        countEl.textContent = `${filtered.length} kurikulum`;
        infoEl.textContent  = `Halaman ${currentPage} dari ${totalPages} · Menampilkan ${start + 1}–${Math.min(start + PER_PAGE, filtered.length)} dari ${filtered.length} kurikulum`;

        // Tombol pagination
        renderPagination(totalPages);

        // Scroll halus ke atas grid
        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ── Render tombol pagination ─────────────────────────────
    function renderPagination(totalPages) {
        if (totalPages <= 1) { ctrlEl.innerHTML = ''; return; }

        const btnBase   = 'inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-semibold transition-colors duration-150 border';
        const btnActive = 'bg-green-600 text-white border-green-600';
        const btnNormal = 'bg-white text-gray-700 border-gray-200 hover:bg-green-50 hover:border-green-400';
        const btnDisabled = 'bg-white text-gray-300 border-gray-100 cursor-not-allowed';

        let html = '';

        // Prev
        html += `<button
            class="${btnBase} ${currentPage === 1 ? btnDisabled : btnNormal}"
            ${currentPage === 1 ? 'disabled' : ''}
            onclick="goPage(${currentPage - 1})"
            aria-label="Halaman sebelumnya">
            ‹
        </button>`;

        // Angka halaman (dengan ellipsis)
        const pages = getPageNumbers(currentPage, totalPages);
        pages.forEach(p => {
            if (p === '...') {
                html += `<span class="${btnBase} border-transparent text-gray-400 cursor-default">…</span>`;
            } else {
                html += `<button
                    class="${btnBase} ${p === currentPage ? btnActive : btnNormal}"
                    onclick="goPage(${p})"
                    aria-label="Halaman ${p}"
                    ${p === currentPage ? 'aria-current="page"' : ''}>
                    ${p}
                </button>`;
            }
        });

        // Next
        html += `<button
            class="${btnBase} ${currentPage === totalPages ? btnDisabled : btnNormal}"
            ${currentPage === totalPages ? 'disabled' : ''}
            onclick="goPage(${currentPage + 1})"
            aria-label="Halaman berikutnya">
            ›
        </button>`;

        ctrlEl.innerHTML = html;
    }

    // ── Hitung nomor halaman yang ditampilkan ────────────────
    function getPageNumbers(current, total) {
        if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1);
        const pages = [];
        if (current <= 4) {
            pages.push(1, 2, 3, 4, 5, '...', total);
        } else if (current >= total - 3) {
            pages.push(1, '...', total-4, total-3, total-2, total-1, total);
        } else {
            pages.push(1, '...', current-1, current, current+1, '...', total);
        }
        return pages;
    }

    // ── Global handler untuk tombol pagination ───────────────
    window.goPage = function (page) {
        const totalPages = Math.ceil(filtered.length / PER_PAGE);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderPage();
    };

    // ── Live search dengan debounce ──────────────────────────
    let debounceTimer;
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const q = this.value.trim().toLowerCase();
            filtered = q
                ? allPrograms.filter(p => p.title.includes(q) || p.desc.includes(q))
                : [...allPrograms];
            currentPage = 1;
            renderPage();
        }, 300);
    });

    // ── Render awal ──────────────────────────────────────────
    renderPage();
});
</script>
@endpush