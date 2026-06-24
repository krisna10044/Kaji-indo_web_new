{{-- resources/views/pages/pelatihan-program-detail.blade.php --}}
@extends('layouts.app')

@php
    $isDB = is_object($program);

    $judul         = $isDB ? $program->judul                                          : $program['judul'];
    $deskripsi     = $isDB ? $program->deskripsi                                      : $program['deskripsi'];
    $metode        = $isDB ? ucfirst($program->metode ?? '-')                         : ($program['metode'] ?? '-');
    $tingkat       = $isDB ? ucfirst($program->tingkat ?? '-')                        : ($program['tingkat'] ?? '-');
    $bahasa        = $isDB ? ($program->bahasa ?? 'Bahasa Indonesia')                 : ($program['bahasa'] ?? 'Bahasa Indonesia');
    $target        = $isDB ? ($program->target ?? '-')                                : ($program['kuota'] ?? '-');
    $tanggal       = $isDB ? optional($program->tanggal)->format('d M Y')             : null;
    $gambar        = $isDB ? $program->gambar                                         : null;
    $ikon          = $isDB ? null                                                     : ($program['ikon'] ?? '🎓');
    $warna         = $isDB ? null                                                     : ($program['warna'] ?? '#e5f5ed');

    // DB-specific
    $jumlahModul      = $isDB ? $program->moduls->count()                                : ($program['total_modul'] ?? 0);
    $totalJam = $isDB ? ($program->total_jam ? ((int)$program->total_jam) . ' Jam' : '-') : ($program['durasi'] ?? '-');
    $jumlahSesi       = $isDB ? ($program->jumlah_sesi ? $program->jumlah_sesi . ' Sesi': null) : null;
    $punya_sertifikat = $isDB ? (bool)$program->sertifikat                               : true;
    $modulsDB         = $isDB ? $program->moduls                                         : collect();
    $modulStatis      = $isDB ? [] : ($program['modul'] ?? []);
    $benefit          = $isDB ? [] : ($program['benefit'] ?? []);

    // Trainer info
    $trainerNama  = $isDB ? ($program->trainer->name ?? null) : null;
$trainerGelar = $isDB
    ? (\App\Models\Trainer::where('user_id', $program->trainer_id)->value('academic_degree')
       ?? $trainerNama)
    : null;

    $deskripsiPanjang = $isDB ? $program->deskripsi_panjang  : null;
    $kontenKurikulum  = $isDB ? $program->konten_kurikulum   : null;
    $kontenMateri     = $isDB ? $program->konten_materi      : null;

    $noWa = $isDB && !empty($program->phone)
        ? $program->phone
        : ($isDB && !empty($program->trainer->phone)
            ? $program->trainer->phone
            : '6281234567890');

    // Absensi
    $absAktif   = $isDB && !empty($program->absensi_mulai) && !empty($program->absensi_selesai);
    if ($absAktif) {
        $absMulai   = \Carbon\Carbon::parse($program->absensi_mulai);
        $absSelesai = \Carbon\Carbon::parse($program->absensi_selesai);
        $absNow     = \Carbon\Carbon::now();

        if ($absNow->lt($absMulai))                        $absStatus = 'upcoming';
        elseif ($absNow->between($absMulai, $absSelesai))  $absStatus = 'active';
        else                                                $absStatus = 'ended';

        $absUrl = !empty($program->absensi_url) ? $program->absensi_url : '#';
    }

    $sudahDiterima = auth()->check() && $isDB
    ? \App\Models\PendaftaranProgram::where('user_id', auth()->id())
        ->where('program_id', $program->id)
        ->where('status', 'diterima')
        ->exists()
    : false;

    $progressModulIds = $sudahDiterima
        ? \App\Models\ModulProgress::where('user_id', auth()->id())
            ->where('program_id', $program->id)
            ->pluck('modul_id')
            ->toArray()
        : [];
    $totalModulCount   = $isDB ? $modulsDB->count() : 0;
    $selesaiModulCount = count($progressModulIds);
    $semuaModulSelesai = $totalModulCount > 0 && $selesaiModulCount >= $totalModulCount;
@endphp

@section('title', $judul . ' - KAJI INDONESIA')

@section('content')

    {{-- Header --}}
    <section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-10 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}" class="text-white/80 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="font-serif text-2xl font-bold">Program Pelatihan</h1>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-12 px-4 min-h-screen">
        <div class="max-w-4xl mx-auto space-y-6">

            {{-- ── Hero Card ── --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200 grid grid-cols-1 sm:grid-cols-2">

                {{-- Gambar / Ikon --}}
                @if($isDB && $gambar)
                    <div class="h-56 sm:h-auto overflow-hidden">
                        <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $judul }}" class="w-full h-full object-cover">
                    </div>
                @elseif($isDB)
                    <div class="h-56 sm:h-auto flex items-center justify-center bg-green-50 text-7xl">🎓</div>
                @else
                    <div class="h-56 sm:h-auto flex items-center justify-center text-7xl" style="background: {{ $warna }};">
                        {{ $ikon }}
                    </div>
                @endif

                {{-- Info --}}
                <div class="p-6 flex flex-col justify-center gap-3">
                    <span class="inline-block bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wide px-3 py-1 rounded-full w-fit">
                        {{ $isDB ? ucfirst($program->tipe ?? 'Kurikulum') : 'Kurikulum Pelatihan' }}
                    </span>

                    <h2 class="font-serif font-bold text-gray-900 text-xl leading-snug">{{ $judul }}</h2>

                    @if($trainerGelar)
                    <p class="text-xs text-gray-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        oleh {{ $trainerGelar }}
                    </p>
                    @endif

                    <p class="text-sm text-gray-600 leading-relaxed">{{ $deskripsi }}</p>

                    <div class="flex flex-wrap gap-3 mt-1">
                    @if($isDB)
@php
    $pendaftaranSaya = auth()->check()
        ? \App\Models\PendaftaranProgram::where('user_id', auth()->id())
            ->where('program_id', $program->id)
            ->whereIn('status', ['pending', 'menunggu_verifikasi', 'diterima'])
            ->latest()
            ->first()
        : null;
@endphp

@if($isDB)
@php
    $pendaftaranSaya = auth()->check()
        ? \App\Models\PendaftaranProgram::where('user_id', auth()->id())
            ->where('program_id', $program->id)
            ->latest()
            ->first()
        : null;
@endphp

@if($pendaftaranSaya && $pendaftaranSaya->status !== 'ditolak')
    @if($pendaftaranSaya->status === 'diterima')
        <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 border border-green-300 text-sm font-bold px-5 py-2.5 rounded-lg">
            ✅ Sudah Terdaftar
        </span>
    @elseif($pendaftaranSaya->status === 'menunggu_verifikasi')
        <span class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 border border-amber-200 text-sm font-bold px-5 py-2.5 rounded-lg">
            ⏳ Menunggu Verifikasi Pembayaran
        </span>
    @elseif($pendaftaranSaya->status === 'pending')
        <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 border border-blue-200 text-sm font-bold px-5 py-2.5 rounded-lg">
            🕐 Menunggu Konfirmasi Admin
        </span>
    @endif
@elseif($pendaftaranSaya && $pendaftaranSaya->status === 'ditolak')
    <div class="w-full bg-red-50 border border-red-200 rounded-xl p-3 mb-2">
        <p class="text-sm font-bold text-red-700 mb-0.5">❌ Pendaftaran Anda ditolak</p>
        @if($pendaftaranSaya->alasan_penolakan)
            <p class="text-xs text-red-600 leading-relaxed">
                <span class="font-semibold">Alasan:</span> {{ $pendaftaranSaya->alasan_penolakan }}
            </p>
        @else
            <p class="text-xs text-red-500 italic">Tidak ada alasan yang diberikan.</p>
        @endif
        <p class="text-xs text-gray-500 mt-1.5">Anda dapat mendaftar kembali.</p>
    </div>
    <a href="{{ route('pelatihan.pendaftaran.create', $program->id) }}"
       class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">
        🔄 Daftar Ulang
    </a>
    @else
    @php
        $programBisaDaftar = true;
        $pesanTidakBisaDaftar = '';

        if ($isDB && !empty($program->program_mulai)) {
            $pMulai  = \Carbon\Carbon::parse($program->program_mulai, 'Asia/Jakarta');
            $pAkhir  = !empty($program->program_selesai)
                        ? \Carbon\Carbon::parse($program->program_selesai, 'Asia/Jakarta')
                        : null;
            $pNow    = \Carbon\Carbon::now('Asia/Jakarta');

            if ($pNow->lt($pMulai)) {
                $programBisaDaftar    = false;
                $pesanTidakBisaDaftar = 'Program belum dibuka · ' . $pMulai->translatedFormat('d M Y, H:i') . ' WIB';
            } elseif ($pAkhir && $pNow->gt($pAkhir)) {
                $programBisaDaftar    = false;
                $pesanTidakBisaDaftar = 'Program sudah selesai';
            }
        }
    @endphp

    @if($programBisaDaftar)
        <a href="{{ route('pelatihan.pendaftaran.create', $program->id) }}"
           class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">
            Daftar Program
        </a>
    @else
        <div>
            <button disabled
                    style="opacity:.45;cursor:not-allowed;pointer-events:none"
                    class="bg-gray-400 text-white text-sm font-bold px-5 py-2.5 rounded-lg">
                🔒 Daftar Program
            </button>
            <div style="margin-top:6px;font-size:11px;font-weight:600;color:#b45309;
                        display:flex;align-items:center;gap:5px">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ $pesanTidakBisaDaftar }}
            </div>
        </div>
    @endif
@endif

@else
{{-- program statis → WA --}}
<a href="https://wa.me/{{ $noWa }}?text=Halo,%20saya%20ingin%20mendaftar%20program%20{{ urlencode($judul) }}"
   target="_blank"
   class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">
    Daftar via WhatsApp
</a>
@endif
@else
{{-- program statis → WA --}}
<a href="https://wa.me/{{ $noWa }}?text=Halo,%20saya%20ingin%20mendaftar%20program%20{{ urlencode($judul) }}"
   target="_blank"
   class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">
    Daftar via WhatsApp
</a>
@endif
                        <a href="{{ route('pelatihan.program') }}"
                           class="border border-green-600 text-green-700 hover:bg-green-50 text-sm font-bold px-5 py-2.5 rounded-lg transition-colors">
                            ← Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Statistik ── --}}
            <div class="grid grid-cols-3 gap-4">

                {{-- Jumlah Modul --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 text-center">
                    <div class="flex justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>
                    <div class="font-bold text-green-900 text-sm">{{ $jumlahModul }} Modul</div>
                    <div class="text-xs text-gray-500 mt-1">Total Modul</div>
                </div>

                {{-- Durasi / Jam --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 text-center">
                    <div class="flex justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="font-bold text-green-900 text-sm">{{ $totalJam }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $jumlahSesi ?? 'Durasi Pelatihan' }}</div>
                </div>

                {{-- Sertifikat --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 text-center">
                    <div class="flex justify-center mb-2">
                        @if($punya_sertifikat)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                        @endif
                    </div>
                    <div class="font-bold text-sm {{ $punya_sertifikat ? 'text-green-900' : 'text-gray-400' }}">
                        {{ $punya_sertifikat ? 'Sertifikat' : 'Tanpa Sertifikat' }}
                    </div>
                    <div class="text-xs mt-1 {{ $punya_sertifikat ? 'text-gray-500' : 'text-gray-300' }}">
                        {{ $punya_sertifikat ? '✓ Tersedia' : '-' }}
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════ --}}
            {{-- ── Tombol Absensi Otomatis ──             --}}
            {{-- ══════════════════════════════════════════ --}}
            {{-- ══ STATUS PEMBUKAAN PROGRAM ══ --}}
@php
    $hasProgramStatus = $isDB && !empty($program->program_mulai);
    if ($hasProgramStatus) {
        $progMulai2   = \Carbon\Carbon::parse($program->program_mulai, 'Asia/Jakarta');
        $progSelesai2 = !empty($program->program_selesai)
            ? \Carbon\Carbon::parse($program->program_selesai, 'Asia/Jakarta')
            : null;
        $nowProg2 = \Carbon\Carbon::now('Asia/Jakarta');

        if ($nowProg2->lt($progMulai2))                                               $statusProg2 = 'belum';
        elseif (!$progSelesai2 || $nowProg2->lte($progSelesai2))                     $statusProg2 = 'aktif';
        else                                                                           $statusProg2 = 'selesai';
    }
@endphp

@if($hasProgramStatus)
@php
    $barBg     = $statusProg2 === 'belum'   ? '#fffbea' : ($statusProg2 === 'aktif' ? '#f0fdf4' : '#f8fafc');
    $barBorder = $statusProg2 === 'belum'   ? '#fcd34d' : ($statusProg2 === 'aktif' ? '#86efac' : '#cbd5e1');
    $barColor  = $statusProg2 === 'belum'   ? '#92400e' : ($statusProg2 === 'aktif' ? '#15803d' : '#475569');
    $barIcon   = $statusProg2 === 'belum'   ? '⏳'      : ($statusProg2 === 'aktif' ? '✅'      : '🔒');
    $barLabel  = $statusProg2 === 'belum'   ? 'Program Belum Dibuka'
               : ($statusProg2 === 'aktif'  ? 'Program Sedang Berlangsung'
               :                              'Program Telah Selesai');
@endphp
<div style="background:{{ $barBg }};border:1.5px solid {{ $barBorder }};border-radius:16px;
            padding:16px 20px;display:flex;align-items:center;justify-content:space-between;
            flex-wrap:wrap;gap:12px"
     id="prog-status-detail"
     data-mulai="{{ $progMulai2->timestamp }}"
     data-selesai="{{ $progSelesai2 ? $progSelesai2->timestamp : 0 }}"
     data-status="{{ $statusProg2 }}">

    <div style="display:flex;align-items:center;gap:12px">
        <div style="width:44px;height:44px;border-radius:12px;background:{{ $barBg }};
                    border:1.5px solid {{ $barBorder }};display:flex;align-items:center;
                    justify-content:center;font-size:22px;flex-shrink:0">
            {{ $barIcon }}
        </div>
        <div>
            <div style="font-size:14px;font-weight:800;color:{{ $barColor }};display:flex;align-items:center;gap:8px">
                {{ $barLabel }}
                @if($statusProg2 === 'aktif')
                <span style="width:8px;height:8px;border-radius:50%;background:#16a34a;
                             display:inline-block;animation:blink-green 1s infinite"></span>
                @endif
            </div>
            <div style="font-size:12px;color:{{ $barColor }};opacity:.75;margin-top:3px">
                @if($statusProg2 === 'belum')
                    Dibuka {{ $progMulai2->translatedFormat('d M Y, H:i') }} WIB
                    @if($progSelesai2) · Selesai {{ $progSelesai2->translatedFormat('d M Y, H:i') }} WIB @endif
                @elseif($statusProg2 === 'aktif')
                    Dimulai {{ $progMulai2->translatedFormat('d M Y, H:i') }} WIB
                    @if($progSelesai2) · Berakhir {{ $progSelesai2->translatedFormat('d M Y, H:i') }} WIB @endif
                @else
                    Berakhir {{ $progSelesai2->translatedFormat('d M Y, H:i') }} WIB
                @endif
            </div>
        </div>
    </div>

    @if($statusProg2 !== 'selesai')
    <div style="display:flex;align-items:center;gap:8px;flex-shrink:0">
        <span style="font-size:12px;font-weight:600;color:{{ $barColor }};opacity:.8">
            {{ $statusProg2 === 'belum' ? 'Dibuka dalam' : 'Berakhir dalam' }}
        </span>
        <span id="prog-countdown-detail"
              style="font-family:'Courier New',monospace;font-size:15px;font-weight:800;
                     letter-spacing:1.5px;color:{{ $barColor }};
                     background:{{ $statusProg2 === 'belum' ? '#fef3c7' : '#dcfce7' }};
                     padding:6px 14px;border-radius:8px;border:1.5px solid {{ $barBorder }}">
            --:--:--
        </span>
    </div>
    @endif

</div>
<style>
@keyframes blink-green { 0%,100%{opacity:1} 50%{opacity:.2} }
</style>
@endif
{{-- ══ END STATUS PROGRAM ══ --}}
            {{-- ── Absensi ── --}}
@include('partials.absensi-block', [
    'absAktif'   => $absAktif   ?? false,
    'absStatus'  => $absStatus  ?? null,
    'absMulai'   => $absMulai   ?? null,
    'absSelesai' => $absSelesai ?? null,
    'program'    => $program,
    'judul'      => $judul,
])
            {{-- ══ End Absensi ══ --}}

            {{-- ── Deskripsi Panjang (DB only) ── --}}
            @if($isDB && $deskripsiPanjang)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">Tentang Program</h2>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">{!! $deskripsiPanjang !!}</div>
            </div>
            @endif

            {{-- ── Konten Kurikulum (DB only) ── --}}
            @if($isDB && $kontenKurikulum)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">Kurikulum</h2>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">{!! $kontenKurikulum !!}</div>
            </div>
            @endif

            {{-- ── Konten Materi (DB only) ── --}}
            @if($isDB && $kontenMateri)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">Materi</h2>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">{!! $kontenMateri !!}</div>
            </div>
            @endif

            {{-- ── Modul dari DB ── --}}
            @if($isDB)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">
                    Modul Pembelajaran
                    <span class="text-sm font-normal text-gray-400 ml-2">({{ $modulsDB->count() }} modul)</span>
                </h2>
                @if($modulsDB->isEmpty())
                <p class="text-sm text-gray-400 italic">Belum ada modul yang ditambahkan.</p>
                @else
                <div class="flex flex-col gap-3">
                @foreach($modulsDB as $index => $modul)
@php
    $now        = \Carbon\Carbon::now('Asia/Jakarta');
    $belumBuka  = !empty($modul->akses_mulai)
                  && $now->lt(\Carbon\Carbon::parse($modul->akses_mulai, 'Asia/Jakarta'));
    $sudahTutup = !empty($modul->akses_selesai)
                  && $now->gt(\Carbon\Carbon::parse($modul->akses_selesai, 'Asia/Jakarta'));
@endphp

<div class="flex items-start gap-3 bg-gray-50 rounded-xl border border-gray-100 p-3">
    <div class="w-7 h-7 rounded-full bg-green-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">
        {{ $modul->urutan ?? ($index + 1) }}
    </div>
    <div class="w-full">
        <div class="font-bold text-green-900 text-sm mb-1">{{ $modul->judul }}</div>
        @if($modul->deskripsi)
            <div class="text-xs text-gray-500 leading-relaxed">{{ $modul->deskripsi }}</div>
        @endif

        {{-- ══ GATE: hanya peserta diterima yang lanjut ══ --}}
        @if(!$sudahDiterima)
            {{-- Belum terdaftar / belum diterima --}}
            <div style="margin-top:10px;background:#f0f9ff;border:1px solid #bae6fd;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:10px">
                <span style="font-size:18px">🔐</span>
                <div style="flex:1">
                    <div style="font-size:12px;font-weight:700;color:#0369a1">Materi Khusus Peserta Terdaftar</div>
                    <div style="font-size:11px;color:#0284c7;margin-top:2px">
                        @if(!auth()->check())
                            <a href="{{ route('login') }}" style="color:#0369a1;font-weight:700;text-decoration:underline">Login</a>
                            dan daftar program ini untuk mengakses materi.
                        @elseif($pendaftaranSaya && $pendaftaranSaya->status === 'menunggu_verifikasi')
                            Pembayaran Anda sedang diverifikasi. Materi akan terbuka setelah diterima.
                        @elseif($pendaftaranSaya && $pendaftaranSaya->status === 'pending')
                            Pendaftaran Anda sedang menunggu konfirmasi admin.
                        @elseif($pendaftaranSaya && $pendaftaranSaya->status === 'ditolak')
                            Pendaftaran Anda ditolak.
                            <a href="{{ route('pelatihan.pendaftaran.create', $program->id) }}" style="color:#0369a1;font-weight:700;text-decoration:underline">Daftar ulang</a>.
                        @else
                            <a href="{{ route('pelatihan.pendaftaran.create', $program->id) }}" style="color:#0369a1;font-weight:700;text-decoration:underline">Daftar program ini</a>
                            untuk mengakses materi modul.
                        @endif
                    </div>
                </div>
            </div>

        @elseif($sudahTutup)
            {{-- Sudah diterima tapi akses modul sudah berakhir --}}
            <div style="margin-top:10px;background:#f3f4f6;border:1px solid #d1d5db;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:10px">
                <span style="font-size:18px">🔒</span>
                <div>
                    <div style="font-size:12px;font-weight:700;color:#6b7280">Akses Modul Telah Berakhir</div>
                    <div style="font-size:11px;color:#9ca3af;margin-top:2px">
                        Ditutup sejak {{ \Carbon\Carbon::parse($modul->akses_selesai, 'Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB
                    </div>
                </div>
            </div>

        @elseif($belumBuka)
            {{-- Sudah diterima tapi modul belum waktunya --}}
            <div style="margin-top:10px;background:#fffbea;border:1px solid #fcd34d66;border-radius:10px;padding:10px 14px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap"
                 id="modul-bar-{{ $modul->id }}"
                 data-mulai="{{ \Carbon\Carbon::parse($modul->akses_mulai, 'Asia/Jakarta')->timestamp }}"
                 data-selesai="{{ !empty($modul->akses_selesai) ? \Carbon\Carbon::parse($modul->akses_selesai, 'Asia/Jakarta')->timestamp : 0 }}"
                 data-status="upcoming">
                <div style="display:flex;align-items:center;gap:10px">
                    <span style="font-size:18px">⏰</span>
                    <div>
                        <div style="font-size:12px;font-weight:700;color:#92400e">Modul Belum Dibuka</div>
                        <div style="font-size:11px;color:#b45309;margin-top:2px">
                            Dibuka pada {{ \Carbon\Carbon::parse($modul->akses_mulai, 'Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:6px;flex-shrink:0">
                    <span style="font-size:11px;color:#b45309;font-weight:600">Dibuka dalam</span>
                    <span id="timer-modul-{{ $modul->id }}"
                          style="font-family:'Courier New',monospace;font-size:13px;font-weight:800;
                                 letter-spacing:1px;color:#92400e;background:#fef3c7;
                                 padding:4px 10px;border-radius:6px;border:1px solid #fcd34d">
                        --:--:--
                    </span>
                </div>
            </div>

            @else
    {{-- Sudah diterima + modul aktif --}}
    @php $modulSelesai = in_array($modul->id, $progressModulIds); @endphp

    {{-- Countdown berakhir --}}
    @if(!empty($modul->akses_selesai))
    <div style="margin-top:10px;background:#e8f5e9;border:1px solid #a7d7c566;border-radius:10px;padding:10px 14px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap"
         id="modul-bar-{{ $modul->id }}"
         data-mulai="0"
         data-selesai="{{ \Carbon\Carbon::parse($modul->akses_selesai,'Asia/Jakarta')->timestamp }}"
         data-status="active">
        <div style="display:flex;align-items:center;gap:10px">
            <span style="font-size:18px">✅</span>
            <div>
                <div style="font-size:12px;font-weight:700;color:#2d6a4f">Modul Sedang Aktif</div>
                <div style="font-size:11px;color:#52b788;margin-top:2px">
                    Berakhir {{ \Carbon\Carbon::parse($modul->akses_selesai,'Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB
                </div>
            </div>
        </div>
        <span id="timer-modul-{{ $modul->id }}"
              style="font-family:'Courier New',monospace;font-size:13px;font-weight:800;
                     color:#2d6a4f;background:#d1fae5;padding:4px 10px;
                     border-radius:6px;border:1px solid #a7d7c5">--:--:--</span>
    </div>
    @endif

    {{-- Badge sudah selesai --}}
    @if($modulSelesai)
    <div style="margin-top:10px;display:inline-flex;align-items:center;gap:6px;
                background:#dcfce7;border:1px solid #86efac;border-radius:8px;
                padding:5px 12px;font-size:12px;font-weight:700;color:#15803d">
        ✅ Modul Selesai
    </div>
    @endif

    {{-- ── MATERI YOUTUBE ── --}}
    @if($modul->materi_type === 'youtube' && $modul->materi_youtube)
        @php
            preg_match('/(?:v=|youtu\.be\/|embed\/)([A-Za-z0-9_-]{11})/', $modul->materi_youtube, $ytMatch);
            $ytId = $ytMatch[1] ?? null;
        @endphp
        @if($ytId)
        <div style="margin-top:12px;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;position:relative"
             id="yt-wrap-{{ $modul->id }}">
            {{-- Overlay anti-skip --}}
            @if(!$modulSelesai)
            <div id="yt-overlay-{{ $modul->id }}"
                 style="display:none;position:absolute;inset:0;background:rgba(0,0,0,.6);
                        z-index:10;align-items:center;justify-content:center;
                        flex-direction:column;gap:8px;color:#fff;font-weight:700;font-size:13px;
                        border-radius:12px;text-align:center;padding:20px">
                ⏩ Tidak bisa fast-forward<br>
                <span style="font-size:11px;font-weight:400;opacity:.8">Tonton video dari awal sampai selesai</span>
            </div>
            @endif
            <div id="yt-player-{{ $modul->id }}"
                 data-video-id="{{ $ytId }}"
                 data-modul-id="{{ $modul->id }}"
                 data-program-id="{{ $program->id }}"
                 data-selesai="{{ $modulSelesai ? '1' : '0' }}"
                 data-csrf="{{ csrf_token() }}"
                 style="width:100%;aspect-ratio:16/9;background:#000">
            </div>
        </div>
        @if(!$modulSelesai)
        <div id="yt-progress-bar-{{ $modul->id }}"
             style="margin-top:6px;height:4px;background:#e5e7eb;border-radius:4px;overflow:hidden">
            <div id="yt-progress-fill-{{ $modul->id }}"
                 style="height:100%;width:0%;background:#2d6a4f;transition:width .5s"></div>
        </div>
        <div style="margin-top:4px;font-size:11px;color:#9ca3af;text-align:right"
             id="yt-progress-label-{{ $modul->id }}">0% ditonton</div>
        @endif
        @endif

    {{-- ── MATERI PDF ── --}}
    @elseif($modul->materi_type === 'pdf' && $modul->materi_pdf)
        <div style="margin-top:12px;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;position:relative">
            <iframe
                id="pdf-frame-{{ $modul->id }}"
                src="{{ asset('storage/' . $modul->materi_pdf) }}#toolbar=1&navpanes=0"
                width="100%" height="500"
                style="display:block;border:none">
            </iframe>
        </div>
        @if(!$modulSelesai)
        <div style="margin-top:8px;background:#fffbea;border:1px solid #fcd34d66;border-radius:8px;
                    padding:8px 12px;font-size:11px;color:#92400e;display:flex;align-items:center;gap:6px">
            📜 Scroll PDF sampai halaman terakhir untuk menyelesaikan modul
        </div>
        <div style="margin-top:6px;height:4px;background:#e5e7eb;border-radius:4px;overflow:hidden">
            <div id="pdf-progress-fill-{{ $modul->id }}"
                 style="height:100%;width:0%;background:#2d6a4f;transition:width .5s"></div>
        </div>
        <div style="margin-top:4px;font-size:11px;color:#9ca3af;text-align:right"
             id="pdf-progress-label-{{ $modul->id }}">0% di-scroll</div>
        @endif
        <div style="display:flex;gap:8px;align-items:center;margin-top:8px;flex-wrap:wrap">
            <a href="{{ asset('storage/' . $modul->materi_pdf) }}" target="_blank" download
               style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;
                      border-radius:8px;font-size:12px;font-weight:600;
                      background:#ecfdf5;color:#15803d;border:1px solid #a7d7c566;text-decoration:none">
                ⬇️ Unduh PDF
            </a>
            @if(!$modulSelesai)
            {{-- Tombol manual fallback jika iframe PDF tidak bisa di-track --}}
            <button onclick="markModulSelesaiManual({{ $modul->id }}, {{ $program->id }}, this)"
                    id="btn-pdf-selesai-{{ $modul->id }}"
                    style="display:none;padding:7px 14px;border-radius:8px;font-size:12px;
                           font-weight:700;background:#2d6a4f;color:#fff;border:none;cursor:pointer">
                ✅ Tandai Selesai
            </button>
            @endif
        </div>
        {{-- Hidden data untuk JS PDF tracker --}}
        @if(!$modulSelesai)
        <div id="pdf-tracker-{{ $modul->id }}"
             data-modul-id="{{ $modul->id }}"
             data-program-id="{{ $program->id }}"
             data-csrf="{{ csrf_token() }}"
             style="display:none"></div>
        @endif
    @endif

    @endif {{-- end gate --}}

</div>
</div>
@endforeach
</div>

{{-- ── Tombol Sertifikat ── --}}
@if($sudahDiterima)
<div id="sertifikat-section"
     style="margin-top:20px;padding:20px;background:{{ $semuaModulSelesai ? 'linear-gradient(135deg,#dcfce7,#bbf7d0)' : '#f9fafb' }};
            border:2px solid {{ $semuaModulSelesai ? '#86efac' : '#e5e7eb' }};
            border-radius:14px;text-align:center;transition:all .3s">
    @if($semuaModulSelesai)
        <div style="font-size:32px;margin-bottom:8px">🏆</div>
        <div style="font-size:16px;font-weight:700;color:#15803d;margin-bottom:4px">
            Selamat! Anda telah menyelesaikan semua modul
        </div>
        <div style="font-size:13px;color:#166534;margin-bottom:16px">
            Sertifikat kelulusan Anda sudah siap
        </div>
        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('pelatihan.sertifikat', $program->id) }}"
               style="padding:10px 24px;background:#15803d;color:#fff;border-radius:10px;
                      font-size:13px;font-weight:700;text-decoration:none">
                🎓 Lihat Sertifikat
            </a>
            <a href="{{ route('pelatihan.sertifikat.download', $program->id) }}"
               style="padding:10px 24px;background:#fff;color:#15803d;border:2px solid #86efac;
                      border-radius:10px;font-size:13px;font-weight:700;text-decoration:none">
                ⬇️ Download PDF
            </a>
        </div>
    @else
        <div style="font-size:24px;margin-bottom:8px">📋</div>
        <div style="font-size:14px;font-weight:600;color:#6b7280;margin-bottom:4px">
            Progress Anda
        </div>
        <div style="font-size:13px;color:#9ca3af;margin-bottom:12px">
            {{ $selesaiModulCount }} / {{ $totalModulCount }} modul selesai
        </div>
        <div style="height:8px;background:#e5e7eb;border-radius:8px;overflow:hidden;max-width:300px;margin:0 auto">
            <div style="height:100%;width:{{ $totalModulCount > 0 ? round($selesaiModulCount/$totalModulCount*100) : 0 }}%;
                        background:linear-gradient(90deg,#2d6a4f,#52b788);border-radius:8px;transition:width .5s"
                 id="overall-progress-bar"></div>
        </div>
        <div style="font-size:12px;color:#9ca3af;margin-top:6px">
            {{ $totalModulCount > 0 ? round($selesaiModulCount/$totalModulCount*100) : 0 }}% selesai
        </div>
        <div style="margin-top:12px;font-size:12px;color:#d1d5db">
            Sertifikat tersedia setelah semua modul selesai
        </div>
    @endif
</div>
@endif
                @endif
            </div>
            @endif

            {{-- ── Modul Statis ── --}}
            @if(!$isDB && !empty($modulStatis))
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">Modul Pembelajaran</h2>
                <div class="flex flex-col gap-3">
                    @foreach($modulStatis as $index => $modul)
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl border border-gray-100 p-3">
                        <div class="w-7 h-7 rounded-full bg-green-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <div class="font-bold text-green-900 text-sm mb-1">{{ $modul['judul'] }}</div>
                            <div class="text-xs text-gray-500 leading-relaxed">{{ $modul['isi'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── Benefit Statis ── --}}
            @if(!$isDB && !empty($benefit))
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">Yang Akan Anda Dapatkan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($benefit as $item)
                    <div class="flex items-start gap-2 text-sm text-gray-700 leading-relaxed">
                        <span class="text-green-500 font-bold mt-0.5">✔</span>
                        {{ $item }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── Informasi Pelatihan ── --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="font-serif font-bold text-gray-900 text-xl mb-4 pb-3 border-b border-gray-100">Informasi Pelatihan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                    $alamat = $isDB ? ($program->alamat ?? null) : null;

$infoRows = [
    ['Metode',         $metode],
    ['Tingkat',        $tingkat],
    ['Bahasa',         $bahasa],
    ['Target Peserta', $target],
    ['Penyelenggara',  $trainerGelar ?? 'KAJI INDONESIA'],
];
if ($isDB && $tanggal)    $infoRows[] = ['Tanggal', $tanggal];
if ($isDB && $jumlahSesi) $infoRows[] = ['Jumlah Sesi', $jumlahSesi];
if ($isDB && $alamat)     $infoRows[] = ['Alamat Lokasi', $alamat];
if (!$isDB)               $infoRows[] = ['Durasi', $totalJam];

if ($isDB && !empty($program->program_mulai)) {
    $progMulai   = \Carbon\Carbon::parse($program->program_mulai, 'Asia/Jakarta');
    $progSelesai = !empty($program->program_selesai)
        ? \Carbon\Carbon::parse($program->program_selesai, 'Asia/Jakarta')
        : null;
    $nowProg = \Carbon\Carbon::now('Asia/Jakarta');

    if ($nowProg->lt($progMulai)) {
        $statusProgram = '⏳ Belum Dibuka (mulai ' . $progMulai->translatedFormat('d M Y, H:i') . ' WIB)';
    } elseif (!$progSelesai || $nowProg->lte($progSelesai)) {
        $statusProgram = '✅ Sedang Berlangsung';
        if ($progSelesai) {
            $statusProgram .= ' (s/d ' . $progSelesai->translatedFormat('d M Y, H:i') . ' WIB)';
        }
    } else {
        $statusProgram = '🔒 Program Selesai (' . $progSelesai->translatedFormat('d M Y, H:i') . ' WIB)';
    }
    $infoRows[] = ['Status Program', $statusProgram];
}

$biayaProgram = $isDB ? ($program->biaya ?? null) : ($program['biaya'] ?? null);
if ($biayaProgram) $infoRows[] = ['Biaya', $biayaProgram];

                    @endphp
                    @foreach($infoRows as [$lbl, $val])
                    <div>
                        <div class="text-xs uppercase tracking-wide font-semibold text-gray-400 mb-1">{{ $lbl }}</div>
                        <div class="text-sm font-semibold text-green-900">{{ $val ?? '-' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
    <script>
(function() {
    var bar = document.getElementById('prog-status-detail');
    if (!bar) return;
    var el      = document.getElementById('prog-countdown-detail');
    var status  = bar.dataset.status;
    var tsMulai = parseInt(bar.dataset.mulai,   10) * 1000;
    var tsAkhir = parseInt(bar.dataset.selesai, 10) * 1000;
    if (!el || status === 'selesai') return;

    function padN(n) { return String(n).padStart(2,'0'); }
    function fmt(ms) {
        if (ms <= 0) return '00:00:00';
        var s = Math.floor(ms/1000);
        var h = Math.floor(s/3600), m = Math.floor((s%3600)/60), ss = s%60;
        return padN(h)+':'+padN(m)+':'+padN(ss);
    }

   var iv = setInterval(function() {
    var now = Date.now();
    var ms  = status === 'belum' ? (tsMulai - now) : (tsAkhir - now);
    if (ms <= 0) { clearInterval(iv); el.textContent = '00:00:00'; return; }
    el.textContent = fmt(ms);
        // Warna warning saat < 1 jam
        if (ms < 3600000 && status === 'aktif') {
            el.style.color       = '#b45309';
            el.style.background  = '#fef3c7';
            el.style.borderColor = '#fcd34d';
        }
    }, 1000);
})(); // ← TUTUP IIFE countdown program

/* ── Countdown timer modul ── */

/* ── Countdown timer modul ── */
function padNum(n) { return String(n).padStart(2, '0'); }
function formatSisa(ms) {
    if (ms <= 0) return '00:00:00';
    const s = Math.floor(ms/1000), h = Math.floor(s/3600), m = Math.floor((s%3600)/60), ss = s%60;
    return h > 0 ? padNum(h)+':'+padNum(m)+':'+padNum(ss) : padNum(m)+':'+padNum(ss);
}
document.querySelectorAll('[id^="modul-bar-"]').forEach(function(bar) {
    const id = bar.id.replace('modul-bar-','');
    const el = document.getElementById('timer-modul-'+id);
    const st = bar.dataset.status;
    const ts0 = parseInt(bar.dataset.mulai,10)*1000;
    const ts1 = parseInt(bar.dataset.selesai,10)*1000;
    if (!el) return;
    var iv = setInterval(function(){
    var now = Date.now();
    if (st==='upcoming') {
        var s = ts0-now; if(s<=0){clearInterval(iv);el.textContent='00:00:00';return;}
        el.textContent=formatSisa(s);
    } else {
        var s = ts1-now; if(s<=0){clearInterval(iv);el.textContent='00:00:00';return;}
        if(s<600000){el.style.color='#dc2626';el.style.background='#fee2e2';}
        el.textContent=formatSisa(s);
    }
}, 1000);
});

/* ── Mark modul selesai via AJAX ── */
function markModulSelesai(modulId, programId, csrf, callback) {
    fetch('/pelatihan/modul/' + modulId + '/selesai', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ program_id: programId })
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            // Update badge modul
            var existing = document.querySelector('#modul-selesai-badge-' + modulId);
            if (!existing) {
                var badge = document.createElement('div');
                badge.id = 'modul-selesai-badge-' + modulId;
                badge.style.cssText = 'margin-top:10px;display:inline-flex;align-items:center;gap:6px;background:#dcfce7;border:1px solid #86efac;border-radius:8px;padding:5px 12px;font-size:12px;font-weight:700;color:#15803d';
                badge.textContent = '✅ Modul Selesai';
                var wrap = document.getElementById('yt-wrap-' + modulId) || document.getElementById('pdf-tracker-' + modulId);
                if (wrap && wrap.parentNode) wrap.parentNode.insertBefore(badge, wrap.nextSibling);
            }
            if (callback) callback(res);
           if (res.semua_selesai) {
    var sertifBox = document.getElementById('sertifikat-section');
    if (sertifBox) {
        sertifBox.style.background = 'linear-gradient(135deg,#dcfce7,#bbf7d0)';
        sertifBox.style.border     = '2px solid #86efac';
        sertifBox.innerHTML =
            '<div style="font-size:32px;margin-bottom:8px">🏆</div>' +
            '<div style="font-size:16px;font-weight:700;color:#15803d;margin-bottom:4px">Selamat! Anda telah menyelesaikan semua modul</div>' +
            '<div style="font-size:13px;color:#166534;margin-bottom:16px">Sertifikat kelulusan Anda sudah siap</div>' +
            '<div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">' +
                '<a href="/pelatihan/sertifikat/' + res.program_id + '" style="padding:10px 24px;background:#15803d;color:#fff;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none">🎓 Lihat Sertifikat</a>' +
                '<a href="/pelatihan/sertifikat/' + res.program_id + '/download" style="padding:10px 24px;background:#fff;color:#15803d;border:2px solid #86efac;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none">⬇️ Download PDF</a>' +
            '</div>';
    }
}
        }
    })
    .catch(function(e){ console.error('Progress error:', e); });
}

/* ── Manual mark (fallback PDF) ── */
window.markModulSelesaiManual = function(modulId, programId, btn) {
    btn.disabled = true;
    btn.textContent = 'Menyimpan...';
    var csrf = btn.closest('[data-csrf]') 
        ? btn.closest('[data-csrf]').dataset.csrf 
        : document.querySelector('meta[name="csrf-token"]').content;
    markModulSelesai(modulId, programId, csrf, function(res) {
        btn.style.display = 'none';
    });
};

/* ════════════════════════════════════════
   YOUTUBE PLAYER — YouTube IFrame API
════════════════════════════════════════ */
var ytPlayers   = {};
var ytDurations = {};
var ytIntervals = {};
var ytDone      = {};

// Load YouTube IFrame API sekali
if (!window._ytApiLoaded) {
    window._ytApiLoaded = true;
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    document.head.appendChild(tag);
}

window.onYouTubeIframeAPIReady = function() {
    document.querySelectorAll('[id^="yt-player-"]').forEach(function(el) {
        var modulId   = el.dataset.modulId;
        var videoId   = el.dataset.videoId;
        var programId = el.dataset.programId;
        var csrf      = el.dataset.csrf;
        var sudahSelesai = el.dataset.selesai === '1';

        if (sudahSelesai) {
            // Tampilkan iframe biasa tanpa tracking
            var iframe = document.createElement('iframe');
            iframe.src = 'https://www.youtube.com/embed/' + videoId;
            iframe.style.cssText = 'width:100%;aspect-ratio:16/9;border:none;display:block';
            iframe.allowFullscreen = true;
            el.replaceWith(iframe);
            return;
        }

        ytDone[modulId] = false;

        var player = new YT.Player('yt-player-' + modulId, {
            videoId: videoId,
            playerVars: {
                controls: 1,
                disablekb: 0,
                rel: 0,
                modestbranding: 1,
            },
            events: {
                onReady: function(e) {
                    ytDurations[modulId] = e.target.getDuration();
                },
                onStateChange: function(e) {
                    var pId = modulId, pCsrf = csrf, pProgId = programId;

                    // Cegah fast-forward: pantau currentTime tiap 500ms
                    if (e.data === YT.PlayerState.PLAYING) {
                        var lastTime = e.target.getCurrentTime();
                        clearInterval(ytIntervals[pId]);
                        ytIntervals[pId] = setInterval(function() {
                            if (!ytPlayers[pId]) return;
                            var cur  = ytPlayers[pId].getCurrentTime();
                            var dur  = ytDurations[pId] || ytPlayers[pId].getDuration();
                            var diff = cur - lastTime;

                            // Jika lompat > 3 detik → kembalikan
                            if (diff > 3.5) {
                                ytPlayers[pId].seekTo(lastTime, true);
                                // Tampilkan overlay sebentar
                                var overlay = document.getElementById('yt-overlay-' + pId);
                                if (overlay) {
                                    overlay.style.display = 'flex';
                                    setTimeout(function(){
                                        if (overlay) overlay.style.display = 'none';
                                    }, 2000);
                                }
                            } else {
                                lastTime = cur;
                            }

                            // Update progress bar
                            if (dur > 0) {
                                var pct = Math.min(100, Math.round(cur/dur*100));
                                var fill  = document.getElementById('yt-progress-fill-'  + pId);
                                var label = document.getElementById('yt-progress-label-' + pId);
                                if (fill)  fill.style.width  = pct + '%';
                                if (label) label.textContent = pct + '% ditonton';
                            }
                        }, 500);

                    } else {
                        clearInterval(ytIntervals[pId]);
                    }

                    // Video selesai
                    if (e.data === YT.PlayerState.ENDED && !ytDone[pId]) {
                        ytDone[pId] = true;
                        clearInterval(ytIntervals[pId]);
                        var fill  = document.getElementById('yt-progress-fill-'  + pId);
                        var label = document.getElementById('yt-progress-label-' + pId);
                        if (fill)  fill.style.width  = '100%';
                        if (label) label.textContent = '100% ditonton';
                        markModulSelesai(pId, pProgId, pCsrf, null);
                    }
                }
            }
        });
        ytPlayers[modulId] = player;
    });
};

/* ════════════════════════════════════════
   PDF SCROLL TRACKER
════════════════════════════════════════ */
document.querySelectorAll('[id^="pdf-tracker-"]').forEach(function(tracker) {
    var modulId   = tracker.dataset.modulId;
    var programId = tracker.dataset.programId;
    var csrf      = tracker.dataset.csrf;
    var iframe    = document.getElementById('pdf-frame-' + modulId);
    var btnSelesai = document.getElementById('btn-pdf-selesai-' + modulId);

    if (!iframe) return;

    // Karena iframe PDF cross-origin tidak bisa di-scroll track langsung,
    // kita pakai pendekatan: user harus klik tombol "Tandai Selesai" 
    // yang muncul setelah 30 detik membuka PDF (waktu minimum baca)
    var minReadSeconds = 30;
    var elapsed = 0;
    var fill  = document.getElementById('pdf-progress-fill-'  + modulId);
    var label = document.getElementById('pdf-progress-label-' + modulId);

    var pdfTimer = setInterval(function() {
        // Hanya hitung jika tab aktif
        if (document.hidden) return;
        elapsed++;
        var pct = Math.min(100, Math.round(elapsed / minReadSeconds * 100));
        if (fill)  fill.style.width  = pct + '%';
        if (label) label.textContent = pct + '% di-baca';

        if (elapsed >= minReadSeconds) {
            clearInterval(pdfTimer);
            if (fill)  fill.style.width  = '100%';
            if (label) label.textContent = '100% — Klik "Tandai Selesai"';
            // Tampilkan tombol
            if (btnSelesai) btnSelesai.style.display = 'inline-flex';
            // Auto mark selesai
            markModulSelesai(modulId, programId, csrf, null);
        }
    }, 1000);

    // Pause timer saat tab tidak aktif
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            clearInterval(pdfTimer);
        }
    });
});
</script>
@endsection
