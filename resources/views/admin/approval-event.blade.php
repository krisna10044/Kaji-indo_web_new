@extends('layouts.admin')

@section('page-title', 'Approval Event')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.all.min.js"></script>
<style>
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
    .swal-btn-confirm-delete {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #ea580c; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-confirm-delete:hover { background: #c2410c; }
    .swal-btn-confirm-restore {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #7c3aed; color: #fff; border: none; cursor: pointer; transition: background 0.15s;
    }
    .swal-btn-confirm-restore:hover { background: #6d28d9; }
    .swal-btn-cancel {
        display: inline-flex; align-items: center;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
        background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; cursor: pointer;
    }
    .swal-btn-cancel:hover { background: #e5e7eb; }
    .swal2-popup  { border-radius: 16px !important; padding: 32px 28px !important; }
    .swal2-title  { font-size: 18px !important; font-weight: 700 !important; color: #111827 !important; }
    .swal2-actions{ gap: 10px !important; margin-top: 24px !important; }

    /* ── Biaya badge ── */
    .badge-gratis   { background:#dcfce7; color:#15803d; border:1px solid #86efac; }
    .badge-berbayar { background:#fef3c7; color:#92400e; border:1px solid #fde68a; }

    /* ── Delete badge ── */
    .badge-deleted  {
        background: #fff7ed; color: #c2410c;
        border: 1px solid #fed7aa;
    }

    /* ── Btn delete & restore ── */
    .btn-delete {
        background: #fff7ed; color: #c2410c;
        border: 1.5px solid #fed7aa;
    }
    .btn-delete:hover { background: #ffedd5; border-color: #fb923c; }

    .btn-restore {
        background: #f5f3ff; color: #7c3aed;
        border: 1.5px solid #ddd6fe;
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px; border-radius: 10px; font-size: 12px; font-weight: 600;
        cursor: pointer; font-family: inherit; transition: all .15s; text-decoration: none;
    }
    .btn-restore:hover { background: #ede9fe; border-color: #c4b5fd; }

    /* ── Row dihapus: redup ── */
    tr.row-deleted td { opacity: 0.6; }
    tr.row-deleted:hover td { opacity: 0.85; }

    /* ── Info banner dihapus ── */
    .deleted-info-banner {
        display: flex; align-items: center; gap: 8px;
        background: #fff7ed; border: 1px solid #fed7aa;
        border-radius: 10px; padding: 8px 12px; margin-top: 4px;
        font-size: 11px; color: #c2410c; line-height: 1.4;
    }

    /* ===================== RESPONSIVE MOBILE ===================== */
    @media (max-width: 768px) {
        .tab-bar {
            width: 100% !important;
            overflow-x: auto !important;
            flex-wrap: nowrap !important;
            -webkit-overflow-scrolling: touch;
        }
        .tab-btn { white-space: nowrap !important; flex-shrink: 0 !important; }
        .table-card-header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 6px !important;
            padding: 12px 14px !important;
        }
        .table-card table { table-layout: fixed !important; width: 100% !important; }

        /* Sembunyikan: Pembimbing(2), Lokasi(3), Tanggal(4), Kapasitas(5), Status(6) */
        .table-card table thead tr th:nth-child(2),
        .table-card table tbody tr td:nth-child(2),
        .table-card table thead tr th:nth-child(3),
        .table-card table tbody tr td:nth-child(3),
        .table-card table thead tr th:nth-child(4),
        .table-card table tbody tr td:nth-child(4),
        .table-card table thead tr th:nth-child(5),
        .table-card table tbody tr td:nth-child(5),
        .table-card table thead tr th:nth-child(6),
        .table-card table tbody tr td:nth-child(6) { display: none !important; }

        .table-card table thead tr th:nth-child(1),
        .table-card table tbody tr td:nth-child(1) { width: 60% !important; }
        .table-card table thead tr th:nth-child(7),
        .table-card table tbody tr td:nth-child(7) { width: 40% !important; }

        thead th { padding: 10px 10px !important; font-size: 9px !important; }
        tbody td  { padding: 10px 10px !important; }

        .preview-cell { gap: 6px !important; }
        .preview-thumb { width: 36px !important; height: 36px !important; font-size: 16px !important; flex-shrink: 0 !important; }
        .preview-name { font-size: 11px !important; overflow: hidden !important; text-overflow: ellipsis !important; white-space: nowrap !important; max-width: 110px !important; }
        .preview-cell .badge-gratis, .preview-cell .badge-berbayar { display: none !important; }

        .action-group { flex-direction: column !important; gap: 4px !important; align-items: stretch !important; width: 100% !important; }
        .action-group .btn-sm { font-size: 11px !important; padding: 6px 4px !important; white-space: nowrap !important; justify-content: center !important; width: 100% !important; display: flex !important; box-sizing: border-box !important; min-height: 30px !important; }
        .action-group .btn-ghost.btn-sm { display: flex !important; align-items: center !important; justify-content: center !important; }

        .modal-overlay { align-items: flex-end !important; padding: 0 !important; }
        .modal { width: 100% !important; max-width: 100% !important; border-radius: 20px 20px 0 0 !important; padding: 20px 16px 32px !important; max-height: 90vh !important; }
        #modal-reject .modal { width: 100% !important; }
        #modal-delete .modal { width: 100% !important; }
        .img-preview { height: 130px !important; margin-bottom: 14px !important; }
        .detail-grid { grid-template-columns: 1fr !important; gap: 8px !important; }
        .form-textarea { font-size: 14px !important; }
        .swal2-popup { width: 92% !important; padding: 24px 18px !important; }
    }
</style>
@endpush

@section('content')

{{-- ── Tab status ── --}}
<div class="tab-bar">
    <button class="tab-btn {{ $status === 'pending'  ? 'active' : '' }}"
        onclick="location.href='{{ route('admin.approval.event') }}?status=pending'">
        Pending
        @if($counts['pending'] > 0)
            <span class="count-pill">{{ $counts['pending'] }}</span>
        @endif
    </button>
    <button class="tab-btn {{ $status === 'approved' ? 'active' : '' }}"
        onclick="location.href='{{ route('admin.approval.event') }}?status=approved'">
        Disetujui
        @if($counts['approved'] > 0)
            <span class="count-pill" style="background:var(--accent);">{{ $counts['approved'] }}</span>
        @endif
    </button>
    <button class="tab-btn {{ $status === 'rejected' ? 'active' : '' }}"
        onclick="location.href='{{ route('admin.approval.event') }}?status=rejected'">
        Ditolak
        @if($counts['rejected'] > 0)
            <span class="count-pill" style="background:#9ca3af;">{{ $counts['rejected'] }}</span>
        @endif
    </button>
    {{-- Tab Dihapus --}}
    <button class="tab-btn {{ $status === 'deleted' ? 'active' : '' }}"
        onclick="location.href='{{ route('admin.approval.event') }}?status=deleted'"
        style="{{ $status === 'deleted' ? '' : '' }}">
        🗑️ Dihapus
        @if($counts['deleted'] > 0)
            <span class="count-pill" style="background:#c2410c;">{{ $counts['deleted'] }}</span>
        @endif
    </button>
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            @if($status === 'deleted')
                🗑️ Event Dihapus Admin
            @else
                📅 Daftar Event
            @endif
            <span class="table-card-subtitle">{{ $events->count() }} event</span>
        </div>

        {{-- Banner info untuk tab deleted --}}
        @if($status === 'deleted')
        <div class="deleted-info-banner" style="margin-top:0;width:100%;box-sizing:border-box;">
            ℹ️ Event di bawah ini dihapus oleh admin namun <strong>tidak dihapus permanen</strong>.
            Trainer dapat memulihkannya dari dashboard mereka. Admin juga bisa memulihkan di sini.
        </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>{{ $status === 'deleted' ? 'Dihapus Oleh' : 'Pembimbing' }}</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Kapasitas</th>
                <th>{{ $status === 'deleted' ? 'Alasan Hapus' : 'Status' }}</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            @php $st = $event->status ?? 'pending'; @endphp
            <tr class="{{ $event->deleted_by_admin_at ? 'row-deleted' : '' }}">

                {{-- Event --}}
                <td>
                    <div class="preview-cell">
                        <div class="preview-thumb">
                            @if($event->gambar)
                                <img src="{{ asset('storage/' . $event->gambar) }}"
                                     alt="{{ $event->judul }}"
                                     style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                            @else
                                🎪
                            @endif
                        </div>
                        <div>
                            <div class="preview-name">{{ $event->judul }}</div>
                            @if(empty($event->biaya) || $event->biaya == '0' || strtolower($event->biaya) === 'gratis')
                                <span class="badge badge-gratis"
                                      style="display:inline-flex;align-items:center;gap:3px;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;margin-top:3px;">
                                    ✅ Gratis
                                </span>
                            @else
                                <span class="badge badge-berbayar"
                                      style="display:inline-flex;align-items:center;gap:3px;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;margin-top:3px;">
                                    💰 {{ $event->biaya }}
                                </span>
                            @endif
                        </div>
                    </div>
                </td>

                {{-- Pembimbing / Dihapus oleh --}}
                <td>
                    @if($status === 'deleted')
                        {{-- Tampilkan siapa admin yang menghapus --}}
                        @if($event->deletedByAdmin)
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:#ea580c;">
                                    {{ strtoupper(substr($event->deletedByAdmin->name ?? 'A', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="submitter-name">{{ $event->deletedByAdmin->name ?? 'Admin' }}</div>
                                    <div class="submitter-sub">
                                        {{ $event->deleted_by_admin_at?->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <span style="color:var(--text-muted);font-size:12px;">Admin</span>
                        @endif
                    @else
                        {{-- Tampilkan trainer (behaviour lama) --}}
                        @if($event->trainer)
                        <div class="submitter">
                            <div class="submitter-avatar" style="background:var(--accent);">
                                {{ strtoupper(substr($event->trainer->name ?? 'T', 0, 2)) }}
                            </div>
                            <div>
                                <div class="submitter-name">{{ $event->trainer->name }}</div>
                                <div class="submitter-sub">Trainer</div>
                            </div>
                        </div>
                        @else
                            <span style="color:var(--text-muted);font-size:12px;">-</span>
                        @endif
                    @endif
                </td>

                {{-- Lokasi --}}
                <td style="font-size:13px;color:var(--text-muted);">
                    {{ $event->lokasi ?? '-' }}
                </td>

                {{-- Tanggal --}}
                <td style="font-size:13px;">
                    <div style="font-weight:600;color:var(--text);">
                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}
                    </div>
                    @if($event->waktu_mulai && $event->waktu_selesai)
                        <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">
                            {{ $event->jam }}
                        </div>
                    @endif
                </td>

                {{-- Kapasitas --}}
                <td style="font-size:13px;color:var(--text-muted);">
                    {{ $event->kapasitas ? $event->kapasitas . ' orang' : '-' }}
                </td>

                {{-- Status / Alasan hapus --}}
                <td>
                    @if($status === 'deleted')
                        <div style="font-size:12px;color:#c2410c;line-height:1.5;max-width:160px;">
                            {{ $event->deleted_reason
                                ? \Illuminate\Support\Str::limit($event->deleted_reason, 60)
                                : '—' }}
                        </div>
                        <div style="font-size:10px;color:#9ca3af;margin-top:3px;">
                            Trainer: {{ $event->trainer->name ?? '-' }}
                        </div>
                    @elseif($st === 'approved')
                        <span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>
                    @elseif($st === 'rejected')
                        <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
                        @if($event->catatan_admin)
                            <div style="font-size:10px;color:#ef4444;margin-top:3px;max-width:140px;line-height:1.4;">
                                {{ \Illuminate\Support\Str::limit($event->catatan_admin, 40) }}
                            </div>
                        @endif
                    @else
                        <span class="badge badge-pending"><span class="badge-dot"></span>Pending</span>
                    @endif
                </td>

                {{-- Aksi --}}
                <td>
                    <div class="action-group">

                        {{-- Detail (semua tab kecuali deleted) --}}
                        @if($status !== 'deleted')
                        <button class="btn btn-ghost btn-sm btn-icon" title="Detail"
                                onclick="openDetailModal({{ $event->id }})">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        @endif

                        {{-- Setujui --}}
                        @if($st !== 'approved' && $status !== 'deleted')
                        <form method="POST"
                              action="{{ route('admin.approval.event.approve', $event->id) }}"
                              id="form-approve-{{ $event->id }}"
                              style="display:inline;">
                            @csrf
                            <button type="button" class="btn btn-approve btn-sm"
                                    onclick="confirmApprove({{ $event->id }}, '{{ addslashes($event->judul) }}')">
                                ✓ Setujui
                            </button>
                        </form>
                        @endif

                        {{-- Tolak --}}
                        @if($st !== 'rejected' && $status !== 'deleted')
                        <button class="btn btn-reject btn-sm"
                                onclick="confirmReject({{ $event->id }}, '{{ addslashes($event->judul) }}')">
                            ✕ Tolak
                        </button>
                        @endif

                        {{-- Hapus (soft delete) — hanya untuk event approved --}}
                        @if($st === 'approved' && $status !== 'deleted')
                        <button type="button" class="btn btn-delete btn-sm"
                                onclick="confirmDelete({{ $event->id }}, '{{ addslashes($event->judul) }}')">
                            🗑️ Hapus
                        </button>
                        {{-- Hidden form soft delete --}}
                        @endif

                        {{-- Pulihkan (restore) — hanya di tab deleted --}}
                        @if($status === 'deleted')
    {{-- Pulihkan --}}
    <form method="POST"
          action="{{ route('admin.approval.event.restore', $event->id) }}"
          id="form-restore-{{ $event->id }}"
          style="display:inline;">
        @csrf
        <button type="button" class="btn btn-restore btn-sm"
                onclick="confirmRestore({{ $event->id }}, '{{ addslashes($event->judul) }}')">
            ↩️ Pulihkan
        </button>
    </form>

    {{-- Hapus Permanen --}}
    <form method="POST"
          action="{{ route('admin.approval.event.force-delete', $event->id) }}"
          id="form-force-delete-event-{{ $event->id }}"
          style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    <button type="button" class="btn btn-delete btn-sm"
            onclick="confirmForceDeleteEvent({{ $event->id }}, '{{ addslashes($event->judul) }}')">
        🗑️ Hapus Permanen
    </button>
@endif

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        @if($status === 'deleted')
                            <div class="empty-state-icon">🗂️</div>
                            <div class="empty-state-text">Tidak ada event yang dihapus admin</div>
                        @else
                            <div class="empty-state-icon">🎉</div>
                            <div class="empty-state-text">Tidak ada event dengan status ini</div>
                        @endif
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- ======================== MODAL DETAIL ======================== --}}
<div class="modal-overlay" id="modal-detail">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Detail Event</div>
            <button class="modal-close" onclick="closeModal('modal-detail')">✕</button>
        </div>
        <div class="img-preview" id="detail-img">🎪</div>
        <div class="detail-grid" id="detail-grid"></div>
        <div class="detail-item full" id="d-reject-wrap" style="display:none;margin-bottom:12px;">
            <div class="detail-label" style="color:#ef4444;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">
                Alasan Penolakan
            </div>
            <div class="detail-value" id="d-reject" style="font-weight:400;font-size:13px;color:#ef4444;"></div>
        </div>
        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:4px;">
            <button class="btn btn-ghost btn-sm" onclick="closeModal('modal-detail')">Tutup</button>
            <button class="btn btn-reject btn-sm"  id="btn-detail-reject"  style="display:none;">✕ Tolak</button>
            <button class="btn btn-approve btn-sm" id="btn-detail-approve" style="display:none;">✓ Setujui</button>
        </div>
    </div>
</div>


{{-- ======================== MODAL TOLAK ======================== --}}
<div class="modal-overlay" id="modal-reject">
    <div class="modal" style="max-width:460px;">
        <div class="modal-header">
            <div class="modal-title">Tolak Event</div>
            <button class="modal-close" onclick="closeModal('modal-reject')">✕</button>
        </div>
        <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:18px;line-height:1.6;">
            Berikan alasan penolakan untuk <strong id="reject-name"></strong>.
            Alasan ini akan tersimpan sebagai catatan untuk trainer.
        </p>
        <form id="form-reject" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Catatan / Alasan Penolakan *</label>
                <textarea name="catatan_admin" class="form-textarea" rows="4"
                          placeholder="Jelaskan alasan penolakan event ini..."
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


{{-- ======================== MODAL HAPUS (soft delete) ======================== --}}
<div class="modal-overlay" id="modal-delete">
    <div class="modal" style="max-width:460px;">
        <div class="modal-header">
            <div class="modal-title">🗑️ Hapus Event</div>
            <button class="modal-close" onclick="closeModal('modal-delete')">✕</button>
        </div>
        <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:6px;line-height:1.6;">
            Hapus event <strong id="delete-event-name"></strong> dari tampilan publik.
        </p>
        <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:10px;padding:10px 14px;margin-bottom:18px;font-size:12px;color:#c2410c;line-height:1.6;">
            ⚠️ Event <strong>tidak dihapus permanen</strong>. Trainer masih bisa memulihkannya dari dashboard mereka, dan admin juga bisa memulihkan dari tab <em>Dihapus</em>.
        </div>
        <form id="form-delete-modal" method="POST">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <label class="form-label">Alasan Penghapusan <span style="color:#9ca3af;font-weight:400;">(opsional)</span></label>
                <textarea name="reason" id="delete-reason-input" class="form-textarea" rows="3"
                          placeholder="Contoh: Konten tidak sesuai pedoman, event sudah lewat batas waktu..."></textarea>
            </div>
            <div style="display:flex;gap:10px;margin-top:6px;">
                <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-delete')">Batal</button>
                <button type="submit" class="btn btn-delete" style="flex:1;border-radius:10px;font-size:12px;font-weight:600;padding:8px 14px;justify-content:center;">
                    🗑️ Hapus Event
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
const eventData = @json($events->values());
const csrfToken = '{{ csrf_token() }}';

// ── SweetAlert2 mixins ────────────────────────────────────────────────────────
const swalApprove = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-approve', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalReject = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-reject', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalRestore = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-restore', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});

// ── Confirm Approve ───────────────────────────────────────────────────────────
function confirmApprove(id, name) {
    swalApprove.fire({
        title: 'Setujui Event?',
        html:  '<span style="font-size:14px;color:#6b7280;">Event <strong>' + name + '</strong> akan dipublikasikan ke website.</span>',
        icon:  'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '✓ Ya, Setujui',
        cancelButtonText:  'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('form-approve-' + id).submit();
    });
}

// ── Confirm Reject ────────────────────────────────────────────────────────────
function confirmReject(id, name) {
    swalReject.fire({
        title: 'Tolak Event?',
        html:  '<span style="font-size:14px;color:#6b7280;">Kamu akan menolak event <strong>' + name + '</strong>.</span>',
        icon:  'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '→ Lanjut Isi Alasan',
        cancelButtonText:  'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) openRejectModal(id, name);
    });
}

// ── Confirm Delete (soft delete) ──────────────────────────────────────────────
function confirmDelete(id, name) {
    // Buka modal delete (ada textarea alasan)
    document.getElementById('delete-event-name').textContent = name;
    document.getElementById('delete-reason-input').value = '';
    document.getElementById('form-delete-modal').action =
    '/admin/approval/event/' + id;
    openModal('modal-delete');
}

// ── Confirm Restore ───────────────────────────────────────────────────────────
function confirmRestore(id, name) {
    swalRestore.fire({
        title: 'Pulihkan Event?',
        html:  '<span style="font-size:14px;color:#6b7280;">Event <strong>' + name + '</strong> akan dipulihkan dan aktif kembali. Trainer juga akan melihat event ini di dashboard mereka.</span>',
        icon:  'question', iconColor: '#7c3aed',
        showCancelButton: true,
        confirmButtonText: '↩️ Ya, Pulihkan',
        cancelButtonText:  'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('form-restore-' + id).submit();
    });
}

// ── Modal Detail ──────────────────────────────────────────────────────────────
function openDetailModal(id) {
    const e = eventData.find(function(x) { return x.id === id; });
    if (!e) return;

    const imgEl = document.getElementById('detail-img');
    if (e.gambar) {
        imgEl.innerHTML = '<img src="/storage/' + e.gambar + '" alt="' + e.judul + '" style="width:100%;height:100%;object-fit:cover;">';
    } else {
        imgEl.textContent = '🎪';
    }

    const biayaLabel = (!e.biaya || e.biaya === '0' || e.biaya.toLowerCase() === 'gratis')
        ? '✅ Gratis'
        : '💰 ' + e.biaya;

    let jamStr = '-';
    if (e.waktu_mulai && e.waktu_selesai) {
        const fmt = function(t) { return t.substring(0,5).replace(':', '.'); };
        jamStr = fmt(e.waktu_mulai) + ' – ' + fmt(e.waktu_selesai) + ' WIB';
    }

    document.getElementById('detail-grid').innerHTML =
        '<div class="detail-item">' +
            '<div class="detail-label">Nama Event</div>' +
            '<div class="detail-value">' + (e.judul ?? '-') + '</div>' +
        '</div>' +
        '<div class="detail-item">' +
            '<div class="detail-label">Tanggal</div>' +
            '<div class="detail-value">' + (e.tanggal ? e.tanggal.substring(0,10) : '-') + '</div>' +
        '</div>' +
        '<div class="detail-item">' +
            '<div class="detail-label">Waktu</div>' +
            '<div class="detail-value">' + jamStr + '</div>' +
        '</div>' +
        '<div class="detail-item">' +
            '<div class="detail-label">Lokasi</div>' +
            '<div class="detail-value">' + (e.lokasi ?? '-') + '</div>' +
        '</div>' +
        '<div class="detail-item">' +
            '<div class="detail-label">Kapasitas</div>' +
            '<div class="detail-value">' + (e.kapasitas ? e.kapasitas + ' orang' : '-') + '</div>' +
        '</div>' +
        '<div class="detail-item">' +
            '<div class="detail-label">Biaya</div>' +
            '<div class="detail-value">' + biayaLabel + '</div>' +
        '</div>' +
        '<div class="detail-item full">' +
            '<div class="detail-label">Deskripsi</div>' +
            '<div class="detail-value" style="font-weight:400;font-size:13px;line-height:1.7;color:var(--text-muted)">' +
                (e.deskripsi ?? '-') +
            '</div>' +
        '</div>';

    const rejectWrap = document.getElementById('d-reject-wrap');
    if (e.status === 'rejected' && e.catatan_admin) {
        rejectWrap.style.display = 'block';
        document.getElementById('d-reject').textContent = e.catatan_admin;
    } else {
        rejectWrap.style.display = 'none';
    }

    const btnApprove = document.getElementById('btn-detail-approve');
    const btnReject  = document.getElementById('btn-detail-reject');
    btnApprove.style.display = e.status !== 'approved' ? 'inline-flex' : 'none';
    btnReject.style.display  = e.status !== 'rejected' ? 'inline-flex' : 'none';
    btnApprove.onclick = function() { closeModal('modal-detail'); confirmApprove(id, e.judul); };
    btnReject.onclick  = function() { closeModal('modal-detail'); confirmReject(id, e.judul); };

    openModal('modal-detail');
}

// ── Modal Reject ──────────────────────────────────────────────────────────────
function openRejectModal(id, name) {
    document.getElementById('reject-name').textContent = name;
    document.getElementById('form-reject').action = '/admin/approval/event/' + id + '/reject';
    openModal('modal-reject');
}

// ── Helpers ───────────────────────────────────────────────────────────────────
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(function(el) {
    el.addEventListener('click', function(e) {
        if (e.target === el) closeModal(el.id);
    });
});

const swalDelete = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-delete', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
function confirmForceDeleteEvent(id, name) {
    swalDelete.fire({
        title: 'Hapus Permanen?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Event <strong>${name}</strong> akan dihapus selamanya.<br>
                <span style="color:#ef4444;font-size:13px;margin-top:6px;display:block;">
                    ⚠️ Tindakan ini tidak dapat dibatalkan dan trainer tidak bisa memulihkannya kembali.
                </span>
               </span>`,
        icon: 'warning', iconColor: '#ea580c',
        showCancelButton: true,
        confirmButtonText: '🗑️ Ya, Hapus Permanen',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('form-force-delete-event-' + id).submit();
    });
}
</script>
@endpush