@extends('layouts.app')

@section('content')

{{-- ===================== STYLES ===================== --}}
<style>
    /* ── Base Cards ── */
    .premium-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1.25rem;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.25s ease;
    }
    .premium-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 40px rgba(0,0,0,0.09);
    }
    .premium-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #1D9E75, #0d6e52);
        transform: scaleX(0);
        transform-origin: left center;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2);
    }
    .premium-card:hover::before { transform: scaleX(1); }

    /* ── Pricing Cards ── */
    .pricing-card {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 1.5rem;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.25s ease;
        display: flex;
        flex-direction: column;
    }
    .pricing-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.10);
    }
    .pricing-card.popular {
        border-color: #1D9E75;
        box-shadow: 0 8px 32px rgba(29,158,117,0.15);
    }
    .pricing-card.popular:hover {
        box-shadow: 0 20px 56px rgba(29,158,117,0.22);
    }

    /* ── Feature list check ── */
    .feat-yes::before {
        content: '';
        display: inline-block;
        width: 1.1rem; height: 1.1rem;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%231D9E75'%3E%3Cpath fill-rule='evenodd' d='M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.172l7.879-7.879a1 1 0 011.414 0z' clip-rule='evenodd'/%3E%3C/svg%3E") center/contain no-repeat;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .feat-no::before {
        content: '';
        display: inline-block;
        width: 1.1rem; height: 1.1rem;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23d1d5db'%3E%3Cpath fill-rule='evenodd' d='M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E") center/contain no-repeat;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ── Comparison table ── */
    .compare-row:nth-child(even) { background: #f9fafb; }
    .compare-row:hover { background: #f0fdf4; }

    /* ── Syarat item ── */
    .syarat-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s;
    }
    .syarat-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 16px rgba(29,158,117,0.08);
        border-color: #d1fae5;
    }

    /* ── Step card ── */
    .step-card {
        background: #ffffff;
        border: 1px solid #f3f4f6;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2), box-shadow 0.3s, border-color 0.25s;
    }
    .step-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(29,158,117,0.1);
        border-color: #d1fae5;
    }

    /* ── Gold / premium badge ── */
    .badge-gold {
        background: linear-gradient(135deg,#b7791f,#d4a017,#b7791f);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }
    .badge-popular {
        background: linear-gradient(135deg,#1D9E75,#0d6e52);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }  /* ← tutup badge-popular di sini */

    /* Tambahkan portfolio-tag di luar, sebagai class baru */
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
        /* ============ MOBILE RESPONSIVE ============ */
@media (max-width: 640px) {

/* ── Hero ── */
section h1 { font-size: 1.75rem !important; }
section p.text-lg { font-size: 0.95rem !important; }

/* ── Tabel perbandingan — jadikan card stack ── */
.overflow-x-auto table { min-width: unset; }
.overflow-x-auto table thead { display: none; }
.overflow-x-auto table tbody tr {
    display: flex;
    flex-direction: column;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    margin: 0 0 0.75rem 0;
    padding: 0.75rem 1rem;
    background: #fff;
}
.overflow-x-auto table tbody td {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.4rem 0;
    border: none;
    font-size: 0.8rem;
    border-bottom: 1px solid #f3f4f6;
}
.overflow-x-auto table tbody td:last-child { border-bottom: none; }
.overflow-x-auto table tbody td:first-child {
    font-weight: 600;
    color: #111827;
    font-size: 0.8rem;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 0.5rem;
    margin-bottom: 0.25rem;
}
/* Label kolom otomatis */
.overflow-x-auto table tbody td:nth-child(2)::before { content: 'Gratis: '; font-size: 0.7rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-right: 0.5rem; }
.overflow-x-auto table tbody td:nth-child(3)::before { content: 'Berbayar: '; font-size: 0.7rem; font-weight: 700; color: #1D9E75; text-transform: uppercase; letter-spacing: 0.05em; margin-right: 0.5rem; }

/* ── Pricing cards ── */
.pricing-card { padding: 1.5rem 1.25rem; }
.pricing-card .text-3xl { font-size: 1.5rem; }

/* ── Premium cards (layanan) ── */
.premium-card { padding: 1.25rem; }

/* ── Step card ── */
.step-card { padding: 1rem 1rem; }
.step-card .flex.items-start { gap: 0.75rem; }

/* ── Syarat item ── */
.syarat-item { padding: 0.75rem; }

/* ── Section padding ── */
section { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
.py-16 { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
.py-14 { padding-top: 2rem !important; padding-bottom: 2rem !important; }

/* ── Heading sizes ── */
.font-serif.text-3xl { font-size: 1.5rem !important; }
.font-serif.text-4xl { font-size: 1.75rem !important; }

/* ── CTA buttons ── */
#daftar .flex.gap-4 { flex-direction: column; }
#daftar a { width: 100%; }

/* ── Contact info wrap ── */
#daftar .flex.flex-wrap { flex-direction: column; align-items: center; gap: 0.5rem; }

/* ── Overflow tabel horizontal fallback ── */
.overflow-x-auto { overflow-x: unset; border-radius: 0.75rem; }
}
    }
</style>
{{-- ===================== END STYLES ===================== --}}


{{-- Hero Section --}}
<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
            
            <!-- TEXT -->
            <div class="max-w-2xl">
                <h1 class="font-serif text-4xl font-bold sm:text-5xl">
                    HALAL CENTER
                </h1>

                <p class="mt-4 text-lg text-white/90">
                Pendampingan sertifikasi halal reguler untuk UMKM, Koperasi, dan Komunitas Bisnis oleh tim konsultan bersertifikat SYNTARA, tanpa biaya konsultasi, tanpa syarat tersembunyi.                </p>
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


{{-- Tentang Program --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Heading tengah --}}
        <div class="text-center mb-10">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Tentang Program</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">HALAL CENTER</h2><br>
        </div>

        {{-- Konten --}}
        <div class="max-w-3xl mx-auto">
            <p class="text-gray-500 leading-relaxed mb-6">
                Didukung oleh tim <strong class="text-gray-700">Penyelia Halal bersertifikat </strong>, auditor berpengalaman, dan bekerja sama langsung dengan BPJPH & LPH terakreditasi, kami mendampingi seluruh proses mulai dari persiapan dokumen NIB hingga penerbitan sertifikat halal resmi.
            </p>
            <ul class="space-y-4">
                @foreach ([
                    ['title' => 'Tim Bersertifikat BNSP',        'desc' => 'Didampingi Penyelia Halal & Juru Sembelih Halal bersertifikasi resmi yang telah berpengalaman.'],
                    ['title' => 'Diakui Secara Resmi BPJPH',    'desc' => 'Sertifikat halal yang diterbitkan diakui oleh BPJPH dan Majelis Ulama Indonesia (MUI).'],
                ] as $f)
                <li class="flex items-start gap-3">
                    <div class="shrink-0 mt-1 h-5 w-5 rounded-full bg-primary/10 flex items-center justify-center">
                        <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $f['title'] }}</p>
                        <p class="text-sm text-gray-500">{{ $f['desc'] }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>


{{-- ── BEDANYA GRATIS & BERBAYAR  --}}
<section class="bg-white py-14">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <br><p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Perbandingan</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900">Gratis Dan Berbayar Apa Bedanya?</h2>
            <p class="mt-3 text-gray-500 max-w-lg mx-auto text-sm">Pilih layanan yang sesuai dengan skala, kompleksitas, dan kebutuhan bisnis Anda.</p><br>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-sm">
            <table class="w-full text-sm min-w-[640px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide w-2/5">Fitur</th>
                        <th class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-700">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Halal GRATIS
                            </span>
                        </th>
                        <th class="px-6 py-4 text-center bg-primary/5 border-l border-r border-primary/20">
                            <span class="inline-flex items-center gap-1.5 text-sm font-bold text-primary">
                                <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Halal BERBAYAR
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $rows = [
                        ['Sasaran Usaha',              'UMK (Mikro & Kecil)',         'Non-UMK, Menengah, Besar, Ekspor'],
                        ['Biaya Konsultasi',            'Gratis',                      'Berbayar (sesuai paket)'],
                        ['Dedicated Consultant',        false,                          true],
                        ['Prioritas Antrian Proses',    false,                          true],
                        ['Multi-Produk dalam 1 Sesi',   'Terbatas',                    'Tidak terbatas'],
                        ['Sertifikasi Ekspor / Global', false,                          true],
                        ['Pelatihan Penyelia Internal', 'Dasar',                        'Intensif + Sertifikat'],
                        ['Pendampingan SOP & IK',       'Standar',                      'Custom + Review Berkala'],
                        ['Garansi Revisi Dokumen',      'Terbatas 1x',                 'Tidak Terbatas'],
                        ['Pendampingan Pasca-Sertifikat',false,                         true],
                        ['Perpanjangan & Pembaruan',    false,                          true],
                        ['Konsultasi Regulasi Lanjutan','Tidak termasuk',              'Termasuk (NIB, BPOM, SNI)'],
                        ['SLA Waktu Respons',           'Normal',                       '< 24 Jam Kerja'],
                    ];
                    @endphp
                    @foreach ($rows as $row)
                    <tr class="compare-row border-b border-gray-100 last:border-0">
                        <td class="px-6 py-3.5 text-gray-700 font-medium">{{ $row[0] }}</td>
                        <td class="px-6 py-3.5 text-center text-gray-500">
                            @if ($row[1] === false)
                                <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-gray-100">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </span>
                            @elseif ($row[1] === true)
                                <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-primary/10">
                                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </span>
                            @else
                                <span class="text-xs text-gray-500">{{ $row[1] }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 text-center bg-primary/5 border-l border-r border-primary/10">
                            @if ($row[2] === false)
                                <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-gray-100">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </span>
                            @elseif ($row[2] === true)
                                <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-primary/20">
                                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </span>
                            @else
                                <span class="text-xs font-semibold text-primary">{{ $row[2] }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


{{-- ── PAKET HARGA ── --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Pilihan Paket</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Paket Konsultasi Halal</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Pilih paket yang paling sesuai dengan kebutuhan dan skala bisnis Anda. Semua paket mencakup Penyelia Halal bersertifikat BNSP dari SYNTARA.</p><br>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ── Paket Reguler ── --}}
            <div class="pricing-card">
                <div class="mb-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Paket Reguler</p>
                    <h3 class="text-2xl font-bold text-gray-900">Non-UMK</h3>
                    <p class="text-sm text-gray-500 mt-1">Untuk usaha menengah yang baru memulai sertifikasi halal.</p>
                </div>
                <div class="mb-6">
                    <p class="text-3xl font-bold text-gray-900">Hubungi Kami</p>
                    <p class="text-xs text-gray-400 mt-1">Harga menyesuaikan jumlah produk & kompleksitas</p>
                </div>
                <ul class="space-y-3 mb-8 flex-1">
                    @foreach ([
                        [true,  'Pendampingan sertifikasi halal reguler'],
                        [true,  'Penyelia Halal bersertifikat BNSP'],
                        [true,  'Penyusunan dokumen SJPH / HAS 23000'],
                        [true,  'Audit proses produksi & fasilitas'],
                        [true,  'Koordinasi dengan BPJPH & LPH'],
                        [true,  'Garansi revisi dokumen 1x'],
                        [false, 'Dedicated consultant eksklusif'],
                        [false, 'Pelatihan intensif + sertifikat'],
                        [false, 'Pendampingan pasca-sertifikat'],
                    ] as [$ok, $text])
                    <li class="flex items-start gap-2.5 text-sm {{ $ok ? 'text-gray-700' : 'text-gray-400' }}">
                        <span class="{{ $ok ? 'feat-yes' : 'feat-no' }}"></span>
                        {{ $text }}
                    </li>
                    @endforeach
                </ul>
                <a href="https://wa.me/6208113182829?text=Halo%20SYNTARA%2C%20saya%20tertarik%20Paket%20Reguler%20Non-UMK"
                   target="_blank" rel="noopener noreferrer"
                   class="block w-full rounded-xl border-2 border-primary py-3 text-center text-sm font-semibold text-primary hover:bg-primary hover:text-white transition-colors duration-200">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- ── Paket Prioritas (Popular) ── --}}
            <div class="pricing-card popular relative">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                    <span class="badge-popular">⭐ Paling Diminati</span>
                </div>
                <div class="mb-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-primary mb-2">Paket Prioritas</p>
                    <h3 class="text-2xl font-bold text-gray-900">Multi-Produk</h3>
                    <p class="text-sm text-gray-500 mt-1">Untuk perusahaan dengan banyak produk atau multi-outlet yang membutuhkan proses lebih cepat.</p>
                </div>
                <div class="mb-6">
                    <p class="text-3xl font-bold text-gray-900">Hubungi Kami</p>
                    <p class="text-xs text-gray-400 mt-1">Harga menyesuaikan jumlah SKU & skala operasional</p>
                </div>
                <ul class="space-y-3 mb-8 flex-1">
                    @foreach ([
                        [true, 'Semua fitur Paket Reguler'],
                        [true, 'Dedicated consultant eksklusif'],
                        [true, 'Prioritas antrian proses BPJPH'],
                        [true, 'Multi-produk / multi-outlet dalam 1 paket'],
                        [true, 'Garansi revisi dokumen tidak terbatas'],
                        [true, 'SLA respons < 24 jam kerja'],
                        [true, 'Pelatihan penyelia halal intensif'],
                        [false, 'Pendampingan sertifikasi ekspor / global'],
                    ] as [$ok, $text])
                    <li class="flex items-start gap-2.5 text-sm {{ $ok ? 'text-gray-700' : 'text-gray-400' }}">
                        <span class="{{ $ok ? 'feat-yes' : 'feat-no' }}"></span>
                        {{ $text }}
                    </li>
                    @endforeach
                </ul>
                <a href="https://wa.me/6208113182829?text=Halo%20SYNTARA%2C%20saya%20tertarik%20Paket%20Prioritas%20Multi-Produk"
                   target="_blank" rel="noopener noreferrer"
                   class="block w-full rounded-xl bg-gradient-to-r from-primary to-primary-dark py-3 text-center text-sm font-semibold text-white hover:opacity-90 transition-opacity shadow-lg shadow-primary/25">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- ── Paket Enterprise ── --}}
            <div class="pricing-card" style="background: linear-gradient(160deg, #0f1f1a 0%, #1a3530 100%); border-color: #2d5c50; color: white;">
                <div class="mb-5">
                    <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#6ee7b7;">Paket Enterprise</p>
                    <h3 class="text-2xl font-bold text-white">Ekspor & Kawasan</h3>
                    <p class="text-sm mt-1" style="color:rgba(255,255,255,0.6);">Untuk korporasi, kawasan industri, dan kebutuhan sertifikasi ekspor ke pasar halal internasional.</p>
                </div>
                <div class="mb-6">
                    <p class="text-3xl font-bold text-white">Custom</p>
                    <p class="text-xs mt-1" style="color:rgba(255,255,255,0.4);">Harga dirancang sesuai kebutuhan spesifik</p>
                </div>
                <ul class="space-y-3 mb-8 flex-1">
                    @foreach ([
                        'Semua fitur Paket Prioritas',
                        'Sertifikasi halal untuk pasar ekspor / global',
                        'Optimasi Kawasan Halal (Halal Hub)',
                        'Penyediaan tenaga Penyelia Halal tersertifikasi untuk kawasan',
                        'Advokasi & penyusunan SJPH skala korporasi',
                        'Pendampingan regulasi penuh (NIB, BPOM, SNI, Halal)',
                        'Digitalisasi ekosistem halal internal',
                        'Kontrak pendampingan jangka panjang',
                    ] as $text)
                    <li class="flex items-start gap-2.5 text-sm" style="color:rgba(255,255,255,0.85);">
                        <span class="shrink-0 mt-0.5 h-4 w-4 rounded-full flex items-center justify-center" style="background:rgba(110,231,183,0.2);">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="#6ee7b7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        {{ $text }}
                    </li>
                    @endforeach
                </ul>
                <a href="https://wa.me/6208113182829?text=Halo%20SYNTARA%2C%20saya%20tertarik%20Paket%20Enterprise"
                   target="_blank" rel="noopener noreferrer"
                   class="block w-full rounded-xl py-3 text-center text-sm font-semibold transition-opacity hover:opacity-90"
                   style="background:linear-gradient(135deg,#1D9E75,#0d6e52); color:#fff; box-shadow: 0 4px 20px rgba(29,158,117,0.35);">
                    Diskusi Kebutuhan
                </a>
            </div>

        </div>

        <p class="mt-6 text-center text-xs text-gray-400">
            * Semua paket tidak termasuk biaya resmi BPJPH yang merupakan kewajiban negara. Biaya tersebut dibayarkan langsung ke BPJPH.
        </p>
    </div>
</section>


{{-- ── LAYANAN YANG DICAKUP ── --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Cakupan Layanan Premium</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Yang Kami Kerjakan untuk Anda</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Layanan end-to-end dari persiapan dokumen hingga pengembangan ekosistem halal bisnis Anda.</p><br>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                [
                    'badge' => null,
                    'title' => 'Pendampingan Sertifikasi Halal Reguler',
                    'desc'  => 'Panduan penuh proses pengajuan ke BPJPH untuk Non-UMK, koperasi, dan komunitas bisnis skala menengah hingga besar.',
                    'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                ],
                [
                    'badge' => 'Premium',
                    'title' => 'Dedicated Consultant & SLA',
                    'desc'  => 'Anda mendapatkan konsultan eksklusif yang menangani proyek Anda dengan jaminan respons di bawah 24 jam kerja.',
                    'icon'  => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                ],
                [
                    'badge' => null,
                    'title' => 'Penyusunan SJPH & Dokumen HAS 23000',
                    'desc'  => 'Penyusunan Sistem Jaminan Produk Halal (SJPH), SOP, dan IK yang disesuaikan khusus dengan alur produksi bisnis Anda.',
                    'icon'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                ],
                [
                    'badge' => 'Premium',
                    'title' => 'Pelatihan Intensif Penyelia Halal',
                    'desc'  => 'Pelatihan mendalam bagi tim internal Anda mencakup Penyelia Halal, Juru Sembelih Halal, dan Audit Halal dilengkapi sertifikat resmi BNSP.',
                    'icon'  => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                ],
                [
                    'badge' => 'Enterprise',
                    'title' => 'Optimasi Kawasan Halal',
                    'desc'  => 'Penyediaan tenaga Penyelia Halal tersertifikasi untuk kawasan industri, sentra produksi, dan Halal Hub mendukung ekosistem halal reguler.',
                    'icon'  => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                ],
                [
                    'badge' => 'Enterprise',
                    'title' => 'Sertifikasi Ekspor & Pasar Global',
                    'desc'  => 'Pendampingan sertifikasi untuk produk yang ditujukan ke pasar halal nasional maupun internasional, membuka akses ekspor yang lebih luas.',
                    'icon'  => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                ],
                [
                    'badge' => null,
                    'title' => 'Pendampingan Regulasi & Legalitas',
                    'desc'  => 'Bantuan pengurusan NIB, BPOM, SNI, dan legalitas lain yang dibutuhkan sebagai bagian dari ekosistem halal bisnis Anda.',
                    'icon'  => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                ],
                [
                    'badge' => 'Premium',
                    'title' => 'Pendampingan Pasca-Sertifikat',
                    'desc'  => 'Monitoring kepatuhan, perpanjangan sertifikat, dan review berkala SOP & IK untuk memastikan status halal Anda tetap valid dan terjaga.',
                    'icon'  => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                ],
                [
                    'badge' => 'Enterprise',
                    'title' => 'Digitalisasi Ekosistem Halal',
                    'desc'  => 'Solusi digital untuk pengelolaan ekosistem halal internal bisnis Anda mulai dari pencatatan bahan baku hingga monitoring kepatuhan secara real-time.',
                    'icon'  => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                ],
            ] as $layanan)
            <div class="premium-card">
                <div class="flex items-start justify-between mb-3">
                    <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 shrink-0">
                        <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $layanan['icon'] }}"/>
                        </svg>
                    </div>
                    @if ($layanan['badge'])
                        @if ($layanan['badge'] === 'Enterprise')
                        <span class="badge-gold">{{ $layanan['badge'] }}</span>
                        @else
                        <span class="badge-popular">{{ $layanan['badge'] }}</span>
                        @endif
                    @endif
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-1.5">{{ $layanan['title'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $layanan['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ── ALUR SERTIFIKASI ── --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Cara Kerja</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Alur Pendampingan Berbayar</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Delapan tahap resmi BPJPH dengan pendampingan eksklusif dari tim SYNTARA lebih cepat, lebih terprioritaskan.</p><br>
        </div>

        <div class="mx-auto max-w-3xl space-y-3">
            @php
            $alur = [
                ['step'=>'01','title'=>'Asesmen & Penawaran',    'durasi'=>'1–2 Hari',    'who'=>'Konsultan SYNTARA',              'desc'=>'Konsultan melakukan asesmen awal terhadap skala bisnis, jumlah produk, dan kompleksitas proses untuk menyusun penawaran yang sesuai.'],
                ['step'=>'02','title'=>'Penandatanganan MOU',    'durasi'=>'1 Hari',      'who'=>'Klien & SYNTARA',                'desc'=>'MOU (Memorandum of Understanding) ditandatangani sebagai dasar kerja sama resmi antara klien dan SYNTARA.'],
                ['step'=>'03','title'=>'Pendaftaran & Data Awal','durasi'=>'6 Hari',      'who'=>'Konsultan & Pelaku Usaha',       'desc'=>'Dedicated consultant mengumpulkan data awal dan memulai proses pendaftaran di sistem BPJPH.'],
                ['step'=>'04','title'=>'Pemberkasan SJPH',       'durasi'=>'8 Hari',      'who'=>'Konsultan',                     'desc'=>'Penyusunan dokumen SJPH lengkap dengan SOP dan IK yang disesuaikan khusus dengan alur produksi bisnis Anda.'],
                ['step'=>'05','title'=>'Upload & Cek Revisi',    'durasi'=>'5 Hari',      'who'=>'Konsultan & Penyelia Halal',    'desc'=>'Upload berkas ke sistem BPJPH, diikuti pengecekan dan penyelesaian revisi tanpa batas hingga disetujui.'],
                ['step'=>'06','title'=>'Persetujuan SJPH',       'durasi'=>'12 Hari',     'who'=>'BPJPH & LPH',                   'desc'=>'BPJPH dan LPH mitra melakukan review. Klien prioritas mendapat antrian lebih cepat dibanding jalur reguler.'],
                ['step'=>'07','title'=>'Audit LPH',              'durasi'=>'10+1 Hari',   'who'=>'LPH, Penyelia, Klien',          'desc'=>'Audit lapangan oleh LPH didampingi penuh oleh dedicated consultant dan Penyelia Halal SYNTARA.'],
                ['step'=>'08','title'=>'Sidang Fatwa & Terbit',  'durasi'=>'10–21 Hari',  'who'=>'MUI → Konsultan → Klien',       'desc'=>'Sidang Fatwa MUI dan penerbitan sertifikat. Setelah terbit, konsultan menyerahkan dan menjelaskan langkah pasca-sertifikat.'],
            ];
            @endphp
            @foreach ($alur as $item)
            <div class="step-card flex items-start gap-4">
                <div class="shrink-0 flex flex-col items-center gap-1">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold shadow-md shadow-primary/25">{{ $item['step'] }}</div>
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

            <div class="mt-4 rounded-xl bg-yellow-50 border border-yellow-200 px-5 py-4 flex items-center gap-3">
                <svg class="h-5 w-5 text-yellow-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <p class="text-sm text-yellow-800 font-medium">Klien berbayar mendapatkan <strong>prioritas antrian</strong> dan <strong>garansi revisi tidak terbatas</strong>  proses lebih cepat dari jalur reguler.</p>
            </div>
        </div>
    </div>
</section>


{{-- ── SYARAT & DOKUMEN ── --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Persyaratan</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Dokumen yang Disiapkan</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Dokumen yang sama dengan jalur gratis namun untuk paket berbayar, tim SYNTARA membantu menyiapkan dan mengisi sebagian besar dokumen ini.</p><br>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['no'=>'01','title'=>'NIB Aktif',                  'desc'=>'Nomor Induk Berusaha aktif dari OSS. Tim kami dapat membantu pendaftaran jika belum memiliki.'],
                ['no'=>'02','title'=>'KTP Pemilik Usaha',          'desc'=>'KTP pemilik dan penanggungjawab halal yang akan tercantum dalam dokumen SJPH.'],
                ['no'=>'03','title'=>'Data Produk & Foto',         'desc'=>'Daftar produk jadi lengkap dengan nama yang jelas dan foto produk dari 2 posisi berbeda.'],
                ['no'=>'04','title'=>'Daftar Bahan Baku',          'desc'=>'Daftar bahan baku dan bahan pendukung, lengkap dengan nama distributor/supplier masing-masing.'],
                ['no'=>'05','title'=>'Alamat Lengkap',             'desc'=>'Alamat usaha, alamat fasilitas produksi, dan alamat outlet (jika ada lebih dari satu).'],
                ['no'=>'06','title'=>'Stempel & Kop Surat',        'desc'=>'Stempel usaha dan kop surat resmi perusahaan diperlukan untuk penandatanganan dokumen.'],
            ] as $s)
            <div class="syarat-item">
                <div class="shrink-0 flex h-9 w-9 items-center justify-center rounded-lg bg-primary/10">
                    <span class="text-xs font-bold text-primary">{{ $s['no'] }}</span>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $s['title'] }}</p>
                    <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6 rounded-xl bg-primary/5 border border-primary/20 px-5 py-4 flex items-start gap-3 max-w-3xl mx-auto">
            <svg class="h-5 w-5 text-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-primary">
                <strong>Keuntungan paket berbayar:</strong> Template berkas (SJPH, SOP, IK, diagram alir produksi, dll.) <strong>disiapkan dan diisi oleh tim konsultan</strong> Anda hanya perlu menyediakan data dasar dan memberikan persetujuan.
            </p>
        </div>
    </div>
</section>

{{-- ── PORTOFOLIO PENDAMPINGAN ── --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Pengalaman Kami</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">Portofolio Pendampingan</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">SYNTARA telah mendampingi berbagai jenis industri dalam proses sertifikasi halal, dari skala UMK hingga perusahaan besar.</p><br>
        </div>

        {{-- Industri Tags --}}
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            @foreach ([
                'Katering', 'Restoran', 'Daging Impor', 'Logistik',
                'Barang Gunaan Rumah Tangga','Peralatan Rumah Tangga',
                'Makanan Kaleng Impor', 'Industri Bakery','Jasa Penyimpanan', 'Bahan Kosmetik',
                'Industri Pembuatan Selai, Saos, Kopi', 'Industri Frozen',
            ] as $industri)
            <span class="portfolio-tag">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $industri }}
            </span>
            @endforeach
        </div>

        {{-- Klien --}}
        <div class="rounded-2xl bg-gray-50 border border-gray-100 shadow-sm p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4 text-center">Sebagian Klien yang Telah Kami Dampingi</p>
            <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 text-sm text-gray-600 font-medium">
                @foreach ([
                    'PT Multichemindo Abadi Sejahtera', 'Sumber Barokah Kerupuk SB', 'CV Bersama Manfaat',
                    'Dapoer MAMA', 'ISOTOK', 'Saos RYAN JAYA', 'NIK\'S MEALS', 'BEEFLAND IDN',
                    'FM Fresh Food', 'DAPOER NOEKI', 'Mei Kui Hwa', 'Kampoeng Semanggi Kendung Sby',
                    'Nita Manisan', 'Alsa Food', 'Fafiyo Makmur Sejahtera', 'Surya Bakery',
                    'Katering RATNA', 'Hj. Azizah', 'Kopi Liberika', 'Rengginang Hotimah',
                    'Petis Ikan Cakalan Barokah', 'PT. PANGAN MITRA BERKAH', 'Katering Bu WID',
                    'FM Roast Chicken', 'Nanjing County Xingguang Canned Food Co.Ltd',
                    'Zhangzhou Tan Co.Ltd Fujian China', 'PT. SUN POWER CERAMICS',
                ] as $klien)
                <span class="border-r border-gray-200 pr-4 last:border-0 last:pr-0 py-0.5">{{ $klien }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ── FAQ ── --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Pertanyaan Umum</p>
            <h2 class="font-serif text-3xl font-bold text-gray-900 sm:text-4xl">FAQ</h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto">Pertanyaan yang sering diajukan seputar layanan konsultasi halal berbayar SYNTARA.</p><br>
        </div>

        <div class="mx-auto max-w-3xl space-y-3" >
            @php
            $faqs = [
                ['q' => 'Apa yang membedakan paket berbayar dari yang gratis?',
                 'a' => 'Paket berbayar ditujukan untuk Non-UMK, usaha menengah-besar, dan kebutuhan kompleks. Perbedaan utamanya adalah: dedicated consultant eksklusif, prioritas antrian BPJPH, garansi revisi tidak terbatas, template dokumen diisi oleh konsultan, dan tersedianya layanan pasca-sertifikat.'],
                ['q' => 'Berapa estimasi biaya paket berbayar?',
                 'a' => 'Biaya bervariasi tergantung jumlah produk (SKU), kompleksitas proses produksi, dan jenis paket yang dipilih. Hubungi tim kami via WhatsApp atau email untuk mendapatkan penawaran yang sesuai dengan kebutuhan bisnis Anda.'],
                ['q' => 'Apakah ada MOU atau kontrak resmi?',
                 'a' => 'Ya. Setiap klien berbayar akan menandatangani MOU (Memorandum of Understanding) sebagai dasar kerja sama resmi yang melindungi hak dan kewajiban kedua belah pihak.'],
                ['q' => 'Apakah biaya BPJPH termasuk dalam paket?',
                 'a' => 'Tidak. Biaya resmi ke BPJPH merupakan kewajiban negara yang dibayarkan langsung oleh pelaku usaha ke BPJPH, terpisah dari biaya jasa konsultasi SYNTARA.'],
                ['q' => 'Berapa lama prosesnya untuk paket berbayar?',
                 'a' => 'Estimasi total proses adalah 40–55 hari kerja. Klien berbayar mendapat prioritas antrian sehingga lebih cepat dibandingkan jalur reguler yang bisa mencapai 62 hari kerja.'],
                ['q' => 'Apakah tersedia layanan untuk kawasan industri atau sentra produksi?',
                 'a' => 'Ya. Paket Enterprise SYNTARA mencakup optimasi Kawasan Halal, penyediaan Penyelia Halal tersertifikasi untuk kawasan, dan program Halal Hub bagi sentra produksi dan pasar.'],
                ['q' => 'Bagaimana cara memulai?',
                 'a' => 'Hubungi tim SYNTARA via WhatsApp di 08113182829 atau email halal.mandatory@gmail.com. Tim kami akan melakukan asesmen awal secara gratis sebelum memberikan penawaran resmi.'],
            ];
            @endphp

            @foreach ($faqs as $faq)
            <div class="step-card" x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full items-center justify-between gap-4 text-left">
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
            <a href="{{ route('halal-center.gratis') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-white/40 bg-white/10 px-8 py-3.5 text-sm font-semibold text-white hover:bg-white/20 transition-colors duration-200 backdrop-blur-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Paket Gratis
            </a>
        </div>

        <p class="mt-6 text-xs text-white/50">
            Atau kunjungi website kami di <a href="https://ikutiaja.link/syntara" target="_blank" class="underline hover:text-white/80">ikutiaja.link/syntara</a>
        </p>
    </div>
</section>
@endsection