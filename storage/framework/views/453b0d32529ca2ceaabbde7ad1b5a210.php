<?php $__env->startSection('page-title', 'Approval Mentor'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
<style>
    .btn-csv-export {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 16px; border-radius: 8px; font-size: 12px; font-weight: 600;
        background: #f0fdf4; color: #15803d; border: 1.5px solid #86efac;
        text-decoration: none; cursor: pointer; transition: all .15s; white-space: nowrap;
    }
    .btn-csv-export:hover { background: #dcfce7; border-color: #4ade80; color: #166534; }
    @media (max-width: 768px) { .btn-csv-export { font-size: 11px; padding: 5px 10px; } }

    .swal-btn-confirm-approve {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #10b981; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-confirm-approve:hover { background: #059669; }
    .swal-btn-confirm-delete {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #ef4444; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-confirm-delete:hover { background: #dc2626; }
    .swal-btn-cancel {
        display: inline-flex; align-items: center;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
        background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; cursor: pointer;
    }
    .swal-btn-cancel:hover { background: #e5e7eb; }
    .swal2-popup  { border-radius: 16px !important; padding: 32px 28px !important; }
    .swal2-title  { font-size: 18px !important; font-weight: 700 !important; color: #111827 !important; }
    .swal2-actions{ gap: 10px !important; margin-top: 24px !important; }

    /* ===================== RESPONSIVE MOBILE ===================== */
    @media (max-width: 768px) {
        .tab-bar { width: 100% !important; overflow-x: auto !important; flex-wrap: nowrap !important; -webkit-overflow-scrolling: touch; }
        .tab-btn { white-space: nowrap !important; flex-shrink: 0 !important; }
        .table-card-header { flex-direction: column !important; align-items: flex-start !important; gap: 6px !important; padding: 12px 14px !important; }
        .table-card table { table-layout: fixed !important; width: 100% !important; }

        /* TAB PENDING */
        #tab-pending thead tr th:nth-child(2), #tab-pending tbody tr td:nth-child(2),
        #tab-pending thead tr th:nth-child(3), #tab-pending tbody tr td:nth-child(3),
        #tab-pending thead tr th:nth-child(4), #tab-pending tbody tr td:nth-child(4) { display: none !important; }
        #tab-pending thead tr th:nth-child(1), #tab-pending tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-pending thead tr th:nth-child(5), #tab-pending tbody tr td:nth-child(5) { width: 45% !important; }

        /* TAB APPROVED */
        #tab-approved thead tr th:nth-child(2), #tab-approved tbody tr td:nth-child(2),
        #tab-approved thead tr th:nth-child(3), #tab-approved tbody tr td:nth-child(3),
        #tab-approved thead tr th:nth-child(4), #tab-approved tbody tr td:nth-child(4),
        #tab-approved thead tr th:nth-child(5), #tab-approved tbody tr td:nth-child(5) { display: none !important; }
        #tab-approved thead tr th:nth-child(1), #tab-approved tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-approved thead tr th:nth-child(6), #tab-approved tbody tr td:nth-child(6) { width: 45% !important; }

        /* TAB REJECTED */
        #tab-rejected thead tr th:nth-child(2), #tab-rejected tbody tr td:nth-child(2),
        #tab-rejected thead tr th:nth-child(3), #tab-rejected tbody tr td:nth-child(3),
        #tab-rejected thead tr th:nth-child(4), #tab-rejected tbody tr td:nth-child(4) { display: none !important; }
        #tab-rejected thead tr th:nth-child(1), #tab-rejected tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-rejected thead tr th:nth-child(5), #tab-rejected tbody tr td:nth-child(5) { width: 45% !important; }

        /* TAB DELETED */
        #tab-deleted thead tr th:nth-child(2), #tab-deleted tbody tr td:nth-child(2),
        #tab-deleted thead tr th:nth-child(3), #tab-deleted tbody tr td:nth-child(3) { display: none !important; }
        #tab-deleted thead tr th:nth-child(1), #tab-deleted tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-deleted thead tr th:nth-child(4), #tab-deleted tbody tr td:nth-child(4) { width: 45% !important; }

        thead th { padding: 10px 10px !important; font-size: 9px !important; }
        tbody td  { padding: 10px 10px !important; }

        .submitter { gap: 6px !important; }
        .submitter-avatar { width: 32px !important; height: 32px !important; font-size: 10px !important; flex-shrink: 0 !important; }
        .submitter-name { font-size: 11px !important; overflow: hidden !important; text-overflow: ellipsis !important; white-space: nowrap !important; max-width: 100px !important; }
        .submitter-sub  { font-size: 10px !important; overflow: hidden !important; text-overflow: ellipsis !important; white-space: nowrap !important; max-width: 100px !important; }

        .action-group { flex-direction: column !important; gap: 4px !important; align-items: stretch !important; width: 100% !important; }
        .action-group .btn-sm { font-size: 11px !important; padding: 6px 4px !important; white-space: nowrap !important; justify-content: center !important; width: 100% !important; display: flex !important; box-sizing: border-box !important; min-height: 30px !important; }
        .action-group .btn-sm svg { width: 13px !important; height: 13px !important; flex-shrink: 0 !important; }

        .modal-overlay { align-items: flex-end !important; padding: 0 !important; }
        .modal { width: 100% !important; max-width: 100% !important; border-radius: 20px 20px 0 0 !important; padding: 20px 16px 32px !important; max-height: 92vh !important; }
        #modal-reject .modal { width: 100% !important; }
        .img-preview { height: 130px !important; margin-bottom: 14px !important; }
        .detail-grid { grid-template-columns: 1fr !important; gap: 8px !important; }
        .detail-item.full { grid-column: 1 !important; }
        .form-textarea { font-size: 14px !important; }
        .swal2-popup { width: 92% !important; padding: 24px 18px !important; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="tab-bar">
    <button class="tab-btn active" data-tab="pending" onclick="switchTab('pending', this)">
        Menunggu
        <?php if($stats['pending'] > 0): ?>
            <span class="count-pill"><?php echo e($stats['pending']); ?></span>
        <?php endif; ?>
    </button>
    <button class="tab-btn" data-tab="approved" onclick="switchTab('approved', this)">
        Disetujui
        <?php if($stats['approved'] > 0): ?>
            <span class="count-pill" style="background:var(--accent);"><?php echo e($stats['approved']); ?></span>
        <?php endif; ?>
    </button>
    <button class="tab-btn" data-tab="rejected" onclick="switchTab('rejected', this)">
        Ditolak
        <?php if($stats['rejected'] > 0): ?>
            <span class="count-pill" style="background:#9ca3af;"><?php echo e($stats['rejected']); ?></span>
        <?php endif; ?>
    </button>
    <button class="tab-btn" data-tab="deleted" onclick="switchTab('deleted', this)">
        🗑️ Dihapus
        <?php if(($stats['deleted'] ?? 0) > 0): ?>
            <span class="count-pill" style="background:#ef4444;"><?php echo e($stats['deleted']); ?></span>
        <?php endif; ?>
    </button>
</div>


<div id="tab-pending">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pendaftaran Menunggu Review
                <span class="table-card-subtitle"><?php echo e($stats['pending']); ?> pendaftar</span>
            </div>
            <a href="<?php echo e(route('admin.approval.mentor')); ?>?export=csv&status=pending" class="btn-csv-export">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </div>

        <?php if($pending->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">🎉</div>
                <div class="empty-state-text">Tidak ada pendaftaran yang menunggu review.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Pendaftar</th>
                        <th>Kontak</th>
                        <th>Lokasi</th>
                        <th>Dikirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--accent);">
                                    <?php echo e(strtoupper(substr($item->full_name, 0, 2))); ?>

                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($item->full_name); ?></div>
                                    <div class="submitter-sub"><?php echo e($item->user->email ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:13px;"><?php echo e($item->phone); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($item->email); ?></div>
                        </td>
                        <td style="max-width:180px;">
                            <div style="font-size:12px;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                <?php echo e($item->gmaps_location); ?>

                            </div>
                        </td>
                        <td>
                            <div style="font-size:12px;color:var(--text-muted);">
                                <?php echo e($item->created_at->diffForHumans()); ?>

                            </div>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal(<?php echo e($item->id); ?>)">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="<?php echo e(route('admin.approval.mentor.approve', $item)); ?>?tab=approved" style="display:none;"
                                      id="form-approve-mentor-<?php echo e($item->id); ?>">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <button type="button" class="btn btn-approve btn-sm"
                                    onclick="confirmApproveMentor(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->full_name)); ?>')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Setujui
                                </button>
                                <button class="btn btn-reject btn-sm"
                                    onclick="confirmRejectMentor(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->full_name)); ?>')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
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


<div id="tab-approved" style="display:none;">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Mentor Disetujui
                <span class="table-card-subtitle"><?php echo e($stats['approved']); ?> mentor aktif</span>
            </div>
            <a href="<?php echo e(route('admin.approval.mentor')); ?>?export=csv&status=approved" class="btn-csv-export">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </div>

        <?php if($approved->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">Belum ada pendaftaran yang disetujui.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Mentor</th>
                        <th>Kontak</th>
                        <th>Lokasi</th>
                        <th>Disetujui</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--accent);">
                                    <?php echo e(strtoupper(substr($item->full_name, 0, 2))); ?>

                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($item->full_name); ?></div>
                                    <div class="submitter-sub"><?php echo e($item->user->email ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:13px;"><?php echo e($item->phone); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($item->email); ?></div>
                        </td>
                        <td style="max-width:180px;">
                            <div style="font-size:12px;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                <?php echo e($item->gmaps_location); ?>

                            </div>
                        </td>
                        <td>
                            <div style="font-size:12px;color:var(--text-muted);">
                                <?php echo e($item->reviewed_at?->diffForHumans() ?? '-'); ?>

                            </div>
                        </td>
                        <td><span class="badge badge-approved"><span class="badge-dot"></span>Aktif</span></td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal(<?php echo e($item->id); ?>)">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="<?php echo e(route('admin.approval.mentor.destroy', $item)); ?>"
                                      id="form-destroy-mentor-<?php echo e($item->id); ?>" style="display:none;">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                </form>
                                <button type="button" class="btn btn-ghost btn-sm" style="color:var(--accent2);"
                                        onclick="confirmDestroyMentor(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->full_name)); ?>', 'approved')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
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


<div id="tab-rejected" style="display:none;">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pendaftaran Ditolak
                <span class="table-card-subtitle"><?php echo e($stats['rejected']); ?> ditolak</span>
            </div>
            <a href="<?php echo e(route('admin.approval.mentor')); ?>?export=csv&status=rejected" class="btn-csv-export">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </div>

        <?php if($rejected->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">Tidak ada pendaftaran yang ditolak.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Pendaftar</th>
                        <th>Kontak</th>
                        <th>Alasan Penolakan</th>
                        <th>Ditolak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $rejected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:#9ca3af;">
                                    <?php echo e(strtoupper(substr($item->full_name, 0, 2))); ?>

                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($item->full_name); ?></div>
                                    <div class="submitter-sub"><?php echo e($item->user->email ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:13px;"><?php echo e($item->phone); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($item->email); ?></div>
                        </td>
                        <td style="max-width:200px;">
                            <div style="font-size:12px;color:var(--accent2);">
                                <?php echo e(Str::limit($item->rejection_reason, 60)); ?>

                            </div>
                        </td>
                        <td>
                            <div style="font-size:12px;color:var(--text-muted);">
                                <?php echo e($item->reviewed_at?->diffForHumans() ?? '-'); ?>

                            </div>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal(<?php echo e($item->id); ?>)">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="<?php echo e(route('admin.approval.mentor.destroy', $item)); ?>"
                                      id="form-destroy-mentor-<?php echo e($item->id); ?>" style="display:none;">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                </form>
                                <button type="button" class="btn btn-ghost btn-sm" style="color:var(--accent2);"
                                        onclick="confirmDestroyMentor(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->full_name)); ?>', 'rejected')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
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


<div id="tab-deleted" style="display:none;">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                🗑️ Mentor Dihapus Admin
                <span class="table-card-subtitle"><?php echo e($stats['deleted'] ?? 0); ?> data</span>
            </div>
        </div>

        <?php if($deleted->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon">✅</div>
                <div class="empty-state-text">Tidak ada mentor yang dihapus.</div>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Mentor</th>
                        <th>Kontak</th>
                        <th>Status Sebelumnya</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $deleted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:#9ca3af;">
                                    <?php echo e(strtoupper(substr($item->full_name, 0, 2))); ?>

                                </div>
                                <div>
                                    <div class="submitter-name"><?php echo e($item->full_name); ?></div>
                                    <div class="submitter-sub"><?php echo e($item->user->email ?? '-'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:13px;"><?php echo e($item->phone); ?></div>
                            <div style="font-size:11px;color:var(--text-muted);"><?php echo e($item->email); ?></div>
                        </td>
                        <td>
                            <?php
                                $prevStatus  = $item->status ?? 'pending';
                                $statusLabel = ['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'][$prevStatus] ?? $prevStatus;
                                $statusClass = ['pending' => 'badge-pending', 'approved' => 'badge-approved', 'rejected' => 'badge-rejected'][$prevStatus] ?? 'badge-inactive';
                            ?>
                            <span class="badge <?php echo e($statusClass); ?>">
                                <span class="badge-dot"></span><?php echo e($statusLabel); ?>

                            </span>
                        </td>
                        <td style="font-size:12px;color:#ef4444;">
                            <?php echo e($item->deleted_at?->format('d M Y, H:i')); ?>

                        </td>
                        <td>
                            <div class="action-group">
                                <button type="button" class="btn btn-approve btn-sm"
                                    onclick="confirmRestoreMentor(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->full_name)); ?>')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Pulihkan
                                </button>
                                <button type="button" class="btn btn-ghost btn-sm" style="color:#dc2626;"
                                    onclick="confirmForceDeleteMentor(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->full_name)); ?>')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Permanen
                                </button>
                            </div>
                            
                            <form id="restore-mentor-form-<?php echo e($item->id); ?>" method="POST"
                                  action="<?php echo e(route('admin.approval.mentor.restore', $item->id)); ?>" style="display:none;">
                                <?php echo csrf_field(); ?>
                            </form>
                            <form id="force-delete-mentor-form-<?php echo e($item->id); ?>" method="POST"
                                  action="<?php echo e(route('admin.approval.mentor.force-delete', $item->id)); ?>" style="display:none;">
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
            <div class="modal-title">Detail Pendaftaran Mentor</div>
            <button class="modal-close" onclick="closeModal('modal-detail')">✕</button>
        </div>

        <div class="img-preview" id="detail-foto">
            <span>🧑</span>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Nama Lengkap</div>
                <div class="detail-value" id="d-nama">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value" id="d-status">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">No. WhatsApp</div>
                <div class="detail-value" id="d-phone">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Email</div>
                <div class="detail-value" id="d-email">-</div>
            </div>
            <div class="detail-item full">
                <div class="detail-label">Lokasi</div>
                <div class="detail-value" id="d-lokasi">-</div>
            </div>
            <div class="detail-item full">
                <div class="detail-label">Bio / Tentang Diri</div>
                <div class="detail-value" id="d-bio" style="font-weight:400;line-height:1.6;font-size:13px;">-</div>
            </div>
            <div class="detail-item full" id="d-reject-wrap" style="display:none;">
                <div class="detail-label" style="color:var(--accent2);">Alasan Penolakan</div>
                <div class="detail-value" id="d-reject" style="font-weight:400;font-size:13px;color:var(--accent2);">-</div>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:4px;">
            <a id="d-ktp-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Scan KTP
            </a>
            <a id="d-foto-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Lihat Pas Foto
            </a>
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <a id="d-transfer-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Lihat Bukti Transfer
            </a>
        </div>
    </div>
</div>


<div class="modal-overlay" id="modal-reject">
    <div class="modal" style="width:460px;">
        <div class="modal-header">
            <div class="modal-title">Tolak Pendaftaran</div>
            <button class="modal-close" onclick="closeModal('modal-reject')">✕</button>
        </div>
        <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:18px;line-height:1.6;">
            Berikan alasan penolakan untuk <strong id="reject-name"></strong>. Alasan ini akan tersimpan sebagai catatan.
        </p>
        <form id="reject-form" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Alasan Penolakan *</label>
                <textarea name="rejection_reason" class="form-textarea" rows="4"
                    placeholder="Contoh: Dokumen KTP tidak jelas, mohon upload ulang dengan kualitas yang lebih baik."
                    required></textarea>
            </div>
            <div style="display:flex;gap:10px;margin-top:6px;">
                <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-reject')">Batal</button>
                <button type="submit" class="btn btn-reject" style="flex:1;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Konfirmasi Tolak
                </button>
            </div>
        </form>
    </div>
</div>


<script>
const mentorData = <?php echo json_encode($pending->merge($approved)->merge($rejected)->keyBy('id'), 15, 512) ?>;

// ── SweetAlert mixins ──
const swalApprove = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-approve', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalDelete = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-delete', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalRestore = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-approve', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalReject = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-delete', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});

// ── Tab switching ──
function switchTab(tab, btn) {
    ['pending', 'approved', 'rejected', 'deleted'].forEach(t => {
        document.getElementById('tab-' + t).style.display = t === tab ? 'block' : 'none';
    });
    btn.closest('.tab-bar').querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const url = new URL(window.location);
    url.searchParams.set('tab', tab);
    window.history.replaceState({}, '', url);
}

// Auto-buka tab dari URL
document.addEventListener('DOMContentLoaded', function () {
    const params    = new URLSearchParams(window.location.search);
    const activeTab = params.get('tab') || 'pending';
    const tabBtn    = document.querySelector(`.tab-btn[data-tab="${activeTab}"]`);
    if (tabBtn) switchTab(activeTab, tabBtn);
});

// ── Approve ──
function confirmApproveMentor(id, name) {
    swalApprove.fire({
        title: 'Setujui Mentor?',
        html:  `<span style="font-size:14px;color:#6b7280;">Anda akan menyetujui <strong>${name}</strong> sebagai Mentor resmi.</span>`,
        icon: 'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '✓ Ya, Setujui',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(result => {
        if (result.isConfirmed) document.getElementById('form-approve-mentor-' + id).submit();
    });
}

// ── Reject (2 langkah: konfirmasi → modal isian) ──
function confirmRejectMentor(id, name) {
    swalReject.fire({
        title: 'Tolak Pendaftaran?',
        html:  `<span style="font-size:14px;color:#6b7280;">Anda akan menolak pendaftaran <strong>${name}</strong>. Lanjutkan untuk mengisi alasan penolakan.</span>`,
        icon: 'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '→ Lanjut Isi Alasan',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(result => {
        if (result.isConfirmed) openRejectModal(id, name);
    });
}

// ── Soft delete ──
function confirmDestroyMentor(id, name, type) {
    const isApproved = type === 'approved';
    swalDelete.fire({
        title: '🗑️ Hapus Mentor?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Data <strong>${name}</strong> akan dipindahkan ke tab <strong>Dihapus</strong> dan masih bisa dipulihkan kembali.
                ${isApproved ? '<span style="color:#ef4444;font-size:13px;margin-top:6px;display:block;">⚠️ Akses mentor akan dicabut sementara.</span>' : ''}
               </span>`,
        icon: 'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '🗑️ Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(result => {
        if (result.isConfirmed) document.getElementById('form-destroy-mentor-' + id).submit();
    });
}

// ── Restore ──
function confirmRestoreMentor(id, name) {
    swalRestore.fire({
        title: '♻️ Pulihkan Mentor?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Data <strong>${name}</strong> akan dipulihkan dan dikembalikan ke status <strong>Menunggu</strong> untuk ditinjau ulang.
               </span>`,
        icon: 'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '♻️ Ya, Pulihkan',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(result => {
        if (result.isConfirmed) document.getElementById('restore-mentor-form-' + id).submit();
    });
}

// ── Force delete ──
function confirmForceDeleteMentor(id, name) {
    swalDelete.fire({
        title: '⚠️ Hapus Permanen?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Data <strong>${name}</strong> akan <strong>dihapus selamanya</strong> dan tidak dapat dipulihkan kembali.
                <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;margin-top:12px;font-size:13px;color:#dc2626;font-weight:600;">
                    ⚠️ Tindakan ini tidak dapat dibatalkan!
                </div>
               </span>`,
        icon: 'warning', iconColor: '#dc2626',
        showCancelButton: true,
        confirmButtonText: '🗑️ Ya, Hapus Permanen',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(result => {
        if (result.isConfirmed) document.getElementById('force-delete-mentor-form-' + id).submit();
    });
}

// ── Detail modal ──
function openDetailModal(id) {
    const d = mentorData[id];
    if (!d) return;

    document.getElementById('d-nama').textContent   = d.full_name;
    document.getElementById('d-phone').textContent  = d.phone;
    document.getElementById('d-email').textContent  = d.email;
    document.getElementById('d-lokasi').textContent = d.gmaps_location;
    document.getElementById('d-bio').textContent    = d.bio;

    const statusMap = {
        pending:  '<span class="badge badge-pending"><span class="badge-dot"></span>Menunggu</span>',
        approved: '<span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>',
        rejected: '<span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>',
    };
    document.getElementById('d-status').innerHTML = statusMap[d.status] ?? d.status;

    const rejectWrap = document.getElementById('d-reject-wrap');
    if (d.status === 'rejected' && d.rejection_reason) {
        rejectWrap.style.display = 'block';
        document.getElementById('d-reject').textContent = d.rejection_reason;
    } else {
        rejectWrap.style.display = 'none';
    }

    const fotoEl = document.getElementById('detail-foto');
    fotoEl.innerHTML = d.white_bg_photo
        ? `<img src="/storage/${d.white_bg_photo}" alt="Pas Foto">`
        : '<span>🧑</span>';

    const ktpLink = document.getElementById('d-ktp-link');
    ktpLink.href = d.ktp_scan ? `/storage/${d.ktp_scan}` : '#';
    ktpLink.style.opacity       = d.ktp_scan ? '1' : '0.4';
    ktpLink.style.pointerEvents = d.ktp_scan ? 'auto' : 'none';

    const fotoLink = document.getElementById('d-foto-link');
    fotoLink.href = d.white_bg_photo ? `/storage/${d.white_bg_photo}` : '#';
    fotoLink.style.opacity       = d.white_bg_photo ? '1' : '0.4';
    fotoLink.style.pointerEvents = d.white_bg_photo ? 'auto' : 'none';

    const transferLink = document.getElementById('d-transfer-link');
    transferLink.href = d.bukti_transfer ? `/storage/${d.bukti_transfer}` : '#';
    transferLink.style.opacity       = d.bukti_transfer ? '1' : '0.4';
    transferLink.style.pointerEvents = d.bukti_transfer ? 'auto' : 'none';

    openModal('modal-detail');
}

function openRejectModal(id, name) {
    document.getElementById('reject-name').textContent = name;
    document.getElementById('reject-form').action = `/admin/approval/mentor/${id}/reject?tab=rejected`;
    openModal('modal-reject');
}

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', e => { if (e.target === el) closeModal(el.id); });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Kaji-indo-main\resources\views/admin/approval-mentor.blade.php ENDPATH**/ ?>