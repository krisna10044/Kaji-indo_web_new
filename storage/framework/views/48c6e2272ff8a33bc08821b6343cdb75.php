<?php $__env->startSection('content'); ?>
    
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl uppercase">
                    UMKM KARYA KAMI
                </h1>
                <p class="mt-4 text-lg text-white/90">
                    Pendampingan dan penguatan kapasitas usaha mikro, kecil, dan menengah.
                </p>
            </div>
            <div>
                <img src="<?php echo e(asset('storage/logo/KARYAKAMI.png')); ?>" alt="Logo Karya Kami" class="w-32 md:w-40 object-contain">
            </div>
        </div>
    </section>   

    <section class="bg-white py-16 px-6 min-h-screen">
        <h2 class="font-serif text-center text-3xl font-bold text-gray-900 sm:text-4xl mb-10">Daftar Mentor</h2>
    
        
        <div class="max-w-2xl mx-auto flex flex-col sm:flex-row gap-4 mb-10">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </span>
                <input type="text" id="searchInput" placeholder="Cari nama atau lokasi..." class="w-full pl-9 pr-4 py-2.5 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
        </div>
    
        
        <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="pembimbingGrid">

            <?php $__empty_1 = true; $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('umkm.mentor.detail', $m->id)); ?>"
                    class="pembimbing-card block bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300"
                    data-nama="<?php echo e(strtolower($m->full_name ?? $m->nama)); ?>"
                    data-lokasi="<?php echo e(strtolower($m->alamat_tampil ?? '')); ?>">
                    
                    
                    
<div class="w-full bg-gray-100 overflow-hidden" style="aspect-ratio: 3/4;">
    <?php if($m->foto): ?>
        <img src="<?php echo e(asset('storage/' . $m->foto)); ?>"
             alt="<?php echo e($m->full_name ?? $m->nama); ?>"
             class="w-full h-full object-cover object-top">
    <?php elseif($m->white_bg_photo): ?>
        <img src="<?php echo e(asset('storage/' . $m->white_bg_photo)); ?>"
             alt="<?php echo e($m->full_name ?? $m->nama); ?>"
             class="w-full h-full object-cover object-top">
    <?php elseif($m->user?->profile_photo_path): ?>
        <img src="<?php echo e(asset('storage/' . $m->user->profile_photo_path)); ?>"
             alt="<?php echo e($m->full_name ?? $m->nama); ?>"
             class="w-full h-full object-cover object-top">
    <?php else: ?>
        <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-emerald-700">
            <?php echo e(strtoupper(substr($m->full_name ?? $m->nama ?? 'M', 0, 2))); ?>

        </div>
    <?php endif; ?>
</div>

                   
<div class="bg-green-50 px-4 py-2 border-b">
    <h3 class="font-bold text-gray-900 text-sm line-clamp-1"><?php echo e($m->full_name ?? $m->nama); ?></h3>
    <?php
        $spesDisplay = $m->displayed_spesialisasi;
        if (is_array($spesDisplay)) {
            $spesDisplay = count($spesDisplay) > 0 ? $spesDisplay[array_rand($spesDisplay)] : null;
        }
    ?>
    <p class="text-xs text-emerald-600 font-bold uppercase line-clamp-1">
        <?php echo e($spesDisplay ?? 'Mentor'); ?>

    </p>
</div>

                    <div class="px-4 py-3 text-gray-600">
                        <p class="text-xs mb-2"><?php echo e($m->alamat_tampil ?? 'Lokasi tidak tersedia'); ?></p>
                        <?php
                            $avgRating = round($m->avg_rating);
                        ?>
                        <div class="flex items-center gap-1">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 <?php echo e($i <= $avgRating ? 'text-amber-400' : 'text-gray-300'); ?>" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            <?php endfor; ?>
                            <?php if($m->total_ulasan > 0): ?>
                                <span class="text-xs text-gray-400 ml-1"><?php echo e(number_format($m->avg_rating, 1)); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20 text-gray-400 italic">
                    Belum ada mentor yang tersedia.
                </div>
            <?php endif; ?>

        </div>

        
        <div class="mt-10 max-w-5xl mx-auto text-center">
            <?php echo e($trainers->links()); ?>

        </div>
    </section>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const cards       = document.querySelectorAll('.pembimbing-card');

            function filterCards() {
                const keyword = searchInput.value.toLowerCase();
                cards.forEach(card => {
                    const nama   = card.dataset.nama   || '';
                    const lokasi = card.dataset.lokasi || '';
                    const match  = nama.includes(keyword) || lokasi.includes(keyword);
                    card.style.display = match ? 'block' : 'none';
                });
            }

            searchInput.addEventListener('input', filterCards);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/pages/umkm-pembimbing.blade.php ENDPATH**/ ?>