<?php $__env->startSection('page-title', 'Manajemen Pengguna'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ===================== RESPONSIVE MOBILE - PENGGUNA ===================== */

@media (max-width: 768px) {

    /* Header: title + filter susun vertikal */
    div[style*="justify-content:space-between"][style*="margin-bottom:18px"] {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 12px !important;
    }

    /* Filter select: full width */
    div[style*="justify-content:space-between"] form {
        width: 100% !important;
    }

    div[style*="justify-content:space-between"] .form-select {
        width: 100% !important;
    }

    /* Tabel: fixed layout */
    .table-card table {
        table-layout: fixed !important;
        width: 100% !important;
    }

    /* Sembunyikan: Role(2), Email(3), Kota(4), Bergabung(5) */
    .table-card table thead tr th:nth-child(2),
    .table-card table tbody tr td:nth-child(2),
    .table-card table thead tr th:nth-child(3),
    .table-card table tbody tr td:nth-child(3),
    .table-card table thead tr th:nth-child(4),
    .table-card table tbody tr td:nth-child(4),
    .table-card table thead tr th:nth-child(5),
    .table-card table tbody tr td:nth-child(5) {
        display: none !important;
    }

    /* Lebar kolom yang tersisa */
    .table-card table thead tr th:nth-child(1),
    .table-card table tbody tr td:nth-child(1) { width: 40% !important; }

    .table-card table thead tr th:nth-child(6),
    .table-card table tbody tr td:nth-child(6) { width: 20% !important; }

    .table-card table thead tr th:nth-child(7),
    .table-card table tbody tr td:nth-child(7) { width: 40% !important; }

    /* Padding baris */
    thead th {
        padding: 10px 10px !important;
        font-size: 9px !important;
    }
    tbody td {
        padding: 10px 10px !important;
    }

    /* Submitter cell */
    .submitter { gap: 6px !important; }

    .submitter-avatar {
        width: 32px !important;
        height: 32px !important;
        font-size: 10px !important;
        flex-shrink: 0 !important;
    }

    .submitter-name {
        font-size: 11px !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
        max-width: 90px !important;
    }

    /* Sembunyikan nomor telepon di bawah nama */
    .submitter-sub {
        display: none !important;
    }

    /* Badge status */
    .badge {
        font-size: 10px !important;
        padding: 2px 6px !important;
        white-space: nowrap !important;
    }

    /* Tombol aksi: susun vertikal, sama lebar */
    .action-group {
        flex-direction: column !important;
        gap: 4px !important;
        align-items: stretch !important;
        width: 100% !important;
    }

    .action-group .btn-sm {
        font-size: 11px !important;
        padding: 6px 4px !important;
        white-space: nowrap !important;
        justify-content: center !important;
        width: 100% !important;
        display: flex !important;
        box-sizing: border-box !important;
        min-height: 30px !important;
    }

    /* ── Pagination ── */
    div[style*="justify-content:space-between"][style*="padding:14px 18px"] {
        flex-direction: column !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 12px 14px !important;
    }

    /* Sembunyikan info "Menampilkan x-y dari z" */
    div[style*="justify-content:space-between"][style*="padding:14px 18px"] > div:first-child {
        display: none !important;
    }

    /* Nomor halaman: wrap agar tidak meluber */
    div[style*="justify-content:space-between"][style*="padding:14px 18px"] > div:last-child {
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
        padding: 20px 16px 32px !important;
        max-height: 92vh !important;
    }

    /* Header avatar di modal */
    #user-detail-body > div:first-child {
        flex-direction: row !important;
        padding: 12px !important;
    }

    /* Detail grid di modal: 1 kolom */
    .detail-grid {
        grid-template-columns: 1fr !important;
        gap: 8px !important;
    }

    .detail-item.full {
        grid-column: 1 !important;
    }

    /* Tombol tutup modal */
    #modal-user-detail .modal > div:last-child {
        justify-content: stretch !important;
    }

    #modal-user-detail .modal > div:last-child .btn {
        width: 100% !important;
        justify-content: center !important;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
    <div class="section-title">
        Semua Pengguna
        <small><?php echo e($users->total()); ?> terdaftar</small>
    </div>

    
<div style="display:flex;gap:8px;align-items:center;">
    <form method="GET" style="display:flex;gap:8px;align-items:center;">
        <div style="display:flex;gap:6px;flex-wrap:wrap;">
            <?php
                $roles = [
                    ''        => ['label' => 'Semua',    'icon' => '👥'],
                    'admin'   => ['label' => 'Admin',    'icon' => '🛡️'],
                    'trainer' => ['label' => 'Trainer',  'icon' => '🎓'],
                    'mentor'  => ['label' => 'Mentor',   'icon' => '💡'],
                    'umkm'    => ['label' => 'UMKM',     'icon' => '🏪'],
                    'umum'    => ['label' => 'Umum',     'icon' => '👤'],
                ];
                $activeRole = request('role', '');
            ?>

            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="submit" name="role" value="<?php echo e($value); ?>"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 5px;
                        padding: 6px 13px;
                        border-radius: 20px;
                        font-size: 12px;
                        font-weight: 600;
                        border: 1.5px solid <?php echo e($activeRole === $value ? 'var(--accent)' : 'var(--border)'); ?>;
                        background: <?php echo e($activeRole === $value ? 'var(--accent)' : 'var(--surface)'); ?>;
                        color: <?php echo e($activeRole === $value ? '#fff' : 'var(--text-muted)'); ?>;
                        cursor: pointer;
                        transition: all 0.15s;
                        white-space: nowrap;
                    "
                    onmouseover="if('<?php echo e($activeRole); ?>' !== '<?php echo e($value); ?>'){this.style.borderColor='var(--accent)';this.style.color='var(--accent)';this.style.background='var(--surface2)';}"
                    onmouseout="if('<?php echo e($activeRole); ?>' !== '<?php echo e($value); ?>'){this.style.borderColor='var(--border)';this.style.color='var(--text-muted)';this.style.background='var(--surface)';}">
                    <span><?php echo e($meta['icon']); ?></span>
                    <?php echo e($meta['label']); ?>

                    
                    
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
    </form>

    
    <a href="<?php echo e(route('admin.pengguna.export')); ?>?role=<?php echo e(request('role', '')); ?>"
        style="
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            border: 1.5px solid var(--border);
            background: var(--surface);
            color: var(--text-muted);
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s;
        "
        onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--accent)';this.style.background='var(--surface2)';"
        onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)';this.style.background='var(--surface)';">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
    </a>
</div>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>Role</th>
                <th>Email</th>
                <th>Kota</th>
                <th>Bergabung</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div class="submitter">
                        <div class="submitter-avatar"
                            style="background:<?php echo e(['var(--accent)','var(--accent3)','var(--warning)','#8b5cf6','#ec4899'][$loop->index % 5]); ?>">
                            <?php if($user->profile_photo_path): ?>
                                <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>" alt="avatar"
                                    style="width:100%;height:100%;object-fit:cover;border-radius:7px;">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="submitter-name"><?php echo e($user->name); ?></div>
                            <div class="submitter-sub"><?php echo e($user->phone ?? 'Belum ada nomor'); ?></div>
                        </div>
                    </div>
                </td>
                <td>
    <div style="display:flex;flex-direction:column;gap:4px;">
        
        <?php if($user->role === 'admin'): ?>
            <span class="role-tag role-admin">🛡️ Admin</span>
        <?php elseif($user->role === 'trainer'): ?>
            <span class="role-tag role-pembimbing">🎓 Trainer</span>
        <?php elseif($user->role === 'mentor'): ?>
            <span class="role-tag" style="background:#f3e8ff;color:#7e22ce;border:1px solid #e9d5ff;">💡 Mentor</span>
        <?php elseif($user->role === 'umkm'): ?>
            <span class="role-tag role-umkm">🏪 UMKM</span>
        <?php else: ?>
            <span class="role-tag role-user">👤 Umum</span>
        <?php endif; ?>

        
        <?php if($user->is_pembimbing && $user->role !== 'trainer'): ?>
            <span class="role-tag role-pembimbing" style="font-size:10px;padding:2px 7px;">+ Pembimbing</span>
        <?php endif; ?>

        <?php if($user->trainer_status === 'approved' && $user->role !== 'trainer'): ?>
            <span class="role-tag role-pembimbing" style="font-size:10px;padding:2px 7px;">+ Trainer ✓</span>
        <?php endif; ?>

        <?php if($user->mentor_status === 'approved' && $user->role !== 'mentor'): ?>
            <span class="role-tag" style="background:#f3e8ff;color:#7e22ce;border:1px solid #e9d5ff;font-size:10px;padding:2px 7px;">+ Mentor ✓</span>
        <?php endif; ?>

        <?php if($user->is_umkm && $user->role !== 'umkm'): ?>
            <span class="role-tag role-umkm" style="font-size:10px;padding:2px 7px;">+ UMKM</span>
        <?php endif; ?>
    </div>
</td>
                <td style="font-size:12px;color:var(--text-muted);"><?php echo e($user->email); ?></td>
                <td style="font-size:12px;"><?php echo e(Str::limit($user->address ?? '-', 18)); ?></td>
                <td style="font-size:12px;color:var(--text-muted);">
                    <?php echo e($user->created_at->format('M Y')); ?>

                </td>
                <td>
                    <?php if(!$user->suspended_at): ?>
                        <span class="badge badge-active"><span class="badge-dot"></span>Aktif</span>
                    <?php else: ?>
                        <span class="badge badge-inactive"><span class="badge-dot"></span>Suspend</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-group">
                        <button class="btn btn-ghost btn-sm" onclick="openUserDetail(<?php echo e($user->id); ?>)">
                            Kelola
                        </button>
                        <?php if(!$user->suspended_at && $user->role !== 'admin'): ?>
                        <form method="POST" action="<?php echo e(route('admin.pengguna.suspend', $user->id)); ?>" style="display:inline;"
                            onsubmit="return confirm('Yakin ingin suspend pengguna ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-reject btn-sm">Suspend</button>
                        </form>
                        <?php elseif($user->suspended_at): ?>
                        <form method="POST" action="<?php echo e(route('admin.pengguna.unsuspend', $user->id)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-approve btn-sm">Aktifkan</button>
                        </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <div class="empty-state-icon">👥</div>
                        <div class="empty-state-text">Tidak ada pengguna ditemukan</div>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    <?php if($users->hasPages()): ?>
    <div style="padding:14px 18px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;">

        
        <div style="font-size:12px;color:var(--text-muted);white-space:nowrap;">
            Menampilkan
            <span style="font-weight:700;color:var(--text);"><?php echo e($users->firstItem()); ?>–<?php echo e($users->lastItem()); ?></span>
            dari
            <span style="font-weight:700;color:var(--text);"><?php echo e($users->total()); ?></span>
            data
        </div>

        
        <div style="display:flex;align-items:center;gap:6px;">

            
            <?php if($users->onFirstPage()): ?>
                <span style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;background:var(--surface2);color:var(--text-muted);border:1px solid var(--border);cursor:not-allowed;opacity:0.45;user-select:none;">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Prev
                </span>
            <?php else: ?>
                <a href="<?php echo e($users->previousPageUrl()); ?>&<?php echo e(http_build_query(request()->except('page'))); ?>"
                   style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;background:var(--surface);color:var(--text);border:1px solid var(--border);text-decoration:none;transition:all 0.15s;"
                   onmouseover="this.style.background='var(--accent)';this.style.color='#fff';this.style.borderColor='var(--accent)';"
                   onmouseout="this.style.background='var(--surface)';this.style.color='var(--text)';this.style.borderColor='var(--border)';">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Prev
                </a>
            <?php endif; ?>

            
            <?php $__currentLoopData = $users->getUrlRange(1, $users->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == $users->currentPage()): ?>
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;font-size:12px;font-weight:700;background:var(--accent);color:#fff;border:1px solid var(--accent);box-shadow:0 2px 8px rgba(0,0,0,0.15);user-select:none;">
                        <?php echo e($page); ?>

                    </span>
                <?php elseif($page == 1 || $page == $users->lastPage() || abs($page - $users->currentPage()) <= 1): ?>
                    <a href="<?php echo e($url); ?>&<?php echo e(http_build_query(request()->except('page'))); ?>"
                       style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;font-size:12px;font-weight:600;background:var(--surface);color:var(--text);border:1px solid var(--border);text-decoration:none;transition:all 0.15s;"
                       onmouseover="this.style.background='var(--surface2)';this.style.borderColor='var(--accent)';"
                       onmouseout="this.style.background='var(--surface)';this.style.borderColor='var(--border)';">
                        <?php echo e($page); ?>

                    </a>
                <?php elseif(abs($page - $users->currentPage()) == 2): ?>
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;font-size:12px;color:var(--text-muted);user-select:none;">···</span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($users->hasMorePages()): ?>
                <a href="<?php echo e($users->nextPageUrl()); ?>&<?php echo e(http_build_query(request()->except('page'))); ?>"
                   style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;background:var(--surface);color:var(--text);border:1px solid var(--border);text-decoration:none;transition:all 0.15s;"
                   onmouseover="this.style.background='var(--accent)';this.style.color='#fff';this.style.borderColor='var(--accent)';"
                   onmouseout="this.style.background='var(--surface)';this.style.color='var(--text)';this.style.borderColor='var(--border)';">
                    Next
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            <?php else: ?>
                <span style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;background:var(--surface2);color:var(--text-muted);border:1px solid var(--border);cursor:not-allowed;opacity:0.45;user-select:none;">
                    Next
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>
    

</div>


<div class="modal-overlay" id="modal-user-detail">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Detail Pengguna</div>
            <button class="modal-close" onclick="closeModal('modal-user-detail')">×</button>
        </div>
        <div id="user-detail-body">
            
        </div>
        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:16px;">
            <button class="btn btn-ghost" onclick="closeModal('modal-user-detail')">Tutup</button>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const usersData = <?php echo json_encode($users->items(), 15, 512) ?>;

    function openUserDetail(id) {
        const u = usersData.find(x => x.id === id);
        if (!u) return;

        const roleMain = u.role === 'admin' ? '🛡️ Admin'
    : u.role === 'trainer'  ? '🎓 Trainer'
    : u.role === 'mentor'   ? '💡 Mentor'
    : u.role === 'umkm'     ? '🏪 UMKM'
    : '👤 Umum';

const roleExtras = [
    (u.is_pembimbing && u.role !== 'trainer')                      ? '+ Pembimbing'  : null,
    (u.trainer_status === 'approved' && u.role !== 'trainer')      ? '+ Trainer ✓'   : null,
    (u.mentor_status  === 'approved' && u.role !== 'mentor')       ? '+ Mentor ✓'    : null,
    (u.is_umkm        && u.role !== 'umkm')                        ? '+ UMKM'        : null,
].filter(Boolean);

const roleName = roleMain + (roleExtras.length ? ' <span style="font-size:11px;color:var(--text-muted);">(' + roleExtras.join(', ') + ')</span>' : '');
        const initials = u.name.substring(0, 2).toUpperCase();
        const avatarColors = ['var(--accent)','var(--accent3)','var(--warning)','#8b5cf6','#ec4899'];
        const color = avatarColors[id % 5];

        document.getElementById('user-detail-body').innerHTML = `
            <div style="display:flex;align-items:center;gap:14px;background:var(--surface2);border-radius:14px;padding:16px;margin-bottom:18px;border:1px solid var(--border);">
                <div style="width:56px;height:56px;border-radius:13px;background:${color};display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;color:#fff;flex-shrink:0;">
                    ${initials}
                </div>
                <div>
                    <div style="font-size:17px;font-weight:700;">${u.name}</div>
                    <div style="font-size:12px;color:var(--text-muted);margin-top:2px;">${u.email}</div>
                </div>
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-label">Role</div><div class="detail-value">${roleName}</div></div>
                <div class="detail-item"><div class="detail-label">No. Telepon</div><div class="detail-value">${u.phone ?? '-'}</div></div>
                <div class="detail-item full"><div class="detail-label">Alamat</div><div class="detail-value" style="font-weight:400;font-size:13px;">${u.address ?? '-'}</div></div>
                <div class="detail-item full"><div class="detail-label">Bio</div><div class="detail-value" style="font-weight:400;font-size:13px;color:var(--text-muted);line-height:1.6;">${u.bio ?? 'Belum ada bio'}</div></div>
                <div class="detail-item"><div class="detail-label">Trainer Status</div><div class="detail-value">${u.trainer_status === 'approved' ? '✅ Approved' : u.trainer_status === 'pending' ? '⏳ Pending' : u.trainer_status === 'rejected' ? '❌ Rejected' : '—'}</div></div>
<div class="detail-item"><div class="detail-label">Mentor Status</div><div class="detail-value">${u.mentor_status === 'approved' ? '✅ Approved' : u.mentor_status === 'pending' ? '⏳ Pending' : u.mentor_status === 'rejected' ? '❌ Rejected' : '—'}</div></div>
            </div>
        `;

        openModal('modal-user-detail');
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/admin/pengguna.blade.php ENDPATH**/ ?>