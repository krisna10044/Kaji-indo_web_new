<?php $__env->startSection('title', 'Daftar Trainer'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl uppercase">
                    DAFTAR TRAINER
                </h1>
                <p class="mt-4 text-lg text-white/90">
                    Temukan trainer profesional yang siap mendampingi perjalanan usaha Anda bersama KAJI INDONESIA.
                </p>
            </div>
            <div>
                <img src="<?php echo e(asset('storage/logo/KAMILATIH.png')); ?>"
                     alt="Logo Kamilatih"
                     class="w-32 md:w-40 object-contain">
            </div>
        </div>
    </section>

    <section class="bg-white py-16 px-6 min-h-screen">
        <h2 class="font-serif text-center text-3xl font-bold text-gray-900 sm:text-4xl mb-10">Daftar Trainer</h2>

        
        <div class="max-w-2xl mx-auto flex flex-col sm:flex-row gap-4 mb-10">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </span>
                <input type="text" id="searchInput"
                       placeholder="Cari Nama Trainer"
                       class="w-full pl-9 pr-4 py-2.5 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
        </div>

        
        <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="trainerGrid">

            <?php $__empty_1 = true; $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('pelatihan.mentor.detail', $trainer->id)); ?>"
                   class="pembimbing-card block bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300"
                   data-nama="<?php echo e(strtolower($trainer->name)); ?>"
                   data-lokasi="<?php echo e(strtolower($trainer->gmaps_location ?? '')); ?>"
                   data-bidang="<?php echo e(strtolower($trainer->bidang_keahlian ?? '')); ?>">

                   
<div class="w-full bg-gray-100 overflow-hidden" style="aspect-ratio: 3/4;">
    <?php if($trainer->foto): ?>
        <img src="<?php echo e(asset('storage/' . $trainer->foto)); ?>"
             alt="<?php echo e($trainer->name); ?>"
             class="w-full h-full object-cover object-top">
    <?php elseif($trainer->white_bg_photo): ?>
        <img src="<?php echo e(asset('storage/' . $trainer->white_bg_photo)); ?>"
             alt="<?php echo e($trainer->name); ?>"
             class="w-full h-full object-cover object-top">
    <?php elseif($trainer->profile_photo_path): ?>
        <img src="<?php echo e(asset('storage/' . $trainer->profile_photo_path)); ?>"
             alt="<?php echo e($trainer->name); ?>"
             class="w-full h-full object-cover object-top">
    <?php else: ?>
        <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-emerald-700">
            <?php echo e(strtoupper(substr($trainer->name, 0, 2))); ?>

        </div>
    <?php endif; ?>
</div>

                    
                    <div class="bg-green-50 px-4 py-2 border-b">
                    <h3 class="font-bold text-gray-900 text-sm line-clamp-1">
    <?php echo e($trainer->academic_degree ?? $trainer->name); ?>

</h3>
                        <p class="text-xs text-emerald-600 font-bold uppercase">
    <?php echo e($trainer->displayed_bidang 
        ?? trim(explode(',', $trainer->keahlian ?? '')[0]) 
        ?: 'Trainer'); ?>

</p>
                    </div>

                    <div class="px-4 py-3 text-gray-600">
                    <p class="text-xs mb-2"><?php echo e($trainer->location ?? 'Lokasi tidak tersedia'); ?></p>
                        <div class="flex items-center gap-1 mt-1">
    <div class="flex items-center gap-0.5 text-amber-400">
        <?php for($i = 1; $i <= 5; $i++): ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                 fill="<?php echo e($i <= round($trainer->avg_rating ?? 0) ? 'currentColor' : 'none'); ?>"
                 stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
            </svg>
        <?php endfor; ?>
    </div>
    <span class="text-xs text-gray-400 ml-1">
        <?php echo e(number_format($trainer->avg_rating ?? 0, 1)); ?>

        (<?php echo e($trainer->total_ulasan ?? 0); ?> ulasan)
    </span>
</div>
                    </div>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20 text-gray-400 italic">
                    Belum ada trainer yang tersedia.
                </div>
            <?php endif; ?>

        </div>

        
        <div class="mt-10 max-w-5xl mx-auto text-center">
            <?php echo e($trainers->links()); ?>

        </div>
    </section>

    <?php
$trainersJson = $trainers->getCollection()->map(function($t) {
    return [
        'id'                 => $t->id,
        'name'               => $t->name,
        'academic_degree'    => $t->academic_degree ?? $t->name,
        'bidang_keahlian'    => $t->displayed_bidang 
                 ?? trim(explode(',', $t->keahlian ?? '')[0]) 
                 ?: 'Trainer',
        'location'           => $t->location ?? 'Lokasi tidak tersedia',
        'foto'               => $t->foto,
        'white_bg_photo'     => $t->white_bg_photo,
        'profile_photo_path' => $t->profile_photo_path,
        'avg_rating'         => $t->avg_rating ?? 0,
        'total_ulasan'       => $t->total_ulasan ?? 0,
    ];
});
?>

    <script>
        // Semua data trainer dilempar dari PHP ke JS (tanpa fetch)
        const allTrainers = <?php echo json_encode($trainersJson, 15, 512) ?>;

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput  = document.getElementById('searchInput');
            const trainerGrid  = document.getElementById('trainerGrid');
            const paginationEl = document.querySelector('.mt-10.max-w-5xl');
            const originalHTML = trainerGrid.innerHTML;
            const originalPage = paginationEl ? paginationEl.innerHTML : '';

            searchInput.addEventListener('input', function () {
                const keyword = this.value.trim().toLowerCase();

                if (keyword === '') {
                    trainerGrid.innerHTML = originalHTML;
                    if (paginationEl) paginationEl.innerHTML = originalPage;
                    return;
                }

                // Sembunyikan pagination saat search
                if (paginationEl) paginationEl.innerHTML = '';

                const filtered = allTrainers.filter(t =>
    t.name.toLowerCase().includes(keyword) ||
    (t.academic_degree ?? '').toLowerCase().includes(keyword) ||
    (t.bidang_keahlian ?? '').toLowerCase().includes(keyword) ||
    (t.location ?? '').toLowerCase().includes(keyword)
);

                renderCards(filtered, keyword);
            });

            function renderCards(trainers, keyword) {
                if (trainers.length === 0) {
                    trainerGrid.innerHTML = `
                        <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                            </svg>
                            <p class="text-sm italic">Trainer "<strong>${keyword}</strong>" tidak ditemukan.</p>
                        </div>`;
                    return;
                }

                trainerGrid.innerHTML = trainers.map(t => {
                    const avg   = parseFloat(t.avg_rating ?? 0).toFixed(1);
                    const total = t.total_ulasan ?? 0;

                    
    const foto = t.foto
    ? `<img src="/storage/${t.foto}" alt="${t.name}" class="w-full h-full object-cover">`
    : t.white_bg_photo
        ? `<img src="/storage/${t.white_bg_photo}" alt="${t.name}" class="w-full h-full object-cover">`
        : t.profile_photo_path
            ? `<img src="/storage/${t.profile_photo_path}" alt="${t.name}" class="w-full h-full object-cover">`
            : `<div class="text-3xl font-bold text-emerald-700">${t.name.substring(0,2).toUpperCase()}</div>`;

                    const bintang = [1,2,3,4,5].map(i =>
                        `<svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                            fill="${i <= Math.round(avg) ? 'currentColor' : 'none'}"
                            stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>`
                    ).join('');

                    return `
    <a href="/pelatihan/mentor/${t.id}"
    class="block bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300">
        <div class="w-full bg-gray-100 overflow-hidden" style="aspect-ratio: 3/4;">
            <div class="w-full h-full flex items-center justify-center overflow-hidden">
                ${foto}
            </div>
        </div>
                            <div class="bg-green-50 px-4 py-2 border-b">
                                <h3 class="font-bold text-gray-900 text-sm line-clamp-1">${t.academic_degree}</h3>
                                <p class="text-xs text-emerald-600 font-bold uppercase">${t.bidang_keahlian}</p>
                            </div>
                            <div class="px-4 py-3 text-gray-600">
                                <p class="text-xs mb-2">${t.location}</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <div class="flex items-center gap-0.5 text-amber-400">${bintang}</div>
                                    <span class="text-xs text-gray-400 ml-1">${avg} (${total} ulasan)</span>
                                </div>
                            </div>
                        </a>`;
                }).join('');
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/pages/pelatihan-pembimbing.blade.php ENDPATH**/ ?>