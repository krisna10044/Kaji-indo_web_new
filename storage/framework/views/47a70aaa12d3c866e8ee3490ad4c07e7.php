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
            <h1>Formulir Pendaftaran Mentor</h1>
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
            action="<?php echo e(route('profile.simpan-mentor')); ?>"
            method="POST"
            enctype="multipart/form-data"
        >
            <?php echo csrf_field(); ?>

            
            <div class="tf-card">
                <div class="tf-card__header">Data Diri</div>

                <div class="tf-field">
                    <label class="tf-label">Nama Lengkap <span class="tf-req">*</span></label>
                    <input
                        type="text"
                        name="full_name"
                        value="<?php echo e(old('full_name', $user->name)); ?>"
                        placeholder="Masukkan nama lengkap Anda"
                        class="tf-input"
                        required
                    >
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">No. WhatsApp <span class="tf-req">*</span></label>
                        <input
                            type="text"
                            name="phone"
                            value="<?php echo e(old('phone', $user->phone)); ?>"
                            placeholder="Contoh: 08123456789"
                            class="tf-input"
                            required
                        >
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Email Aktif <span class="tf-req">*</span></label>
                        <input
                            type="email"
                            name="email"
                            value="<?php echo e(old('email', $user->email)); ?>"
                            class="tf-input"
                            required
                        >
                    </div>
                </div>
            </div>

            
<div class="tf-card">
    <div class="tf-card__header">Sosial Media</div>
    <p style="font-size:12px;color:#6b7280;margin-bottom:14px">Isi minimal satu akun sosial media yang aktif.</p>

    <div class="tf-field">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#E1306C"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.975.975 1.246 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.975.975-2.242 1.246-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.975-.975-1.246-2.242-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608.975-.975 2.242-1.246 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.333.014 7.053.072 5.197.157 3.355.673 2.014 2.014.673 3.355.157 5.197.072 7.053.014 8.333 0 8.741 0 12c0 3.259.014 3.667.072 4.947.085 1.856.601 3.698 1.942 5.039 1.341 1.341 3.183 1.857 5.039 1.942C8.333 23.986 8.741 24 12 24s3.667-.014 4.947-.072c1.856-.085 3.698-.601 5.039-1.942 1.341-1.341 1.857-3.183 1.942-5.039.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.085-1.856-.601-3.698-1.942-5.039C20.645.673 18.803.157 16.947.072 15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Instagram
            </span>
        </label>
        <div style="position:relative">
            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:13px;color:#9ca3af;pointer-events:none">@</span>
            <input type="text" name="sosmed_instagram"
                value="<?php echo e(old('sosmed_instagram')); ?>"
                placeholder="username"
                class="tf-input" style="padding-left:28px">
        </div>
    </div>

    <div class="tf-field">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#000"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                X / Twitter
            </span>
        </label>
        <div style="position:relative">
            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:13px;color:#9ca3af;pointer-events:none">@</span>
            <input type="text" name="sosmed_twitter"
                value="<?php echo e(old('sosmed_twitter')); ?>"
                placeholder="username"
                class="tf-input" style="padding-left:28px">
        </div>
    </div>

    <div class="tf-field">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#0A66C2"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                LinkedIn
            </span>
        </label>
        <input type="url" name="sosmed_linkedin"
            value="<?php echo e(old('sosmed_linkedin')); ?>"
            placeholder="https://linkedin.com/in/username"
            class="tf-input">
    </div>

    <div class="tf-field">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#FF0000"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                YouTube
            </span>
        </label>
        <input type="url" name="sosmed_youtube"
            value="<?php echo e(old('sosmed_youtube')); ?>"
            placeholder="https://youtube.com/@channel"
            class="tf-input">
    </div>

    <div class="tf-field" style="margin-bottom:0">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Facebook
            </span>
        </label>
        <input type="url" name="sosmed_facebook"
            value="<?php echo e(old('sosmed_facebook')); ?>"
            placeholder="https://facebook.com/username"
            class="tf-input">
    </div>
</div>


<div class="tf-card">
    <div class="tf-card__header">Bidang Spesialisasi / Keahlian</div>
    <p style="font-size:12px;color:#6b7280;margin-bottom:14px">
        Pilih dari daftar atau ketik untuk menambah bidang kustom. Minimal <strong>1 bidang</strong>.
    </p>

    
    <div class="tf-chips" id="preset-chips-mentor">
        <?php
            $presetsM = [
                'Manajemen Bisnis UMKM', 'Pemasaran Digital', 'Keuangan & Pembukuan',
                'Pengembangan Produk', 'Packaging & Branding', 'Ekspor & Perdagangan',
                'Perizinan & Legalitas', 'Akses Pembiayaan', 'E-commerce & Marketplace',
                'Produksi & Operasional', 'SDM & Organisasi', 'Kewirausahaan Sosial',
                'Kuliner & F&B', 'Fashion & Kerajinan', 'Teknologi untuk UMKM',
            ];
            $savedSpesialisasi = old('bidang_spesialisasi', '');
            $savedSArr = $savedSpesialisasi ? array_map('trim', explode(',', $savedSpesialisasi)) : [];
        ?>
        <?php $__currentLoopData = $presetsM; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                class="tf-chip <?php echo e(in_array($preset, $savedSArr) ? 'tf-chip--active' : ''); ?>"
                onclick="toggleChipMentor(this)"
            ><?php echo e($preset); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="tf-keahlian-add">
        <input
            type="text"
            id="custom-spesialisasi-input"
            placeholder="Ketik bidang spesialisasi lain..."
            class="tf-input"
            style="flex:1"
            maxlength="60"
            onkeydown="if(event.key==='Enter'){event.preventDefault();addCustomSpesialisasi();}"
        >
        <button type="button" class="tf-add-btn" onclick="addCustomSpesialisasi()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah
        </button>
    </div>

    
    <div class="tf-selected-tags" id="selected-tags-mentor">
        <?php $__currentLoopData = $savedSArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!in_array($item, $presetsM) && $item !== ''): ?>
                <span class="tf-tag tf-tag--custom">
                    <?php echo e($item); ?>

                    <button type="button" onclick="removeTagMentor(this, '<?php echo e($item); ?>')" class="tf-tag__remove">×</button>
                </span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <p class="tf-hint" style="margin-top:8px">
        <span id="spesialisasi-count"><?php echo e(count($savedSArr)); ?></span> bidang dipilih
    </p>

    
    <input type="hidden" name="bidang_spesialisasi" id="bidang-spesialisasi-value" value="<?php echo e($savedSpesialisasi); ?>">
</div>

            
            <div class="tf-card">
                <div class="tf-card__header">Alamat Domisili</div>

                <div class="tf-field">
                    <label class="tf-label">Lokasi Tinggal (Sesuai Google Maps) <span class="tf-req">*</span></label>
                    <input
                        type="text"
                        name="gmaps_location"
                        id="gmaps_location"
                        value="<?php echo e(old('gmaps_location')); ?>"
                        placeholder="Jl. Raya Darmo No.1, RT 03/RW 05, Wonokromo, Surabaya 60241"
                        class="tf-input"
                        required
                    >
                    <p class="tf-hint">* Wajib sertakan RT/RW dan kode pos</p>
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Provinsi <span class="tf-req">*</span></label>
                        <select name="provinsi" id="provinsi" class="tf-select" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kabupaten / Kota <span class="tf-req">*</span></label>
                        <select name="kabupaten" id="kabupaten" class="tf-select" required disabled>
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kecamatan <span class="tf-req">*</span></label>
                        <select name="kecamatan" id="kecamatan" class="tf-select" required disabled>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Desa / Kelurahan <span class="tf-req">*</span></label>
                        <select name="kelurahan" id="kelurahan" class="tf-select" required disabled>
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
                    </div>
                </div>

                
                <div class="tf-field">
                    <label class="tf-label">
                        Titik Lokasi di Peta <span class="tf-req">*</span>
                    </label>
                    <p class="tf-hint" style="margin-bottom:8px">
                        Peta akan otomatis mengarah ke lokasi Anda setelah <strong>Desa/Kelurahan</strong> dipilih.
                        Anda juga bisa klik atau geser marker untuk menyesuaikan titik secara manual.
                    </p>

                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css"/>
                    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>

                    <div style="position:relative;">
                        <div id="map-picker-mentor" style="height:280px;border-radius:10px;border:1.5px solid #d1d5db;overflow:hidden;"></div>
                        <div id="map-mentor-loading" style="display:none;position:absolute;inset:0;background:rgba(255,255,255,0.75);border-radius:10px;z-index:1000;align-items:center;justify-content:center;flex-direction:column;gap:8px;">
                            <div style="width:28px;height:28px;border:3px solid #a7d8be;border-top-color:#0f6e56;border-radius:50%;animation:tf-spin 0.8s linear infinite;"></div>
                            <span style="font-size:12px;color:#666;">Mencari lokasi...</span>
                        </div>
                    </div>

                    <p id="map-picker-hint-mentor" class="tf-hint" style="margin-top:6px">
                        📍 Pilih Desa/Kelurahan terlebih dahulu agar peta otomatis mengarah ke lokasi Anda.
                    </p>
                    <input type="hidden" name="lat" id="lat-mentor" value="<?php echo e(old('lat')); ?>" required>
                    <input type="hidden" name="lng" id="lng-mentor" value="<?php echo e(old('lng')); ?>" required>
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Tentang Diri</div>

                <div class="tf-field">
                    <label class="tf-label">Bio / Tentang Diri Anda <span class="tf-req">*</span></label>
                    <textarea
                        name="bio"
                        rows="4"
                        placeholder="Ceritakan latar belakang, keahlian, dan motivasi Anda menjadi mentor UMKM..."
                        class="tf-textarea"
                        required
                    ><?php echo e(old('bio')); ?></textarea>
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Upload Dokumen</div>

                <div class="tf-grid-2">
                    
                    <div class="tf-field">
                        <label class="tf-label">Pas Foto Background Putih <span class="tf-req">*</span></label>
                        <div class="tf-upload" onclick="triggerFile('file-pasfoto')" role="button" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="tf-upload__label" id="label-pasfoto">Tambahkan file</span>
                            <span class="tf-upload__hint">JPG, PNG · Maks 2 MB</span>
                        </div>
                        <input type="file" name="white_bg_photo" id="file-pasfoto" class="tf-file-hidden" accept="image/*" required onchange="updateUploadLabel(this,'label-pasfoto')">
                    </div>

                    
                    <div class="tf-field">
                        <label class="tf-label">Scan KTP <span class="tf-req">*</span></label>
                        <div class="tf-upload" onclick="triggerFile('file-ktp')" role="button" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                            </svg>
                            <span class="tf-upload__label" id="label-ktp">Tambahkan file</span>
                            <span class="tf-upload__hint">JPG, PNG, PDF · Maks 2 MB</span>
                        </div>
                        <input type="file" name="ktp_scan" id="file-ktp" class="tf-file-hidden" accept="image/*,.pdf" required onchange="updateUploadLabel(this,'label-ktp')">
                    </div>
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Biaya Pendaftaran</div>

                <p class="tf-biaya-desc">
                    Transfer biaya pendaftaran sebesar <strong>Rp100.000</strong> ke rekening berikut, lalu unggah bukti transfer.
                </p>

                <div class="tf-rekening">
                    <div class="tf-rek-row">
                        <span class="tf-rek-label">Bank</span>
                        <span class="tf-rek-val">BNI</span>
                    </div>
                    <div class="tf-rek-row">
                        <span class="tf-rek-label">Atas Nama</span>
                        <span class="tf-rek-val">ARI PRABOWO</span>
                    </div>
                    <div class="tf-rek-row">
                        <span class="tf-rek-label">No. Rekening</span>
                        <span class="tf-rek-val" id="nomor-rek">873873298</span>
                        <button type="button" class="tf-copy-btn" onclick="copyRekening()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <span id="copy-label">Salin</span>
                        </button>
                    </div>
                </div>

                <div class="tf-field" style="margin-top:14px">
                    <label class="tf-label">Bukti Transfer <span class="tf-req">*</span></label>
                    <div class="tf-upload tf-upload--wide" onclick="triggerFile('file-transfer')" role="button" tabindex="0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                        </svg>
                        <div>
                            <span class="tf-upload__label" id="label-transfer">Tambahkan file</span>
                            <span class="tf-upload__hint" style="display:block">JPG, PNG, PDF · Maks 2 MB</span>
                        </div>
                    </div>
                    <input type="file" name="bukti_transfer" id="file-transfer" class="tf-file-hidden" accept="image/*,.pdf" required onchange="updateUploadLabel(this,'label-transfer')">
                </div>
            </div>

            
            <div class="tf-agree">
                <input
                    type="checkbox"
                    name="agree_terms"
                    id="agree_terms"
                    value="1"
                    required
                    class="tf-agree__check"
                >
                <label for="agree_terms" class="tf-agree__label">
                    Saya setuju dengan
                    <a href="https://kajiindonesia.com/" target="_blank" rel="noopener">Syarat dan Ketentuan</a>
                    serta
                    <a href="https://kajiindonesia.com/" target="_blank" rel="noopener">Kebijakan Privasi</a>
                    yang berlaku di <strong>KAJI Indonesia</strong>.
                </label>
            </div>

            
            <button type="submit" class="tf-submit">
                Kirim Pendaftaran Mentor
            </button>

            <p class="tf-footer-note">
                * Pendaftaran akan ditinjau oleh Admin sebelum ditampilkan di halaman Mentor.
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

/* Rekening */
.tf-biaya-desc { font-size: 13px; color: #4b5563; line-height: 1.6; margin-bottom: 12px; }
.tf-biaya-desc strong { color: #111827; }
.tf-rekening { border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden; }
.tf-rek-row {
    display: flex;
    align-items: center;
    padding: 9px 14px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 13px;
    gap: 8px;
}
.tf-rek-row:last-child { border-bottom: none; }
.tf-rek-label { color: #6b7280; font-size: 12px; width: 90px; flex-shrink: 0; }
.tf-rek-val { font-weight: 600; color: #111827; flex: 1; letter-spacing: .02em; }
.tf-copy-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 600;
    color: #0f6e56;
    background: #e6f4ee;
    border: 1px solid #a7d8be;
    border-radius: 6px;
    cursor: pointer;
    transition: background .15s;
    white-space: nowrap;
}
.tf-copy-btn:hover { background: #c3e9d7; }

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

/* ---- Chips ---- */
.tf-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-bottom: 12px;
}
.tf-chip {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    border: 1.5px solid #d1d5db;
    background: #f9fafb;
    color: #4b5563;
    cursor: pointer;
    transition: all .15s;
    font-family: inherit;
    line-height: 1.4;
}
.tf-chip:hover:not(:disabled) { border-color: #0f6e56; color: #0f6e56; background: #f0faf6; }
.tf-chip--active { background: #0f6e56; border-color: #0f6e56; color: #fff; }
.tf-chip--active:hover:not(:disabled) { background: #085041; border-color: #085041; color: #fff; }

/* ---- Custom input row ---- */
.tf-keahlian-add {
    display: flex;
    gap: 8px;
    margin-bottom: 10px;
    align-items: center;
}
.tf-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 9px 14px;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    background: #0f6e56;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    white-space: nowrap;
    font-family: inherit;
    transition: background .15s;
    flex-shrink: 0;
}
.tf-add-btn:hover { background: #085041; }

/* ---- Selected tags ---- */
.tf-selected-tags { display: flex; flex-wrap: wrap; gap: 6px; min-height: 0; }
.tf-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}
.tf-tag--custom { background: #ede9fe; color: #5b21b6; border: 1.5px solid #c4b5fd; }
.tf-tag__remove {
    background: none; border: none; cursor: pointer;
    font-size: 15px; line-height: 1; color: inherit;
    padding: 0; margin-left: 2px; opacity: .7; font-family: inherit;
}
.tf-tag__remove:hover { opacity: 1; }

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

/* ======================== SPESIALISASI MENTOR ======================== */
function getSpesialisasiArray() {
    const val = document.getElementById('bidang-spesialisasi-value').value;
    return val ? val.split(',').map(s => s.trim()).filter(Boolean) : [];
}
function setSpesialisasiValue(arr) {
    document.getElementById('bidang-spesialisasi-value').value = arr.join(',');
    const counter = document.getElementById('spesialisasi-count');
    if (counter) counter.textContent = arr.length;
}
function toggleChipMentor(btn) {
    const label = btn.textContent.trim();
    let arr = getSpesialisasiArray();
    if (btn.classList.contains('tf-chip--active')) {
        btn.classList.remove('tf-chip--active');
        arr = arr.filter(v => v !== label);
    } else {
        btn.classList.add('tf-chip--active');
        if (!arr.includes(label)) arr.push(label);
    }
    setSpesialisasiValue(arr);
}
function addCustomSpesialisasi() {
    const input = document.getElementById('custom-spesialisasi-input');
    const label = input.value.trim();
    if (!label) return;
    let arr = getSpesialisasiArray();
    if (arr.includes(label)) { input.value = ''; return; }
    arr.push(label);
    setSpesialisasiValue(arr);
    const container = document.getElementById('selected-tags-mentor');
    const tag = document.createElement('span');
    tag.className = 'tf-tag tf-tag--custom';
    tag.dataset.value = label;
    tag.innerHTML = `${label} <button type="button" onclick="removeTagMentor(this,'${label.replace(/'/g,"\\'")}') " class="tf-tag__remove">×</button>`;
    container.appendChild(tag);
    input.value = '';
    input.focus();
}
function removeTagMentor(btn, label) {
    btn.closest('.tf-tag').remove();
    let arr = getSpesialisasiArray();
    arr = arr.filter(v => v !== label);
    setSpesialisasiValue(arr);
}

/* ======================== VALIDASI SUBMIT MENTOR ======================== */
document.querySelector('form').addEventListener('submit', function (e) {
    // Cek sosmed — minimal 1
    const sosmedFields = ['sosmed_instagram','sosmed_twitter','sosmed_linkedin','sosmed_youtube','sosmed_facebook'];
    const filledSosmed = sosmedFields.some(name => {
        const el = this.querySelector(`[name="${name}"]`);
        return el && el.value.trim() !== '';
    });
    if (!filledSosmed) {
        e.preventDefault();
        let banner = document.getElementById('sosmed-error-mentor');
        if (!banner) {
            banner = document.createElement('div');
            banner.id = 'sosmed-error-mentor';
            banner.className = 'tf-banner tf-banner--rejected';
            banner.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <div>
                    <p class="tf-banner__title">Sosial Media Wajib Diisi</p>
                    <p class="tf-banner__body">Isi minimal satu akun sosial media.</p>
                </div>`;
            const sosmedCard = document.getElementById('bidang-spesialisasi-value').closest('.tf-card').previousElementSibling;
            sosmedCard.prepend(banner);
        }
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    // Cek spesialisasi — minimal 1
    const spesVal = document.getElementById('bidang-spesialisasi-value').value.trim();
    if (!spesVal) {
        e.preventDefault();
        const oldB = document.getElementById('spesialisasi-error');
        if (oldB) oldB.remove();
        const banner = document.createElement('div');
        banner.id = 'spesialisasi-error';
        banner.className = 'tf-banner tf-banner--rejected';
        banner.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <div>
                <p class="tf-banner__title">Bidang Spesialisasi Wajib Diisi</p>
                <p class="tf-banner__body">Pilih atau tambahkan minimal <strong>1 bidang spesialisasi</strong>.</p>
            </div>`;
        const spesCard = document.getElementById('bidang-spesialisasi-value').closest('.tf-card');
        spesCard.prepend(banner);
        spesCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

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

function copyRekening() {
    const noRek = document.getElementById('nomor-rek').textContent.trim();
    const label = document.getElementById('copy-label');
    const done  = () => { label.textContent = '✓ Tersalin!'; setTimeout(() => { label.textContent = 'Salin'; }, 2000); };
    if (navigator.clipboard) {
        navigator.clipboard.writeText(noRek).then(done);
    } else {
        const el = document.createElement('textarea');
        el.value = noRek; document.body.appendChild(el); el.select();
        document.execCommand('copy'); document.body.removeChild(el); done();
    }
}

/* ======================== PETA + GEOCODE ======================== */
(function () {
    var map         = L.map('map-picker-mentor').setView([-2.5, 118], 5);
    var marker      = null;
    var debTimer    = null;
    var isGeocoding = false;
    var hintEl      = document.getElementById('map-picker-hint-mentor');
    var loadEl      = document.getElementById('map-mentor-loading');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);

    var oldLat = document.getElementById('lat-mentor').value;
    var oldLng = document.getElementById('lng-mentor').value;
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
        document.getElementById('lat-mentor').value = lat;
        document.getElementById('lng-mentor').value = lng;
        hintEl.textContent = '✅ ' + lat.toFixed(6) + ', ' + lng.toFixed(6) + ' — Geser marker untuk menyesuaikan.';
        hintEl.style.color = '#16a34a';
    }

    map.on('click', function (e) { setMarker(e.latlng.lat, e.latlng.lng, false); });

    function selText(id) {
        var el = document.getElementById(id);
        if (!el || !el.value) return '';
        return el.options[el.selectedIndex].text;
    }

    window.mentorGeocode = function () {
        clearTimeout(debTimer);
        debTimer = setTimeout(doGeocode, 600);
    };

    function doGeocode() {
        if (isGeocoding) return;
        var alamat   = (document.getElementById('gmaps_location') || {}).value || '';
        var kelVal   = (document.getElementById('kelurahan') || {}).value || '';
        var kelText  = selText('kelurahan');
        var kecText  = selText('kecamatan');
        var kabText  = selText('kabupaten');
        var provText = selText('provinsi');
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
            .catch(function (err) {
                loadEl.style.display = 'none';
                isGeocoding = false;
                hintEl.textContent = '⚠️ Gagal terhubung ke layanan peta. Klik titik di peta secara manual.';
                hintEl.style.color = '#b45309';
            });
    }
})();

/* ======================== WILAYAH API ======================== */
(function () {
    var BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';
    var elProv = document.getElementById('provinsi');
    var elKab  = document.getElementById('kabupaten');
    var elKec  = document.getElementById('kecamatan');
    var elKel  = document.getElementById('kelurahan');

    function resetSelect(el, label) {
        el.innerHTML = '<option value="">' + label + '</option>';
        el.disabled = true;
    }

    fetch(BASE + '/provinces.json')
        .then(function (r) { return r.json(); })
        .then(function (data) {
            data.forEach(function (p) {
                var o = document.createElement('option');
                o.value = p.name; o.dataset.id = p.id; o.textContent = p.name;
                elProv.appendChild(o);
            });
        });

    elProv.addEventListener('change', function () {
        resetSelect(elKab, 'Pilih Kabupaten/Kota');
        resetSelect(elKec, 'Pilih Kecamatan');
        resetSelect(elKel, 'Pilih Desa/Kelurahan');
        if (!this.value) return;
        var provId = this.options[this.selectedIndex].dataset.id;
        fetch(BASE + '/regencies/' + provId + '.json')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                data.forEach(function (k) {
                    var o = document.createElement('option');
                    o.value = k.name; o.dataset.id = k.id; o.textContent = k.name;
                    elKab.appendChild(o);
                });
                elKab.disabled = false;
            });
    });

    elKab.addEventListener('change', function () {
        resetSelect(elKec, 'Pilih Kecamatan');
        resetSelect(elKel, 'Pilih Desa/Kelurahan');
        if (!this.value) return;
        var kabId = this.options[this.selectedIndex].dataset.id;
        fetch(BASE + '/districts/' + kabId + '.json')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                data.forEach(function (k) {
                    var o = document.createElement('option');
                    o.value = k.name; o.dataset.id = k.id; o.textContent = k.name;
                    elKec.appendChild(o);
                });
                elKec.disabled = false;
            });
    });

    elKec.addEventListener('change', function () {
        resetSelect(elKel, 'Pilih Desa/Kelurahan');
        if (!this.value) return;
        var kecId = this.options[this.selectedIndex].dataset.id;
        fetch(BASE + '/villages/' + kecId + '.json')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                data.forEach(function (k) {
                    var o = document.createElement('option');
                    o.value = k.name; o.dataset.id = k.id; o.textContent = k.name;
                    elKel.appendChild(o);
                });
                elKel.disabled = false;
            });
    });

    elKel.addEventListener('change', function () {
        if (!this.value) return;
        if (typeof window.mentorGeocode === 'function') window.mentorGeocode();
    });

    var inputLokasi = document.getElementById('gmaps_location');
    if (inputLokasi) {
        inputLokasi.addEventListener('input', function () {
            var kelVal = (document.getElementById('kelurahan') || {}).value || '';
            if (kelVal) window.mentorGeocode();
        });
    }
})();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/profile/daftar-mentor.blade.php ENDPATH**/ ?>