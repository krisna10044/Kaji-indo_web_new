

<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-primary-dark via-primary to-primary- py-16 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-2xl">
            <h1 class="font-serif text-4xl font-bold sm:text-5xl">Lokasi UMKM</h1>
            <p class="mt-4 text-lg text-white/90">
                Temukan sebaran mitra UMKM yang didampingi oleh Karya Kami di seluruh Indonesia.
            </p>
        </div>
        <div>
            <img src="<?php echo e(asset('storage/logo/KARYAKAMI.png')); ?>" alt="Logo Karya Kami" class="w-32 md:w-40 object-contain">
        </div>
    </div>
</section>


<div class="bg-white border-b border-gray-200 shadow-sm" style="position:relative;z-index:1;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-between gap-3">
        <p class="text-sm text-gray-500">Klik marker pada peta untuk melihat detail UMKM atau Mentor</p>
        <div class="flex items-center gap-3 flex-wrap">
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center gap-1.5">
                    <span style="display:inline-block;width:14px;height:14px;background:#1a73e8;border-radius:50%;border:2px solid #fff;box-shadow:0 1px 3px rgba(0,0,0,.3);"></span>
                    <span class="text-gray-600 font-medium">UMKM</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span style="display:inline-block;width:14px;height:14px;background:#e53935;border-radius:50%;border:2px solid #fff;box-shadow:0 1px 3px rgba(0,0,0,.3);"></span>
                    <span class="text-gray-600 font-medium">Mentor</span>
                </div>
            </div>
            <span id="jumlah-umkm" class="text-sm font-semibold bg-blue-100 text-blue-800 px-4 py-1 rounded-full border border-blue-200">Memuat...</span>
            <span id="jumlah-mentor" class="text-sm font-semibold bg-red-100 text-red-800 px-4 py-1 rounded-full border border-red-200">Memuat...</span>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css"/>

<style>
    #map { z-index: 0; }
    .leaflet-popup-content-wrapper { border-radius: 12px !important; padding: 0 !important; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.15) !important; }
    .leaflet-popup-content { margin: 0 !important; width: 240px !important; }
    .popup-foto { width: 100%; height: 140px; object-fit: cover; display: block; background: #f3f4f6; }
    .popup-foto-placeholder { width: 100%; height: 100px; background: #e8f0fe; display: flex; align-items: center; justify-content: center; font-size: 36px; }
    .popup-foto-placeholder-mentor { width: 100%; height: 100px; background: #fce8e8; display: flex; align-items: center; justify-content: center; font-size: 36px; }
    .popup-body { padding: 12px 14px 14px; }
    .popup-nama { font-size: 14px; font-weight: 600; color: #1a1a2e; margin-bottom: 5px; line-height: 1.3; }
    .popup-alamat { font-size: 12px; color: #666; line-height: 1.5; margin-bottom: 10px; }
    .popup-badge-umkm { display: inline-block; background: #dbeafe; color: #1d4ed8; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; margin-bottom: 8px; letter-spacing: 0.5px; text-transform: uppercase; }
    .popup-badge-mentor { display: inline-block; background: #fee2e2; color: #b91c1c; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; margin-bottom: 8px; letter-spacing: 0.5px; text-transform: uppercase; }
    .popup-btn-detail { display: block; text-align: center; background: #1a73e8; color: #fff !important; font-size: 12px; font-weight: 600; padding: 7px 14px; border-radius: 8px; text-decoration: none; }
    .popup-btn-detail:hover { background: #1557b0; }
    .popup-btn-mentor { display: block; text-align: center; background: #e53935; color: #fff !important; font-size: 12px; font-weight: 600; padding: 7px 14px; border-radius: 8px; text-decoration: none; }
    .popup-btn-mentor:hover { background: #b71c1c; }
</style>

<div class="relative">
    <div id="loading" class="absolute inset-0 flex flex-col items-center justify-center bg-white/80 gap-3" style="z-index:1;">
        <div class="w-10 h-10 border-4 border-gray-200 border-t-primary rounded-full animate-spin"></div>
        <p class="text-sm text-gray-500">Memuat data peta...</p>
    </div>
    <div id="error-box" class="hidden absolute top-4 left-1/2 -translate-x-1/2 bg-red-50 border border-red-200 text-red-700 text-sm px-5 py-3 rounded-lg shadow max-w-md text-center" style="z-index:2;"></div>
    <div id="map" class="w-full" style="height:600px;"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>

<script>
const API_UMKM_URL   = '<?php echo e(route("umkm.peta-data")); ?>';
const API_MENTOR_URL = '<?php echo e(route("umkm.peta-data-mentor")); ?>';
const DETAIL_URL     = '<?php echo e(url("/umkm/produk/profil")); ?>';
const MENTOR_DETAIL_URL = '<?php echo e(url("/umkm/pembimbing")); ?>';

const map = L.map('map').setView([-2.5, 118], 5);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 19,
}).addTo(map);

function buatMarkerUMKM() {
    return L.divIcon({
        className: '',
        html: `<div style="position:relative;width:52px;height:62px;">
            <div style="width:52px;height:52px;background:#1a73e8;border-radius:50% 50% 50% 0;transform:rotate(-45deg);position:absolute;top:0;left:0;border:2px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.3);"></div>
            <div style="position:absolute;top:6px;left:6px;width:40px;height:40px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;">
                <span style="font-size:9px;font-weight:800;color:#1a73e8;text-align:center;line-height:1.1;">UMKM</span>
            </div></div>`,
        iconSize: [52, 62], iconAnchor: [26, 62], popupAnchor: [0, -66],
    });
}

function buatMarkerMentor() {
    return L.divIcon({
        className: '',
        html: `<div style="position:relative;width:58px;height:68px;">
            <div style="width:58px;height:58px;background:#e53935;border-radius:50% 50% 50% 0;transform:rotate(-45deg);position:absolute;top:0;left:0;border:2px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.35);"></div>
            <div style="position:absolute;top:7px;left:7px;width:44px;height:44px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;">
                <span style="font-size:8px;font-weight:800;color:#e53935;text-align:center;line-height:1.1;">MENTOR</span>
            </div></div>`,
        iconSize: [58, 68], iconAnchor: [29, 68], popupAnchor: [0, -72],
    });
}

function buatPopupUMKM(umkm) {
    const fotoHtml = umkm.foto
        ? `<div style="width:100%;height:140px;background:#f3f4f6;overflow:hidden;">
               <img style="width:100%;height:140px;object-fit:cover;display:block;"
                    src="${umkm.foto}"
                    alt="${escHtml(umkm.nama)}"
                    onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:140px;background:#e8f0fe;display:flex;align-items:center;justify-content:center;font-size:36px;\'>🏪</div>'">
           </div>`
        : `<div style="width:100%;height:140px;background:#e8f0fe;display:flex;align-items:center;justify-content:center;font-size:36px;">🏪</div>`;

    const alamat = umkm.alamat ? `<div class="popup-alamat">📍 ${escHtml(umkm.alamat)}</div>` : '';

    return `${fotoHtml}<div class="popup-body">
        <div class="popup-badge-umkm">UMKM</div>
        <div class="popup-nama">${escHtml(umkm.nama)}</div>
        ${alamat}
        <a class="popup-btn-detail" href="${DETAIL_URL}/${umkm.id}">Lihat Detail Produk →</a>
    </div>`;
}

function buatPopupMentor(mentor) {
    const fotoHtml = mentor.foto
        ? `<div style="width:100%;height:140px;background:#f3f4f6;overflow:hidden;">
               <img style="width:100%;height:140px;object-fit:cover;display:block;"
                    src="${mentor.foto}"
                    alt="${escHtml(mentor.nama)}"
                    onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:140px;background:#fce8e8;display:flex;align-items:center;justify-content:center;font-size:36px;\'>👤</div>'">
           </div>`
        : `<div style="width:100%;height:140px;background:#fce8e8;display:flex;align-items:center;justify-content:center;font-size:36px;">👤</div>`;

    const lokasi = mentor.lokasi ? `<div class="popup-alamat">📍 ${escHtml(mentor.lokasi)}</div>` : '';

    return `${fotoHtml}<div class="popup-body">
        <div class="popup-badge-mentor">MENTOR</div>
        <div class="popup-nama">${escHtml(mentor.nama)}</div>
        ${lokasi}
        <a class="popup-btn-mentor" href="${MENTOR_DETAIL_URL}/${mentor.id}">Lihat Detail →</a>
    </div>`;
}

async function muatSemuaData() {
    try {
        const [resUMKM, resMentor] = await Promise.all([
            fetch(API_UMKM_URL),
            fetch(API_MENTOR_URL),
        ]);
        if (!resUMKM.ok)   throw new Error('HTTP UMKM ' + resUMKM.status);
        if (!resMentor.ok) throw new Error('HTTP Mentor ' + resMentor.status);

        const jsonUMKM   = await resUMKM.json();
        const jsonMentor = await resMentor.json();
        const dataUMKM   = jsonUMKM.data   || [];
        const dataMentor = jsonMentor.data  || [];

        document.getElementById('loading').style.display = 'none';
        document.getElementById('jumlah-umkm').textContent   = (jsonUMKM.total_approved   ?? dataUMKM.length)   + ' UMKM Terdaftar';
        document.getElementById('jumlah-mentor').textContent = (jsonMentor.total_approved ?? dataMentor.length) + ' Mentor Terdaftar';

        const allMarkers = [];
        const iconUMKM   = buatMarkerUMKM();
        const iconMentor = buatMarkerMentor();

        dataUMKM.forEach(umkm => {
            if (!umkm.lat || !umkm.lng) return;
            const marker = L.marker([umkm.lat, umkm.lng], { icon: iconUMKM });
            marker.bindPopup(buatPopupUMKM(umkm), { maxWidth: 260 });
            marker.addTo(map);
            allMarkers.push(marker);
        });

        dataMentor.forEach(mentor => {
            if (!mentor.lat || !mentor.lng) return;
            const marker = L.marker([mentor.lat, mentor.lng], { icon: iconMentor });
            marker.bindPopup(buatPopupMentor(mentor), { maxWidth: 260 });
            marker.addTo(map);
            allMarkers.push(marker);
        });

        if (allMarkers.length > 0) {
            map.fitBounds(L.featureGroup(allMarkers).getBounds().pad(0.2));
        } else {
            tampilInfo('Belum ada data UMKM yang disetujui dan memiliki informasi lokasi.');
        }

    } catch (err) {
        document.getElementById('loading').style.display = 'none';
        tampilError('Gagal memuat data: ' + err.message);
        console.error(err);
    }
}

function tampilError(msg) {
    const el = document.getElementById('error-box');
    el.textContent = '⚠️ ' + msg;
    el.classList.remove('hidden');
}

function tampilInfo(msg) {
    const el = document.getElementById('error-box');
    el.style.cssText += 'background:#eff6ff;border-color:#bfdbfe;color:#1e40af;';
    el.textContent = 'ℹ️ ' + msg;
    el.classList.remove('hidden');
}

function escHtml(s) {
    if (!s) return '';
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

muatSemuaData();
setInterval(muatSemuaData, 300000);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/umkm-lokasi.blade.php ENDPATH**/ ?>