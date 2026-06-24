<?php $__env->startSection('content'); ?>
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            
            <!-- TEXT -->
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">
                    UMKM KARYA KAMI
                </h1>

                <p class="mt-4 text-lg text-white/90">
                    Pendampingan dan penguatan kapasitas usaha mikro, kecil, dan menengah.
                </p>
            </div>

            <!-- IMAGE -->
            <div>
                <img 
                    src="<?php echo e(asset('storage/logo/KARYAKAMI.png')); ?>"
                    alt="Logo Karya Kami"
                    class="w-32 md:w-40 object-contain"
                >
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16 px-6 min-h-screen">

        <h2 class="font-serif text-center text-3xl font-bold text-gray-900 sm:text-4xl mb-10">
            Daftar UMKM
        </h2>

        
        <div class="max-w-2xl mx-auto flex flex-col sm:flex-row gap-4 mb-10">

            <div class="relative flex-1">

                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path 
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"
                        />
                    </svg>
                </span>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari produk..."
                    class="w-full pl-9 pr-4 py-2.5 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-green-300"
                >
            </div>
        </div>

        
        <div 
            class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
            id="produkGrid"
        >

        <?php $__empty_1 = true; $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div onclick="window.location='<?php echo e(route('produk.show', $item->id)); ?>'"
     class="produk-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200 flex flex-col duration-300 hover:shadow-lg hover:-translate-y-1 cursor-pointer"
     data-nama="<?php echo e(strtolower($item->nama)); ?>">

     <div class="relative w-full bg-gray-100 overflow-hidden" style="aspect-ratio: 3/4;">
    <img src="<?php echo e(asset('storage/' . $item->foto)); ?>"
         alt="<?php echo e($item->nama); ?>"
         class="w-full h-full object-cover object-top">

    <img src="<?php echo e(asset('storage/logo/KARYAKAMI.png')); ?>"
         alt="Logo"
         class="absolute top-2 right-2 w-20 h-10 object-contain rounded-md p-1 bg-white/80">
</div>

    <div class="bg-green-100 px-4 py-2">
        <h3 class="font-serif font-bold text-gray-900 text-lg text-center truncate"><?php echo e($item->nama); ?></h3>
        <p class="text-xs text-green-700 text-center truncate"><?php echo e($item->produk->nama); ?></p>
    </div>

    <div class="px-4 py-3 flex-1">
        <p class="text-sm text-gray-600 text-center leading-relaxed line-clamp-3 min-h-[3.75rem]">
            <?php echo e($item->deskripsi); ?>

        </p>
    </div>

    <div class="grid grid-cols-2">
        <?php
            $nomorWa = preg_replace('/[^0-9]/', '', $item->produk->whatsapp ?? $item->produk->kontak ?? '');
            if ($nomorWa && str_starts_with($nomorWa, '0')) {
                $nomorWa = '62' . substr($nomorWa, 1);
            }
            $pesanWa = urlencode('Halo UMKM ' . $item->produk->nama . ', saya tertarik dengan produk ' . $item->nama . ' setelah melihatnya di website KAJI Indonesia.' . "\n" . 'Boleh tanya-tanya lebih lanjut atau pesan produknya? Terima kasih!');
        ?>
        <span
            onclick="event.stopPropagation(); <?php echo e($nomorWa ? "window.open('https://wa.me/{$nomorWa}?text={$pesanWa}', '_blank')" : "alert('Nomor WhatsApp belum tersedia.')"); ?>"
            class="flex items-center justify-center bg-green-500 hover:bg-green-600 text-white text-sm font-semibold text-center py-3 transition-colors duration-200 cursor-pointer">
            WhatsApp
        </span>
        <span class="bg-orange-400 hover:bg-orange-500 text-gray-900 text-sm font-semibold text-center py-3 transition-colors duration-200">
            Detail
        </span>
    </div>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-4 text-center text-gray-400 py-20">
        Belum ada produk unggulan tersedia.
    </div>
<?php endif; ?>

        </div>

        
        <div id="noResult" class="hidden text-center text-gray-400 py-20">
            Produk tidak ditemukan.
        </div>

    </section>

    <script>

        const searchInput = document.getElementById('searchInput');
        const cards       = document.querySelectorAll('.produk-card');
        const noResult    = document.getElementById('noResult');

        searchInput.addEventListener('input', function () {

            const keyword = this.value.toLowerCase();
            let visible   = 0;

            cards.forEach(card => {

                const nama  = card.dataset.nama;
                const match = nama.includes(keyword);

                card.style.display = match ? 'flex' : 'none';

                if (match) visible++;

            });

            noResult.classList.toggle('hidden', visible > 0);

        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Kaji-indo-main\resources\views/pages/umkm-produk.blade.php ENDPATH**/ ?>