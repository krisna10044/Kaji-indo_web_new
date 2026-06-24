<?php $__env->startSection('content'); ?>
<div class="tf-page">
    <div class="tf-container">

        
        <a href="<?php echo e(route('profile')); ?>" class="tf-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Profil
        </a>

        
        <div class="tf-hero">
            <h1>Formulir Pendaftaran Mitra UMKM</h1>
            <p>Lengkapi data di bawah ini dengan benar untuk ditinjau oleh Admin.</p>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="tf-banner tf-banner--rejected">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <div>
                    <p class="tf-banner__title">Ada kesalahan input:</p>
                    <ul class="tf-error-list">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        
        <form
            action="<?php echo e(route('profile.simpan-umkm')); ?>"
            method="POST"
            enctype="multipart/form-data"
            id="form-umkm"
        >
            <?php echo csrf_field(); ?>

            
            <div class="tf-card">
                <div class="tf-card__header">Informasi Usaha</div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Nama Toko / Usaha <span class="tf-req">*</span></label>
                        <input
                            type="text"
                            name="nama"
                            value="<?php echo e(old('nama')); ?>"
                            placeholder="Contoh: Batik Nusantara"
                            class="tf-input"
                            required
                        >
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kategori Usaha <span class="tf-req">*</span></label>
                        <select name="kategori" class="tf-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Kuliner"   <?php echo e(old('kategori') === 'Kuliner'   ? 'selected' : ''); ?>>Kuliner</option>
                            <option value="Fashion"   <?php echo e(old('kategori') === 'Fashion'   ? 'selected' : ''); ?>>Fashion</option>
                            <option value="Kerajinan" <?php echo e(old('kategori') === 'Kerajinan' ? 'selected' : ''); ?>>Kerajinan</option>
                            <option value="Pertanian" <?php echo e(old('kategori') === 'Pertanian' ? 'selected' : ''); ?>>Pertanian</option>
                            <option value="Jasa"      <?php echo e(old('kategori') === 'Jasa'      ? 'selected' : ''); ?>>Jasa</option>
                        </select>
                    </div>
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Nama Pemilik (Owner) <span class="tf-req">*</span></label>
                        <input
                            type="text"
                            name="owner"
                            value="<?php echo e(old('owner')); ?>"
                            class="tf-input"
                            required
                        >
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kontak WhatsApp <span class="tf-req">*</span></label>
                        <input
                            type="text"
                            name="kontak"
                            value="<?php echo e(old('kontak')); ?>"
                            placeholder="Contoh: 628123456789"
                            class="tf-input"
                            required
                        >
                        <p class="tf-hint">* Gunakan format angka mulai dari 62</p>
                    </div>
                </div>

                <div class="tf-field">
                    <label class="tf-label">Nomor Induk Berusaha (NIB) <span class="tf-label--optional">(Opsional)</span></label>
                    <input
                        type="text"
                        name="nib"
                        value="<?php echo e(old('nib')); ?>"
                        class="tf-input"
                    >
                </div>

                <div class="tf-field">
                    <label class="tf-label">Deskripsi Usaha <span class="tf-req">*</span></label>
                    <textarea
                        name="deskripsi"
                        rows="4"
                        placeholder="Jelaskan produk unggulan dan keunikan usaha Anda..."
                        class="tf-textarea"
                        required
                    ><?php echo e(old('deskripsi')); ?></textarea>
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Lokasi Usaha</div>

                <div class="tf-field">
                    <label class="tf-label">Detail Alamat (Jalan, No Rumah, RT/RW) <span class="tf-req">*</span></label>
                    <textarea
                        name="alamat"
                        id="alamat_umkm"
                        rows="2"
                        placeholder="Contoh: Jl. Sudirman No. 123, RT 01/RW 02"
                        class="tf-textarea"
                        required
                    ><?php echo e(old('alamat')); ?></textarea>
                    <p class="tf-hint">* Wajib sertakan RT/RW agar peta lebih akurat</p>
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Provinsi <span class="tf-req">*</span></label>
                        <select name="provinsi" id="provinsi_umkm" class="tf-select" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kabupaten / Kota <span class="tf-req">*</span></label>
                        <select name="kabupaten_kota" id="kota_umkm" class="tf-select" required disabled>
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kecamatan <span class="tf-req">*</span></label>
                        <select name="kecamatan" id="kecamatan_umkm" class="tf-select" required disabled>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kelurahan / Desa <span class="tf-req">*</span></label>
                        <select name="kelurahan" id="kelurahan_umkm" class="tf-select" required disabled>
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>
                </div>

                
                <div class="tf-field">
                    <label class="tf-label">
                        Titik Lokasi di Peta <span class="tf-req">*</span>
                    </label>
                    <p class="tf-hint" style="margin-bottom:8px">
                        Peta akan otomatis mengarah ke lokasi usaha setelah <strong>Kelurahan/Desa</strong> dipilih.
                        Anda juga bisa klik atau geser marker untuk menyesuaikan titik secara manual.
                    </p>

                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css"/>
                    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>

                    <div style="position:relative;">
                        <div id="map-picker-umkm" style="height:280px;border-radius:10px;border:1.5px solid #d1d5db;overflow:hidden;"></div>
                        <div id="map-umkm-loading" style="display:none;position:absolute;inset:0;background:rgba(255,255,255,0.75);border-radius:10px;z-index:1000;align-items:center;justify-content:center;flex-direction:column;gap:8px;">
                            <div style="width:28px;height:28px;border:3px solid #a7d8be;border-top-color:#0f6e56;border-radius:50%;animation:tf-spin 0.8s linear infinite;"></div>
                            <span style="font-size:12px;color:#666;">Mencari lokasi...</span>
                        </div>
                    </div>

                    <p id="map-hint-umkm" class="tf-hint" style="margin-top:6px">
                        📍 Pilih Kelurahan/Desa terlebih dahulu agar peta otomatis mengarah ke lokasi Anda.
                    </p>
                    <input type="hidden" name="lat" id="lat-umkm" value="<?php echo e(old('lat')); ?>" required>
                    <input type="hidden" name="lng" id="lng-umkm" value="<?php echo e(old('lng')); ?>" required>
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Upload Foto</div>

                <div class="tf-grid-2">
                    
                    <div class="tf-field">
                        <label class="tf-label">Logo Usaha <span class="tf-req">*</span></label>
                        <div class="tf-upload" onclick="triggerFile('file-logo')" role="button" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="tf-upload__label" id="label-logo">Pilih Logo</span>
                            <span class="tf-upload__hint">JPG, PNG, WebP · Maks 10 MB</span>
                        </div>
                        <input type="file" name="logo" id="file-logo" class="tf-file-hidden" accept="image/*" required onchange="updateUploadLabel(this,'label-logo')">
                    </div>

                    
                    <div class="tf-field">
                        <label class="tf-label">Foto Produk Unggulan <span class="tf-req">*</span></label>
                        <div class="tf-upload" onclick="triggerFile('file-produk')" role="button" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="tf-upload__label" id="label-produk">Pilih Foto</span>
                            <span class="tf-upload__hint">JPG, PNG, WebP · Maks 10 MB</span>
                        </div>
                        <input type="file" name="foto_produk" id="file-produk" class="tf-file-hidden" accept="image/*" required onchange="updateUploadLabel(this,'label-produk')">
                    </div>
                </div>
            </div>

            
            <div class="tf-agree">
                <input
                    type="checkbox"
                    name="terms"
                    id="terms"
                    value="1"
                    required
                    class="tf-agree__check"
                >
                <label for="terms" class="tf-agree__label">
                    Saya setuju dengan
                    <a href="https://kajiindonesia.com/" target="_blank" rel="noopener">Syarat dan Ketentuan</a>
                    serta
                    <a href="https://kajiindonesia.com/" target="_blank" rel="noopener">Kebijakan Privasi</a>
                    yang berlaku di <strong>KAJI Indonesia</strong>.
                </label>
            </div>

            
            <button type="submit" class="tf-submit">
                Kirim Pendaftaran UMKM
            </button>

            <p class="tf-footer-note">
                * Pendaftaran akan ditinjau oleh Admin sebelum ditampilkan di halaman UMKM.
            </p>

        </form>
    </div>
</div>


<style>
@keyframes tf-spin { to { transform: rotate(360deg); } }

.tf-page {
    min-height: 100vh;
    background: #f4f6f5;
    padding: 20px 0 40px;
}
.tf-container {
    max-width: 640px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Back */
.tf-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #0f6e56;
    text-decoration: none;
    margin-bottom: 14px;
    transition: color .15s;
}
.tf-back:hover { color: #085041; }

/* Hero */
.tf-hero {
    background: #0f6e56;
    border-radius: 14px;
    padding: 22px 20px;
    text-align: center;
    color: #fff;
    margin-bottom: 10px;
}
.tf-hero h1 { font-size: 20px; font-weight: 700; margin-bottom: 5px; }
.tf-hero p { font-size: 13px; color: #a9d9c6; line-height: 1.5; }

/* Banner */
.tf-banner {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 12px 14px;
    border-radius: 0 10px 10px 0;
    margin-bottom: 10px;
    border-left: 3px solid;
}
.tf-banner--rejected { background: #fef2f2; border-color: #ef4444; }
.tf-banner__icon { flex-shrink: 0; margin-top: 1px; }
.tf-banner--rejected .tf-banner__icon { color: #dc2626; }
.tf-banner__title { font-size: 13px; font-weight: 700; margin-bottom: 3px; }
.tf-banner--rejected .tf-banner__title { color: #991b1b; }
.tf-error-list {
    list-style: disc;
    padding-left: 16px;
    font-size: 12px;
    color: #991b1b;
    margin-top: 4px;
    line-height: 1.7;
}

/* Card */
.tf-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e8ede9;
    padding: 16px;
    margin-bottom: 10px;
}
.tf-card__header {
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: .06em;
    padding-bottom: 10px;
    margin-bottom: 14px;
    border-bottom: 1px solid #f0f4f1;
}

/* Field */
.tf-field { margin-bottom: 12px; }
.tf-field:last-child { margin-bottom: 0; }
.tf-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
}
.tf-req { color: #dc2626; font-weight: 400; }
.tf-label--optional { font-weight: 400; color: #9ca3af; font-size: 11px; }
.tf-hint { font-size: 10px; color: #9ca3af; margin-top: 4px; }

/* Inputs */
.tf-input,
.tf-select,
.tf-textarea {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 13px;
    color: #111827;
    background: #fff;
    outline: none;
    font-family: inherit;
    transition: border-color .15s, box-shadow .15s;
    -webkit-appearance: none;
    box-sizing: border-box;
}
.tf-input:focus,
.tf-select:focus,
.tf-textarea:focus {
    border-color: #0f6e56;
    box-shadow: 0 0 0 3px rgba(15,110,86,.1);
}
.tf-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 36px;
}
.tf-select:disabled { background-color: #f9fafb; color: #9ca3af; cursor: not-allowed; }
.tf-textarea { resize: vertical; line-height: 1.55; min-height: 80px; }

/* Grid */
.tf-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
@media (max-width: 400px) {
    .tf-grid-2 { grid-template-columns: 1fr; }
}

/* Upload */
.tf-upload {
    border: 1.5px dashed #d1d5db;
    border-radius: 10px;
    padding: 14px 10px;
    text-align: center;
    background: #fafafa;
    cursor: pointer;
    transition: border-color .15s, background .15s;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    min-height: 88px;
    justify-content: center;
    box-sizing: border-box;
}
.tf-upload:hover { border-color: #0f6e56; background: #f0faf6; }
.tf-upload svg { color: #0f6e56; flex-shrink: 0; }
.tf-upload__label { font-size: 12px; font-weight: 600; color: #0f6e56; line-height: 1.5; }
.tf-upload__hint { font-size: 10px; color: #9ca3af; }
.tf-upload--wide {
    flex-direction: row;
    text-align: left;
    gap: 12px;
    padding: 12px 16px;
    min-height: auto;
}
.tf-file-hidden { display: none; }

/* Agree */
.tf-agree {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 14px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e8ede9;
    margin-bottom: 14px;
}
.tf-agree__check {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    margin-top: 2px;
    accent-color: #0f6e56;
    cursor: pointer;
}
.tf-agree__label { font-size: 12px; color: #4b5563; line-height: 1.7; cursor: pointer; }
.tf-agree__label a { color: #0f6e56; font-weight: 600; text-decoration: none; }
.tf-agree__label a:hover { text-decoration: underline; }
.tf-agree__label strong { color: #111827; }

/* Submit */
.tf-submit {
    width: 100%;
    padding: 14px;
    background: #0f6e56;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: background .15s, transform .1s;
    letter-spacing: .01em;
    box-shadow: 0 4px 14px rgba(15,110,86,.25);
}
.tf-submit:hover { background: #085041; transform: translateY(-1px); }
.tf-submit:active { transform: translateY(0); }
.tf-footer-note {
    text-align: center;
    font-size: 11px;
    color: #9ca3af;
    margin-top: 12px;
    font-style: italic;
}

/* Responsive */
@media (min-width: 480px) {
    .tf-hero h1 { font-size: 22px; }
    .tf-card { padding: 20px; }
    .tf-container { padding: 0 20px; }
}
@media (min-width: 640px) {
    .tf-page { padding: 32px 0 60px; }
    .tf-hero { padding: 28px 24px; }
}
</style>


<script>
function triggerFile(id) {
    const el = document.getElementById(id);
    if (el) el.click();
}

function updateUploadLabel(input, labelId) {
    const label = document.getElementById(labelId);
    if (!label) return;
    if (input.files && input.files[0]) {
        label.innerHTML = '<span style="color:#059669;font-style:italic;font-weight:400">✓ ' + input.files[0].name + '</span>';
    }
}

/* ======================== PETA + GEOCODE ======================== */
(function () {
    var map         = L.map('map-picker-umkm').setView([-2.5, 118], 5);
    var marker      = null;
    var debTimer    = null;
    var isGeocoding = false;
    var hintEl      = document.getElementById('map-hint-umkm');
    var loadEl      = document.getElementById('map-umkm-loading');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);

    var oldLat = document.getElementById('lat-umkm').value;
    var oldLng = document.getElementById('lng-umkm').value;
    if (oldLat && oldLng) setMarker(parseFloat(oldLat), parseFloat(oldLng), true);

    function setMarker(lat, lng, zoomIn) {
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', function (e) {
                var p = e.target.getLatLng();
                simpanKoordinat(p.lat, p.lng);
            });
        }
        if (zoomIn) map.setView([lat, lng], 16);
        simpanKoordinat(lat, lng);
    }

    function simpanKoordinat(lat, lng) {
        document.getElementById('lat-umkm').value = lat;
        document.getElementById('lng-umkm').value = lng;
        hintEl.textContent = '✅ ' + lat.toFixed(6) + ', ' + lng.toFixed(6) + ' — Geser marker untuk menyesuaikan.';
        hintEl.style.color = '#16a34a';
    }

    map.on('click', function (e) { setMarker(e.latlng.lat, e.latlng.lng, false); });

    function selText(id) {
        var el = document.getElementById(id);
        if (!el || !el.value) return '';
        return el.options[el.selectedIndex].text;
    }

    window.umkmGeocode = function () {
        clearTimeout(debTimer);
        debTimer = setTimeout(doGeocode, 600);
    };

    function doGeocode() {
        if (isGeocoding) return;
        var alamat   = (document.getElementById('alamat_umkm') || {}).value || '';
        var kelVal   = (document.getElementById('kelurahan_umkm') || {}).value || '';
        var kelText  = selText('kelurahan_umkm');
        var kecText  = selText('kecamatan_umkm');
        var kabText  = selText('kota_umkm');
        var provText = selText('provinsi_umkm');
        if (!kelVal || alamat.trim().length < 5) return;

        isGeocoding = true;
        loadEl.style.display = 'flex';
        hintEl.textContent   = '🔍 Mencari lokasi...';
        hintEl.style.color   = '#6b7280';

        var p1 = new URLSearchParams({
            format: 'json', limit: '1', countrycodes: 'id', 'accept-language': 'id,en',
            street: alamat.trim(), suburb: kelText, city: kabText, state: provText, country: 'Indonesia'
        });

        fetch('https://nominatim.openstreetmap.org/search?' + p1.toString())
            .then(function (r) { return r.json(); })
            .then(function (h1) {
                if (h1 && h1.length > 0) return h1[0];
                var q2 = [kelText, kecText, kabText, provText].filter(Boolean).join(', ');
                var p2 = new URLSearchParams({ format: 'json', limit: '1', countrycodes: 'id', 'accept-language': 'id,en', q: q2 + ', Indonesia' });
                return fetch('https://nominatim.openstreetmap.org/search?' + p2.toString())
                    .then(function (r2) { return r2.json(); })
                    .then(function (h2) { return (h2 && h2.length > 0) ? h2[0] : null; });
            })
            .then(function (result) {
                loadEl.style.display = 'none';
                isGeocoding = false;
                if (!result) { hintEl.textContent = '⚠️ Lokasi tidak ditemukan otomatis. Klik langsung di peta.'; hintEl.style.color = '#b45309'; return; }
                var lat = parseFloat(result.lat);
                var lng = parseFloat(result.lon);
                if (lat >= -11 && lat <= 6 && lng >= 95 && lng <= 141) {
                    setMarker(lat, lng, true);
                } else {
                    hintEl.textContent = '⚠️ Hasil di luar Indonesia. Klik langsung di peta.';
                    hintEl.style.color = '#b45309';
                }
            })
            .catch(function () {
                loadEl.style.display = 'none';
                isGeocoding = false;
                hintEl.textContent = '⚠️ Gagal terhubung ke layanan peta. Klik titik di peta secara manual.';
                hintEl.style.color = '#b45309';
            });
    }

    var inputAlamat = document.getElementById('alamat_umkm');
    if (inputAlamat) {
        inputAlamat.addEventListener('input', function () {
            var kelVal = (document.getElementById('kelurahan_umkm') || {}).value || '';
            if (kelVal) window.umkmGeocode();
        });
    }
})();

/* ======================== WILAYAH API ======================== */
(function () {
    var BASE   = 'https://www.emsifa.com/api-wilayah-indonesia/api';
    var elProv = document.getElementById('provinsi_umkm');
    var elKab  = document.getElementById('kota_umkm');
    var elKec  = document.getElementById('kecamatan_umkm');
    var elKel  = document.getElementById('kelurahan_umkm');

    function resetSelect(el, label) {
        el.innerHTML = '<option value="">' + label + '</option>';
        el.disabled = true;
    }

    fetch(BASE + '/provinces.json')
        .then(function (r) { return r.json(); })
        .then(function (data) {
            data.forEach(function (p) {
                var o = document.createElement('option');
                o.value = p.id; o.textContent = p.name;
                elProv.appendChild(o);
            });
        })
        .catch(function () { alert('Gagal memuat data provinsi. Pastikan internet aktif!'); });

    elProv.addEventListener('change', function () {
        resetSelect(elKab, 'Pilih Kabupaten/Kota');
        resetSelect(elKec, 'Pilih Kecamatan');
        resetSelect(elKel, 'Pilih Kelurahan');
        if (!this.value) return;
        fetch(BASE + '/regencies/' + this.value + '.json')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                data.forEach(function (k) {
                    var o = document.createElement('option');
                    o.value = k.id; o.textContent = k.name;
                    elKab.appendChild(o);
                });
                elKab.disabled = false;
            });
    });

    elKab.addEventListener('change', function () {
        resetSelect(elKec, 'Pilih Kecamatan');
        resetSelect(elKel, 'Pilih Kelurahan');
        if (!this.value) return;
        fetch(BASE + '/districts/' + this.value + '.json')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                data.forEach(function (k) {
                    var o = document.createElement('option');
                    o.value = k.id; o.textContent = k.name;
                    elKec.appendChild(o);
                });
                elKec.disabled = false;
            });
    });

    elKec.addEventListener('change', function () {
        resetSelect(elKel, 'Pilih Kelurahan');
        if (!this.value) return;
        fetch(BASE + '/villages/' + this.value + '.json')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                data.forEach(function (k) {
                    var o = document.createElement('option');
                    o.value = k.id; o.textContent = k.name;
                    elKel.appendChild(o);
                });
                elKel.disabled = false;
            });
    });

    elKel.addEventListener('change', function () {
        if (!this.value) return;
        if (typeof window.umkmGeocode === 'function') window.umkmGeocode();
    });
})();

/* ======================== SUBMIT: kirim nama bukan ID ======================== */
document.getElementById('form-umkm').addEventListener('submit', function () {
    var maps = {
        'provinsi_umkm'  : 'provinsi',
        'kota_umkm'      : 'kabupaten_kota',
        'kecamatan_umkm' : 'kecamatan',
        'kelurahan_umkm' : 'kelurahan',
    };
    Object.keys(maps).forEach(function (elId) {
        var el = document.getElementById(elId);
        if (!el || !el.value) return;
        var hidden = document.createElement('input');
        hidden.type  = 'hidden';
        hidden.name  = maps[elId];
        hidden.value = el.options[el.selectedIndex].text;
        document.getElementById('form-umkm').appendChild(hidden);
        el.removeAttribute('name');
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/profile/daftar-umkm.blade.php ENDPATH**/ ?>