<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">

    
    <div class="bg-white border-b border-gray-200 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-3">
            <a href="<?php echo e(route('home')); ?>"
               class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="min-w-0">
                <h1 class="text-base font-bold text-gray-800 leading-tight">Profil Saya</h1>
                <p class="text-xs text-gray-400 truncate">Kelola informasi dan keamanan akun</p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-5 space-y-4">

        
        <?php if(session('success')): ?>
        <div id="notif-success"
             class="px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-emerald-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="flex-1 leading-snug"><?php echo e(session('success')); ?></span>
            <button onclick="document.getElementById('notif-success').remove()" class="text-emerald-400 flex-shrink-0 mt-0.5">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div id="notif-error"
             class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-red-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 2a10 10 0 110 20A10 10 0 0112 2z"/>
            </svg>
            <span class="flex-1 leading-snug"><?php echo e(session('error')); ?></span>
            <button onclick="document.getElementById('notif-error').remove()" class="text-red-400 flex-shrink-0 mt-0.5">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <?php endif; ?>

        <?php if($errors->has('current_password')): ?>
        <div id="notif-pwd-error"
             class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-red-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 2a10 10 0 110 20A10 10 0 0112 2z"/>
            </svg>
            <span class="flex-1 leading-snug">❌ <?php echo e($errors->first('current_password')); ?></span>
            <button onclick="document.getElementById('notif-pwd-error').remove()" class="text-red-400 flex-shrink-0 mt-0.5">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <?php endif; ?>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-8">

            
            <div class="lg:col-span-1 space-y-4">

                
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-4">Foto Profil</h3>

                    
                    <div class="flex items-center gap-4 lg:block">
                        
                        <div class="w-20 h-20 lg:w-full lg:aspect-[3/4] lg:h-auto bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-200 flex items-center justify-center">
                            <?php if($user->profile_photo_path): ?>
                                <img id="preview-foto" src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>" class="w-full h-full object-cover object-top">
                            <?php else: ?>
                                <div id="preview-placeholder" class="text-3xl lg:text-6xl font-bold text-emerald-600 uppercase">
                                    <?php echo e(substr($user->name, 0, 1)); ?>

                                </div>
                                <img id="preview-foto" src="" class="w-full h-full object-cover hidden">
                            <?php endif; ?>
                        </div>

                        
                        <div class="flex-1 lg:mt-4">
                            <form action="<?php echo e(route('profile.update-photo')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <label class="block text-xs text-gray-500 mb-2">Pilih foto baru</label>
                                <input type="file" name="photo" id="input-foto"
                                    class="block w-full text-xs text-gray-500
                                           file:mr-3 file:py-1.5 file:px-3
                                           file:rounded-lg file:border-0 file:text-xs file:font-semibold
                                           file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 mb-3"
                                    accept="image/*">
                                <button type="submit"
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 px-4 rounded-xl font-semibold text-sm transition flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Update Foto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="lg:space-y-4">

                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-3">

                        
                        <?php if($user->role === 'admin'): ?>
                        <div class="p-4 lg:p-6 rounded-2xl text-white shadow-md bg-emerald-800">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="p-1 bg-white rounded-full flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-emerald-800" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-sm">Administrator ✓</h4>
                            </div>
                            <p class="text-xs text-emerald-100 leading-relaxed mb-3 hidden lg:block">
                                Anda login sebagai Admin. Kelola seluruh data platform dari sini.
                            </p>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                               class="block w-full bg-white text-emerald-800 py-2 rounded-lg font-bold text-xs lg:text-sm text-center hover:bg-gray-100 transition">
                                Dashboard Admin →
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if($user->role !== 'admin'): ?>

                        
                        <?php if($user->role === 'umkm'): ?>
                        <div class="p-4 lg:p-6 rounded-2xl text-white shadow-md bg-emerald-800">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="p-1 bg-white rounded-full flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-emerald-800" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-sm lg:text-base">Mitra UMKM ✓</h4>
                            </div>
                            <p class="text-xs text-emerald-100 leading-relaxed mb-3 hidden lg:block">
                                Akun Anda telah diverifikasi. Mulai kelola produk usaha dan program pelatihan Anda.
                            </p>
                            <a href="<?php echo e(route('dashboard-umkm')); ?>"
                               class="block w-full bg-white text-emerald-800 py-2 rounded-lg font-bold text-xs lg:text-sm text-center hover:bg-gray-100 transition">
                                Dashboard UMKM →
                            </a>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($user->role !== 'umkm'): ?>
                        <div class="p-4 lg:p-6 rounded-2xl text-white shadow-md transition-all duration-300
                            <?php if(isset($umkm) && $umkm->status == 'pending'): ?> bg-amber-500
                            <?php elseif(isset($umkm) && $umkm->status == 'approved'): ?> bg-emerald-800
                            <?php elseif(isset($umkm) && $umkm->status == 'rejected'): ?> bg-red-600
                            <?php else: ?> bg-emerald-700 <?php endif; ?>">

                            <?php if(isset($umkm) && $umkm->status == 'pending'): ?>
                                <div class="flex items-center gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-pulse flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h4 class="font-bold text-sm">UMKM · Ditinjau</h4>
                                </div>
                                <p class="text-xs text-amber-50 leading-relaxed mb-2">Tim Admin sedang memverifikasi data Anda.</p>
                                <div class="py-1.5 px-3 bg-black/10 rounded-lg text-center">
                                    <span class="text-[10px] uppercase font-black">Menunggu Persetujuan</span>
                                </div>

                            <?php elseif(isset($umkm) && $umkm->status == 'approved'): ?>
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="p-1 bg-white rounded-full flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-emerald-800" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-sm">Mitra UMKM ✓</h4>
                                </div>
                                <a href="<?php echo e(route('dashboard-umkm')); ?>"
                                   class="block w-full bg-white text-emerald-800 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">
                                    Dashboard UMKM →
                                </a>

                            <?php elseif(isset($umkm) && $umkm->status == 'rejected'): ?>
                                <h4 class="font-bold text-sm mb-1">UMKM Ditolak</h4>
                                <p class="text-xs text-red-50 mb-2">Data belum memenuhi syarat.</p>
                                <?php if($umkm->rejection_reason): ?>
                                    <div class="mb-3 p-2 bg-black/20 border border-white/20 rounded-lg">
                                        <p class="text-[10px] font-bold text-red-200 uppercase mb-1">Alasan:</p>
                                        <p class="text-xs text-white leading-relaxed"><?php echo e($umkm->rejection_reason); ?></p>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo e(route('profile.daftar-umkm')); ?>"
                                   class="block w-full bg-white text-red-600 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">
                                    Daftar Ulang
                                </a>

                            <?php else: ?>
                                <h4 class="font-bold text-sm mb-1">Daftar UMKM</h4>
                                <p class="text-xs text-emerald-100 mb-3 leading-relaxed hidden lg:block">Bergabunglah sebagai mitra UMKM KAJI INDONESIA</p>
                                <?php if($user->profile_photo_path): ?>
                                    <a href="<?php echo e(route('profile.daftar-umkm')); ?>" class="block w-full bg-white text-emerald-700 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">Daftar Sekarang</a>
                                <?php else: ?>
                                    <span class="block w-full bg-white/30 text-white/70 py-2 rounded-lg font-bold text-xs text-center cursor-not-allowed">Upload Foto Dulu</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($user->role === 'trainer'): ?>
                        <div class="p-4 lg:p-6 rounded-2xl text-white shadow-md bg-emerald-800">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="p-1 bg-white rounded-full flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-emerald-800" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-sm">Trainer ✓</h4>
                            </div>
                            <p class="text-xs text-emerald-100 leading-relaxed mb-3 hidden lg:block">Akun Anda telah diverifikasi sebagai Trainer.</p>
                            <a href="<?php echo e(route('trainer.dashboard')); ?>"
                               class="block w-full bg-white text-emerald-800 py-2 rounded-lg font-bold text-xs lg:text-sm text-center hover:bg-gray-100 transition">
                                Dashboard Trainer →
                            </a>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($user->role !== 'trainer'): ?>
                        <div class="p-4 lg:p-6 rounded-2xl text-white shadow-md transition-all duration-300
                            <?php if($user->trainer_status == 'pending'): ?> bg-amber-500
                            <?php elseif($user->trainer_status == 'rejected'): ?> bg-red-600
                            <?php else: ?> bg-emerald-700 <?php endif; ?>">

                            <?php if($user->trainer_status == 'pending'): ?>
                                <div class="flex items-center gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-pulse flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h4 class="font-bold text-sm">Trainer · Ditinjau</h4>
                                </div>
                                <p class="text-xs text-amber-50 leading-relaxed mb-2">Tim Admin sedang memverifikasi data Anda.</p>
                                <div class="py-1.5 px-3 bg-black/10 rounded-lg text-center">
                                    <span class="text-[10px] uppercase font-black">Menunggu Persetujuan</span>
                                </div>

                            <?php elseif($user->trainer_status == 'rejected'): ?>
                                <h4 class="font-bold text-sm mb-1">Trainer Ditolak</h4>
                                <p class="text-xs text-red-50 mb-2">Data belum memenuhi syarat.</p>
                                <?php if($trainer?->rejection_reason): ?>
                                    <div class="mb-3 p-2 bg-black/20 border border-white/20 rounded-lg">
                                        <p class="text-[10px] font-bold text-red-200 uppercase mb-1">Alasan:</p>
                                        <p class="text-xs text-white leading-relaxed"><?php echo e($trainer->rejection_reason); ?></p>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo e(route('profile.daftar-trainer')); ?>"
                                   class="block w-full bg-white text-red-600 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">
                                    Daftar Ulang
                                </a>

                            <?php else: ?>
                                <h4 class="font-bold text-sm mb-1">Daftar Trainer</h4>
                                <p class="text-xs text-emerald-100 mb-3 leading-relaxed hidden lg:block">Bergabunglah sebagai pengajar profesional di KAJI INDONESIA</p>
                                <?php if($user->profile_photo_path): ?>
                                    <a href="<?php echo e(route('profile.daftar-trainer')); ?>" class="block w-full bg-white text-emerald-700 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">Daftar Sekarang</a>
                                <?php else: ?>
                                    <span class="block w-full bg-white/30 text-white/70 py-2 rounded-lg font-bold text-xs text-center cursor-not-allowed">Upload Foto Dulu</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        
                        <?php if(isset($mentor)): ?>
                        <div class="p-4 lg:p-6 rounded-2xl text-white shadow-md transition-all duration-300
                            <?php if($mentor->status == 'pending'): ?> bg-amber-500
                            <?php elseif($mentor->status == 'approved'): ?> bg-emerald-800
                            <?php elseif($mentor->status == 'rejected'): ?> bg-red-600
                            <?php endif; ?>">
                            <div class="flex items-center gap-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 <?php echo e($mentor->status == 'pending' ? 'animate-pulse' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <h4 class="font-bold text-sm">
                                    <?php if($mentor->status == 'rejected'): ?> Mentor Ditolak
                                    <?php elseif($mentor->status == 'approved'): ?> Mentor ✓
                                    <?php else: ?> Mentor · Ditinjau
                                    <?php endif; ?>
                                </h4>
                            </div>
                            <?php if($mentor->status == 'rejected'): ?>
                                <?php if($mentor->rejection_reason): ?>
                                    <div class="mb-2 p-2 bg-black/20 border border-white/20 rounded-lg">
                                        <p class="text-[10px] font-bold uppercase text-red-200 mb-1">Alasan:</p>
                                        <p class="text-xs text-white leading-relaxed"><?php echo e($mentor->rejection_reason); ?></p>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo e(route('profile.daftar-mentor')); ?>"
                                   class="block w-full bg-white text-red-600 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">
                                    Daftar Ulang
                                </a>
                            <?php elseif($mentor->status == 'pending'): ?>
                                <p class="text-xs text-amber-100">Dokumen sedang dalam peninjauan Admin.</p>
                                <?php else: ?>
    <p class="text-xs text-emerald-100 mb-3 hidden lg:block">Akun telah diverifikasi sebagai Mentor.</p>
    <a href="<?php echo e(route('mentor.dashboard')); ?>"
       class="block w-full bg-white text-emerald-800 py-2 rounded-lg font-bold text-xs lg:text-sm text-center hover:bg-gray-100 transition">
        Dashboard Mentor →
    </a>
<?php endif; ?>
<?php if($mentor->status !== 'approved'): ?>
<div class="py-1 px-3 bg-black/10 rounded border border-white/20 text-center mt-2">
    <span class="text-[10px] uppercase font-black">Status: <?php echo e(strtoupper($mentor->status)); ?></span>
</div>
<?php endif; ?>
                        </div>
                        <?php endif; ?>

                        
                        <?php if(!isset($mentor)): ?>
                        <div class="bg-emerald-700 p-4 lg:p-6 rounded-2xl text-white shadow-md">
                            <h4 class="font-bold text-sm mb-1">Daftar Mentor</h4>
                            <p class="text-xs text-emerald-100 mb-3 leading-relaxed hidden lg:block">Bergabunglah sebagai pembimbing dan fasilitator UMKM</p>
                            <?php if($user->profile_photo_path): ?>
                                <a href="<?php echo e(route('profile.daftar-mentor')); ?>" class="block w-full bg-white text-emerald-700 py-2 rounded-lg font-bold text-xs text-center hover:bg-gray-100 transition">Daftar Sekarang</a>
                            <?php else: ?>
                                <span class="block w-full bg-white/30 text-white/70 py-2 rounded-lg font-bold text-xs text-center cursor-not-allowed">Upload Foto Dulu</span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?> 
                    </div>
                </div>

            </div>

            
            <div class="lg:col-span-2 space-y-4">

                
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-4 pb-3 border-b border-gray-100">
                        Informasi Akun
                    </h3>
                    <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Username</label>
                            <input type="text" value="<?php echo e($user->username); ?>" disabled
                                   class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-400 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Nama <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Email <span class="text-red-400">*</span></label>
                            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Nomor Telepon <span class="text-red-400">*</span></label>
                            <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Alamat <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <textarea name="address" rows="3"
                                      class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent resize-none transition"><?php echo e(old('address', $user->address)); ?></textarea>
                        </div>
                        <button type="submit"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-4 pb-3 border-b border-gray-100">
                        Ubah Password
                    </h3>
                    <form action="<?php echo e(route('profile.update-password')); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Password Saat Ini</label>
                            <input type="password" name="current_password"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition"
                                   placeholder="Masukkan password lama">
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Password Baru</label>
                                <input type="password" name="password"
                                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition"
                                       placeholder="Minimal 8 karakter">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition"
                                       placeholder="Ulangi password baru">
                            </div>
                        </div>
                        <button type="submit"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Update Password
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('input-foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = document.getElementById('preview-foto');
            const placeholder = document.getElementById('preview-placeholder');
            preview.src = event.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    ['notif-success', 'notif-error', 'notif-pwd-error'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            setTimeout(function() {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(function() { el.remove(); }, 500);
            }, 5000);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/profile/index.blade.php ENDPATH**/ ?>