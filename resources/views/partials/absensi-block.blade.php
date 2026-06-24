@if($absAktif ?? false)

@php
    $sudahAbsen = false;
    $waktuAbsen = null;
    if (auth()->check() && isset($program->id)) {
        $rec = \App\Models\AbsensiPeserta::where('pelatihan_id', $program->id)
                ->where('user_id', auth()->id())
                ->first();
        if ($rec) {
            $sudahAbsen = true;
            $waktuAbsen = $rec->created_at
                ->setTimezone(config('app.timezone'))
                ->format('H:i');
        }
    }
@endphp

@if(($absStatus ?? '') === 'active')
{{-- ══ AKTIF ══ --}}
<div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex flex-col sm:flex-row items-center gap-4"
     id="absensi-block"
     data-status="active"
     data-mulai="{{ $absMulai->toIso8601String() }}"
     data-selesai="{{ $absSelesai->toIso8601String() }}"
     data-pelatihan-id="{{ $program->id }}"
     data-login="{{ auth()->check() ? '1' : '0' }}"
     data-login-url="{{ route('login') }}"
     data-submit-url="{{ route('absensi.submit', $program->id) }}">

    <div class="flex items-center gap-3 flex-1 min-w-0">
        <span class="relative flex h-3 w-3 flex-shrink-0">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
        </span>
        <div class="min-w-0">
            <div class="font-bold text-green-800 text-sm">Absensi Sedang Berlangsung</div>
            <div class="text-xs text-green-600 mt-0.5 flex items-center gap-1 flex-wrap">
                <span>Berakhir pukul {{ $absSelesai->format('H:i') }} WIB</span>
                <span class="opacity-50">·</span>
                <span>Sisa: <span id="abs-countdown" class="font-mono font-bold">--:--</span></span>
                @if(auth()->check())
                <span class="opacity-50">·</span>
                <span class="truncate max-w-[140px]">Login sebagai <strong>{{ auth()->user()->name }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    <div id="abs-btn-wrap" class="flex-shrink-0 w-full sm:w-auto">
        @if($sudahAbsen)
        {{-- Sudah absen (dari DB) --}}
        <div class="flex items-center justify-center gap-2 px-5 py-3 bg-green-100 border border-green-300
                    text-green-700 font-bold text-sm rounded-xl">
            ✅ Sudah Absen
            <span class="text-xs font-normal text-green-500">· {{ $waktuAbsen }} WIB</span>
        </div>

        @elseif(auth()->check())
        {{-- Login & belum absen → tombol aktif --}}
        <button id="btn-absensi"
            onclick="doAbsensi(this)"
            class="w-full sm:w-auto flex items-center justify-center gap-2
                   bg-green-600 hover:bg-green-700 active:scale-95
                   text-white font-bold text-sm px-6 py-3 rounded-xl
                   transition-all shadow-md select-none cursor-pointer">
            <span id="abs-icon">✅</span>
            <span id="abs-text">Absen Sekarang</span>
        </button>

        @else
        {{-- Belum login --}}
        <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}"
           class="w-full sm:w-auto flex items-center justify-center gap-2
                  bg-gray-600 hover:bg-gray-700 text-white font-bold text-sm
                  px-6 py-3 rounded-xl transition-all shadow-md">
            🔒 Login untuk Absen
        </a>
        @endif
    </div>
</div>

@elseif(($absStatus ?? '') === 'upcoming')
{{-- ══ AKAN DATANG ══ --}}
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex flex-col sm:flex-row items-center gap-4"
     id="absensi-block"
     data-status="upcoming"
     data-mulai="{{ $absMulai->toIso8601String() }}"
     data-selesai="{{ $absSelesai->toIso8601String() }}">
    <div class="flex items-center gap-3 flex-1">
        <span class="text-2xl flex-shrink-0">⏰</span>
        <div>
            <div class="font-bold text-amber-800 text-sm">Absensi Akan Dibuka</div>
            <div class="text-xs text-amber-600 mt-0.5">
                {{ $absMulai->translatedFormat('d M Y, H:i') }} – {{ $absSelesai->format('H:i') }} WIB
                &nbsp;·&nbsp;Dibuka dalam:
                <span id="abs-countdown" class="font-mono font-bold">--:--</span>
            </div>
        </div>
    </div>
    <button disabled class="w-full sm:w-auto bg-amber-200 text-amber-600 font-bold text-sm
                            px-6 py-3 rounded-xl cursor-not-allowed opacity-70">
        🔒 Belum Dibuka
    </button>
</div>

@else
{{-- ══ SUDAH BERAKHIR ══ --}}
@php
    $sudahAbsenEnded = false;
    $waktuAbsenEnded = null;
    if (auth()->check() && isset($program->id)) {
        $recEnded = \App\Models\AbsensiPeserta::where('pelatihan_id', $program->id)
                ->where('user_id', auth()->id())
                ->first();
        if ($recEnded) {
            $sudahAbsenEnded = true;
            $waktuAbsenEnded = $recEnded->created_at
                ->setTimezone(config('app.timezone'))
                ->format('H:i');
        }
    }
@endphp

@if($sudahAbsenEnded)
<div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex items-center gap-4">
    <span class="text-2xl flex-shrink-0">✅</span>
    <div class="flex-1">
        <div class="font-bold text-green-700 text-sm">Anda Telah Absen</div>
        <div class="text-xs text-green-500 mt-0.5">
            Tercatat pukul {{ $waktuAbsenEnded }} WIB
            · Absensi ditutup {{ $absSelesai->translatedFormat('d M Y, H:i') }} WIB
        </div>
    </div>
    <div class="flex-shrink-0 px-4 py-2 bg-green-100 border border-green-300
                text-green-700 font-bold text-sm rounded-xl">
        ✅ Sudah Absen
    </div>
</div>
@else
<div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 flex items-center gap-4 opacity-60">
    <span class="text-2xl flex-shrink-0">🔒</span>
    <div>
        <div class="font-bold text-gray-600 text-sm">Absensi Telah Ditutup</div>
        <div class="text-xs text-gray-400 mt-0.5">
            Selesai {{ $absSelesai->translatedFormat('d M Y, H:i') }} WIB
        </div>
    </div>
</div>
@endif

@endif {{-- end absStatus --}}

@endif {{-- end $absAktif --}}

@push('scripts')
<script>
(function () {
    var block = document.getElementById('absensi-block');
    if (!block) return;

    var status  = block.dataset.status;
    var mulai   = new Date(block.dataset.mulai);
    var selesai = new Date(block.dataset.selesai);
    var cntEl   = document.getElementById('abs-countdown');

    // Hanya upcoming yang butuh reload (saat absensi dibuka)
    // Active TIDAK reload saat selesai — cukup disable tombol via JS
    var reloaded = false;

    function pad(n) { return String(n).padStart(2, '0'); }
    function fmt(ms) {
        if (ms <= 0) return '00:00';
        var s = Math.floor(ms / 1000);
        var h = Math.floor(s / 3600), m = Math.floor((s % 3600) / 60), ss = s % 60;
        return h > 0 ? pad(h)+':'+pad(m)+':'+pad(ss) : pad(m)+':'+pad(ss);
    }

    var upcomingTimer = setInterval(tickUpcoming, 1000);
function tickUpcoming() {
    var msToOpen = mulai - new Date();
    if (msToOpen <= 0) {
        if (cntEl) cntEl.textContent = '00:00';
        if (!reloaded) {
            reloaded = true;
            clearInterval(upcomingTimer);

            // Ubah tampilan block dari upcoming → active tanpa reload
            block.className = 'bg-green-50 border border-green-200 rounded-2xl p-5 flex flex-col sm:flex-row items-center gap-4';
            block.dataset.status = 'active';
            block.innerHTML =
                '<div class="flex items-center gap-3 flex-1 min-w-0">'
                + '<span class="relative flex h-3 w-3 flex-shrink-0">'
                + '<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>'
                + '<span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>'
                + '</span>'
                + '<div class="min-w-0">'
                + '<div class="font-bold text-green-800 text-sm">Absensi Sedang Berlangsung</div>'
                + '<div class="text-xs text-green-600 mt-0.5">Sisa: <span id="abs-countdown" class="font-mono font-bold">--:--</span></div>'
                + '</div></div>'
                + '<div id="abs-btn-wrap" class="flex-shrink-0 w-full sm:w-auto">'
                + '<button id="btn-absensi" onclick="doAbsensi(this)"'
                + ' class="w-full sm:w-auto flex items-center justify-center gap-2'
                + ' bg-green-600 hover:bg-green-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition-all shadow-md">'
                + '<span id="abs-icon">✅</span>'
                + '<span id="abs-text">Absen Sekarang</span>'
                + '</button></div>';

            // Mulai countdown active
            cntEl = document.getElementById('abs-countdown');
            activeTimer = setInterval(tickActive, 1000);
            tickActive();
        }
        return;
    }
    if (cntEl) cntEl.textContent = fmt(msToOpen);
}
    // ── ACTIVE: hitung mundur sampai selesai, lalu disable tombol (TANPA reload) ──
    var activeTimer = setInterval(tickActive, 1000);
function tickActive() {
    var msLeft = selesai - new Date();
    if (msLeft <= 0) {
        if (cntEl) cntEl.textContent = '00:00';
        clearInterval(activeTimer); // ✅ hentikan interval
        var btn = document.getElementById('btn-absensi');
        if (btn && !btn.disabled) {
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.style.cursor  = 'not-allowed';
            document.getElementById('abs-icon').textContent = '🔒';
            document.getElementById('abs-text').textContent = 'Absensi Ditutup';
        }
        return;
    }
    if (cntEl) cntEl.textContent = fmt(msLeft);
}

    
if (status === 'upcoming') {
    tickUpcoming();
    var upcomingTimer = setInterval(tickUpcoming, 1000);
} else if (status === 'active') {
    tickActive();
    var activeTimer = setInterval(tickActive, 1000);
}
    // ── Handler tombol absen ──
    function setDone(waktu) {
        var wrap = document.getElementById('abs-btn-wrap');
        if (!wrap) return;
        wrap.innerHTML =
            '<div style="display:flex;align-items:center;gap:8px;padding:10px 18px;'
            + 'background:#dcfce7;border:1.5px solid #86efac;border-radius:10px;'
            + 'font-size:13px;font-weight:700;color:#15803d;white-space:nowrap">'
            + '✅ Sudah Absen'
            + (waktu ? '<span style="font-size:11px;font-weight:400;color:#16a34a">· ' + waktu + ' WIB</span>' : '')
            + '</div>';
    }

    window.doAbsensi = function (btn) {
        if (btn.disabled) return;
        btn.disabled = true;

        var iconEl = document.getElementById('abs-icon');
        var textEl = document.getElementById('abs-text');
        if (iconEl) iconEl.textContent = '⏳';
        if (textEl) textEl.textContent  = 'Mencatat...';

        var csrf = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';

        fetch(block.dataset.submitUrl, {
            method : 'POST',
            headers: {
                'Content-Type' : 'application/json',
                'X-CSRF-TOKEN' : csrf,
                'Accept'       : 'application/json',
            },
            body: JSON.stringify({}),
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.require_login) {
                window.location.href = block.dataset.loginUrl
                    + '?redirect=' + encodeURIComponent(window.location.href);
                return;
            }
            if (res.success) {
                setDone(res.waktu || '');
            } else {
                btn.disabled = false;
                if (iconEl) iconEl.textContent = '✅';
                if (textEl) textEl.textContent  = 'Absen Sekarang';

                var errEl = document.getElementById('abs-err');
                if (!errEl) {
                    errEl = document.createElement('p');
                    errEl.id = 'abs-err';
                    errEl.style.cssText = 'margin-top:6px;font-size:11px;color:#dc2626;text-align:center';
                    document.getElementById('abs-btn-wrap').appendChild(errEl);
                }
                errEl.textContent = res.message || 'Gagal mencatat absensi.';
            }
        })
        .catch(function () {
            btn.disabled = false;
            if (iconEl) iconEl.textContent = '✅';
            if (textEl) textEl.textContent  = 'Absen Sekarang';
        });
    };
})();
</script>
@endpush