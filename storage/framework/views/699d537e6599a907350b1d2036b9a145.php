<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('umkm.pembimbing')); ?>" class="text-white/80 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="font-serif text-2xl font-bold">Profil Mentor</h1>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-12 px-4 min-h-screen">
    <h2 class="font-serif text-center text-2xl font-bold text-gray-900 mb-10">Profil Mentor</h2>

    
    <div class="max-w-6xl mx-auto mb-4">
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                ✅ <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-amber-100 border border-amber-400 text-amber-800 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                ⚠️ <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-center font-semibold mb-4">Pembimbing</h3>

           <div class="w-full bg-gray-100 rounded-lg overflow-hidden" style="aspect-ratio: 3/4;">
    <?php if($mentor->foto): ?>
        <img src="<?php echo e(asset('storage/' . $mentor->foto)); ?>"
             alt="<?php echo e($mentor->full_name ?? $mentor->nama); ?>"
             class="w-full h-full object-cover object-top">
    <?php elseif($mentor->white_bg_photo): ?>
        <img src="<?php echo e(asset('storage/' . $mentor->white_bg_photo)); ?>"
             alt="<?php echo e($mentor->full_name ?? $mentor->nama); ?>"
             class="w-full h-full object-cover object-top">
    <?php elseif($mentor->user?->profile_photo_path): ?>
        <img src="<?php echo e(asset('storage/' . $mentor->user->profile_photo_path)); ?>"
             alt="<?php echo e($mentor->full_name ?? $mentor->nama); ?>"
             class="w-full h-full object-cover object-top">
    <?php else: ?>
        <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-emerald-700">
            <?php echo e(strtoupper(substr($mentor->full_name ?? $mentor->nama ?? 'M', 0, 2))); ?>

        </div>
    <?php endif; ?>
</div>

            
            <div class="flex items-center gap-1 mt-4">
                <?php $avgDisplay = round($avgRating); ?>
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 <?php echo e($i <= $avgDisplay ? 'text-amber-400' : 'text-gray-200'); ?>" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                <?php endfor; ?>
                <span class="text-gray-500 text-xs ml-1 font-medium">
                    <?php echo e(number_format($avgRating, 1)); ?> / 5
                    <span class="text-gray-400">(<?php echo e($totalUlasan); ?> ulasan)</span>
                </span>
            </div>

            
            <?php if($mentor->alamat_tampil): ?>
            <div class="flex items-start gap-1.5 mt-3 text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
                </svg>
                <span><?php echo e($mentor->alamat_tampil); ?></span>
            </div>
            <?php endif; ?>

            
            <?php if($mentor->phone): ?>
            <div class="flex items-center gap-1.5 mt-2 text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span><?php echo e($mentor->phone); ?></span>
            </div>
            <?php endif; ?>

            
            <?php if($mentor->email): ?>
            <div class="flex items-center gap-1.5 mt-2 text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="break-all"><?php echo e($mentor->email); ?></span>
            </div>
            <?php endif; ?>

            
<?php
    $sosmedData = [];
    if (!empty($mentor->sosmed)) {
        $decoded = is_array($mentor->sosmed) ? $mentor->sosmed : json_decode($mentor->sosmed, true);
        $sosmedData = is_array($decoded) ? $decoded : [];
    }

    $sosmedLinks = [
        'instagram' => [
            'icon'   => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4 4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z',
            'color'  => 'text-pink-500',
            'label'  => 'Instagram',
            'prefix' => 'https://instagram.com/',
        ],
        'twitter' => [
            'icon'   => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.259 5.63 5.905-5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z',
            'color'  => 'text-gray-800',
            'label'  => 'X / Twitter',
            'prefix' => 'https://x.com/',
        ],
        'linkedin' => [
            'icon'   => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z',
            'color'  => 'text-blue-700',
            'label'  => 'LinkedIn',
            'prefix' => 'https://linkedin.com/in/',
        ],
        'youtube' => [
            'icon'   => 'M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z',
            'color'  => 'text-red-600',
            'label'  => 'YouTube',
            'prefix' => 'https://youtube.com/@',
        ],
    ];

    $hasSosmed = collect(array_keys($sosmedLinks))->first(fn($k) => !empty($sosmedData[$k]));
?>

<?php if($hasSosmed): ?>
<div class="mt-3 pt-3 border-t border-gray-100">
    <p class="text-xs text-gray-400 font-medium mb-2">Media Sosial</p>
    <div class="flex flex-wrap gap-2">
        <?php $__currentLoopData = $sosmedLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($sosmedData[$key])): ?>
                <?php
                    $val = $sosmedData[$key];
                    $url = str_starts_with($val, 'http')
                        ? $val
                        : ($cfg['prefix'] . ltrim($val, '/'));
                ?>
                <a href="<?php echo e($url); ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-100 hover:border-gray-300 hover:bg-gray-100 transition text-xs font-medium text-gray-600 hover:text-gray-900">
                    <svg class="w-3.5 h-3.5 <?php echo e($cfg['color']); ?> flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="<?php echo e($cfg['icon']); ?>"/>
                    </svg>
                    <?php echo e($cfg['label']); ?>

                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

            
            <?php if($mentor->phone): ?>
            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $mentor->phone)); ?>"
               target="_blank"
               class="mt-5 flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition w-full">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Hubungi via WhatsApp
            </a>
            <?php endif; ?>

            
<?php if(auth()->guard()->check()): ?>
    <?php
        $userUmkm = \App\Models\Produk::where('user_id', auth()->id())
                        ->where('status', 'approved')
                        ->with('mentors')
                        ->first();
        $sudahTerhubung = $userUmkm && $userUmkm->mentors->contains($mentor->id);
    ?>
    <?php if($userUmkm): ?>
        <?php if($sudahTerhubung): ?>
            
            <div class="mt-3 w-full flex items-center justify-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold py-2.5 px-4 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Sudah Terhubung sebagai Pendamping
            </div>
        <?php else: ?>
            
            <button type="button"
                    onclick="document.getElementById('modalHubungMentor').classList.remove('hidden')"
                    class="mt-3 w-full group relative overflow-hidden flex items-center justify-center gap-2
                           bg-gradient-to-r from-orange-400 to-orange-500
                           hover:from-orange-500 hover:to-orange-600
                           text-white text-sm font-bold py-3 px-4 rounded-xl
                           shadow-md hover:shadow-orange-200 hover:shadow-lg
                           transition-all duration-200 active:scale-95">
                
                <span class="absolute inset-0 w-full h-full bg-white/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-500 skew-x-12"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Hubungkan dengan Mentor Ini
            </button>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
        </div>

        
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <p class="text-sm font-semibold text-gray-500">Hai, Saya</p>
            <h3 class="text-xl font-bold text-gray-900 mb-1"><?php echo e($mentor->full_name ?? $mentor->nama); ?></h3>

            <?php
    $spesPublik = [];
    $rawSpes = $mentor->spesialisasi;
    if (is_array($rawSpes)) {
        $spesPublik = array_values(array_filter(array_map('trim', $rawSpes)));
    } elseif (is_string($rawSpes) && $rawSpes) {
        $decoded = json_decode($rawSpes, true);
        $spesPublik = is_array($decoded)
            ? array_values(array_filter(array_map('trim', $decoded)))
            : array_values(array_filter(array_map('trim', explode(',', $rawSpes))));
    }
?>

<?php if(count($spesPublik) > 0): ?>
    <div class="flex flex-wrap gap-2 mb-4">
        <?php $__currentLoopData = $spesPublik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full uppercase">
            <?php echo e($spes); ?>

        </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full uppercase mb-4">
        Mentor
    </div>
<?php endif; ?>

            <p class="text-sm text-gray-600 leading-relaxed">
                <?php echo e($mentor->bio ?? $mentor->deskripsi ?? 'Belum ada deskripsi.'); ?>

            </p>
        </div>

        
<div class="bg-white p-6 rounded-xl shadow-sm">
    <div class="mb-4">
        <h3 class="font-semibold text-gray-900">UMKM Didampingi</h3>
    </div>

    <?php if($connectedUmkm->isEmpty()): ?>
        <div class="flex flex-col items-center justify-center py-8 text-center">
            <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Belum ada UMKM yang terhubung</p>
        </div>
    <?php else: ?>
        <div class="space-y-3 max-h-80 overflow-y-auto pr-1">
            <?php $__currentLoopData = $connectedUmkm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Ambil produk unggulan milik UMKM ini
                $itemUnggulan = \App\Models\ProdukItem::where('produk_id', $umkm->id)
                    ->where('is_unggulan', true)
                    ->first();
                // Fallback ke produk item pertama jika tidak ada unggulan
                $itemFallback = $itemUnggulan ?? \App\Models\ProdukItem::where('produk_id', $umkm->id)->first();
            ?>

            <?php if($itemFallback): ?>
                
                <a href="<?php echo e(route('produk.show', $itemFallback->id)); ?>"
                   class="flex items-center gap-3 p-2.5 bg-gray-50 rounded-lg hover:bg-emerald-50 hover:shadow-sm transition group">
            <?php else: ?>
                
                <div class="flex items-center gap-3 p-2.5 bg-gray-50 rounded-lg opacity-60 cursor-default">
            <?php endif; ?>
                    
                    <?php if($umkm->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $umkm->logo)); ?>"
                             alt="<?php echo e($umkm->nama); ?>"
                             class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-gray-100">
                    <?php elseif($itemFallback?->foto): ?>
                        <img src="<?php echo e(asset('storage/' . $itemFallback->foto)); ?>"
                             alt="<?php echo e($umkm->nama); ?>"
                             class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-gray-100">
                    <?php else: ?>
                        <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-sm flex-shrink-0">
                            <?php echo e(strtoupper(substr($umkm->nama ?? 'U', 0, 2))); ?>

                        </div>
                    <?php endif; ?>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-gray-900 truncate <?php echo e($itemFallback ? 'group-hover:text-emerald-700' : ''); ?> transition">
                            <?php echo e($umkm->nama); ?>

                        </p>
                        <div class="flex items-center gap-1.5 mt-0.5 flex-wrap">
                            <?php if($umkm->kategori): ?>
                                <span class="inline-block bg-white text-gray-400 text-xs px-2 py-0.5 rounded-full border border-gray-100">
                                    <?php echo e($umkm->kategori); ?>

                                </span>
                            <?php endif; ?>
                            <?php if($itemUnggulan): ?>
                                <span class="inline-block bg-amber-50 text-amber-600 text-xs px-2 py-0.5 rounded-full border border-amber-100">
                                    ⭐ <?php echo e($itemUnggulan->nama); ?>

                                </span>
                            <?php elseif(!$itemFallback): ?>
                                <span class="text-xs text-gray-300">Belum ada produk</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($itemFallback): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-emerald-500 transition flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    <?php endif; ?>

            <?php if($itemFallback): ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>

    </div>

    
    <div class="max-w-6xl mx-auto mt-8">
        <div class="bg-white rounded-xl shadow-sm p-6">

            
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Ulasan & Penilaian</h3>
                    <p class="text-sm text-gray-400 mt-0.5">Ulasan diberikan oleh UMKM yang didampingi mentor ini</p>
                </div>
                
                <div class="text-center hidden sm:block">
                    <p class="text-4xl font-extrabold text-amber-500"><?php echo e(number_format($avgRating, 1)); ?></p>
                    <div class="flex justify-center gap-0.5 mt-1">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 <?php echo e($i <= round($avgRating) ? 'text-amber-400' : 'text-gray-200'); ?>" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">dari <?php echo e($totalUlasan); ?> ulasan</p>
                </div>
            </div>

            
<?php if(auth()->guard()->check()): ?>
    <?php if($bisaMemberiUlasan && !$sudahUlasan): ?>
        <div class="bg-white rounded-xl border border-emerald-200 p-5 mb-8" id="formUlasan">
            <div class="flex items-center gap-2 mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                </svg>
                <h4 class="font-semibold text-gray-900">Tulis Ulasan Anda</h4>
            </div>

            <form action="<?php echo e(route('umkm.mentor.ulasan.store', $mentor->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                    <div class="flex gap-1" id="starContainer">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <button type="button"
                                    class="star-btn w-9 h-9 text-gray-300 hover:text-amber-400 transition-colors duration-150 focus:outline-none"
                                    data-value="<?php echo e($i); ?>"
                                    title="<?php echo e($i); ?> bintang">
                                <svg fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            </button>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="">
                    <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-4">
                    <label for="komentar" class="block text-sm font-medium text-gray-700 mb-2">
                        Komentar <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <textarea id="komentar"
                              name="komentar"
                              rows="3"
                              maxlength="1000"
                              placeholder="Bagikan pengalaman Anda bersama mentor ini..."
                              class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent resize-none"><?php echo e(old('komentar')); ?></textarea>
                    <p class="text-xs text-gray-400 mt-1 text-right" id="charCount">0 / 1000 karakter</p>
                    <?php $__errorArgs = ['komentar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit"
                        id="btnKirimUlasan"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    Kirim Ulasan
                </button>
            </form>
        </div>

    <?php elseif($bisaMemberiUlasan && $sudahUlasan): ?>
        <?php if(!session('success')): ?>
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-blue-700">Anda sudah memberikan ulasan untuk mentor ini. Terima kasih!</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>

<?php else: ?>
    <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-5 mb-6 text-center">
        <p class="text-sm text-gray-500 mb-3">Masuk terlebih dahulu sebagai UMKM untuk memberikan ulasan.</p>
        <a href="<?php echo e(route('login')); ?>" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
            Masuk Sekarang
        </a>
    </div>
<?php endif; ?>

            
            <?php if($ulasan->isEmpty()): ?>
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <p class="text-gray-500 font-medium">Belum ada ulasan</p>
                    <p class="text-gray-400 text-sm mt-1">Jadilah yang pertama memberikan ulasan untuk mentor ini.</p>
                </div>
            <?php else: ?>
                <div class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $ulasan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="py-5 first:pt-0" id="ulasan-<?php echo e($item->id); ?>">
                        <div class="flex items-start gap-4">
                            
                            <div class="flex-shrink-0">
                                <?php if($item->user->profile_photo_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->user->profile_photo_path)); ?>"
                                         alt="<?php echo e($item->user->name); ?>"
                                         class="w-10 h-10 rounded-full object-cover border border-gray-100">
                                <?php else: ?>
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm">
                                        <?php echo e(strtoupper(substr($item->user->name ?? 'U', 0, 2))); ?>

                                    </div>
                                <?php endif; ?>
                            </div>

                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 flex-wrap">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900"><?php echo e($item->user->name ?? 'Pengguna'); ?></p>
                                        <div class="flex items-center gap-1 mt-0.5">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-3.5 h-3.5 <?php echo e($i <= $item->rating ? 'text-amber-400' : 'text-gray-200'); ?>"
                                                     fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                </svg>
                                            <?php endfor; ?>
                                            <span class="text-xs text-gray-400 ml-0.5"><?php echo e($item->rating); ?>/5</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs text-gray-400"><?php echo e($item->created_at->diffForHumans()); ?></span>

                                        
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->id() === $item->user_id): ?>
                                                <form action="<?php echo e(route('umkm.mentor.ulasan.destroy', [$mentor->id, $item->id])); ?>"
                                                      method="POST"
                                                      onsubmit="return confirm('Hapus ulasan ini?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                            class="text-xs text-red-400 hover:text-red-600 transition font-medium">
                                                        Hapus
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if($item->komentar): ?>
                                    <p class="text-sm text-gray-600 mt-2 leading-relaxed"><?php echo e($item->komentar); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <?php if(auth()->guard()->check()): ?>
<div id="modalHubungMentor"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
     onclick="if(event.target===this) this.classList.add('hidden')">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 text-center"
         onclick="event.stopPropagation()">

        <div class="w-14 h-14 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>

        <h3 class="text-base font-bold text-gray-900 mb-1">Hubungkan dengan Mentor?</h3>
        <p class="text-sm text-gray-500 mb-6 leading-relaxed">
            Anda hanya dapat memiliki satu mentor aktif. Apakah Anda yakin ingin terhubung dengan mentor ini?
        </p>

        <div class="flex gap-3">
            <button type="button"
                    onclick="document.getElementById('modalHubungMentor').classList.add('hidden')"
                    class="flex-1 py-2.5 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">
                Batal
            </button>
            <form action="<?php echo e(route('umkm.pilih-mentor', $mentor->id)); ?>" method="POST" class="flex-1">
                <?php echo csrf_field(); ?>
                <button type="submit"
                        class="w-full py-2.5 rounded-lg bg-orange-400 hover:bg-orange-500 text-white text-sm font-semibold transition">
                    Ya, Hubungkan
                </button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

</section>


<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars      = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('ratingInput');
    const btnKirim   = document.getElementById('btnKirimUlasan');
    const textarea   = document.getElementById('komentar');
    const charCount  = document.getElementById('charCount');

    if (!stars.length) return;

    let selectedRating = 0;

    function highlightStars(value) {
        stars.forEach(star => {
            const v = parseInt(star.dataset.value);
            star.classList.toggle('text-amber-400', v <= value);
            star.classList.toggle('text-gray-300',  v > value);
        });
    }

    // Hover
    stars.forEach(star => {
        star.addEventListener('mouseenter', () => highlightStars(parseInt(star.dataset.value)));
        star.addEventListener('mouseleave', () => highlightStars(selectedRating));

        // Klik pilih rating
        star.addEventListener('click', () => {
            selectedRating = parseInt(star.dataset.value);
            ratingInput.value = selectedRating;
            highlightStars(selectedRating);
            if (btnKirim) btnKirim.disabled = false;
        });
    });

    // Counter karakter textarea
    if (textarea && charCount) {
        textarea.addEventListener('input', () => {
            charCount.textContent = textarea.value.length + ' / 1000 karakter';
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/detail-pembimbing.blade.php ENDPATH**/ ?>