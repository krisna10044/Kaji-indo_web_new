<?php $__env->startSection('page-title', $item ? 'Edit Dokumentasi' : 'Tambah Dokumentasi'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .form-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px;
        box-shadow: var(--shadow);
        margin-bottom: 22px;
    }

    .form-card-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-grid .full { grid-column: 1 / -1; }

    .form-group { display: flex; flex-direction: column; gap: 5px; }

    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-label span.required { color: var(--accent2); margin-left: 2px; }

    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 10px 13px;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        font-family: inherit;
        font-size: 13px;
        transition: border-color .2s, box-shadow .2s;
        outline: none;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(45,106,79,.08);
    }

    .form-textarea { min-height: 100px; resize: vertical; }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--border);
        border-radius: 12px;
        padding: 28px 20px;
        text-align: center;
        background: var(--surface2);
        cursor: pointer;
        transition: all .2s;
        position: relative;
    }

    .upload-area:hover, .upload-area.dragover {
        border-color: var(--accent);
        background: var(--accent-light);
    }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-icon { font-size: 32px; margin-bottom: 8px; }
    .upload-text { font-size: 13px; font-weight: 600; color: var(--text); }
    .upload-hint { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

    /* Preview Grid */
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 10px;
        margin-top: 12px;
    }

    .preview-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--border);
        aspect-ratio: 1;
        background: var(--surface2);
    }

    .preview-item img {
        width: 100%; height: 100%;
        object-fit: cover;
    }

    .preview-item .remove-btn {
        position: absolute;
        top: 4px; right: 4px;
        width: 20px; height: 20px;
        border-radius: 50%;
        background: rgba(231,111,81,.9);
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        line-height: 1;
    }

    /* Thumbnail preview single */
    .thumb-preview {
        margin-top: 10px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
        max-height: 180px;
        display: none;
    }

    .thumb-preview img { width: 100%; height: 180px; object-fit: cover; display: block; }

    /* Toggle published */
    .toggle-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 10px 14px;
    }

    .toggle {
        position: relative;
        width: 40px;
        height: 22px;
        flex-shrink: 0;
    }

    .toggle input { opacity: 0; width: 0; height: 0; }

    .toggle-slider {
        position: absolute;
        inset: 0;
        background: var(--border);
        border-radius: 22px;
        cursor: pointer;
        transition: .3s;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 16px; height: 16px;
        left: 3px; top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .3s;
    }

    .toggle input:checked + .toggle-slider { background: var(--accent); }
    .toggle input:checked + .toggle-slider::before { transform: translateX(18px); }

    .toggle-label { font-size: 13px; font-weight: 600; }
    .toggle-sub { font-size: 11px; color: var(--text-muted); }

    /* Kategori toggle pills */
    .kategori-wrap { display: flex; gap: 8px; }

    .kategori-pill {
        flex: 1;
        position: relative;
    }

    .kategori-pill input[type="radio"] { display: none; }

    .kategori-pill label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px;
        border-radius: 10px;
        border: 2px solid var(--border);
        background: var(--surface2);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
        transition: all .2s;
        color: var(--text-muted);
    }

    .kategori-pill input:checked + label {
        border-color: var(--accent);
        background: var(--accent-light);
        color: var(--accent);
    }

    /* Video url section */
    #section-video { display: none; }
    #section-foto  { display: none; }

    /* Action bar */
    .action-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Error */
    .field-error {
        font-size: 11px;
        color: var(--accent2);
        margin-top: 3px;
        font-weight: 500;
    }

    /* Existing foto (edit mode) */
    .existing-foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 10px;
        margin-bottom: 12px;
    }

    .existing-foto-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--border);
        aspect-ratio: 1;
    }

    .existing-foto-item img { width: 100%; height: 100%; object-fit: cover; }
    .existing-foto-item .foto-label {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: rgba(0,0,0,.45);
        color: #fff;
        font-size: 9px;
        text-align: center;
        padding: 3px;
    }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-card { padding: 18px 14px; }
        .action-bar { flex-direction: column-reverse; }
        .action-bar .btn { width: 100%; justify-content: center; }
        .kategori-wrap { flex-direction: column; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:var(--text-muted);">
    <a href="<?php echo e(route('admin.dokumentasi.index')); ?>" style="color:var(--accent);font-weight:600;text-decoration:none;">Dokumentasi</a>
    <span>›</span>
    <span><?php echo e($item ? 'Edit' : 'Tambah Baru'); ?></span>
</div>

<form
    id="form-dokumentasi"
    action="<?php echo e($item ? route('admin.dokumentasi.update', $item) : route('admin.dokumentasi.store')); ?>"
    method="POST"
    enctype="multipart/form-data"
>
    <?php echo csrf_field(); ?>
    <?php if($item): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    
    <div class="form-card">
        <div class="form-card-title">
            📝 Informasi Dokumentasi
        </div>

        <div class="form-grid">

            
            <div class="form-group full">
                <label class="form-label">Judul Kegiatan <span class="required">*</span></label>
                <input
                    type="text"
                    name="judul"
                    class="form-input"
                    placeholder="Contoh: Pelatihan UMKM Batch 3 — Surabaya"
                    value="<?php echo e(old('judul', $item->judul ?? '')); ?>"
                >
                <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label class="form-label">Tanggal Kegiatan <span class="required">*</span></label>
                <input
                    type="date"
                    name="tanggal_kegiatan"
                    class="form-input"
                    value="<?php echo e(old('tanggal_kegiatan', isset($item) ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('Y-m-d') : '')); ?>"
                >
                <?php $__errorArgs = ['tanggal_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label class="form-label">Kategori <span class="required">*</span></label>
                <div class="kategori-wrap">
                <div class="kategori-pill">
    <input type="radio" id="kat-foto" name="kategori" value="foto"
        <?php echo e(old('kategori', $item->kategori ?? '') === 'foto' ? 'checked' : ''); ?>>
    <label for="kat-foto">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;">
            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Foto
    </label>
</div>
<div class="kategori-pill">
    <input type="radio" id="kat-video" name="kategori" value="video"
        <?php echo e(old('kategori', $item->kategori ?? '') === 'video' ? 'checked' : ''); ?>>
    <label for="kat-video">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;">
            <path d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
        </svg>
        Video
    </label>
</div>
                </div>
                <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group full">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-textarea" placeholder="Ceritakan singkat tentang kegiatan ini..."><?php echo e(old('deskripsi', $item->deskripsi ?? '')); ?></textarea>
                <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
<div class="form-group full">
    <label class="form-label">Status Publikasi</label>
    <div class="toggle-wrap">
        <label class="toggle">
            <input
                type="checkbox"
                value="1"
                <?php echo e(old('is_published', $item ? (int)$item->is_published : 1) ? 'checked' : ''); ?>

                id="toggle-published"
            >
            <span class="toggle-slider"></span>
        </label>
        <div>
            <div class="toggle-label" id="toggle-label-text">
                <?php echo e(old('is_published', $item ? $item->is_published : true) ? 'Dipublikasikan' : 'Draft'); ?>

            </div>
            <div class="toggle-sub">Dokumentasi akan terlihat di halaman publik</div>
        </div>
    </div>
</div>

        </div>
    </div>

    
<div class="form-card">
    <div class="form-card-title">
        🖼️ Media
    </div>

    
    <div id="section-foto">

        
        <div class="form-group" style="margin-bottom:20px;">
            <label class="form-label">Cover Foto <span class="required">*</span></label>
            <div class="upload-area" id="thumb-area">
                <input type="file" name="thumbnail" accept="image/*" id="thumb-input">
                <div class="upload-icon">🖼️</div>
                <div class="upload-text">Klik atau seret foto cover</div>
                <div class="upload-hint">JPG, PNG, WEBP — maks. 2 MB</div>
            </div>
            <div class="thumb-preview" id="thumb-preview">
                <img id="thumb-preview-img" src="" alt="preview">
            </div>
            <?php if($item && $item->thumbnail): ?>
                <div style="margin-top:10px;">
                    <div style="font-size:11px;color:var(--text-muted);margin-bottom:6px;font-weight:600;">COVER SAAT INI</div>
                    <div style="border-radius:12px;overflow:hidden;border:1px solid var(--border);max-height:180px;">
                        <img src="<?php echo e(asset('storage/' . $item->thumbnail)); ?>" style="width:100%;height:180px;object-fit:cover;display:block;">
                    </div>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:5px;">Upload baru untuk mengganti cover lama.</div>
                </div>
            <?php endif; ?>
            <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group">
            <label class="form-label">Upload Foto Kegiatan</label>
            <?php if($item && $item->foto && count($item->foto) > 0): ?>
                <div style="margin-bottom:10px;">
                    <div style="font-size:11px;color:var(--text-muted);margin-bottom:6px;font-weight:600;">FOTO SAAT INI (<?php echo e(count($item->foto)); ?> foto)</div>
                    <div class="existing-foto-grid">
                        <?php $__currentLoopData = $item->foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="existing-foto-item">
                            <img src="<?php echo e(asset('storage/' . $f)); ?>" alt="foto">
                            <div class="foto-label">Foto lama</div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div style="font-size:11px;color:var(--text-muted);">Upload foto baru di bawah untuk mengganti semua foto lama.</div>
                </div>
            <?php endif; ?>
            <div class="upload-area" id="foto-area">
                <input type="file" name="foto[]" accept="image/*" multiple id="foto-input">
                <div class="upload-icon">📷</div>
                <div class="upload-text">Klik atau seret foto-foto kegiatan</div>
                <div class="upload-hint">Bisa pilih lebih dari 1 foto — JPG, PNG, WEBP — maks. 3 MB/foto</div>
            </div>
            <div class="preview-grid" id="foto-preview-grid"></div>
            <?php $__errorArgs = ['foto.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

    </div>

    
    <div id="section-video">

        
        <div class="form-group" style="margin-bottom:20px;">
            <label class="form-label">Upload File Video <span class="required">*</span></label>
            <div class="upload-area" id="video-file-area">
                <input type="file" name="video_file" accept="video/*" id="video-file-input">
                <div class="upload-icon">🎬</div>
                <div class="upload-text">Klik atau seret file video</div>
                <div class="upload-hint">MP4, MOV, WEBM — maks. 100 MB</div>
            </div>
            <div id="video-file-info" style="display:none;margin-top:10px;padding:10px 14px;background:var(--surface2);border:1px solid var(--border);border-radius:10px;font-size:12px;align-items:center;gap:8px;">
                <span>🎬</span>
                <span id="video-file-name" style="font-weight:600;color:var(--text);"></span>
                <span id="video-file-size" style="color:var(--text-muted);"></span>
            </div>
            <?php if($item && $item->video_file): ?>
                <div style="margin-top:10px;padding:10px 14px;background:var(--surface2);border:1px solid var(--border);border-radius:10px;font-size:12px;">
                    <span>🎬</span>
                    <span style="font-weight:600;">Video saat ini: </span>
                    <span style="color:var(--text-muted);"><?php echo e(basename($item->video_file)); ?></span>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:4px;">Upload baru untuk mengganti video lama.</div>
                </div>
            <?php endif; ?>
            <?php $__errorArgs = ['video_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group" style="margin-bottom:20px;">
            <label class="form-label">
                Cover Video
                <span style="color:var(--text-muted);font-weight:400;text-transform:none;letter-spacing:0;">(otomatis dari video · bisa ganti manual)</span>
            </label>

            <canvas id="video-canvas" style="display:none;"></canvas>
            <video id="video-scrubber" style="display:none;" muted playsinline preload="metadata"></video>
            <input type="hidden" name="cover_video_base64" id="cover-video-base64">

            <div id="cover-preview-wrap" style="display:none;margin-bottom:12px;">
                <div style="border-radius:12px;overflow:hidden;border:1px solid var(--border);aspect-ratio:16/9;background:var(--surface2);position:relative;">
                    <img id="cover-preview-img" src="" alt="cover" style="width:100%;height:100%;object-fit:cover;display:block;">
                    <div style="position:absolute;bottom:8px;right:8px;">
                        <span id="cover-badge" style="background:rgba(0,0,0,.6);color:#fff;font-size:10px;padding:3px 8px;border-radius:20px;font-weight:600;">AUTO CAPTURE</span>
                    </div>
                </div>

                <div style="margin-top:10px;">
                    <div style="font-size:11px;color:var(--text-muted);font-weight:600;margin-bottom:5px;">PILIH FRAME COVER</div>
                    <input type="range" id="frame-scrubber" min="0" max="100" value="10"
                        style="width:100%;accent-color:var(--accent);cursor:pointer;">
                    <div style="display:flex;justify-content:space-between;font-size:10px;color:var(--text-muted);margin-top:3px;">
                        <span>Awal</span>
                        <span id="frame-time-label">–</span>
                        <span>Akhir</span>
                    </div>
                </div>

                <div style="margin-top:10px;">
                    <label class="form-label" style="margin-bottom:5px;">Atau upload cover manual</label>
                    <div class="upload-area" id="cover-manual-area" style="padding:16px;">
                        <input type="file" name="cover_video" accept="image/*" id="cover-manual-input">
                        <div style="font-size:13px;font-weight:600;color:var(--text-muted);">🖼️ Pilih gambar cover</div>
                    </div>
                </div>
            </div>

            <?php if($item && $item->cover_video): ?>
                <div style="margin-bottom:12px;">
                    <div style="font-size:11px;color:var(--text-muted);margin-bottom:6px;font-weight:600;">COVER SAAT INI</div>
                    <div style="border-radius:12px;overflow:hidden;border:1px solid var(--border);max-height:180px;">
                        <img src="<?php echo e(asset('storage/' . $item->cover_video)); ?>" style="width:100%;height:180px;object-fit:cover;display:block;">
                    </div>
                </div>
            <?php endif; ?>
            <?php $__errorArgs = ['cover_video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group">
            <label class="form-label">
                URL YouTube
                <span style="color:var(--text-muted);font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span>
            </label>
            <input type="url" name="youtube_url" class="form-input"
                placeholder="https://www.youtube.com/watch?v=..."
                value="<?php echo e(old('youtube_url', $item->youtube_url ?? '')); ?>"
                id="youtube-url-input">
            <?php $__errorArgs = ['youtube_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <div id="yt-preview" style="display:none;margin-top:12px;">
                <div style="font-size:11px;color:var(--text-muted);margin-bottom:6px;font-weight:600;letter-spacing:1px;text-transform:uppercase;">Preview Video</div>
                <div style="border-radius:12px;overflow:hidden;border:1px solid var(--border);aspect-ratio:16/9;">
                    <iframe id="yt-iframe" width="100%" height="100%" frameborder="0" allowfullscreen style="display:block;"></iframe>
                </div>
            </div>
        </div>

    </div>

</div>



<input type="hidden" name="is_published" id="is_published_input"
    value="<?php echo e(old('is_published', $item ? (int)$item->is_published : 1)); ?>">

<div class="action-bar">
    <a href="<?php echo e(route('admin.dokumentasi.index')); ?>" class="btn btn-ghost">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;">
            <path d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
    <button type="button" id="submit-btn" class="btn btn-ghost" onclick="submitAs()">
        <svg id="submit-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;">
            <path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
        </svg>
        <span id="submit-label">Simpan sebagai Draft</span>
    </button>
</div>
</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// ── Publish / Draft logic ────────────────────────────────
const hiddenInput  = document.getElementById('is_published_input');
const toggleEl     = document.getElementById('toggle-published');
const toggleLabel  = document.getElementById('toggle-label-text');
const submitBtn    = document.getElementById('submit-btn');
const submitLbl    = document.getElementById('submit-label');
const submitIcon   = document.getElementById('submit-icon');

const iconDraft   = `<path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>`;
const iconPublish = `<path d="M5 13l4 4L19 7"/>`;

function setPublishState(val) {
    const isPublish = val == 1;
    hiddenInput.value       = isPublish ? '1' : '0';
    toggleEl.checked        = isPublish;
    toggleLabel.textContent = isPublish ? 'Dipublikasikan' : 'Draft';

    // Update tombol
    submitIcon.innerHTML = isPublish ? iconPublish : iconDraft;
    submitLbl.textContent = isPublish ? 'Simpan & Publish' : 'Simpan sebagai Draft';
    submitBtn.className  = isPublish ? 'btn btn-primary' : 'btn btn-ghost';
}

// Init
setPublishState(hiddenInput.value);

// Toggle ubah state
toggleEl.addEventListener('change', function() {
    setPublishState(this.checked ? 1 : 0);
});

function submitAs() {
    document.getElementById('form-dokumentasi').submit();
}
// ── Kategori toggle ──────────────────────────────────────
const radios       = document.querySelectorAll('input[name="kategori"]');
const sectionFoto  = document.getElementById('section-foto');
const sectionVideo = document.getElementById('section-video');

function toggleKategori(val) {
    sectionFoto.style.display  = val === 'foto'  ? 'block' : 'none';
    sectionVideo.style.display = val === 'video' ? 'block' : 'none';
}

radios.forEach(r => r.addEventListener('change', () => toggleKategori(r.value)));
const initialKat = document.querySelector('input[name="kategori"]:checked');
if (initialKat) toggleKategori(initialKat.value);

// ── Thumbnail preview ────────────────────────────────────
document.getElementById('thumb-input').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const preview = document.getElementById('thumb-preview');
    const img     = document.getElementById('thumb-preview-img');
    img.src = URL.createObjectURL(file);
    preview.style.display = 'block';
});

// ── Multi foto preview ───────────────────────────────────
const fotoInput = document.getElementById('foto-input');
const fotoGrid  = document.getElementById('foto-preview-grid');
let selectedFiles = [];

fotoInput.addEventListener('change', function() {
    selectedFiles = [...selectedFiles, ...Array.from(this.files)];
    renderFotoPreview();
});

function renderFotoPreview() {
    fotoGrid.innerHTML = '';
    selectedFiles.forEach((file, idx) => {
        const url  = URL.createObjectURL(file);
        const item = document.createElement('div');
        item.className = 'preview-item';
        item.innerHTML = `
            <img src="${url}" alt="preview">
            <button type="button" class="remove-btn" onclick="removeFoto(${idx})">✕</button>
        `;
        fotoGrid.appendChild(item);
    });
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    fotoInput.files = dt.files;
}

function removeFoto(idx) {
    selectedFiles.splice(idx, 1);
    renderFotoPreview();
}

// ── Video file → auto capture cover ─────────────────────
const videoFileInput  = document.getElementById('video-file-input');
const videoScrubber   = document.getElementById('video-scrubber');
const videoCanvas     = document.getElementById('video-canvas');
const coverBase64     = document.getElementById('cover-video-base64');
const coverPreviewWrap = document.getElementById('cover-preview-wrap');
const coverPreviewImg  = document.getElementById('cover-preview-img');
const frameScrubber    = document.getElementById('frame-scrubber');
const frameTimeLabel   = document.getElementById('frame-time-label');
const videoFileInfo    = document.getElementById('video-file-info');

function captureFrame(seconds) {
    videoScrubber.currentTime = seconds;
}

function drawFrame() {
    const ctx = videoCanvas.getContext('2d');
    videoCanvas.width  = videoScrubber.videoWidth;
    videoCanvas.height = videoScrubber.videoHeight;
    ctx.drawImage(videoScrubber, 0, 0, videoCanvas.width, videoCanvas.height);
    const dataUrl = videoCanvas.toDataURL('image/jpeg', 0.85);
    coverPreviewImg.src = dataUrl;
    coverBase64.value   = dataUrl;

    // Format waktu
    const s = Math.floor(videoScrubber.currentTime);
    frameTimeLabel.textContent = `${String(Math.floor(s/60)).padStart(2,'0')}:${String(s%60).padStart(2,'0')}`;
}

videoScrubber.addEventListener('seeked', drawFrame);

videoFileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    // Info file
    document.getElementById('video-file-name').textContent = file.name;
    document.getElementById('video-file-size').textContent = (file.size / (1024*1024)).toFixed(1) + ' MB';
    videoFileInfo.style.display = 'flex';

    // Load ke video element
    const url = URL.createObjectURL(file);
    videoScrubber.src = url;
    videoScrubber.load();

    videoScrubber.addEventListener('loadedmetadata', function() {
        const duration = videoScrubber.duration;
        frameScrubber.max = Math.floor(duration);

        // Auto capture di 10% durasi
        const captureAt = duration * 0.1;
        frameScrubber.value = Math.floor(captureAt);
        captureFrame(captureAt);

        coverPreviewWrap.style.display = 'block';
    }, { once: true });
});

// Slider scrub frame
frameScrubber.addEventListener('input', function() {
    captureFrame(parseFloat(this.value));
});

// Override cover manual
document.getElementById('cover-manual-input').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        coverPreviewImg.src  = e.target.result;
        coverBase64.value    = e.target.result;
        // Hapus badge AUTO CAPTURE
        const badge = coverPreviewWrap.querySelector('span[style*="AUTO CAPTURE"]');
        if (badge) badge.textContent = 'MANUAL';
    };
    reader.readAsDataURL(file);
    // Kosongkan input cover_video agar tidak bentrok
    coverBase64.value = '';
});

// ── YouTube URL → embed preview ──────────────────────────
const ytInput   = document.getElementById('youtube-url-input');
const ytPreview = document.getElementById('yt-preview');
const ytIframe  = document.getElementById('yt-iframe');

function getYtId(url) {
    const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/);
    return match ? match[1] : null;
}

if (ytInput) {
    if (ytInput.value) {
        const id = getYtId(ytInput.value);
        if (id) { ytIframe.src = `https://www.youtube.com/embed/${id}`; ytPreview.style.display = 'block'; }
    }
    ytInput.addEventListener('input', function() {
        const id = getYtId(this.value);
        if (id) { ytIframe.src = `https://www.youtube.com/embed/${id}`; ytPreview.style.display = 'block'; }
        else    { ytIframe.src = ''; ytPreview.style.display = 'none'; }
    });
}



// ── Drag & drop styling ──────────────────────────────────
['thumb-area', 'foto-area', 'video-file-area', 'cover-manual-area'].forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener('dragover',  e => { e.preventDefault(); el.classList.add('dragover'); });
    el.addEventListener('dragleave', () => el.classList.remove('dragover'));
    el.addEventListener('drop',      () => el.classList.remove('dragover'));
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/admin/dokumentasi/form.blade.php ENDPATH**/ ?>