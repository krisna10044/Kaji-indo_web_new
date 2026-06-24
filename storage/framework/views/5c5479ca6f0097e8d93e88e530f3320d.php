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
            <h1>Formulir Pendaftaran Trainer</h1>
            <p>Lengkapi data di bawah ini dengan benar untuk ditinjau oleh Admin.</p>
        </div>

        
        <?php if($trainer?->status === 'pending'): ?>
            <div class="tf-banner tf-banner--pending">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="tf-banner__title">Pendaftaran Sedang Ditinjau</p>
                    <p class="tf-banner__body">Data kamu sudah diterima dan sedang dalam proses review oleh Admin. Kamu tidak bisa mengubah data saat ini.</p>
                </div>
            </div>
        <?php elseif($trainer?->status === 'rejected'): ?>
            <div class="tf-banner tf-banner--rejected">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="tf-banner__title">Pendaftaran Ditolak</p>
                    <?php if($trainer->rejection_reason): ?>
                        <p class="tf-banner__body">Alasan: <strong><?php echo e($trainer->rejection_reason); ?></strong></p>
                    <?php endif; ?>
                    <p class="tf-banner__body" style="color:#dc2626">Silakan perbaiki data di bawah dan kirim ulang.</p>
                </div>
            </div>
        <?php endif; ?>

        
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
    action="<?php echo e(route('profile.simpan-trainer')); ?>"
    method="POST"
    enctype="multipart/form-data"
    novalidate
    <?php if($trainer && $trainer->status === 'pending'): ?> onsubmit="return false;" <?php endif; ?>
>
            <?php echo csrf_field(); ?>

            
            <div class="tf-card">
                <div class="tf-card__header">Data Diri</div>

                <div class="tf-field">
                <label class="tf-label">Nama Lengkap & Gelar Akademik <span class="tf-req">*</span></label>
<input
    type="text"
    name="academic_degree"
    value="<?php echo e(old('academic_degree', $trainer?->academic_degree ?? $user->name)); ?>"
    placeholder="Contoh: <?php echo e($user->name); ?>, S.E., M.M."
                        class="tf-input"
                        required
                        <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                    >
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">No. WhatsApp <span class="tf-req">*</span></label>
                        <input
                            type="text"
                            name="no_hp"
                            value="<?php echo e(old('no_hp', $trainer?->no_hp ?? $user->phone)); ?>"
                            class="tf-input"
                            required
                            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                        >
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Email Aktif <span class="tf-req">*</span></label>
                        <input
                            type="email"
                            name="email"
                            value="<?php echo e(old('email', $trainer?->email ?? $user->email)); ?>"
                            class="tf-input"
                            required
                            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                        >
                    </div>
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Nomor NIK/KTP <span class="tf-req">*</span></label>
                        <input
    type="text"
    name="nik"
    value="<?php echo e(old('nik', $trainer?->nik)); ?>"
    class="tf-input"
    required
    maxlength="16"
    minlength="16"
    pattern="\d{16}"
    inputmode="numeric"
    placeholder="16 digit angka"
    <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
    oninput="updateNikCounter(this)"
>
<p class="tf-hint" id="nik-counter">0 / 16 digit</p>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">
                            NPWP
                            <span class="tf-label--optional">(Opsional)</span>
                        </label>
                        <input
                            type="text"
                            name="npwp"
                            value="<?php echo e(old('npwp', $trainer?->npwp)); ?>"
                            class="tf-input"
                            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                        >
                    </div>
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Alamat Domisili</div>

                <div class="tf-field">
                    <label class="tf-label">Alamat Domisili Sekarang <span class="tf-req">*</span></label>
                    <input
                        type="text"
                        name="gmaps_location"
                        value="<?php echo e(old('gmaps_location', $trainer?->gmaps_location)); ?>"
                        placeholder="Jl. Raya Darmo No.1, RT 03/RW 05, Wonokromo, Surabaya 60241"
                        class="tf-input"
                        required
                        <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                    >
                    <p class="tf-hint">* Wajib sertakan RT/RW dan kode pos</p>
                </div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Provinsi <span class="tf-req">*</span></label>
                        <select
                            name="provinsi"
                            id="provinsi"
                            data-selected="<?php echo e(old('provinsi', $trainer?->provinsi)); ?>"
                            class="tf-select"
                            required
                            <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                        >
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kabupaten / Kota <span class="tf-req">*</span></label>
                        <select
                            name="kabupaten"
                            id="kabupaten"
                            data-selected="<?php echo e(old('kabupaten', $trainer?->kabupaten)); ?>"
                            class="tf-select"
                            required
                            disabled
                        >
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Kecamatan <span class="tf-req">*</span></label>
                        <select
                            name="kecamatan"
                            id="kecamatan"
                            data-selected="<?php echo e(old('kecamatan', $trainer?->kecamatan)); ?>"
                            class="tf-select"
                            required
                            disabled
                        >
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Desa / Kelurahan <span class="tf-req">*</span></label>
                        <select
                            name="kelurahan"
                            id="kelurahan"
                            data-selected="<?php echo e(old('kelurahan', $trainer?->kelurahan)); ?>"
                            class="tf-select"
                            required
                            disabled
                        >
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
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
            value="<?php echo e(old('sosmed_instagram', $sosmedData['instagram'] ?? '')); ?>"
                placeholder="username"
                class="tf-input" style="padding-left:28px"
                <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>>
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
                value="<?php echo e(old('sosmed_twitter', $sosmedData['twitter'] ?? '')); ?>"
                placeholder="username"
                class="tf-input" style="padding-left:28px"
                <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>>
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
            value="<?php echo e(old('sosmed_linkedin', $sosmedData['linkedin'] ?? '')); ?>" 
            placeholder="https://linkedin.com/in/username"
            class="tf-input"
            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>>
    </div>

    <div class="tf-field">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#FF0000"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                YouTube
            </span>
        </label>
        <input type="url" name="sosmed_youtube"
            value="<?php echo e(old('sosmed_youtube', $sosmedData['youtube'] ?? '')); ?>"
            placeholder="https://youtube.com/@channel"
            class="tf-input"
            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>>
    </div>

    <div class="tf-field" style="margin-bottom:0">
        <label class="tf-label">
            <span style="display:inline-flex;align-items:center;gap:6px">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Facebook
            </span>
        </label>
        <input type="url" name="sosmed_facebook"
            value="<?php echo e(old('sosmed_facebook', $sosmedData['facebook'] ?? '')); ?>" 
            placeholder="https://facebook.com/username"
            class="tf-input"
            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>>
    </div>
</div>

            
            <div class="tf-card">
                <div class="tf-card__header">Kualifikasi</div>

                <div class="tf-grid-2">
                    <div class="tf-field">
                        <label class="tf-label">Ijazah Terakhir <span class="tf-req">*</span></label>
                        <?php $selectedIjazah = old('ijazah_type', $trainer?->ijazah_type) ?>
                        <select
                            name="ijazah_type"
                            class="tf-select"
                            required
                            <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                        >
                            <option value="SMA" <?php echo e($selectedIjazah == 'SMA' ? 'selected' : ''); ?>>SMA/SMK Sederajat</option>
                            <option value="D3"  <?php echo e($selectedIjazah == 'D3'  ? 'selected' : ''); ?>>D3</option>
                            <option value="S1"  <?php echo e($selectedIjazah == 'S1'  ? 'selected' : ''); ?>>S1</option>
                            <option value="S2"  <?php echo e($selectedIjazah == 'S2'  ? 'selected' : ''); ?>>S2</option>
                            <option value="S3"  <?php echo e($selectedIjazah == 'S3'  ? 'selected' : ''); ?>>S3</option>
                        </select>
                    </div>
                    <div class="tf-field">
                        <label class="tf-label">Link Drive Dokumentasi <span class="tf-req">*</span></label>
                        <input
                            type="url"
                            name="drive_link_documentation"
                            value="<?php echo e(old('drive_link_documentation', $trainer?->drive_link_documentation)); ?>"
                            placeholder="https://drive.google.com/..."
                            class="tf-input"
                            required
                            <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                        >
                    </div>
                </div>

                <div class="tf-field">
                    <label class="tf-label">Pengalaman Sebagai Trainer <span class="tf-req">*</span></label>
                    <textarea
                        name="experience"
                        rows="3"
                        placeholder="Berapa lama dan di bidang apa Anda menjadi Trainer..."
                        class="tf-textarea"
                        required
                        <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                    ><?php echo e(old('experience', $trainer?->experience)); ?></textarea>
                </div>

                <div class="tf-field">
                    <label class="tf-label">Tentang Diri Anda <span class="tf-req">*</span></label>
                    <textarea
                        name="bio"
                        rows="3"
                        placeholder="Deskripsi singkat tentang diri Anda..."
                        class="tf-textarea"
                        required
                        <?php if($trainer?->status === 'pending'): ?> readonly <?php endif; ?>
                    ><?php echo e(old('bio', $trainer?->bio)); ?></textarea>
                </div>
            </div>

            
<div class="tf-card">
    <div class="tf-card__header">Bidang Keahlian / Spesialisasi</div>
    <p style="font-size:12px;color:#6b7280;margin-bottom:14px">
        Pilih dari daftar atau ketik untuk menambah bidang keahlian kustom. Minimal <strong>1 bidang</strong>.
    </p>

    
    <div class="tf-chips" id="preset-chips">
        <?php
            $presets = [
                'Leadership & Manajemen', 'Public Speaking', 'Digital Marketing',
                'Keuangan & Akuntansi', 'SDM & HRD', 'Kewirausahaan',
                'Penjualan & Negosiasi', 'Komunikasi Bisnis', 'Pengembangan Diri',
                'Produktivitas & Time Management', 'Teknologi Informasi', 'Hukum Bisnis',
                'K3 & Safety', 'Ekspor Impor', 'Pemasaran Konten',
            ];
            $savedKeahlian = old('bidang_keahlian', $trainer?->keahlian ?? '');
            $savedArr = $savedKeahlian ? array_map('trim', explode(',', $savedKeahlian)) : [];
        ?>
        <?php $__currentLoopData = $presets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                class="tf-chip <?php echo e(in_array($preset, $savedArr) ? 'tf-chip--active' : ''); ?>"
                onclick="toggleChip(this)"
                <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
            ><?php echo e($preset); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if(!($trainer?->status === 'pending')): ?>
    <div class="tf-keahlian-add">
        <input
            type="text"
            id="custom-keahlian-input"
            placeholder="Ketik bidang keahlian lain..."
            class="tf-input"
            style="flex:1"
            maxlength="60"
            onkeydown="if(event.key==='Enter'){event.preventDefault();addCustomKeahlian();}"
        >
        <button type="button" class="tf-add-btn" onclick="addCustomKeahlian()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah
        </button>
    </div>
    <?php endif; ?>

    
    <div class="tf-selected-tags" id="selected-tags">
        <?php $__currentLoopData = $savedArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!in_array($item, $presets) && $item !== ''): ?>
                <span class="tf-tag tf-tag--custom">
                    <?php echo e($item); ?>

                    <?php if(!($trainer?->status === 'pending')): ?>
                        <button type="button" onclick="removeTag(this, '<?php echo e($item); ?>')" class="tf-tag__remove">×</button>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <p class="tf-hint" id="keahlian-counter" style="margin-top:8px">
        <span id="keahlian-count"><?php echo e(count($savedArr)); ?></span> bidang dipilih
    </p>

    
    <input type="hidden" name="bidang_keahlian" id="bidang-keahlian-value" value="<?php echo e($savedKeahlian); ?>">
</div>

            
            <div class="tf-card">
                <div class="tf-card__header">Upload Dokumen</div>

                <div class="tf-grid-2">

                    
                    <div class="tf-field">
                        <label class="tf-label">Scan KTP <span class="tf-req">*</span></label>
                        <div class="tf-upload" onclick="triggerFile('file-ktp')" role="button" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                            </svg>
                            <span class="tf-upload__label" id="label-ktp">
                                <?php if($trainer?->ktp_scan): ?>
                                    <span class="tf-upload__existing">✓ Sudah diupload</span><br>Ganti file
                                <?php else: ?>
                                    Tambahkan file
                                <?php endif; ?>
                            </span>
                            <span class="tf-upload__hint">JPG, PNG, PDF · Maks 2 MB</span>
                        </div>
                        <input
                            type="file"
                            name="ktp_scan"
                            id="file-ktp"
                            class="tf-file-hidden"
                            accept="image/*,.pdf"
                            <?php echo e(!$trainer?->ktp_scan ? 'required' : ''); ?>

                            onchange="updateUploadLabel(this, 'label-ktp')"
                            <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                        >
                    </div>

                    
                    <div class="tf-field">
                        <label class="tf-label">Sertifikat BNSP <span class="tf-req">*</span></label>
                        <div class="tf-upload" onclick="triggerFile('file-bnsp')" role="button" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <span class="tf-upload__label" id="label-bnsp">
                                <?php if($trainer?->bnsp_certificate): ?>
                                    <span class="tf-upload__existing">✓ Sudah diupload</span><br>Ganti file
                                <?php else: ?>
                                    Tambahkan file
                                <?php endif; ?>
                            </span>
                            <span class="tf-upload__hint">JPG, PNG, PDF · Maks 2 MB</span>
                        </div>
                        <input
                            type="file"
                            name="bnsp_certificate"
                            id="file-bnsp"
                            class="tf-file-hidden"
                            accept="image/*,.pdf"
                            <?php echo e(!$trainer?->bnsp_certificate ? 'required' : ''); ?>

                            onchange="updateUploadLabel(this, 'label-bnsp')"
                            <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                        >
                    </div>
                </div>

                
                <div class="tf-field">
                    <label class="tf-label">Pas Foto Background Putih <span class="tf-req">*</span></label>
                    <div class="tf-upload tf-upload--wide" onclick="triggerFile('file-pasfoto')" role="button" tabindex="0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <div>
                            <span class="tf-upload__label" id="label-pasfoto">
                                <?php if($trainer?->white_bg_photo): ?>
                                    <span class="tf-upload__existing">✓ Sudah diupload</span>&nbsp; Ganti file
                                <?php else: ?>
                                    Tambahkan file
                                <?php endif; ?>
                            </span>
                            <span class="tf-upload__hint" style="display:block">JPG, PNG · Maks 2 MB</span>
                        </div>
                    </div>
                    <input
                        type="file"
                        name="white_bg_photo"
                        id="file-pasfoto"
                        class="tf-file-hidden"
                        accept="image/*"
                        <?php echo e(!$trainer?->white_bg_photo ? 'required' : ''); ?>

                        onchange="updateUploadLabel(this, 'label-pasfoto')"
                        <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                    >
                </div>
            </div>

            
            <div class="tf-card">
                <div class="tf-card__header">Biaya Pendaftaran</div>

                <p class="tf-biaya-desc">
                    Transfer biaya pendaftaran sebesar <strong>Rp200.000</strong> ke rekening berikut, lalu unggah bukti transfer.
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
                            <span class="tf-upload__label" id="label-transfer">
                                <?php if($trainer?->bukti_transfer): ?>
                                    <span class="tf-upload__existing">✓ Sudah diupload</span>&nbsp; Ganti file
                                <?php else: ?>
                                    Tambahkan file
                                <?php endif; ?>
                            </span>
                            <span class="tf-upload__hint" style="display:block">JPG, PNG, PDF · Maks 2 MB</span>
                        </div>
                    </div>
                    <input
                        type="file"
                        name="bukti_transfer"
                        id="file-transfer"
                        class="tf-file-hidden"
                        accept="image/*,.pdf"
                        <?php echo e(!$trainer?->bukti_transfer ? 'required' : ''); ?>

                        onchange="updateUploadLabel(this, 'label-transfer')"
                        <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                    >
                </div>
            </div>

            
            <div class="tf-agree">
                <input
                    type="checkbox"
                    name="agree_terms"
                    id="agree_terms"
                    value="1"
                    <?php echo e($trainer?->agree_terms ? 'checked' : 'required'); ?>

                    class="tf-agree__check"
                    <?php if($trainer?->status === 'pending'): ?> disabled <?php endif; ?>
                >
                <label for="agree_terms" class="tf-agree__label">
                    Saya setuju dengan
                    <a href="https://kajiindonesia.com/" target="_blank" rel="noopener">Syarat dan Ketentuan</a>
                    serta
                    <a href="https://kajiindonesia.com/" target="_blank" rel="noopener">Kebijakan Privasi</a>
                    yang berlaku di <strong>KAJI Indonesia</strong>.
                </label>
            </div>

            
            <?php if($trainer?->status === 'pending'): ?>
                <button type="button" class="tf-submit tf-submit--disabled" disabled>
                    Menunggu Verifikasi Admin...
                </button>
            <?php else: ?>
                <button type="submit" class="tf-submit">
                    <?php echo e($trainer?->status === 'rejected' ? 'Kirim Ulang Persyaratan' : 'Kirim Seluruh Persyaratan'); ?>

                </button>
            <?php endif; ?>

            <p class="tf-footer-note">
                * Pendaftaran akan ditinjau oleh Admin sebelum ditampilkan di halaman Trainer.
            </p>

        </form>
    </div>
</div>


<style>
/* ---- Reset & Base ---- */
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

/* ---- Back Link ---- */
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

/* ---- Hero ---- */
.tf-hero {
    background: #0f6e56;
    border-radius: 14px;
    padding: 22px 20px;
    text-align: center;
    color: #fff;
    margin-bottom: 10px;
}
.tf-hero h1 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 5px;
}
.tf-hero p {
    font-size: 13px;
    color: #a9d9c6;
    line-height: 1.5;
}

/* ---- Banner ---- */
.tf-banner {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 12px 14px;
    border-radius: 0 10px 10px 0;
    margin-bottom: 10px;
    border-left: 3px solid;
}
.tf-banner--pending {
    background: #fefce8;
    border-color: #f59e0b;
}
.tf-banner--rejected {
    background: #fef2f2;
    border-color: #ef4444;
}
.tf-banner__icon {
    flex-shrink: 0;
    margin-top: 1px;
}
.tf-banner--pending .tf-banner__icon { color: #d97706; }
.tf-banner--rejected .tf-banner__icon { color: #dc2626; }
.tf-banner__title {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 3px;
}
.tf-banner--pending .tf-banner__title { color: #92400e; }
.tf-banner--rejected .tf-banner__title { color: #991b1b; }
.tf-banner__body {
    font-size: 12px;
    line-height: 1.5;
    margin-bottom: 2px;
}
.tf-banner--pending .tf-banner__body { color: #92400e; }
.tf-banner--rejected .tf-banner__body { color: #991b1b; }

/* ---- Error List ---- */
.tf-error-list {
    list-style: disc;
    padding-left: 16px;
    font-size: 12px;
    color: #991b1b;
    margin-top: 4px;
    line-height: 1.7;
}

/* ---- Card ---- */
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

/* ---- Field ---- */
.tf-field {
    margin-bottom: 12px;
}
.tf-field:last-child {
    margin-bottom: 0;
}
.tf-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
}
.tf-req { color: #dc2626; font-weight: 400; }
.tf-label--optional {
    font-weight: 400;
    color: #9ca3af;
    font-size: 11px;
}
.tf-hint {
    font-size: 10px;
    color: #9ca3af;
    margin-top: 4px;
}

/* ---- Inputs ---- */
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
}
.tf-input:focus,
.tf-select:focus,
.tf-textarea:focus {
    border-color: #0f6e56;
    box-shadow: 0 0 0 3px rgba(15,110,86,.1);
}
.tf-input[readonly],
.tf-select[disabled],
.tf-textarea[readonly] {
    background: #f9fafb;
    color: #6b7280;
    cursor: not-allowed;
}
.tf-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 36px;
}
.tf-textarea { resize: vertical; line-height: 1.55; min-height: 80px; }

/* ---- Grid ---- */
.tf-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
@media (max-width: 400px) {
    .tf-grid-2 {
        grid-template-columns: 1fr;
    }
}

/* ---- Upload ---- */
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
}
.tf-upload:hover {
    border-color: #0f6e56;
    background: #f0faf6;
}
.tf-upload svg { color: #0f6e56; flex-shrink: 0; }
.tf-upload__label {
    font-size: 12px;
    font-weight: 600;
    color: #0f6e56;
    line-height: 1.5;
}
.tf-upload__existing {
    font-size: 11px;
    color: #059669;
    display: block;
    font-style: italic;
    font-weight: 400;
}
.tf-upload__hint {
    font-size: 10px;
    color: #9ca3af;
}
.tf-upload--wide {
    flex-direction: row;
    text-align: left;
    gap: 12px;
    padding: 12px 16px;
    min-height: auto;
}
.tf-file-hidden {
    display: none;
}

/* ---- Rekening ---- */
.tf-biaya-desc {
    font-size: 13px;
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 12px;
}
.tf-biaya-desc strong { color: #111827; }
.tf-rekening {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
}
.tf-rek-row {
    display: flex;
    align-items: center;
    padding: 9px 14px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 13px;
    gap: 8px;
}
.tf-rek-row:last-child { border-bottom: none; }
.tf-rek-label {
    color: #6b7280;
    font-size: 12px;
    width: 90px;
    flex-shrink: 0;
}
.tf-rek-val {
    font-weight: 600;
    color: #111827;
    flex: 1;
    letter-spacing: .02em;
}
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

/* ---- Agree ---- */
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
.tf-agree__label {
    font-size: 12px;
    color: #4b5563;
    line-height: 1.7;
    cursor: pointer;
}
.tf-agree__label a {
    color: #0f6e56;
    font-weight: 600;
    text-decoration: none;
}
.tf-agree__label a:hover { text-decoration: underline; }
.tf-agree__label strong { color: #111827; }

/* ---- Submit ---- */
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
.tf-submit--disabled {
    background: #9ca3af;
    cursor: not-allowed;
    box-shadow: none;
}
.tf-footer-note {
    text-align: center;
    font-size: 11px;
    color: #9ca3af;
    margin-top: 12px;
    font-style: italic;
}

/* ---- Responsive fine-tuning ---- */
@media (min-width: 480px) {
    .tf-hero h1 { font-size: 22px; }
    .tf-card { padding: 20px; }
    .tf-container { padding: 0 20px; }
}
@media (min-width: 640px) {
    .tf-page { padding: 32px 0 60px; }
    .tf-hero { padding: 28px 24px; }
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
.tf-chip:hover:not(:disabled) {
    border-color: #0f6e56;
    color: #0f6e56;
    background: #f0faf6;
}
.tf-chip--active {
    background: #0f6e56;
    border-color: #0f6e56;
    color: #fff;
}
.tf-chip--active:hover:not(:disabled) {
    background: #085041;
    border-color: #085041;
    color: #fff;
}
.tf-chip:disabled {
    opacity: .6;
    cursor: not-allowed;
}

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
.tf-selected-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    min-height: 0;
}
.tf-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}
.tf-tag--custom {
    background: #ede9fe;
    color: #5b21b6;
    border: 1.5px solid #c4b5fd;
}
.tf-tag__remove {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 15px;
    line-height: 1;
    color: inherit;
    padding: 0;
    margin-left: 2px;
    opacity: .7;
    font-family: inherit;
}
.tf-tag__remove:hover { opacity: 1; }
</style>


<script>
    /* ---- File upload helper ---- */
    function triggerFile(id) {
        const el = document.getElementById(id);
        if (el && !el.disabled) el.click();
    }

    function updateNikCounter(input) {
    // Hanya izinkan angka
    input.value = input.value.replace(/\D/g, '').slice(0, 16);
    const counter = document.getElementById('nik-counter');
    if (counter) {
        const len = input.value.length;
        counter.textContent = `${len} / 16 digit`;
        counter.style.color = len === 16 ? '#059669' : (len > 0 ? '#d97706' : '#9ca3af');
    }
}

/* ======================== BIDANG KEAHLIAN ======================== */
function getKeahlianArray() {
    const val = document.getElementById('bidang-keahlian-value').value;
    return val ? val.split(',').map(s => s.trim()).filter(Boolean) : [];
}

function setKeahlianValue(arr) {
    document.getElementById('bidang-keahlian-value').value = arr.join(',');
    const counter = document.getElementById('keahlian-count');
    if (counter) counter.textContent = arr.length;
}

function toggleChip(btn) {
    const label = btn.textContent.trim();
    let arr = getKeahlianArray();
    if (btn.classList.contains('tf-chip--active')) {
        btn.classList.remove('tf-chip--active');
        arr = arr.filter(v => v !== label);
    } else {
        btn.classList.add('tf-chip--active');
        if (!arr.includes(label)) arr.push(label);
    }
    setKeahlianValue(arr);
}

function addCustomKeahlian() {
    const input = document.getElementById('custom-keahlian-input');
    const label = input.value.trim();
    if (!label) return;

    let arr = getKeahlianArray();
    if (arr.includes(label)) {
        input.value = '';
        return;
    }

    arr.push(label);
    setKeahlianValue(arr);

    // Render tag custom
    const container = document.getElementById('selected-tags');
    const tag = document.createElement('span');
    tag.className = 'tf-tag tf-tag--custom';
    tag.dataset.value = label;
    tag.innerHTML = `${label} <button type="button" onclick="removeTag(this, '${label.replace(/'/g,"\\'")}') " class="tf-tag__remove">×</button>`;
    container.appendChild(tag);

    input.value = '';
    input.focus();
}

function removeTag(btn, label) {
    btn.closest('.tf-tag').remove();
    let arr = getKeahlianArray();
    arr = arr.filter(v => v !== label);
    setKeahlianValue(arr);
}

document.querySelector('form').addEventListener('submit', function (e) {
    const isPending = <?php echo e($trainer?->status === 'pending' ? 'true' : 'false'); ?>;
    if (isPending) return;

    // ---- 1. cek sosmed ----
    const sosmedFields = ['sosmed_instagram','sosmed_twitter','sosmed_linkedin','sosmed_youtube','sosmed_facebook'];
    const filled = sosmedFields.some(name => {
        const el = this.querySelector(`[name="${name}"]`);
        return el && el.value.trim() !== '';
    });
    if (!filled) {
        e.preventDefault();
        let banner = document.getElementById('sosmed-error');
        if (!banner) {
            banner = document.createElement('div');
            banner.id = 'sosmed-error';
            banner.className = 'tf-banner tf-banner--rejected';
            banner.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <div>
                    <p class="tf-banner__title">Sosial Media Wajib Diisi</p>
                    <p class="tf-banner__body">Isi minimal satu akun sosial media.</p>
                </div>
            `;
            const sosmedCard = document.querySelector('.tf-card:nth-of-type(3)');
            sosmedCard.parentNode.insertBefore(banner, sosmedCard);
        }
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return; // stop
    }
 
    // ---- 2. cek NIK 16 digit ----
    const nikEl = this.querySelector('[name="nik"]');
    if (nikEl && !/^\d{16}$/.test(nikEl.value.trim())) {
        e.preventDefault();
        const oldNik = document.getElementById('nik-error');
        if (oldNik) oldNik.remove();
        const nikBanner = document.createElement('div');
        nikBanner.id = 'nik-error';
        nikBanner.className = 'tf-banner tf-banner--rejected';
        nikBanner.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <div>
                <p class="tf-banner__title">NIK Tidak Valid</p>
                <p class="tf-banner__body">Nomor NIK/KTP harus terdiri dari tepat <strong>16 digit angka</strong>.</p>
            </div>
        `;
        nikEl.closest('.tf-field').appendChild(nikBanner);
        nikEl.style.borderColor = '#ef4444';
        nikEl.style.boxShadow = '0 0 0 3px rgba(239,68,68,.1)';
        nikEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        nikEl.addEventListener('input', function () {
            nikEl.style.borderColor = '';
            nikEl.style.boxShadow = '';
            const b = document.getElementById('nik-error');
            if (b) b.remove();
        }, { once: true });
        return; // stop
    }
 
    // ---- 3. cek bidang keahlian ----
    const keahlianVal = document.getElementById('bidang-keahlian-value').value.trim();
    if (!keahlianVal) {
        e.preventDefault();
        const oldK = document.getElementById('keahlian-error');
        if (oldK) oldK.remove();
        const banner = document.createElement('div');
        banner.id = 'keahlian-error';
        banner.className = 'tf-banner tf-banner--rejected';
        banner.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="tf-banner__icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <div>
                <p class="tf-banner__title">Bidang Keahlian Wajib Diisi</p>
                <p class="tf-banner__body">Pilih atau tambahkan minimal <strong>1 bidang keahlian</strong>.</p>
            </div>
        `;
        const keahlianCard = document.getElementById('bidang-keahlian-value').closest('.tf-card');
        keahlianCard.prepend(banner);
        keahlianCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return; // stop
    }
});

    function updateUploadLabel(input, labelId) {
        const label = document.getElementById(labelId);
        if (!label) return;
        if (input.files && input.files[0]) {
            label.innerHTML = '<span style="color:#059669;font-style:italic;font-weight:400">✓ ' + input.files[0].name + '</span>';
        }
    }

    /* ---- Salin rekening ---- */
    function copyRekening() {
        const noRek = document.getElementById('nomor-rek').textContent.trim();
        const label = document.getElementById('copy-label');
        const done = () => {
            label.textContent = '✓ Tersalin!';
            setTimeout(() => { label.textContent = 'Salin'; }, 2000);
        };
        if (navigator.clipboard) {
            navigator.clipboard.writeText(noRek).then(done);
        } else {
            const el = document.createElement('textarea');
            el.value = noRek;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            done();
        }
    }

    /* ======================== WILAYAH API ======================== */
    const BASE_URL = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    const provinsiSelect  = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kabupaten');
    const kecamatanSelect = document.getElementById('kecamatan');
    const kelurahanSelect = document.getElementById('kelurahan');

    const savedProvinsi  = provinsiSelect.dataset.selected  || '';
    const savedKabupaten = kabupatenSelect.dataset.selected || '';
    const savedKecamatan = kecamatanSelect.dataset.selected || '';
    const savedKelurahan = kelurahanSelect.dataset.selected || '';

    /* Load provinsi */
    fetch(`${BASE_URL}/provinces.json`)
        .then(res => res.json())
        .then(data => {
            let savedProvId = null;
            data.forEach(prov => {
                const opt = document.createElement('option');
                opt.value = prov.name;
                opt.dataset.id = prov.id;
                opt.textContent = prov.name;
                if (prov.name === savedProvinsi) {
                    opt.selected = true;
                    savedProvId = prov.id;
                }
                provinsiSelect.appendChild(opt);
            });
            if (savedProvId && savedKabupaten) {
                loadKabupaten(savedProvId, savedKabupaten);
            }
        });

    function loadKabupaten(provinsiId, prefillKab = '') {
        kabupatenSelect.disabled = true;
        fetch(`${BASE_URL}/regencies/${provinsiId}.json`)
            .then(res => res.json())
            .then(data => {
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                let savedKabId = null;
                data.forEach(kab => {
                    const opt = document.createElement('option');
                    opt.value = kab.name;
                    opt.dataset.id = kab.id;
                    opt.textContent = kab.name;
                    if (kab.name === prefillKab) {
                        opt.selected = true;
                        savedKabId = kab.id;
                    }
                    kabupatenSelect.appendChild(opt);
                });
                kabupatenSelect.disabled = false;
                if (savedKabId && savedKecamatan) loadKecamatan(savedKabId, savedKecamatan);
            });
    }

    function loadKecamatan(kabupatenId, prefillKec = '') {
        kecamatanSelect.disabled = true;
        fetch(`${BASE_URL}/districts/${kabupatenId}.json`)
            .then(res => res.json())
            .then(data => {
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                let savedKecId = null;
                data.forEach(kec => {
                    const opt = document.createElement('option');
                    opt.value = kec.name;
                    opt.dataset.id = kec.id;
                    opt.textContent = kec.name;
                    if (kec.name === prefillKec) {
                        opt.selected = true;
                        savedKecId = kec.id;
                    }
                    kecamatanSelect.appendChild(opt);
                });
                kecamatanSelect.disabled = false;
                if (savedKecId && savedKelurahan) loadKelurahan(savedKecId, savedKelurahan);
            });
    }

    function loadKelurahan(kecamatanId, prefillKel = '') {
        kelurahanSelect.disabled = true;
        fetch(`${BASE_URL}/villages/${kecamatanId}.json`)
            .then(res => res.json())
            .then(data => {
                kelurahanSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                data.forEach(kel => {
                    const opt = document.createElement('option');
                    opt.value = kel.name;
                    opt.dataset.id = kel.id;
                    opt.textContent = kel.name;
                    if (kel.name === prefillKel) opt.selected = true;
                    kelurahanSelect.appendChild(opt);
                });
                kelurahanSelect.disabled = false;
            });
    }

    /* Event listeners pilih manual */
    provinsiSelect.addEventListener('change', function () {
        resetSelect(kabupatenSelect, 'Pilih Kabupaten/Kota');
        resetSelect(kecamatanSelect, 'Pilih Kecamatan');
        resetSelect(kelurahanSelect, 'Pilih Desa/Kelurahan');
        if (!this.value) return;
        const id = this.options[this.selectedIndex].dataset.id;
        loadKabupaten(id);
    });

    kabupatenSelect.addEventListener('change', function () {
        resetSelect(kecamatanSelect, 'Pilih Kecamatan');
        resetSelect(kelurahanSelect, 'Pilih Desa/Kelurahan');
        if (!this.value) return;
        const id = this.options[this.selectedIndex].dataset.id;
        loadKecamatan(id);
    });

    kecamatanSelect.addEventListener('change', function () {
        resetSelect(kelurahanSelect, 'Pilih Desa/Kelurahan');
        if (!this.value) return;
        const id = this.options[this.selectedIndex].dataset.id;
        loadKelurahan(id);
    });

    function resetSelect(selectEl, placeholder) {
        selectEl.innerHTML = `<option value="">${placeholder}</option>`;
        selectEl.disabled = true;
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/profile/daftar-trainer.blade.php ENDPATH**/ ?>