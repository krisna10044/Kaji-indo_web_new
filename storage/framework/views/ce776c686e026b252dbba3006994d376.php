    
    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Dashboard Trainer – KAJI Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
    <style>

    .materi-type-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 14px 8px;
        border: 2px solid var(--border);
        border-radius: 12px;
        background: var(--surface2);
        color: var(--text-muted);
        transition: all .2s;
        text-align: center;
        user-select: none;
    }
    .materi-type-card:hover {
        border-color: var(--accent3);
        background: #e3f0fa;
    }
    .materi-type-card.active {
        border-color: var(--accent);
        background: var(--accent-light);
        color: var(--accent);
    }

    .form-input:invalid:not(:placeholder-shown),
    .form-textarea:invalid:not(:placeholder-shown),
    .form-select:invalid {
        border-color: var(--accent2);
        background: #fff8f7;
    }
    .form-input:valid:not(:placeholder-shown),
    .form-textarea:valid:not(:placeholder-shown) {
        border-color: #a7d7c5;
    }
    :root {
        --bg: #f8f4ef;
        --surface: #ffffff;
        --surface2: #f2ede7;
        --border: #e8e0d6;
        --accent: #2d6a4f;
        --accent-light: #e8f5e9;
        --accent2: #e76f51;
        --accent3: #457b9d;
        --warning: #f59e0b;
        --text: #1a1a2e;
        --text-muted: #7a7065;
        --radius: 16px;
        --shadow: 0 2px 16px rgba(45,106,79,.07);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

    /* ============ SIDEBAR ============ */
    .sidebar { width: 265px; min-height: 100vh; background: var(--accent); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; z-index: 100; }
    .sidebar-brand { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,.12); }
    .brand-box { display: flex; align-items: center; gap: 12px; }
    .brand-icon { width: 42px; height: 42px; background: rgba(255,255,255,.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; }
    .brand-icon svg { color: #fff; }
    .brand-name { font-family: 'Cormorant Garamond', serif; font-size: 20px; color: #fff; font-weight: 700; }
    .brand-role { font-size: 11px; color: rgba(255,255,255,.6); letter-spacing: 1.5px; text-transform: uppercase; }
    .nav-section { padding: 20px 16px 8px; }
    .nav-label { font-size: 10px; color: rgba(255,255,255,.4); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; padding-left: 10px; }
    .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 12px; cursor: pointer; color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500; margin-bottom: 3px; transition: all .2s; text-decoration: none; }
    .nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
    .nav-item.active { background: rgba(255,255,255,.18); color: #fff; font-weight: 600; }
    .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
    .nav-badge { margin-left: auto; background: var(--accent2); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 20px; }
    .sidebar-user { margin-top: auto; padding: 16px; border-top: 1px solid rgba(255,255,255,.12); }
    .user-card { display: flex; align-items: center; gap: 12px; padding: 10px; border-radius: 12px; cursor: pointer; transition: background .2s; }
    .user-card:hover { background: rgba(255,255,255,.1); }
    .user-avatar { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: #fff; flex-shrink: 0; border: 2px solid rgba(255,255,255,.3); overflow: hidden; }
    .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .user-name { font-size: 13px; font-weight: 600; color: #fff; }
    .user-role { font-size: 11px; color: rgba(255,255,255,.55); }

    /* ============ MAIN ============ */
    .main { margin-left: 265px; flex: 1; }
    .topbar { background: var(--surface); border-bottom: 1px solid var(--border); padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; box-shadow: var(--shadow); }
    .topbar-title { font-family: 'Cormorant Garamond', serif; font-size: 24px; font-weight: 700; color: var(--text); }

    .btn { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all .2s; font-family: inherit; text-decoration: none; }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: #1f4e37; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(45,106,79,.3); }
    .btn-secondary { background: var(--accent3); color: #fff; }
    .btn-secondary:hover { background: #2e5a7a; transform: translateY(-1px); }
    .btn-ghost { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
    .btn-ghost:hover { background: var(--border); }
    .btn-danger { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }
    .btn-danger:hover { background: var(--accent2); color: #fff; }
    .btn-sm { padding: 6px 14px; font-size: 12px; border-radius: 8px; }
    .btn-outline { background: transparent; border: 1.5px solid var(--accent); color: var(--accent); }
    .btn-outline:hover { background: var(--accent); color: #fff; }

    .content { padding: 32px; }

    /* ============ STATS ============ */
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px; }
    .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 22px; box-shadow: var(--shadow); position: relative; overflow: hidden; }
    .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
    .stat-card.green::before { background: linear-gradient(90deg, var(--accent), #52b788); }
    .stat-card.teal::before { background: linear-gradient(90deg, #0d9488, #34d399); }
    .stat-card.blue::before { background: linear-gradient(90deg, var(--accent3), #60a5fa); }
    .stat-card.orange::before { background: linear-gradient(90deg, var(--accent2), #f4a261); }
    .stat-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 12px; }
    .stat-card.green .stat-icon { background: var(--accent-light); }
    .stat-card.teal .stat-icon { background: #e6faf8; }
    .stat-card.blue .stat-icon { background: #e3f0fa; }
    .stat-card.orange .stat-icon { background: #fff0ed; }
    .stat-label { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .stat-value { font-size: 30px; font-weight: 800; color: var(--text); }
    .stat-sub { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

    /* ============ TABLE ============ */
    .table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 28px; box-shadow: var(--shadow); }
    table { width: 100%; border-collapse: collapse; }
    thead th { padding: 14px 18px; text-align: left; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-muted); background: var(--surface2); border-bottom: 1px solid var(--border); }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #f9f7f4; }
    tbody td { padding: 14px 18px; font-size: 13px; }

    .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .badge-pending  { background: #fffbea; color: var(--warning); border: 1px solid #fcd34d66; }
    .badge-approved { background: var(--accent-light); color: var(--accent); border: 1px solid #a7d7c566; }
    .badge-rejected { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }
    .badge-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

    .chip { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: var(--surface2); color: var(--text-muted); border: 1px solid var(--border); text-transform: capitalize; }
    .chip-kurikulum { background: #e3f0fa; color: var(--accent3); border-color: #bdd5ea; }
    .chip-materi    { background: var(--accent-light); color: var(--accent); border-color: #a7d7c5; }
    .chip-event     { background: #fff0ed; color: var(--accent2); border-color: #e76f5166; }

    /* ============ KURIKULUM BLOCK ============ */
    .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
    .section-title { font-size: 16px; font-weight: 700; }
    .section-title span { color: var(--text-muted); font-weight: 400; font-size: 14px; margin-left: 8px; }
    .section-actions { display: flex; gap: 10px; align-items: center; }

    .kurikulum-block { margin-bottom: 28px; }
    .kurikulum-block-header { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius) var(--radius) 0 0; padding: 16px 20px; display: flex; align-items: center; gap: 12px; }
    .kurikulum-block-header .k-title { font-size: 15px; font-weight: 700; flex: 1; }
    .kurikulum-block-header .k-meta { font-size: 12px; color: var(--text-muted); display: flex; gap: 12px; flex-wrap: wrap; }
    .modul-list { border: 1px solid var(--border); border-top: none; border-radius: 0 0 var(--radius) var(--radius); overflow: hidden; }
    .modul-row { display: flex; align-items: center; gap: 14px; padding: 12px 20px; border-bottom: 1px solid var(--border); background: var(--surface); transition: background .15s; }
    .modul-row:last-child { border-bottom: none; }
    .modul-row:hover { background: #f9f7f4; }
    .modul-info { flex: 1; }
    .modul-title { font-size: 13px; font-weight: 600; color: var(--accent); }
    .modul-meta { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

    .btn-icon { width: 30px; height: 30px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface2); color: var(--text-muted); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all .2s; font-size: 13px; }
    .btn-icon:hover { background: var(--accent-light); border-color: var(--accent); color: var(--accent); }
    .btn-icon-danger:hover { background: #fff0ed; border-color: var(--accent2); color: var(--accent2) !important; }

    /* ============ ABSENSI STYLES ============ */
    .absensi-bar { border: 1px solid var(--border); border-top: none; background: linear-gradient(135deg, #f0f9f4 0%, #fafffe 100%); padding: 14px 20px; display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
    .absensi-bar.absensi-active { background: linear-gradient(135deg, #e8f5e9 0%, #f0fff4 100%); border-color: #a7d7c5; }
    .absensi-bar.absensi-upcoming { background: linear-gradient(135deg, #fffbea 0%, #fffdf5 100%); border-color: #fcd34d66; }
    .absensi-bar.absensi-ended { background: var(--surface2); border-color: var(--border); opacity: 0.8; }
    .btn-absensi-live { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: var(--accent); color: #fff; border: none; border-radius: 10px; font-size: 13px; font-weight: 700; cursor: pointer; font-family: inherit; text-decoration: none; animation: pulse-green 2s infinite; transition: all .2s; }
    .btn-absensi-live:hover { background: #1f4e37; transform: translateY(-1px); }
    @keyframes pulse-green { 0%, 100% { box-shadow: 0 0 0 0 rgba(45,106,79,.4); } 50% { box-shadow: 0 0 0 6px rgba(45,106,79,0); } }
    .absensi-countdown { display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; }
    .countdown-timer { font-size: 13px; font-weight: 800; font-family: 'Courier New', monospace; letter-spacing: 1px; color: var(--accent); background: var(--accent-light); padding: 4px 10px; border-radius: 6px; border: 1px solid #a7d7c566; }
    .countdown-timer.warning { color: #b45309; background: #fffbea; border-color: #fcd34d66; }
    .countdown-timer.upcoming { color: #b45309; background: #fffbea; border-color: #fcd34d66; }
    .absensi-label { font-size: 12px; font-weight: 600; display: flex; align-items: center; gap: 6px; }
    .absensi-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); animation: blink 1s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
    .absensi-schedule-info { font-size: 11px; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }

    /* Toggle absensi dalam form */
    .absensi-toggle-section { background: var(--surface2); border: 1.5px solid var(--border); border-radius: 12px; overflow: hidden; margin-bottom: 0; }
    .absensi-toggle-header { display: flex; align-items: center; justify-content: space-between; padding: 14px 16px; cursor: pointer; user-select: none; transition: background .15s; }
    .absensi-toggle-header:hover { background: var(--border); }
    .absensi-toggle-header-left { display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 700; color: var(--text); }
    .absensi-toggle-body { display: none; padding: 16px; border-top: 1px solid var(--border); background: var(--surface); }
    .absensi-toggle-body.open { display: block; }

    /* Switch toggle */
    .switch { position: relative; display: inline-block; width: 40px; height: 22px; flex-shrink: 0; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .switch-slider { position: absolute; cursor: pointer; inset: 0; background: #ccc; border-radius: 22px; transition: .3s; }
    .switch-slider:before { content: ''; position: absolute; height: 16px; width: 16px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: .3s; }
    .switch input:checked + .switch-slider { background: var(--accent); }
    .switch input:checked + .switch-slider:before { transform: translateX(18px); }

    /* ============ PROFILE ============ */
    .profile-hero { background: linear-gradient(135deg, var(--accent) 0%, #1b4332 100%); border-radius: var(--radius); padding: 32px; margin-bottom: 24px; display: flex; align-items: center; gap: 24px; box-shadow: var(--shadow); }
    .profile-avatar-xl { width: 80px; height: 80px; border-radius: 18px; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: 800; color: #fff; border: 3px solid rgba(255,255,255,.3); flex-shrink: 0; overflow: hidden; }
    .profile-avatar-xl img { width: 100%; height: 100%; object-fit: cover; border-radius: 15px; }
    .profile-hero-info h2 { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 4px; }
    .profile-hero-info p { color: rgba(255,255,255,.7); font-size: 14px; }
    .profile-form-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 28px; box-shadow: var(--shadow); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-group { margin-bottom: 18px; }
    .form-label { display: block; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .form-input, .form-textarea, .form-select { width: 100%; padding: 11px 14px; background: var(--surface2); border: 1.5px solid var(--border); border-radius: 10px; color: var(--text); font-family: inherit; font-size: 14px; transition: border .2s; }
    .form-input:focus, .form-textarea:focus, .form-select:focus { outline: none; border-color: var(--accent); background: #fff; }
    .form-textarea { min-height: 100px; resize: vertical; }
    .form-static { padding: 11px 14px; background: var(--bg); border: 1.5px solid var(--border); border-radius: 10px; font-size: 14px; color: var(--text); }
    .form-hint { font-size: 11px; color: var(--text-muted); margin-top: 5px; }
    .form-divider { border: none; border-top: 1px solid var(--border); margin: 8px 0 18px; }
    .form-section-title { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 14px; }

    .radio-group { display: flex; gap: 12px; }
    .radio-option { flex: 1; }
    .radio-option input[type="radio"] { display: none; }
    .radio-option label { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px; border: 1.5px solid var(--border); border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all .2s; background: var(--surface2); color: var(--text-muted); }
    .radio-option input[type="radio"]:checked + label { border-color: var(--accent); background: var(--accent-light); color: var(--accent); }

    .upload-area { position: relative; width: 100%; min-height: 110px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; padding: 24px; border: 2px dashed #2d6a4f66; border-radius: 14px; background: #faf8f5; text-align: center; cursor: pointer; transition: all .2s; }
    .upload-area:hover { background: #eef8f1; border-color: var(--accent); }
    .upload-area .upload-icon { font-size: 36px; line-height: 1; }
    .upload-area .upload-text { font-size: 13px; color: var(--text-muted); line-height: 1.6; }
    .upload-area .upload-text span { color: var(--accent); font-weight: 700; }
    .upload-fname { margin-top: 4px; font-size: 12px; font-weight: 600; color: var(--accent); word-break: break-word; }

    /* ============ MODAL ============ */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); backdrop-filter: blur(4px); z-index: 200; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal { background: var(--surface); border-radius: 20px; width: 640px; max-height: 90vh; overflow-y: auto; padding: 30px; box-shadow: 0 24px 80px rgba(0,0,0,.2); animation: popIn .25s ease; border: 1px solid var(--border); }
    @keyframes popIn { from { transform: scale(.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .modal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
    .modal-title { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 700; }
    .modal-title small { font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500; color: var(--text-muted); display: block; margin-top: 2px; }
    .modal-close { width: 34px; height: 34px; border-radius: 10px; background: var(--surface2); border: 1px solid var(--border); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--text-muted); }
    .modal-close:hover { background: #fee; border-color: var(--accent2); color: var(--accent2); }
    .modal-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border); }

    .alert { padding: 14px 18px; border-radius: 10px; font-size: 13px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .alert-success { background: var(--accent-light); color: var(--accent); border: 1px solid #a7d7c566; }
    .alert-error   { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }

    .notice-box { background: #fffbea; border: 1px solid #fcd34d66; border-radius: 12px; padding: 16px 20px; display: flex; align-items: center; gap: 14px; margin-bottom: 20px; }
    .notice-box .notice-text { font-size: 13px; color: #92400e; line-height: 1.6; }

    .page-section { display: none; }
    .page-section.active { display: block; }

    .empty-state { text-align: center; padding: 60px 20px; color: var(--text-muted); }
    .empty-state .empty-icon { font-size: 48px; margin-bottom: 16px; }
    .empty-state h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; color: var(--text); }
    .empty-state p { font-size: 13px; line-height: 1.6; }

    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

    .btn-resubmit { animation: pulse-orange 2s infinite; }
    /* ============ PROGRAM STATUS BADGE ============ */
.program-status-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    border: 1px solid var(--border);
    border-top: none;
    background: var(--surface);
    flex-wrap: wrap;
}
.program-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .3px;
}
.psb-belum  { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
.psb-aktif  { background: #f0fdf4; color: #16a34a; border: 1px solid #86efac; }
.psb-selesai{ background: #f8fafc; color: #64748b; border: 1px solid #cbd5e1; }
.program-countdown {
    font-size: 12px;
    font-weight: 700;
    font-family: 'Courier New', monospace;
    letter-spacing: 1px;
    padding: 4px 10px;
    border-radius: 6px;
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
}
.program-countdown.aktif  { background: #f0fdf4; color: #16a34a; border-color: #86efac; }
.program-countdown.warning{ background: #fffbea; color: #b45309; border-color: #fcd34d; }
.psb-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: currentColor;
    flex-shrink: 0;
}
.psb-dot.blink { animation: blink 1s infinite; }
    @keyframes pulse-orange { 0%, 100% { box-shadow: 0 0 0 0 rgba(231,111,81,.3); } 50% { box-shadow: 0 0 0 4px rgba(231,111,81,0); } }

    /* Upload area portrait 9:16 */
    .upload-area-portrait {
        position: relative;
        width: 100%;
        max-width: 200px;
        margin: 0 auto;
        border: 2px dashed #2d6a4f66;
        border-radius: 14px;
        background: #faf8f5;
        cursor: pointer;
        transition: all .2s;
        overflow: hidden;
    }
    .upload-area-portrait::before {
        content: '';
        display: block;
        padding-top: 177.78%; /* 9:16 = 100/(9/16) */
    }
    .upload-area-portrait:hover { background: #eef8f1; border-color: var(--accent); }
    .upload-area-portrait-inner {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 16px;
        text-align: center;
    }
    .upload-area-portrait img.portrait-preview {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        z-index: 1;
    }
    .upload-area-portrait .portrait-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.45);
        border-radius: 12px;
        z-index: 2;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .upload-area-portrait-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }
    .upload-area-portrait-label span {
        background: var(--accent-light);
        color: var(--accent);
        border: 1px solid #a7d7c566;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 10px;
    }
    .upload-error { font-size: 11px; color: var(--accent2); margin-top: 5px; display: none; }
    /* ============ ALAMAT GROUP ============ */
    /* Selalu tampil, tidak disembunyikan agar selalu terkirim */
    #k-alamat-group { display: block; }
    #k-alamat-group.hidden-alamat {
        display: none !important;
    }

    /* ============ HAMBURGER BUTTON ============ */
    .hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        padding: 8px;
        border-radius: 10px;
        background: var(--surface2);
        border: 1px solid var(--border);
        flex-shrink: 0;
    }
    .hamburger span {
        display: block;
        width: 20px;
        height: 2px;
        background: var(--text);
        border-radius: 2px;
        transition: all .3s;
    }

    /* ============ SIDEBAR OVERLAY (mobile) ============ */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.45);
        z-index: 99;
        backdrop-filter: blur(2px);
    }
    .sidebar-overlay.open { display: block; }

    /* ============ RESPONSIVE: LARGE SCREEN (≥1400px) ============ */
    @media (min-width: 1400px) {
        .content { padding: 36px 48px; }
        .stats-grid { grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .stat-value { font-size: 34px; }
    }

    /* ============ RESPONSIVE: TABLET (769px – 1100px) ============ */
    @media (min-width: 769px) and (max-width: 1100px) {
        .sidebar { width: 220px; }
        .main { margin-left: 220px; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .content { padding: 24px 20px; }
        .topbar { padding: 14px 20px; }
        .modal { width: 90vw !important; }
    }

    /* ============ RESPONSIVE: MOBILE (≤768px) ============ */
    @media (max-width: 768px) {
        /* Sidebar */
        .sidebar {
            transform: translateX(-100%);
            transition: transform .3s ease;
            width: 260px;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0,0,0,.2);
        }
        .sidebar.open {
            transform: translateX(0);
        }

        /* Main */
        .main { margin-left: 0; }

        /* Topbar */
        .topbar { padding: 12px 16px; gap: 10px; }
        .topbar-title { font-size: 18px; }
        .hamburger { display: flex; }

        /* Sembunyikan tombol lihat website di mobile */
        .topbar .btn-ghost { display: none; }

        /* Greeting teks */
        .topbar > div > span { display: none; }

        /* Content */
        .content { padding: 16px; }

        /* Stats grid */
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        .stat-value { font-size: 24px; }
        .stat-card { padding: 16px; }

        /* Tables */
        .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }

        /* Khusus tabel Status Terbaru di beranda — sembunyikan kolom Tanggal */
        @media (max-width: 480px) {
            /* Sembunyikan kolom Tanggal (kolom ke-3) */
            #page-beranda table thead th:nth-child(3),
            #page-beranda table tbody td:nth-child(3) {
                display: none;
            }
            /* Sembunyikan kolom Lokasi di tabel event (kolom ke-2) */
            #page-event table thead th:nth-child(2),
            #page-event table tbody td:nth-child(2) {
                display: none;
            }
            /* Perkecil padding sel tabel */
            tbody td, thead th { padding: 10px 10px; }
            
            /* Perkecil font badge di tabel */
            .badge { font-size: 10px; padding: 3px 7px; }
            .chip  { font-size: 10px; padding: 2px 8px; }
        }

        /* Form rows */
        .form-row { grid-template-columns: 1fr; gap: 0; }

        /* Kurikulum block header */
        .kurikulum-block-header {
            flex-wrap: wrap;
            gap: 10px;
            padding: 14px;
        }
        .kurikulum-block-header > div:last-child {
            width: 100%;
            justify-content: flex-end;
            flex-wrap: wrap;
        }
        .k-meta { gap: 8px; }

        /* Section header */
        .section-header { flex-direction: column; align-items: flex-start; gap: 12px; }
        .section-actions { width: 100%; display: flex; flex-wrap: wrap; gap: 8px; }
        .section-actions .btn { flex: 1; justify-content: center; }

        /* Modal */
        .modal-overlay { align-items: flex-end; }
        .modal {
            width: 100% !important;
            max-height: 92vh;
            border-radius: 20px 20px 0 0;
            padding: 24px 20px;
        }

        /* Profile hero */
        .profile-hero { flex-direction: column; text-align: center; gap: 16px; padding: 24px 20px; }
        .profile-hero button { margin-left: 0 !important; width: 100%; justify-content: center; }

        /* Absensi bar */
        .absensi-bar { padding: 12px 14px; gap: 10px; }
        .btn-absensi-live { width: 100%; justify-content: center; }

        /* Radio group */
        .radio-group { flex-direction: column; }

        /* Modul row */
        .modul-row { flex-wrap: wrap; gap: 10px; }
        .modul-row > div:last-child { margin-left: auto; }

        /* User card di sidebar */
        .user-name { font-size: 12px; }
    }

    /* ============ CARD TABLE MOBILE ============ */
    @media (max-width: 768px) {
        /* Hapus min-width paksa */
        table { min-width: unset; width: 100%; }

        /* Sembunyikan thead */
        #page-beranda .table-wrap thead,
        #page-event .table-wrap thead { display: none; }

        /* Ubah tbody jadi block */
        #page-beranda .table-wrap tbody,
        #page-event .table-wrap tbody { display: block; }

        /* Setiap baris jadi kartu */
        #page-beranda .table-wrap tbody tr,
        #page-event .table-wrap tbody tr {
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border);
            border-radius: 12px;
            margin: 10px 12px;
            padding: 12px 14px;
            background: var(--surface);
            box-shadow: var(--shadow);
            gap: 6px;
        }

        /* Semua td jadi block */
        #page-beranda .table-wrap tbody td,
        #page-event .table-wrap tbody td {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 2px 0;
            font-size: 13px;
            border: none;
        }

        /* Label otomatis sebelum setiap kolom */
        #page-beranda .table-wrap tbody td::before,
        #page-event .table-wrap tbody td::before {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            min-width: 60px;
            flex-shrink: 0;
        }

        /* Beranda: Nama, Tipe, Tanggal, Status */
        #page-beranda .table-wrap tbody td:nth-child(1)::before { content: 'Nama'; }
        #page-beranda .table-wrap tbody td:nth-child(2)::before { content: 'Tipe'; }
        #page-beranda .table-wrap tbody td:nth-child(3)::before { content: 'Tanggal'; }
        #page-beranda .table-wrap tbody td:nth-child(4)::before { content: 'Status'; }

        /* Event: Nama, Lokasi, Tanggal, Kapasitas, Status, Aksi */
        #page-event .table-wrap tbody td:nth-child(1)::before  { content: 'Event'; }
        #page-event .table-wrap tbody td:nth-child(2)::before  { content: 'Lokasi'; }
        #page-event .table-wrap tbody td:nth-child(3)::before  { content: 'Tanggal'; }
        #page-event .table-wrap tbody td:nth-child(4)::before  { content: 'Kapasitas'; }
        #page-event .table-wrap tbody td:nth-child(5)::before  { content: 'Status'; }
        #page-event .table-wrap tbody td:nth-child(6)::before  { content: 'Aksi'; }

        /* Kolom nama rata atas (karena ada catatan admin) */
        #page-event .table-wrap tbody td:nth-child(1) { align-items: flex-start; }

        /* Hapus border antar baris lama */
        #page-beranda .table-wrap tbody tr,
        #page-event .table-wrap tbody tr { border-bottom: none !important; }

        /* Tambah garis pemisah antar label-value */
        #page-beranda .table-wrap tbody td:not(:last-child),
        #page-event .table-wrap tbody td:not(:last-child) {
            padding-bottom: 6px;
            border-bottom: 1px solid var(--surface2);
        }

        /* Stat card teks tidak terpotong */
        .stat-label { font-size: 11px; }
        .stat-sub   { font-size: 11px; }

        /* Topbar greeting sembunyikan di mobile */
        .topbar > div > span { display: none; }
    }
    /* ============ RESPONSIVE: MOBILE KECIL (≤400px) ============ */
    @media (max-width: 400px) {
        .stats-grid { grid-template-columns: 1fr; }
        .stat-value { font-size: 28px; }
        .topbar-title { font-size: 16px; }
    }

    </style>
    </head>
    <body>

    
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-box">
                <div class="brand-icon">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div>
                    <div class="brand-name">KAJI Indonesia</div>
                    <div class="brand-role">Trainer</div>
                </div>
            </div>
        </div>
        <div class="nav-section">
    <div class="nav-label">Menu Utama</div>

    
    <div class="nav-item active" onclick="showPage('beranda')">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
        </svg>
        Beranda
    </div>

    
    <?php
        $badgeProgram = ($pelatihanList ?? collect())
            ->whereIn('status', ['pending', 'rejected'])->count();
    ?>
    <div class="nav-item" onclick="showPage('program')">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        Program / Pelatihan
        <?php if($badgeProgram > 0): ?>
            <span class="nav-badge"><?php echo e($badgeProgram); ?></span>
        <?php endif; ?>
    </div>

    
    <?php
        $badgeEvent = ($eventList ?? collect())
            ->whereIn('status', ['pending', 'rejected'])->count();
    ?>
    <div class="nav-item" onclick="showPage('event')">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Event
        <?php if($badgeEvent > 0): ?>
            <span class="nav-badge"><?php echo e($badgeEvent); ?></span>
        <?php endif; ?>
    </div>

    
    <?php
        $badgeUlasan = isset($totalUlasan) && $totalUlasan > 0 ? $totalUlasan : 0;
    ?>
    <div class="nav-item" onclick="showPage('ulasan')">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>
        Ulasan
        <?php if($badgeUlasan > 0): ?>
        <span class="nav-badge"><?php echo e($badgeUlasan); ?></span>
        <?php endif; ?>
    </div>

    
    <?php $unreadDeleted = $deletedLogs->where('is_read', false)->count(); ?>
    <div class="nav-item <?php echo e($activePage === 'deleted' ? 'active' : ''); ?>"
         onclick="showPage('deleted')" id="nav-deleted">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        Program Dihapus
        <?php if($unreadDeleted > 0): ?>
        <span class="nav-badge" id="deleted-badge"><?php echo e($unreadDeleted); ?></span>
        <?php endif; ?>
    </div>

    
<?php $unreadDeletedEvent = isset($deletedEventLogs) ? $deletedEventLogs->where('is_read', false)->count() : 0; ?>
<div class="nav-item <?php echo e(isset($activePage) && $activePage === 'deleted-event' ? 'active' : ''); ?>"
     onclick="showPage('deleted-event')" id="nav-deleted-event">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <rect x="3" y="4" width="18" height="18" rx="2"/>
        <line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
        <line x1="9" y1="16" x2="9.01" y2="16"/>
    </svg>
    Event Dihapus
    <?php if($unreadDeletedEvent > 0): ?>
        <span class="nav-badge" id="deleted-event-badge"><?php echo e($unreadDeletedEvent); ?></span>
    <?php endif; ?>
</div>

</div>

<div class="nav-section">
    <div class="nav-label">Akun</div>

    
    <?php
        $profilTidakLengkap = empty($trainer?->bio)
            || empty($trainer?->foto)
            || empty($trainer?->lokasi)
            || empty(auth()->user()->phone);
        $badgeProfil = $profilTidakLengkap ? 1 : 0;
    ?>
    <div class="nav-item" onclick="showPage('profil')">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
        Profil Saya
        <?php if($badgeProfil): ?>
        <span class="nav-badge" style="background:#457b9d" title="Profil belum lengkap">!</span>
        <?php endif; ?>
    </div>

    <a href="<?php echo e(route('logout')); ?>"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="nav-item">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        Keluar
    </a>
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none">
        <?php echo csrf_field(); ?>
    </form>
</div>
        </div>
        <div class="sidebar-user">
            <div class="user-card" onclick="showPage('profil')">
            <div class="user-avatar">
            <?php $fotoSidebar = $trainer?->foto ?? null; ?>
    <?php if($fotoSidebar): ?>
        <img src="<?php echo e(asset('storage/' . $fotoSidebar)); ?>" alt="<?php echo e(auth()->user()->name); ?>">
    <?php else: ?>
        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

    <?php endif; ?>
    </div>
                <div>
                    <div class="user-name"><?php echo e(auth()->user()->name); ?></div>
                    <div class="user-role">Trainer</div>
                </div>
            </div>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>

    
    <main class="main">
    <header class="topbar">
        <button class="hamburger" onclick="toggleSidebar()" aria-label="Toggle Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="topbar-title" id="page-title">Dashboard Trainer</div>
        <div style="display:flex;gap:10px;align-items:center">
            <span style="font-size:13px;color:var(--text-muted)">Halo, <?php echo e(auth()->user()->name); ?> 👋</span>
            <a href="<?php echo e(url('/')); ?>" target="_blank" class="btn btn-ghost" style="font-size:13px;padding:8px 16px">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 2a10 10 0 100 20A10 10 0 0012 2z"/>
                    <path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
                </svg>
                Lihat Website
            </a>
        </div>
    </header>

    <div class="content">


<?php if(isset($deletedLogs) && $deletedLogs->where('is_read', false)->count() > 0): ?>
<div id="notif-deleted-wrap"
    style="background:#fff7ed;border:1.5px solid #fed7aa;border-radius:14px;
           padding:16px 20px;margin-bottom:20px;box-shadow:0 2px 12px rgba(234,88,12,.08)">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;gap:12px;flex-wrap:wrap">
        <div style="display:flex;align-items:center;gap:10px">
            <div style="width:36px;height:36px;border-radius:10px;background:#ffedd5;
                        display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0">
                🗑️
            </div>
            <div>
                <div style="font-size:14px;font-weight:700;color:#c2410c">
                    Program Dihapus oleh Admin
                </div>
                <div style="font-size:12px;color:#9a3412;margin-top:1px">
                    <?php echo e($deletedLogs->where('is_read', false)->count()); ?> program berikut telah dihapus
                </div>
            </div>
        </div>
        <button onclick="tandaiSudahDibaca()"
            style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;
                   background:#ea580c;color:#fff;border:none;cursor:pointer;font-family:inherit;
                   transition:background .15s;flex-shrink:0"
            onmouseover="this.style.background='#c2410c'"
            onmouseout="this.style.background='#ea580c'">
            ✓ Tandai Sudah Dibaca
        </button>
    </div>
    <div style="display:flex;flex-direction:column;gap:8px">
        <?php $__currentLoopData = $deletedLogs->where('is_read', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex;align-items:center;gap:12px;padding:10px 14px;
                    background:#fff;border:1px solid #fed7aa;border-radius:10px">
            <div style="font-size:18px;flex-shrink:0">
                <?php echo e($log->program_tipe === 'modul' ? '📝' : '📚'); ?>

            </div>
            <div style="flex:1;min-width:0">
                <div style="font-size:13px;font-weight:700;color:#1a1a2e">
                    <?php echo e($log->program_title); ?>

                </div>
                <div style="font-size:11px;color:#9a3412;margin-top:2px;display:flex;align-items:center;gap:6px;flex-wrap:wrap">
                    <span style="background:#ffedd5;color:#c2410c;border:1px solid #fed7aa;
                                 padding:1px 8px;border-radius:20px;font-weight:600;font-size:10px">
                        <?php echo e(ucfirst($log->program_tipe ?? 'program')); ?>

                    </span>
                    <span>Dihapus pada <?php echo e($log->deleted_at_by_admin->translatedFormat('d M Y, H:i')); ?> WIB</span>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

<?php if(isset($deletedEventLogs) && $deletedEventLogs->where('is_read', false)->count() > 0): ?>
<div id="notif-deleted-event-wrap"
    style="background:#f0f4ff;border:1.5px solid #bfdbfe;border-radius:14px;
           padding:16px 20px;margin-bottom:20px;box-shadow:0 2px 12px rgba(69,123,157,.08)">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;gap:12px;flex-wrap:wrap">
        <div style="display:flex;align-items:center;gap:10px">
            <div style="width:36px;height:36px;border-radius:10px;background:#dbeafe;
                        display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0">
                🗓️
            </div>
            <div>
                <div style="font-size:14px;font-weight:700;color:#1d4ed8">
                    Event Dihapus oleh Admin
                </div>
                <div style="font-size:12px;color:#1e40af;margin-top:1px">
                    <?php echo e($deletedEventLogs->where('is_read', false)->count()); ?> event berikut telah dihapus
                </div>
            </div>
        </div>
        <button onclick="tandaiEventSudahDibaca()"
            style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;
                   background:#1d4ed8;color:#fff;border:none;cursor:pointer;font-family:inherit;
                   transition:background .15s;flex-shrink:0"
            onmouseover="this.style.background='#1e40af'"
            onmouseout="this.style.background='#1d4ed8'">
            ✓ Tandai Sudah Dibaca
        </button>
    </div>
    <div style="display:flex;flex-direction:column;gap:8px">
        <?php $__currentLoopData = $deletedEventLogs->where('is_read', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex;align-items:center;gap:12px;padding:10px 14px;
                    background:#fff;border:1px solid #bfdbfe;border-radius:10px">
            <div style="font-size:18px;flex-shrink:0">🎪</div>
            <div style="flex:1;min-width:0">
                <div style="font-size:13px;font-weight:700;color:#1a1a2e">
                    <?php echo e($log->event_title); ?>

                </div>
                <div style="font-size:11px;color:#1e40af;margin-top:2px;display:flex;align-items:center;gap:6px;flex-wrap:wrap">
                    <span style="background:#dbeafe;color:#1d4ed8;border:1px solid #bfdbfe;
                                 padding:1px 8px;border-radius:20px;font-weight:600;font-size:10px">
                        Event
                    </span>
                    <span>Dihapus pada <?php echo e($log->deleted_at_by_admin->translatedFormat('d M Y, H:i')); ?> WIB</span>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

        <div class="page-section active" id="page-beranda">
            <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
            <?php if(session('error')): ?><div class="alert alert-error">⚠️ <?php echo e(session('error')); ?></div><?php endif; ?>

            <div class="stats-grid">
                <div class="stat-card green">
                    <div class="stat-icon">📚</div>
                    <div class="stat-label">Total Kurikulum</div>
                    <div class="stat-value"><?php echo e($totalKurikulum ?? 0); ?></div>
                    <div class="stat-sub">Kurikulum yang diajukan</div>
                </div>
                <div class="stat-card teal">
                    <div class="stat-icon">📝</div>
                    <div class="stat-label">Total Modul</div>
                    <div class="stat-value"><?php echo e($totalModul ?? 0); ?></div>
                    <div class="stat-sub">Modul dalam kurikulum</div>
                </div>
                <div class="stat-card blue">
                    <div class="stat-icon">📅</div>
                    <div class="stat-label">Total Event</div>
                    <div class="stat-value"><?php echo e($totalEvent ?? 0); ?></div>
                    <div class="stat-sub">Event yang diajukan</div>
                </div>
                <div class="stat-card orange">
                    <div class="stat-icon">⏳</div>
                    <div class="stat-label">Menunggu Persetujuan</div>
                    <div class="stat-value"><?php echo e($pendingTotal ?? 0); ?></div>
                    <div class="stat-sub">Perlu tindakan admin</div>
                </div>
            </div>

            <div class="section-header">
                <div class="section-title">Status Terbaru <span>program & modul</span></div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Nama</th><th>Tipe</th><th>Tanggal</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentSubmissions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="font-weight:500"><?php echo e($item->judul ?? $item->nama); ?></td>
                            <td><span class="chip chip-<?php echo e($item->tipe ?? 'kurikulum'); ?>"><?php echo e(ucfirst($item->tipe ?? '-')); ?></span></td>
                            <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y')); ?></td>
                            <td>
                            <?php if(!empty($item->deleted_at)): ?>
    <span class="badge" style="background:#f3f0ff;color:#7c3aed;border:1px solid #c4b5fd">
        <span class="badge-dot"></span>Dihapus Admin
    </span>
<?php elseif(($item->status ?? '') === 'approved'): ?>
    <span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>
<?php elseif(($item->status ?? '') === 'rejected'): ?>
    <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
<?php else: ?>
    <span class="badge badge-pending"><span class="badge-dot"></span>Menunggu</span>
<?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" style="text-align:center;padding:40px;color:var(--text-muted)">Belum ada program atau event yang diajukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="page-section" id="page-program">
            <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
            <?php if(session('error')): ?><div class="alert alert-error">⚠️ <?php echo e(session('error')); ?></div><?php endif; ?>

            <div class="section-header">
                <div class="section-title">Program / Pelatihan <span><?php echo e(($totalKurikulum ?? 0) + ($totalModul ?? 0)); ?> total</span></div>
                <div class="section-actions">
                    <button class="btn btn-secondary" onclick="openModalModul()">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        + Tambah Modul
                    </button>
                    <button class="btn btn-primary" onclick="openModal('modal-kurikulum')">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        + Tambah Kurikulum
                    </button>
                </div>
            </div>

            <?php
                $kurikulumList   = isset($pelatihanList) ? $pelatihanList->where('tipe', 'kurikulum') : collect();
                $modulList       = isset($pelatihanList) ? $pelatihanList->where('tipe', 'modul')     : collect();
                $adaKurikulumVar = $kurikulumList->count() > 0;
            ?>

            <?php if($adaKurikulumVar): ?>
                <?php $__currentLoopData = $kurikulumList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $modulDalamK = $modulList->where('kurikulum_id', $k->id)->sortBy('urutan');
                    $absensiAktif   = !empty($k->absensi_mulai) && !empty($k->absensi_selesai) && $k->absensi_aktif;
                    $absensiMulai   = $absensiAktif ? \Carbon\Carbon::parse($k->absensi_mulai, 'Asia/Jakarta') : null;
    $absensiSelesai = $absensiAktif ? \Carbon\Carbon::parse($k->absensi_selesai, 'Asia/Jakarta') : null;                $absensiUrl     = $k->absensi_url ?? '#';
                    $now            = \Carbon\Carbon::now();
                    $statusAbsensi  = null;
                    if ($absensiAktif) {
                        if ($now->lt($absensiMulai))                           $statusAbsensi = 'upcoming';
                        elseif ($now->between($absensiMulai, $absensiSelesai)) $statusAbsensi = 'active';
                        else                                                   $statusAbsensi = 'ended';
                    }
                    $jumlahAbsensi = \App\Models\AbsensiPeserta::where('pelatihan_id', $k->id)->count();
                ?>
    
                <div class="kurikulum-block">
                    <div class="kurikulum-block-header">
                        <div style="width:42px;height:42px;border-radius:10px;background:var(--surface2);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;overflow:hidden;">
                            <?php if($k->gambar): ?>
                                <img src="<?php echo e(asset('storage/'.$k->gambar)); ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?> 📚 <?php endif; ?>
                        </div>
                        <div style="flex:1">
                            <div class="k-title"><?php echo e($k->judul); ?></div>
                            <div class="k-meta">
                                <span><?php echo e($modulDalamK->count()); ?> materi</span>
                                <?php if($k->total_jam): ?> <span>⏱ <?php echo e((int) $k->total_jam); ?> jam</span> <?php endif; ?>
                                <?php if($k->jumlah_sesi): ?> <span>📅 <?php echo e($k->jumlah_sesi); ?> sesi</span> <?php endif; ?>
                                <?php if($k->sertifikat): ?> <span>🏆 Sertifikat</span> <?php endif; ?>
                                <?php if($k->tingkat): ?> <span><?php echo e(ucfirst($k->tingkat)); ?></span> <?php endif; ?>
                                <?php if($k->metode): ?> <span><?php echo e(ucfirst($k->metode)); ?></span> <?php endif; ?>
                                <?php if($k->alamat): ?> <span>📍 <?php echo e(Str::limit($k->alamat, 30)); ?></span> <?php endif; ?>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;flex-shrink:0">
                        <?php if(!empty($k->deleted_at)): ?>
    <span class="badge" style="background:#f3f0ff;color:#7c3aed;border:1px solid #c4b5fd">
        <span class="badge-dot"></span>Dihapus Admin
    </span>
<?php elseif(($k->status ?? '') === 'approved'): ?>
    <span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>
<?php elseif(($k->status ?? '') === 'rejected'): ?>
    <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
<?php else: ?>
    <span class="badge badge-pending"><span class="badge-dot"></span>Menunggu</span>
<?php endif; ?>

                            <?php
                            $jumlahPendaftar = \App\Models\PendaftaranProgram::where('program_id', $k->id)->count();
                        ?>
                            <button class="btn btn-sm"
                            style="background:#e8f0fe;color:#1d4ed8;border:1.5px solid #93c5fd;font-weight:700;gap:6px;flex-shrink:0"
                                onclick="bukaDaftarPeserta(<?php echo e($k->id); ?>, '<?php echo e(addslashes($k->judul)); ?>')">
                                🎓 Peserta
                                <?php if($jumlahPendaftar > 0): ?>
                                    <span style="background:#1d4ed8;color:#fff;font-size:10px;font-weight:700;padding:1px 7px;border-radius:20px;margin-left:2px">
                            <?php echo e($jumlahPendaftar); ?>

                            </span>
                            <?php endif; ?>
                            </button>

                            <button class="btn btn-sm" style="background:#e8f5e9;color:#2d6a4f;border:1.5px solid #a7d7c5;font-weight:700;gap:6px;flex-shrink:0"
                                onclick="bukaDaftarAbsensi(<?php echo e($k->id); ?>, '<?php echo e(addslashes($k->judul)); ?>')">
                                👥 Absensi
                                <?php if($jumlahAbsensi > 0): ?>
                                    <span style="background:#2d6a4f;color:#fff;font-size:10px;font-weight:700;padding:1px 7px;border-radius:20px;margin-left:2px"><?php echo e($jumlahAbsensi); ?></span>
                                <?php endif; ?>
                            </button>

                            

                            <button class="btn btn-sm btn-outline" onclick="openModalModulDenganKurikulum(<?php echo e($k->id); ?>, '<?php echo e(addslashes($k->judul)); ?>')">+ Modul</button>

                            <button class="btn-icon btn-edit-kurikulum"
                                data-id="<?php echo e($k->id); ?>"
                                data-judul="<?php echo e($k->judul); ?>"
                                data-deskripsi="<?php echo e($k->deskripsi ?? ''); ?>"
                                data-metode="<?php echo e($k->metode ?? ''); ?>"
                                data-tingkat="<?php echo e($k->tingkat ?? ''); ?>"
                                data-bahasa="<?php echo e($k->bahasa ?? 'Bahasa Indonesia'); ?>"
                                data-total-jam="<?php echo e($k->total_jam ?? ''); ?>"
                                data-jumlah-sesi="<?php echo e($k->jumlah_sesi ?? ''); ?>"
                                data-sertifikat="<?php echo e($k->sertifikat ? 1 : 0); ?>"
                                data-phone="<?php echo e($k->phone ?? auth()->user()->phone ?? ''); ?>"
                                data-biaya="<?php echo e($k->biaya ?? ''); ?>"
                                data-absensi-aktif="<?php echo e(!empty($k->absensi_mulai) ? 1 : 0); ?>"
                                data-absensi-mulai="<?php echo e($k->absensi_mulai ?? ''); ?>"
                                data-absensi-selesai="<?php echo e($k->absensi_selesai ?? ''); ?>"
                                data-absensi-url="<?php echo e($k->absensi_url ?? ''); ?>"
                            data-alamat="<?php echo e(json_encode($k->alamat ?? '')); ?>"
                            data-gambar-url="<?php echo e($k->gambar ? asset('storage/'.$k->gambar) : ''); ?>"
data-program-mulai="<?php echo e($k->program_mulai ? \Carbon\Carbon::parse($k->program_mulai)->format('Y-m-d\TH:i') : ''); ?>"
data-program-selesai="<?php echo e($k->program_selesai ? \Carbon\Carbon::parse($k->program_selesai)->format('Y-m-d\TH:i') : ''); ?>"
                                title="Edit Kurikulum">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>

                            <button class="btn-icon btn-icon-danger" onclick="hapusItem(<?php echo e($k->id); ?>, 'kurikulum')" title="Hapus">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6M9 6V4h6v2"/></svg>
                            </button>
                        </div>
                    </div>
                    <?php
    $progMulai   = !empty($k->program_mulai)   ? \Carbon\Carbon::parse($k->program_mulai, 'Asia/Jakarta')   : null;
    $progSelesai = !empty($k->program_selesai) ? \Carbon\Carbon::parse($k->program_selesai, 'Asia/Jakarta') : null;
    $nowProg     = \Carbon\Carbon::now('Asia/Jakarta');
    $statusProg  = null;
    if ($progMulai) {
        if ($nowProg->lt($progMulai))                                                        $statusProg = 'belum';
        elseif (!$progSelesai || $nowProg->lte($progSelesai))                               $statusProg = 'aktif';
        else                                                                                  $statusProg = 'selesai';
    }
?>
<?php if($statusProg): ?>
<div class="program-status-wrap"
     id="prog-status-bar-<?php echo e($k->id); ?>"
     data-mulai="<?php echo e($progMulai ? $progMulai->timestamp : 0); ?>"
     data-selesai="<?php echo e($progSelesai ? $progSelesai->timestamp : 0); ?>"
     data-status="<?php echo e($statusProg); ?>">

    <?php if($statusProg === 'belum'): ?>
        <span class="program-status-badge psb-belum">
            <span class="psb-dot"></span>⏳ Belum Dibuka
        </span>
        <span style="font-size:12px;color:var(--text-muted)">Dibuka dalam</span>
        <span class="program-countdown" id="prog-timer-<?php echo e($k->id); ?>">--:--:--</span>
        <span style="font-size:11px;color:var(--text-muted);margin-left:4px">
            (<?php echo e($progMulai->translatedFormat('d M Y, H:i')); ?> WIB)
        </span>

    <?php elseif($statusProg === 'aktif'): ?>
        <span class="program-status-badge psb-aktif">
            <span class="psb-dot blink"></span>✅ Sedang Berlangsung
        </span>
        <?php if($progSelesai): ?>
            <span style="font-size:12px;color:var(--text-muted)">Berakhir dalam</span>
            <span class="program-countdown aktif" id="prog-timer-<?php echo e($k->id); ?>">--:--:--</span>
            <span style="font-size:11px;color:var(--text-muted);margin-left:4px">
                (s/d <?php echo e($progSelesai->translatedFormat('d M Y, H:i')); ?> WIB)
            </span>
        <?php else: ?>
            <span style="font-size:12px;color:var(--text-muted)">
                Dimulai <?php echo e($progMulai->translatedFormat('d M Y, H:i')); ?> WIB · Tidak ada batas akhir
            </span>
        <?php endif; ?>

    <?php else: ?>
        <span class="program-status-badge psb-selesai">
            <span class="psb-dot"></span>🔒 Program Selesai
        </span>
        <span style="font-size:11px;color:var(--text-muted)">
            Berakhir <?php echo e($progSelesai->translatedFormat('d M Y, H:i')); ?> WIB
        </span>
    <?php endif; ?>

</div>
<?php endif; ?>

                    <?php if($absensiAktif): ?>
                    <div class="absensi-bar absensi-<?php echo e($statusAbsensi); ?>"
                        id="absensi-bar-<?php echo e($k->id); ?>"
                        data-mulai="<?php echo e($absensiMulai ? $absensiMulai->timestamp : 0); ?>"
                        data-selesai="<?php echo e($absensiSelesai ? $absensiSelesai->timestamp : 0); ?>"
                        data-url="<?php echo e($absensiUrl); ?>">
                        <?php if($statusAbsensi === 'active'): ?>
                            <div class="absensi-label"><span class="absensi-dot"></span>Absensi Sedang Berlangsung</div>
                            <a href="<?php echo e($absensiUrl); ?>" target="_blank" class="btn-absensi-live">✅ Buka Link Absensi</a>
                            <div class="absensi-countdown">
                                <span style="color:var(--text-muted);font-size:11px">Berakhir dalam</span>
                                <span class="countdown-timer" id="timer-<?php echo e($k->id); ?>">--:--:--</span>
                            </div>
                        <?php elseif($statusAbsensi === 'upcoming'): ?>
                            <div style="font-size:20px">⏰</div>
                            <div>
                                <div class="absensi-label" style="color:#92400e">Absensi Akan Dibuka</div>
                                <div class="absensi-schedule-info"><?php echo e($absensiMulai->translatedFormat('d M Y, H:i')); ?> – <?php echo e($absensiSelesai->format('H:i')); ?> WIB</div>
                            </div>
                            <div class="absensi-countdown" style="margin-left:auto">
                                <span style="color:var(--text-muted);font-size:11px">Dibuka dalam</span>
                                <span class="countdown-timer upcoming" id="timer-<?php echo e($k->id); ?>">--:--:--</span>
                            </div>
                        <?php else: ?>
                            <div style="font-size:18px">🔒</div>
                            <div>
                                <div class="absensi-label" style="color:var(--text-muted)">Absensi Telah Ditutup</div>
                                <div class="absensi-schedule-info">Selesai <?php echo e($absensiSelesai->translatedFormat('d M Y, H:i')); ?> WIB</div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                

                    <?php if($modulDalamK->count() > 0): ?>
                    <div class="modul-list">
                        <?php $__currentLoopData = $modulDalamK; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="modul-row">
                            <div style="width:32px;height:32px;border-radius:50%;background:var(--accent);color:#fff;font-size:13px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?php echo e($m->urutan ?? $loop->iteration); ?></div>
                            <div class="modul-info">
                                <div class="modul-title"><?php echo e($m->judul); ?></div>
                                <?php if($m->deskripsi): ?><div class="modul-meta"><?php echo e($m->deskripsi); ?></div><?php endif; ?>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;flex-shrink:0">
                                <?php if(($m->status ?? '') === 'approved'): ?>
                                    <span class="badge badge-approved" style="font-size:10px;padding:3px 8px"><span class="badge-dot"></span>Disetujui</span>
                                <?php elseif(($m->status ?? '') === 'rejected'): ?>
                                    <span class="badge badge-rejected" style="font-size:10px;padding:3px 8px"><span class="badge-dot"></span>Ditolak</span>
                                <?php else: ?>
                                    <span class="badge badge-pending" style="font-size:10px;padding:3px 8px"><span class="badge-dot"></span>Menunggu</span>
                                <?php endif; ?>
                                <button class="btn-icon" onclick="editModul(
        <?php echo e($m->id); ?>,
        <?php echo e($m->kurikulum_id ?? 'null'); ?>,
        '<?php echo e(addslashes($m->judul)); ?>',
        '<?php echo e(addslashes($m->deskripsi ?? '')); ?>',
        '<?php echo e($m->urutan ?? $loop->iteration); ?>',
        '<?php echo e($m->materi_type ?? ''); ?>',
        '<?php echo e($m->materi_youtube ?? ''); ?>',
        '<?php echo e($m->materi_pdf ? asset('storage/'.$m->materi_pdf) : ''); ?>',
        '<?php echo e($m->materi_pdf ?? ''); ?>',
    '<?php echo e($m->akses_mulai ?? ''); ?>',
    '<?php echo e($m->akses_selesai ?? ''); ?>'
        
    )" title="Edit Modul">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </button>
                                <button class="btn-icon btn-icon-danger" onclick="hapusItem(<?php echo e($m->id); ?>, 'modul')" title="Hapus">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6M9 6V4h6v2"/></svg>
                                </button>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <div class="modul-list">
                        <div style="padding:20px 24px;font-size:13px;color:var(--text-muted);display:flex;align-items:center;gap:10px">
                            <span>📭</span> Belum ada modul.
                            <button class="btn btn-sm btn-outline" style="margin-left:4px" onclick="openModalModulDenganKurikulum(<?php echo e($k->id); ?>, '<?php echo e(addslashes($k->judul)); ?>')">Tambah sekarang</button>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(($k->status ?? '') === 'rejected' && $k->catatan_admin): ?>
                    <div style="padding:10px 16px;background:#fff0ed;border:1px solid #e76f5166;border-top:none;border-radius:0 0 var(--radius) var(--radius);font-size:12px;color:var(--accent2)">
                        <strong>Catatan Admin:</strong> <?php echo e($k->catatan_admin); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="table-wrap">
                    <div class="empty-state">
                        <div class="empty-icon">📚</div>
                        <h3>Belum ada kurikulum</h3>
                        <p>Mulai dengan membuat kurikulum, lalu tambahkan modul ke dalamnya.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="page-section" id="page-event">
            <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
            <div class="section-header">
                <div class="section-title">Event <span><?php echo e($totalEvent ?? 0); ?> total</span></div>
                <button class="btn btn-primary" onclick="openModal('modal-event')">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Event
                </button>
            </div>
            <?php if(isset($eventList) && $eventList->count() > 0): ?>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Nama Event</th><th>Lokasi</th><th>Tanggal</th><th>Kapasitas</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                        <?php $__currentLoopData = $eventList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $eTanggal      = \Carbon\Carbon::parse($event->tanggal)->format('Y-m-d');
                                $eWaktuMulai   = $event->waktu_mulai   ? \Carbon\Carbon::parse($event->waktu_mulai)->format('H:i')   : '';
                                $eWaktuSelesai = $event->waktu_selesai ? \Carbon\Carbon::parse($event->waktu_selesai)->format('H:i') : '';
                                $eGambar       = $event->gambar        ? asset('storage/' . $event->gambar) : '';
                            ?>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:flex-start;gap:10px;">
                                        <div style="width:42px;height:42px;border-radius:8px;overflow:hidden;background:#f0f0f0;flex-shrink:0;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:18px;">
                                            <?php if($event->gambar): ?>
                                                <img src="<?php echo e(asset('storage/' . $event->gambar)); ?>" alt="<?php echo e($event->judul); ?>" style="width:100%;height:100%;object-fit:cover;">
                                            <?php else: ?> 🎪 <?php endif; ?>
                                        </div>
                                        <div style="flex:1;min-width:0;">
                                            <div style="font-weight:600;font-size:13px;"><?php echo e($event->judul ?? $event->nama); ?></div>
                                            <?php if($event->status === 'rejected' && $event->catatan_admin): ?>
                                                <div style="margin-top:5px;background:#fff0ed;border:1px solid #e76f5166;border-radius:8px;padding:6px 10px;">
                                                    <div style="font-size:10px;font-weight:700;color:var(--accent2);text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">📋 Catatan Admin</div>
                                                    <div style="font-size:12px;color:#b45309;line-height:1.5;"><?php echo e($event->catatan_admin); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:13px;"><?php echo e($event->lokasi ?? '-'); ?></td>
                                <td style="font-size:13px;"><?php echo e(\Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y')); ?></td>
                                <td style="font-size:13px;"><?php echo e($event->kapasitas ?? '-'); ?></td>
                                <td>
                                <?php if(!empty($event->deleted_by_admin_at)): ?>
    <span class="badge" style="background:#f3f0ff;color:#7c3aed;border:1px solid #c4b5fd">
        <span class="badge-dot"></span>Dihapus Admin
    </span>
<?php elseif($event->status === 'approved'): ?>
    <span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>
<?php elseif($event->status === 'rejected'): ?>
    <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
<?php else: ?>
    <span class="badge badge-pending"><span class="badge-dot"></span>Menunggu</span>
<?php endif; ?>
                                </td>
                                <td>
    <div style="display:flex;gap:6px;align-items:center;">
        <?php if(empty($event->deleted_by_admin_at)): ?>
            <button class="btn-icon <?php echo e($event->status === 'rejected' ? 'btn-resubmit' : ''); ?>"
                style="<?php echo e($event->status === 'rejected' ? 'background:#fff0ed;border-color:#e76f51;color:#e76f51;' : ''); ?>"
                onclick="editEvent(<?php echo e($event->id); ?>,'<?php echo e(addslashes($event->judul ?? $event->nama)); ?>','<?php echo e($eTanggal); ?>','<?php echo e($eWaktuMulai); ?>','<?php echo e($eWaktuSelesai); ?>','<?php echo e(addslashes($event->lokasi ?? '')); ?>','<?php echo e($event->kapasitas ?? ''); ?>','<?php echo e(addslashes($event->biaya ?? '')); ?>','<?php echo e(addslashes($event->deskripsi ?? '')); ?>','<?php echo e($eGambar); ?>','<?php echo e($event->phone ?? auth()->user()->phone ?? ''); ?>')"
                title="<?php echo e($event->status === 'rejected' ? 'Edit & Kirim Ulang' : 'Edit'); ?>">
                <?php if($event->status === 'rejected'): ?>
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                <?php else: ?>
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                <?php endif; ?>
            </button>
            <button class="btn-icon btn-icon-danger" onclick="hapusEvent(<?php echo e($event->id); ?>)" title="Hapus">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6M9 6V4h6v2"/></svg>
            </button>
        <?php else: ?>
            <span style="font-size:11px;color:#7c3aed;font-style:italic">—</span>
        <?php endif; ?>
    </div>
</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="table-wrap">
                    <div class="empty-state">
                        <div class="empty-icon">📅</div>
                        <h3>Belum ada event</h3>
                        <p>Klik "Tambah Event" untuk mengajukan event baru.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
    <div class="page-section" id="page-ulasan">
        <div class="section-header">
            <div class="section-title">Ulasan dari Peserta <span><?php echo e($totalUlasan ?? 0); ?> ulasan</span></div>
        </div>

        <?php
            $ulasanTrainer = isset($trainer) ? \App\Models\TrainerUlasan::where('trainer_id', $trainer->user_id ?? auth()->id())
                ->with('user')->latest()->get() : collect();
            $avgRatingTrainer = $ulasanTrainer->count() ? round($ulasanTrainer->avg('rating'), 1) : 0;
        ?>

        <?php if($ulasanTrainer->isEmpty()): ?>
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)">
                <div class="empty-state">
                    <div class="empty-icon">💬</div>
                    <h3>Belum ada ulasan</h3>
                    <p>Ulasan dari peserta pelatihan Anda akan tampil di sini setelah mereka memberikan penilaian.</p>
                </div>
            </div>
        <?php else: ?>
            
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px;margin-bottom:24px;box-shadow:var(--shadow);display:flex;align-items:center;gap:32px;flex-wrap:wrap">
                <div style="text-align:center;flex-shrink:0">
                    <div style="font-size:52px;font-weight:800;color:var(--text);line-height:1"><?php echo e(number_format($avgRatingTrainer, 1)); ?></div>
                    <div style="color:#f59e0b;font-size:22px;margin:6px 0">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php echo e($i <= round($avgRatingTrainer) ? '★' : '☆'); ?>

                        <?php endfor; ?>
                    </div>
                    <div style="font-size:12px;color:var(--text-muted)"><?php echo e($ulasanTrainer->count()); ?> ulasan</div>
                </div>
                <div style="flex:1;min-width:200px">
                    <?php for($star = 5; $star >= 1; $star--): ?>
                    <?php
                        $count = $ulasanTrainer->where('rating', $star)->count();
                        $pct   = $ulasanTrainer->count() ? round($count / $ulasanTrainer->count() * 100) : 0;
                    ?>
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
                        <span style="font-size:12px;color:var(--text-muted);width:14px;text-align:right"><?php echo e($star); ?></span>
                        <span style="color:#f59e0b;font-size:13px">★</span>
                        <div style="flex:1;height:8px;background:var(--surface2);border-radius:20px;overflow:hidden">
                            <div style="height:100%;width:<?php echo e($pct); ?>%;background:#f59e0b;border-radius:20px;transition:width .5s"></div>
                        </div>
                        <span style="font-size:11px;color:var(--text-muted);width:28px"><?php echo e($count); ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            
            <div style="display:flex;flex-direction:column;gap:12px">
                <?php $__currentLoopData = $ulasanTrainer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:16px 18px;box-shadow:var(--shadow)">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:10px">
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:36px;height:36px;border-radius:10px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:var(--accent);flex-shrink:0">
                                <?php echo e(strtoupper(substr($ulasan->user?->name ?? 'A', 0, 2))); ?>

                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:600;color:var(--text)"><?php echo e($ulasan->user?->name ?? 'Anonim'); ?></div>
                                <div style="font-size:11px;color:var(--text-muted)"><?php echo e(\Carbon\Carbon::parse($ulasan->created_at)->translatedFormat('d M Y')); ?></div>
                            </div>
                        </div>
                        <div style="background:var(--surface2);padding:4px 10px;border-radius:20px;font-size:12px;font-weight:700;color:#f59e0b;border:1px solid #fcd34d66;flex-shrink:0">
                            ★ <?php echo e($ulasan->rating); ?>.0
                        </div>
                    </div>

                    <div style="color:#f59e0b;font-size:14px;letter-spacing:1px;margin-bottom:8px">
                        <?php for($i = 1; $i <= 5; $i++): ?><?php echo e($i <= $ulasan->rating ? '★' : '☆'); ?><?php endfor; ?>
                    </div>

                    <div style="background:var(--surface2);border-radius:10px;padding:12px 14px;border-left:3px solid var(--accent)">
                        <?php if($ulasan->komentar && trim($ulasan->komentar) !== ''): ?>
                            <div style="font-size:13px;color:var(--text);line-height:1.7;font-style:italic">
                                "<?php echo e($ulasan->komentar); ?>"
                            </div>
                        <?php else: ?>
                            <div style="font-size:12px;color:var(--text-muted);font-style:italic;display:flex;align-items:center;gap:6px">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                                Tidak ada komentar tertulis dari peserta ini.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <ul style="margin:0;padding-left:16px">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
<div class="page-section <?php echo e($activePage === 'deleted' ? 'active' : ''); ?>" id="page-deleted">

    <div class="section-header">
        <div>
            <div class="section-title">Program Dihapus Admin</div>
            <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">
                Program di bawah ini dihapus oleh admin. Anda bisa memulihkannya — program akan dikirim ulang sebagai pending.
            </p>
        </div>
    </div>

    <?php if($deletedLogs->isEmpty()): ?>
        <div class="empty-state">
            <div class="empty-icon">🗑️</div>
            <h3>Tidak ada program yang dihapus</h3>
            <p>Semua program Anda masih aktif.</p>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Judul Program</th>
                        <th>Tipe</th>
                        <th>Dihapus Pada</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $deletedLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="<?php echo e(!$log->is_read ? 'background:#fff8f0;' : ''); ?>">
                        <td>
                            <strong><?php echo e($log->program_title); ?></strong>
                            <?php if(!$log->is_read): ?>
                                <span class="badge" style="background:#fff3ed;color:#e76f51;border:1px solid #e76f5133;font-size:10px;margin-left:6px;">Baru</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span style="text-transform:capitalize;"><?php echo e($log->program_tipe ?? '-'); ?></span>
                        </td>
                        <td>
                            <?php echo e($log->deleted_at_by_admin
                                ? $log->deleted_at_by_admin->translatedFormat('d M Y, H:i')
                                : '-'); ?>

                        </td>
                        <td>
                            <span class="badge badge-rejected">
                                <span class="badge-dot"></span>Dihapus Admin
                            </span>
                        </td>
                        <td>
    <button type="button"
        class="btn btn-primary btn-sm"
        onclick="bukaModalPulihkan(
            <?php echo e($log->id); ?>,
            '<?php echo e(addslashes($log->program_title)); ?>',
            '<?php echo e(ucfirst($log->program_tipe ?? 'program')); ?>',
            '<?php echo e($log->deleted_at_by_admin?->translatedFormat('d M Y, H:i')); ?>'
        )">
        ♻️ Pulihkan
    </button>
</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>


<div class="page-section <?php echo e(isset($activePage) && $activePage === 'deleted-event' ? 'active' : ''); ?>" id="page-deleted-event">
    <div class="section-header">
        <div>
            <div class="section-title">Event Dihapus Admin</div>
            <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">
                Event di bawah ini dihapus oleh admin. Anda bisa memulihkannya — event akan dikirim ulang sebagai pending.
            </p>
        </div>
    </div>

    <?php if(!isset($deletedEventLogs) || $deletedEventLogs->isEmpty()): ?>
        <div class="empty-state">
            <div class="empty-icon">🗑️</div>
            <h3>Tidak ada event yang dihapus</h3>
            <p>Semua event Anda masih aktif.</p>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama Event</th>
                        <th>Tanggal Event</th>
                        <th>Dihapus Pada</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $deletedEventLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="<?php echo e(!$log->is_read ? 'background:#f0f4ff;' : ''); ?>">
                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                <div style="font-size:20px;flex-shrink:0">🎪</div>
                                <div>
                                    <strong><?php echo e($log->event_title); ?></strong>
                                    <?php if(!$log->is_read): ?>
                                        <span class="badge" style="background:#dbeafe;color:#1d4ed8;border:1px solid #bfdbfe;font-size:10px;margin-left:6px;">Baru</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;color:var(--text-muted);">
                            <?php echo e($log->event_tanggal ? \Carbon\Carbon::parse($log->event_tanggal)->translatedFormat('d M Y') : '-'); ?>

                        </td>
                        <td>
                            <?php echo e($log->deleted_at_by_admin
                                ? $log->deleted_at_by_admin->translatedFormat('d M Y, H:i')
                                : '-'); ?>

                        </td>
                        <td>
                            <span class="badge badge-rejected">
                                <span class="badge-dot"></span>Dihapus Admin
                            </span>
                        </td>
                        <td>
                            <button type="button"
                                class="btn btn-secondary btn-sm"
                                onclick="bukaModalPulihkanEvent(
                                    <?php echo e($log->id); ?>,
                                    '<?php echo e(addslashes($log->event_title)); ?>',
                                    '<?php echo e($log->deleted_at_by_admin?->translatedFormat('d M Y, H:i')); ?>'
                                )">
                                ♻️ Pulihkan
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
        
        <div class="page-section" id="page-profil">
            <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
            <div class="profile-hero">
            <div class="profile-avatar-xl">
            <?php $fotoHero = $trainer?->foto ?? null; ?>
    <?php if($fotoHero): ?>
        <img src="<?php echo e(asset('storage/' . $fotoHero)); ?>" alt="<?php echo e(auth()->user()->name); ?>">
    <?php else: ?>
        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

    <?php endif; ?>
    </div>
                <div class="profile-hero-info">
                    <h2><?php echo e(auth()->user()->name); ?></h2>
                    <p>Trainer · Bergabung sejak <?php echo e(\Carbon\Carbon::parse(auth()->user()->created_at)->translatedFormat('F Y')); ?></p>
                </div>
                <button class="btn" style="background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.3);margin-left:auto" onclick="openModal('modal-profil')">Edit Profil</button>
            </div>
            <div class="profile-form-card">
        <div class="form-row">
            <div class="form-group">
                <div class="form-label">Nama Lengkap</div>
                <div class="form-static"><?php echo e(auth()->user()->name); ?></div>
            </div>
            <div class="form-group">
                <div class="form-label">Nama & Gelar (Publik)</div>
                <div class="form-static"><?php echo e($trainer?->academic_degree ?? auth()->user()->name); ?></div>
                <div class="form-hint">Yang tampil di halaman daftar trainer</div>
            </div>
            <div class="form-group">
                <div class="form-label">Email</div>
                <div class="form-static"><?php echo e(auth()->user()->email); ?></div>
            </div>
            <div class="form-group">
                <div class="form-label">No. Telepon / WhatsApp</div>
                <div class="form-static" style="display:flex;align-items:center;gap:8px">
                    <?php if(auth()->user()->phone): ?>
                        <span style="color:#25d366">✓</span> <?php echo e(auth()->user()->phone); ?>

                    <?php else: ?>
                        <span style="color:var(--text-muted);font-style:italic">Belum diisi</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group" style="grid-column: 1 / -1">
                <div class="form-label">Bidang Keahlian Ditampilkan</div>
                <?php
                    $keahlianList = array_values(array_filter(
                        array_map('trim', explode(',', $trainer?->keahlian ?? ''))
                    ));
                ?>
                <div class="form-static">
                    <?php echo e($trainer?->displayed_bidang ?? ($keahlianList[0] ?? '-')); ?>

                </div>
                <div class="form-hint">Klik "Edit Profil" untuk mengubah.</div>
            </div>
        </div>
        <div class="form-group">
        <div class="form-label">Bio / Tentang Saya</div>
        <div class="form-static" style="min-height:80px;line-height:1.7">
            <?php echo e($trainer?->bio ?? 'Belum ada bio.'); ?>

        </div>
    </div>

    <hr class="form-divider">
    <div class="form-section-title">Lokasi & Media Sosial</div>

    <div class="form-group">
        <div class="form-label">Alamat / Lokasi</div>
        <div class="form-static" style="display:flex;align-items:flex-start;gap:10px">
            <span style="font-size:16px;flex-shrink:0;margin-top:1px">📍</span>
            <span><?php echo e($trainer?->lokasi ?? '-'); ?></span>
        </div>
    </div>
               
    
    
<?php
$sosmedIcons = [
    'instagram' => '<svg viewBox="0 0 24 24" width="20" height="20"><defs><radialGradient id="ig2" cx="30%" cy="107%" r="150%"><stop offset="0%" stop-color="#ffd879"/><stop offset="40%" stop-color="#fd1d1d"/><stop offset="100%" stop-color="#833ab4"/></radialGradient></defs><rect x="2" y="2" width="20" height="20" rx="6" fill="url(#ig2)"/><circle cx="12" cy="12" r="4.5" stroke="white" stroke-width="1.5" fill="none"/><circle cx="17" cy="7" r="1.2" fill="white"/></svg>',
    'linkedin'  => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#0077B5"/><path d="M7.5 9.5H5v9h2.5v-9zm-1.25-4a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm3.75 4h2.4v1.24h.04c.33-.63 1.15-1.29 2.37-1.29 2.53 0 3 1.67 3 3.84v4.21H15.3v-3.73c0-.89-.02-2.03-1.24-2.03-1.24 0-1.43.97-1.43 1.97v3.79H10V9.5z" fill="white"/></svg>',
    'twitter'   => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#14171A"/><path d="M17.5 4h2.5l-5.4 6.2 6.4 8.3h-5l-3.9-5.1-4.5 5.1H5.1l5.8-6.6L4.5 4H9.6l3.5 4.6L17.5 4zm-.9 12.9h1.4L7.6 5.4H6.1l10.5 11.5z" fill="white"/></svg>',
    'youtube'   => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#FF0000"/><path d="M19.6 8.2s-.2-1.3-.8-1.9c-.7-.8-1.5-.8-1.9-.8C14.7 5.4 12 5.4 12 5.4s-2.7 0-4.9.1c-.4 0-1.2.1-1.9.8-.6.6-.8 1.9-.8 1.9S4.2 9.5 4.2 11v1.3c0 1.5.2 2.9.2 2.9s.2 1.3.8 1.9c.7.8 1.7.7 2.1.8C8.7 18 12 18 12 18s2.7 0 4.9-.2c.4 0 1.2-.1 1.9-.8.6-.6.8-1.9.8-1.9s.2-1.4.2-2.9V11c0-1.5-.2-2.8-.2-2.8zm-11.4 5.8V9.7l5.3 2.2-5.3 2.1z" fill="white"/></svg>',
    'facebook'  => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#1877F2"/><path d="M16 12h-2.5v7h-3v-7H9v-2.5h1.5v-1.6C10.5 6.1 11.5 5 13.4 5H16v2.5h-1.6c-.7 0-.9.4-.9.9v1.1H16L15.7 12z" fill="white"/></svg>',
];

$sosmedData2 = [];
if ($trainer && $trainer->sosmed) {
    $raw2 = $trainer->getRawOriginal('sosmed');
    $dec2 = is_string($raw2) ? json_decode($raw2, true) : $raw2;
    $sosmedData2 = is_array($dec2) ? $dec2 : [];
}

$sosmedCfg2 = [
    'instagram' => ['label'=>'Instagram', 'color'=>'#e1306c', 'bg'=>'#fff0f5', 'border'=>'#f9a8c9',
        'href'=>fn($v)=>'https://instagram.com/'.$v, 'display'=>fn($v)=>'@'.$v],
    'linkedin'  => ['label'=>'LinkedIn',  'color'=>'#0077b5', 'bg'=>'#e8f4fd', 'border'=>'#90caf9',
        'href'=>fn($v)=>str_starts_with($v,'http')?$v:'https://linkedin.com/in/'.$v,
        'display'=>fn($v)=>str_starts_with($v,'http')?(preg_match('/linkedin\.com\/in\/([^?\/\s]+)/i',$v,$mx)?'in/'.$mx[1]:'LinkedIn Profile'):'in/'.$v],
    'twitter'   => ['label'=>'Twitter / X','color'=>'#14171a', 'bg'=>'#f0f0f0', 'border'=>'#ccc',
        'href'=>fn($v)=>'https://twitter.com/'.ltrim($v,'@'), 'display'=>fn($v)=>'@'.ltrim($v,'@')],
    'youtube'   => ['label'=>'YouTube',   'color'=>'#ff0000', 'bg'=>'#fff0f0', 'border'=>'#ffb3b3',
        'href'=>fn($v)=>$v, 'display'=>fn($v)=>preg_match('/@([^\/\?]+)/i',$v,$mx)?'@'.$mx[1]:'YouTube Channel'],
    'facebook'  => ['label'=>'Facebook',  'color'=>'#1877F2', 'bg'=>'#e8f0fe', 'border'=>'#93c5fd',
        'href'=>fn($v)=>$v, 'display'=>fn($v)=>preg_match('/facebook\.com\/([^\/\?]+)/i',$v,$mx)?$mx[1]:'Facebook Page'],
];
?>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:10px;margin-bottom:18px">
    <?php $__currentLoopData = $sosmedCfg2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $val = $sosmedData2[$key] ?? null; ?>
        <div style="display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:12px;
                    border:1.5px solid <?php echo e($val ? $cfg['border'] : 'var(--border)'); ?>;
                    background:<?php echo e($val ? $cfg['bg'] : 'var(--surface2)'); ?>">
            <div style="width:36px;height:36px;border-radius:10px;flex-shrink:0;display:flex;
                        align-items:center;justify-content:center;
                        background:<?php echo e($val ? '#fff' : 'var(--border)'); ?>;
                        border:1px solid <?php echo e($val ? $cfg['border'] : 'transparent'); ?>">
                <?php echo $sosmedIcons[$key]; ?>

            </div>
            <div style="min-width:0;flex:1">
                <div style="font-size:10px;font-weight:700;color:var(--text-muted);
                            text-transform:uppercase;letter-spacing:1px;margin-bottom:3px">
                    <?php echo e($cfg['label']); ?>

                </div>
                <?php if($val): ?>
                    <a href="<?php echo e($cfg['href']($val)); ?>" target="_blank"
                       style="font-size:13px;font-weight:600;color:<?php echo e($cfg['color']); ?>;
                              text-decoration:none;display:block;white-space:nowrap;
                              overflow:hidden;text-overflow:ellipsis"
                       title="<?php echo e($cfg['display']($val)); ?>">
                        <?php echo e($cfg['display']($val)); ?>

                    </a>
                <?php else: ?>
                    <span style="font-size:12px;color:#bbb;font-style:italic">Belum diisi</span>
                <?php endif; ?>
            </div>
            <?php if($val): ?>
                <a href="<?php echo e($cfg['href']($val)); ?>" target="_blank"
                   style="flex-shrink:0;color:<?php echo e($cfg['color']); ?>;opacity:.6;text-decoration:none">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                        <polyline points="15 3 21 3 21 9"/>
                        <line x1="10" y1="14" x2="21" y2="3"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    </div> 
    </div>
    </main>

    
    <div class="modal-overlay" id="modal-kurikulum">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <span id="modal-kurikulum-title-text">Tambah Kurikulum</span>
                    <small id="modal-kurikulum-subtitle">Isi detail kurikulum, modul dapat ditambah setelah kurikulum tersimpan</small>
                </div>
                <button class="modal-close" onclick="resetKurikulumModal(); closeModal('modal-kurikulum')">×</button>
            </div>
            <form id="form-kurikulum" method="POST" enctype="multipart/form-data" action="<?php echo e(route('trainer.kurikulum.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="tipe" value="kurikulum">
                <input type="hidden" name="_method" id="kurikulum-method" value="POST">
                <input type="hidden" name="kurikulum_edit_id" id="kurikulum-edit-id">

                <div class="form-group">
                    <label class="form-label">Nama Kurikulum <span style="color:var(--accent2)">*</span></label>
                    <input class="form-input" type="text" name="judul" id="k-judul" placeholder="Contoh: Kursus Digital Marketing Terapan..." required>
                </div>
                <div class="form-group">
                <label class="form-label">Deskripsi <span style="color:var(--accent2)">*</span></label>
    <textarea class="form-textarea" name="deskripsi" id="k-deskripsi" rows="3" placeholder="Jelaskan tujuan dan isi kurikulum ini..." maxlength="500" required></textarea>
                </div>

                <hr class="form-divider">
                <div class="form-section-title">Informasi Kurikulum</div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <div class="form-group">
                        <label class="form-label">Total Jam Pelajaran <span style="color:var(--accent2)">*</span></label>
                        <input class="form-input" type="number" name="total_jam" id="k-total-jam" placeholder="Contoh: 20" min="1" step="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Sesi <span style="color:var(--accent2)">*</span></label>
                        <input class="form-input" type="number" name="jumlah_sesi" id="k-jumlah-sesi" placeholder="Contoh: 5" min="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Ada Sertifikat?</label>
                    <div class="radio-group">
                        <div class="radio-option"><input type="radio" name="sertifikat" id="sertifikat-ya" value="1"><label for="sertifikat-ya">🏆 Ya, ada sertifikat</label></div>
                        <div class="radio-option"><input type="radio" name="sertifikat" id="sertifikat-tidak" value="0" checked><label for="sertifikat-tidak">Tidak ada sertifikat</label></div>
                    </div>
                </div>

                <hr class="form-divider">
                <div class="form-section-title">Informasi Tambahan</div>

                <div class="form-row">
                <div class="form-group">
                        <label class="form-label">Metode <span style="color:var(--accent2)">*</span></label>
                        <select class="form-select" name="metode" id="k-metode" onchange="toggleAlamat(this.value)" required>
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                            <option value="hybrid">Online & Offline / Hybrid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tingkat <span style="color:var(--accent2)">*</span></label>
                        <select class="form-select" name="tingkat" id="k-tingkat" required>
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="pemula">Pemula</option>
                            <option value="menengah">Menengah</option>
                            <option value="lanjut">Lanjut</option>
                        </select>
                    </div>
                </div>

                
                <div class="form-group" id="k-alamat-group">
                    <label class="form-label">Alamat Lokasi</label>
                    <textarea class="form-textarea" name="alamat" id="k-alamat" rows="2"
                        placeholder="Contoh: Jl. Raya Darmo No. 45, Surabaya"></textarea>
                    <div class="form-hint">Alamat tempat pelatihan offline/hybrid berlangsung</div>
                </div>

                <div class="form-group">
                    <label class="form-label">No. WhatsApp untuk Pendaftaran <span style="color:var(--accent2)">*</span></label>
                    <input class="form-input" type="text" name="phone" id="k-phone"
                        value="<?php echo e(auth()->user()->phone ?? ''); ?>"
                        placeholder="Contoh: 6281234567890"
                        pattern="^[0-9]{9,15}$"
                        title="Masukkan nomor WhatsApp valid (9–15 digit angka)"
                        required>
                    <div class="form-hint">Otomatis diisi dari profil. Ubah jika ingin nomor berbeda untuk kurikulum ini.</div>
                </div>

                <div class="form-row">
        <div class="form-group">
            <label class="form-label">Bahasa <span style="color:var(--accent2)">*</span></label>
            <input class="form-input" type="text" name="bahasa" id="k-bahasa"
                value="Bahasa Indonesia" placeholder="Contoh: Bahasa Indonesia" required>
        </div>
        <div class="form-group">
            <label class="form-label">Biaya <span style="color:var(--accent2)">*</span></label>
            <select class="form-select" name="biaya" id="k-biaya" required>
                <option value="" disabled selected>-- Pilih --</option>
                <option value="Gratis">Gratis</option>
                <option value="Berbayar">Berbayar</option>
            </select>
        </div>
    </div>

    <div class="form-group">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
                        <div class="form-label" style="margin-bottom:0">Poster Kurikulum <span style="color:var(--accent2)">*</span></div>
                        <span style="background:var(--accent-light);color:var(--accent);border:1px solid #a7d7c566;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:700;letter-spacing:.5px">📐 9 : 16 PORTRAIT</span>
                    </div>
                    <div style="display:flex;gap:16px;align-items:flex-start;flex-wrap:wrap">
                        
                        <label for="k-gambar" id="k-gambar-area"
                            style="position:relative;width:120px;flex-shrink:0;border:2px dashed #2d6a4f66;border-radius:14px;background:#faf8f5;cursor:pointer;transition:all .2s;overflow:hidden;display:block"
                            onmouseover="this.style.borderColor='var(--accent)';this.style.background='#eef8f1'"
                            onmouseout="this.style.borderColor='#2d6a4f66';this.style.background='#faf8f5'">
                            
                            <div style="padding-top:177.78%"></div>
                            
                            <div id="k-gambar-placeholder"
                                style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;padding:12px;text-align:center">
                                <div style="font-size:28px">🖼️</div>
                                <div style="font-size:11px;color:var(--text-muted);line-height:1.5">Upload<br><span style="color:var(--accent);font-weight:700">PNG / JPG</span></div>
                            </div>
                            
                            <img id="k-gambar-preview" src="" alt="preview"
                                style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
                            
                            <div id="k-gambar-overlay"
                                style="display:none;position:absolute;inset:0;background:rgba(0,0,0,.5);border-radius:12px;z-index:2;flex-direction:column;align-items:center;justify-content:center;gap:4px">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                                    <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/>
                                    <circle cx="12" cy="13" r="4"/>
                                </svg>
                                <span style="font-size:10px;font-weight:700;color:#fff">Ganti</span>
                            </div>
                        </label>
                        
                        <div style="flex:1;min-width:150px">
                            <div style="background:#fffbea;border:1px solid #fcd34d66;border-radius:10px;padding:11px 13px;font-size:12px;color:#92400e;line-height:1.8;margin-bottom:8px">
                                <strong>📐 Wajib rasio 9:16 (portrait)</strong><br>
                                Ukuran yang disarankan:<br>
                                • <strong>1080 × 1920</strong> px (Full HD)<br>
                                • <strong>720 × 1280</strong> px<br>
                                • <strong>540 × 960</strong> px
                            </div>
                            <div class="upload-fname" id="k-gambar-name" style="font-size:12px;word-break:break-word"></div>
                            <div id="k-gambar-error"
                                style="display:none;font-size:11px;color:var(--accent2);background:#fff0ed;border:1px solid #e76f5166;border-radius:8px;padding:8px 10px;margin-top:6px;line-height:1.5">
                                ⚠️ Gambar harus portrait <strong>9:16</strong>.<br>Contoh ukuran: 1080×1920 px.
                            </div>
                        </div>
                    </div>
                    <input type="file" id="k-gambar" name="gambar" accept="image/*" style="display:none"
                        onchange="onKurikulumGambarChange(this)">
                </div>

                <hr class="form-divider">
<div class="form-section-title">📅 Status Pembukaan Program</div>
<div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:12px;padding:14px 16px;margin-bottom:16px;font-size:12px;color:#0369a1;line-height:1.7">
    <strong>ℹ️ Opsional.</strong> Atur tanggal mulai &amp; selesai program agar peserta tahu kapan program dibuka. 
    Sistem akan otomatis menampilkan label <strong>Belum Dibuka</strong>, <strong>Sedang Berlangsung</strong>, atau <strong>Selesai</strong> beserta countdown.
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
    <div class="form-group">
        <label class="form-label">Program Dibuka</label>
        <input class="form-input" type="datetime-local" name="program_mulai" id="k-program-mulai">
        <div class="form-hint">Tanggal &amp; jam program mulai</div>
    </div>
    <div class="form-group">
        <label class="form-label">Program Ditutup / Selesai</label>
        <input class="form-input" type="datetime-local" name="program_selesai" id="k-program-selesai">
        <div class="form-hint">Kosongkan jika tidak ada batas waktu</div>
    </div>
</div>
                <hr class="form-divider">
                <div class="absensi-toggle-section">
                    <div class="absensi-toggle-header" onclick="toggleAbsensiSection()">
                        <div class="absensi-toggle-header-left">
                            <span style="font-size:18px">✅</span>
                            <div>
                                <div style="font-size:13px;font-weight:700">Tombol Absensi Otomatis</div>
                                <div style="font-size:11px;font-weight:400;color:var(--text-muted);margin-top:2px">Atur jadwal buka & tutup absensi</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px">
                            <label class="switch" onclick="event.stopPropagation()">
                                <input type="checkbox" id="k-absensi-aktif" name="absensi_aktif" value="1" onchange="toggleAbsensiSection(this.checked)">
                                <span class="switch-slider"></span>
                            </label>
                            <svg id="absensi-chevron" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="color:var(--text-muted);transition:transform .2s"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                    </div>
                    <div class="absensi-toggle-body" id="absensi-body">
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label">Waktu Mulai Absensi <span style="color:var(--accent2)">*</span></label>
                                <input class="form-input" type="datetime-local" name="absensi_mulai" id="k-absensi-mulai">
                                <div class="form-hint">Tombol absensi muncul mulai jam ini</div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label">Waktu Selesai Absensi <span style="color:var(--accent2)">*</span></label>
                                <input class="form-input" type="datetime-local" name="absensi_selesai" id="k-absensi-selesai">
                                <div class="form-hint">Tombol absensi hilang otomatis jam ini</div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:14px;margin-bottom:0">
                            <label class="form-label">Link / URL Absensi</label>
                            <input class="form-input" type="url" name="absensi_url" id="k-absensi-url" placeholder="https://forms.gle/...">
                            <div class="form-hint">Kosongkan untuk menggunakan halaman absensi bawaan sistem.</div>
                        </div>
                        <div id="absensi-preview" style="display:none;margin-top:14px;background:#f0f9f4;border:1px solid #a7d7c566;border-radius:10px;padding:12px 16px">
                            <div style="font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:8px">Preview tombol absensi</div>
                            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
                                <div style="display:flex;align-items:center;gap:6px;font-size:12px;font-weight:600;color:var(--accent)">
                                    <span style="width:8px;height:8px;border-radius:50%;background:var(--accent);display:inline-block"></span>Absensi Berlangsung
                                </div>
                                <div style="background:var(--accent);color:#fff;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:700">✅ Buka Link Absensi</div>
                                <div style="font-size:12px;color:var(--text-muted)">Berakhir dalam <strong id="absensi-preview-dur" style="color:var(--accent)">–</strong></div>
                            </div>
                            <div id="absensi-preview-schedule" style="font-size:11px;color:var(--text-muted);margin-top:8px"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" onclick="resetKurikulumModal(); closeModal('modal-kurikulum')">Batal</button>
                    <button type="submit" class="btn btn-primary" id="kurikulum-submit-btn">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <span id="kurikulum-submit-text">Kirim untuk Disetujui</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="modal-overlay" id="modal-modul">
        <div class="modal" style="width:560px">
            <div class="modal-header">
                <div class="modal-title">
                    <span id="modal-modul-title-text">Tambah Modul Pembelajaran</span>
                    <small id="modal-modul-subtitle">Modul tampil sebagai daftar bernomor di halaman kurikulum</small>
                </div>
                <button class="modal-close" onclick="resetModulModal(); closeModal('modal-modul')">×</button>
            </div>

            <?php $adaKurikulum = isset($pelatihanList) && $pelatihanList->where('tipe','kurikulum')->count() > 0; ?>
            <?php if(!$adaKurikulum): ?>
            <div class="notice-box">
                <div style="font-size:22px;flex-shrink:0">⚠️</div>
                <div class="notice-text">
                    <strong>Belum ada kurikulum.</strong> Buat kurikulum terlebih dahulu.
                    <br><a href="#" onclick="closeModal('modal-modul'); openModal('modal-kurikulum')"
                        style="color:var(--accent);font-weight:700">Buat kurikulum sekarang →</a>
                </div>
            </div>
            <?php endif; ?>

            <form id="form-modul" method="POST" enctype="multipart/form-data"
                action="<?php echo e(route('trainer.modul.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="_method"      id="modul-method"   value="POST">
                <input type="hidden" name="modul_edit_id" id="modul-edit-id">
                <input type="hidden" name="tipe"          value="modul">
                
                <input type="hidden" name="materi_pdf_existing" id="m-materi-pdf-existing">

                
                <div style="display:grid;grid-template-columns:1fr 120px;gap:14px">
                    <div class="form-group">
                        <label class="form-label">Kurikulum <span style="color:var(--accent2)">*</span></label>
                        <select class="form-select" name="kurikulum_id" id="m-kurikulum-id"
                                required <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>>
                            <option value="">-- Pilih kurikulum --</option>
                            <?php if(isset($pelatihanList)): ?>
                                <?php $__currentLoopData = $pelatihanList->where('tipe','kurikulum'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k->id); ?>"><?php echo e($k->judul); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan <span style="color:var(--accent2)">*</span></label>
                        <input class="form-input" type="number" name="urutan" id="m-urutan"
                            placeholder="1" min="1" required <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>>
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Judul Modul <span style="color:var(--accent2)">*</span></label>
                    <input class="form-input" type="text" name="judul" id="m-judul"
                        placeholder="Contoh: Pengenalan Dunia UMKM"
                        required <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>>
                </div>

                
                <div class="form-group">
                <label class="form-label">Deskripsi Singkat <span style="color:var(--accent2)">*</span></label>
    <textarea class="form-textarea" name="deskripsi" id="m-deskripsi"
            rows="2" maxlength="300"
            placeholder="Ringkasan isi modul..."
            required
            <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>></textarea>
                </div>

                
                <hr class="form-divider">
                <div class="form-section-title">⏰ Jadwal Akses Modul</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <div class="form-group">
                        <label class="form-label">Akses Dibuka</label>
                        <input class="form-input" type="datetime-local" name="akses_mulai" id="m-akses-mulai"
                            <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>>
                        <div class="form-hint">Kosongkan = langsung bisa diakses</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Akses Ditutup</label>
                        <input class="form-input" type="datetime-local" name="akses_selesai" id="m-akses-selesai"
                            <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>>
                        <div class="form-hint">Kosongkan = tidak ada batas waktu</div>
                    </div>
                </div>

                
                <hr class="form-divider">
                <div class="form-section-title" style="display:flex;align-items:center;gap:8px">
                    📎 Materi Modul
                    <span style="font-size:11px;font-weight:400;color:var(--text-muted)">
                        — opsional, ditampilkan saat peserta membuka kelas
                    </span>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Jenis Materi</label>
                    <div style="display:flex;gap:10px">
                        
                        <label style="flex:1;cursor:pointer">
                            <input type="radio" name="materi_type" value=""
                                id="m-materi-none" checked
                                onchange="switchMateriType('')"
                                style="display:none">
                            <div class="materi-type-card" id="card-none">
                                <span style="font-size:20px">🚫</span>
                                <div style="font-size:12px;font-weight:600;margin-top:4px">Tidak ada</div>
                            </div>
                        </label>
                        
                        <label style="flex:1;cursor:pointer">
                            <input type="radio" name="materi_type" value="pdf"
                                id="m-materi-pdf-radio"
                                onchange="switchMateriType('pdf')"
                                style="display:none">
                            <div class="materi-type-card" id="card-pdf">
                                <span style="font-size:20px">📄</span>
                                <div style="font-size:12px;font-weight:600;margin-top:4px">Upload PDF</div>
                            </div>
                        </label>
                        
                        <label style="flex:1;cursor:pointer">
                            <input type="radio" name="materi_type" value="youtube"
                                id="m-materi-yt-radio"
                                onchange="switchMateriType('youtube')"
                                style="display:none">
                            <div class="materi-type-card" id="card-youtube">
                                <span style="font-size:20px">▶️</span>
                                <div style="font-size:12px;font-weight:600;margin-top:4px">Video YouTube</div>
                            </div>
                        </label>
                    </div>
                </div>

                
                <div id="panel-pdf" style="display:none">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">File PDF <span style="color:var(--accent2)">*</span></label>
                        <label id="pdf-upload-area"
                            style="display:flex;align-items:center;gap:14px;padding:16px;
                                    border:2px dashed #2d6a4f66;border-radius:12px;
                                    background:#fafbff;cursor:pointer;transition:all .2s"
                            onmouseover="this.style.borderColor='var(--accent)';this.style.background='#f0f9f4'"
                            onmouseout="this.style.borderColor='#2d6a4f66';this.style.background='#fafbff'"
                            for="m-materi-pdf-file">
                            <div style="width:44px;height:44px;border-radius:10px;background:#fee2e2;
                                        display:flex;align-items:center;justify-content:center;
                                        font-size:22px;flex-shrink:0">📄</div>
                            <div style="flex:1;min-width:0">
                                <div id="pdf-upload-label"
                                    style="font-size:13px;font-weight:600;color:var(--text)">
                                    Klik untuk memilih file PDF
                                </div>
                                <div id="pdf-upload-sub"
                                    style="font-size:11px;color:var(--text-muted);margin-top:2px">
                                    Maks. 20 MB · Format .pdf
                                </div>
                            </div>
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                stroke="var(--accent)" stroke-width="2">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </label>
                        <input type="file" id="m-materi-pdf-file" name="materi_pdf"
                            accept=".pdf" style="display:none"
                            onchange="onPdfChange(this)">
                        
                        <div id="pdf-existing-info" style="display:none;margin-top:8px;
                            padding:10px 14px;background:var(--accent-light);
                            border:1px solid #a7d7c566;border-radius:10px;
                            display:none;align-items:center;gap:10px">
                            <span style="font-size:18px">📄</span>
                            <div style="flex:1;font-size:12px">
                                <div style="font-weight:600;color:var(--accent)">PDF tersimpan</div>
                                <div style="color:var(--text-muted)">Upload file baru untuk mengganti</div>
                            </div>
                            <a id="pdf-existing-link" href="#" target="_blank"
                            style="font-size:12px;font-weight:600;color:var(--accent3);text-decoration:none">
                                Buka ↗
                            </a>
                        </div>
                    </div>
                </div>

                
                <div id="panel-youtube" style="display:none">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">URL Video YouTube <span style="color:var(--accent2)">*</span></label>
                        <input class="form-input" type="url" name="materi_youtube" id="m-materi-youtube"
                            placeholder="https://www.youtube.com/watch?v=..."
                            oninput="updateYoutubePreview(this.value)">
                        <div class="form-hint">Paste URL video YouTube (bisa video publik maupun unlisted)</div>
                        
                        <div id="yt-preview-wrap"
                            style="display:none;margin-top:10px;border-radius:12px;overflow:hidden;
                                    border:1px solid var(--border);position:relative">
                            <div style="position:relative;padding-top:56.25%;background:#000">
                                <img id="yt-thumbnail" src="" alt="thumbnail"
                                    style="position:absolute;inset:0;width:100%;height:100%;
                                            object-fit:cover;opacity:.85">
                                <div style="position:absolute;inset:0;display:flex;
                                            align-items:center;justify-content:center">
                                    <div style="width:52px;height:52px;border-radius:50%;
                                                background:rgba(255,0,0,.9);
                                                display:flex;align-items:center;justify-content:center">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                                            <polygon points="5,3 19,12 5,21"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div id="yt-video-title"
                                style="padding:8px 12px;font-size:12px;font-weight:600;
                                        background:var(--surface2);color:var(--text)">
                                Video terdeteksi ✓
                            </div>
                        </div>
                        <div id="yt-error"
                            style="display:none;margin-top:6px;font-size:11px;
                                    color:var(--accent2);background:#fff0ed;
                                    border:1px solid #e76f5166;border-radius:8px;padding:8px 12px">
                            ⚠️ URL tidak valid. Gunakan format: https://www.youtube.com/watch?v=XXXX
                        </div>
                    </div>
                </div>

                
                <?php if($adaKurikulum): ?>
                <div style="background:var(--surface2);border:1px solid var(--border);
                            border-radius:12px;padding:14px 16px;margin-top:18px">
                    <div style="font-size:11px;font-weight:700;color:var(--text-muted);
                                text-transform:uppercase;letter-spacing:1px;margin-bottom:10px">
                        Preview tampilan
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:12px;padding:10px 14px;
                                background:var(--surface);border:1px solid var(--border);border-radius:10px">
                        <div id="preview-num"
                            style="width:28px;height:28px;border-radius:50%;background:var(--accent);
                                    color:#fff;font-size:12px;font-weight:700;
                                    display:flex;align-items:center;justify-content:center;
                                    flex-shrink:0;margin-top:2px">1</div>
                        <div style="flex:1;min-width:0">
                            <div style="font-size:13px;font-weight:700;color:var(--accent)"
                                id="preview-judul">Judul modul...</div>
                            <div style="font-size:12px;color:var(--text-muted);margin-top:3px;line-height:1.5"
                                id="preview-desc">Deskripsi modul...</div>
                            <div id="preview-materi-badge" style="display:none;margin-top:6px">
                                <span id="preview-materi-tag"
                                    style="display:inline-flex;align-items:center;gap:5px;
                                            padding:3px 10px;border-radius:20px;font-size:11px;
                                            font-weight:600;background:#e3f0fa;color:var(--accent3);
                                            border:1px solid #bdd5ea">
                                    📎 Materi tersedia
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost"
                            onclick="resetModulModal(); closeModal('modal-modul')">Batal</button>
                    <button type="submit" class="btn btn-primary" id="modul-submit-btn"
                            <?php echo e(!$adaKurikulum ? 'disabled' : ''); ?>

                            style="<?php echo e(!$adaKurikulum ? 'opacity:.5;cursor:not-allowed' : ''); ?>">
                        <span id="modul-submit-text">Simpan Modul</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="modal-overlay" id="modal-event">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title" id="modal-event-title">Tambah Event</div>
                <button class="modal-close" onclick="resetEventModal(); closeModal('modal-event')">×</button>
            </div>
            <form id="form-event" method="POST" enctype="multipart/form-data" action="<?php echo e(route('trainer.event.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="_method" id="event-method" value="POST">
                <input type="hidden" name="event_id" id="event-id">
                <div class="form-group">
                    <label class="form-label">Nama Event <span style="color:var(--accent2)">*</span></label>
                    <input class="form-input" type="text" name="judul" id="event-judul" placeholder="Contoh: Festival Kuliner UMKM 2025" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal <span style="color:var(--accent2)">*</span></label>
                    <input class="form-input" type="date" name="tanggal" id="event-tanggal" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai</label>
                        <input class="form-input" type="time" name="waktu_mulai" id="event-waktu-mulai">
                        <div class="form-hint">Contoh: 08:00</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Selesai</label>
                        <input class="form-input" type="time" name="waktu_selesai" id="event-waktu-selesai">
                        <div class="form-hint">Contoh: 15:00</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input class="form-input" type="text" name="lokasi" id="event-lokasi" placeholder="Contoh: Gedung KAJI Indonesia, Surabaya">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kapasitas Peserta</label>
                        <input class="form-input" type="number" name="kapasitas" id="event-kapasitas" min="1" placeholder="Contoh: 100">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Biaya</label>
                        <input class="form-input" type="text" name="biaya" id="event-biaya" placeholder="Gratis / Rp 50.000">
                        <div class="form-hint">Kosongkan atau isi "Gratis" jika tidak berbayar</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">No. WhatsApp</label>
                    <input class="form-input" type="text" name="phone" id="event-phone" value="<?php echo e(auth()->user()->phone ?? ''); ?>" placeholder="Contoh: 6281234567890">
                    <div class="form-hint">Otomatis diisi dari profil. Ubah jika ingin nomor berbeda untuk event ini.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Event <span style="color:var(--accent2)">*</span></label>
                    <textarea class="form-textarea" name="deskripsi" id="event-deskripsi" rows="4" placeholder="Jelaskan detail event ini..." required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Gambar / Banner Event</label>
                    <label class="upload-area" for="event-gambar" id="event-upload-area">
                        <img id="event-gambar-preview" src="" alt="preview" style="display:none;width:100%;height:100%;object-fit:cover;border-radius:12px;position:absolute;top:0;left:0;">
                        <div class="upload-icon" id="event-upload-icon">🖼️</div>
                        <div class="upload-text" id="event-upload-text">Klik untuk upload atau <span>drag & drop</span><br>PNG, JPG hingga 5MB</div>
                        <div class="upload-fname" id="event-gambar-name"></div>
                    </label>
                    <input type="file" id="event-gambar" name="gambar" accept="image/*" style="display:none" onchange="onEventGambarChange(this)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" onclick="resetEventModal(); closeModal('modal-event')">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim untuk Disetujui</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="modal-overlay" id="modal-profil">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Edit Profil</div>
                <button class="modal-close" onclick="closeModal('modal-profil')">×</button>
            </div>
            <form method="POST" action="<?php echo e(route('trainer.profil.update')); ?>" enctype="multipart/form-data" autocomplete="off">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="form-row">
        <div class="form-group">
            <label class="form-label">Nama Lengkap *</label>
            <input class="form-input" type="text" name="name" value="<?php echo e(auth()->user()->name); ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Lengkap & Gelar Akademik</label>
            <input class="form-input" type="text" name="academic_degree"
                value="<?php echo e($trainer->academic_degree ?? auth()->user()->name); ?>"
                placeholder="Contoh: <?php echo e(auth()->user()->name); ?>, S.E., M.M.">
            <div class="form-hint">Yang tampil di halaman publik trainer</div>
        </div>
        <div class="form-group">
            <label class="form-label">Email *</label>
            <input class="form-input" type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">No. Telepon</label>
            <input class="form-input" type="text" name="phone" value="<?php echo e(auth()->user()->phone ?? ''); ?>">
        </div>
    </div>

    
    <div class="form-group">
        <label class="form-label">Bidang Keahlian</label>
        <?php
            $presets = [
                'Leadership & Manajemen', 'Public Speaking', 'Digital Marketing',
                'Keuangan & Akuntansi', 'SDM & HRD', 'Kewirausahaan',
                'Penjualan & Negosiasi', 'Komunikasi Bisnis', 'Pengembangan Diri',
                'Produktivitas & Time Management', 'Teknologi Informasi', 'Hukum Bisnis',
                'K3 & Safety', 'Ekspor Impor', 'Pemasaran Konten',
            ];
            $savedKeahlian = $trainer->keahlian ?? '';
            $savedArr = $savedKeahlian ? array_map('trim', explode(',', $savedKeahlian)) : [];
        ?>
        <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:10px" id="profil-chips">
            <?php $__currentLoopData = $presets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button"
                    class="profil-chip"
                    onclick="toggleProfilChip(this)"
                    style="padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;border:1.5px solid <?php echo e(in_array($preset, $savedArr) ? 'var(--accent)' : '#d1d5db'); ?>;background:<?php echo e(in_array($preset, $savedArr) ? 'var(--accent)' : '#f9fafb'); ?>;color:<?php echo e(in_array($preset, $savedArr) ? '#fff' : '#4b5563'); ?>;cursor:pointer;font-family:inherit;transition:all .15s">
                    <?php echo e($preset); ?>

                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px" id="profil-custom-tags">
            <?php $__currentLoopData = $savedArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!in_array($item, $presets) && $item !== ''): ?>
                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;background:#ede9fe;color:#5b21b6;border:1.5px solid #c4b5fd">
                        <?php echo e($item); ?>

                        <button type="button" onclick="removeProfilTag(this, '<?php echo e($item); ?>')"
                            style="background:none;border:none;cursor:pointer;font-size:15px;line-height:1;color:inherit;padding:0;opacity:.7">×</button>
                    </span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div style="display:flex;gap:8px;margin-bottom:6px">
            <input type="text" id="profil-custom-input" placeholder="Tambah keahlian lain..."
                class="form-input" style="flex:1"
                onkeydown="if(event.key==='Enter'){event.preventDefault();addProfilCustom();}">
            <button type="button" onclick="addProfilCustom()"
                    style="padding:9px 14px;font-size:12px;font-weight:600;color:#fff;background:var(--accent);border:none;border-radius:8px;cursor:pointer;font-family:inherit;white-space:nowrap">
                + Tambah
            </button>
        </div>
        <input type="hidden" name="bidang_keahlian" id="profil-keahlian-value" value="<?php echo e($savedKeahlian); ?>">
    <div style="font-size:11px;color:var(--text-muted)" id="profil-keahlian-counter">
        <span id="profil-keahlian-count"><?php echo e(count($savedArr)); ?></span> bidang dipilih
    </div>

    
    
    <div class="form-group" style="margin-top:14px;margin-bottom:0">
        <label class="form-label">Bidang yang Ditampilkan di Publik</label>
        <select name="displayed_bidang" id="profil-displayed-bidang" class="form-select">
            <?php $__currentLoopData = $savedArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($item); ?>"
                    <?php echo e(($trainer->displayed_bidang === $item) ? 'selected' : ''); ?>>
                    <?php echo e($item); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="form-hint">Bidang ini yang muncul di kartu trainer halaman publik.</div>
    </div>
    </div>

    <div class="form-group">
        <label class="form-label">Bio</label>
        <textarea class="form-textarea" name="bio"><?php echo e($trainer->bio ?? ''); ?></textarea>
    </div>

    <hr class="form-divider">
<div class="form-section-title">Lokasi & Media Sosial</div>


<div class="form-group">
    <label class="form-label">Alamat / Lokasi</label>
    <input class="form-input" type="text" name="lokasi"
        value="<?php echo e($trainer?->lokasi ?? ''); ?>"
        placeholder="Contoh: Surabaya, Jawa Timur">
</div>

<?php 
    $sosmedData = [];
    if ($trainer && $trainer->sosmed) {
        $raw = $trainer->getRawOriginal('sosmed');
        $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
        $sosmedData = is_array($decoded) ? $decoded : [];
    }

    $sosmedConfig = [
        'instagram' => [
            'label'   => 'Instagram',
            'icon'    => '📸',
            'color'   => '#e1306c',
            'bg'      => '#fff0f5',
            'border'  => '#f9a8c9',
            'prefix'  => '@',
            'href'    => fn($v) => 'https://instagram.com/' . $v,
            'display' => fn($v) => '@' . $v,
        ],
        'linkedin' => [
            'label'   => 'LinkedIn',
            'icon'    => '💼',
            'color'   => '#0077b5',
            'bg'      => '#e8f4fd',
            'border'  => '#90caf9',
            'prefix'  => '',
            'href'    => fn($v) => str_starts_with($v, 'http') ? $v : 'https://linkedin.com/in/' . $v,
            'display' => fn($v) => str_starts_with($v, 'http')
                ? (preg_match('/linkedin\.com\/in\/([^?\/\s]+)/i', $v, $m) ? 'in/' . $m[1] : 'LinkedIn Profile')
                : 'in/' . $v,
        ],
        'twitter' => [
            'label'   => 'Twitter / X',
            'icon'    => '𝕏',
            'color'   => '#14171a',
            'bg'      => '#f0f0f0',
            'border'  => '#ccc',
            'prefix'  => '@',
            'href'    => fn($v) => 'https://twitter.com/' . ltrim($v, '@'),
            'display' => fn($v) => '@' . ltrim($v, '@'),
        ],
        'youtube' => [
            'label'   => 'YouTube',
            'icon'    => '▶️',
            'color'   => '#ff0000',
            'bg'      => '#fff0f0',
            'border'  => '#ffb3b3',
            'prefix'  => '',
            'href'    => fn($v) => $v,
            'display' => fn($v) => preg_match('/@([^\/\?]+)/i', $v, $m) ? '@' . $m[1] : 'YouTube Channel',
        ],
        'facebook' => [
            'label'   => 'Facebook',
            'icon'    => '📘',
            'color'   => '#1877F2',
            'bg'      => '#e8f0fe',
            'border'  => '#93c5fd',
            'prefix'  => '',
            'href'    => fn($v) => $v,
            'display' => fn($v) => preg_match('/facebook\.com\/([^\/\?]+)/i', $v, $m) ? $m[1] : 'Facebook Page',
        ],
    ];
?>


<?php
$sosmedFields = [
    'instagram' => [
        'label'       => 'Instagram',
        'placeholder' => 'username (tanpa @)',
        'prefix'      => '@',
        'hint'        => 'Contoh: namaakun (tanpa @)',
    ],
    'linkedin' => [
        'label'       => 'LinkedIn',
        'placeholder' => 'URL profil atau username',
        'prefix'      => '',
        'hint'        => 'Contoh: https://linkedin.com/in/namaakun',
    ],
    'twitter' => [
        'label'       => 'Twitter / X',
        'placeholder' => 'username (tanpa @)',
        'prefix'      => '@',
        'hint'        => 'Contoh: namaakun (tanpa @)',
    ],
    'youtube' => [
        'label'       => 'YouTube',
        'placeholder' => 'URL channel YouTube',
        'prefix'      => '',
        'hint'        => 'Contoh: https://youtube.com/@namaakun',
    ],
    'facebook' => [
        'label'       => 'Facebook',
        'placeholder' => 'URL halaman Facebook',
        'prefix'      => '',
        'hint'        => 'Contoh: https://facebook.com/namaakun',
    ],
];

$sosmedData = [];
if ($trainer && $trainer->sosmed) {
    $raw = $trainer->getRawOriginal('sosmed');
    $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
    $sosmedData = is_array($decoded) ? $decoded : [];
}
?>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px">
    <?php $__currentLoopData = $sosmedFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $val = $sosmedData[$key] ?? ''; ?>
    <div class="form-group" style="margin-bottom:0">
        <label class="form-label" style="display:flex;align-items:center;gap:8px">
            <?php echo $sosmedIcons[$key]; ?>

            <?php echo e($field['label']); ?>

        </label>
        <div style="position:relative">
            <?php if($field['prefix']): ?>
                <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);
                             font-size:13px;font-weight:600;color:var(--text-muted);
                             pointer-events:none;z-index:1"><?php echo e($field['prefix']); ?></span>
                <input class="form-input" type="text"
                    name="sosmed[<?php echo e($key); ?>]"
                    value="<?php echo e($val); ?>"
                    placeholder="<?php echo e($field['placeholder']); ?>"
                    style="padding-left:28px">
            <?php else: ?>
                <input class="form-input" type="text"
                    name="sosmed[<?php echo e($key); ?>]"
                    value="<?php echo e($val); ?>"
                    placeholder="<?php echo e($field['placeholder']); ?>">
            <?php endif; ?>
        </div>
        <div class="form-hint"><?php echo e($field['hint']); ?></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    <div class="form-group">
        <label class="form-label">Foto Profil</label>
        <label class="upload-area" for="profil-foto" id="profil-foto-area"
            style="position:relative;overflow:hidden;min-height:110px">

            
            <?php $fotoAktif = $trainer?->foto ?? null; ?>
            <?php if($fotoAktif): ?>
                <img id="profil-foto-preview"
                    src="<?php echo e(asset('storage/' . $fotoAktif)); ?>"
                    alt="Foto Profil"
                    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
                <div id="profil-foto-overlay"
                    style="position:absolute;inset:0;background:rgba(0,0,0,.45);border-radius:12px;z-index:2;
                            display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                        <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                    <span style="font-size:12px;font-weight:600;color:#fff">Ganti Foto</span>
                    <div class="upload-fname" id="profil-foto-name" style="color:#fff;z-index:3"></div>
                </div>
            <?php else: ?>
                <div id="profil-foto-preview" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1"></div>
                <div id="profil-foto-overlay" style="display:none"></div>
                <div id="profil-foto-placeholder" style="display:flex;flex-direction:column;align-items:center;gap:8px">
                    <div class="upload-icon">📷</div>
                    <div class="upload-text">Klik untuk upload foto atau <span>drag & drop</span></div>
                </div>
                <div class="upload-fname" id="profil-foto-name"></div>
            <?php endif; ?>

        </label>
        <input type="file" id="profil-foto" name="foto" accept="image/*"
            style="display:none" onchange="onProfilFotoChange(this)">
        <div style="font-size:11px;color:var(--text-muted);margin-top:5px">JPG, PNG · Maks 2 MB</div>
    </div>
                <hr class="form-divider">
                <div class="form-group">
        <label class="form-label">Password Baru <span style="color:var(--text-muted);font-weight:400;text-transform:none;letter-spacing:0">(kosongkan jika tidak diubah)</span></label>
        <div style="position:relative">
        <input class="form-input" type="password" name="password" id="input-password-baru"
            placeholder="Min. 8 karakter" style="padding-right:44px"
            autocomplete="new-password">
            <button type="button" onclick="togglePassword('input-password-baru', 'eye-baru')"
                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-muted);padding:0;display:flex;align-items:center">
                <svg id="eye-baru" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </button>
        </div>
        <div style="font-size:11px;color:var(--text-muted);margin-top:5px">Min. 8 karakter, kombinasi huruf dan angka disarankan</div>
    </div>

    <div class="form-group">
        <label class="form-label">Konfirmasi Password Baru</label>
        <div style="position:relative">
        <input class="form-input" type="password" name="password_confirmation" id="input-password-confirm"
                placeholder="Ulangi password baru" style="padding-right:44px"
                autocomplete="new-password">
            <button type="button" onclick="togglePassword('input-password-confirm', 'eye-confirm')"
                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-muted);padding:0;display:flex;align-items:center">
                <svg id="eye-confirm" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </button>
        </div>
        <div id="password-match-hint" style="font-size:11px;margin-top:5px;display:none"></div>
    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" onclick="closeModal('modal-profil')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="modal-overlay" id="modal-absensi-daftar">
        <div class="modal" style="width:700px;max-width:95vw">
            <div class="modal-header">
                <div class="modal-title">
                    👥 Daftar Absensi
                    <small id="modal-abs-subtitle" style="display:block;margin-top:3px">–</small>
                </div>
                <button class="modal-close" onclick="closeModal('modal-absensi-daftar')">×</button>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:10px">
                <div style="display:flex;align-items:center;gap:8px">
                    <span style="font-size:13px;color:var(--text-muted)">Total hadir:</span>
                    <span id="abs-total-badge" style="background:var(--accent);color:#fff;font-size:12px;font-weight:700;padding:3px 12px;border-radius:20px">–</span>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn btn-sm btn-ghost" onclick="exportAbsensiCsv()" style="gap:6px">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export CSV
                    </button>
                    <button class="btn btn-sm btn-ghost" onclick="refreshAbsensi()" style="gap:6px">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
                        Refresh
                    </button>
                </div>
            </div>
            <div id="abs-loading" style="text-align:center;padding:44px;color:var(--text-muted);font-size:13px">⏳ Memuat data...</div>
            <div id="abs-table-wrap" style="display:none">
                <div class="table-wrap" style="margin-bottom:0;max-height:400px;overflow-y:auto">
                    <table>
                        <thead><tr><th style="width:48px">#</th><th>Nama</th><th>Email</th><th>Waktu Absen</th></tr></thead>
                        <tbody id="abs-tbody"></tbody>
                    </table>
                </div>
            </div>
            <div id="abs-empty" style="display:none;text-align:center;padding:50px 20px;color:var(--text-muted)">
                <div style="font-size:42px;margin-bottom:12px">📭</div>
                <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:6px">Belum ada yang absen</div>
                <div style="font-size:13px">Peserta akan muncul di sini saat absensi aktif</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" onclick="closeModal('modal-absensi-daftar')">Tutup</button>
            </div>
        </div>
    </div>

    
    <div class="modal-overlay" id="modal-peserta-daftar">
        <div class="modal" style="width:700px;max-width:95vw">
            <div class="modal-header">
                <div class="modal-title">
                    🎓 Daftar Peserta
                    <small id="modal-peserta-subtitle" style="display:block;margin-top:3px">–</small>
                </div>
                <button class="modal-close" onclick="closeModal('modal-peserta-daftar')">×</button>
            </div>

            
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:10px">
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
                    <span style="font-size:13px;color:var(--text-muted)">Total:</span>
                    <span id="peserta-total-badge"
                        style="background:#1d4ed8;color:#fff;font-size:12px;font-weight:700;padding:3px 12px;border-radius:20px">–</span>
                    <span id="peserta-diterima-badge"
                        style="background:var(--accent);color:#fff;font-size:12px;font-weight:700;padding:3px 12px;border-radius:20px">–</span>
                    <span id="peserta-pending-badge"
                        style="background:#f59e0b;color:#fff;font-size:12px;font-weight:700;padding:3px 12px;border-radius:20px">–</span>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn btn-sm btn-ghost" onclick="exportPesertaCsv()" style="gap:6px">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export CSV
                    </button>
                    <button class="btn btn-sm btn-ghost" onclick="refreshPeserta()" style="gap:6px">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <polyline points="23 4 23 10 17 10"/>
                            <path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>

            
            <div style="display:flex;gap:6px;margin-bottom:14px;border-bottom:1px solid var(--border);padding-bottom:10px">
                <button onclick="filterPeserta('semua')" id="tab-peserta-semua"
                    style="padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;border:1.5px solid #1d4ed8;background:#1d4ed8;color:#fff;cursor:pointer;font-family:inherit;transition:all .15s">
                    Semua
                </button>
                <button onclick="filterPeserta('diterima')" id="tab-peserta-diterima"
                    style="padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;border:1.5px solid var(--border);background:#f9fafb;color:#6b7280;cursor:pointer;font-family:inherit;transition:all .15s">
                    ✅ Diterima
                </button>
                <button onclick="filterPeserta('menunggu')" id="tab-peserta-menunggu"
                    style="padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;border:1.5px solid var(--border);background:#f9fafb;color:#6b7280;cursor:pointer;font-family:inherit;transition:all .15s">
                    ⏳ Menunggu
                </button>
                <button onclick="filterPeserta('ditolak')" id="tab-peserta-ditolak"
                    style="padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;border:1.5px solid var(--border);background:#f9fafb;color:#6b7280;cursor:pointer;font-family:inherit;transition:all .15s">
                    ✕ Ditolak
                </button>
            </div>

            <div id="peserta-loading" style="text-align:center;padding:44px;color:var(--text-muted);font-size:13px">
                ⏳ Memuat data...
            </div>

            <div id="peserta-table-wrap" style="display:none">
                <div class="table-wrap" style="margin-bottom:0;max-height:400px;overflow-y:auto">
                    <table>
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Bukti Bayar</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="peserta-tbody"></tbody>
                    </table>
                </div>
            </div>

            <div id="peserta-empty"
                style="display:none;text-align:center;padding:50px 20px;color:var(--text-muted)">
                <div style="font-size:42px;margin-bottom:12px">📭</div>
                <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:6px">Belum ada peserta</div>
                <div style="font-size:13px">Peserta yang mendaftar akan muncul di sini</div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-ghost" onclick="closeModal('modal-peserta-daftar')">Tutup</button>
            </div>
        </div>
    </div>

    <form id="form-hapus" method="POST" style="display:none"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
    <form id="form-hapus-event" method="POST" style="display:none"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>

    <script>

    /* ================================================================
TANDAI EVENT LOG SUDAH DIBACA
================================================================ */
function tandaiEventSudahDibaca() {
    fetch('/trainer/deleted-event-log/mark-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const wrap = document.getElementById('notif-deleted-event-wrap');
            if (wrap) {
                wrap.style.transition = 'opacity .3s';
                wrap.style.opacity = '0';
                setTimeout(() => wrap.remove(), 300);
            }
            const badge = document.getElementById('deleted-event-badge');
            if (badge) badge.remove();
        }
    })
    .catch(() => alert('Gagal menandai. Coba lagi.'));
}

/* ================================================================
MODAL PULIHKAN EVENT
================================================================ */
function bukaModalPulihkanEvent(logId, judul, tanggalHapus) {
    document.getElementById('pulihkan-event-judul').textContent = judul;
    document.getElementById('pulihkan-event-meta').textContent  =
        'Event · Dihapus ' + tanggalHapus + ' WIB';
    document.getElementById('form-pulihkan-event').action =
        '/trainer/deleted-event-log/' + logId + '/restore';
    openModal('modal-pulihkan-event');
}
    /* ================================================================
    DAFTAR PESERTA PENDAFTARAN
    ================================================================ */
    var _pesertaProgramId  = null;
    var _pesertaAllData    = [];
    var _pesertaFilterAktif = 'semua';

    function bukaDaftarPeserta(programId, judul) {
        _pesertaProgramId = programId;
        document.getElementById('modal-peserta-subtitle').textContent = judul;
        document.getElementById('peserta-total-badge').textContent    = '–';
        document.getElementById('peserta-diterima-badge').textContent = '– diterima';
        document.getElementById('peserta-pending-badge').textContent  = '– menunggu';
        document.getElementById('peserta-loading').style.display      = 'block';
        document.getElementById('peserta-table-wrap').style.display   = 'none';
        document.getElementById('peserta-empty').style.display        = 'none';
        _pesertaFilterAktif = 'semua';
        _setTabPeserta('semua');
        openModal('modal-peserta-daftar');
        _muatPeserta(programId);
    }

    function refreshPeserta() {
        if (_pesertaProgramId) _muatPeserta(_pesertaProgramId);
    }

    function _muatPeserta(programId) {
        document.getElementById('peserta-loading').style.display    = 'block';
        document.getElementById('peserta-table-wrap').style.display = 'none';
        document.getElementById('peserta-empty').style.display      = 'none';

        fetch('/trainer/program/' + programId + '/peserta', {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(r => r.json())
        .then(res => {
            document.getElementById('peserta-loading').style.display = 'none';
            if (!res.success) { alert('Gagal: ' + res.message); return; }

            _pesertaAllData = res.peserta;

            // Update badge summary
            const total    = res.peserta.length;
            const diterima = res.peserta.filter(p => p.status === 'diterima').length;
            const menunggu = res.peserta.filter(p => p.status === 'menunggu_verifikasi').length;

            document.getElementById('peserta-total-badge').textContent    = total + ' total';
            document.getElementById('peserta-diterima-badge').textContent = diterima + ' diterima';
            document.getElementById('peserta-pending-badge').textContent  = menunggu + ' menunggu';

            _renderPeserta(_pesertaFilterAktif);
        })
        .catch(() => {
            document.getElementById('peserta-loading').style.display = 'none';
            alert('Gagal terhubung ke server.');
        });
    }

    function filterPeserta(filter) {
        _pesertaFilterAktif = filter;
        _setTabPeserta(filter);
        _renderPeserta(filter);
    }

    function _setTabPeserta(aktif) {
        const tabs = {
            semua:    { bg: '#1d4ed8', border: '#1d4ed8', color: '#fff' },
            diterima: { bg: 'var(--accent)', border: 'var(--accent)', color: '#fff' },
            menunggu: { bg: '#f59e0b', border: '#f59e0b', color: '#fff' },
            ditolak:  { bg: '#ef4444', border: '#ef4444', color: '#fff' },
        };
        const defaultStyle = 'background:#f9fafb;border-color:var(--border);color:#6b7280';

        ['semua', 'diterima', 'menunggu', 'ditolak'].forEach(key => {
            const btn = document.getElementById('tab-peserta-' + key);
            if (!btn) return;
            if (key === aktif) {
                const s = tabs[key];
                btn.style.cssText = `padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;
                    border:1.5px solid ${s.border};background:${s.bg};color:${s.color};
                    cursor:pointer;font-family:inherit;transition:all .15s`;
            } else {
                btn.style.cssText = `padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;
                    border:1.5px solid var(--border);background:#f9fafb;color:#6b7280;
                    cursor:pointer;font-family:inherit;transition:all .15s`;
            }
        });
    }

    function _renderPeserta(filter) {
        let data = _pesertaAllData;
        if (filter === 'diterima') data = data.filter(p => p.status === 'diterima');
        else if (filter === 'menunggu') data = data.filter(p => p.status === 'menunggu_verifikasi');
        else if (filter === 'ditolak') data = data.filter(p => p.status === 'ditolak');

        if (data.length === 0) {
            document.getElementById('peserta-table-wrap').style.display = 'none';
            document.getElementById('peserta-empty').style.display      = 'block';
            return;
        }

        const tbody = document.getElementById('peserta-tbody');
        tbody.innerHTML = '';

        data.forEach((p, i) => {
            const statusBadge = p.status === 'diterima'
                ? `<span style="display:inline-flex;align-items:center;gap:4px;background:#e8f5e9;color:#2d6a4f;border:1px solid #a7d7c566;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600">
                        <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block"></span>Diterima
                </span>`
                : p.status === 'ditolak'
                ? `<span style="display:inline-flex;align-items:center;gap:4px;background:#fff0ed;color:#e76f51;border:1px solid #e76f5166;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600">
                        <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block"></span>Ditolak
                </span>`
                : `<span style="display:inline-flex;align-items:center;gap:4px;background:#fffbea;color:#f59e0b;border:1px solid #fcd34d66;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600">
                        <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block"></span>Menunggu
                </span>`;

            const buktiBayar = p.bukti_pembayaran
                ? `<a href="${p.bukti_pembayaran}" target="_blank"
                    style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;
                            font-size:11px;font-weight:600;background:var(--surface2);border:1px solid var(--border);
                            color:var(--text);text-decoration:none">
                    🖼️ Lihat
                </a>`
                : `<span style="font-size:12px;color:#9ca3af">— Gratis —</span>`;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="font-weight:600;color:var(--text-muted);width:40px">${i + 1}</td>
                <td>
                    <div style="font-weight:600;font-size:13px">${_esc(p.nama)}</div>
                    <div style="font-size:11px;color:var(--text-muted)">${_esc(p.email)}</div>
                </td>
                <td style="font-size:12px;color:var(--text-muted)">
                    ${_esc(p.no_hp)}
                    ${p.alamat ? `<div style="font-size:11px">${_esc(p.alamat)}</div>` : ''}
                </td>
                <td>${buktiBayar}</td>
                <td style="font-size:12px;color:var(--text-muted)">${_esc(p.tanggal_daftar)}</td>
                <td>${statusBadge}</td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('peserta-table-wrap').style.display = 'block';
        document.getElementById('peserta-empty').style.display      = 'none';
    }

    function exportPesertaCsv() {
        if (_pesertaProgramId) {
            window.location.href = '/trainer/program/' + _pesertaProgramId + '/peserta/export';
        }
    }
    /* ================================================================
    KURIKULUM GAMBAR — VALIDASI PORTRAIT 9:16
    ================================================================ */
    function onKurikulumGambarChange(input) {
        const errorEl  = document.getElementById('k-gambar-error');
        const nameEl   = document.getElementById('k-gambar-name');
        const preview  = document.getElementById('k-gambar-preview');
        const overlay  = document.getElementById('k-gambar-overlay');
        const pholder  = document.getElementById('k-gambar-placeholder');
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];

        // Validasi ukuran maks 5MB
        if (file.size > 5 * 1024 * 1024) {
            errorEl.innerHTML  = '⚠️ Ukuran file terlalu besar. Maks <strong>5 MB</strong>.';
            errorEl.style.display = 'block';
            nameEl.textContent = '';
            preview.style.display = 'none';
            overlay.style.display = 'none';
            pholder.style.display = 'flex';
            input.value = '';
            return;
        }

        const imgCheck = new Image();
        const url = URL.createObjectURL(file);
        imgCheck.onload = function () {
            URL.revokeObjectURL(url);
            const w = imgCheck.naturalWidth, h = imgCheck.naturalHeight;
            const ratio       = w / h;
            const targetRatio = 9 / 16;   // 0.5625
            const tolerance   = 0.06;     // toleransi ±6%
            const valid       = (h > w) && (Math.abs(ratio - targetRatio) / targetRatio <= tolerance);

            if (!valid) {
                errorEl.innerHTML  = '⚠️ Gambar harus <strong>portrait 9:16</strong>.<br>'
                    + 'Ukuran Anda: ' + w + '×' + h + ' px. '
                    + 'Contoh yang benar: 1080×1920 px.';
                errorEl.style.display = 'block';
                nameEl.textContent    = '';
                preview.style.display = 'none';
                overlay.style.display = 'none';
                pholder.style.display = 'flex';
                input.value = '';
                return;
            }

            // Gambar valid — tampilkan preview
            errorEl.style.display = 'none';
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src           = e.target.result;
                preview.style.display = 'block';
                overlay.style.display = 'flex';
                pholder.style.display = 'none';
                nameEl.innerHTML = '✅ <strong>' + file.name + '</strong><br>'
                    + '<span style="color:var(--text-muted)">' + w + '×' + h + ' px · '
                    + (file.size / 1024).toFixed(0) + ' KB</span>';
            };
            reader.readAsDataURL(file);
        };
        imgCheck.src = url;
    }

    function resetKurikulumGambarPreview() {
        const preview = document.getElementById('k-gambar-preview');
        const overlay = document.getElementById('k-gambar-overlay');
        const pholder = document.getElementById('k-gambar-placeholder');
        const nameEl  = document.getElementById('k-gambar-name');
        const errorEl = document.getElementById('k-gambar-error');
        if (preview) { preview.src = ''; preview.style.display = 'none'; }
        if (overlay) overlay.style.display = 'none';
        if (pholder) pholder.style.display = 'flex';
        if (nameEl)  nameEl.textContent = '';
        if (errorEl) errorEl.style.display = 'none';
    }
    /* ================================================================
    toggleAlamat — pisah antara "show/hide saja" vs "reset nilai"
    ================================================================ */
    function _setVisibilityAlamat(tampil) {
        var grup = document.getElementById('k-alamat-group');
        if (tampil) {
            grup.style.maxHeight    = '200px';
            grup.style.overflow     = 'visible';
            grup.style.opacity      = '1';
            grup.style.marginBottom = '18px';
        } else {
            grup.style.maxHeight    = '0';
            grup.style.overflow     = 'hidden';
            grup.style.opacity      = '0';
            grup.style.marginBottom = '0';
        }
    }

    // Dipanggil saat USER memilih metode dari dropdown — boleh kosongkan alamat
    function toggleAlamat(val) {
        var isOfflineOrHybrid = (val === 'offline' || val === 'hybrid');
        _setVisibilityAlamat(isOfflineOrHybrid);
        // Kosongkan alamat hanya jika user memilih online (bukan saat load data edit)
        if (!isOfflineOrHybrid) {
            document.getElementById('k-alamat').value = '';
        }
    }

    // Dipanggil saat LOAD DATA EDIT — tidak boleh mengosongkan nilai
    function _tampilkanAlamatTanpaReset(val) {
        var isOfflineOrHybrid = (val === 'offline' || val === 'hybrid');
        _setVisibilityAlamat(isOfflineOrHybrid);
        // TIDAK mengosongkan nilai
    }

    

    /* ================================================================
    SIDEBAR TOGGLE (MOBILE)
    ================================================================ */
    function toggleSidebar() {
        const sidebar  = document.querySelector('.sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
        document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
    }
    function closeSidebar() {
        document.querySelector('.sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('open');
        document.body.style.overflow = '';
    }

    /* ================================================================
    NAVIGASI
    ================================================================ */
    function showPage(id) {
    if (window.innerWidth <= 768) closeSidebar();
    document.querySelectorAll('.page-section').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    document.getElementById('page-' + id).classList.add('active');
    const titles = {
        beranda: 'Dashboard Trainer',
        program: 'Program / Pelatihan',
        event: 'Event',
        ulasan: 'Ulasan',
        deleted: 'Program Dihapus',
        'deleted-event': 'Event Dihapus',
        profil: 'Profil Saya',
    };
    document.getElementById('page-title').textContent = titles[id] || 'Dashboard';
    document.querySelectorAll('.nav-item').forEach(item => {
        if ((item.getAttribute('onclick') || '').includes("'" + id + "'")) item.classList.add('active');
    });

    if (id === 'deleted') {
        fetch('<?php echo e(route("trainer.deleted-log.mark-read")); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            const badge = document.getElementById('deleted-badge');
            if (badge) badge.remove();
        });
    }

    if (id === 'deleted-event') {
        fetch('/trainer/deleted-event-log/mark-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            const badge = document.getElementById('deleted-event-badge');
            if (badge) badge.remove();
        });
    }
}

    /* ================================================================
    MODAL HELPERS
    ================================================================ */
    function openModal(id)  { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }
    document.querySelectorAll('.modal-overlay').forEach(m => {
        m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
    });
    function showFileName(input, labelId) {
        const label = document.getElementById(labelId);
        if (input.files && input.files[0]) label.textContent = '✓ ' + input.files[0].name;
    }

    /* ================================================================
    ABSENSI TOGGLE
    ================================================================ */
    function toggleAbsensiSection(forceState) {
        const checkbox = document.getElementById('k-absensi-aktif');
        const body     = document.getElementById('absensi-body');
        const chevron  = document.getElementById('absensi-chevron');
        if (typeof forceState === 'boolean') {
            checkbox.checked = forceState;
        } else {
            checkbox.checked = !checkbox.checked;
        }
        const isOpen = checkbox.checked;
        body.classList.toggle('open', isOpen);
        chevron.style.transform = isOpen ? 'rotate(180deg)' : '';
        if (!isOpen) {
            document.getElementById('k-absensi-mulai').value   = '';
            document.getElementById('k-absensi-selesai').value = '';
            document.getElementById('k-absensi-url').value     = '';
            document.getElementById('absensi-preview').style.display = 'none';
        }
    }

    /* ================================================================
    ABSENSI PREVIEW
    ================================================================ */
    function updateAbsensiPreview() {
        const mulai   = document.getElementById('k-absensi-mulai').value;
        const selesai = document.getElementById('k-absensi-selesai').value;
        const preview = document.getElementById('absensi-preview');
        const durEl   = document.getElementById('absensi-preview-dur');
        const schEl   = document.getElementById('absensi-preview-schedule');
        if (!mulai || !selesai) { preview.style.display = 'none'; return; }
        const mDate = new Date(mulai);
        const sDate = new Date(selesai);
        if (sDate <= mDate) { preview.style.display = 'none'; return; }
        preview.style.display = 'block';
        const diffMin = Math.round((sDate - mDate) / 60000);
        if (diffMin < 60) { durEl.textContent = diffMin + ' menit'; }
        else {
            const h = Math.floor(diffMin / 60), m = diffMin % 60;
            durEl.textContent = h + ' jam' + (m ? ' ' + m + ' menit' : '');
        }
        const fmt = d => d.toLocaleDateString('id-ID', {day:'numeric',month:'short',year:'numeric'}) + ', ' + d.toLocaleTimeString('id-ID', {hour:'2-digit',minute:'2-digit'});
        schEl.textContent = 'Jadwal: ' + fmt(mDate) + ' – ' + fmt(sDate) + ' WIB';
    }

    /* ================================================================
    ABSENSI COUNTDOWN
    ================================================================ */
    function pad(n) { return String(n).padStart(2, '0'); }
    function formatCountdown(ms) {
        if (ms <= 0) return '00:00:00';
        const s = Math.floor(ms / 1000);
        const h = Math.floor(s / 3600), m = Math.floor((s % 3600) / 60), ss = s % 60;
        return h > 0 ? pad(h)+':'+pad(m)+':'+pad(ss) : pad(m)+':'+pad(ss);
    }
    /* ================================================================
PROGRAM STATUS COUNTDOWN
================================================================ */
function initProgramTimers() {
    document.querySelectorAll('[id^="prog-status-bar-"]').forEach(function(bar) {
        const tsMulai   = parseInt(bar.dataset.mulai,   10) * 1000;
        const tsSelesai = parseInt(bar.dataset.selesai, 10) * 1000;
        const status    = bar.dataset.status;
        const barId     = bar.id.replace('prog-status-bar-', '');
        const timerEl   = document.getElementById('prog-timer-' + barId);
        if (!timerEl) return; // selesai / tidak ada timer

        var ivId;
        function tick() {
            var now = Date.now();
            if (status === 'belum') {
                var ms = tsMulai - now;
                if (ms <= 0) { location.reload(); return; }
                timerEl.textContent = formatCountdown(ms);
            } else if (status === 'aktif' && tsSelesai > 0) {
                var ms = tsSelesai - now;
                if (ms <= 0) { location.reload(); return; }
                timerEl.textContent = formatCountdown(ms);
                timerEl.className = ms < 3600000
                    ? 'program-countdown warning'
                    : 'program-countdown aktif';
            } else {
                clearInterval(ivId);
            }
        }
        tick();
        ivId = setInterval(tick, 1000);
    });
}
    function initAbsensiTimers() {
        document.querySelectorAll('[id^="absensi-bar-"]').forEach(function(bar) {
            const tsMulai   = parseInt(bar.dataset.mulai, 10) * 1000;
            const tsSelesai = parseInt(bar.dataset.selesai, 10) * 1000;
            const timerId   = bar.id.replace('absensi-bar-', '');
            const timerEl   = document.getElementById('timer-' + timerId);
            if (!timerEl || isNaN(tsMulai) || isNaN(tsSelesai) || tsMulai === 0) return;
            var intervalId;
            function tick() {
                var now = Date.now();
                var msToMulai = tsMulai - now, msToSelesai = tsSelesai - now;
                if (msToMulai > 0) {
                    timerEl.textContent = formatCountdown(msToMulai);
                    timerEl.className   = 'countdown-timer upcoming';
                } else if (msToSelesai > 0) {
                    timerEl.textContent = formatCountdown(msToSelesai);
                    timerEl.className   = msToSelesai < 600000 ? 'countdown-timer warning' : 'countdown-timer';
                    if (bar.classList.contains('absensi-upcoming')) location.reload();
                } else {
                    clearInterval(intervalId);
                    if (!bar.classList.contains('absensi-ended')) location.reload();
                }
            }
            tick();
            intervalId = setInterval(tick, 1000);
        });
    }

    /* ================================================================
    EDIT KURIKULUM
    ================================================================ */
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-edit-kurikulum');
        if (!btn) return;
        const d = btn.dataset;

        document.getElementById('modal-kurikulum-title-text').textContent = 'Edit Kurikulum';
        document.getElementById('modal-kurikulum-subtitle').textContent   = 'Perubahan langsung tersimpan tanpa perlu persetujuan ulang';
        document.getElementById('kurikulum-submit-text').textContent      = 'Simpan Perubahan';
        document.getElementById('kurikulum-edit-id').value = d.id;
        document.getElementById('k-judul').value           = d.judul;
        document.getElementById('k-deskripsi').value       = d.deskripsi || '';
        document.getElementById('k-tingkat').value         = d.tingkat  || '';
        document.getElementById('k-bahasa').value          = d.bahasa   || '';
        document.getElementById('k-total-jam').value       = d.totalJam || '';
        document.getElementById('k-jumlah-sesi').value     = d.jumlahSesi || '';
        document.getElementById('k-phone').value           = d.phone    || '';
        document.getElementById('k-biaya').value = d.biaya || '';
        document.getElementById('kurikulum-method').value  = 'PUT';
        document.getElementById('form-kurikulum').action   = '/kurikulum/' + d.id;

        // ① ISI ALAMAT DULU — sebelum apapun
        try {
        document.getElementById('k-alamat').value = JSON.parse(d.alamat) || '';
    } catch(e) {
        document.getElementById('k-alamat').value = d.alamat || '';
    }

        // ② Set metode dropdown
        document.getElementById('k-metode').value = d.metode || '';

        // ③ Tampilkan/sembunyikan field alamat TANPA mengosongkan nilainya
        _tampilkanAlamatTanpaReset(d.metode || '');

        // Sertifikat
        if (d.sertifikat == '1') {
            document.getElementById('sertifikat-ya').checked = true;
        } else {
            document.getElementById('sertifikat-tidak').checked = true;
        }

        // Absensi
        const absensiAktif = d.absensiAktif === '1';
        document.getElementById('k-absensi-aktif').checked = absensiAktif;
        toggleAbsensiSection(absensiAktif);
        if (absensiAktif) {
            if (d.absensiMulai)   document.getElementById('k-absensi-mulai').value   = d.absensiMulai.substring(0, 16);
            if (d.absensiSelesai) document.getElementById('k-absensi-selesai').value = d.absensiSelesai.substring(0, 16);
            document.getElementById('k-absensi-url').value = d.absensiUrl || '';
            updateAbsensiPreview();
        }

        document.querySelectorAll('input[name="_token"]').forEach(el => {
            el.value = document.querySelector('meta[name="csrf-token"]').content;
        });

        // Program mulai & selesai
        document.getElementById('k-program-mulai').value   = d.programMulai   || '';
        document.getElementById('k-program-selesai').value = d.programSelesai || '';

        // Preview gambar existing saat edit
        const gambarUrl = d.gambarUrl || '';
        if (gambarUrl) {
            const preview = document.getElementById('k-gambar-preview');
            const overlay = document.getElementById('k-gambar-overlay');
            const pholder = document.getElementById('k-gambar-placeholder');
            const nameEl  = document.getElementById('k-gambar-name');
            preview.src           = gambarUrl;
            preview.style.display = 'block';
            overlay.style.display = 'flex';
            pholder.style.display = 'none';
            nameEl.innerHTML      = '✅ <strong>Gambar tersimpan</strong> — klik area poster untuk mengganti';
        } else {
            resetKurikulumGambarPreview();
        }

        openModal('modal-kurikulum');
    });



    /* ================================================================
    EDIT EVENT
    ================================================================ */
    function editEvent(id, judul, tanggal, waktuMulai, waktuSelesai, lokasi, kapasitas, biaya, deskripsi, gambar, phone) {
        document.getElementById('modal-event-title').textContent    = 'Edit Event';
        document.getElementById('event-id').value                   = id;
        document.getElementById('event-judul').value                = judul;
        document.getElementById('event-tanggal').value              = tanggal;
        document.getElementById('event-waktu-mulai').value          = waktuMulai   || '';
        document.getElementById('event-waktu-selesai').value        = waktuSelesai || '';
        document.getElementById('event-lokasi').value               = lokasi       || '';
        document.getElementById('event-kapasitas').value            = kapasitas    || '';
        document.getElementById('event-biaya').value                = biaya        || '';
        document.getElementById('event-deskripsi').value            = deskripsi    || '';
        document.getElementById('event-method').value               = 'PUT';
        document.getElementById('form-event').action                = '/trainer/event/' + id;
        document.getElementById('event-phone').value                = phone        || '';
        if (gambar) {
            tampilkanPreviewEvent(gambar);
            document.getElementById('event-gambar-name').textContent = '✓ Gambar tersimpan — klik untuk mengganti';
        } else {
            resetPreviewEvent();
        }
        openModal('modal-event');
    }

    function resetEventModal() {
        document.getElementById('modal-event-title').textContent = 'Tambah Event';
        document.getElementById('event-method').value = 'POST';
        document.getElementById('form-event').action  = '<?php echo e(route("trainer.event.store")); ?>';
        document.getElementById('form-event').reset();
        resetPreviewEvent();
    }

    function onEventGambarChange(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { tampilkanPreviewEvent(e.target.result); };
            reader.readAsDataURL(input.files[0]);
            document.getElementById('event-gambar-name').textContent = '✓ ' + input.files[0].name;
        }
    }
    function tampilkanPreviewEvent(src) {
        var p = document.getElementById('event-gambar-preview');
        p.src = src; p.style.display = 'block';
        document.getElementById('event-upload-icon').style.display = 'none';
        document.getElementById('event-upload-text').style.display = 'none';
    }
    function resetPreviewEvent() {
        var p = document.getElementById('event-gambar-preview');
        p.src = ''; p.style.display = 'none';
        document.getElementById('event-upload-icon').style.display = '';
        document.getElementById('event-upload-text').style.display = '';
        document.getElementById('event-gambar-name').textContent   = '';
    }

    /* ================================================================
    RESET MODAL KURIKULUM
    ================================================================ */
    function resetKurikulumModal() {
        document.getElementById('modal-kurikulum-title-text').textContent = 'Tambah Kurikulum';
        document.getElementById('modal-kurikulum-subtitle').textContent   = 'Isi detail kurikulum, modul dapat ditambah setelah kurikulum tersimpan';
        document.getElementById('kurikulum-submit-text').textContent      = 'Kirim untuk Disetujui';
        document.getElementById('kurikulum-method').value = 'POST';
        document.getElementById('form-kurikulum').action  = '<?php echo e(route("trainer.kurikulum.store")); ?>';
        document.getElementById('form-kurikulum').reset();
        resetKurikulumGambarPreview();
        document.getElementById('sertifikat-tidak').checked  = true;
        document.getElementById('k-phone').value = '<?php echo e(auth()->user()->phone ?? ""); ?>';
        document.getElementById('k-absensi-aktif').checked = false;
        document.getElementById('k-alamat').value = '';
        document.getElementById('k-biaya').value = '';  
        document.getElementById('k-program-mulai').value   = '';
        document.getElementById('k-program-selesai').value = '';
        toggleAlamat('');
        toggleAbsensiSection(false);
    }



    /* ================================================================
    HAPUS
    ================================================================ */
    function hapusItem(id, tipe) {
        if (!confirm('Yakin ingin menghapus ' + tipe + ' ini?')) return;
        const form = document.getElementById('form-hapus');
        form.action = '/' + tipe + '/' + id;
        form.submit();
    }
    function hapusEvent(id) {
        if (!confirm('Yakin ingin menghapus event ini?')) return;
        const form = document.getElementById('form-hapus-event');
        form.action = '/trainer/event/' + id;
        form.submit();
    }

    /* ================================================================
    MATERI TYPE SWITCHER
    ================================================================ */
    function switchMateriType(type) {
        // Reset semua card
        ['none','pdf','youtube'].forEach(t => {
            const card = document.getElementById('card-' + t);
            if (card) card.classList.remove('active');
        });
        // Activate pilihan
        const activeId = type === '' ? 'none' : type;
        const activeCard = document.getElementById('card-' + activeId);
        if (activeCard) activeCard.classList.add('active');
        // Sembunyikan semua panel
        document.getElementById('panel-pdf').style.display     = 'none';
        document.getElementById('panel-youtube').style.display = 'none';
        // Tampilkan panel yang dipilih
        if (type === 'pdf')     document.getElementById('panel-pdf').style.display     = 'block';
        if (type === 'youtube') document.getElementById('panel-youtube').style.display = 'block';
        // Update preview badge
        updatePreviewMateriBadge(type);
    }

    function onPdfChange(input) {
        const label = document.getElementById('pdf-upload-label');
        const sub   = document.getElementById('pdf-upload-sub');
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 20 * 1024 * 1024) {
                alert('File PDF terlalu besar. Maks 20 MB.');
                input.value = '';
                return;
            }
            label.innerHTML = '✅ <strong>' + file.name + '</strong>';
            sub.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB · siap diupload';
        }
    }

    function updateYoutubePreview(url) {
        const wrap  = document.getElementById('yt-preview-wrap');
        const thumb = document.getElementById('yt-thumbnail');
        const err   = document.getElementById('yt-error');
        const videoId = extractYoutubeId(url);
        if (videoId) {
            thumb.src = 'https://img.youtube.com/vi/' + videoId + '/hqdefault.jpg';
            wrap.style.display = 'block';
            err.style.display  = 'none';
            updatePreviewMateriBadge('youtube');
        } else if (url.length > 10) {
            wrap.style.display = 'none';
            err.style.display  = 'block';
        } else {
            wrap.style.display = 'none';
            err.style.display  = 'none';
        }
    }

    function extractYoutubeId(url) {
        if (!url) return null;
        const patterns = [
            /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([A-Za-z0-9_-]{11})/,
        ];
        for (const p of patterns) {
            const m = url.match(p);
            if (m) return m[1];
        }
        return null;
    }

    function updatePreviewMateriBadge(type) {
        const badge = document.getElementById('preview-materi-badge');
        const tag   = document.getElementById('preview-materi-tag');
        if (!badge) return;
        if (!type || type === '') {
            badge.style.display = 'none';
        } else if (type === 'pdf') {
            badge.style.display = 'block';
            tag.innerHTML = '📄 Materi PDF tersedia';
            tag.style.background = '#fee2e2';
            tag.style.color = '#dc2626';
            tag.style.borderColor = '#fca5a5';
        } else if (type === 'youtube') {
            badge.style.display = 'block';
            tag.innerHTML = '▶️ Video YouTube tersedia';
            tag.style.background = '#fee2e2';
            tag.style.color = '#dc2626';
            tag.style.borderColor = '#fca5a5';
        }
    }

    /* ================================================================
    EDIT MODUL (GANTI YANG LAMA)
    ================================================================ */
    function editModul(id, kurikulumId, judul, deskripsi, urutan, materiType, materiYoutube, materiPdfUrl, materiPdfPath, aksesMulai, aksesSelesai) {
        document.getElementById('modal-modul-title-text').textContent = 'Edit Modul';
        document.getElementById('modal-modul-subtitle').textContent   = 'Perubahan langsung tersimpan';
        document.getElementById('modul-submit-text').textContent      = 'Simpan Perubahan';
        document.getElementById('modul-edit-id').value                = id;
        document.getElementById('m-kurikulum-id').value               = kurikulumId;
        document.getElementById('m-judul').value                      = judul;
        document.getElementById('m-deskripsi').value                  = deskripsi;
        document.getElementById('m-urutan').value                     = urutan;
        document.getElementById('modul-method').value                 = 'PUT';
        document.getElementById('form-modul').action                  = '/modul/' + id;
        document.getElementById('m-materi-pdf-existing').value        = materiPdfPath || '';
        document.getElementById('m-akses-mulai').value   = aksesMulai   ? aksesMulai.substring(0, 16)   : '';
        document.getElementById('m-akses-selesai').value = aksesSelesai ? aksesSelesai.substring(0, 16) : '';

        // Set tipe materi
        const safeType = materiType || '';
        const radioNone = document.getElementById('m-materi-none');
        const radioPdf  = document.getElementById('m-materi-pdf-radio');
        const radioYt   = document.getElementById('m-materi-yt-radio');
        radioNone.checked = safeType === '';
        radioPdf.checked  = safeType === 'pdf';
        radioYt.checked   = safeType === 'youtube';
        switchMateriType(safeType);

        // PDF existing info
        const pdfInfo = document.getElementById('pdf-existing-info');
        const pdfLink = document.getElementById('pdf-existing-link');
        if (safeType === 'pdf' && materiPdfUrl) {
            pdfInfo.style.display = 'flex';
            pdfLink.href = materiPdfUrl;
            document.getElementById('pdf-upload-label').textContent = 'Upload PDF baru untuk mengganti';
            document.getElementById('pdf-upload-sub').textContent   = 'File lama akan tetap digunakan jika tidak diubah';
        } else {
            pdfInfo.style.display = 'none';
        }

        // YouTube
        if (safeType === 'youtube') {
            document.getElementById('m-materi-youtube').value = materiYoutube || '';
            updateYoutubePreview(materiYoutube || '');
        }

        updatePreview();
        openModal('modal-modul');
    }

    /* ================================================================
    RESET MODAL MODUL (GANTI YANG LAMA)
    ================================================================ */
    function resetModulModal() {
        document.getElementById('modal-modul-title-text').textContent = 'Tambah Modul Pembelajaran';
        document.getElementById('modal-modul-subtitle').textContent   = 'Modul tampil sebagai daftar bernomor di halaman kurikulum';
        document.getElementById('modul-submit-text').textContent      = 'Simpan Modul';
        document.getElementById('modul-method').value                 = 'POST';
        document.getElementById('form-modul').action                  = '<?php echo e(route("trainer.modul.store")); ?>';
        document.getElementById('form-modul').reset();
        document.getElementById('m-materi-pdf-existing').value        = '';
        // Reset materi
        document.getElementById('m-materi-none').checked              = true;
        switchMateriType('');
        document.getElementById('pdf-existing-info').style.display    = 'none';
        document.getElementById('pdf-upload-label').textContent       = 'Klik untuk memilih file PDF';
        document.getElementById('pdf-upload-sub').textContent         = 'Maks. 20 MB · Format .pdf';
        document.getElementById('yt-preview-wrap').style.display      = 'none';
        document.getElementById('yt-error').style.display             = 'none';
        document.getElementById('m-akses-mulai').value   = '';
        document.getElementById('m-akses-selesai').value = '';
        // Reset preview
        const pNum   = document.getElementById('preview-num');
        const pJudul = document.getElementById('preview-judul');
        const pDesc  = document.getElementById('preview-desc');
        if (pNum)   pNum.textContent   = '1';
        if (pJudul) pJudul.textContent = 'Judul modul...';
        if (pDesc)  pDesc.textContent  = 'Deskripsi modul...';
        const badge = document.getElementById('preview-materi-badge');
        if (badge) badge.style.display = 'none';
    }

    /* ================================================================
    UPDATE PREVIEW (GANTI YANG LAMA)
    ================================================================ */
    function updatePreview() {
        const judul  = document.getElementById('m-judul');
        const desc   = document.getElementById('m-deskripsi');
        const urutan = document.getElementById('m-urutan');
        const pJudul = document.getElementById('preview-judul');
        const pDesc  = document.getElementById('preview-desc');
        const pNum   = document.getElementById('preview-num');
        if (pJudul) pJudul.textContent = judul?.value  || 'Judul modul...';
        if (pDesc)  pDesc.textContent  = desc?.value   || 'Deskripsi modul...';
        if (pNum)   pNum.textContent   = urutan?.value || '1';
    }

    function openModalModul() {
        <?php if(!$adaKurikulum): ?>
            if (!confirm('Kamu belum punya kurikulum. Buat kurikulum terlebih dahulu?')) return;
            openModal('modal-kurikulum'); return;
        <?php endif; ?>
        resetModulModal();
        openModal('modal-modul');
    }
    function openModalModulDenganKurikulum(kurikulumId, kurikulumJudul) {
        resetModulModal();
        document.getElementById('m-kurikulum-id').value = kurikulumId;
        document.getElementById('modal-modul-subtitle').textContent = 'Menambah modul ke: ' + kurikulumJudul;
        openModal('modal-modul');
    }

    /* ================================================================
    ABSENSI DAFTAR & EXPORT
    ================================================================ */
    var _absPelId = null;
    function bukaDaftarAbsensi(pelId, judul) {
        _absPelId = pelId;
        document.getElementById('modal-abs-subtitle').textContent = judul;
        document.getElementById('abs-total-badge').textContent    = '–';
        document.getElementById('abs-loading').style.display      = 'block';
        document.getElementById('abs-table-wrap').style.display   = 'none';
        document.getElementById('abs-empty').style.display        = 'none';
        openModal('modal-absensi-daftar');
        _muatAbsensi(pelId);
    }
    function refreshAbsensi() { if (_absPelId) _muatAbsensi(_absPelId); }
    function _muatAbsensi(pelId) {
        document.getElementById('abs-loading').style.display    = 'block';
        document.getElementById('abs-table-wrap').style.display = 'none';
        document.getElementById('abs-empty').style.display      = 'none';
        fetch('/trainer/kurikulum/' + pelId + '/absensi', {
            headers: { 'Accept':'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(r => r.json())
        .then(res => {
            document.getElementById('abs-loading').style.display = 'none';
            if (!res.success) { alert('Gagal: ' + res.message); return; }
            document.getElementById('abs-total-badge').textContent = res.total;
            if (res.total === 0) { document.getElementById('abs-empty').style.display = 'block'; return; }
            var tbody = document.getElementById('abs-tbody');
            tbody.innerHTML = '';
            res.peserta.forEach(p => {
                var tr = document.createElement('tr');
                tr.innerHTML = '<td style="font-weight:600;color:var(--text-muted)">' + p.no + '</td>'
                    + '<td style="font-weight:500">' + _esc(p.nama) + '</td>'
                    + '<td style="font-size:12px;color:var(--text-muted)">' + _esc(p.email) + '</td>'
                    + '<td style="font-size:12px;color:var(--text-muted)">' + _esc(p.waktu) + '</td>';
                tbody.appendChild(tr);
            });
            document.getElementById('abs-table-wrap').style.display = 'block';
        })
        .catch(() => { document.getElementById('abs-loading').style.display = 'none'; alert('Gagal terhubung ke server.'); });
    }
    function exportAbsensiCsv() { if (_absPelId) window.location.href = '/trainer/kurikulum/' + _absPelId + '/absensi/export'; }
    function _esc(s) {
        if (s == null) return '–';
        return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    /* ================================================================
    INIT
    ================================================================ */
    
    /* ================================================================
    PROFIL CHIPS — BIDANG KEAHLIAN
    ================================================================ */
    function getProfilKeahlianArray() {
        const val = document.getElementById('profil-keahlian-value').value;
        return val ? val.split(',').map(s => s.trim()).filter(Boolean) : [];
    }
    function toggleProfilChip(btn) {
        const label = btn.textContent.trim();
        let arr = getProfilKeahlianArray();
        if (btn.style.background.includes('var(--accent)') || btn.style.background === 'var(--accent)') {
            btn.style.background = '#f9fafb';
            btn.style.borderColor = '#d1d5db';
            btn.style.color = '#4b5563';
            arr = arr.filter(v => v !== label);
        } else {
            btn.style.background = 'var(--accent)';
            btn.style.borderColor = 'var(--accent)';
            btn.style.color = '#fff';
            if (!arr.includes(label)) arr.push(label);
        }
        setProfilKeahlianValue(arr);
    }
    function addProfilCustom() {
        const input = document.getElementById('profil-custom-input');
        const label = input.value.trim();
        if (!label) return;
        let arr = getProfilKeahlianArray();
        if (arr.includes(label)) { input.value = ''; return; }
        arr.push(label);
        setProfilKeahlianValue(arr); // ← ini sudah update dropdown

        const container = document.getElementById('profil-custom-tags');
        const tag       = document.createElement('span');
        tag.style.cssText = 'display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;background:#ede9fe;color:#5b21b6;border:1.5px solid #c4b5fd';
        tag.dataset.value = label;
        tag.innerHTML = label + ` <button type="button" onclick="removeProfilTag(this,'${label.replace(/'/g,"\\'")}') " style="background:none;border:none;cursor:pointer;font-size:15px;line-height:1;color:inherit;padding:0;opacity:.7">×</button>`;
        container.appendChild(tag);

        // ← Auto-pilih keahlian baru di dropdown displayed_bidang
        const select = document.getElementById('profil-displayed-bidang');
        if (select) select.value = label;

        input.value = '';
        input.focus();
    }
    function removeProfilTag(btn, label) {
        btn.closest('span').remove();
        let arr = getProfilKeahlianArray();
        arr = arr.filter(v => v !== label);
        setProfilKeahlianValue(arr);
    }

    function setProfilKeahlianValue(arr) {
        document.getElementById('profil-keahlian-value').value = arr.join(',');
        const counter = document.getElementById('profil-keahlian-count');
        if (counter) counter.textContent = arr.length;

        const select   = document.getElementById('profil-displayed-bidang');
        if (!select) return;
        const currentVal = select.value; // simpan pilihan sebelumnya
        select.innerHTML = '';
        arr.forEach(item => {
            const opt      = document.createElement('option');
            opt.value      = item;
            opt.textContent = item;
            // ← pertahankan pilihan sebelumnya, atau otomatis pilih item terakhir ditambah
            if (item === currentVal) opt.selected = true;
            select.appendChild(opt);
        });

        // Kalau pilihan sebelumnya sudah tidak ada di arr, pilih item pertama
        if (arr.length > 0 && !arr.includes(currentVal)) {
            select.value = arr[0];
        }
    }

    /* ================================================================
    TOGGLE PASSWORD VISIBILITY
    ================================================================ */
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye   = document.getElementById(eyeId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        eye.innerHTML = isHidden
            ? `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>`
            : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>`;
    }
    document.addEventListener('DOMContentLoaded', function () {
    // Alamat group transition
    var grup = document.getElementById('k-alamat-group');
    if (grup) {
        grup.style.transition = 'max-height .3s ease, opacity .3s ease, margin-bottom .3s ease';
        grup.style.maxHeight    = '0';
        grup.style.overflow     = 'hidden';
        grup.style.opacity      = '0';
        grup.style.marginBottom = '0';
    }

    <?php if($errors->any()): ?>
        showPage('profil');
    <?php endif; ?>

    // Absensi listeners
    document.getElementById('k-absensi-mulai').addEventListener('change', updateAbsensiPreview);
    document.getElementById('k-absensi-selesai').addEventListener('change', updateAbsensiPreview);

    // Modul preview listeners
    ['m-judul', 'm-deskripsi', 'm-urutan'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', updatePreview);
    });

    initProgramTimers();

    // Absensi timers
    initAbsensiTimers();

    // Hash/session routing
    const hash = window.location.hash.replace('#', '');
    if (['beranda','program','event','ulasan','deleted','deleted-event','profil'].includes(hash)) {
        showPage(hash);
    } else {
        <?php if(session('active_page')): ?>
            showPage('<?php echo e(session("active_page")); ?>');
        <?php endif; ?>
    }

    // Password match
    const pw1  = document.getElementById('input-password-baru');
    const pw2  = document.getElementById('input-password-confirm');
    const hint = document.getElementById('password-match-hint');
    if (pw1 && pw2 && hint) {
        function checkMatch() {
            if (!pw2.value) { hint.style.display = 'none'; return; }
            hint.style.display = 'block';
            if (pw1.value === pw2.value) {
                hint.textContent = '✓ Password cocok';
                hint.style.color = 'var(--accent)';
                pw2.style.borderColor = 'var(--accent)';
            } else {
                hint.textContent = '✗ Password tidak cocok';
                hint.style.color = 'var(--accent2)';
                pw2.style.borderColor = 'var(--accent2)';
            }
        }
        pw1.addEventListener('input', checkMatch);
        pw2.addEventListener('input', checkMatch);
    }
});
    /* ================================================================
    PROFIL FOTO PREVIEW
    ================================================================ */
    function onProfilFotoChange(input) {
        if (!input.files || !input.files[0]) return;
        const file   = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const src         = e.target.result;
            const preview     = document.getElementById('profil-foto-preview');
            const overlay     = document.getElementById('profil-foto-overlay');
            const placeholder = document.getElementById('profil-foto-placeholder');
            const nameEl      = document.getElementById('profil-foto-name');

            // Tampilkan preview
            if (preview.tagName === 'IMG') {
                preview.src = src;
            } else {
                // Kalau sebelumnya tidak ada foto, ganti div jadi img
                const img = document.createElement('img');
                img.id = 'profil-foto-preview';
                img.src = src;
                img.alt = 'Preview';
                img.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1';
                preview.replaceWith(img);
            }

            // Tampilkan overlay
            if (overlay) {
                overlay.style.display = 'flex';
                overlay.style.flexDirection = 'column';
                overlay.style.alignItems = 'center';
                overlay.style.justifyContent = 'center';
                overlay.style.gap = '6px';
                overlay.innerHTML = `
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                        <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                    <span style="font-size:12px;font-weight:600;color:#fff">✓ ${file.name}</span>
                `;
            }

            // Sembunyikan placeholder kalau ada
            if (placeholder) placeholder.style.display = 'none';
            if (nameEl) nameEl.textContent = '';
        };

        reader.readAsDataURL(file);
    }
    /* ================================================================
TANDAI LOG DIHAPUS SUDAH DIBACA
================================================================ */
function tandaiSudahDibaca() {
    fetch('/trainer/deleted-log/read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            const wrap = document.getElementById('notif-deleted-wrap');
            if (wrap) {
                wrap.style.transition = 'opacity .3s';
                wrap.style.opacity = '0';
                setTimeout(() => wrap.remove(), 300);
            }
        }

        const badge = document.getElementById('deleted-badge');
    if (badge) badge.remove();
    })
    .catch(() => alert('Gagal menandai. Coba lagi.'));
}

/* ================================================================
MODAL KONFIRMASI PULIHKAN
================================================================ */
function bukaModalPulihkan(logId, judul, tipe, tanggalHapus) {
    document.getElementById('pulihkan-judul').textContent = judul;
    document.getElementById('pulihkan-meta').textContent  =
        tipe + ' · Dihapus ' + tanggalHapus + ' WIB';
    document.getElementById('pulihkan-icon').textContent  =
        tipe.toLowerCase() === 'modul' ? '📝' : '📚';
    
    // ← GANTI BARIS INI
    document.getElementById('form-pulihkan').action =
        '/trainer/deleted-log/' + logId + '/restore'; // bukan /trainer/program/
    
    openModal('modal-pulihkan');
}
    </script>
    
<div class="modal-overlay" id="modal-pulihkan">
    <div class="modal" style="width:460px;text-align:center;padding:36px 32px">
        <div style="width:68px;height:68px;border-radius:20px;background:#f3f0ff;
                    display:flex;align-items:center;justify-content:center;
                    font-size:30px;margin:0 auto 18px;border:2px solid #e9d5ff">
            ♻️
        </div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:700;
                    color:var(--text);margin-bottom:8px">
            Pulihkan Program?
        </div>
        <p style="font-size:13px;color:var(--text-muted);margin-bottom:22px;line-height:1.7">
            Program akan dikirim ulang ke admin sebagai
            <strong style="color:var(--warning)">pending</strong>
            dan perlu disetujui kembali sebelum aktif.
        </p>

        
        <div style="background:#faf8f5;border:1.5px solid #e8e0d6;border-radius:14px;
                    padding:14px 18px;margin-bottom:24px;text-align:left">
            <div style="font-size:10px;font-weight:700;color:var(--text-muted);
                        text-transform:uppercase;letter-spacing:1.5px;margin-bottom:10px">
                Detail Program
            </div>
            <div style="display:flex;align-items:center;gap:12px">
                <div style="width:40px;height:40px;border-radius:10px;background:#f3f0ff;
                            display:flex;align-items:center;justify-content:center;
                            font-size:20px;flex-shrink:0;border:1px solid #e9d5ff"
                     id="pulihkan-icon">📚</div>
                <div style="min-width:0;flex:1">
                    <div style="font-size:14px;font-weight:700;color:var(--text);
                                white-space:nowrap;overflow:hidden;text-overflow:ellipsis"
                         id="pulihkan-judul">–</div>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:3px"
                         id="pulihkan-meta">–</div>
                </div>
            </div>
        </div>

        <form id="form-pulihkan" method="POST">
            <?php echo csrf_field(); ?>
            <div style="display:flex;gap:10px">
                <button type="button" class="btn btn-ghost"
                        onclick="closeModal('modal-pulihkan')"
                        style="flex:1;justify-content:center">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary"
                        style="flex:1;justify-content:center;background:#7c3aed">
                    ♻️ Ya, Pulihkan
                </button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay" id="modal-pulihkan-event">
    <div class="modal" style="width:460px;text-align:center;padding:36px 32px">
        <div style="width:68px;height:68px;border-radius:20px;background:#dbeafe;
                    display:flex;align-items:center;justify-content:center;
                    font-size:30px;margin:0 auto 18px;border:2px solid #bfdbfe">
            ♻️
        </div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:700;
                    color:var(--text);margin-bottom:8px">
            Pulihkan Event?
        </div>
        <p style="font-size:13px;color:var(--text-muted);margin-bottom:22px;line-height:1.7">
            Event akan dikirim ulang ke admin sebagai
            <strong style="color:var(--warning)">pending</strong>
            dan perlu disetujui kembali sebelum aktif.
        </p>

        <div style="background:#faf8f5;border:1.5px solid #e8e0d6;border-radius:14px;
                    padding:14px 18px;margin-bottom:24px;text-align:left">
            <div style="font-size:10px;font-weight:700;color:var(--text-muted);
                        text-transform:uppercase;letter-spacing:1.5px;margin-bottom:10px">
                Detail Event
            </div>
            <div style="display:flex;align-items:center;gap:12px">
                <div style="width:40px;height:40px;border-radius:10px;background:#dbeafe;
                            display:flex;align-items:center;justify-content:center;
                            font-size:20px;flex-shrink:0;border:1px solid #bfdbfe">
                    🎪
                </div>
                <div style="min-width:0;flex:1">
                    <div style="font-size:14px;font-weight:700;color:var(--text);
                                white-space:nowrap;overflow:hidden;text-overflow:ellipsis"
                         id="pulihkan-event-judul">–</div>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:3px"
                         id="pulihkan-event-meta">–</div>
                </div>
            </div>
        </div>

        <form id="form-pulihkan-event" method="POST">
            <?php echo csrf_field(); ?>
            <div style="display:flex;gap:10px">
                <button type="button" class="btn btn-ghost"
                        onclick="closeModal('modal-pulihkan-event')"
                        style="flex:1;justify-content:center">
                    Batal
                </button>
                <button type="submit" class="btn btn-secondary"
                        style="flex:1;justify-content:center">
                    ♻️ Ya, Pulihkan Event
                </button>
            </div>
        </form>
    </div>
</div>
    </body>
    </html><?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/trainer/dashboard.blade.php ENDPATH**/ ?>