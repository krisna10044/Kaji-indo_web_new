<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} — Admin KAJI Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f8f4ef;
            --surface: #ffffff;
            --surface2: #f2ede7;
            --border: #e8e0d6;
            --accent: #2d6a4f;
            --accent-dark: #1f4e37;
            --accent-light: #e8f5e9;
            --accent2: #e76f51;
            --accent3: #457b9d;
            --warning: #f59e0b;
            --text: #1a1a2e;
            --text-muted: #7a7065;
            --radius: 16px;
            --shadow: 0 2px 16px rgba(45,106,79,.07);
            --shadow-md: 0 4px 24px rgba(45,106,79,.10);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 265px;
            min-height: 100vh;
            background: var(--accent);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: rgba(255,255,255,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid rgba(255,255,255,.25);
            overflow: hidden;
            flex-shrink: 0;
        }

        .brand-logo img { width: 100%; height: 100%; object-fit: contain; padding: 5px; filter: brightness(0) invert(1); }
        .brand-logo svg { color: #fff; }

        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 19px;
            color: #fff;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand-role {
            font-size: 10px;
            color: rgba(255,255,255,.55);
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .nav-section {
            padding: 18px 14px 6px;
        }

        .nav-label {
            font-size: 10px;
            color: rgba(255,255,255,.38);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 6px;
            padding-left: 10px;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 11px;
            cursor: pointer;
            color: rgba(255,255,255,.68);
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 2px;
            transition: all .2s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: rgba(255,255,255,.1);
            color: #fff;
        }

        .nav-item.active {
            background: rgba(255,255,255,.18);
            color: #fff;
            font-weight: 600;
        }

        .nav-item svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--accent2);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            animation: badgePulse 2s infinite;
        }

        .nav-badge.muted {
            background: rgba(255,255,255,.22);
            color: rgba(255,255,255,.9);
            animation: none;
        }

        @keyframes badgePulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .65; }
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px;
            border-top: 1px solid rgba(255,255,255,.1);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 11px;
            cursor: pointer;
            transition: background .2s;
        }

        .user-card:hover { background: rgba(255,255,255,.1); }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
            border: 2px solid rgba(255,255,255,.25);
            overflow: hidden;
        }

        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-role-label { font-size: 11px; color: rgba(255,255,255,.5); }

        .logout-link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 12px;
    border-radius: 9px;
    color: rgba(255,255,255,.85); /* ← lebih terang */
    font-size: 13px;
    font-weight: 600; /* ← lebih tebal */
    margin-top: 6px;
    cursor: pointer;
    transition: all .2s;
    text-decoration: none;
    background: rgba(255,255,255,.08); /* ← sedikit background */
    border: 1px solid rgba(255,255,255,.15); /* ← border tipis */
    width: 100%;
    text-align: left;
}

.logout-link:hover { 
    background: rgba(231,111,81,.25); 
    color: #fca89a;
    border-color: rgba(231,111,81,.4);
}

.logout-link svg { width: 15px; height: 15px; }
        /* ===================== MAIN ===================== */
        .main-wrap {
            margin-left: 265px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: var(--shadow);
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .topbar-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
        }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .date-chip {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 6px 13px;
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .date-chip svg { width: 13px; height: 13px; }

        .main-content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ===================== BUTTONS ===================== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 17px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all .2s;
            font-family: inherit;
            text-decoration: none;
        }

        .btn svg { width: 15px; height: 15px; flex-shrink: 0; }

        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(45,106,79,.25); }

        .btn-ghost { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--border); }

        .btn-approve { background: var(--accent-light); color: var(--accent); border: 1.5px solid rgba(167,215,197,.6); }
        .btn-approve:hover { background: var(--accent); color: #fff; }

        .btn-reject { background: #fff0ed; color: var(--accent2); border: 1.5px solid rgba(231,111,81,.4); }
        .btn-reject:hover { background: var(--accent2); color: #fff; }

        .btn-sm { padding: 5px 11px; font-size: 12px; border-radius: 8px; }
        .btn-sm svg { width: 13px; height: 13px; }

        .btn-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 9px;
            justify-content: center;
        }

        /* ===================== STATS GRID ===================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 26px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }

        .stat-card.green::before  { background: linear-gradient(90deg, var(--accent), #52b788); }
        .stat-card.orange::before { background: linear-gradient(90deg, var(--accent2), #f4a261); }
        .stat-card.yellow::before { background: linear-gradient(90deg, var(--warning), #fcd34d); }
        .stat-card.blue::before   { background: linear-gradient(90deg, var(--accent3), #60a5fa); }
        .stat-card.teal::before   { background: linear-gradient(90deg, #0d9488, #34d399); }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 12px;
        }

        .stat-card.green .stat-icon  { background: var(--accent-light); }
        .stat-card.orange .stat-icon { background: #fff0ed; }
        .stat-card.yellow .stat-icon { background: #fffbea; }
        .stat-card.blue .stat-icon   { background: #e3f0fa; }
        .stat-card.teal .stat-icon   { background: #e6faf8; }

        .stat-num {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 3px;
            color: var(--text);
            line-height: 1;
        }

        .stat-label {
            font-size: 10.5px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .stat-trend {
            font-size: 11px;
            margin-top: 6px;
            font-weight: 500;
        }

        /* ===================== TABLE ===================== */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 22px;
            box-shadow: var(--shadow);
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--surface2);
        }

        .table-card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-card-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 400;
            margin-left: 4px;
        }

        table { width: 100%; border-collapse: collapse; }

        thead th {
            padding: 11px 18px;
            text-align: left;
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            background: var(--surface2);
            border-bottom: 1px solid var(--border);
            font-weight: 700;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #faf8f5; }
        tbody td { padding: 13px 18px; font-size: 13px; }

        /* ===================== BADGES ===================== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }

        .badge-pending  { background: #fffbea; color: var(--warning); border: 1px solid rgba(245,158,11,.3); }
        .badge-approved { background: var(--accent-light); color: var(--accent); border: 1px solid rgba(167,215,197,.5); }
        .badge-rejected { background: #fff0ed; color: var(--accent2); border: 1px solid rgba(231,111,81,.3); }
        .badge-active   { background: var(--accent-light); color: var(--accent); border: 1px solid rgba(167,215,197,.5); }
        .badge-inactive { background: #f3f4f6; color: #6b7280; border: 1px solid #e5e7eb; }

        /* ===================== SUBMITTER CELL ===================== */
        .submitter { display: flex; align-items: center; gap: 9px; }

        .submitter-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .submitter-name { font-weight: 600; font-size: 13px; }
        .submitter-sub  { font-size: 11px; color: var(--text-muted); }

        /* ===================== PREVIEW CELL ===================== */
        .preview-cell { display: flex; align-items: center; gap: 10px; }

        .preview-thumb {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--surface2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .preview-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .preview-name { font-weight: 600; font-size: 13px; }
        .preview-meta { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .action-group { display: flex; gap: 5px; align-items: center; }

        /* ===================== ROLE TAGS ===================== */
        .role-tag {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .role-admin     { background: var(--accent-light); color: var(--accent); }
        .role-pembimbing { background: #fffbea; color: #b45309; }
        .role-umkm      { background: #e3f0fa; color: var(--accent3); }
        .role-user      { background: #f3f4f6; color: #6b7280; }

        /* ===================== TABS ===================== */
        .tab-bar {
            display: flex;
            gap: 3px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 18px;
            width: fit-content;
            box-shadow: var(--shadow);
        }

        .tab-btn {
            padding: 7px 18px;
            border-radius: 9px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            color: var(--text-muted);
            border: none;
            background: transparent;
            font-family: inherit;
        }

        .tab-btn.active { background: var(--accent); color: #fff; }
        .tab-btn:hover:not(.active) { color: var(--text); background: var(--surface2); }

        .count-pill {
            display: inline-block;
            background: var(--accent2);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 10px;
            margin-left: 5px;
            vertical-align: middle;
        }

        /* ===================== SECTION HEADER ===================== */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .section-title small {
            font-weight: 400;
            color: var(--text-muted);
            font-size: 12px;
            margin-left: 6px;
        }

        /* ===================== MODAL ===================== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15,15,25,.5);
            backdrop-filter: blur(5px);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open { display: flex; }

        .modal {
            background: var(--surface);
            border-radius: 20px;
            width: 580px;
            max-width: 95vw;
            max-height: 88vh;
            overflow-y: auto;
            padding: 28px;
            box-shadow: 0 24px 80px rgba(0,0,0,.18);
            animation: popIn .25s ease;
            border: 1px solid var(--border);
        }

        @keyframes popIn {
            from { transform: scale(.94) translateY(8px); opacity: 0; }
            to   { transform: scale(1) translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .modal-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 700;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            transition: all .2s;
        }

        .modal-close:hover { background: #fee2e2; border-color: var(--accent2); color: var(--accent2); }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 18px;
        }

        .detail-item {
            background: var(--surface2);
            border-radius: 10px;
            padding: 12px 14px;
            border: 1px solid var(--border);
        }

        .detail-item.full { grid-column: 1/-1; }

        .detail-label {
            font-size: 10px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .detail-value { font-size: 14px; font-weight: 600; }

        .img-preview {
            width: 100%;
            height: 160px;
            background: var(--surface2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin-bottom: 18px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .img-preview img { width: 100%; height: 100%; object-fit: cover; }

        .form-group { margin-bottom: 14px; }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 9px 12px;
            background: var(--surface2);
            border: 1.5px solid var(--border);
            border-radius: 9px;
            color: var(--text);
            font-family: inherit;
            font-size: 13px;
            transition: border-color .2s;
        }

        .form-textarea { min-height: 80px; resize: vertical; }
        .form-input:focus, .form-textarea:focus, .form-select:focus { outline: none; border-color: var(--accent); }

        .confirm-modal { width: 400px; text-align: center; }
        .confirm-icon { font-size: 48px; margin-bottom: 12px; }
        .confirm-title { font-size: 17px; font-weight: 700; margin-bottom: 7px; }
        .confirm-desc { font-size: 13.5px; color: var(--text-muted); margin-bottom: 20px; line-height: 1.65; }
        .confirm-btns { display: flex; gap: 10px; justify-content: center; }

        /* ===================== EMPTY STATE ===================== */
        .empty-state {
            text-align: center;
            padding: 52px 20px;
            color: var(--text-muted);
        }

        .empty-state-icon { font-size: 40px; margin-bottom: 12px; opacity: .6; }
        .empty-state-text { font-size: 14px; }

        /* ===================== TOAST ===================== */
        #toast {
            position: fixed;
            bottom: 26px;
            right: 26px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 13px 18px;
            font-size: 13px;
            font-weight: 600;
            z-index: 999;
            transform: translateY(70px);
            opacity: 0;
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
            pointer-events: none;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 9px;
        }

        /* ===================== SCROLLBAR ===================== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .main-content { padding: 18px 16px; }
        }

        /* Hamburger Button */
        .hamburger-btn {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            width: 38px;
            height: 38px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            padding: 8px;
            flex-shrink: 0;
        }

        .hamburger-btn span {
            display: block;
            width: 100%;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Overlay gelap saat sidebar terbuka */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar-overlay.active { display: block; }

        @media (max-width: 768px) {
            .hamburger-btn { display: flex; }

            .topbar {
                padding: 12px 16px !important;
            }

            .topbar-title {
                font-size: 17px !important;
            }

            /* Sembunyikan date chip di mobile, terlalu panjang */
            .date-chip {
                display: none !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<!-- OVERLAY MOBILE -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>
<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-box">
            <div class="brand-logo">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">KAJI Indonesia</div>
                <div class="brand-role">Admin Panel</div>
            </div>
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-label">Manajemen</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Overview
        </a>

        <a href="{{ route('admin.approval.program') }}"
           class="nav-item {{ request()->routeIs('admin.approval.program') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Approval Program
            @if(($stats['pending_program'] ?? 0) > 0)
                <span class="nav-badge">{{ $stats['pending_program'] }}</span>
            @endif
        </a>

        <a href="{{ route('admin.approval.produk') }}"
           class="nav-item {{ request()->routeIs('admin.approval.produk') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
            </svg>
            Approval UMKM
            @if(($stats['pending_produk'] ?? 0) > 0)
                <span class="nav-badge">{{ $stats['pending_produk'] }}</span>
            @endif
        </a>

        <a href="{{ route('admin.approval.event') }}"
           class="nav-item {{ request()->routeIs('admin.approval.event') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Approval Event
            @if(($stats['pending_event'] ?? 0) > 0)
                <span class="nav-badge">{{ $stats['pending_event'] }}</span>
            @endif
        </a>

        <a href="{{ route('admin.approval.trainer') }}"
            class="nav-item {{ request()->routeIs('admin.approval.trainer') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Approval Trainer
            @if(($stats['pending_trainer'] ?? 0) > 0)
                <span class="nav-badge">{{ $stats['pending_trainer'] }}</span>
            @endif
        </a>

        <a href="{{ route('admin.approval.mentor') }}"
        class="nav-item {{ request()->routeIs('admin.approval.mentor*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Approval Mentor
            @if(($stats['pending_mentor'] ?? 0) > 0)
                <span class="nav-badge">{{ $stats['pending_mentor'] }}</span>
            @endif
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-label">Data</div>

        <a href="{{ route('admin.pengguna') }}"
           class="nav-item {{ request()->routeIs('admin.pengguna*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            Pengguna
            @if(($stats['total_users'] ?? 0) > 0)
                <span class="nav-badge muted">{{ $stats['total_users'] }}</span>
            @endif
        </a>


    </div>
    <div class="nav-section">
        <div class="nav-label">Edit</div>

        <a href="{{ route('admin.dokumentasi.index') }}"
           class="nav-item {{ request()->routeIs('admin.dokumentasi*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Dokumentasi
        </a>

    </div>
    </div>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                @auth
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="avatar">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    @endif
                @endauth
            </div>
            <div style="flex:1;min-width:0;">
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-role-label">Super Administrator</div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-link" style="border:none;width:100%;text-align:left;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN WRAP -->
<div class="main-wrap">
    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" id="hamburger-btn" onclick="toggleSidebar()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
        </div>
        <div class="topbar-right">
            <div class="date-chip">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                {{ now()->locale('id')->isoFormat('dddd, D MMM YYYY') }}
            </div>
            <a href="{{ route('home') }}" class="btn btn-ghost btn-sm" target="_blank">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Website
            </a>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="main-content">
        @if(session('success'))
            <div style="background:var(--accent-light);border:1px solid rgba(45,106,79,.25);border-radius:10px;padding:12px 16px;margin-bottom:18px;font-size:13px;color:var(--accent);font-weight:600;display:flex;align-items:center;gap:8px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fff0ed;border:1px solid rgba(231,111,81,.25);border-radius:10px;padding:12px 16px;margin-bottom:18px;font-size:13px;color:var(--accent2);font-weight:600;display:flex;align-items:center;gap:8px;">
                ❌ {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

<!-- TOAST -->
<div id="toast"></div>
    <script>
        function showToast(msg, type = 'success') {
            const t = document.getElementById('toast');
            const colors = { success: 'var(--accent)', error: 'var(--accent2)', info: 'var(--accent3)' };
            const icons  = { success: '✅', error: '❌', info: 'ℹ️' };
            t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
            t.style.color = colors[type];
            t.style.transform = 'translateY(0)';
            t.style.opacity   = '1';
            setTimeout(() => { t.style.transform = 'translateY(70px)'; t.style.opacity = '0'; }, 3200);
        }

        function openModal(id)  { document.getElementById(id).classList.add('open'); }
        function closeModal(id) { document.getElementById(id).classList.remove('open'); }

        // Close modal on overlay click
        document.querySelectorAll('.modal-overlay').forEach(m => {
            m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
        });

        // Tab switching
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.tab-bar').querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        // Tutup sidebar saat klik overlay
        document.getElementById('sidebar-overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
            this.classList.remove('active');
        });

        // Tutup sidebar otomatis saat klik menu (pindah halaman)
        document.querySelectorAll('.sidebar .nav-item').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebar-overlay').classList.remove('active');
            });
        });
    </script>

    @stack('scripts')
    </body>
    
@stack('scripts')
</body>
</html>