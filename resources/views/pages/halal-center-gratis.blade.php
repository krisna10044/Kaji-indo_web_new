@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            
            <!-- TEXT -->
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">
                    HALAL CENTER
                </h1>

                <p class="mt-4 text-lg text-white/90">
                    Pendampingan sertifikasi halal untuk UMKM, Koperasi, dan Komunitas Bisnis oleh tim konsultan bersertifikat dan kompeten.
                </p>
            </div>

            <!-- IMAGE -->
            <div>
                <img 
                    src="{{ asset('storage/logo/SYNTARA.png') }}"
                    alt="Logo Karya Kami"
                    class="w-64 md:w-80 object-contain"
                >
            </div>
        </div>
    </section>


{{-- ===================== STYLES ===================== --}}
<style>
    .halal-card {
        background: #ffffff;
        border: 1px solid #d1fae5;
        border-radius: 1rem;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.25s ease;
    }

    .halal-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: #1D9E75;
        transform: scaleX(0);
        transform-origin: left center;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2);
    }

    .halal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 36px rgba(29, 158, 117, 0.13);
        border-color: #6ee7b7;
    }

    .halal-card:hover::after {
        transform: scaleX(1);
    }

    .step-card {
        background: #ffffff;
        border: 1px solid #f3f4f6;
        border-radius: 1rem;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.25s ease;
    }

    .step-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(29, 158, 117, 0.1);
        border-color: #d1fae5;
    }

    .syarat-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        background: #ffffff;
        border: 1px solid #d1fae5;
        border-radius: 0.75rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .syarat-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 16px rgba(29, 158, 117, 0.1);
    }

    .portfolio-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.375rem 0.875rem;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #15803d;
        transition: background 0.2s, border-color 0.2s;
    }

    .portfolio-tag:hover {
        background: #dcfce7;
        border-color: #86efac;
    }

    .flow-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        height: 2rem;
        padding: 0 0.5rem;
        background: #1D9E75;
        color: #fff;
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 700;
        flex-shrink: 0;
    }

/* ===================== RESPONSIVE MOBILE - HALAL CENTER GRATIS ===================== */

    @media (max-width: 768px) {

        /* Hero section */
        .bg-gradient-to-br h1 {
            font-size: 2rem !important;
        }

        /* Padding section lebih compact */
        .py-16 {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }

        /* Grid Layanan: 1 kolom */
        .grid.gap-4 {
            grid-template-columns: 1fr !important;
        }

        /* Halal card */
        .halal-card {
            padding: 1.25rem !important;
        }

        .halal-card h3 {
            font-size: 0.875rem !important;
        }

        .halal-card p {
            font-size: 0.8rem !important;
            line-height: 1.55 !important;
        }

        .halal-card .inline-flex.h-11 {
            width: 2.25rem !important;
            height: 2.25rem !important;
            border-radius: 0.6rem !important;
            margin-bottom: 0.75rem !important;
        }

        /* ── Portofolio tags hijau ── */
        .flex.flex-wrap.justify-center.gap-2 {
            gap: 0.5rem !important;
            padding: 0 0.5rem !important;
        }

        .portfolio-tag {
            font-size: 0.75rem !important;
            padding: 0.35rem 0.85rem !important;
            border-radius: 9999px !important;
            font-weight: 600 !important;
        }

        /* ── Klien box: grid 2 kolom kartu ── */
        .rounded-2xl {
            padding: 1rem !important;
        }

        .rounded-2xl p.text-xs {
            font-size: 0.65rem !important;
            margin-bottom: 0.75rem !important;
        }

        .rounded-2xl .flex.flex-wrap {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 0.4rem !important;
        }

        .rounded-2xl .flex.flex-wrap span {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.68rem !important;
            font-weight: 500 !important;
            padding: 0.45rem 0.5rem !important;
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            color: #374151 !important;
            text-align: center !important;
            line-height: 1.35 !important;
            min-height: 2.2rem !important;
            word-break: break-word !important;
            white-space: normal !important;
        }

        /* Item panjang sendirian: span full */
        .rounded-2xl .flex.flex-wrap span:last-child:nth-child(odd) {
            grid-column: span 2 !important;
        }

        /* ── Syarat Pendaftaran: 3 kolom → 1 kolom ── */
        .grid.gap-8.lg\\:grid-cols-3 {
            grid-template-columns: 1fr !important;
            gap: 1rem !important;
        }

        .grid.gap-8.lg\\:grid-cols-3 > div {
            padding: 1rem !important;
            border-radius: 0.875rem !important;
        }

        .grid.gap-8.lg\\:grid-cols-3 .inline-flex.items-center.gap-2 {
            padding: 0.35rem 0.75rem !important;
            font-size: 0.7rem !important;
        }

        .grid.gap-8.lg\\:grid-cols-3 li {
            font-size: 0.8rem !important;
            line-height: 1.5 !important;
        }

        .grid.gap-8.lg\\:grid-cols-3 li svg {
            width: 0.9rem !important;
            height: 0.9rem !important;
            flex-shrink: 0 !important;
            margin-top: 0.15rem !important;
        }

        /* ── Alur Sertifikasi ── */
        .step-card {
            padding: 1.1rem !important;
        }

        .step-card .flex.items-start.gap-4 {
            gap: 0.75rem !important;
        }

        /* ── Tim grid: 1 kolom ── */
        .grid.gap-4.sm\\:grid-cols-2.lg\\:grid-cols-3 {
            grid-template-columns: 1fr !important;
        }

        /* ── FAQ ── */
        .mx-auto.max-w-3xl {
            max-width: 100% !important;
        }

        /* ── CTA Section ── */
        .mt-6.flex.flex-wrap.justify-center.gap-4 {
            flex-direction: column !important;
            align-items: center !important;
            gap: 0.5rem !important;
        }

        .mt-8.flex.flex-col.sm\\:flex-row {
            flex-direction: column !important;
            gap: 0.75rem !important;
        }

        .mt-8.flex.flex-col.sm\\:flex-row a {
            width: 100% !important;
            justify-content: center !important;
        }

        /* Section header */
        .mb-12 { margin-bottom: 1.75rem !important; }
        .mb-10 { margin-bottom: 1.25rem !important; }

        /* Info box estimasi */
        .mt-4.rounded-xl {
            padding: 0.875rem 1rem !important;
            font-size: 0.8rem !important;
        }
    }

</style>


{{-- Tentang Program --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Heading tengah --}}
        <div class="text-center mb-10">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Tentang Program</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">HALAL CENTER GRATIS</h2><br>
        </div>

        {{-- Konten --}}
        <div class="max-w-3xl mx-auto">
            <p class="text-gray-500 leading-relaxed mb-3">
                Program Halal Center Gratis Merupakan layanan pendampingan sertifikasi halal yang dirancang khusus untuk pelaku usaha mikro dan kecil (UMK), koperasi, dan komunitas bisnis. Kami hadir memastikan produk Anda memenuhi standar kehalalan yang diakui secara resmi tanpa membebani biaya operasional Anda.
            </p>
        </div>
    </div>
</section>

{{-- Layanan yang Dicakup --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Cakupan Layanan</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Yang Kami Bantu</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Layanan komprehensif untuk memastikan produk dan proses bisnis Anda memenuhi standar kehalalan resmi.</p><br>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                [
                    'title' => 'Pendampingan Sertifikasi Halal Reguler',
                    'desc'  => 'Kami memandu seluruh proses pengajuan ke BPJPH untuk UMK, Non-UMK, Koperasi, dan Komunitas Bisnis dari persiapan hingga terbit sertifikat.',
                    'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                ],
                [
                    'title' => 'Audit Proses Produksi & Fasilitas',
                    'desc'  => 'Tim auditor kami memeriksa rantai produksi, gudang, peralatan, dan fasilitas untuk memastikan tidak ada unsur yang tidak halal.',
                    'icon'  => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
                ],
                [
                    'title' => 'Penyusunan Dokumen SJPH / HAS 23000',
                    'desc'  => 'Kami membantu menyusun Sistem Jaminan Produk Halal (SJPH) sesuai standar HAS 23000 yang disyaratkan BPJPH, lengkap dengan SOP dan IK.',
                    'icon'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                ],
                [
                    'title' => 'Konsultasi Bahan Baku & Supplier',
                    'desc'  => 'Kami membantu mengidentifikasi dan memverifikasi status kehalalan seluruh bahan baku, bahan pendukung, dan rantai pasokan produk Anda.',
                    'icon'  => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                ],
                [
                    'title' => 'Pelatihan Penyelia Halal Internal',
                    'desc'  => 'Kami menyelenggarakan pelatihan bagi tim internal agar seluruh karyawan memahami dan menerapkan prinsip halal sesuai regulasi terbaru.',
                    'icon'  => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                ],
                [
                    'title' => 'Pendampingan Regulasi & Legalitas',
                    'desc'  => 'Bantuan pengurusan NIB, dan dokumen legalitas lain yang dibutuhkan sebagai prasyarat proses sertifikasi halal.',
                    'icon'  => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                ],
            ] as $layanan)
            <div class="halal-card">
                <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10">
                    <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $layanan['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-1">{{ $layanan['title'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $layanan['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- Portofolio Pendampingan --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Pengalaman Kami</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Portofolio Pendampingan</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">SYNTARA telah mendampingi berbagai pelaku usaha dalam proses sertifikasi halal melalui Pendamping Proses Produk Halal (P3H) bersertifikat.</p><br>
        </div>

        {{-- P3H Tags --}}
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            @forelse ($p3hTrainers as $trainer)
            <span class="portfolio-tag">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ $trainer->nama_lengkap }}
            </span>
            @empty
            <p class="text-sm text-gray-400 italic">Belum ada pendamping terdaftar.</p>
            @endforelse
        </div>
    </div>
</section>


{{-- Syarat Pendaftaran --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Persyaratan</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Berkas yang Disiapkan</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Siapkan dokumen-dokumen berikut agar proses pendampingan dapat berjalan lancar dan cepat.</p><br>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">

            {{-- Perijinan Usaha --}}
            <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                <div class="mb-4 inline-flex items-center gap-2 rounded-lg bg-primary/10 px-3 py-1.5">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="text-xs font-bold text-primary uppercase tracking-wide">Perijinan Usaha</span>
                </div>
                <ul class="space-y-2.5">
                    @foreach ([
                        'NIB aktif (jika belum punya, siapkan 1 KTP pemilik untuk dibantu daftarkan konsultan)',
                        'Tentukan jenis produk yang didaftarkan (nama & ejaan yang benar)',
                        'Tentukan alamat usaha, produksi, dan outlet (jika ada)',
                        'Siapkan 2 meterai',
                        'Stempel usaha',
                        'Kop surat perusahaan',
                        'Tanda tangan pemilik usaha di kertas putih',
                    ] as $item)
                    <li class="flex items-start gap-2 text-sm text-gray-600">
                        <svg class="mt-0.5 h-4 w-4 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                        </svg>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Pendukung Personil --}}
            <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                <div class="mb-4 inline-flex items-center gap-2 rounded-lg bg-primary/10 px-3 py-1.5">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-xs font-bold text-primary uppercase tracking-wide">Pendukung Personil</span>
                </div>
                <ul class="space-y-2.5">
                    @foreach ([
                        'Pemilik Usaha (nama, NIK, no. HP)',
                        'Penanggungjawab Halal (boleh berbeda dengan pemilik)',
                        'Penyelia Halal bersertifikat BNSP <strong class="text-primary">disiapkan oleh Konsultan SYNTARA</strong>',
                        'Karyawan pendukung lain (nama, no. HP, jabatan)',
                    ] as $item)
                    <li class="flex items-start gap-2 text-sm text-gray-600">
                        <svg class="mt-0.5 h-4 w-4 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                        </svg>
                        {!! $item !!}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Template Berkas --}}
            <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
                <div class="mb-4 inline-flex items-center gap-2 rounded-lg bg-primary/10 px-3 py-1.5">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-xs font-bold text-primary uppercase tracking-wide">Pengisian Template <span class="normal-case font-normal">(diisi pelaku usaha)</span></span>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    @foreach ([
                        'Daftar produk jadi + foto produk (2 posisi)',
                        'Daftar bahan baku & bahan pendukung (lengkap dengan distributor/supplier)',
                        'Matrik bahan dan produk',
                        'Catatan pembelian bahan baku & bahan penunjang',
                        'Catatan penyimpanan bahan dan produk jadi',
                        'Catatan hasil produksi',
                        'Catatan pemeriksaan bahan datang',
                        'Diagram alir proses produksi (per item)',
                        'Catatan penjualan produksi',
                        'Daftar formulasi produk',
                        'Absensi pelatihan penyelia halal internal',
                    ] as $i => $item)
                    <li class="flex items-start gap-2">
                        <span class="shrink-0 text-xs font-bold text-primary/60 mt-0.5 w-5">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}.</span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>


{{-- Alur Sertifikasi --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Cara Kerja</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Alur Sertifikasi Halal</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Delapan tahap terstruktur menuju sertifikat halal resmi BPJPH untuk produk Anda.</p><br>
        </div>

        <div class="mx-auto max-w-3xl space-y-3">
            @php
            $alur = [
                ['step'=>'01', 'title'=>'Pendaftaran',         'durasi'=>'6 Hari',      'who'=>'Konsultan & Pelaku Usaha', 'desc'=>'Konsultan mengumpulkan data awal dari pelaku usaha untuk memulai proses pendaftaran.'],
                ['step'=>'02', 'title'=>'Pemberkasan SJPH',    'durasi'=>'8 Hari',      'who'=>'Konsultan',                'desc'=>'Konsultan menyusun berkas Sistem Jaminan Produk Halal (SJPH) berdasarkan data input dari pelaku usaha.'],
                ['step'=>'03', 'title'=>'Upload Sistem',       'durasi'=>'2 Hari',      'who'=>'Konsultan & Penyelia Halal','desc'=>'Berkas SJPH diunggah ke sistem BPJPH oleh konsultan bersama Penyelia Halal.'],
                ['step'=>'04', 'title'=>'Cek Revisi',          'durasi'=>'3 Hari',      'who'=>'Konsultan & Penyelia Halal','desc'=>'Konsultan dan Penyelia Halal memeriksa dan menyelesaikan revisi yang diminta sistem BPJPH.'],
                ['step'=>'05', 'title'=>'Persetujuan SJPH',    'durasi'=>'12 Hari',     'who'=>'BPJPH & LPH',             'desc'=>'BPJPH dan Lembaga Pemeriksa Halal (LPH) mitra melakukan review dan memberikan persetujuan SJPH.'],
                ['step'=>'06', 'title'=>'Audit LPH',           'durasi'=>'10+1 Hari',   'who'=>'LPH, Penyelia, Pelaku',   'desc'=>'LPH menjadwalkan audit (10 hari) dan melaksanakan audit lapangan selama 1 hari bersama Penyelia Halal dan Pelaku Usaha.'],
                ['step'=>'07', 'title'=>'Sidang Fatwa MUI',    'durasi'=>'10–20 Hari',  'who'=>'MUI',                     'desc'=>'Majelis Ulama Indonesia melaksanakan sidang fatwa untuk menetapkan status kehalalan produk.'],
                ['step'=>'08', 'title'=>'Terbit Sertifikat',   'durasi'=>'1 Hari',      'who'=>'Konsultan → Pelaku Usaha','desc'=>'Sertifikat halal resmi diterbitkan oleh BPJPH, kemudian diserahkan oleh konsultan kepada pelaku usaha.'],
            ];
            @endphp

            @foreach ($alur as $item)
            <div class="step-card flex items-start gap-4">
                <div class="shrink-0 flex flex-col items-center gap-1">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold shadow-md shadow-primary/25">
                        {{ $item['step'] }}
                    </div>
                    @if (!$loop->last)
                    <div class="w-0.5 h-4 bg-primary/20 rounded-full"></div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <h3 class="text-sm font-bold text-gray-900">{{ $item['title'] }}</h3>
                        <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $item['durasi'] }}</span>
                    </div>
                    <p class="text-xs text-gray-400 mb-1.5">Pelaksana: {{ $item['who'] }}</p>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach

            <div class="mt-4 rounded-xl bg-primary/5 border border-primary/20 px-5 py-4 flex items-center gap-3">
                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-primary font-medium">Total estimasi proses: <strong>42–62 hari kerja</strong> dari pendaftaran hingga sertifikat terbit.</p>
            </div>
        </div>
    </div>
</section>


{{-- Tim SYNTARA --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Tim Kami</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Tim SYNTARA</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Didukung oleh tenaga profesional bersertifikat yang berpengalaman di bidang sertifikasi dan ekosistem halal.</p><br>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['name'=>'Ari Prabowo, ST., MM., C.PH.',   'roles'=>['Direktur SYNTARA', 'Penyelia Halal', 'Juru Sembelih Halal', 'Konsultan'], 'highlight'=>true],
                ['name'=>'Sabhira Kamilarahma, S.Si.',     'roles'=>['Penyelia Halal', 'Fasilitator']],
                ['name'=>'Dwi Kurniawan, SE.',              'roles'=>['Penyelia Halal', 'Fasilitator']],
                ['name'=>'Meiyanti Nainggolan, SE.',        'roles'=>['Penyelia Halal', 'Trainer']],
                ['name'=>'Fahmi Syaifuddin R., SH.',        'roles'=>['Pendamping Hukum', 'Juru Sembelih Halal', 'Fasilitator']],
                ['name'=>'Dr. Putrinadia F.P.',             'roles'=>['Fasilitator Higienis']],
                ['name'=>'Julimarini Sri Retno',            'roles'=>['Fasilitator', 'Staff Administrasi']],
                ['name'=>'Sulthan Helmizein, S.IKom.',      'roles'=>['Fasilitator', 'Social Media']],
                ['name'=>'Dina Ediwani',                    'roles'=>['PPH UMK', 'Fasilitator', 'Trainer']],
            ] as $member)
            <div class="halal-card {{ $member['highlight'] ?? false ? 'bg-gradient-to-br from-primary/5 to-emerald-50 border-primary/30' : '' }}">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $member['name'] }}</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($member['roles'] as $role)
                    <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $role }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- FAQ --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Pertanyaan Umum</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">FAQ</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Jawaban atas pertanyaan yang paling sering diajukan seputar program Halal Center Gratis SYNTARA.</p><br>
        </div>

        <div class="mx-auto max-w-3xl space-y-3">
            @php
            $faqs = [
                ['q' => 'Apakah benar-benar gratis? Tidak ada biaya tersembunyi?',
                 'a' => 'Ya, layanan konsultasi, pendampingan, dan pelatihan dari SYNTARA sepenuhnya gratis untuk pelaku UMK yang memenuhi syarat. Biaya yang mungkin timbul hanya biaya resmi dari BPJPH yang merupakan kewajiban negara dan di luar layanan kami.'],
                ['q' => 'Berapa lama proses sertifikasi halal?',
                 'a' => 'Berdasarkan alur resmi BPJPH, total estimasi proses berlangsung 42–62 hari kerja, mulai dari pendaftaran hingga sertifikat terbit. Program kami dirancang untuk memastikan setiap tahap berjalan efisien.'],
                ['q' => 'Apakah Penyelia Halal harus saya cari sendiri?',
                 'a' => 'Tidak. SYNTARA menyediakan Penyelia Halal bersertifikat BNSP sebagai bagian dari layanan pendampingan. Anda tidak perlu mencari atau merekrut penyelia halal secara mandiri.'],
                ['q' => 'Produk apa saja yang bisa didaftarkan?',
                 'a' => 'Program ini terbuka untuk produk makanan, minuman, katering, logistik, jasa penyimpanan, bahan kosmetik, industri frozen, bakery, dan banyak jenis industri lainnya. Untuk produk spesifik, silakan hubungi tim kami untuk konsultasi lebih lanjut.'],
                ['q' => 'Apakah usaha saya harus sudah berjalan lama?',
                 'a' => 'Tidak ada batasan lama usaha. Bahkan usaha baru yang baru memulai produksi pun bisa mendaftar, selama memiliki NIB aktif (atau mau dibantu membuat NIB) dan proses produksi yang sudah berjalan.'],
                ['q' => 'Bagaimana cara menghubungi SYNTARA untuk mendaftar?',
                 'a' => 'Anda bisa menghubungi kami melalui WhatsApp di 08113182829, email halal.mandatory@gmail.com, atau mengunjungi kantor kami di Demak Selatan V/22 Surabaya.'],
            ];
            @endphp

            @foreach ($faqs as $i => $faq)
            <div class="step-card" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="flex w-full items-center justify-between gap-4 text-left"
                >
                    <span class="text-sm font-semibold text-gray-900">{{ $faq['q'] }}</span>
                    <div class="shrink-0 flex h-7 w-7 items-center justify-center rounded-full bg-primary/10 transition-transform duration-300" :class="open ? 'rotate-45' : ''">
                        <svg class="h-3.5 w-3.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="mt-3 border-t border-gray-100 pt-3">
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- CTA Section --}}
<section id="daftar" class="bg-gradient-to-br from-primary-dark via-primary to-primary-light py-16 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold text-white mb-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pendampingan Aktif Hubungi Kami Sekarang
        </div>
        <h2 class="font-serif text-3xl font-bold sm:text-4xl">Siap Mendapatkan Sertifikat Halal?</h2>
        <p class="mt-4 text-lg text-white/85 max-w-xl mx-auto">
            Daftarkan produk Anda sekarang dan dapatkan pendampingan penuh dari tim konsultan halal SYNTARA 100% gratis untuk pelaku UMK.
        </p>

        {{-- Contact Info --}}
        <div class="mt-6 flex flex-wrap justify-center gap-4 text-sm text-white/80">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                08113182829
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                halal.mandatory@gmail.com
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Demak Selatan V/22 Surabaya
            </span>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/6208113182829"
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-8 py-3.5 text-sm font-semibold text-primary hover:bg-gray-50 transition-colors duration-200 shadow-lg shadow-black/10">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Daftar via WhatsApp
            </a>
            <a href="{{ route('halal-center.berbayar') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-white/40 bg-white/10 px-8 py-3.5 text-sm font-semibold text-white hover:bg-white/20 transition-colors duration-200 backdrop-blur-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Paket Berbayar
            </a>
        </div>

        <p class="mt-6 text-xs text-white/50">
            Atau kunjungi website kami di <a href="https://ikutiaja.link/syntara" target="_blank" class="underline hover:text-white/80">ikutiaja.link/syntara</a>
        </p>
    </div>
</section>

@endsection