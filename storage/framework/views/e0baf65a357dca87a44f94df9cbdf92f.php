<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
        <a href="<?php echo e(route('umkm.produk')); ?>" class="text-white/80 hover:text-white transition">
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

        
        <div class="lg:col-span-1">
            <div class="bg-white p-4 rounded-2xl border shadow-sm text-center">
                <h4 class="font-serif font-bold text-lg text-gray-900 mb-1"><?php echo e($item->nama); ?></h4>
                <p class="text-xs text-green-700 font-semibold mb-4"><?php echo e($produk->nama); ?></p>

                <div class="relative rounded-xl overflow-hidden shadow-md bg-gray-50 border border-gray-100" style="aspect-ratio: 3/4;">
                    <?php if($item->foto): ?>
                        <img src="<?php echo e(asset('storage/' . $item->foto)); ?>"
                             class="w-full h-full object-cover object-top"
                             alt="<?php echo e($item->nama); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Foto belum tersedia</span>
                        </div>
                    <?php endif; ?>

                    <?php if($produk->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $produk->logo)); ?>"
                             alt="Logo <?php echo e($produk->nama); ?>"
                             class="absolute top-3 right-3 w-16 h-16 object-contain bg-white/95 rounded-xl p-1.5 shadow-md border border-gray-200/50">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="flex flex-col gap-6">

            
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm flex-1">

                <?php if($item->harga): ?>
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Harga</p>
                    <p class="text-green-600 font-semibold text-lg"><?php echo e($item->harga_format); ?></p>
                </div>
                <?php endif; ?>

                <?php if($item->kategori): ?>
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Kategori</p>
                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full mt-1">
                        <?php echo e($item->kategori); ?>

                    </span>
                </div>
                <?php endif; ?>

                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Keterangan</p>
                    <p class="text-gray-600 text-sm leading-relaxed mt-1"><?php echo e($item->deskripsi); ?></p>
                </div>

                <?php if($item->stok): ?>
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Stok</p>
                    <p class="text-gray-600 text-sm mt-1"><?php echo e($item->stok); ?> <?php echo e($item->satuan); ?></p>
                </div>
                <?php endif; ?>

                <?php if($produk->alamat): ?>
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700">Alamat</p>
                    <p class="text-gray-600 text-sm mt-1"><?php echo e($produk->alamat); ?></p>
                </div>
                <?php endif; ?>

                <?php
                    $nomorWa = preg_replace('/[^0-9]/', '', $produk->whatsapp ?? $produk->kontak ?? '');
                    if ($nomorWa && str_starts_with($nomorWa, '0')) {
                        $nomorWa = '62' . substr($nomorWa, 1);
                    }
                    $pesanWa = urlencode('Halo UMKM ' . $produk->nama . ', saya tertarik dengan produk ' . $item->nama . ' setelah melihatnya di website KAJI Indonesia.' . "\n" . 'Boleh tanya-tanya lebih lanjut atau pesan produknya? Terima kasih!');
                ?>

            </div>

            
            <div class="flex flex-col gap-3">
                <?php if($nomorWa): ?>
                <a href="https://wa.me/<?php echo e($nomorWa); ?>?text=<?php echo e($pesanWa); ?>"
                   target="_blank"
                   class="flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-semibold text-center py-4 rounded-xl transition-colors duration-200 text-base shadow-sm">
                    Chat WhatsApp
                </a>
                <?php endif; ?>

                <?php if($produk->alamat): ?>
                <a href="https://maps.google.com/?q=<?php echo e(urlencode($produk->alamat)); ?>"
                   target="_blank"
                   class="bg-orange-400 hover:bg-orange-500 text-white font-semibold text-center py-4 rounded-xl transition-colors duration-200 text-base shadow-sm">
                    Lihat Alamat
                </a>
                <?php endif; ?>
            </div>

        </div>

        
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h3 class="font-serif font-bold text-gray-900 text-lg text-center mb-1">Produk Lainnya</h3>
            <p class="text-xs text-green-700 text-center mb-4">dari <?php echo e($produk->nama); ?></p>

            <div class="flex flex-col gap-4 max-h-[600px] overflow-y-auto pr-1">
                <?php $__empty_1 = true; $__currentLoopData = $itemLainnya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('produk.show', $lain->id)); ?>"
                   class="flex flex-col items-center gap-2 group border-b border-gray-100 pb-3 last:border-0">
                    <?php if($lain->foto): ?>
                        <img src="<?php echo e(asset('storage/' . $lain->foto)); ?>"
                             alt="<?php echo e($lain->nama); ?>"
                             class="w-full h-28 object-cover rounded-xl group-hover:opacity-90 transition shadow-sm">
                    <?php else: ?>
                        <div class="w-full h-24 bg-gray-200 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400 text-xs">Tidak ada foto</span>
                        </div>
                    <?php endif; ?>
                    <p class="text-sm text-gray-700 font-medium text-center group-hover:text-green-600 transition truncate w-full px-2">
                        <?php echo e($lain->nama); ?>

                    </p>
                    <?php if($lain->harga): ?>
                    <p class="text-xs text-green-600 font-semibold"><?php echo e($lain->harga_format); ?></p>
                    <?php endif; ?>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center text-gray-400 text-sm py-10">
                    Tidak ada produk lain dari UMKM ini.
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/pages/detail-produk.blade.php ENDPATH**/ ?>