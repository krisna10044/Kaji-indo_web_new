<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            
            <!-- TEXT -->
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">
                Layanan
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


<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
       

            
            <div>
                <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Tentang Layanan Kami</p>
                <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl mb-4">Solusi Konsultasi Terpercaya untuk Bisnis Anda</h2>
                <p class="text-gray-500 leading-relaxed mb-3">
                    Kami adalah mitra konsultasi bisnis profesional yang telah dipercaya oleh ratusan perusahaan di Indonesia. Dengan pendekatan berbasis data dan pengalaman bertahun-tahun, kami hadir untuk membantu bisnis Anda tumbuh secara berkelanjutan.
                </p>
                <p class="text-gray-500 leading-relaxed mb-6">
                    Layanan kami mencakup seluruh aspek bisnis dari legalitas usaha, strategi keuangan, hingga transformasi digital semua dalam satu atap.
                </p>
                <ul class="space-y-4">
                    <?php $__currentLoopData = [
                        ['title' => 'Konsultan Berpengalaman', 'desc' => 'Tim kami terdiri dari para ahli dengan pengalaman lintas industri.'],
                        ['title' => 'Solusi Terukur & Berbasis Data', 'desc' => 'Setiap rekomendasi didukung oleh analisis mendalam dan data aktual.'],
                        ['title' => 'Pendampingan Penuh', 'desc' => 'Kami mendampingi dari perencanaan hingga implementasi dan evaluasi.'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start gap-3">
                        <div class="shrink-0 mt-1 h-5 w-5 rounded-full bg-primary/10 flex items-center justify-center">
                            <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900"><?php echo e($f['title']); ?></p>
                            <p class="text-sm text-gray-500"><?php echo e($f['desc']); ?></p>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            

    </div>
</section>


<section class="bg-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4" id="stats-section">

            <?php $__currentLoopData = [
                ['target' => 888, 'label' => 'Trusted Clients', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                ['target' => 35,  'label' => 'Awards Won',     'icon' => 'M5 3h14M5 3a2 2 0 00-2 2v3a6 6 0 006 6h2a6 6 0 006-6V5a2 2 0 00-2-2M5 3H3m18 0h-2M9 14v1a3 3 0 006 0v-1M7 21h10'],
                ['target' => 25,  'label' => 'Expert Advisor', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['target' => 500, 'label' => 'Comp. Projects', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center gap-4 rounded-xl p-5 bg-gradient-to-br from-primary-dark via-primary to-primary-light text-white shadow-md shadow-primary/20">
                <div class="shrink-0 h-11 w-11 rounded-xl bg-white/15 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="<?php echo e($stat['icon']); ?>"/>
                    </svg>
                </div>
                <div class="h-10 w-px bg-white/25 shrink-0"></div>
                <div>
                    <p class="text-2xl font-bold">
                        <span class="stat-counter" data-target="<?php echo e($stat['target']); ?>">0</span>+
                    </p>
                    <p class="text-xs text-white/80 mt-0.5"><?php echo e($stat['label']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>


<script>
(function () {
    const counters = document.querySelectorAll('.stat-counter');
    let animated = false;

    function animateCounters() {
        if (animated) return;
        animated = true;

        counters.forEach(function (counter) {
            const target = parseInt(counter.getAttribute('data-target'), 10);
            const duration = 1800;
            const startTime = performance.now();

            function easeOutQuart(t) {
                return 1 - Math.pow(1 - t, 4);
            }

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                counter.textContent = Math.floor(easeOutQuart(progress) * target);
                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target;
                }
            }

            requestAnimationFrame(update);
        });
    }

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                animateCounters();
                observer.disconnect();
            }
        });
    }, { threshold: 0.3 });

    const section = document.getElementById('stats-section');
    if (section) observer.observe(section);
})();
</script>


<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Yang Kami Tawarkan</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Jenis Layanan Konsultan</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Kami menyediakan berbagai layanan konsultasi yang dirancang sesuai kebutuhan spesifik bisnis Anda.</p><br>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

            <?php $__currentLoopData = [
                [
                    'title' => 'Konsultan Bisnis',
                    'desc'  => 'Analisis bisnis model dan strategi pertumbuhan agar bisnis Anda berkembang berkelanjutan.',
                    'icon'  => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    'items' => ['Analisis model bisnis', 'Strategi pertumbuhan bisnis', 'Sustainability businesses'],
                ],
                [
                    'title' => 'Konsultan Legalitas Usaha',
                    'desc'  => 'Pengurusan izin usaha, sertifikasi profesi, dan kepatuhan regulasi bisnis Anda.',
                    'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'items' => ['Pengurusan izin usaha (NIB, SIUP)', 'Sertifikasi profesi', 'Audit kepatuhan regulasi'],
                ],
                [
                    'title' => 'Konsultan Legalitas Produk',
                    'desc'  => 'Pendampingan sertifikasi produk hingga perizinan edar agar produk Anda aman dan terpercaya.',
                    'icon'  => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                    'items' => ['Sertifikasi produk (BPOM, Halal, SNI)', 'Izin edar & merek dagang', 'Perlindungan hak kekayaan intelektual'],
                ],
                [
                    'title' => 'Konsultan Keuangan Bisnis',
                    'desc'  => 'Analisis keuangan untuk memaksimalkan profitabilitas dan meminimalkan risiko finansial.',
                    'icon'  => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'items' => ['Perencanaan arus kas & anggaran', 'Analisis kelayakan investasi', 'Restrukturisasi keuangan'],
                ],
                [
                    'title' => 'Website & Digital',
                    'desc'  => 'Solusi digital lengkap mulai dari pembuatan website, aplikasi, streaming, hingga pelatihan digital marketing.',
                    'icon'  => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2',
                    'items' => ['Pembuatan website profesional', 'Aplikasi & layanan streaming', 'Pelatihan digital marketing'],
                ],
                [
                    'title' => 'Keberlanjutan & Franchise',
                    'desc'  => 'Pengembangan bisnis jangka panjang melalui manajemen project, kerjasama, dan ekspansi franchise.',
                    'icon'  => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
                    'items' => ['Manajemen project & kerjasama', 'Pengembangan & ekspansi franchise', 'Analisis sustainability businesses'],
                ],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-primary to-primary-light"></div>
                <div class="p-6">
                    <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 group-hover:bg-primary/20 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="<?php echo e($layanan['icon']); ?>"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1"><?php echo e($layanan['title']); ?></h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4"><?php echo e($layanan['desc']); ?></p>
                    <ul class="space-y-1.5">
                        <?php $__currentLoopData = $layanan['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-3.5 h-3.5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <?php echo e($item); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>


<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Cara Kami Bekerja</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Proses Konsultasi Kami</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Setiap proyek kami jalankan melalui tahapan yang terstruktur untuk memastikan hasil yang optimal.</p><br>
        </div>

        <div class="relative">
            
            <div class="hidden lg:block absolute top-10 left-[calc(12.5%+1rem)] right-[calc(12.5%+1rem)] h-0.5 bg-gradient-to-r from-primary/20 via-primary/60 to-primary/20"></div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <?php $__currentLoopData = [
                    ['step' => '01', 'title' => 'Konsultasi Awal',       'desc' => 'Kami mendengarkan kebutuhan dan tantangan bisnis Anda secara mendalam melalui sesi diskusi terbuka.',                       'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                    ['step' => '02', 'title' => 'Analisis & Diagnosis',   'desc' => 'Tim kami melakukan analisis mendalam terhadap kondisi bisnis, pasar, dan peluang yang ada.',                            'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                    ['step' => '03', 'title' => 'Solusi & Rencana',       'desc' => 'Kami menyusun rekomendasi dan rencana aksi yang konkret, terukur, dan dapat diimplementasikan.',                         'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['step' => '04', 'title' => 'Implementasi & Evaluasi','desc' => 'Kami mendampingi proses implementasi dan mengevaluasi hasil secara berkala untuk memastikan target tercapai.',            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative flex flex-col items-center text-center">
                    <div class="relative mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-primary text-white shadow-lg shadow-primary/30 z-10">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($item['icon']); ?>"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 flex h-6 w-6 items-center justify-center rounded-full bg-white text-xs font-bold text-primary ring-2 ring-primary/20"><?php echo e($item['step']); ?></span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-2"><?php echo e($item['title']); ?></h3>
                    <p class="text-sm text-gray-500 leading-relaxed"><?php echo e($item['desc']); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>


<section class="bg-gradient-to-br from-primary-dark via-primary to-primary-light py-16 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-serif text-3xl font-bold sm:text-4xl">Siap Memulai Konsultasi?</h2>
        <p class="mt-4 text-lg text-white/85 max-w-xl mx-auto">
            Hubungi tim kami sekarang dan dapatkan sesi konsultasi awal secara gratis. Kami siap membantu bisnis Anda berkembang.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo e(route('konsultan.paket')); ?>"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-8 py-3.5 text-sm font-semibold text-primary hover:bg-gray-50 transition-colors duration-200 shadow-lg shadow-black/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Paket Konsultasi
            </a>
            <a href="https://wa.me/6281234567890"
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-white/40 bg-white/10 px-8 py-3.5 text-sm font-semibold text-white hover:bg-white/20 transition-colors duration-200 backdrop-blur-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/konsultan-layanan.blade.php ENDPATH**/ ?>