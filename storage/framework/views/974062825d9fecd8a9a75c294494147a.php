<?php $__env->startSection('page-title', 'Approval Program'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
<style>
.tipe-chip.active-deleted { background: #fef2f2; color: #991b1b; border-color: #fca5a5; }
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
    .btn-csv-export {
        font-size: 11px;
        padding: 5px 10px;
    }
}

/* Tombol hapus */
.btn-delete {
    background: #fff7ed;
    color: #c2410c;
    border: 1.5px solid #fed7aa;
}
.btn-delete:hover {
    background: #ffedd5;
    border-color: #fb923c;
}

/* SweetAlert konfirmasi hapus */
.swal-btn-confirm-delete {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
    background: #ea580c; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
}
.swal-btn-confirm-delete:hover { background: #c2410c; }

/* Mobile: tombol hapus tetap muncul */
@media (max-width: 768px) {
    .btn-delete {
        font-size: 10px !important;
        padding: 4px 6px !important;
    }
}
    .swal-btn-confirm-approve {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #10b981; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-confirm-approve:hover { background: #059669; }
    .swal-btn-confirm-reject {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #ef4444; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-confirm-reject:hover { background: #dc2626; }
    .swal-btn-cancel {
        display: inline-flex; align-items: center;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
        background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-cancel:hover { background: #e5e7eb; }
    .swal2-popup { border-radius: 16px !important; padding: 32px 28px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; color: #111827 !important; }
    .swal2-actions { gap: 10px !important; margin-top: 24px !important; }

    /* ── Filter tipe chips ── */
    .tipe-filter { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
    .tipe-chip {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;
        border: 1.5px solid var(--border, #e5e7eb); background: #f9fafb;
        color: #6b7280; cursor: pointer; text-decoration: none; transition: all .15s;
    }
    .tipe-chip:hover { border-color: #6b7280; color: #374151; }
    .tipe-chip.active-all       { background: #1f2937; color: #fff; border-color: #1f2937; }
    .tipe-chip.active-kurikulum { background: #dbeafe; color: #1d4ed8; border-color: #93c5fd; }
    .tipe-chip.active-modul     { background: #dcfce7; color: #15803d; border-color: #86efac; }
    .tipe-chip .chip-count {
        background: rgba(0,0,0,.12); border-radius: 20px;
        padding: 1px 6px; font-size: 10px; font-weight: 700;
    }

    /* ── Badge tipe di tabel ── */
    .badge-tipe-kurikulum { background:#dbeafe;color:#1d4ed8;border:1px solid #93c5fd; }
    .badge-tipe-modul     { background:#dcfce7;color:#15803d;border:1px solid #86efac; }

    /* ── Info box di modal detail ── */
    .info-grid {
        display: grid; grid-template-columns: repeat(3,1fr); gap: 10px;
        background: #f9fafb; border: 1px solid #e5e7eb;
        border-radius: 12px; padding: 14px; margin-bottom: 14px;
    }
    .info-grid-item { text-align: center; }
    .info-grid-item .ig-val  { font-size: 18px; font-weight: 800; color: #111827; }
    .info-grid-item .ig-label{ font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: .06em; margin-top: 2px; }
    .sertifikat-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: #fef9c3; color: #854d0e; border: 1px solid #fde68a;
        border-radius: 20px; padding: 4px 12px; font-size: 12px; font-weight: 600;
    }
    .kurikulum-ref {
        display: flex; align-items: center; gap: 8px;
        background: #dbeafe; border: 1px solid #93c5fd; border-radius: 10px;
        padding: 10px 14px; margin-bottom: 14px; font-size: 13px;
    }
    .kurikulum-ref .kr-icon { font-size: 18px; }
    .kurikulum-ref .kr-label { font-size: 10px; color: #3b82f6; text-transform: uppercase; letter-spacing: .06em; }
    .kurikulum-ref .kr-title { font-weight: 700; color: #1d4ed8; }

    .tipe-chip.active-pendaftaran { background: #fef3c7; color: #92400e; border-color: #fde68a; }

    /* ===================== RESPONSIVE MOBILE ===================== */

    /* Tab bar: scroll horizontal jika muat */
    @media (max-width: 768px) {
        .tab-bar {
            width: 100% !important;
            overflow-x: auto !important;
            flex-wrap: nowrap !important;
            -webkit-overflow-scrolling: touch;
        }

        .tab-btn {
            white-space: nowrap !important;
            flex-shrink: 0 !important;
        }

        /* Chips filter tipe */
        .tipe-filter {
            gap: 6px !important;
        }

        .tipe-chip {
            font-size: 11px !important;
            padding: 4px 10px !important;
        }

        /* Table card */
        .table-card {
            border-radius: 12px !important;
        }

        /* Sembunyikan kolom yang tidak penting di mobile */
        /* Kolom Tipe (duplikat, sudah ada di preview-meta) */
        .table-card table thead tr th:nth-child(2),
        .table-card table tbody tr td:nth-child(2) {
            display: none !important;
        }

        /* Kolom Metode/Induk */
        .table-card table thead tr th:nth-child(4),
        .table-card table tbody tr td:nth-child(4) {
            display: none !important;
        }

        /* Kolom Diajukan (tanggal) */
        .table-card table thead tr th:nth-child(5),
        .table-card table tbody tr td:nth-child(5) {
            display: none !important;
        }

        /* Kolom Status */
        .table-card table thead tr th:nth-child(6),
        .table-card table tbody tr td:nth-child(6) {
            display: none !important;
        }

        /* Ukuran kolom yang tersisa */
        .table-card table {
            table-layout: fixed !important;
            width: 100% !important;
        }

        /* Kolom Program */
        .table-card table thead tr th:nth-child(1),
        .table-card table tbody tr td:nth-child(1) {
            width: 40% !important;
        }

        /* Kolom Trainer */
        .table-card table thead tr th:nth-child(3),
        .table-card table tbody tr td:nth-child(3) {
            width: 30% !important;
        }

        /* Kolom Aksi */
        .table-card table thead tr th:nth-child(7),
        .table-card table tbody tr td:nth-child(7) {
            width: 30% !important;
        }

        /* Preview cell */
        .preview-cell {
            gap: 6px !important;
        }

        .preview-thumb {
            width: 34px !important;
            height: 34px !important;
            font-size: 14px !important;
            flex-shrink: 0 !important;
        }

        .preview-name {
            font-size: 11px !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            max-width: 90px !important;
        }

        .preview-meta {
            font-size: 10px !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            max-width: 90px !important;
        }

        /* Submitter (trainer) */
        .submitter-avatar {
            width: 26px !important;
            height: 26px !important;
            font-size: 9px !important;
            border-radius: 6px !important;
            flex-shrink: 0 !important;
        }

        .submitter-name {
            font-size: 11px !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            max-width: 70px !important;
        }

        .submitter-sub {
            display: none !important;
        }

        /* Tombol aksi: susun vertikal */
        .action-group {
            flex-direction: column !important;
            gap: 4px !important;
        }

        .action-group .btn-sm {
            font-size: 10px !important;
            padding: 4px 6px !important;
            white-space: nowrap !important;
        }

        /* Sembunyikan tombol ikon detail di mobile (hemat ruang) */
        .action-group .btn-icon {
            display: none !important;
        }

        /* Thead padding */
        thead th {
            padding: 10px 10px !important;
            font-size: 9px !important;
        }

        tbody td {
            padding: 10px 10px !important;
        }

        /* Pagination */
        .pagination {
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 4px !important;
        }

        /* ── Modal: slide dari bawah ── */
        .modal-overlay {
            align-items: flex-end !important;
            padding: 0 !important;
        }

        .modal {
            width: 100% !important;
            max-width: 100% !important;
            border-radius: 20px 20px 0 0 !important;
            padding: 20px 16px 28px !important;
            max-height: 88vh !important;
        }

        /* Info grid di modal */
        .info-grid {
            grid-template-columns: repeat(3, 1fr) !important;
            padding: 10px !important;
        }

        .ig-val {
            font-size: 15px !important;
        }

        /* Detail grid di modal: 1 kolom */
        .detail-grid {
            grid-template-columns: 1fr !important;
        }

        .detail-item.full {
            grid-column: 1 !important;
        }

        /* Tombol di footer modal */
        #modal-detail .modal > div:last-child,
        #modal-reject .modal > div:last-child {
            flex-direction: column-reverse !important;
        }

        /* Form reject textarea */
        .form-textarea {
            font-size: 14px !important;
        }

        /* SweetAlert2 di mobile */
        .swal2-popup {
            width: 92% !important;
            padding: 24px 18px !important;
        }

        /* Table card header */
        .table-card-header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 6px !important;
            padding: 12px 14px !important;
        }
    }

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php
    $activeTab = request('tab', 'program');
    $statusDaftarMap = ['pending' => 'menunggu_verifikasi', 'approved' => 'diterima', 'rejected' => 'ditolak'];
?>
<div class="tab-bar">
<button class="tab-btn <?php echo e($status === 'pending' && $activeTab !== 'deleted' ? 'active' : ''); ?>"
    onclick="navigateTo({ status: 'pending' })">
    Pending
        <?php if($counts['pending'] > 0): ?>
            <span class="count-pill" data-count="pending"><?php echo e($counts['pending']); ?></span>
        <?php else: ?>
            <span class="count-pill" data-count="pending" style="display:none;">0</span>
        <?php endif; ?>
    </button>
    <button class="tab-btn <?php echo e($status === 'approved' && $activeTab !== 'deleted' ? 'active' : ''); ?>"
    onclick="navigateTo({ status: 'approved' })">
    Disetujui
        <?php if($counts['approved'] > 0): ?>
            <span class="count-pill" data-count="approved" style="background:var(--accent);"><?php echo e($counts['approved']); ?></span>
        <?php else: ?>
            <span class="count-pill" data-count="approved" style="background:var(--accent);display:none;">0</span>
        <?php endif; ?>
    </button>
    <button class="tab-btn <?php echo e($status === 'rejected' && $activeTab !== 'deleted' ? 'active' : ''); ?>"
    onclick="navigateTo({ status: 'rejected' })">
    Ditolak
        <?php if($counts['rejected'] > 0): ?>
            <span class="count-pill" data-count="rejected" style="background:#9ca3af;"><?php echo e($counts['rejected']); ?></span>
        <?php else: ?>
            <span class="count-pill" data-count="rejected" style="background:#9ca3af;display:none;">0</span>
        <?php endif; ?>
    </button>
    <button class="tab-btn <?php echo e($activeTab === 'deleted' ? 'active' : ''); ?>"
        onclick="navigateTo({ tab: 'deleted' })"
        style="<?php echo e($activeTab === 'deleted' ? '' : ''); ?>">
        🗑️ Dihapus
        <?php if(($counts['deleted'] ?? 0) > 0): ?>
            <span class="count-pill" data-count="deleted" style="background:#ef4444;"><?php echo e($counts['deleted']); ?></span>
        <?php else: ?>
            <span class="count-pill" data-count="deleted" style="background:#ef4444;display:none;">0</span>
        <?php endif; ?>
        </button>
</div>


<div class="tipe-filter">
    <a href="javascript:void(0)"
       onclick="navigateTo({ tipe: 'all', tab: 'program' })"
       class="tipe-chip <?php echo e($activeTab === 'program' && $tipe === 'all' ? 'active-all' : ''); ?>">
        📋 Semua
        <span class="chip-count" data-chip="all"><?php echo e($countTipe['all']); ?></span>
    </a>
    <a href="javascript:void(0)"
       onclick="navigateTo({ tipe: 'kurikulum', tab: 'program' })"
       class="tipe-chip <?php echo e($activeTab === 'program' && $tipe === 'kurikulum' ? 'active-kurikulum' : ''); ?>">
        📚 Kurikulum
        <span class="chip-count" data-chip="kurikulum"><?php echo e($countTipe['kurikulum']); ?></span>
    </a>
    <a href="javascript:void(0)"
       onclick="navigateTo({ tipe: 'modul', tab: 'program' })"
       class="tipe-chip <?php echo e($activeTab === 'program' && $tipe === 'modul' ? 'active-modul' : ''); ?>">
        📝 Modul
        <span class="chip-count" data-chip="modul"><?php echo e($countTipe['modul']); ?></span>
    </a>
    <a href="javascript:void(0)"
       onclick="navigateTo({ tab: 'pendaftaran' })"
       class="tipe-chip <?php echo e($activeTab === 'pendaftaran' ? 'active-pendaftaran' : ''); ?>">
        📩 Pendaftaran
        <span class="chip-count" data-chip="pendaftaran"
            style="<?php echo e($countsDaftar['menunggu_verifikasi'] > 0 ? '' : 'display:none;'); ?>">
            <?php echo e($countsDaftar['menunggu_verifikasi']); ?>

        </span>
    </a>
</div>

<?php if(request('tab') !== 'pendaftaran' && request('tab') !== 'deleted'): ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            🎓 Daftar Program Pelatihan
            <span class="table-card-subtitle"><?php echo e($programs->total()); ?> program</span>
        </div>
        <a href="<?php echo e(route('admin.approval.program.export-csv', array_filter([
            'status' => $status,
            'tipe'   => $tipe,
            'tab'    => 'program',
        ]))); ?>"
           class="btn-csv-export">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export CSV
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Program</th>
                <th>Tipe</th>
                <th>Trainer</th>
                <th>Metode / Induk</th>
                <th>Diajukan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $st = $program->status ?? 'pending'; ?>
            <tr>
                
                <td>
                    <div class="preview-cell">
                        <div class="preview-thumb">
                            <?php if($program->gambar): ?>
                                <img src="<?php echo e(asset('storage/' . $program->gambar)); ?>" alt="<?php echo e($program->judul); ?>"
                                    style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                            <?php else: ?>
                                <?php echo e($program->tipe === 'modul' ? '📝' : '📚'); ?>

                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="preview-name"><?php echo e($program->judul ?? $program->nama); ?></div>
                            <div class="preview-meta"><?php echo e(Str::limit($program->deskripsi ?? '', 40)); ?></div>
                        </div>
                    </div>
                </td>

                
                <td>
                    <?php if($program->tipe === 'kurikulum'): ?>
                        <span class="badge badge-tipe-kurikulum" style="display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">
                            📚 Kurikulum
                        </span>
                    <?php elseif($program->tipe === 'modul'): ?>
                        <span class="badge badge-tipe-modul" style="display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">
                            📝 Modul
                        </span>
                        <?php if($program->urutan): ?>
                        <div style="font-size:10px;color:#9ca3af;margin-top:2px;">Urutan #<?php echo e($program->urutan); ?></div>
                        <?php endif; ?>
                    <?php else: ?>
                        <span style="font-size:12px;color:#9ca3af;"><?php echo e(ucfirst($program->tipe ?? '-')); ?></span>
                    <?php endif; ?>
                </td>

                
                <td>
                    <?php if($program->trainer): ?>
                    <div class="submitter">
                        <div class="submitter-avatar" style="background:var(--accent);">
                            <?php echo e(strtoupper(substr($program->trainer->name ?? 'T', 0, 2))); ?>

                        </div>
                        <div>
                            <div class="submitter-name"><?php echo e($program->trainer->name ?? '-'); ?></div>
                            <div class="submitter-sub">Trainer</div>
                        </div>
                    </div>
                    <?php else: ?>
                    <span style="color:var(--text-muted);font-size:12px;">-</span>
                    <?php endif; ?>
                </td>

                
                <td style="font-size:12px;">
                    <?php if($program->tipe === 'modul'): ?>
                        <?php
                            $induk = $program->kurikulum_id
                                ? \App\Models\Program::find($program->kurikulum_id)
                                : null;
                        ?>
                        <?php if($induk): ?>
                            <span style="color:#1d4ed8;font-weight:600;">📚 <?php echo e(Str::limit($induk->judul, 25)); ?></span>
                        <?php else: ?>
                            <span style="color:#9ca3af;">—</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo e(ucfirst($program->metode ?? '-')); ?>

                    <?php endif; ?>
                </td>

                
                <td style="font-size:12px;color:var(--text-muted);">
                    <?php echo e($program->created_at->format('d M Y')); ?>

                </td>

                
                <td>
                    <?php if($st === 'approved'): ?>
                        <span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>
                    <?php elseif($st === 'rejected'): ?>
                        <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
                    <?php else: ?>
                        <span class="badge badge-pending"><span class="badge-dot"></span>Pending</span>
                    <?php endif; ?>
                </td>

                
<td>
    <div class="action-group">
        <button class="btn btn-ghost btn-sm btn-icon" title="Detail"
            onclick="openDetailModal(<?php echo e($program->id); ?>)">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </button>

        <?php if($st !== 'approved'): ?>
        <form method="POST" action="<?php echo e(route('admin.approval.program.approve', $program->id)); ?>"
            id="form-approve-<?php echo e($program->id); ?>" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="button" class="btn btn-approve btn-sm"
                onclick="confirmApprove(<?php echo e($program->id); ?>, '<?php echo e(addslashes($program->judul ?? $program->nama)); ?>')">
                ✓ Setujui
            </button>
        </form>
        <?php endif; ?>

        <?php if($st !== 'rejected'): ?>
        <button class="btn btn-reject btn-sm"
            onclick="confirmReject(<?php echo e($program->id); ?>, '<?php echo e(addslashes($program->judul ?? $program->nama)); ?>')">
            ✕ Tolak
        </button>
        <?php endif; ?>

        
        <?php if($st === 'approved'): ?>
        <form method="POST" action="<?php echo e(route('admin.approval.program.delete', $program->id)); ?>"
            id="form-delete-<?php echo e($program->id); ?>" style="display:none;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
        <button type="button" class="btn btn-delete btn-sm"
            onclick="confirmDelete(<?php echo e($program->id); ?>, '<?php echo e(addslashes($program->judul ?? $program->nama)); ?>', '<?php echo e($program->tipe); ?>')">
            🗑️ Hapus
        </button>
        <?php endif; ?>
    </div>
</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <div class="empty-state-icon">🎉</div>
                        <div class="empty-state-text">Tidak ada program dengan status ini</div>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($programs->hasPages()): ?>
    <div style="padding:14px 18px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;">
        <?php echo e($programs->withQueryString()->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php endif; ?> 

<?php if(request('tab') === 'deleted'): ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            🗑️ Program Dihapus Admin
            <span class="table-card-subtitle"><?php echo e($deletedLogs->total()); ?> program</span>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Judul Program</th>
                <th>Tipe</th>
                <th>Trainer</th>
                <th>Dihapus Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $deletedLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;font-size:13px;"><?php echo e($log->program_title); ?></div>
                </td>
                <td>
                    <?php if($log->program_tipe === 'kurikulum'): ?>
                        <span class="badge badge-tipe-kurikulum" style="display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">
                            📚 Kurikulum
                        </span>
                    <?php elseif($log->program_tipe === 'modul'): ?>
                        <span class="badge badge-tipe-modul" style="display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">
                            📝 Modul
                        </span>
                    <?php else: ?>
                        <span style="font-size:12px;color:#9ca3af;"><?php echo e(ucfirst($log->program_tipe ?? '-')); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php $trainer = \App\Models\User::find($log->trainer_user_id); ?>
                    <?php if($trainer): ?>
                    <div class="submitter">
                        <div class="submitter-avatar" style="background:var(--accent);">
                            <?php echo e(strtoupper(substr($trainer->name, 0, 2))); ?>

                        </div>
                        <div>
                            <div class="submitter-name"><?php echo e($trainer->name); ?></div>
                            <div class="submitter-sub">Trainer</div>
                        </div>
                    </div>
                    <?php else: ?>
                        <span style="color:#9ca3af;font-size:12px;">—</span>
                    <?php endif; ?>
                </td>
                <td style="font-size:12px;color:var(--text-muted);">
                    <?php echo e($log->deleted_at_by_admin?->format('d M Y, H:i')); ?>

                </td>
                <td>
                    <div class="action-group">
                    <form method="POST"
    action="<?php echo e(route('admin.approval.program.restore', $log->id)); ?>"
    id="form-restore-<?php echo e($log->id); ?>" style="display:none;">
    <?php echo csrf_field(); ?>
</form>
<button type="button" class="btn btn-approve btn-sm"
    onclick="confirmRestoreProgram(<?php echo e($log->id); ?>, '<?php echo e(addslashes($log->program_title)); ?>')">
    ♻️ Pulihkan
</button>

<form method="POST"
    action="<?php echo e(route('admin.approval.program.deleted.destroy', $log->id)); ?>"
    id="form-destroy-log-<?php echo e($log->id); ?>" style="display:none;">
    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
</form>
<button type="button" class="btn btn-delete btn-sm"
    onclick="confirmDestroyLog(<?php echo e($log->id); ?>, '<?php echo e(addslashes($log->program_title)); ?>')">
    🗑️ Hapus Log
</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <div class="empty-state-icon">✅</div>
                        <div class="empty-state-text">Tidak ada program yang dihapus</div>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($deletedLogs->hasPages()): ?>
    <div style="padding:14px 18px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;">
        <?php echo e($deletedLogs->withQueryString()->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php endif; ?>



<?php if(request('tab') === 'pendaftaran'): ?>
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            📩 Pendaftaran Program
            <span class="table-card-subtitle"><?php echo e($pendaftarans->total()); ?> pendaftaran</span>
        </div>
        <a href="<?php echo e(route('admin.approval.program.export-csv', array_filter([
            'status'        => $status,
            'tab'           => 'pendaftaran',
            'status_daftar' => $statusDaftar,
        ]))); ?>"
           class="btn-csv-export">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export CSV
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Pendaftar</th>
                <th>Program</th>
                <th>Kontak</th>
                <th>Bukti Bayar</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div class="submitter">
                        <div class="submitter-avatar" style="background:var(--accent);">
                            <?php echo e(strtoupper(substr($p->nama_lengkap, 0, 2))); ?>

                        </div>
                        <div>
                            <div class="submitter-name"><?php echo e($p->nama_lengkap); ?></div>
                            <div class="submitter-sub"><?php echo e($p->email); ?></div>
                        </div>
                    </div>
                </td>
                <td>
                    <div style="font-size:13px;font-weight:600;color:#111827;"><?php echo e($p->program->judul ?? '-'); ?></div>
                    <?php if($p->program): ?>
                        <?php
                            $isBerbayar = !empty($p->program->biaya)
                                && strtolower($p->program->biaya) !== 'gratis'
                                && $p->program->biaya != 0;
                        ?>
                        <span style="<?php echo e($isBerbayar ? 'background:#fef3c7;color:#92400e;border:1px solid #fde68a;' : 'background:#d1fae5;color:#065f46;border:1px solid #6ee7b7;'); ?> font-size:10px;padding:2px 8px;border-radius:20px;display:inline-block;margin-top:2px;">
                            <?php echo e($isBerbayar ? '💳 Berbayar' : '✅ Gratis'); ?>

                        </span>
                    <?php endif; ?>
                </td>
                <td style="font-size:12px;color:var(--text-muted);">
                    <?php echo e($p->no_hp); ?>

                    <?php if($p->alamat): ?><div style="font-size:11px;"><?php echo e(Str::limit($p->alamat, 30)); ?></div><?php endif; ?>
                </td>
                <td>
                    <?php if($p->bukti_pembayaran): ?>
                        <a href="<?php echo e(asset('storage/' . $p->bukti_pembayaran)); ?>" target="_blank"
                           class="btn btn-ghost btn-sm" style="font-size:11px;">🖼️ Lihat Bukti</a>
                    <?php else: ?>
                        <span style="font-size:12px;color:#9ca3af;">— Gratis —</span>
                    <?php endif; ?>
                </td>
                <td style="font-size:12px;color:var(--text-muted);"><?php echo e($p->created_at->format('d M Y')); ?></td>
                <td>
                    <?php if($p->status === 'diterima'): ?>
                        <span class="badge badge-approved"><span class="badge-dot"></span>Diterima</span>
                        <?php elseif($p->status === 'ditolak'): ?>
    <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
    <?php if($p->alasan_penolakan): ?>
        <div style="font-size:10px;color:#ef4444;margin-top:3px;max-width:140px;line-height:1.4;">
            <?php echo e(Str::limit($p->alasan_penolakan, 50)); ?>

        </div>
    <?php endif; ?>
                    <?php else: ?>
                        <span class="badge badge-pending"><span class="badge-dot"></span>Menunggu</span>
                    <?php endif; ?>
                </td>
                <td>
    <div class="action-group">
        <?php if($p->status !== 'diterima'): ?>
        <form method="POST" action="<?php echo e(route('admin.pendaftaran.approve', $p->id)); ?>"
            id="form-approve-daftar-<?php echo e($p->id); ?>" style="display:none;">
            <?php echo csrf_field(); ?>
        </form>
        <button type="button" class="btn btn-approve btn-sm"
            onclick="confirmApproveDaftar(<?php echo e($p->id); ?>, '<?php echo e(addslashes($p->nama_lengkap)); ?>')">
            ✓ Terima
        </button>
        <?php endif; ?>
        <?php if($p->status !== 'ditolak'): ?>
        <button type="button" class="btn btn-reject btn-sm"
            onclick="confirmRejectDaftar(<?php echo e($p->id); ?>, '<?php echo e(addslashes($p->nama_lengkap)); ?>')">
            ✕ Tolak
        </button>
        <?php endif; ?>
    </div>
</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <div class="empty-state-icon">🎉</div>
                        <div class="empty-state-text">Tidak ada pendaftaran</div>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($pendaftarans->hasPages()): ?>
    <div style="padding:14px 18px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;">
        <?php echo e($pendaftarans->withQueryString()->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php endif; ?>

<div class="modal-overlay" id="modal-detail">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" id="detail-modal-title">Detail Program</div>
            <button class="modal-close" onclick="closeModal('modal-detail')">✕</button>
        </div>

        <div class="img-preview" id="detail-img">📚</div>

        
        <div id="detail-kurikulum-info" style="display:none;margin-bottom:14px;">
            <div class="info-grid">
                <div class="info-grid-item">
                    <div class="ig-val" id="d-jumlah-materi">-</div>
                    <div class="ig-label">Jumlah Materi</div>
                </div>
                <div class="info-grid-item">
                    <div class="ig-val" id="d-total-jam">-</div>
                    <div class="ig-label">Total Jam</div>
                </div>
                <div class="info-grid-item">
                    <div class="ig-val" id="d-jumlah-sesi">-</div>
                    <div class="ig-label">Jumlah Sesi</div>
                </div>
            </div>
            <div id="d-sertifikat-wrap" style="margin-bottom:8px;"></div>
        </div>

        
        <div id="detail-modul-induk" class="kurikulum-ref" style="display:none;">
            <div class="kr-icon">📚</div>
            <div>
                <div class="kr-label">Bagian dari Kurikulum</div>
                <div class="kr-title" id="d-induk-judul">—</div>
            </div>
            <div style="margin-left:auto;font-size:12px;color:#3b82f6;font-weight:700;" id="d-induk-urutan"></div>
        </div>

        <div class="detail-grid" id="detail-grid"></div>

        <div class="detail-item full" id="d-reject-wrap" style="display:none;margin-bottom:12px;">
            <div class="detail-label" style="color:var(--accent2);font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">Alasan Penolakan</div>
            <div class="detail-value" id="d-reject" style="font-weight:400;font-size:13px;color:var(--accent2);"></div>
        </div>

        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:4px;">
            <button class="btn btn-ghost btn-sm" onclick="closeModal('modal-detail')">Tutup</button>
            <button class="btn btn-reject btn-sm" id="btn-detail-reject" style="display:none;">✕ Tolak</button>
            <button class="btn btn-approve btn-sm" id="btn-detail-approve" style="display:none;">✓ Setujui</button>
        </div>
    </div>
</div>



<div class="modal-overlay" id="modal-reject">
    <div class="modal" style="max-width:460px;">
        <div class="modal-header">
            <div class="modal-title">Tolak Program</div>
            <button class="modal-close" onclick="closeModal('modal-reject')">✕</button>
        </div>
        <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:18px;line-height:1.6;">
            Berikan alasan penolakan untuk <strong id="reject-name"></strong>. Alasan ini akan tersimpan sebagai catatan untuk trainer.
        </p>
        <form id="form-reject" method="POST">
    <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Alasan Penolakan *</label>
                <textarea name="catatan" class="form-textarea" rows="4"
                    placeholder="Contoh: Deskripsi kurang lengkap, judul tidak sesuai kategori..."
                    required></textarea>
            </div>
            <div style="display:flex;gap:10px;margin-top:6px;">
                <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-reject')">Batal</button>
                <button type="submit" class="btn btn-reject" style="flex:1;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Konfirmasi Tolak
                </button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="modal-tolak-daftar">
    <div class="modal" style="max-width:460px;">
        <div class="modal-header">
            <div class="modal-title">Tolak Pendaftaran</div>
            <button class="modal-close" onclick="closeModal('modal-tolak-daftar')">✕</button>
        </div>
        <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:18px;line-height:1.6;">
            Pendaftar: <strong id="tolak-daftar-nama"></strong>
        </p>
        <form id="form-tolak-daftar" method="POST">
    <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Alasan Penolakan <span style="color:#ef4444;">*</span></label>
                <textarea name="alasan_penolakan" class="form-textarea" rows="4" required
                    placeholder="Contoh: Bukti pembayaran tidak valid, data tidak lengkap..."></textarea>
            </div>
            <div style="display:flex;gap:10px;margin-top:6px;">
                <button type="button" class="btn btn-ghost" style="flex:1;"
                    onclick="closeModal('modal-tolak-daftar')">Batal</button>
                <button type="submit" class="btn btn-reject" style="flex:1;">
                    ✕ Konfirmasi Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function confirmRestoreProgram(id, title) {
    swalApprove.fire({
        title: 'Pulihkan Program?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Program <strong>${title}</strong> akan dikembalikan ke status <strong>Pending</strong> dan dapat ditinjau ulang.
               </span>`,
        icon: 'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '♻️ Ya, Pulihkan',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) document.getElementById('form-restore-' + id).submit();
    });
}

function confirmDestroyLog(id, title) {
    swalDelete.fire({
        title: 'Hapus Log Permanen?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Log program <strong>${title}</strong> akan dihapus secara permanen.<br>
                <span style="color:#ef4444;font-size:13px;margin-top:6px;display:block;">
                    ⚠️ Tindakan ini tidak dapat dibatalkan.
                </span>
               </span>`,
        icon: 'warning', iconColor: '#ea580c',
        showCancelButton: true,
        confirmButtonText: '🗑️ Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) document.getElementById('form-destroy-log-' + id).submit();
    });
}

const _state = {
    status:        '<?php echo e($status); ?>',
    tipe:          '<?php echo e($tipe); ?>',
    tab:           '<?php echo e(request("tab", "program")); ?>',
    status_daftar: '<?php echo e($statusDaftar); ?>',
};

const _statusDaftarMap = {
    pending:  'menunggu_verifikasi',
    approved: 'diterima',
    rejected: 'ditolak',
};

// ─── Navigasi terpusat ────────────────────────────────────────────────────────
function navigateTo(overrides) {
    const next = { ..._state, ...overrides };

    if ('status' in overrides && !('tab' in overrides)) {
        next.tab = 'program';
    }

    // Jika buka tab pendaftaran: sesuaikan status_daftar dengan tab aktif
    if (next.tab === 'pendaftaran') {
        next.status_daftar = _statusDaftarMap[next.status] ?? 'menunggu_verifikasi';
        // tipe tidak relevan untuk pendaftaran, reset ke all
        next.tipe = 'all';
    }

    if (next.tab === 'deleted') {   // ← tambah ini
        next.tipe = 'all';
        next.status = 'pending';
    }

    // Jika balik ke tab program: pastikan tipe ada
    if (next.tab === 'program') {
        next.tipe = next.tipe ?? 'all';
    }

    const params = new URLSearchParams({
        status:        next.status,
        tipe:          next.tipe,
        tab:           next.tab,
        status_daftar: next.status_daftar,
    });

    window.location.href = '<?php echo e(route("admin.approval.program")); ?>?' + params.toString();
}

// ─── Data program untuk modal detail ─────────────────────────────────────────
const programData = <?php echo json_encode($programs->items(), 15, 512) ?>;

// ─── Polling counts real-time (setiap 30 detik) ───────────────────────────────
const _countsUrl = '<?php echo e(route("admin.approval.program.counts")); ?>?status=<?php echo e($status); ?>';

function refreshCounts() {
    fetch(_countsUrl)
        .then(r => r.ok ? r.json() : null)
        .then(data => {
            if (!data) return;

            // Tab pills
            setPill('[data-count="pending"]',  data.counts.pending);
            setPill('[data-count="approved"]', data.counts.approved);
            setPill('[data-count="rejected"]', data.counts.rejected);

            // Chips tipe (hanya relevan di tab program)
            if (_state.tab === 'program') {
                setChip('[data-chip="all"]',       data.countTipe.all);
                setChip('[data-chip="kurikulum"]',  data.countTipe.kurikulum);
                setChip('[data-chip="modul"]',      data.countTipe.modul);
            }

            // Chip pendaftaran: selalu tampilkan menunggu_verifikasi
            setChip('[data-chip="pendaftaran"]', data.countsDaftar.menunggu_verifikasi);
        })
        .catch(() => {}); // silent fail — tidak ganggu UX
}

function setPill(selector, count) {
    const el = document.querySelector(selector);
    if (!el) return;
    el.textContent = count;
    el.style.display = count > 0 ? '' : 'none';
}

function setChip(selector, count) {
    const el = document.querySelector(selector);
    if (!el) return;
    el.textContent = count;
    el.style.display = count > 0 ? '' : 'none';
}

// Mulai polling
setInterval(refreshCounts, 30_000);

// ─── SweetAlert2 ──────────────────────────────────────────────────────────────
const swalApprove = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-approve', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalReject = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-reject', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});

// Mixin SweetAlert untuk hapus
const swalDelete = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-delete', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});

function confirmDelete(id, name, tipe) {
    const isKurikulum = tipe === 'kurikulum';
    swalDelete.fire({
        title: 'Hapus Program?',
        html: `
            <span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Kamu akan menghapus <strong>${name}</strong>.
                ${isKurikulum
                    ? '<br><span style="color:#ef4444;font-size:13px;margin-top:6px;display:block;">⚠️ Semua modul dalam kurikulum ini juga akan ikut terhapus.</span>'
                    : ''
                }
                <br>Tindakan ini <strong>tidak dapat dibatalkan</strong>.
            </span>`,
        icon: 'warning', iconColor: '#ea580c',
        showCancelButton: true,
        confirmButtonText: '🗑️ Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) document.getElementById('form-delete-' + id).submit();
    });
}

function confirmApproveDaftar(id, nama) {
    swalApprove.fire({
        title: 'Terima Pendaftaran?',
        html: `<span style="font-size:14px;color:#6b7280;">Pendaftaran <strong>${nama}</strong> akan disetujui.</span>`,
        icon: 'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '✓ Ya, Terima',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) document.getElementById('form-approve-daftar-' + id).submit();
    });
}

function confirmRejectDaftar(id, nama) {
    swalReject.fire({
        title: 'Tolak Pendaftaran?',
        html: `<span style="font-size:14px;color:#6b7280;">Kamu akan menolak pendaftaran <strong>${nama}</strong>.</span>`,
        icon: 'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '→ Lanjut Isi Alasan',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) bukaTolakDaftar(id, nama);
    });
}
function confirmApprove(id, name) {
    swalApprove.fire({
        title: 'Setujui Program?',
        html:  `<span style="font-size:14px;color:#6b7280;">Program <strong>${name}</strong> akan dipublikasikan.</span>`,
        icon: 'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '✓ Ya, Setujui',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) document.getElementById('form-approve-' + id).submit();
    });
}

function confirmReject(id, name) {
    swalReject.fire({
        title: 'Tolak Program?',
        html:  `<span style="font-size:14px;color:#6b7280;">Kamu akan menolak <strong>${name}</strong>.</span>`,
        icon: 'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '→ Lanjut Isi Alasan',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(r => {
        if (r.isConfirmed) openRejectModal(id, name);
    });
}

// ─── Modal Detail ──────────────────────────────────────────────────────────────
function openDetailModal(id) {
    const p = programData.find(x => x.id === id);
    if (!p) return;

    document.getElementById('detail-modal-title').textContent =
        p.tipe === 'modul' ? 'Detail Modul' : 'Detail Kurikulum';

    const imgEl = document.getElementById('detail-img');
    if (p.gambar) {
        imgEl.innerHTML = `<img src="/storage/${p.gambar}" alt="${p.judul}" style="width:100%;height:100%;object-fit:cover;">`;
    } else {
        imgEl.textContent = p.tipe === 'modul' ? '📝' : '📚';
    }

    const kurikulumInfo = document.getElementById('detail-kurikulum-info');
    const modulInduk    = document.getElementById('detail-modul-induk');

    if (p.tipe === 'kurikulum') {
        kurikulumInfo.style.display = 'block';
        modulInduk.style.display    = 'none';
        document.getElementById('d-jumlah-materi').textContent = p.jumlah_materi ?? '-';
        document.getElementById('d-total-jam').textContent     = p.total_jam ? p.total_jam + ' jam' : '-';
        document.getElementById('d-jumlah-sesi').textContent   = p.jumlah_sesi ?? '-';
        const sertWrap = document.getElementById('d-sertifikat-wrap');
        sertWrap.innerHTML = p.sertifikat
            ? '<span class="sertifikat-badge">🏆 Ada sertifikat kelulusan</span>' : '';
    } else if (p.tipe === 'modul') {
        kurikulumInfo.style.display = 'none';
        modulInduk.style.display    = 'flex';
        const induk = programData.find(x => x.id === p.kurikulum_id);
        document.getElementById('d-induk-judul').textContent  = induk ? induk.judul : 'Kurikulum #' + (p.kurikulum_id ?? '?');
        document.getElementById('d-induk-urutan').textContent = p.urutan ? 'Urutan #' + p.urutan : '';
    } else {
        kurikulumInfo.style.display = 'none';
        modulInduk.style.display    = 'none';
    }

    const isModul = p.tipe === 'modul';
    document.getElementById('detail-grid').innerHTML = `
        <div class="detail-item">
            <div class="detail-label">Judul</div>
            <div class="detail-value">${p.judul ?? '-'}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tipe</div>
            <div class="detail-value">${p.tipe ? p.tipe.charAt(0).toUpperCase() + p.tipe.slice(1) : '-'}</div>
        </div>
        ${!isModul ? `
        <div class="detail-item">
            <div class="detail-label">Metode</div>
            <div class="detail-value">${p.metode ?? '-'}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tingkat</div>
            <div class="detail-value">${p.tingkat ?? '-'}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Bahasa</div>
            <div class="detail-value">${p.bahasa ?? '-'}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Target Peserta</div>
            <div class="detail-value" style="font-weight:400;font-size:13px;">${p.target ?? '-'}</div>
        </div>
        ` : `
        <div class="detail-item">
            <div class="detail-label">Nomor Urutan</div>
            <div class="detail-value">#${p.urutan ?? '-'}</div>
        </div>
        `}
        <div class="detail-item full">
            <div class="detail-label">Deskripsi</div>
            <div class="detail-value" style="font-weight:400;font-size:13px;line-height:1.7;color:var(--text-muted)">${p.deskripsi ?? '-'}</div>
        </div>
    `;

    const rejectWrap = document.getElementById('d-reject-wrap');
    if (p.status === 'rejected' && p.catatan_admin) {
        rejectWrap.style.display = 'block';
        document.getElementById('d-reject').textContent = p.catatan_admin;
    } else {
        rejectWrap.style.display = 'none';
    }

    const btnApprove = document.getElementById('btn-detail-approve');
    const btnReject  = document.getElementById('btn-detail-reject');
    btnApprove.style.display = p.status !== 'approved' ? 'inline-flex' : 'none';
    btnReject.style.display  = p.status !== 'rejected' ? 'inline-flex' : 'none';
    btnApprove.onclick = () => { closeModal('modal-detail'); confirmApprove(id, p.judul); };
    btnReject.onclick  = () => { closeModal('modal-detail'); confirmReject(id, p.judul); };

    openModal('modal-detail');
}

function bukaTolakDaftar(id, nama) {
    document.getElementById('tolak-daftar-nama').textContent = nama;
    document.getElementById('form-tolak-daftar').action = `/admin/pendaftaran/${id}/reject`;
    document.getElementById('form-tolak-daftar').querySelector('textarea').value = '';
    openModal('modal-tolak-daftar');
}

// ─── Modal Reject ──────────────────────────────────────────────────────────────
function openRejectModal(id, name) {
    document.getElementById('reject-name').textContent = name;
    document.getElementById('form-reject').action = `/admin/approval/program/${id}/reject`;
    document.getElementById('form-reject').querySelector('textarea').value = '';  // ← tambah ini
    openModal('modal-reject');
}

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Kaji-indo-main\resources\views/admin/approval-program.blade.php ENDPATH**/ ?>