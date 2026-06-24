<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            
            <!-- TEXT -->
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">
                Paket Layanan
                </h1>

                <p class="mt-4 text-lg text-white/90">
                Konsultan Bisnis - Digital Marketing - Website - Apps - Streaming - Sertifikasi dan Legalitas Usaha.                </p>
            </div>

            <!-- IMAGE -->
            <div>
                <img 
                    src="<?php echo e(asset('storage/logo/KOPIGAYA.png')); ?>"
                    alt="Logo Karya Kami"
                    class="w-32 md:w-40 object-contain"
                >
            </div>
        </div>
    </section>


<style>
    /* --- Pricing Cards (default: background putih, teks hijau) --- */
    .plan-card {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border: 1px solid #d1fae5;
        border-radius: 1rem;
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.25s ease;
        will-change: transform;
    }

    /* Semua teks di card putih → hijau */
    .plan-card .card-plan-name  { color: #0F6E56; }
    .plan-card .card-currency   { color: #1D9E75; }
    .plan-card .card-price      { color: #0F6E56; }
    .plan-card .card-period     { color: #5DCAA5; }
    .plan-card .card-feature    { color: #1D9E75; border-color: #d1fae5; }
    .plan-card .card-divider    { border-color: #d1fae5; }

    /* Garis bawah animasi */
    .plan-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: #1D9E75;
        transform: scaleX(0);
        transform-origin: left center;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2);
    }

    .plan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 48px rgba(29, 158, 117, 0.15);
        border-color: #6ee7b7;
    }

    .plan-card:hover::after {
        transform: scaleX(1);
    }

    /* --- Featured card: background hijau → semua teks putih --- */
    .plan-card.featured {
        background: linear-gradient(145deg, #1D9E75 0%, #0F6E56 100%);
        border-color: transparent;
        box-shadow: 0 8px 30px rgba(29, 158, 117, 0.35);
    }

    .plan-card.featured .card-plan-name  { color: #ffffff; }
    .plan-card.featured .card-currency   { color: rgba(255,255,255,0.7); }
    .plan-card.featured .card-price      { color: #ffffff; }
    .plan-card.featured .card-period     { color: rgba(255,255,255,0.65); }
    .plan-card.featured .card-feature    { color: rgba(255,255,255,0.9); border-color: rgba(255,255,255,0.15); }
    .plan-card.featured .card-divider    { border-color: rgba(255,255,255,0.2); }
    .plan-card.featured .badge-populer   { background: rgba(255,255,255,0.2); color: #ffffff; }

    .plan-card.featured::after {
        background: rgba(255, 255, 255, 0.55);
    }

    .plan-card.featured:hover {
        transform: translateY(-10px);
        box-shadow: 0 22px 56px rgba(29, 158, 117, 0.45);
        border-color: transparent;
    }

    /* --- CTA Button --- */
    .plan-cta {
        display: block;
        width: 100%;
        margin-top: 2rem;
        padding: 0.65rem 0;
        text-align: center;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 9999px;
        text-decoration: none;
        transition: background 0.2s ease,
                    color 0.2s ease,
                    border-color 0.2s ease,
                    transform 0.15s ease;
    }

    .plan-cta.green-outline {
        border: 1.5px solid #1D9E75;
        color: #0F6E56;
        background: transparent;
    }

    .plan-cta.green-outline:hover {
        background: #1D9E75;
        color: #ffffff;
        border-color: #1D9E75;
        transform: scale(1.02);
    }

    .plan-cta.white-outline {
        border: 2px solid rgba(255, 255, 255, 0.75);
        color: #ffffff;
        background: rgba(255, 255, 255, 0.12);
    }

    .plan-cta.white-outline:hover {
        background: #ffffff;
        color: #1D9E75;
        border-color: #ffffff;
        transform: scale(1.02);
    }

    /* --- Testimonial Cards --- */
    .testi-card {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border: 1px solid #f3f4f6;
        border-radius: 1rem;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.25s ease;
    }

    /* Garis atas animasi */
    .testi-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: #1D9E75;
        transform: scaleX(0);
        transform-origin: left center;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2);
    }

    .testi-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        border-color: #d1fae5;
    }

    .testi-card:hover::before {
        transform: scaleX(1);
    }

    /* ===================== RESPONSIVE MOBILE - PAKET KONSULTAN ===================== */

    @media (max-width: 768px) {

        /* Hero section */
        .bg-gradient-to-br h1 {
            font-size: 2rem !important;
        }

        /* ── Pricing Grid: paksa 1 kolom ── */
        div[style*="grid-template-columns: 1fr 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }

        /* Pricing card */
        .plan-card {
            padding: 1.75rem 1.5rem !important;
        }

        /* Featured card (Advance): tampil di tengah urutan kedua, 
           beri efek agar tetap menonjol */
        .plan-card.featured {
            order: -1 !important; /* tampil pertama di mobile */
        }

        /* Harga lebih kecil sedikit */
        .card-price {
            font-size: 2.25rem !important;
        }

        /* CTA button */
        .plan-cta {
            margin-top: 1.5rem !important;
            padding: 0.75rem 0 !important;
            font-size: 0.9rem !important;
        }

        /* ── Testimoni Grid: paksa 1 kolom ── */
        div[style*="grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;"] {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }

        /* Testimoni card */
        .testi-card {
            padding: 1.25rem !important;
        }

        /* Section header */
        .mb-12 {
            margin-bottom: 2rem !important;
        }

        /* Catatan di bawah pricing */
        .mt-8 {
            margin-top: 1.25rem !important;
        }

        /* Padding section */
        .py-16 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
    }

</style>




<section id="paket" class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        
        <div class="mb-12 text-center">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Paket Layanan</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Pilih paket yang tepat</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Konsultasi profesional dengan harga terjangkau dan hasil nyata untuk pertumbuhan bisnis Anda.</p><br>
        </div>

        
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; align-items: stretch;">

            
            <div class="plan-card">
                <p class="card-plan-name text-center text-sm font-semibold">Basic Plan</p>
                <hr class="card-divider my-5">
                <div class="text-center">
                    <div class="flex items-baseline justify-center gap-1">
                        <span class="card-currency text-base font-medium">Rp</span>
                        <span class="card-price text-4xl font-bold">500K</span>
                    </div>
                    <p class="card-period mt-1 text-xs">per bulan</p>
                </div>
                <hr class="card-divider my-6">
                <ul style="flex: 1; list-style: none; padding: 0; margin: 0;">
                    <?php $__currentLoopData = [
                        'Konsultasi Legalitas Usaha',
                        'Konsultasi Legalitas Produk',
                        'Konsultasi Branding',
                        'Konsultasi Sertifikasi Profesi',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="card-feature border-b py-2.5 text-center text-sm last:border-0"><?php echo e($f); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <a href="#kontak" class="plan-cta green-outline">Pilih Paket Ini</a>
            </div>

            
            <div class="plan-card featured">
                <div class="mb-3 text-center">
                    <span class="badge-populer rounded-full px-4 py-1 text-xs font-semibold">✦ Paling Populer</span>
                </div>
                <p class="card-plan-name text-center text-sm font-semibold">Advance Plan</p>
                <hr class="card-divider my-5">
                <div class="text-center">
                    <div class="flex items-baseline justify-center gap-1">
                        <span class="card-currency text-base font-medium">Rp</span>
                        <span class="card-price text-4xl font-bold">4.500K</span>
                    </div>
                    <p class="card-period mt-1 text-xs">per bulan</p>
                </div>
                <hr class="card-divider my-6">
                <ul style="flex: 1; list-style: none; padding: 0; margin: 0;">
                    <?php $__currentLoopData = [
                        'Semua fitur Basic Plan',
                        '+ Konsultasi Keuangan',
                        '+ Konsultasi Kerjasama',
                        '+ Konsultasi Pemasaran',
                        '+ Mentoring Halal',
                        '+ Mentoring Ijin Edar',
                        '+ Mentoring Franchise',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="card-feature border-b py-2.5 text-center text-sm last:border-0"><?php echo e($f); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <a href="#kontak" class="plan-cta white-outline">Pilih Paket Ini</a>
            </div>

            
            <div class="plan-card">
                <p class="card-plan-name text-center text-sm font-semibold">Professional Plan</p>
                <hr class="card-divider my-5">
                <div class="text-center">
                    <div class="flex items-baseline justify-center gap-1">
                        <span class="card-currency text-base font-medium">Rp</span>
                        <span class="card-price text-4xl font-bold">6.000K</span>
                    </div>
                    <p class="card-period mt-1 text-xs">per bulan</p>
                </div>
                <hr class="card-divider my-6">
                <ul style="flex: 1; list-style: none; padding: 0; margin: 0;">
                    <?php $__currentLoopData = [
                        'Semua fitur Advance Plan',
                        '+ Layanan sesuai permintaan',
                        '+ Konsultan dedicated',
                        '+ Prioritas penanganan',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="card-feature border-b py-2.5 text-center text-sm last:border-0"><?php echo e($f); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <a href="#kontak" class="plan-cta green-outline">Pilih Paket Ini</a>
            </div>

        </div>

        <p class="mt-8 text-center text-xs text-gray-400">
            Semua paket sudah termasuk konsultasi awal <strong>gratis</strong>. Harga belum termasuk PPN.
        </p>
    </div>
</section>



<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        
        <div class="mb-12 text-center">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Testimoni Klien</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">
                Apa kata <span class="text-primary">klien</span> kami
            </h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">
                Konsultan Bisnis · Digital Marketing · Website · Apps · Streaming · Sertifikasi & Legalitas Usaha 
            </p><br>
        </div>

        
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">

            <?php
            $testimoni = [
                [
                    'nama'    => 'Marta',
                    'peran'   => 'Reporter',
                    'inisial' => 'MA',
                    'teks'    => 'Layanan streaming KOPIGAYA sudah saya nikmati sejak 3 tahun lalu. Kegiatan bisnis maupun keluarga dapat di-support semuanya oleh KOPIGAYA. Walaupun saya sedang berada di Jerman, layanan KOPIGAYA tetap menjadi solusi digital terbaik bagi saya.',
                ],
                [
                    'nama'    => 'Tony',
                    'peran'   => 'Bisnis Laundry Hotel & Rumah Sakit',
                    'inisial' => 'TO',
                    'teks'    => 'Perusahaan saya mendapatkan layanan Konsultasi Bisnis dari KOPIGAYA secara profesional. Kini usaha saya semakin meningkat dan berkembang, berkat legalitas usaha yang semuanya diselesaikan dengan tuntas oleh KOPIGAYA.',
                ],
                [
                    'nama'    => 'Sri Sudarmiana',
                    'peran'   => 'Restaurant Owner',
                    'inisial' => 'SS',
                    'teks'    => 'KOPIGAYA memberikan layanan profesional sejak pertama kali berkenalan hingga project selesai. Dengan kontrak yang sudah disepakati kedua belah pihak, kami sangat diuntungkan dan puas dengan hasilnya.',
                ],
            ];
            ?>

            <?php $__currentLoopData = $testimoni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="testi-card">
                    
                    <div class="mb-4 flex gap-0.5">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <svg class="h-4 w-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>

                    <p style="flex: 1;" class="text-sm leading-relaxed text-gray-600"><?php echo e($t['teks']); ?></p>

                    <div class="mt-6 flex items-center gap-3 border-t border-gray-100 pt-5">
                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-primary/10 text-xs font-bold text-primary">
                            <?php echo e($t['inisial']); ?>

                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900"><?php echo e($t['nama']); ?></p>
                            <p class="text-xs text-primary"><?php echo e($t['peran']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/konsultan-paket.blade.php ENDPATH**/ ?>