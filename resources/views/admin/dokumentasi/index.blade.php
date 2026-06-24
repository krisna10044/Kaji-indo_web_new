@extends('layouts.admin')

@section('page-title', 'Dokumentasi')

@push('styles')
<style>
    .dok-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .dok-toolbar-left {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* Filter pills */
    .filter-pill {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        border: 1.5px solid var(--border);
        background: var(--surface);
        color: var(--text-muted);
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
    }

    .filter-pill:hover { border-color: var(--accent); color: var(--accent); }
    .filter-pill.active { background: var(--accent); border-color: var(--accent); color: #fff; }

    /* Grid kartu */
    .dok-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .dok-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform .2s, box-shadow .2s;
        display: flex;
        flex-direction: column;
    }

    .dok-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }

    .dok-thumb {
        width: 100%;
        aspect-ratio: 16/9;
        background: var(--surface2);
        position: relative;
        overflow: hidden;
    }

    .dok-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
    }

    .dok-thumb-placeholder {
        width: 100%; height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        background: linear-gradient(135deg, var(--surface2), var(--border));
    }

    .dok-type-badge {
        position: absolute;
        top: 8px; left: 8px;
        background: rgba(0,0,0,.55);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
        backdrop-filter: blur(4px);
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .dok-status-badge {
        position: absolute;
        top: 8px; right: 8px;
    }

    .dok-body {
        padding: 14px 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .dok-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .dok-meta {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .dok-desc {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
    }

    .dok-actions {
        display: flex;
        gap: 6px;
        padding: 10px 16px 14px;
        border-top: 1px solid var(--border);
        background: var(--surface2);
    }

    /* Stats mini */
    .dok-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }

    .dok-stat {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px 16px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dok-stat-icon {
        font-size: 22px;
        width: 40px; height: 40px;
        border-radius: 10px;
        background: var(--surface2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dok-stat-num { font-size: 20px; font-weight: 800; color: var(--text); line-height: 1; }
    .dok-stat-label { font-size: 11px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: .5px; margin-top: 2px; }

    /* Pagination */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 8px;
    }

    .pagination-wrap .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px; height: 34px;
        border-radius: 9px;
        border: 1.5px solid var(--border);
        background: var(--surface);
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
    }

    .pagination-wrap .page-link:hover { border-color: var(--accent); color: var(--accent); }
    .pagination-wrap .page-link.active { background: var(--accent); border-color: var(--accent); color: #fff; }
    .pagination-wrap .page-link.disabled { opacity: .4; pointer-events: none; }

    @media (max-width: 768px) {
        .dok-toolbar { flex-direction: column; align-items: flex-start; }
        .dok-toolbar .btn { width: 100%; justify-content: center; }
        .dok-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
        .dok-stats { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .dok-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- STATS --}}
<div class="dok-stats">
    <div class="dok-stat">
        <div class="dok-stat-icon">📁</div>
        <div>
            <div class="dok-stat-num">{{ $totalAll }}</div>
            <div class="dok-stat-label">Total Dokumentasi</div>
        </div>
    </div>
    <div class="dok-stat">
        <div class="dok-stat-icon">🖼️</div>
        <div>
            <div class="dok-stat-num">{{ $totalFoto }}</div>
            <div class="dok-stat-label">Album Foto</div>
        </div>
    </div>
    <div class="dok-stat">
        <div class="dok-stat-icon">🎬</div>
        <div>
            <div class="dok-stat-num">{{ $totalVideo }}</div>
            <div class="dok-stat-label">Video</div>
        </div>
    </div>
</div>

{{-- TOOLBAR --}}
<div class="dok-toolbar">
    <div class="dok-toolbar-left">
        <a href="{{ route('admin.dokumentasi.index') }}"
           class="filter-pill {{ !request('kategori') ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('admin.dokumentasi.index', ['kategori' => 'foto']) }}"
           class="filter-pill {{ request('kategori') === 'foto' ? 'active' : '' }}">
            🖼️ Foto
        </a>
        <a href="{{ route('admin.dokumentasi.index', ['kategori' => 'video']) }}"
           class="filter-pill {{ request('kategori') === 'video' ? 'active' : '' }}">
            🎬 Video
        </a>
    </div>
    <a href="{{ route('admin.dokumentasi.create') }}" class="btn btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Dokumentasi
    </a>
</div>

{{-- GRID --}}
@if($items->isEmpty())
    <div class="table-card">
        <div class="empty-state">
            <div class="empty-state-icon">📂</div>
            <div class="empty-state-text">Belum ada dokumentasi</div>
            <a href="{{ route('admin.dokumentasi.create') }}" class="btn btn-primary" style="margin-top:16px;">
                + Tambah Pertama
            </a>
        </div>
    </div>
@else
    <div class="dok-grid">
        @foreach($items as $dok)
        <div class="dok-card">
            {{-- Thumbnail --}}
            <div class="dok-thumb">
            @if($dok->thumbnail)
    <img src="{{ asset('storage/' . $dok->thumbnail) }}" alt="{{ $dok->judul }}">
@elseif($dok->cover_video)
    <img src="{{ asset('storage/' . $dok->cover_video) }}" alt="{{ $dok->judul }}">
@elseif($dok->kategori === 'video' && $dok->youtube_url)
                    @php
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $dok->youtube_url, $m);
                        $ytId = $m[1] ?? null;
                    @endphp
                    @if($ytId)
                        <img src="https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg" alt="{{ $dok->judul }}">
                    @else
                        <div class="dok-thumb-placeholder">🎬</div>
                    @endif
                @else
                    <div class="dok-thumb-placeholder">
                        {{ $dok->kategori === 'foto' ? '🖼️' : '🎬' }}
                    </div>
                @endif

                <span class="dok-type-badge">
                    {{ $dok->kategori === 'foto' ? '🖼️ Foto' : '🎬 Video' }}
                </span>

                <span class="dok-status-badge">
                    @if($dok->is_published)
                        <span class="badge badge-approved"><span class="badge-dot"></span>Publik</span>
                    @else
                        <span class="badge badge-inactive"><span class="badge-dot"></span>Draft</span>
                    @endif
                </span>
            </div>

            {{-- Body --}}
            <div class="dok-body">
                <div class="dok-title">{{ $dok->judul }}</div>
                <div class="dok-meta">
                    📅 {{ \Carbon\Carbon::parse($dok->tanggal_kegiatan)->locale('id')->isoFormat('D MMM YYYY') }}
                    @if($dok->kategori === 'foto' && $dok->foto)
                        · 📷 {{ count($dok->foto) }} foto
                    @endif
                </div>
                @if($dok->deskripsi)
                    <div class="dok-desc">{{ $dok->deskripsi }}</div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="dok-actions">
                <a href="{{ route('admin.dokumentasi.edit', $dok) }}" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.dokumentasi.destroy', $dok) }}" method="POST"
                      onsubmit="return confirm('Hapus dokumentasi ini? Tindakan tidak bisa dibatalkan.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-reject btn-sm">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    @if($items->hasPages())
    <div class="pagination-wrap">
        {{-- Prev --}}
        <a href="{{ $items->previousPageUrl() ?? '#' }}"
           class="page-link {{ $items->onFirstPage() ? 'disabled' : '' }}">‹</a>

        @for($p = 1; $p <= $items->lastPage(); $p++)
            <a href="{{ $items->url($p) }}"
               class="page-link {{ $items->currentPage() === $p ? 'active' : '' }}">{{ $p }}</a>
        @endfor

        {{-- Next --}}
        <a href="{{ $items->nextPageUrl() ?? '#' }}"
           class="page-link {{ !$items->hasMorePages() ? 'disabled' : '' }}">›</a>
    </div>
    @endif
@endif

@endsection