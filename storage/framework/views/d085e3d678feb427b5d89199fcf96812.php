<?php $__env->startSection('title', 'Event Pelatihan - KAJI INDONESIA'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">
                    EVENT KAMI LATIH
                </h1>
                <p class="mt-4 text-lg text-white/90">
                    Workshop dan seminar untuk pengembangan kapasitas UMKM.
                </p>
            </div>
            <div>
                <img src="<?php echo e(asset('storage/logo/KAMILATIH.png')); ?>"
                     alt="Logo Karya Kami"
                     class="w-32 md:w-40 object-contain">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16 px-6 min-h-screen">

        <?php if($events->isEmpty()): ?>
            
            <div class="max-w-lg mx-auto text-center py-24">
                <div class="text-6xl mb-4">🎉</div>
                <h2 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Event</h2>
                <p class="text-gray-500 text-sm">Event akan segera hadir. Pantau terus halaman ini!</p>
            </div>
        <?php else: ?>
            <h2 class="font-serif text-center text-3xl font-bold text-gray-900 sm:text-4xl mb-6">
                Event Pelatihan UMKM
            </h2>

            
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
                            id="event-search-input"
                            type="text"
                            placeholder="Cari nama event..."
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            autocomplete="off"
                        >
                    </div>
                    <span id="event-search-count" class="text-sm text-gray-400 whitespace-nowrap px-1"></span>
                </div>
            </div>

            
            <div id="all-events-data" class="hidden">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $waPhone = $item->phone ?? $item->trainer?->phone ?? '6281234567890';
                    $waText  = urlencode('Halo, saya ingin mendaftar event: ' . $item->judul . ' pada ' . \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y'));
                    $tanggalFormatted = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y');
                    $isGratis = empty($item->biaya) || $item->biaya == '0' || strtolower($item->biaya) === 'gratis';
                    $trainerGelarEvent = \App\Models\Trainer::where('user_id', $item->trainer_id)
        ->value('academic_degree') ?? $item->trainer?->name ?? '';
                ?>
                <div
                    class="event-card-data"
                    data-id="<?php echo e($item->id); ?>"
                    data-title="<?php echo e(strtolower($item->judul)); ?>"
                    data-desc="<?php echo e(strtolower($item->deskripsi ?? '')); ?>"
                    data-judul="<?php echo e($item->judul); ?>"
                    data-deskripsi="<?php echo e(Str::limit($item->deskripsi, 100)); ?>"
                    data-gambar="<?php echo e($item->gambar ? asset('storage/' . $item->gambar) : ''); ?>"
                    data-tanggal="<?php echo e($tanggalFormatted); ?>"
                    data-biaya="<?php echo e($item->biaya ?? ''); ?>"
                    data-is-gratis="<?php echo e($isGratis ? '1' : '0'); ?>"
                    data-trainer="<?php echo e($trainerGelarEvent); ?>"
                    data-wa-phone="<?php echo e($waPhone); ?>"
                    data-wa-text="<?php echo e($waText); ?>"
                    data-detail-url="<?php echo e(route('pelatihan.event.detail', $item->id)); ?>"
                ></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div id="event-grid" class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            </div>

            
            <div id="event-empty-state" class="hidden max-w-6xl mx-auto text-center py-20 text-gray-400">
                <div class="text-5xl mb-4">🔍</div>
                <p id="event-empty-message" class="text-lg font-semibold text-gray-500">Belum ada event tersedia.</p>
            </div>

            
            <div id="event-pagination-wrapper" class="max-w-6xl mx-auto mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p id="event-pagination-info" class="text-sm text-gray-500 order-2 sm:order-1"></p>
                <div id="event-pagination-controls" class="flex items-center gap-1 order-1 sm:order-2"></div>
            </div>

        <?php endif; ?>

    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Konfigurasi ──────────────────────────────────────────
    const PER_PAGE = 8;

    // ── Ambil semua data dari DOM ────────────────────────────
    const rawNodes = document.querySelectorAll('.event-card-data');
    if (!rawNodes.length) return;

    const allEvents = Array.from(rawNodes).map(el => ({
        id:        el.dataset.id,
        title:     el.dataset.title,
        desc:      el.dataset.desc,
        judul:     el.dataset.judul,
        deskripsi: el.dataset.deskripsi,
        gambar:    el.dataset.gambar,
        tanggal:   el.dataset.tanggal,
        biaya:     el.dataset.biaya,
        isGratis:  el.dataset.isGratis === '1',
        trainer:   el.dataset.trainer,
        waPhone:   el.dataset.waPhone,
        waText:    el.dataset.waText,
        detailUrl: el.dataset.detailUrl,
    }));

    // ── State ────────────────────────────────────────────────
    let filtered    = [...allEvents];
    let currentPage = 1;

    // ── Elemen ──────────────────────────────────────────────
    const grid        = document.getElementById('event-grid');
    const emptyState  = document.getElementById('event-empty-state');
    const emptyMsg    = document.getElementById('event-empty-message');
    const countEl     = document.getElementById('event-search-count');
    const infoEl      = document.getElementById('event-pagination-info');
    const ctrlEl      = document.getElementById('event-pagination-controls');
    const searchInput = document.getElementById('event-search-input');

    // ── Build card HTML ──────────────────────────────────────
    function buildCard(e) {
        const imgHtml = e.gambar
            ? `<img src="${e.gambar}" alt="${e.judul}" class="w-full h-full object-cover">`
            : `<div class="w-full h-44 flex items-center justify-center text-5xl bg-gradient-to-br from-green-100 to-green-300">🎪</div>`;

        const biayaHtml = e.isGratis
            ? `<span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-300">✅ Gratis</span>`
            : `<span class="inline-block bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full border border-orange-300">💰 ${e.biaya}</span>`;

        const trainerHtml = e.trainer
            ? `<p class="text-xs text-gray-400 text-center mt-2">oleh ${e.trainer}</p>`
            : '';

        return `
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200 flex flex-col duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="w-full h-44 flex items-center justify-center overflow-hidden bg-green-50">
                ${e.gambar
                    ? `<img src="${e.gambar}" alt="${e.judul}" class="w-full h-full object-cover">`
                    : `<span class="text-5xl">🎪</span>`
                }
            </div>

            <div class="bg-green-100 px-4 py-2">
                <h3 class="font-serif font-bold text-gray-900 text-base text-center leading-snug">
                    ${e.judul}
                </h3>
            </div>

            <div class="flex items-center gap-2 bg-green-50 border-b border-green-100 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/>
                </svg>
                <span class="text-sm font-semibold text-green-700">${e.tanggal}</span>
            </div>

            <div class="px-4 pt-3 flex justify-center">
                ${biayaHtml}
            </div>

            <div class="px-4 py-3 flex-1">
                <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-3">${e.deskripsi}</p>
                ${trainerHtml}
            </div>

            <div class="grid grid-cols-2">
                <a href="https://wa.me/${e.waPhone}?text=${e.waText}"
                   target="_blank"
                   class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold text-center py-3 transition-colors duration-200">
                    WhatsApp
                </a>
                <a href="${e.detailUrl}"
                   class="bg-orange-400 hover:bg-orange-500 text-gray-900 text-sm font-semibold text-center py-3 transition-colors duration-200">
                    Detail
                </a>
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
                ? `Event "${searchInput.value.trim()}" tidak ditemukan.`
                : 'Belum ada event tersedia.';
            countEl.textContent = '';
            infoEl.textContent  = '';
            ctrlEl.innerHTML    = '';
            return;
        }

        grid.classList.remove('hidden');
        emptyState.classList.add('hidden');
        grid.innerHTML = slice.map(buildCard).join('');

        countEl.textContent = `${filtered.length} event`;
        infoEl.textContent  = `Halaman ${currentPage} dari ${totalPages} · Menampilkan ${start + 1}–${Math.min(start + PER_PAGE, filtered.length)} dari ${filtered.length} event`;

        renderPagination(totalPages);
        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ── Render tombol pagination ─────────────────────────────
    function renderPagination(totalPages) {
        if (totalPages <= 1) { ctrlEl.innerHTML = ''; return; }

        const btnBase     = 'inline-flex items-center justify-center w-9 h-9 rounded-lg text-sm font-semibold transition-colors duration-150 border';
        const btnActive   = 'bg-green-600 text-white border-green-600';
        const btnNormal   = 'bg-white text-gray-700 border-gray-200 hover:bg-green-50 hover:border-green-400';
        const btnDisabled = 'bg-white text-gray-300 border-gray-100 cursor-not-allowed';

        let html = '';

        html += `<button class="${btnBase} ${currentPage === 1 ? btnDisabled : btnNormal}"
            ${currentPage === 1 ? 'disabled' : ''}
            onclick="eventGoPage(${currentPage - 1})" aria-label="Sebelumnya">‹</button>`;

        getPageNumbers(currentPage, totalPages).forEach(p => {
            if (p === '...') {
                html += `<span class="${btnBase} border-transparent text-gray-400 cursor-default">…</span>`;
            } else {
                html += `<button class="${btnBase} ${p === currentPage ? btnActive : btnNormal}"
                    onclick="eventGoPage(${p})" aria-label="Halaman ${p}"
                    ${p === currentPage ? 'aria-current="page"' : ''}>${p}</button>`;
            }
        });

        html += `<button class="${btnBase} ${currentPage === totalPages ? btnDisabled : btnNormal}"
            ${currentPage === totalPages ? 'disabled' : ''}
            onclick="eventGoPage(${currentPage + 1})" aria-label="Berikutnya">›</button>`;

        ctrlEl.innerHTML = html;
    }

    // ── Nomor halaman dengan ellipsis ────────────────────────
    function getPageNumbers(current, total) {
        if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1);
        if (current <= 4)          return [1, 2, 3, 4, 5, '...', total];
        if (current >= total - 3)  return [1, '...', total-4, total-3, total-2, total-1, total];
        return [1, '...', current-1, current, current+1, '...', total];
    }

    // ── Global handler pagination ────────────────────────────
    window.eventGoPage = function (page) {
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
                ? allEvents.filter(e => e.title.includes(q) || e.desc.includes(q))
                : [...allEvents];
            currentPage = 1;
            renderPage();
        }, 300);
    });

    // ── Render awal ──────────────────────────────────────────
    renderPage();
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Kaji-indo-main\resources\views/pages/pelatihan-event.blade.php ENDPATH**/ ?>