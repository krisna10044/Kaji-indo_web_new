<?php $__env->startSection('content'); ?>

<section
    class="relative overflow-hidden"
    style="min-height: 580px;"
    x-data="{
        active: 0,
        total: 5,
        autoplay: null,
        slides: [
            { url: 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1600&q=80&auto=format&fit=crop', label: 'Pelatihan & Pengembangan SDM' },
            { url: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=1600&q=80&auto=format&fit=crop', label: 'Pelatihan Bisnis Profesional' },
            { url: 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1600&q=80&auto=format&fit=crop', label: 'Konsultasi & Strategi Bisnis' },
            { url: 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1600&q=80&auto=format&fit=crop', label: 'Pendampingan UMKM' },
            { url: 'https://images.unsplash.com/photo-1579621970795-87facc2f976d?w=1600&q=80&auto=format&fit=crop', label: 'Sertifikasi & Legalitas Halal' },
        ],
        restartBar() {
            const bar = document.getElementById('hero-progress-bar');
            if (!bar) return;
            const parent = bar.parentNode;
            const clone = bar.cloneNode(false);
            clone.style.animation = 'none';
            parent.replaceChild(clone, bar);
            void clone.offsetWidth;
            clone.style.animation = 'hero-progress 5s linear forwards';
        },
        go(i) {
            this.active = (i + this.total) % this.total;
            this.restartBar();
            clearInterval(this.autoplay);
            this.autoplay = setInterval(() => { this.go(this.active + 1); }, 5000);
        },
        init() {
            this.$nextTick(() => { this.restartBar(); });
            this.autoplay = setInterval(() => { this.go(this.active + 1); }, 5000);
        }
    }"
    x-init="init()">

    
    <div class="absolute inset-0 z-0">
        <template x-for="(slide, index) in slides" :key="index">
            <div
                class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out"
                :style="'background-image: url(' + slide.url + ')'"
                :class="active === index ? 'opacity-100' : 'opacity-0'">
            </div>
        </template>
        <div class="absolute inset-0 bg-gradient-to-br from-primary-dark/88 via-primary/78 to-primary-light/65"></div>
        <div class="absolute inset-0 opacity-[0.035]"
             style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23fff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    
    <button @click="go(active - 1)"
        class="absolute left-2 sm:left-4 top-1/2 z-20 -translate-y-1/2
               flex h-8 w-8 sm:h-11 sm:w-11 items-center justify-center
               rounded-full bg-black/20 sm:bg-white/15 backdrop-blur-sm border border-white/20
               text-white transition-all duration-200 hover:bg-white/30 hover:scale-110 focus:outline-none"
        aria-label="Sebelumnya">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    
    <button @click="go(active + 1)"
        class="absolute right-2 sm:right-4 top-1/2 z-20 -translate-y-1/2
               flex h-8 w-8 sm:h-11 sm:w-11 items-center justify-center
               rounded-full bg-black/20 sm:bg-white/15 backdrop-blur-sm border border-white/20
               text-white transition-all duration-200 hover:bg-white/30 hover:scale-110 focus:outline-none"
        aria-label="Berikutnya">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    
    
    <div class="relative z-10 mx-auto max-w-7xl px-12 py-16 sm:px-16 sm:py-24 lg:px-20 lg:py-28 lg:flex lg:items-center lg:gap-12">
        <div class="w-full max-w-2xl mx-auto lg:mx-0 lg:max-w-xl text-center lg:text-left">

            
            <div class="mb-3 sm:mb-4 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 sm:px-4 sm:py-1.5 backdrop-blur-sm ring-1 ring-white/20">
                <span class="h-1.5 w-1.5 rounded-full bg-secondary animate-pulse flex-shrink-0"></span>
                <span class="text-[10px] sm:text-xs font-semibold uppercase tracking-widest text-white/90 truncate max-w-[180px] sm:max-w-none"
                      x-text="slides[active].label"></span>
            </div>

            <h1 class="font-serif text-3xl font-bold tracking-tight text-white drop-shadow-lg sm:text-4xl lg:text-5xl xl:text-6xl">
                Membangun Indonesia Melalui Kajian & Pelatihan
            </h1>
            <p class="mt-3 sm:mt-4 text-sm sm:text-base lg:text-lg text-white/90 drop-shadow leading-relaxed">
                Kaji Indonesia hadir sebagai mitra terpercaya dalam pengembangan SDM, pendampingan UMKM, sertifikasi halal, dan konsultasi bisnis dengan nilai-nilai profesional dan islami.
            </p>
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center lg:justify-start gap-3 sm:gap-4">
                <a href="#layanan"
                   class="inline-flex items-center justify-center rounded-xl bg-secondary px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-gray-900 shadow-lg transition-all hover:bg-secondary-dark hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2">
                    Lihat Program
                </a>
                <a href="#kontak"
                   class="inline-flex items-center justify-center rounded-xl border-2 border-white/80 bg-white/10 px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white backdrop-blur-sm transition-all hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>

    
    <div class="absolute bottom-5 left-1/2 z-20 -translate-x-1/2 flex items-center gap-1.5 sm:gap-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="go(index)"
                :aria-label="'Slide ' + (index + 1)"
                :class="active === index
                    ? 'w-5 sm:w-7 bg-white shadow-[0_0_8px_rgba(255,255,255,0.6)]'
                    : 'w-1.5 sm:w-2 bg-white/40 hover:bg-white/70'"
                class="h-1.5 sm:h-2 rounded-full transition-all duration-300 focus:outline-none cursor-pointer">
            </button>
        </template>
    </div>

    
    <div class="absolute bottom-0 left-0 right-0 z-20 h-[3px] bg-white/10">
        <div id="hero-progress-bar" class="h-full bg-white/70 rounded-r-full"></div>
    </div>

</section>

<style>
@keyframes hero-progress {
    from { width: 0%; }
    to   { width: 100%; }

    /* ── PARTNER MARQUEE ── */
    @keyframes marquee-left {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }
    @keyframes marquee-right {
        from { transform: translateX(-50%); }
        to   { transform: translateX(0); }
    }
    .marquee-row-left {
        animation: marquee-left 80s linear infinite;
    }
    .marquee-row-right {
        animation: marquee-right 80s linear infinite;
    }
    .partner-marquee:hover .marquee-row-left,
    .partner-marquee:hover .marquee-row-right {
        animation-play-state: paused;
    }

}

</style>
 
<section class="bg-white py-16 sm:py-20" id="statistik"
         x-data="{
             shown: false,
             counters: { event: 0, speakers: 0, participants: 0, topics: 0 },
             target: { event: 108, speakers: 512, participants: 15053, topics: 1024 },
             intervalId: null,
             step() {
                 const speed = 80;
                 let selesai = true;
                 ['event','speakers','participants','topics'].forEach(k => {
                     if (this.counters[k] < this.target[k]) {
                         selesai = false;
                         const add = Math.ceil(this.target[k] / speed);
                         this.counters[k] = Math.min(this.counters[k] + add, this.target[k]);
                     }
                 });
                 if (selesai) clearInterval(this.intervalId);
             },
             mulai() {
                 if (this.shown) return;
                 this.shown = true;
                 this.intervalId = setInterval(() => this.step(), 20);
             }
         }"
         x-init="
             const observer = new IntersectionObserver((entries) => {
                 entries.forEach(entry => {
                     if (entry.isIntersecting) {
                         mulai();
                         observer.disconnect();
                     }
                 });
             }, { threshold: 0.2 });
             observer.observe($el);
         ">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">


<div class="rounded-2xl border border-gray-100 bg-gray-50 p-6 text-center transition-all duration-300 hover:border-primary/20 hover:bg-primary/5">
    <p class="text-3xl font-bold tracking-tight text-primary sm:text-4xl lg:text-5xl"
       x-text="counters.event.toLocaleString('id-ID')">0</p>
    <p class="mt-2 text-sm text-gray-500">Acara</p>
</div>


<div class="rounded-2xl border border-gray-100 bg-gray-50 p-6 text-center transition-all duration-300 hover:border-primary/20 hover:bg-primary/5">
    <p class="text-3xl font-bold tracking-tight text-primary sm:text-4xl lg:text-5xl"
       x-text="counters.speakers.toLocaleString('id-ID')">0</p>
    <p class="mt-2 text-sm text-gray-500">Pembicara</p>
</div>


<div class="rounded-2xl border border-gray-100 bg-gray-50 p-6 text-center transition-all duration-300 hover:border-primary/20 hover:bg-primary/5">
    <p class="text-3xl font-bold tracking-tight text-primary sm:text-4xl lg:text-5xl"
       x-text="counters.participants.toLocaleString('id-ID')">0</p>
    <p class="mt-2 text-sm text-gray-500">Peserta</p>
</div>


<div class="rounded-2xl border border-gray-100 bg-gray-50 p-6 text-center transition-all duration-300 hover:border-primary/20 hover:bg-primary/5">
    <p class="text-3xl font-bold tracking-tight text-primary sm:text-4xl lg:text-5xl"
       x-text="counters.topics.toLocaleString('id-ID')">0</p>
    <p class="mt-2 text-sm text-gray-500">Topik Dibahas</p>
</div>

</div>
    </div>
</section>


<section class="bg-gray-50 py-10 sm:py-16 lg:py-20" id="layanan">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="font-serif text-2xl font-bold text-gray-900 sm:text-3xl lg:text-4xl">Layanan Unggulan</h2>
            <p class="mx-auto mt-3 max-w-2xl text-sm sm:text-base text-gray-600">Berbagai program dan layanan untuk mendukung perkembangan bisnis dan SDM Anda.</p>
        </div>
        <div class="mt-8 sm:mt-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <?php
    $layanan = [
        ['route' => 'pelatihan.program',   'external' => false, 'icon' => 'academic', 'title' => 'Pelatihan',    'desc' => 'Program pelatihan berkualitas untuk peningkatan kompetensi SDM dan profesional.'],
        ['route' => 'umkm.produk',         'external' => false, 'icon' => 'store',    'title' => 'UMKM',         'desc' => 'Pendampingan dan penguatan kapasitas usaha mikro, kecil, dan menengah.'],
        ['route' => 'halal-center.gratis', 'external' => false, 'icon' => 'halal',    'title' => 'Halal Center', 'desc' => 'Sertifikasi dan konsultasi halal untuk produk dan proses bisnis Anda.'],
        ['route' => 'konsultan.layanan',   'external' => false, 'icon' => 'consult',  'title' => 'Konsultan',    'desc' => 'Konsultasi strategi bisnis, manajemen, dan pengembangan organisasi.'],
        ['route' => 'https://infojawatimur.com', 'external' => true, 'icon' => 'media', 'title' => 'Media',      'desc' => 'Konten edukatif dan informasi seputar kajian, bisnis, dan halal.'],
        ['route' => null,                  'external' => false, 'icon' => 'book',     'title' => 'Kajian',       'desc' => 'Forum kajian dan diskusi untuk pengembangan wawasan dan jaringan.'],
    ];
?>
            <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rounded-2xl bg-white p-5 sm:p-6 shadow-sm ring-1 ring-gray-200/50 transition-shadow hover:shadow-lg">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <?php if(($item['icon'] ?? '') === 'academic'): ?>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        <?php elseif(($item['icon'] ?? '') === 'store'): ?>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <?php elseif(($item['icon'] ?? '') === 'halal'): ?>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <?php elseif(($item['icon'] ?? '') === 'consult'): ?>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <?php elseif(($item['icon'] ?? '') === 'media'): ?>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <?php else: ?>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="mt-4 font-serif text-lg sm:text-xl font-semibold text-gray-900"><?php echo e($item['title']); ?></h3>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed"><?php echo e($item['desc']); ?></p>
                    <?php if($item['external']): ?>
                        <a href="<?php echo e($item['route']); ?>" target="_blank" rel="noopener noreferrer"
                           class="mt-4 inline-flex items-center text-sm font-semibold text-primary hover:underline">
                            Selengkapnya
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    <?php elseif(!empty($item['route'])): ?>
                        <a href="<?php echo e(route($item['route'])); ?>"
                           class="mt-4 inline-flex items-center text-sm font-semibold text-primary hover:underline">
                            Selengkapnya
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    <?php else: ?>
                        <a href="#kontak" class="mt-4 inline-flex items-center text-sm font-semibold text-primary hover:underline">
                            Selengkapnya
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

 
<section class="bg-white py-16 sm:py-20" id="tentang-kami">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        
        <div class="text-center mb-6">
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Tentang Kami</h2>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:items-stretch">

         
            <div class="flex flex-col items-center justify-center gap-5">

                
                <img
                    src="<?php echo e(asset('storage/logo/LOGO KAJI KATA.jpeg')); ?>"
                    alt="Logo Kaji Indonesia"
                    class="object-contain"
                    style="height: 200px; width: auto;"
                />

                

            </div>

            
            <div class="flex flex-col justify-center" style="min-height: 280px;">
                <p class="text-gray-600 leading-relaxed text-sm sm:text-base text-justify">
                    <span class="font-semibold text-gray-800">KAJI Indonesia</span> adalah lembaga yang berfokus pada penguatan kolaborasi antar komunitas, organisasi, dan instansi. Berdiri sejak <span class="font-semibold text-primary">2008</span> sebagai penghubung komunitas di Jawa Timur, kini berkembang menjadi jaringan kolaboratif berskala nasional.
                </p>
                <p class="mt-4 text-gray-600 leading-relaxed text-sm sm:text-base text-justify">
                    Resmi menjadi lembaga nasional pada <span class="font-semibold text-primary">2012</span>, KAJI menghadirkan sinergi aktif dan berkelanjutan melalui inkubator bisnis dan layanan konsultasi untuk mendukung pertumbuhan ekonomi dan kualitas SDM.
                </p>
                <p class="mt-4 text-gray-600 leading-relaxed text-sm sm:text-base text-justify">
                    Dengan pendekatan <span class="font-medium text-gray-800">digital, legal, dan modern</span>, KAJI mendorong ekosistem kewirausahaan yang mandiri dan berdaya saing hingga tingkat global.
                </p>
                <div class="mt-6 flex flex-wrap gap-2">
                    <span class="inline-flex items-center rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold text-primary ring-1 ring-primary/20">Sejak 2008</span>
                    <span class="inline-flex items-center rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold text-primary ring-1 ring-primary/20">Lembaga Nasional</span>
                    <span class="inline-flex items-center rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold text-primary ring-1 ring-primary/20">Go Global</span>
                    <span class="inline-flex items-center rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold text-primary ring-1 ring-primary/20">Go Legal</span>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="bg-gray-50 py-12 sm:py-16">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

        
        <div class="text-center mb-8">
            <span class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold text-primary ring-1 ring-primary/20">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Legalitas & Sertifikasi
            </span>
            <h2 class="mt-3 font-serif text-2xl font-bold text-gray-900 sm:text-3xl">
                Terdaftar Resmi di KEMENKUMHAM
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                No: IDM001176552 – 2023 · Dilindungi UU No. 20 Tahun 2016 tentang Merek
            </p>
        </div>

        
        <div class="rounded-2xl overflow-hidden shadow-md ring-1 ring-gray-200">
            <img
                src="<?php echo e(asset('storage/logo/LOGOKAJIKEMENKUHAM.jpeg')); ?>"
                alt="Sertifikat KEMENKUMHAM KAJI Indonesia IDM001176552 2023"
                class="w-full h-auto object-contain"
            />
        </div>

    </div>
</section>

   
<section class="bg-gray-50 py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        
        <div class="text-center">
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Apa Kata Mereka</h2>
            <p class="mx-auto mt-3 max-w-2xl text-gray-600">Testimoni dari mitra dan peserta program KAJI Indonesia.</p>
        </div>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-200/50">
                <p class="text-gray-700">"Pelatihan dari KAJI Indonesia sangat aplikatif. Tim kami langsung bisa mengimplementasikan di lapangan."</p>
                <p class="mt-4 font-semibold text-gray-900">Bapak Ahmad, Direktur HR</p>
                <p class="text-sm text-gray-500">Perusahaan Manufaktur</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-200/50">
                <p class="text-gray-700">"Pendampingan UMKM dan proses sertifikasi halal kami berjalan lancar. Recommended."</p>
                <p class="mt-4 font-semibold text-gray-900">Ibu Siti, Pemilik UMKM</p>
                <p class="text-sm text-gray-500">Produk Makanan</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-200/50 sm:col-span-2 lg:col-span-1">
                <p class="text-gray-700">"Konsultan profesional dan komunikatif. Hasil rekomendasi strategi sangat membantu perkembangan bisnis kami."</p>
                <p class="mt-4 font-semibold text-gray-900">Bapak Rudi, CEO Startup</p>
                <p class="text-sm text-gray-500">Teknologi</p>
            </div>
        </div>

        
        <div class="mt-16 border-t border-gray-200 pt-12">
            <p class="text-center text-sm font-medium uppercase tracking-wider text-gray-500">
                Dipercaya oleh
            </p>

            <?php
                $partners = [
                    // ── 16 LAMA ──────────────────────────────
                    'partner-01.png',
                    'partner-03.png',
                    'partner-04.png',
                    'partner-05.png',
                    'partner-06.jpg',
                    'partner-07.png',
                    'partner-08.png',
                    'partner-09.jpg',
                    'partner-10.png',
                    'partner-11.png',
                    'partner-12.png',
                    'partner-14.jpeg',
                    'partner-15.jpg',
                    'partner-16.png',
                    'partner-17.png',

                    // ── 81 BARU ──────────────────────────────
                    'PERTAMINA.jpeg',
                    'DISKOP JATENG.jpg',
                    'LOGO DISKOP SURABAYA.png',
                    'LOGO INDOSAT.png',
                    'LOGO BAZNAS SURABAYA.jpg',
                    'LOGO 1080x380_INIJAWATIMUR.COM _.png',
                    'DISKOP TUBAN.jpg',
                    'LOGO GSE.png',
                    'KARYA KAMI LOGO.jpg',
                    'LOGO IKUTIAJA.png',
                    'LOGO IKASMANCA.png',
                    'KAMPUS-BERDAMPAK.png',
                    'LOGO DISKOP MALUKU TENGAH.jpg',
                    'LOGO BPJSTK.png',
                    'Cropped_LOGO_BRGM_512PX (1).png',
                    'LOGO (1) (1).png',
                    'LOGO IKA ITS.jpg',
                    'KONSTRUKSITALK (1).png',
                    'LOGO D_SEAFOOD.jpg',
                    '1200px-Logo_UNPAR.png',
                    'LOGO INFINIX.png',
                    'LOGO JOSSTODAY.png',
                    'LOGO JMKP.png',
                    'LOGO KADINJATIM (1).png',
                    'LOGO KEMBANG SETAMAN (1).png',
                    'LOGO LEAF CENA (1).jpeg',
                    'LOGO KIPPS.png',
                    'LOGO LIONS MAHARDHIKA.jpg',
                    'LOGO PKPOT.jpg',
                    'LOGO MIE SEHAT CEMPAKA 1.png',
                    'LOGO PPNS.jpg',
                    'LOGO STIE MAHARDHIKA.png',
                    'LOGO RB SIDOARJO.jpg',
                    'LOGO Dapurnya kopi probolinggo-02 - Siti Romlah.jpg',
                    'LOGO RB SUMSEL.jpg',
                    'LOGO SERAGAMKUPURNAMAMU.jpg',
                    'LOGO RB SURABAYA.png',
                    'LOGO SAGUQU MERBAU 22.png',
                    'LOGO ROMADU.png',
                    'LOGO_FONT_HITAM-removebg-preview (1) - Muhammad Najih Islahuddin.png',
                    'Logo APIK.png',
                    'Logo KC.jpg',
                    'Logo CITAMA.png',
                    'Logo AWPI.png',
                    'Logo HALAL HUB 6.png',
                    'Logo SPEKAL (1).png',
                    'Logo Unusida.png',
                    'Logo UNUSA.png',
                    'Logo FBI.png',
                    'Logo Yayasan Bina Insan Berkarya.jpeg',
                    'LogoBKPM (1).png',
                    'Logo-iniSurabaya-2021_web.png',
                    'Logo_Kementerian_Investasi_-_BKPM_(2021).png',
                    'Logo_Wadah_Warna@2x (1).png',
                    'PN MEKAR.png',
                    'Logo_Universitas_Darussalam_Gontor.jpg',
                    'RayTja Logo 2021 (1).jpg',
                    'TUGAS LOGO_ARI PRABOWO.png',
                    'logo Kemenkop.jpg',
                    'favicon kosntruksinews (1).png',
                    'bsn_logo_master_res.png',
                    'TUGAS LOGO_JULIMARINI.jpeg',
                    'institut asia.jpg',
                    'logo PENS (1).png',
                    'logo PelatihanBISA.png',
                    'logo UMKM Fest (1).png',
                    'logo UNAIR.png',
                    'logo UPN.png',
                    'logo logo (3) (1).png',
                    'logo logo (2) (1).png',
                    'Logo_of_the_Ministry_of_Villages,_Disadvantage_Region_Developments,_and_Transmigrations_of_the_Republic_of_Indonesia.svg.png',
                    'logo logo (8) (1).png',
                    'logo logo (5) (1).png',
                    'logo logo (6) (1).png',
                    'logo logo (7) (1).png',
                    'logo-PMR.png',
                    'logo psd.png',
                    'logo logo (9) (1).png',
                    'logo-pemkab-jember.png',
                    'logo-unitomo.png',
                    'logo_web_PCNU_SBY2.png',
                ];

                $slidesDesktop = array_chunk($partners, 18); // 6 col × 3 baris
                $slidesMobile  = array_chunk($partners, 9);  // 3 col × 3 baris
            ?>


            
            <div class="mt-8 relative hidden md:block"
                x-data="{
                    active: 0,
                    total: <?php echo e(count($slidesDesktop)); ?>,
                    autoplay: null,
                    go(i) {
                        this.active = (i + this.total) % this.total;
                        clearInterval(this.autoplay);
                        this.autoplay = setInterval(() => this.go(this.active + 1), 5000);
                    },
                    init() {
                        this.autoplay = setInterval(() => this.go(this.active + 1), 5000);
                    }
                }"
                x-init="init()">

                
                <div class="overflow-hidden px-12">
                    <div class="relative" style="min-height: 220px;">
                        <?php $__currentLoopData = $slidesDesktop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                x-show="active === <?php echo e($i); ?>"
                                x-transition:enter="transition ease-in-out duration-500"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in-out duration-500"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                :class="active === <?php echo e($i); ?> ? 'relative' : 'absolute inset-0'"
                                class="w-full grid grid-cols-6 gap-4">
                                <?php $__currentLoopData = $slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex aspect-square items-center justify-center rounded-xl bg-white p-3 shadow-sm ring-1 ring-gray-200/60 transition-all duration-300 hover:shadow-md hover:ring-gray-300">
                                        <img
                                            src="<?php echo e(asset('storage/partners/' . rawurlencode($logo))); ?>"
                                            alt="Partner"
                                            class="h-full w-full object-contain"
                                            loading="lazy"
                                        />
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <button @click="go(active - 1)" aria-label="Sebelumnya"
                    class="absolute left-0 top-1/2 -translate-y-1/2
                        flex h-9 w-9 items-center justify-center rounded-full
                        bg-white shadow-md ring-1 ring-gray-200 text-gray-600
                        transition-all duration-200
                        hover:bg-primary hover:text-white hover:ring-primary
                        focus:outline-none">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                
                <button @click="go(active + 1)" aria-label="Berikutnya"
                    class="absolute right-0 top-1/2 -translate-y-1/2
                        flex h-9 w-9 items-center justify-center rounded-full
                        bg-white shadow-md ring-1 ring-gray-200 text-gray-600
                        transition-all duration-200
                        hover:bg-primary hover:text-white hover:ring-primary
                        focus:outline-none">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                
                <div class="mt-8 flex justify-center items-center gap-2">
                    <template x-for="i in total" :key="i">
                        <button
                            @click="go(i - 1)"
                            :class="active === i - 1
                                ? 'w-7 bg-primary shadow-[0_0_6px_rgba(0,128,0,0.4)]'
                                : 'w-2 bg-gray-300 hover:bg-gray-400'"
                            class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                            :aria-label="'Slide ' + i">
                        </button>
                    </template>
                </div>

            </div>


            
            <div class="mt-8 relative block md:hidden"
                x-data="{
                    active: 0,
                    total: <?php echo e(count($slidesMobile)); ?>,
                    autoplay: null,
                    go(i) {
                        this.active = (i + this.total) % this.total;
                        clearInterval(this.autoplay);
                        this.autoplay = setInterval(() => this.go(this.active + 1), 5000);
                    },
                    init() {
                        this.autoplay = setInterval(() => this.go(this.active + 1), 5000);
                    }
                }"
                x-init="init()">

                
                <div class="overflow-hidden px-10">
                    <div class="relative" style="min-height: 280px;">
                        <?php $__currentLoopData = $slidesMobile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                x-show="active === <?php echo e($i); ?>"
                                x-transition:enter="transition ease-in-out duration-500"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in-out duration-500"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                :class="active === <?php echo e($i); ?> ? 'relative' : 'absolute inset-0'"
                                class="w-full grid grid-cols-3 gap-3">
                                <?php $__currentLoopData = $slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex aspect-square items-center justify-center rounded-xl bg-white p-3 shadow-sm ring-1 ring-gray-200/60 transition-all duration-300 hover:shadow-md hover:ring-gray-300">
                                        <img
                                            src="<?php echo e(asset('storage/partners/' . rawurlencode($logo))); ?>"
                                            alt="Partner"
                                            class="h-full w-full object-contain"
                                            loading="lazy"
                                        />
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <button @click="go(active - 1)" aria-label="Sebelumnya"
                    class="absolute left-0 top-1/2 -translate-y-1/2
                        flex h-8 w-8 items-center justify-center rounded-full
                        bg-white shadow-md ring-1 ring-gray-200 text-gray-600
                        transition-all duration-200
                        hover:bg-primary hover:text-white hover:ring-primary
                        focus:outline-none">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                
                <button @click="go(active + 1)" aria-label="Berikutnya"
                    class="absolute right-0 top-1/2 -translate-y-1/2
                        flex h-8 w-8 items-center justify-center rounded-full
                        bg-white shadow-md ring-1 ring-gray-200 text-gray-600
                        transition-all duration-200
                        hover:bg-primary hover:text-white hover:ring-primary
                        focus:outline-none">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                
                <div class="mt-8 flex justify-center items-center gap-1.5">
                    <template x-for="i in total" :key="i">
                        <button
                            @click="go(i - 1)"
                            :class="active === i - 1
                                ? 'w-5 bg-primary shadow-[0_0_6px_rgba(0,128,0,0.4)]'
                                : 'w-2 bg-gray-300 hover:bg-gray-400'"
                            class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                            :aria-label="'Slide ' + i">
                        </button>
                    </template>
                </div>

            </div>

        </div>

    </div>
</section>

    
    <section class="bg-primary py-16 sm:py-20" id="kontak">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="font-serif text-3xl font-bold text-white sm:text-4xl">Siap Berkembang Bersama Kami?</h2>
            <p class="mt-4 text-lg text-white/90">Daftar sekarang untuk program pelatihan, pendampingan UMKM, atau konsultasi. Tim kami siap mendampingi Anda.</p>
            <a href="<?php echo e(route('register')); ?>" class="mt-8 inline-flex items-center justify-center rounded-xl bg-secondary px-8 py-4 text-base font-semibold text-gray-900 shadow-lg transition-all hover:bg-secondary-dark hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 focus:ring-offset-primary">
                Daftar Sekarang
            </a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Kaji-indo-main\resources\views/pages/home.blade.php ENDPATH**/ ?>