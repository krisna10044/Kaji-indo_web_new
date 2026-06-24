{{-- resources/views/admin/approval-trainer.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Approval Trainer')

@push('styles')
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
    .doc-btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    .doc-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        text-decoration: none;
        border: 1px solid transparent;
        transition: all 0.15s;
        white-space: nowrap;
        line-height: 1;
    }
    .doc-btn-ktp      { background:#E6F1FB; color:#0C447C; border-color:#B5D4F4; }
    .doc-btn-ktp:hover      { background:#C9E1F7; }
    .doc-btn-bnsp     { background:#EEEDFE; color:#3C3489; border-color:#CECBF6; }
    .doc-btn-bnsp:hover     { background:#DDDCFC; }
    .doc-btn-drive    { background:#E6F7F2; color:#0F6E56; border-color:#A7DED0; }
    .doc-btn-drive:hover    { background:#C6EDE3; }
    .doc-btn-transfer { background:#FEF3C7; color:#92400E; border-color:#FCD34D; }
    .doc-btn-transfer:hover { background:#FDE68A; }
    .doc-btn-foto     { background:#FCE7F3; color:#9D174D; border-color:#F9A8D4; }
    .doc-btn-foto:hover     { background:#FBCFE8; }
    .doc-btn-disabled { background:#f3f4f6; color:#c0c4cc; border-color:#e5e7eb; cursor:not-allowed; opacity:0.6; }

    .swal-btn-confirm-approve {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #10b981; color: #fff; border: none; cursor: pointer;
        transition: background 0.15s;
    }
    .swal-btn-confirm-approve:hover { background: #059669; }
    .swal-btn-confirm-reject {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        background: #ef4444; color: #fff; border: none; cursor: pointer;
        transition: background 0.15s;
    }
    .swal-btn-confirm-reject:hover { background: #dc2626; }
    .swal-btn-cancel {
        display: inline-flex; align-items: center;
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 500;
        background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; cursor: pointer;
        transition: background 0.15s;
    }
    .swal-btn-cancel:hover { background: #e5e7eb; }
    .swal2-popup { border-radius: 16px !important; padding: 32px 28px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; color: #111827 !important; }
    .swal2-actions { gap: 10px !important; margin-top: 24px !important; }

    .relative-time {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: var(--text-muted);
    }
    .relative-time::before {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #34d399;
        flex-shrink: 0;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.4; transform: scale(0.7); }
    }

    /* ── Avatar foto profil di modal ── */
    .detail-avatar-photo {
        width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        display: block;
    }
    .detail-avatar-initials {
        font-size: 32px;
        font-weight: 700;
        color: #0F6E56;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    /* ── Tab Dihapus chip merah ── */
    .deleted-chip {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 11px; font-weight: 600; padding: 3px 9px; border-radius: 20px;
        background: #fee2e2; color: #dc2626; border: 1px solid #fca5a566;
    }

    /* ===================== RESPONSIVE MOBILE ===================== */
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
        .table-card-header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 6px !important;
            padding: 12px 14px !important;
        }
        .table-card table {
            table-layout: fixed !important;
            width: 100% !important;
        }

        /* TAB PENDING */
        #tab-pending thead tr th:nth-child(2),
        #tab-pending tbody tr td:nth-child(2),
        #tab-pending thead tr th:nth-child(3),
        #tab-pending tbody tr td:nth-child(3),
        #tab-pending thead tr th:nth-child(4),
        #tab-pending tbody tr td:nth-child(4),
        #tab-pending thead tr th:nth-child(5),
        #tab-pending tbody tr td:nth-child(5) { display: none !important; }
        #tab-pending thead tr th:nth-child(1),
        #tab-pending tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-pending thead tr th:nth-child(6),
        #tab-pending tbody tr td:nth-child(6) { width: 45% !important; }

        /* TAB APPROVED */
        #tab-approved thead tr th:nth-child(2),
        #tab-approved tbody tr td:nth-child(2),
        #tab-approved thead tr th:nth-child(3),
        #tab-approved tbody tr td:nth-child(3),
        #tab-approved thead tr th:nth-child(4),
        #tab-approved tbody tr td:nth-child(4),
        #tab-approved thead tr th:nth-child(5),
        #tab-approved tbody tr td:nth-child(5),
        #tab-approved thead tr th:nth-child(6),
        #tab-approved tbody tr td:nth-child(6) { display: none !important; }
        #tab-approved thead tr th:nth-child(1),
        #tab-approved tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-approved thead tr th:nth-child(7),
        #tab-approved tbody tr td:nth-child(7) { width: 45% !important; }

        /* TAB REJECTED */
        #tab-rejected thead tr th:nth-child(2),
        #tab-rejected tbody tr td:nth-child(2),
        #tab-rejected thead tr th:nth-child(3),
        #tab-rejected tbody tr td:nth-child(3),
        #tab-rejected thead tr th:nth-child(4),
        #tab-rejected tbody tr td:nth-child(4),
        #tab-rejected thead tr th:nth-child(5),
        #tab-rejected tbody tr td:nth-child(5) { display: none !important; }
        #tab-rejected thead tr th:nth-child(1),
        #tab-rejected tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-rejected thead tr th:nth-child(6),
        #tab-rejected tbody tr td:nth-child(6) { width: 45% !important; }

        /* TAB DELETED */
        #tab-deleted thead tr th:nth-child(2),
        #tab-deleted tbody tr td:nth-child(2),
        #tab-deleted thead tr th:nth-child(3),
        #tab-deleted tbody tr td:nth-child(3) { display: none !important; }
        #tab-deleted thead tr th:nth-child(1),
        #tab-deleted tbody tr td:nth-child(1) { width: 55% !important; }
        #tab-deleted thead tr th:nth-child(4),
        #tab-deleted tbody tr td:nth-child(4) { width: 45% !important; }

        thead th { padding: 10px 10px !important; font-size: 9px !important; }
        tbody td  { padding: 10px 10px !important; }

        .submitter { gap: 6px !important; }
        .submitter-avatar {
            width: 32px !important; height: 32px !important;
            font-size: 10px !important; flex-shrink: 0 !important;
        }
        .submitter-name {
            font-size: 11px !important; overflow: hidden !important;
            text-overflow: ellipsis !important; white-space: nowrap !important; max-width: 100px !important;
        }
        .submitter-sub {
            font-size: 10px !important; overflow: hidden !important;
            text-overflow: ellipsis !important; white-space: nowrap !important; max-width: 100px !important;
        }

        .action-group {
            flex-direction: column !important; gap: 4px !important;
            align-items: stretch !important; width: 100% !important;
        }
        .action-group .btn-sm {
            font-size: 11px !important; padding: 6px 4px !important;
            white-space: nowrap !important; justify-content: center !important;
            width: 100% !important; display: flex !important;
            box-sizing: border-box !important; min-height: 30px !important;
        }
        .action-group .btn-sm svg { width: 13px !important; height: 13px !important; flex-shrink: 0 !important; }

        .modal-overlay { align-items: flex-end !important; padding: 0 !important; }
        .modal {
            width: 100% !important; max-width: 100% !important;
            border-radius: 20px 20px 0 0 !important;
            padding: 20px 16px 32px !important; max-height: 92vh !important;
        }
        #modal-reject .modal { width: 100% !important; }
        #detail-avatar-wrap { min-height: 100px !important; max-height: 200px !important; margin-bottom: 14px !important; border-radius: 12px !important; }
        .detail-grid { grid-template-columns: 1fr !important; gap: 8px !important; }
        .detail-item.full { grid-column: 1 !important; }
        .form-textarea { font-size: 14px !important; }
        .swal2-popup { width: 92% !important; padding: 24px 18px !important; }
        .doc-btn-group { flex-wrap: wrap !important; gap: 4px !important; }
        .doc-btn { font-size: 10px !important; padding: 4px 8px !important; }
    }
</style>
@endpush

@section('content')

{{-- Tab Bar --}}
<div class="tab-bar">
    <button class="tab-btn active" onclick="switchTab('pending', this)">
        Menunggu
        @if($counts['pending'] > 0)
            <span class="count-pill">{{ $counts['pending'] }}</span>
        @endif
    </button>
    <button class="tab-btn" onclick="switchTab('approved', this)">
        Disetujui
        @if($counts['approved'] > 0)
            <span class="count-pill" style="background:var(--accent);">{{ $counts['approved'] }}</span>
        @endif
    </button>
    <button class="tab-btn" onclick="switchTab('rejected', this)">
        Ditolak
        @if($counts['rejected'] > 0)
            <span class="count-pill" style="background:#9ca3af;">{{ $counts['rejected'] }}</span>
        @endif
    </button>
    <button class="tab-btn" onclick="switchTab('deleted', this)">
        🗑️ Dihapus
        @if(($counts['deleted'] ?? 0) > 0)
            <span class="count-pill" style="background:#ef4444;">{{ $counts['deleted'] }}</span>
        @endif
    </button>
</div>

{{-- ======================== TAB PENDING ======================== --}}
<div id="tab-pending">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pendaftaran Menunggu Review
                <span class="table-card-subtitle">{{ $counts['pending'] }} pendaftar</span>
            </div>
            <a href="{{ route('admin.approval.trainer') }}?export=csv&status=pending" class="btn-csv-export">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </div>

        @if($pending->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">🎉</div>
                <div class="empty-state-text">Tidak ada pendaftaran trainer yang menunggu review.</div>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Calon Trainer</th>
                        <th>NIK</th>
                        <th>Dokumen</th>
                        <th>Pengalaman</th>
                        <th>Dikirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $trainer)
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--accent);">
                                    {{ strtoupper(substr($trainer->nama ?? '', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="submitter-name">{{ $trainer->academic_degree ?? $trainer->nama }}</div>
                                    <div class="submitter-sub">{{ $trainer->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:12px;color:var(--text-muted);">{{ $trainer->nik ?? '-' }}</td>
                        <td>
                            <div class="doc-btn-group">
                                @if($trainer->ktp_scan)
                                    @php $p = str_replace('public/', '', $trainer->ktp_scan); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-ktp">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>KTP
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">KTP</span>
                                @endif
                                @if($trainer->bnsp_certificate)
                                    @php $p = str_replace('public/', '', $trainer->bnsp_certificate); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-bnsp">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>BNSP
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">BNSP</span>
                                @endif
                                @if($trainer->bukti_transfer)
                                    @php $p = str_replace('public/', '', $trainer->bukti_transfer); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-transfer">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>Transfer
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">Transfer</span>
                                @endif
                                @if($trainer->white_bg_photo)
                                    @php $p = str_replace('public/', '', $trainer->white_bg_photo); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-foto">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Pas Foto
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">Pas Foto</span>
                                @endif
                                @if($trainer->drive_link_documentation)
                                    <a href="{{ $trainer->drive_link_documentation }}" target="_blank" class="doc-btn doc-btn-drive">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>Drive
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td style="max-width:180px;font-size:12px;color:var(--text-muted);">
                            {{ Str::limit($trainer->experience, 55) }}
                        </td>
                        <td>
                            <span class="relative-time"
                                  data-time="{{ ($trainer->applied_at ?? $trainer->created_at)->toIso8601String() }}"
                                  title="{{ ($trainer->applied_at ?? $trainer->created_at)->format('d M Y, H:i') }}">
                                {{ ($trainer->applied_at ?? $trainer->created_at)->diffForHumans() }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal({{ $trainer->id }})">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="{{ route('admin.trainer.approve', $trainer->id) }}"
                                      id="form-approve-{{ $trainer->id }}" style="display:inline;">
                                    @csrf
                                    <button type="button" class="btn btn-approve btn-sm"
                                        onclick="confirmApprove({{ $trainer->id }}, '{{ addslashes($trainer->academic_degree ?? $trainer->nama) }}')">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Setujui
                                    </button>
                                </form>
                                <button class="btn btn-reject btn-sm"
                                    onclick="confirmReject({{ $trainer->id }}, '{{ addslashes($trainer->academic_degree ?? $trainer->nama) }}')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Tolak
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- ======================== TAB APPROVED ======================== --}}
<div id="tab-approved" style="display:none;">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Trainer Disetujui
                <span class="table-card-subtitle">{{ $counts['approved'] }} trainer aktif</span>
            </div>
            <a href="{{ route('admin.approval.trainer') }}?export=csv&status=approved" class="btn-csv-export">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </div>

        @if($approved->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">Belum ada trainer yang disetujui.</div>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Trainer</th>
                        <th>NIK</th>
                        <th>Dokumen</th>
                        <th>Pengalaman</th>
                        <th>Disetujui</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($approved as $trainer)
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:var(--accent);">
                                    {{ strtoupper(substr($trainer->nama ?? '', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="submitter-name">{{ $trainer->academic_degree ?? $trainer->nama }}</div>
                                    <div class="submitter-sub">{{ $trainer->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:12px;color:var(--text-muted);">{{ $trainer->nik ?? '-' }}</td>
                        <td>
                            <div class="doc-btn-group">
                                @if($trainer->ktp_scan)
                                    @php $p = str_replace('public/', '', $trainer->ktp_scan); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-ktp">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>KTP
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">KTP</span>
                                @endif
                                @if($trainer->bnsp_certificate)
                                    @php $p = str_replace('public/', '', $trainer->bnsp_certificate); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-bnsp">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>BNSP
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">BNSP</span>
                                @endif
                                @if($trainer->bukti_transfer)
                                    @php $p = str_replace('public/', '', $trainer->bukti_transfer); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-transfer">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>Transfer
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">Transfer</span>
                                @endif
                                @if($trainer->white_bg_photo)
                                    @php $p = str_replace('public/', '', $trainer->white_bg_photo); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-foto">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Pas Foto
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">Pas Foto</span>
                                @endif
                                @if($trainer->drive_link_documentation)
                                    <a href="{{ $trainer->drive_link_documentation }}" target="_blank" class="doc-btn doc-btn-drive">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>Drive
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td style="max-width:180px;font-size:12px;color:var(--text-muted);">
                            {{ Str::limit($trainer->experience, 55) }}
                        </td>
                        <td>
                            <span class="relative-time" data-time="{{ $trainer->reviewed_at?->toIso8601String() ?? $trainer->updated_at->toIso8601String() }}"
                                  title="{{ ($trainer->reviewed_at ?? $trainer->updated_at)->format('d M Y, H:i') }}">
                                {{ ($trainer->reviewed_at ?? $trainer->updated_at)->diffForHumans() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-approved"><span class="badge-dot"></span>Aktif</span>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal({{ $trainer->id }})">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="{{ route('admin.trainer.destroy', $trainer->id) }}"
                                      id="form-destroy-trainer-{{ $trainer->id }}" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-ghost btn-sm" style="color:var(--accent2);"
                                        onclick="confirmDestroyTrainer({{ $trainer->id }}, '{{ addslashes($trainer->academic_degree ?? $trainer->nama) }}', 'approved')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- ======================== TAB REJECTED ======================== --}}
<div id="tab-rejected" style="display:none;">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pendaftaran Ditolak
                <span class="table-card-subtitle">{{ $counts['rejected'] }} ditolak</span>
            </div>
            <a href="{{ route('admin.approval.trainer') }}?export=csv&status=rejected" class="btn-csv-export">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export CSV
            </a>
        </div>

        @if($rejected->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">Tidak ada pendaftaran trainer yang ditolak.</div>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Pendaftar</th>
                        <th>NIK</th>
                        <th>Dokumen</th>
                        <th>Alasan Penolakan</th>
                        <th>Ditolak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rejected as $trainer)
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:#9ca3af;">
                                    {{ strtoupper(substr($trainer->nama ?? '', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="submitter-name">{{ $trainer->academic_degree ?? $trainer->nama }}</div>
                                    <div class="submitter-sub">{{ $trainer->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:12px;color:var(--text-muted);">{{ $trainer->nik ?? '-' }}</td>
                        <td>
                            <div class="doc-btn-group">
                                @if($trainer->ktp_scan)
                                    @php $p = str_replace('public/', '', $trainer->ktp_scan); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-ktp">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>KTP
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">KTP</span>
                                @endif
                                @if($trainer->bnsp_certificate)
                                    @php $p = str_replace('public/', '', $trainer->bnsp_certificate); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-bnsp">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>BNSP
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">BNSP</span>
                                @endif
                                @if($trainer->bukti_transfer)
                                    @php $p = str_replace('public/', '', $trainer->bukti_transfer); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-transfer">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>Transfer
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">Transfer</span>
                                @endif
                                @if($trainer->white_bg_photo)
                                    @php $p = str_replace('public/', '', $trainer->white_bg_photo); @endphp
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="doc-btn doc-btn-foto">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Pas Foto
                                    </a>
                                @else
                                    <span class="doc-btn doc-btn-disabled">Pas Foto</span>
                                @endif
                            </div>
                        </td>
                        <td style="max-width:200px;">
                            <div style="font-size:12px;color:var(--accent2);">
                                {{ Str::limit($trainer->rejection_reason ?? '-', 60) }}
                            </div>
                        </td>
                        <td>
                            <span class="relative-time"
                                  data-time="{{ $trainer->reviewed_at?->toIso8601String() ?? $trainer->updated_at->toIso8601String() }}"
                                  title="{{ ($trainer->reviewed_at ?? $trainer->updated_at)->format('d M Y, H:i') }}">
                                {{ ($trainer->reviewed_at ?? $trainer->updated_at)->diffForHumans() }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-ghost btn-sm" onclick="openDetailModal({{ $trainer->id }})">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </button>
                                <form method="POST" action="{{ route('admin.trainer.destroy', $trainer->id) }}"
                                      id="form-destroy-trainer-{{ $trainer->id }}" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-ghost btn-sm" style="color:var(--accent2);"
                                        onclick="confirmDestroyTrainer({{ $trainer->id }}, '{{ addslashes($trainer->academic_degree ?? $trainer->nama) }}', 'rejected')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- ======================== TAB DELETED ======================== --}}
<div id="tab-deleted" style="display:none;">
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                🗑️ Trainer Dihapus Admin
                <span class="table-card-subtitle">{{ $counts['deleted'] ?? 0 }} data</span>
            </div>
        </div>

        @if($deleted->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">✅</div>
                <div class="empty-state-text">Tidak ada trainer yang dihapus.</div>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Trainer</th>
                        <th>NIK</th>
                        <th>Status Sebelumnya</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deleted as $trainer)
                    <tr>
                        <td>
                            <div class="submitter">
                                <div class="submitter-avatar" style="background:#9ca3af;">
                                    {{ strtoupper(substr($trainer->nama ?? '', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="submitter-name">{{ $trainer->academic_degree ?? $trainer->nama }}</div>
                                    <div class="submitter-sub">{{ $trainer->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:12px;color:var(--text-muted);">{{ $trainer->nik ?? '-' }}</td>
                        <td>
                            @php
                                $prevStatus = $trainer->status ?? 'pending';
                                $statusLabel = ['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'][$prevStatus] ?? $prevStatus;
                                $statusClass = ['pending' => 'badge-pending', 'approved' => 'badge-approved', 'rejected' => 'badge-rejected'][$prevStatus] ?? 'badge-inactive';
                            @endphp
                            <span class="badge {{ $statusClass }}">
                                <span class="badge-dot"></span>{{ $statusLabel }}
                            </span>
                        </td>
                        <td style="font-size:12px;color:#ef4444;">
                            {{ $trainer->deleted_at?->format('d M Y, H:i') }}
                        </td>
                        <td>
                            <div class="action-group">
                                <button type="button" class="btn btn-approve btn-sm"
                                    onclick="confirmRestoreTrainer({{ $trainer->id }}, '{{ addslashes($trainer->academic_degree ?? $trainer->nama) }}')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Pulihkan
                                </button>
                                <button type="button" class="btn btn-ghost btn-sm" style="color:#dc2626;"
                                    onclick="confirmForceDeleteTrainer({{ $trainer->id }}, '{{ addslashes($trainer->academic_degree ?? $trainer->nama) }}')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Permanen
                                </button>
                            </div>
                            {{-- Form tersembunyi --}}
                            <form id="restore-trainer-form-{{ $trainer->id }}" method="POST"
                                  action="{{ route('admin.trainer.restore', $trainer->id) }}" style="display:none;">
                                @csrf
                            </form>
                            <form id="force-delete-trainer-form-{{ $trainer->id }}" method="POST"
                                  action="{{ route('admin.trainer.force-delete', $trainer->id) }}" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- ======================== MODAL DETAIL ======================== --}}
<div class="modal-overlay" id="modal-detail">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Detail Pendaftaran Trainer</div>
            <button class="modal-close" onclick="closeModal('modal-detail')">✕</button>
        </div>

        <div class="img-preview" id="detail-avatar-wrap"
             style="display:flex;align-items:center;justify-content:center;
                    overflow:hidden;border-radius:8px;
                    width:100%;height:auto;min-height:120px;max-height:280px;">
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
                <div class="detail-label">NIK</div>
                <div class="detail-value" id="d-nik">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Email</div>
                <div class="detail-value" id="d-email" style="font-weight:400;font-size:13px;">-</div>
            </div>
            <div class="detail-item full">
                <div class="detail-label">Pengalaman</div>
                <div class="detail-value" id="d-experience" style="font-weight:400;line-height:1.6;font-size:13px;color:var(--text-muted);">-</div>
            </div>
            <div class="detail-item full" id="d-reject-wrap" style="display:none;">
                <div class="detail-label" style="color:var(--accent2);">Alasan Penolakan</div>
                <div class="detail-value" id="d-reject" style="font-weight:400;font-size:13px;color:var(--accent2);">-</div>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:4px;">
            <a id="d-ktp-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Scan KTP
            </a>
            <a id="d-bnsp-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                Lihat Sertifikat BNSP
            </a>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px;">
            <a id="d-transfer-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                Lihat Bukti Transfer
            </a>
            <a id="d-foto-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Lihat Pas Foto
            </a>
        </div>

        <div id="d-drive-wrap" style="margin-top:8px;display:none;">
            <a id="d-drive-link" href="#" target="_blank" class="btn btn-ghost btn-sm" style="width:100%;justify-content:center;">
                &#x2197; Buka Drive Dokumentasi
            </a>
        </div>
    </div>
</div>

{{-- ======================== MODAL TOLAK ======================== --}}
<div class="modal-overlay" id="modal-reject">
    <div class="modal" style="max-width:460px;">
        <div class="modal-header">
            <div class="modal-title">Tolak Pendaftaran Trainer</div>
            <button class="modal-close" onclick="closeModal('modal-reject')">✕</button>
        </div>
        <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:18px;line-height:1.6;">
            Berikan alasan penolakan untuk <strong id="reject-name"></strong>. Alasan ini akan tersimpan sebagai catatan.
        </p>
        <form id="reject-form" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Alasan Penolakan *</label>
                <textarea name="rejection_reason" class="form-textarea" rows="4"
                    placeholder="Contoh: Dokumen KTP tidak jelas, sertifikat BNSP tidak valid..."
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

{{-- ======================== DATA + SCRIPT ======================== --}}
<script>
const trainerData = @json(
    $pending->concat($approved)->concat($rejected)
        ->map(function ($t) {
            $arr = $t->toArray();
            $arr['profile_photo_url'] = $t->user?->profile_photo_path
                ? asset('storage/' . $t->user->profile_photo_path)
                : null;
            return $arr;
        })
        ->keyBy('id')
);

// ── Relative time ──
function formatRelativeTime(isoString) {
    const now  = new Date();
    const past = new Date(isoString);
    const diff = Math.floor((now - past) / 1000);
    if (diff < 60)         return 'Baru saja';
    if (diff < 3600)     { const m  = Math.floor(diff / 60);      return m  + ' menit yang lalu'; }
    if (diff < 86400)    { const h  = Math.floor(diff / 3600);    return h  + ' jam yang lalu'; }
    if (diff < 2592000)  { const d  = Math.floor(diff / 86400);   return d  + ' hari yang lalu'; }
    if (diff < 31536000) { const mo = Math.floor(diff / 2592000); return mo + ' bulan yang lalu'; }
    return Math.floor(diff / 31536000) + ' tahun yang lalu';
}
function updateAllRelativeTimes() {
    document.querySelectorAll('.relative-time[data-time]').forEach(function(el) {
        el.textContent = formatRelativeTime(el.dataset.time);
    });
}
updateAllRelativeTimes();
setInterval(updateAllRelativeTimes, 30000);

// ── SweetAlert mixins ──
const swalApprove = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-approve', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalReject = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-reject', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalDelete = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-reject', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});
const swalRestore = Swal.mixin({
    customClass: { confirmButton: 'swal-btn-confirm-approve', cancelButton: 'swal-btn-cancel' },
    buttonsStyling: false,
});

// ── Tab switching ──
function switchTab(tab, btn) {
    ['pending', 'approved', 'rejected', 'deleted'].forEach(function(t) {
        document.getElementById('tab-' + t).style.display = t === tab ? 'block' : 'none';
    });
    btn.closest('.tab-bar').querySelectorAll('.tab-btn').forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');
}

// ── Approve ──
function confirmApprove(id, name) {
    swalApprove.fire({
        title: 'Setujui Trainer?',
        html:  '<span style="font-size:14px;color:#6b7280;">Anda akan menyetujui <strong>' + name + '</strong> sebagai Trainer resmi.</span>',
        icon:  'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '✓ Ya, Setujui',
        cancelButtonText:  'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('form-approve-' + id).submit();
    });
}

// ── Reject ──
function confirmReject(id, name) {
    swalReject.fire({
        title: 'Tolak Pendaftaran?',
        html:  '<span style="font-size:14px;color:#6b7280;">Anda akan menolak pendaftaran <strong>' + name + '</strong>. Lanjutkan untuk mengisi alasan penolakan.</span>',
        icon:  'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '→ Lanjut Isi Alasan',
        cancelButtonText:  'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) openRejectModal(id, name);
    });
}

// ── Soft delete (pindah ke tab Dihapus) ──
function confirmDestroyTrainer(id, name, type) {
    const isApproved = type === 'approved';
    swalDelete.fire({
        title: '🗑️ Hapus Trainer?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Data <strong>${name}</strong> akan dipindahkan ke tab <strong>Dihapus</strong> dan masih bisa dipulihkan kembali.<br>
                ${isApproved ? '<span style="color:#ef4444;font-size:13px;margin-top:6px;display:block;">⚠️ Akses trainer akan dicabut sementara.</span>' : ''}
               </span>`,
        icon: 'warning', iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonText: '🗑️ Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('form-destroy-trainer-' + id).submit();
    });
}

// ── Restore ──
function confirmRestoreTrainer(id, name) {
    swalRestore.fire({
        title: '♻️ Pulihkan Trainer?',
        html: `<span style="font-size:14px;color:#6b7280;line-height:1.6;">
                Data <strong>${name}</strong> akan dipulihkan dan dikembalikan ke status <strong>Menunggu</strong> untuk ditinjau ulang.
               </span>`,
        icon: 'question', iconColor: '#10b981',
        showCancelButton: true,
        confirmButtonText: '♻️ Ya, Pulihkan',
        cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('restore-trainer-form-' + id).submit();
    });
}

// ── Force delete ──
function confirmForceDeleteTrainer(id, name) {
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
    }).then(function(result) {
        if (result.isConfirmed) document.getElementById('force-delete-trainer-form-' + id).submit();
    });
}

// ── Detail modal ──
function openDetailModal(id) {
    const d = trainerData[id];
    if (!d) return;

    const avatarWrap = document.getElementById('detail-avatar-wrap');
    if (d.profile_photo_url) {
        avatarWrap.style.background = 'transparent';
        avatarWrap.style.padding    = '0';
        avatarWrap.innerHTML = '';
        const img = document.createElement('img');
        img.src       = d.profile_photo_url;
        img.className = 'detail-avatar-photo';
        img.onerror   = function() {
            avatarWrap.style.background = '#f3f4f6';
            avatarWrap.innerHTML = '';
        };
        avatarWrap.appendChild(img);
    } else {
        avatarWrap.style.background = '#f3f4f6';
        avatarWrap.style.padding    = '';
        avatarWrap.innerHTML = '';
    }

    document.getElementById('d-nama').textContent       = d.academic_degree ?? d.nama;
    document.getElementById('d-nik').textContent        = d.nik ?? '-';
    document.getElementById('d-email').textContent      = d.email ?? '-';
    document.getElementById('d-experience').textContent = d.experience ?? '-';

    const statusMap = {
        pending:  '<span class="badge badge-pending"><span class="badge-dot" style="background:#EF9F27;"></span>Menunggu</span>',
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

    function storagePath(raw) {
        return raw ? '/storage/' + raw.replace('public/', '') : null;
    }

    const ktpLink = document.getElementById('d-ktp-link');
    const ktpPath = storagePath(d.ktp_scan);
    ktpLink.href = ktpPath ?? '#';
    ktpLink.style.opacity       = ktpPath ? '1' : '0.4';
    ktpLink.style.pointerEvents = ktpPath ? 'auto' : 'none';

    const bnspLink = document.getElementById('d-bnsp-link');
    const bnspPath = storagePath(d.bnsp_certificate);
    bnspLink.href = bnspPath ?? '#';
    bnspLink.style.opacity       = bnspPath ? '1' : '0.4';
    bnspLink.style.pointerEvents = bnspPath ? 'auto' : 'none';

    const transferLink = document.getElementById('d-transfer-link');
    const transferPath = storagePath(d.bukti_transfer);
    transferLink.href = transferPath ?? '#';
    transferLink.style.opacity       = transferPath ? '1' : '0.4';
    transferLink.style.pointerEvents = transferPath ? 'auto' : 'none';

    const fotoLink = document.getElementById('d-foto-link');
    const fotoPath = storagePath(d.white_bg_photo);
    fotoLink.href = fotoPath ?? '#';
    fotoLink.style.opacity       = fotoPath ? '1' : '0.4';
    fotoLink.style.pointerEvents = fotoPath ? 'auto' : 'none';

    const driveWrap = document.getElementById('d-drive-wrap');
    const driveLink = document.getElementById('d-drive-link');
    if (d.drive_link_documentation) {
        driveWrap.style.display = 'block';
        driveLink.href = d.drive_link_documentation;
    } else {
        driveWrap.style.display = 'none';
    }

    openModal('modal-detail');
}

function openRejectModal(id, name) {
    document.getElementById('reject-name').textContent = name;
    document.getElementById('reject-form').action = '/admin/approval/trainer/' + id + '/reject';
    openModal('modal-reject');
}

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(function(el) {
    el.addEventListener('click', function(e) {
        if (e.target === el) closeModal(el.id);
    });
});
</script>

@endsection