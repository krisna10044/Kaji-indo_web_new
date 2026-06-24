<?php $__env->startSection('page-title', 'Overview'); ?>


<?php $__env->startPush('styles'); ?>
<style>
/* ===== RESPONSIVE MOBILE ===== */

/* Stats Grid: 2 kolom di mobile */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr 1fr !important;
        gap: 10px !important;
    }

    .stat-card {
        padding: 12px 10px !important;
    }

    .stat-num {
        font-size: 22px !important;
    }

    .stat-icon {
        font-size: 18px !important;
    }

    .stat-label {
        font-size: 11px !important;
    }

    .stat-trend {
        font-size: 10px !important;
    }
}

/* Section header: stack vertikal */
@media (max-width: 768px) {
    .section-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 8px !important;
    }
}

/* Tabel: scroll horizontal di dalam wrapper */
@media (max-width: 768px) {
    .table-card {
        overflow-x: hidden !important;
    }

    .table-card table {
        width: 100% !important;
        table-layout: fixed !important;
    }

    /* Sembunyikan kolom Tipe (duplikat dengan preview-meta) */
    .table-card table thead tr th:nth-child(2),
    .table-card table tbody tr td:nth-child(2) {
        display: none !important;
    }

    /* Kolom Item */
    .table-card table thead tr th:nth-child(1),
    .table-card table tbody tr td:nth-child(1) {
        width: 35% !important;
    }

    /* Kolom Diajukan oleh */
    .table-card table thead tr th:nth-child(3),
    .table-card table tbody tr td:nth-child(3) {
        width: 30% !important;
    }

    /* Kolom Tanggal */
    .table-card table thead tr th:nth-child(4),
    .table-card table tbody tr td:nth-child(4) {
        width: 20% !important;
        font-size: 10px !important;
    }

    /* Kolom Status: sembunyikan di tabel utama (info sudah cukup) */
    .table-card table thead tr th:nth-child(5),
    .table-card table tbody tr td:nth-child(5) {
        display: none !important;
    }

    /* Kolom Aksi */
    .table-card table thead tr th:nth-child(6),
    .table-card table tbody tr td:nth-child(6) {
        width: 15% !important;
    }

    .preview-cell {
        gap: 6px !important;
    }

    .preview-thumb {
        width: 32px !important;
        height: 32px !important;
        flex-shrink: 0 !important;
        font-size: 14px !important;
    }

    .preview-name {
        font-size: 11px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        max-width: 80px !important;
    }

    .preview-meta {
        font-size: 10px !important;
    }

    /* Submitter: sembunyikan email/role sub-text */
    .submitter {
        gap: 5px !important;
    }

    .submitter-avatar {
        width: 26px !important;
        height: 26px !important;
        font-size: 9px !important;
        flex-shrink: 0 !important;
    }

    .submitter-name {
        font-size: 11px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        max-width: 70px !important;
    }

    .submitter-sub {
        display: none !important;
    }

    /* Tombol Aksi: susun vertikal, ikon saja */
    .action-group {
        flex-direction: column !important;
        gap: 4px !important;
    }

    .action-group .btn-approve,
    .action-group .btn-reject {
        font-size: 10px !important;
        padding: 4px 6px !important;
        white-space: nowrap !important;
    }
}

/* Grid bawah: 2 kolom → 1 kolom di mobile */
@media (max-width: 768px) {
    div[style*="grid-template-columns:1fr 1fr"] {
        display: flex !important;
        flex-direction: column !important;
        gap: 14px !important;
    }
}

/* Tabel pengguna & produk di bawah */
@media (max-width: 768px) {
    .table-card-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 6px !important;
    }

    /* Kolom Bergabung di tabel pengguna terbaru */
    .table-card table th:last-child,
    .table-card table td:last-child {
        font-size: 10px !important;
    }
}

/* Modal: full width di mobile */
@media (max-width: 768px) {
    .modal-overlay {
        padding: 16px !important;
        align-items: flex-end !important;  /* muncul dari bawah */
    }

    .modal.confirm-modal {
        width: 100% !important;
        max-width: 100% !important;
        border-radius: 16px 16px 0 0 !important;
        padding: 24px 16px !important;
    }

    .confirm-btns {
        flex-direction: column-reverse !important;
        gap: 8px !important;
    }

    .confirm-btns .btn {
        width: 100% !important;
        justify-content: center !important;
    }

    .form-textarea {
        width: 100% !important;
        box-sizing: border-box !important;
    }
    
    .bottom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

@media (max-width: 768px) {
    .bottom-grid {
        grid-template-columns: 1fr !important;
        gap: 14px !important;
    }
}
}
</style>
<?php $__env->startSection('content'); ?>

 
<div class="stats-grid">
    <div class="stat-card green">
        <div class="stat-icon">📋</div>
        <div class="stat-num"><?php echo e($stats['total_pending']); ?></div>
        <div class="stat-label">Total Pending</div>
        <div class="stat-trend" style="color:var(--accent2)">
            <?php echo e($stats['pending_hari_ini'] > 0 ? '▲ ' . $stats['pending_hari_ini'] . ' hari ini' : 'Tidak ada baru'); ?>

        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-icon">🛍️</div>
        <div class="stat-num"><?php echo e($stats['pending_produk']); ?></div>
        <div class="stat-label">Produk Pending</div>
        <div class="stat-trend" style="color:var(--text-muted)">Butuh review</div>
    </div>

    <div class="stat-card yellow">
        <div class="stat-icon">🎓</div>
        <div class="stat-num"><?php echo e($stats['pending_program'] + $stats['pending_event']); ?></div>
        <div class="stat-label">Program & Event</div>
        <div class="stat-trend" style="color:var(--text-muted)">Dari pembimbing</div>
    </div>

    <div class="stat-card teal">
        <div class="stat-icon">✅</div>
        <div class="stat-num"><?php echo e($stats['disetujui_bulan']); ?></div>
        <div class="stat-label">Disetujui Bulan Ini</div>
        <div class="stat-trend" style="color:var(--accent)">↑ Terus bertumbuh</div>
    </div>

    <div class="stat-card blue">
        <div class="stat-icon">👥</div>
        <div class="stat-num"><?php echo e($stats['total_users']); ?></div>
        <div class="stat-label">Total Pengguna</div>
        <div class="stat-trend" style="color:var(--accent3)">
            <?php echo e($stats['total_umkm']); ?> UMKM · <?php echo e($stats['total_pembimbing']); ?> Pembimbing
        </div>
    </div>
</div>


<div class="section-header">
    <div class="section-title">
        Antrian Persetujuan Terbaru
        <small>perlu tindakan segera</small>
    </div>
    <a href="<?php echo e(route('admin.approval.produk')); ?>" class="btn btn-ghost btn-sm">Lihat Semua →</a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Tipe</th>
                <th>Diajukan oleh</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $antrian_terbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div class="preview-cell">
                        <div class="preview-thumb">
                            <?php if($item['type'] === 'produk'): ?>
                                <?php if(!empty($item['foto'])): ?>
                                    <img src="<?php echo e(asset('storage/' . $item['foto'])); ?>" alt="<?php echo e($item['nama']); ?>">
                                <?php else: ?>
                                    🛍️
                                <?php endif; ?>
                            <?php elseif($item['type'] === 'program'): ?>
                                🎓
                            <?php else: ?>
                                🗓️
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="preview-name"><?php echo e($item['nama']); ?></div>
                            <div class="preview-meta"><?php echo e(ucfirst($item['type'])); ?></div>
                        </div>
                    </div>
                </td>
                <td><?php echo e(ucfirst($item['type'])); ?></td>
                <td>
                    <div class="submitter">
                        <div class="submitter-avatar" style="background:<?php echo e($item['avatar_color'] ?? 'var(--accent3)'); ?>">
                            <?php echo e(strtoupper(substr($item['submitter'], 0, 2))); ?>

                        </div>
                        <div>
                            <div class="submitter-name"><?php echo e($item['submitter']); ?></div>
                            <div class="submitter-sub"><?php echo e($item['submitter_role']); ?></div>
                        </div>
                    </div>
                </td>
                <td><?php echo e(\Carbon\Carbon::parse($item['tanggal'])->format('d M Y')); ?></td>
                <td><span class="badge badge-pending"><span class="badge-dot"></span>Pending</span></td>
                <td>
                    <div class="action-group">
                        <button class="btn btn-approve btn-sm"
                            onclick="openApproveModal('<?php echo e($item['type']); ?>', <?php echo e($item['id']); ?>)">
                            ✓ Setujui
                        </button>
                        <button class="btn btn-reject btn-sm"
                            onclick="openRejectModal('<?php echo e($item['type']); ?>', <?php echo e($item['id']); ?>)">
                            ✕ Tolak
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <div class="empty-state-icon">🎉</div>
                        <div class="empty-state-text">Semua antrian sudah diproses!</div>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<div class="bottom-grid">
    
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                👥 Pengguna Terdaftar Terbaru
                <span class="table-card-subtitle">5 terakhir</span>
            </div>
            <a href="<?php echo e(route('admin.pengguna')); ?>" class="btn btn-ghost btn-sm">Lihat Semua</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pengguna_terbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="submitter">
                            <div class="submitter-avatar" style="background:<?php echo e(['var(--accent)','var(--accent3)','var(--warning)','#8b5cf6','#ec4899'][($loop->index % 5)]); ?>">
                                <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                            </div>
                            <div>
                                <div class="submitter-name"><?php echo e($user->name); ?></div>
                                <div class="submitter-sub"><?php echo e($user->email); ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if($user->role === 'admin'): ?>
                            <span class="role-tag role-admin">Admin</span>
                        <?php elseif($user->is_pembimbing): ?>
                            <span class="role-tag role-pembimbing">Pembimbing</span>
                        <?php elseif($user->is_umkm): ?>
                            <span class="role-tag role-umkm">UMKM</span>
                        <?php else: ?>
                            <span class="role-tag role-user">User</span>
                        <?php endif; ?>
                    </td>
                    <td style="color:var(--text-muted);font-size:12px;">
                        <?php echo e($user->created_at->diffForHumans()); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3">
                        <div class="empty-state" style="padding:24px;">
                            <div class="empty-state-text">Belum ada pengguna</div>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                🛍️ Produk Didaftarkan Terbaru
                <span class="table-card-subtitle">5 terakhir</span>
            </div>
            <a href="<?php echo e(route('admin.approval.produk')); ?>" class="btn btn-ghost btn-sm">Review</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $produk_terbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="preview-cell">
                            <div class="preview-thumb">
                                <?php if($produk->foto): ?>
                                    <img src="<?php echo e(asset('storage/' . $produk->foto)); ?>" alt="<?php echo e($produk->nama); ?>">
                                <?php else: ?>
                                    🛍️
                                <?php endif; ?>
                            </div>
                            <div>
                                <div class="preview-name"><?php echo e(Str::limit($produk->nama, 24)); ?></div>
                                <div class="preview-meta">Rp <?php echo e(number_format($produk->harga ?? 0, 0, ',', '.')); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:12px;"><?php echo e($produk->kategori ?? '-'); ?></td>
                    <td>
                        <?php if(($produk->status ?? 'pending') === 'approved'): ?>
                            <span class="badge badge-approved"><span class="badge-dot"></span>Aktif</span>
                        <?php elseif(($produk->status ?? 'pending') === 'rejected'): ?>
                            <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
                        <?php else: ?>
                            <span class="badge badge-pending"><span class="badge-dot"></span>Pending</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3">
                        <div class="empty-state" style="padding:24px;">
                            <div class="empty-state-text">Belum ada produk</div>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal-overlay" id="modal-approve">
    <div class="modal confirm-modal">
        <div class="confirm-icon">✅</div>
        <div class="confirm-title">Konfirmasi Persetujuan</div>
        <div class="confirm-desc">Anda akan menyetujui item ini. Item akan langsung aktif dan terlihat di platform KAJI Indonesia.</div>
        <form id="form-approve" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="confirm-btns">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-approve')">Batal</button>
                <button type="submit" class="btn btn-approve">✓ Ya, Setujui</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="modal-reject">
    <div class="modal confirm-modal">
        <div class="confirm-icon">❌</div>
        <div class="confirm-title">Konfirmasi Penolakan</div>
        <div class="confirm-desc">Berikan alasan penolakan agar pengaju dapat memperbaiki pengajuannya.</div>
        <form id="form-reject" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="form-group" style="text-align:left;margin-bottom:18px;">
                <label class="form-label">Alasan Penolakan</label>
                <textarea class="form-textarea" name="catatan" placeholder="Contoh: Foto produk kurang jelas, deskripsi tidak lengkap..."></textarea>
            </div>
            <div class="confirm-btns">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-reject')">Batal</button>
                <button type="submit" class="btn btn-reject">✕ Ya, Tolak</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const routes = {
        produk:  { approve: '/admin/approval/produk/{id}/approve',  reject: '/admin/approval/produk/{id}/reject' },
        program: { approve: '/admin/approval/program/{id}/approve', reject: '/admin/approval/program/{id}/reject' },
        event:   { approve: '/admin/approval/event/{id}/approve',   reject: '/admin/approval/event/{id}/reject' },
    };

    function openApproveModal(type, id) {
        const url = routes[type].approve.replace('{id}', id);
        document.getElementById('form-approve').action = url;
        openModal('modal-approve');
    }

    function openRejectModal(type, id) {
        const url = routes[type].reject.replace('{id}', id);
        document.getElementById('form-reject').action = url;
        openModal('modal-reject');
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/admin/dashboard-admin.blade.php ENDPATH**/ ?>