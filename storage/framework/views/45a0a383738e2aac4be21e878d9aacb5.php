<?php $__env->startSection('page-title', 'Approval UMKM'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ── CSV Export Button ── */
.btn-csv-export {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    background: #f0fdf4;
    color: #15803d;
    border: 1.5px solid #86efac;
    text-decoration: none;
    cursor: pointer;
    transition: all .15s;
    white-space: nowrap;
}
.btn-csv-export:hover {
    background: #dcfce7;
    border-color: #4ade80;
    color: #166534;
}
@media (max-width: 768px) {
    .btn-csv-export { font-size: 11px; padding: 5px 10px; }
}
/* ═══════════════════════════════════════════════
   TAB BAR UTAMA
═══════════════════════════════════════════════ */
.tab-bar { display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap; }
.tab-btn {
    padding: 8px 18px; border-radius: 20px; font-size: 13px; font-weight: 600;
    border: 1.5px solid var(--border); background: var(--surface2); color: var(--text-muted);
    cursor: pointer; font-family: inherit; transition: all .15s;
    display: flex; align-items: center; gap: 6px;
}
.tab-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
.count-pill {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 20px; height: 20px; padding: 0 6px; border-radius: 20px;
    background: var(--accent2); color: #fff; font-size: 10px; font-weight: 700;
}
.tab-btn.active .count-pill { background: rgba(255,255,255,.25); }

/* ═══════════════════════════════════════════════
   SUB-TAB
═══════════════════════════════════════════════ */
.sub-tab-bar {
    display: flex; gap: 6px; margin-bottom: 20px;
    border-bottom: 2px solid var(--border); padding-bottom: 0;
}
.sub-tab-btn {
    padding: 8px 16px; font-size: 13px; font-weight: 600;
    border: none; background: transparent; color: var(--text-muted);
    cursor: pointer; font-family: inherit; transition: all .15s;
    border-bottom: 2px solid transparent; margin-bottom: -2px;
    display: flex; align-items: center; gap: 6px;
}
.sub-tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); }
.sub-tab-btn:hover:not(.active) { color: var(--text); }

/* ═══════════════════════════════════════════════
   TABLE CARD (Pending, Profil UMKM, Rejected)
═══════════════════════════════════════════════ */
.table-card { background:var(--surface); border:1px solid var(--border); border-radius:16px; overflow:hidden; box-shadow:var(--shadow); margin-bottom:24px; }
.table-card-header { display:flex; align-items:center; justify-content:space-between; padding:16px 20px; border-bottom:1px solid var(--border); }
.table-card-title { font-size:14px; font-weight:700; color:var(--text); display:flex; align-items:center; gap:8px; }
.table-card-subtitle { font-size:12px; color:var(--text-muted); font-weight:400; }
.table-card table { width:100%; border-collapse:collapse; }
.table-card thead th { padding:12px 16px; font-size:10px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.06em; background:var(--surface2); border-bottom:1px solid var(--border); text-align:left; }
.table-card tbody tr { border-bottom:1px solid var(--border); transition:background .1s; }
.table-card tbody tr:last-child { border-bottom:none; }
.table-card tbody tr:hover { background:var(--surface2); }
.table-card tbody td { padding:12px 16px; vertical-align:middle; }

/* ── Submitter cell ── */
.submitter { display:flex; align-items:center; gap:10px; }
.submitter-avatar { width:38px; height:38px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:16px; overflow:hidden; flex-shrink:0; }
.submitter-avatar img { width:100%; height:100%; object-fit:cover; }
.submitter-name { font-size:13px; font-weight:600; color:var(--text); }
.submitter-sub  { font-size:11px; color:var(--text-muted); margin-top:1px; }

/* ── Action group ── */
.action-group { display:flex; align-items:center; gap:6px; flex-wrap:wrap; }

/* ═══════════════════════════════════════════════
   CARD (Produk Item sub-tab only)
═══════════════════════════════════════════════ */
.umkm-avatar {
    width: 52px; height: 52px; border-radius: 12px; overflow: hidden; flex-shrink: 0;
    background: var(--surface2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center; font-size: 22px;
}
.umkm-avatar img { width:100%; height:100%; object-fit:cover; }
.umkm-name  { font-size: 14px; font-weight: 700; color: var(--text); margin-bottom: 2px; }
.umkm-owner { font-size: 12px; color: var(--text-muted); }
.umkm-meta  { display:flex; gap:6px; flex-wrap:wrap; margin-top:4px; }
.umkm-meta-chip {
    font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 20px;
    background: var(--surface2); color: var(--text-muted); border: 1px solid var(--border);
}
.umkm-card {
    background: var(--surface); border: 1px solid var(--border); border-radius: 16px;
    overflow: hidden; box-shadow: var(--shadow); transition: box-shadow .2s; align-self: start;
}
.umkm-card:hover { box-shadow: 0 4px 24px rgba(45,106,79,.1); }
.umkm-card-header {
    padding: 16px 18px; display: flex; align-items: center; gap: 14px;
    border-bottom: 1px solid var(--border);
}
.umkm-card-footer {
    padding: 12px 18px; border-top: 1px solid var(--border);
    display: flex; gap: 8px; align-items: center; background: var(--surface2);
}
.items-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 16px; align-items: start;
}
.items-scroll {
    max-height: 148px; overflow-y: auto;
    scrollbar-width: thin; scrollbar-color: var(--border) transparent;
}
.items-scroll::-webkit-scrollbar { width: 4px; }
.items-scroll::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }
.item-row {
    display: flex; align-items: center; gap: 10px; padding: 8px 10px;
    border: 1px solid var(--border); border-radius: 10px; margin-bottom: 6px;
    background: var(--surface2);
}
.item-thumb {
    width: 36px; height: 36px; border-radius: 8px; overflow: hidden; flex-shrink: 0;
    background: var(--border); display: flex; align-items: center; justify-content: center; font-size: 16px;
}
.item-thumb img { width:100%; height:100%; object-fit:cover; }
.item-name  { font-size: 12px; font-weight: 600; color: var(--text); }
.item-price { font-size: 11px; color: var(--accent); font-weight: 700; }
.item-del-btn {
    margin-left: auto; flex-shrink: 0; width: 28px; height: 28px; border-radius: 8px;
    background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626;
    display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all .15s;
}
.item-del-btn:hover { background: #dc2626; color: #fff; }
.no-items {
    text-align: center; padding: 16px; font-size: 12px; color: var(--text-muted);
    background: var(--surface2); border-radius: 10px; border: 1px dashed var(--border);
}
.umkm-items-title {
    font-size: 11px; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;
    display: flex; align-items: center; justify-content: space-between;
}
.harga-range {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 12px; font-weight: 700; color: var(--accent);
    background: var(--accent-light); padding: 3px 10px; border-radius: 20px;
    border: 1px solid #a7d7c566;
}

/* ═══════════════════════════════════════════════
   BADGE & BUTTON
═══════════════════════════════════════════════ */
.badge { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.badge-dot { width:6px; height:6px; border-radius:50%; background:currentColor; }
.badge-pending  { background:#fffbea; color:#f59e0b; border:1px solid #fcd34d66; }
.badge-approved { background:var(--accent-light); color:var(--accent); border:1px solid #a7d7c566; }
.badge-rejected { background:#fff0ed; color:#e76f51; border:1px solid #e76f5166; }

.btn { display:inline-flex; align-items:center; gap:6px; padding:8px 14px; border-radius:10px; font-size:12px; font-weight:600; border:none; cursor:pointer; font-family:inherit; transition:all .15s; text-decoration:none; }
.btn-approve { background:var(--accent); color:#fff; }
.btn-approve:hover { background:#1f4e37; }
.btn-reject  { background:#fff0ed; color:#e76f51; border:1px solid #e76f5166; }
.btn-reject:hover  { background:#e76f51; color:#fff; }
.btn-ghost   { background:var(--surface); color:var(--text); border:1px solid var(--border); }
.btn-ghost:hover   { background:var(--surface2); }
.btn-danger  { background:#fee2e2; color:#dc2626; border:1px solid #fca5a5; }
.btn-danger:hover  { background:#dc2626; color:#fff; }
.btn-sm { padding:6px 12px; font-size:11px; border-radius:8px; }

/* ═══════════════════════════════════════════════
   MODAL
═══════════════════════════════════════════════ */
.modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); backdrop-filter:blur(4px); z-index:200; align-items:center; justify-content:center; }
.modal-overlay.open { display:flex; }
.modal { background:var(--surface); border-radius:20px; width:540px; max-height:90vh; overflow-y:auto; padding:28px; box-shadow:0 24px 80px rgba(0,0,0,.2); animation:popIn .2s ease; border:1px solid var(--border); }
@keyframes popIn { from{transform:scale(.95);opacity:0} to{transform:scale(1);opacity:1} }
.modal-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
.modal-title  { font-size:18px; font-weight:700; color:var(--text); }
.modal-close  { width:32px; height:32px; border-radius:8px; background:var(--surface2); border:1px solid var(--border); cursor:pointer; font-size:18px; color:var(--text-muted); display:flex; align-items:center; justify-content:center; }
.modal-close:hover { background:#fee; color:#dc2626; }
.modal-footer { display:flex; gap:10px; justify-content:flex-end; margin-top:20px; padding-top:16px; border-top:1px solid var(--border); }
.form-group   { margin-bottom:16px; }
.form-label   { display:block; font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:6px; }
.form-textarea { width:100%; padding:10px 12px; background:var(--surface2); border:1.5px solid var(--border); border-radius:10px; font-family:inherit; font-size:13px; color:var(--text); resize:vertical; }
.form-textarea:focus { outline:none; border-color:var(--accent); }
.detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px; }
.detail-item.full { grid-column:1/-1; }
.detail-label { font-size:10px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:4px; }
.detail-value { font-size:13px; font-weight:600; color:var(--text); }
.img-preview  { width:100%; height:180px; border-radius:12px; overflow:hidden; background:var(--surface2); display:flex; align-items:center; justify-content:center; font-size:48px; margin-bottom:16px; border:1px solid var(--border); }
.img-preview img { width:100%; height:100%; object-fit:cover; }

/* ═══════════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════════ */
.empty-state { text-align:center; padding:60px 20px; color:var(--text-muted); }
.empty-state-icon { font-size:48px; margin-bottom:12px; }
.empty-state-text { font-size:14px; }

/* ═══════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════ */
@media (max-width: 768px) {
    .tab-bar { overflow-x:auto; flex-wrap:nowrap; -webkit-overflow-scrolling:touch; }
    .tab-btn { white-space:nowrap; flex-shrink:0; }
    .items-grid { grid-template-columns: 1fr; }
    .modal { width:95vw; padding:20px 16px; }
    .detail-grid { grid-template-columns:1fr; }
    .detail-item.full { grid-column:1; }
    .table-card-header { flex-direction:column; align-items:flex-start; gap:6px; padding:12px 14px; }

    /* Pending: sembunyikan Lokasi(3), NIB(4), Didaftarkan(5) */
    #tab-pending thead tr th:nth-child(3),
    #tab-pending tbody tr td:nth-child(3),
    #tab-pending thead tr th:nth-child(4),
    #tab-pending tbody tr td:nth-child(4),
    #tab-pending thead tr th:nth-child(5),
    #tab-pending tbody tr td:nth-child(5) { display:none !important; }
    #tab-pending table { table-layout:fixed; width:100%; }
    #tab-pending thead tr th:nth-child(1),
    #tab-pending tbody tr td:nth-child(1) { width:55%; }
    #tab-pending thead tr th:nth-child(2),
    #tab-pending tbody tr td:nth-child(2) { width:15%; }
    #tab-pending thead tr th:nth-child(6),
    #tab-pending tbody tr td:nth-child(6) { width:30%; }

    /* Approved profil: sembunyikan Lokasi(3), NIB(4), Disetujui(5) */
    #subtab-profil thead tr th:nth-child(3),
    #subtab-profil tbody tr td:nth-child(3),
    #subtab-profil thead tr th:nth-child(4),
    #subtab-profil tbody tr td:nth-child(4),
    #subtab-profil thead tr th:nth-child(5),
    #subtab-profil tbody tr td:nth-child(5) { display:none !important; }
    #subtab-profil table { table-layout:fixed; width:100%; }
    #subtab-profil thead tr th:nth-child(1),
    #subtab-profil tbody tr td:nth-child(1) { width:55%; }
    #subtab-profil thead tr th:nth-child(2),
    #subtab-profil tbody tr td:nth-child(2) { width:15%; }
    #subtab-profil thead tr th:nth-child(6),
    #subtab-profil tbody tr td:nth-child(6) { width:30%; }

    /* Rejected: sembunyikan Pemilik(2), Alasan(3), Ditolak(4) */
    #tab-rejected thead tr th:nth-child(2),
    #tab-rejected tbody tr td:nth-child(2),
    #tab-rejected thead tr th:nth-child(3),
    #tab-rejected tbody tr td:nth-child(3),
    #tab-rejected thead tr th:nth-child(4),
    #tab-rejected tbody tr td:nth-child(4) { display:none !important; }
    #tab-rejected table { table-layout:fixed; width:100%; }
    #tab-rejected thead tr th:nth-child(1),
    #tab-rejected tbody tr td:nth-child(1) { width:65%; }
    #tab-rejected thead tr th:nth-child(5),
    #tab-rejected tbody tr td:nth-child(5) { width:35%; }

    thead th { padding:10px 10px !important; font-size:9px !important; }
    tbody td  { padding:10px 10px !important; }

    .submitter { gap:6px; }
    .submitter-avatar { width:32px !important; height:32px !important; font-size:13px !important; }
    .submitter-name { font-size:11px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:110px; }
    .submitter-sub  { display:none; }

    .action-group { flex-direction:column; gap:4px; align-items:stretch; width:100%; }
    .action-group .btn-sm { font-size:11px; padding:6px 4px; white-space:nowrap; justify-content:center; width:100%; display:flex; box-sizing:border-box; min-height:30px; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?> 


<div class="tab-bar">
    <button class="tab-btn" data-tab="pending" onclick="switchTab('pending',this)">
        ⏳ Menunggu
        <?php if($counts['pending'] > 0): ?>
            <span class="count-pill"><?php echo e($counts['pending']); ?></span>
        <?php endif; ?>
    </button>
    <button class="tab-btn" data-tab="approved" onclick="switchTab('approved',this)">
        ✅ Disetujui
        <?php if($counts['approved'] > 0): ?>
            <span class="count-pill" style="background:var(--accent)"><?php echo e($counts['approved']); ?></span>
        <?php endif; ?>
    </button>
    <button class="tab-btn" data-tab="rejected" onclick="switchTab('rejected',this)">
        ✕ Ditolak
        <?php if($counts['rejected'] > 0): ?>
            <span class="count-pill" style="background:#9ca3af"><?php echo e($counts['rejected']); ?></span>
        <?php endif; ?>
    </button>
    <button class="tab-btn" data-tab="deleted" onclick="switchTab('deleted',this)">
        🗑️ Dihapus
        <?php if(($counts['deleted'] ?? 0) > 0): ?>
            <span class="count-pill" style="background:#ef4444"><?php echo e($counts['deleted']); ?></span>
        <?php endif; ?>
    </button>
</div>


<div id="tab-pending" style="display:none">
    <div class="table-card">
    <div class="table-card-header">
    <div class="table-card-title">
        ⏳ Pendaftaran UMKM Menunggu
        <span class="table-card-subtitle"><?php echo e($counts['pending']); ?> pendaftaran</span>
    </div>
    <a href="<?php echo e(route('admin.approval.produk.export-csv', ['status' => 'pending'])); ?>"
       class="btn-csv-export">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
    </a>
</div>

        <?php if($pending->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">🎉</div>
                <div class="empty-state-text">Tidak ada pendaftaran UMKM yang menunggu persetujuan.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Usaha</th>
                        <th>Pemilik</th>
                        <th>Lokasi</th>
                        <th>NIB</th>
                        <th>Didaftarkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--surface2);border:1px solid var(--border);">
                                    <?php if($produk->logo): ?>
                                        <img src="<?php echo e(asset('storage/'.$produk->logo)); ?>" alt="<?php echo e($produk->nama); ?>">
                                    <?php elseif($produk->foto_produk): ?>
                                        <img src="<?php echo e(asset('storage/'.$produk->foto_produk)); ?>" alt="<?php echo e($produk->nama); ?>">
                                    <?php else: ?>
                                        🏪
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($produk->nama); ?></div>
                                    <div class="submitter-sub"><?php echo e($produk->kategori ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:13px;font-weight:600;"><?php echo e($produk->owner ?? '-'); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($produk->kontak ?? '-'); ?></div>
                        </td>
                        <td>
                            <div style="font-size:12px;"><?php echo e($produk->kabupaten_kota ?? '-'); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($produk->provinsi ?? '-'); ?></div>
                        </td>
                        <td style="font-size:12px;color:var(--text-muted);"><?php echo e($produk->nib ?? '-'); ?></td>
                        <td style="font-size:12px;color:var(--text-muted);"><?php echo e($produk->created_at->format('d M Y')); ?></td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal(<?php echo e($produk->id); ?>)">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="<?php echo e(route('admin.approval.produk.approve', $produk)); ?>" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-approve btn-sm">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="12" height="12"><path d="M5 13l4 4L19 7"/></svg>
                                        Setujui
                                    </button>
                                </form>
                                <button class="btn btn-reject btn-sm" onclick="openRejectModal(<?php echo e($produk->id); ?>, '<?php echo e(addslashes($produk->nama)); ?>')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" width="12" height="12"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    Tolak
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>


<div id="tab-approved" style="display:none">

    <div class="sub-tab-bar">
        <button class="sub-tab-btn active" data-subtab="profil" onclick="switchSubTab('profil',this)">
            🏪 Profil UMKM
            <span style="background:var(--accent-light);color:var(--accent);font-size:10px;font-weight:700;padding:1px 7px;border-radius:20px;"><?php echo e($counts['approved']); ?></span>
        </button>
        <button class="sub-tab-btn" data-subtab="produk" onclick="switchSubTab('produk',this)">
            🛍️ Produk Item
        </button>
    </div>

    
    <div id="subtab-profil">
        <div class="table-card">
        <div class="table-card-header">
    <div class="table-card-title">
        🏪 Data UMKM Disetujui
        <span class="table-card-subtitle"><?php echo e($counts['approved']); ?> UMKM aktif</span>
    </div>
    <a href="<?php echo e(route('admin.approval.produk.export-csv', ['status' => 'approved'])); ?>"
       class="btn-csv-export">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
    </a>
</div>

            <?php if($approved->isEmpty()): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <div class="empty-state-text">Belum ada UMKM yang disetujui.</div>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Usaha</th>
                            <th>Pemilik</th>
                            <th>Lokasi</th>
                            <th>NIB</th>
                            <th>Disetujui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="submitter">
                                    <div class="submitter-avatar" style="background:var(--surface2);border:1px solid var(--border);">
                                        <?php if($produk->logo): ?>
                                            <img src="<?php echo e(asset('storage/'.$produk->logo)); ?>" alt="<?php echo e($produk->nama); ?>">
                                        <?php elseif($produk->foto_produk): ?>
                                            <img src="<?php echo e(asset('storage/'.$produk->foto_produk)); ?>" alt="<?php echo e($produk->nama); ?>">
                                        <?php else: ?>
                                            🏪
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="submitter-name"><?php echo e($produk->nama); ?></div>
                                        <div class="submitter-sub"><?php echo e($produk->kategori ?? '-'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-size:13px;font-weight:600;"><?php echo e($produk->owner ?? '-'); ?></div>
                                <div style="font-size:11px;color:var(--text-muted);"><?php echo e($produk->kontak ?? '-'); ?></div>
                            </td>
                            <td>
                                <div style="font-size:12px;"><?php echo e($produk->kabupaten_kota ?? '-'); ?></div>
                                <div style="font-size:11px;color:var(--text-muted);"><?php echo e($produk->provinsi ?? '-'); ?></div>
                            </td>
                            <td style="font-size:12px;color:var(--text-muted);"><?php echo e($produk->nib ?? '-'); ?></td>
                            <td style="font-size:12px;color:var(--accent);font-weight:600;">
                                <?php echo e($produk->approved_at?->format('d M Y') ?? '-'); ?>

                            </td>
                            <td>
                                <div class="action-group">
                                    <button class="btn btn-ghost btn-sm" onclick="openDetailModal(<?php echo e($produk->id); ?>)">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"
    onclick="openHapusUmkmModal(<?php echo e($produk->id); ?>, '<?php echo e(addslashes($produk->nama)); ?>')">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12">
        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 6V4h6v2M4 7h16"/>
    </svg>
    Hapus
</button>
<form id="hapus-umkm-form-<?php echo e($produk->id); ?>" method="POST"
      action="<?php echo e(route('admin.approval.umkm.destroy', $produk)); ?>" style="display:none">
    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
</form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    
<div id="subtab-produk" style="display:none">

    
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
        <div style="font-size:13px;color:var(--text-muted);">
            Menampilkan produk dari UMKM yang telah disetujui
        </div>
        <a href="<?php echo e(route('admin.approval.produk.export-csv', ['status' => 'approved', 'type' => 'items'])); ?>"
           class="btn-csv-export">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export CSV
        </a>
    </div>

    <?php if($approved->isEmpty()): ?>
        <div class="empty-state">
            <div class="empty-state-icon">📦</div>
            <div class="empty-state-text">Belum ada UMKM yang disetujui.</div>
        </div>
    <?php else: ?>
        
        <div class="items-grid" id="produk-cards-grid">
            <?php $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $items     = $produk->items ?? collect();
                $itemCount = $items->count();
                $hargaMin  = $items->min('harga');
                $hargaMax  = $items->max('harga');
            ?>
            <div class="umkm-card produk-card-item" style="display:none">
                <div class="umkm-card-header">
                    <div class="umkm-avatar">
                        <?php if($produk->logo): ?>
                            <img src="<?php echo e(asset('storage/'.$produk->logo)); ?>" alt="<?php echo e($produk->nama); ?>">
                        <?php elseif($produk->foto_produk): ?>
                            <img src="<?php echo e(asset('storage/'.$produk->foto_produk)); ?>" alt="<?php echo e($produk->nama); ?>">
                        <?php else: ?>
                            🏪
                        <?php endif; ?>
                    </div>
                    <div style="flex:1;min-width:0">
                        <div class="umkm-name"><?php echo e($produk->nama); ?></div>
                        <?php if($produk->owner): ?>
                            <div class="umkm-owner">👤 <?php echo e($produk->owner); ?></div>
                        <?php endif; ?>
                        <div class="umkm-meta">
                            <?php if($produk->kategori): ?>
                                <span class="umkm-meta-chip"><?php echo e($produk->kategori); ?></span>
                            <?php endif; ?>
                            <?php if($produk->kabupaten_kota): ?>
                                <span class="umkm-meta-chip">📍 <?php echo e($produk->kabupaten_kota); ?></span>
                            <?php endif; ?>
                            <?php if($itemCount > 0): ?>
                                <span class="harga-range">
                                    Rp <?php echo e(number_format($hargaMin, 0, ',', '.')); ?>

                                    <?php if($hargaMin !== $hargaMax): ?>
                                        – <?php echo e(number_format($hargaMax, 0, ',', '.')); ?>

                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="badge badge-approved"><span class="badge-dot"></span>Aktif</span>
                </div>

                <div style="padding:14px 18px;">
                    <div class="umkm-items-title">
                        <span>🛍️ Produk (<?php echo e($itemCount); ?>)</span>
                        <?php if($itemCount > 0): ?>
                            <button class="btn btn-ghost btn-sm" onclick="openUmkmDetailModal(<?php echo e($produk->id); ?>)">Lihat Semua</button>
                        <?php endif; ?>
                    </div>

                    <?php if($items->isEmpty()): ?>
                        <div class="no-items">Belum ada produk ditambahkan</div>
                    <?php else: ?>
                        <div class="items-scroll">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item-row">
                                <div class="item-thumb">
                                    <?php if($item->foto): ?>
                                        <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama); ?>">
                                    <?php else: ?> 📦 <?php endif; ?>
                                </div>
                                <div style="flex:1;min-width:0">
                                    <div class="item-name" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo e($item->nama); ?></div>
                                    <div class="item-price"><?php echo e($item->harga_format); ?></div>
                                </div>
                                <form method="POST"
                                      action="<?php echo e(route('admin.approval.umkm.item.destroy', [$produk->id, $item->id])); ?>"
                                      onsubmit="return confirm('Hapus produk \"<?php echo e(addslashes($item->nama)); ?>\"?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="item-del-btn" title="Hapus produk">
                                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path d="M18 6L6 18M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($itemCount > 2): ?>
                            <div style="font-size:10px;color:var(--text-muted);text-align:center;padding:4px 0 2px;display:flex;align-items:center;justify-content:center;gap:4px">
                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 9l-7 7-7-7"/></svg>
                                scroll untuk <?php echo e($itemCount - 2); ?> produk lainnya
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="umkm-card-footer">
                    <button class="btn btn-ghost btn-sm" onclick="openUmkmDetailModal(<?php echo e($produk->id); ?>)" style="flex:1;justify-content:center">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Detail Produk
                    </button>
                    <form method="POST"
                          action="<?php echo e(route('admin.approval.umkm.destroy', $produk)); ?>"
                          onsubmit="return confirm('Hapus UMKM \"<?php echo e(addslashes($produk->nama)); ?>\" beserta semua produknya?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 6V4h6v2M4 7h16"/>
                            </svg>
                            Hapus UMKM
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div id="produk-pagination" style="display:flex;align-items:center;justify-content:space-between;margin-top:20px;flex-wrap:wrap;gap:10px;">
            <div style="font-size:12px;color:var(--text-muted);" id="produk-page-info"></div>
            <div style="display:flex;gap:8px;align-items:center;">
                <button class="btn btn-ghost btn-sm" id="btn-produk-prev" onclick="changeProdukPage(-1)" disabled>
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                    Prev
                </button>
                <div id="produk-page-dots" style="display:flex;gap:4px;"></div>
                <button class="btn btn-ghost btn-sm" id="btn-produk-next" onclick="changeProdukPage(1)">
                    Next
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>

</div>


<div id="tab-rejected" style="display:none">
    <div class="table-card">
    <div class="table-card-header">
    <div class="table-card-title">
        ✕ Pendaftaran UMKM Ditolak
        <span class="table-card-subtitle"><?php echo e($counts['rejected']); ?> ditolak</span>
    </div>
    <a href="<?php echo e(route('admin.approval.produk.export-csv', ['status' => 'rejected'])); ?>"
       class="btn-csv-export">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
    </a>
</div>

        <?php if($rejected->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">Tidak ada pendaftaran UMKM yang ditolak.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Usaha</th>
                        <th>Pemilik</th>
                        <th>Alasan Penolakan</th>
                        <th>Ditolak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $rejected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--surface2);border:1px solid var(--border);">
                                    <?php if($produk->logo): ?>
                                        <img src="<?php echo e(asset('storage/'.$produk->logo)); ?>" alt="<?php echo e($produk->nama); ?>">
                                    <?php elseif($produk->foto_produk): ?>
                                        <img src="<?php echo e(asset('storage/'.$produk->foto_produk)); ?>" alt="<?php echo e($produk->nama); ?>">
                                    <?php else: ?>
                                        🏪
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($produk->nama); ?></div>
                                    <div class="submitter-sub"><?php echo e($produk->kategori ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:13px;font-weight:600;"><?php echo e($produk->owner ?? '-'); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($produk->kontak ?? '-'); ?></div>
                        </td>
                        <td style="font-size:12px;color:#e76f51;max-width:200px;line-height:1.5;">
                            <?php echo e(Str::limit($produk->catatan_admin ?? $produk->rejection_reason ?? '-', 60)); ?>

                        </td>
                        <td style="font-size:12px;color:#e76f51;">
                            <?php echo e($produk->rejected_at?->format('d M Y') ?? '-'); ?>

                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal(<?php echo e($produk->id); ?>)">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST"
                                      action="<?php echo e(route('admin.approval.produk.destroy', $produk)); ?>"
                                      style="display:inline;"
                                      onsubmit="return confirm('Hapus data UMKM \"<?php echo e(addslashes($produk->nama)); ?>\"?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 6V4h6v2M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>


<div id="tab-deleted" style="display:none">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                🗑️ UMKM Dihapus Admin
                <span class="table-card-subtitle"><?php echo e($counts['deleted'] ?? 0); ?> data</span>
            </div>
        </div>

        <?php if($deleted->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">✅</div>
                <div class="empty-state-text">Tidak ada UMKM yang dihapus.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Usaha</th>
                        <th>Pemilik</th>
                        <th>Kategori</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $deleted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--surface2);border:1px solid var(--border);">
                                    <?php if($produk->logo): ?>
                                        <img src="<?php echo e(asset('storage/'.$produk->logo)); ?>" alt="<?php echo e($produk->nama); ?>">
                                    <?php elseif($produk->foto_produk): ?>
                                        <img src="<?php echo e(asset('storage/'.$produk->foto_produk)); ?>" alt="<?php echo e($produk->nama); ?>">
                                    <?php else: ?>
                                        🏪
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($produk->nama); ?></div>
                                    <div class="submitter-sub"><?php echo e($produk->kontak ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;"><?php echo e($produk->owner ?? '-'); ?></td>
                        <td style="font-size:12px;color:var(--text-muted);"><?php echo e($produk->kategori ?? '-'); ?></td>
                        <td style="font-size:12px;color:#ef4444;">
                            <?php echo e($produk->deleted_at?->format('d M Y, H:i')); ?>

                        </td>
                        <td>
    <div class="action-group">
        <button type="button" class="btn btn-approve btn-sm"
            onclick="openRestoreModal(<?php echo e($produk->id); ?>, '<?php echo e(addslashes($produk->nama)); ?>')">
            ♻️ Pulihkan
        </button>
        <button type="button" class="btn btn-danger btn-sm"
            onclick="openForceDeleteModal(<?php echo e($produk->id); ?>, '<?php echo e(addslashes($produk->nama)); ?>')">
            🗑️ Hapus Permanen
        </button>
    </div>
    
    <form id="restore-form-<?php echo e($produk->id); ?>" method="POST"
          action="<?php echo e(route('admin.approval.produk.restore', $produk->id)); ?>" style="display:none">
        <?php echo csrf_field(); ?>
    </form>
    <form id="force-delete-form-<?php echo e($produk->id); ?>" method="POST"
          action="<?php echo e(route('admin.approval.produk.force-delete', $produk->id)); ?>" style="display:none">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
    </form>
</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>


<div class="modal-overlay" id="modal-detail">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Detail Pendaftaran UMKM</div>
            <button class="modal-close" onclick="closeModal('modal-detail')">✕</button>
        </div>
        <div class="img-preview" id="detail-img"><span>🏪</span></div>
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Nama Usaha</div>
                <div class="detail-value" id="d-nama">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value" id="d-status">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Kategori</div>
                <div class="detail-value" id="d-kategori">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Pemilik</div>
                <div class="detail-value" id="d-owner">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">NIB</div>
                <div class="detail-value" id="d-nib">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Kontak WA</div>
                <div class="detail-value" id="d-kontak">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Provinsi</div>
                <div class="detail-value" id="d-provinsi">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Kab/Kota</div>
                <div class="detail-value" id="d-kabkota">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Didaftarkan</div>
                <div class="detail-value" id="d-tanggal">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">ID Anggota</div>
                <div class="detail-value" id="d-idtkm">-</div>
            </div>
            <div class="detail-item full">
                <div class="detail-label">Alamat</div>
                <div class="detail-value" id="d-alamat" style="font-weight:400;font-size:13px;">-</div>
            </div>
            <div class="detail-item full">
                <div class="detail-label">Deskripsi</div>
                <div class="detail-value" id="d-deskripsi" style="font-weight:400;line-height:1.6;font-size:13px;color:var(--text-muted);">-</div>
            </div>
            <div class="detail-item full" id="d-reject-wrap" style="display:none">
                <div class="detail-label" style="color:#e76f51">Alasan Penolakan</div>
                <div class="detail-value" id="d-reject" style="font-weight:400;font-size:13px;color:#e76f51;">-</div>
            </div>
        </div>
        <div id="d-action-btns" style="display:flex;gap:10px;margin-top:4px;">
            <button class="btn btn-ghost" style="flex:1" onclick="closeModal('modal-detail')">Tutup</button>
            <button class="btn btn-reject" id="btn-detail-reject" style="flex:1">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M6 18L18 6M6 6l12 12"/></svg>
                Tolak
            </button>
            <button class="btn btn-approve" id="btn-detail-approve" style="flex:1">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M5 13l4 4L19 7"/></svg>
                Setujui
            </button>
        </div>
        <div id="d-close-only" style="display:none;margin-top:4px;">
            <button class="btn btn-ghost" style="width:100%" onclick="closeModal('modal-detail')">Tutup</button>
        </div>
    </div>
</div>


<div class="modal-overlay" id="modal-umkm-items">
    <div class="modal" style="width:600px">
        <div class="modal-header">
            <div class="modal-title">🛍️ Semua Produk UMKM</div>
            <button class="modal-close" onclick="closeModal('modal-umkm-items')">✕</button>
        </div>
        <div style="display:flex;align-items:center;gap:12px;padding:12px;background:var(--surface2);border-radius:12px;margin-bottom:16px">
            <div id="modal-umkm-items-avatar" style="width:44px;height:44px;border-radius:10px;background:var(--border);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;overflow:hidden">🏪</div>
            <div>
                <div id="modal-umkm-items-name" style="font-size:14px;font-weight:700"></div>
                <div id="modal-umkm-items-meta" style="font-size:12px;color:var(--text-muted)"></div>
            </div>
        </div>
        <div id="modal-umkm-items-list" style="display:flex;flex-direction:column;gap:8px;max-height:420px;overflow-y:auto"></div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('modal-umkm-items')">Tutup</button>
        </div>
    </div>
</div>


<div class="modal-overlay" id="modal-reject">
    <div class="modal" style="width:460px">
        <div class="modal-header">
            <div class="modal-title">✕ Tolak Pendaftaran UMKM</div>
            <button class="modal-close" onclick="closeModal('modal-reject')">✕</button>
        </div>
        <p style="font-size:13px;color:var(--text-muted);margin-bottom:16px;line-height:1.6">
            Berikan alasan penolakan untuk <strong id="reject-name"></strong>.
        </p>
        <form id="reject-form" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Alasan Penolakan *</label>
                <textarea name="alasan" class="form-textarea" rows="4"
                    placeholder="Contoh: Data tidak lengkap, NIB tidak valid..." required></textarea>
            </div>
            <div style="display:flex;gap:10px;margin-top:6px">
                <button type="button" class="btn btn-ghost" style="flex:1" onclick="closeModal('modal-reject')">Batal</button>
                <button type="submit" class="btn btn-reject" style="flex:1">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    Konfirmasi Tolak
                </button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="modal-restore">
    <div class="modal" style="width:420px">
        <div class="modal-header">
            <div class="modal-title">♻️ Pulihkan UMKM</div>
            <button class="modal-close" onclick="closeModal('modal-restore')">✕</button>
        </div>
        <div style="text-align:center;padding:10px 0 20px">
            <div style="font-size:48px;margin-bottom:12px">♻️</div>
            <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:8px">
                Pulihkan <span id="restore-umkm-name" style="color:var(--accent)"></span>?
            </div>
            <div style="font-size:13px;color:var(--text-muted);line-height:1.6">
                UMKM ini akan dikembalikan ke status <strong>Menunggu</strong> dan dapat ditinjau ulang oleh admin.
            </div>
        </div>
        <div style="display:flex;gap:10px">
            <button type="button" class="btn btn-ghost" style="flex:1" onclick="closeModal('modal-restore')">Batal</button>
            <button type="button" class="btn btn-approve" style="flex:1" id="btn-confirm-restore">
                ♻️ Ya, Pulihkan
            </button>
        </div>
    </div>
</div>


<div class="modal-overlay" id="modal-force-delete">
    <div class="modal" style="width:420px">
        <div class="modal-header">
            <div class="modal-title">🗑️ Hapus Permanen</div>
            <button class="modal-close" onclick="closeModal('modal-force-delete')">✕</button>
        </div>
        <div style="text-align:center;padding:10px 0 20px">
            <div style="font-size:48px;margin-bottom:12px">⚠️</div>
            <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:8px">
                Hapus permanen <span id="force-delete-umkm-name" style="color:#dc2626"></span>?
            </div>
            <div style="font-size:13px;color:var(--text-muted);line-height:1.6;margin-bottom:12px">
                Semua data UMKM beserta produknya akan <strong>dihapus selamanya</strong> dan tidak dapat dipulihkan kembali.
            </div>
            <div style="background:#fff0ed;border:1px solid #fca5a588;border-radius:10px;padding:10px 14px;font-size:12px;color:#dc2626;font-weight:600;">
                ⚠️ Tindakan ini tidak dapat dibatalkan!
            </div>
        </div>
        <div style="display:flex;gap:10px">
            <button type="button" class="btn btn-ghost" style="flex:1" onclick="closeModal('modal-force-delete')">Batal</button>
            <button type="button" class="btn btn-danger" style="flex:1" id="btn-confirm-force-delete">
                🗑️ Ya, Hapus Permanen
            </button>
        </div>
    </div>
</div>



<script>
// ── Modal Pulihkan ──
function openRestoreModal(id, nama) {
    document.getElementById('restore-umkm-name').textContent = nama;
    document.getElementById('btn-confirm-restore').onclick = () => {
        document.getElementById('restore-form-' + id).submit();
    };
    openModal('modal-restore');
}

// ── Modal Hapus Permanen ──
function openForceDeleteModal(id, nama) {
    document.getElementById('force-delete-umkm-name').textContent = nama;
    document.getElementById('btn-confirm-force-delete').onclick = () => {
        document.getElementById('force-delete-form-' + id).submit();
    };
    openModal('modal-force-delete');
}
const produkData   = <?php echo json_encode($pending->merge($approved)->merge($rejected)->keyBy('id'), 15, 512) ?>;
const approvedData = <?php echo json_encode($approved->keyBy('id'), 15, 512) ?>;
const csrfToken    = '<?php echo e(csrf_token()); ?>';

// ── Produk Item Pagination ──
const PRODUK_PER_PAGE = 6;
let produkCurrentPage = 1;

function initProdukPagination() {
    const cards = document.querySelectorAll('.produk-card-item');
    if (!cards.length) return;
    renderProdukPage(1, cards, Math.ceil(cards.length / PRODUK_PER_PAGE));
}

function renderProdukPage(page, cards, totalPages) {
    if (!cards)      cards      = document.querySelectorAll('.produk-card-item');
    if (!totalPages) totalPages = Math.ceil(cards.length / PRODUK_PER_PAGE);

    produkCurrentPage = page;
    const start = (page - 1) * PRODUK_PER_PAGE;
    const end   = start + PRODUK_PER_PAGE;

    cards.forEach((card, i) => {
        const show = i >= start && i < end;
        card.style.display       = show ? 'flex' : 'none';
        card.style.flexDirection = show ? 'column' : '';
    });

    const infoEl = document.getElementById('produk-page-info');
    if (infoEl) infoEl.textContent = `Menampilkan ${start + 1}–${Math.min(end, cards.length)} dari ${cards.length} UMKM`;

    const prevBtn = document.getElementById('btn-produk-prev');
    const nextBtn = document.getElementById('btn-produk-next');
    if (prevBtn) prevBtn.disabled = page <= 1;
    if (nextBtn) nextBtn.disabled = page >= totalPages;

    const dotsEl = document.getElementById('produk-page-dots');
    if (dotsEl) {
        dotsEl.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const dot = document.createElement('button');
            dot.style.cssText = `
                width:28px;height:28px;border-radius:8px;border:1.5px solid var(--border);
                background:${i === page ? 'var(--accent)' : 'var(--surface)'};
                color:${i === page ? '#fff' : 'var(--text-muted)'};
                font-size:11px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s;
            `;
            dot.textContent = i;
            dot.onclick = () => renderProdukPage(i);
            dotsEl.appendChild(dot);
        }
    }
}

function changeProdukPage(dir) {
    const cards      = document.querySelectorAll('.produk-card-item');
    const totalPages = Math.ceil(cards.length / PRODUK_PER_PAGE);
    const newPage    = produkCurrentPage + dir;
    if (newPage >= 1 && newPage <= totalPages) renderProdukPage(newPage, cards, totalPages);
}

function switchTab(tab, btn) {
    ['pending','approved','rejected','deleted'].forEach(t => {
        document.getElementById('tab-'+t).style.display = t === tab ? 'block' : 'none';
    });
    btn.closest('.tab-bar').querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const url = new URL(window.location);
    url.searchParams.set('tab', tab);
    window.history.replaceState({}, '', url);
}

function switchSubTab(sub, btn) {
    ['profil','produk'].forEach(s => {
        document.getElementById('subtab-'+s).style.display = s === sub ? 'block' : 'none';
    });
    btn.closest('.sub-tab-bar').querySelectorAll('.sub-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const url = new URL(window.location);
    url.searchParams.set('subtab', sub);
    window.history.replaceState({}, '', url);

    if (sub === 'produk') {
        setTimeout(() => initProdukPagination(), 10);
    }
}

// ── Single DOMContentLoaded ──
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const tab    = params.get('tab') || 'pending';
    const subtab = params.get('subtab') || 'profil';

    const tabBtn = document.querySelector(`.tab-btn[data-tab="${tab}"]`);
    if (tabBtn) switchTab(tab, tabBtn);

    if (tab === 'approved') {
        const subBtn = document.querySelector(`.sub-tab-btn[data-subtab="${subtab}"]`);
        if (subBtn) switchSubTab(subtab, subBtn);
        if (subtab === 'produk') setTimeout(() => initProdukPagination(), 50);
    }
});

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
});

function openDetailModal(id) {
    const p = produkData[id];
    if (!p) return;
    const imgEl = document.getElementById('detail-img');
    const foto  = p.logo || p.foto_produk;
    imgEl.innerHTML = foto
        ? `<img src="/storage/${foto}" style="width:100%;height:100%;object-fit:cover">`
        : '<span>🏪</span>';
    document.getElementById('d-nama').textContent      = p.nama ?? '-';
    document.getElementById('d-kategori').textContent  = p.kategori ?? '-';
    document.getElementById('d-owner').textContent     = p.owner ?? '-';
    document.getElementById('d-nib').textContent       = p.nib ?? '-';
    document.getElementById('d-kontak').textContent    = p.kontak ?? '-';
    document.getElementById('d-provinsi').textContent  = p.provinsi ?? '-';
    document.getElementById('d-kabkota').textContent   = p.kabupaten_kota ?? '-';
    document.getElementById('d-idtkm').textContent     = p.id_tkm ?? '-';
    document.getElementById('d-alamat').textContent    = p.alamat ?? '-';
    document.getElementById('d-deskripsi').textContent = p.deskripsi ?? '-';
    document.getElementById('d-tanggal').textContent   = p.created_at
        ? new Date(p.created_at).toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'})
        : '-';
    const statusMap = {
        pending:  '<span class="badge badge-pending"><span class="badge-dot"></span>Menunggu</span>',
        approved: '<span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>',
        rejected: '<span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>',
    };
    document.getElementById('d-status').innerHTML = statusMap[p.status] ?? p.status;
    const rejectWrap = document.getElementById('d-reject-wrap');
    if (p.status === 'rejected' && (p.catatan_admin || p.rejection_reason)) {
        rejectWrap.style.display = 'block';
        document.getElementById('d-reject').textContent = p.catatan_admin || p.rejection_reason;
    } else {
        rejectWrap.style.display = 'none';
    }
    const actionBtns = document.getElementById('d-action-btns');
    const closeOnly  = document.getElementById('d-close-only');
    if (p.status === 'pending') {
        actionBtns.style.display = 'flex';
        closeOnly.style.display  = 'none';
        document.getElementById('btn-detail-approve').onclick = () => { closeModal('modal-detail'); submitApprove(id); };
        document.getElementById('btn-detail-reject').onclick  = () => { closeModal('modal-detail'); openRejectModal(id, p.nama); };
    } else {
        actionBtns.style.display = 'none';
        closeOnly.style.display  = 'block';
    }
    openModal('modal-detail');
}

function openUmkmDetailModal(id) {
    const u = approvedData[id];
    if (!u) return;
    const foto = u.logo || u.foto_produk;
    document.getElementById('modal-umkm-items-avatar').innerHTML = foto
        ? `<img src="/storage/${foto}" style="width:100%;height:100%;object-fit:cover">`
        : '🏪';
    document.getElementById('modal-umkm-items-name').textContent = u.nama;
    document.getElementById('modal-umkm-items-meta').textContent =
        [u.kategori, u.kabupaten_kota ? '📍 '+u.kabupaten_kota : null].filter(Boolean).join(' · ');
    const listEl = document.getElementById('modal-umkm-items-list');
    const items  = u.items || [];
    if (items.length === 0) {
        listEl.innerHTML = '<div class="no-items">Belum ada produk ditambahkan</div>';
    } else {
        listEl.innerHTML = items.map(item => `
            <div style="display:flex;align-items:center;gap:12px;padding:10px 12px;border:1px solid var(--border);border-radius:10px;background:var(--surface2)">
                <div style="width:44px;height:44px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--border);display:flex;align-items:center;justify-content:center;font-size:18px">
                    ${item.foto ? `<img src="/storage/${item.foto}" style="width:100%;height:100%;object-fit:cover">` : '📦'}
                </div>
                <div style="flex:1;min-width:0">
                    <div style="font-size:13px;font-weight:600;color:var(--text)">${_esc(item.nama)}</div>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:2px">
                        ${item.kategori ? item.kategori+' · ' : ''}Stok: ${item.stok ?? '-'} ${item.satuan ?? ''}
                    </div>
                    <div style="font-size:12px;font-weight:700;color:var(--accent);margin-top:3px">
                        Rp ${Number(item.harga).toLocaleString('id-ID')}
                    </div>
                    ${item.deskripsi ? `<div style="font-size:11px;color:var(--text-muted);margin-top:3px;line-height:1.5">${_esc(item.deskripsi)}</div>` : ''}
                </div>
                <form method="POST" action="/admin/approval/produk/${id}/item/${item.id}"
                      onsubmit="return confirm('Hapus produk ini?')">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="item-del-btn">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>
        `).join('');
    }
    openModal('modal-umkm-items');
}

function submitApprove(id) {
    const f = document.createElement('form');
    f.method = 'POST';
    f.action = `/admin/approval/produk/${id}/approve`;
    const t  = document.createElement('input');
    t.type='hidden'; t.name='_token'; t.value=csrfToken;
    f.appendChild(t); document.body.appendChild(f); f.submit();
}

function openRejectModal(id, nama) {
    document.getElementById('reject-name').textContent = nama;
    document.getElementById('reject-form').action = `/admin/approval/produk/${id}/reject`;
    document.getElementById('reject-form').querySelector('textarea').value = '';
    openModal('modal-reject');
}

function _esc(s) {
    if (!s) return '';
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function openHapusUmkmModal(id, nama) {
    document.getElementById('hapus-umkm-name').textContent = nama;
    document.getElementById('btn-confirm-hapus-umkm').onclick = () => {
        document.getElementById('hapus-umkm-form-' + id).submit();
    };
    openModal('modal-hapus-umkm');
}
</script>

<div class="modal-overlay" id="modal-hapus-umkm">
    <div class="modal" style="width:420px">
        <div class="modal-header">
            <div class="modal-title">🗑️ Hapus UMKM</div>
            <button class="modal-close" onclick="closeModal('modal-hapus-umkm')">✕</button>
        </div>
        <div style="text-align:center;padding:10px 0 20px">
            <div style="font-size:48px;margin-bottom:12px">⚠️</div>
            <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:8px">
                Hapus <span id="hapus-umkm-name" style="color:#dc2626"></span>?
            </div>
            <div style="font-size:13px;color:var(--text-muted);line-height:1.6;margin-bottom:12px">
                Data UMKM beserta semua produknya akan dipindahkan ke tab <strong>Dihapus</strong> dan masih bisa dipulihkan.
            </div>
            <div style="background:#fff0ed;border:1px solid #fca5a588;border-radius:10px;padding:10px 14px;font-size:12px;color:#dc2626;font-weight:600;">
                ⚠️ Konfirmasi sebelum melanjutkan
            </div>
        </div>
        <div style="display:flex;gap:10px">
            <button type="button" class="btn btn-ghost" style="flex:1" onclick="closeModal('modal-hapus-umkm')">Batal</button>
            <button type="button" class="btn btn-danger" style="flex:1" id="btn-confirm-hapus-umkm">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 6V4h6v2M4 7h16"/>
                </svg>
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/admin/approval-produk.blade.php ENDPATH**/ ?>