
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>Dashboard Mentor – KAJI Indonesia</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
<style>

/* ============ PRODUK GRID MODAL ============ */
.produk-grid-modal { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px; }
.produk-card-modal { background: var(--surface2); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
.produk-card-modal-img { width: 100%; height: 120px; object-fit: cover; background: var(--border); display: flex; align-items: center; justify-content: center; font-size: 32px; }
.produk-card-modal-img img { width: 100%; height: 100%; object-fit: cover; }
.produk-card-modal-body { padding: 10px 12px; }
.produk-card-modal-name { font-size: 13px; font-weight: 700; margin-bottom: 4px; }
.produk-card-modal-price { font-size: 12px; color: var(--accent); font-weight: 700; }
.produk-card-modal-desc { font-size: 11px; color: var(--text-muted); margin-top: 3px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
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
.brand-name { font-family: 'Cormorant Garamond', serif; font-size: 20px; color: #fff; font-weight: 700; }
.brand-role { font-size: 11px; color: rgba(255,255,255,.6); letter-spacing: 1.5px; text-transform: uppercase; }
.nav-section { padding: 20px 16px 8px; }
.nav-label { font-size: 10px; color: rgba(255,255,255,.4); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; padding-left: 10px; }
.nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 12px; cursor: pointer; color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500; margin-bottom: 3px; transition: all .2s; text-decoration: none; }
.nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
.nav-item.active { background: rgba(255,255,255,.18); color: #fff; font-weight: 600; }
.nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
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
.content { padding: 32px; }

/* ============ BUTTONS ============ */
.btn { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all .2s; font-family: inherit; text-decoration: none; }
.btn-primary { background: var(--accent); color: #fff; }
.btn-primary:hover { background: #1f4e37; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(45,106,79,.3); }
.btn-ghost { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
.btn-ghost:hover { background: var(--border); }
.btn-sm { padding: 6px 14px; font-size: 12px; border-radius: 8px; }
.btn-outline { background: transparent; border: 1.5px solid var(--accent); color: var(--accent); }
.btn-outline:hover { background: var(--accent); color: #fff; }

/* ============ ALERTS ============ */
.alert { padding: 14px 18px; border-radius: 10px; font-size: 13px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.alert-success { background: var(--accent-light); color: var(--accent); border: 1px solid #a7d7c566; }
.alert-error   { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }

/* ============ STATS ============ */
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px; }
.stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 22px; box-shadow: var(--shadow); position: relative; overflow: hidden; }
.stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
.stat-card.green::before  { background: linear-gradient(90deg, var(--accent), #52b788); }
.stat-card.teal::before   { background: linear-gradient(90deg, #0d9488, #34d399); }
.stat-card.blue::before   { background: linear-gradient(90deg, var(--accent3), #60a5fa); }
.stat-card.orange::before { background: linear-gradient(90deg, var(--accent2), #f4a261); }
.stat-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 12px; }
.stat-card.green .stat-icon  { background: var(--accent-light); }
.stat-card.teal .stat-icon   { background: #e6faf8; }
.stat-card.blue .stat-icon   { background: #e3f0fa; }
.stat-card.orange .stat-icon { background: #fff0ed; }
.stat-label { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
.stat-value { font-size: 30px; font-weight: 800; color: var(--text); }
.stat-sub { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

/* ============ SECTION ============ */
.section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
.section-title { font-size: 16px; font-weight: 700; }
.section-title span { color: var(--text-muted); font-weight: 400; font-size: 14px; margin-left: 8px; }

/* ============ BADGE ============ */
.badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.badge-pending  { background: #fffbea; color: var(--warning); border: 1px solid #fcd34d66; }
.badge-approved { background: var(--accent-light); color: var(--accent); border: 1px solid #a7d7c566; }
.badge-rejected { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }
.badge-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

/* ============ UMKM CARDS ============ */
.umkm-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; }
.umkm-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); transition: transform .2s, box-shadow .2s; }
.umkm-card:hover { transform: translateY(-3px); box-shadow: 0 8px 32px rgba(45,106,79,.12); }
.umkm-card-header { display: flex; align-items: center; gap: 14px; padding: 18px 18px 14px; }
.umkm-avatar { width: 52px; height: 52px; border-radius: 14px; background: var(--surface2); border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; overflow: hidden; }
.umkm-avatar img { width: 100%; height: 100%; object-fit: cover; }
.umkm-name { font-size: 14px; font-weight: 700; color: var(--text); margin-bottom: 3px; }
.umkm-owner { font-size: 12px; color: var(--text-muted); }
.umkm-card-body { padding: 0 18px 14px; }
.umkm-desc { font-size: 12px; color: var(--text-muted); line-height: 1.6; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.umkm-meta { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; }
.umkm-chip { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11px; font-weight: 600; background: var(--surface2); color: var(--text-muted); border: 1px solid var(--border); }
.umkm-chip.green  { background: var(--accent-light); color: var(--accent); border-color: #a7d7c566; }
.umkm-chip.blue   { background: #e3f0fa; color: var(--accent3); border-color: #bdd5ea; }
.umkm-chip.orange { background: #fff0ed; color: var(--accent2); border-color: #e76f5166; }
.umkm-card-footer { padding: 12px 18px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; background: var(--surface2); }
.umkm-date { font-size: 11px; color: var(--text-muted); }

/* ============ EMPTY STATE ============ */
.empty-state { text-align: center; padding: 60px 20px; color: var(--text-muted); }
.empty-state .empty-icon { font-size: 52px; margin-bottom: 16px; }
.empty-state h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; color: var(--text); }
.empty-state p { font-size: 13px; line-height: 1.6; max-width: 380px; margin: 0 auto; }

/* ============ PAGE SECTIONS ============ */
.page-section { display: none; }
.page-section.active { display: block; }

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
.form-static { padding: 11px 14px; background: var(--bg); border: 1.5px solid var(--border); border-radius: 10px; font-size: 14px; color: var(--text); line-height: 1.5; }
.form-hint { font-size: 11px; color: var(--text-muted); margin-top: 5px; }
.form-divider { border: none; border-top: 1px solid var(--border); margin: 8px 0 18px; }

/* ============ STATUS BANNER ============ */
.status-banner { border-radius: 12px; padding: 16px 20px; display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }
.status-banner.pending  { background: #fffbea; border: 1px solid #fcd34d66; }
.status-banner.approved { background: var(--accent-light); border: 1px solid #a7d7c566; }
.status-banner.rejected { background: #fff0ed; border: 1px solid #e76f5166; }
.status-banner-text { font-size: 13px; line-height: 1.6; }
.status-banner.pending  .status-banner-text { color: #92400e; }
.status-banner.approved .status-banner-text { color: var(--accent); }
.status-banner.rejected .status-banner-text { color: #9b2c1a; }

/* ============ ULASAN LIST ============ */
.ulasan-list { display: flex; flex-direction: column; gap: 12px; }
.ulasan-card { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; padding: 16px 18px; box-shadow: var(--shadow); }
.ulasan-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 8px; }
.ulasan-reviewer { font-size: 13px; font-weight: 600; }
.ulasan-date { font-size: 11px; color: var(--text-muted); }
.ulasan-stars { color: #f59e0b; font-size: 14px; letter-spacing: 1px; margin-bottom: 6px; }
.ulasan-text { font-size: 13px; color: var(--text-muted); line-height: 1.6; }

/* ============ SEARCH & FILTER ============ */
.filter-bar { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-bottom: 20px; }
.search-input { flex: 1; min-width: 200px; padding: 9px 14px 9px 38px; background: var(--surface); border: 1.5px solid var(--border); border-radius: 10px; font-size: 13px; color: var(--text); font-family: inherit; transition: border .2s; }
.search-input:focus { outline: none; border-color: var(--accent); }
.search-wrap { position: relative; flex: 1; min-width: 200px; }
.search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }

/* ============ MODAL ============ */
.modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); backdrop-filter: blur(4px); z-index: 200; align-items: center; justify-content: center; }
.modal-overlay.open { display: flex; }
.modal { background: var(--surface); border-radius: 20px; width: 560px; max-height: 90vh; overflow-y: auto; padding: 30px; box-shadow: 0 24px 80px rgba(0,0,0,.2); animation: popIn .25s ease; border: 1px solid var(--border); }
@keyframes popIn { from { transform: scale(.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.modal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.modal-title { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 700; }
.modal-title small { font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500; color: var(--text-muted); display: block; margin-top: 2px; }
.modal-close { width: 34px; height: 34px; border-radius: 10px; background: var(--surface2); border: 1px solid var(--border); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--text-muted); }
.modal-close:hover { background: #fee; border-color: var(--accent2); color: var(--accent2); }
.modal-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border); }

/* ============ UPLOAD ============ */
.upload-area { position: relative; width: 100%; min-height: 110px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; padding: 24px; border: 2px dashed #2d6a4f66; border-radius: 14px; background: #faf8f5; text-align: center; cursor: pointer; transition: all .2s; }
.upload-area:hover { background: #eef8f1; border-color: var(--accent); }
.upload-area .upload-icon { font-size: 36px; }
.upload-area .upload-text { font-size: 13px; color: var(--text-muted); }
.upload-area .upload-text span { color: var(--accent); font-weight: 700; }
.upload-fname { margin-top: 4px; font-size: 12px; font-weight: 600; color: var(--accent); word-break: break-word; }

/* ============ HAMBURGER ============ */
.hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 8px; border-radius: 10px; background: var(--surface2); border: 1px solid var(--border); flex-shrink: 0; }
.hamburger span { display: block; width: 20px; height: 2px; background: var(--text); border-radius: 2px; transition: all .3s; }
.sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 99; backdrop-filter: blur(2px); }
.sidebar-overlay.open { display: block; }

/* ============ RESPONSIVE ============ */
@media (min-width: 1400px) { .content { padding: 36px 48px; } .stats-grid { gap: 20px; } }
@media (min-width: 769px) and (max-width: 1100px) {
    .sidebar { width: 220px; } .main { margin-left: 220px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .content { padding: 24px 20px; } .topbar { padding: 14px 20px; }
    .modal { width: 90vw !important; }
}
@media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); transition: transform .3s ease; width: 260px; z-index: 100; box-shadow: 4px 0 24px rgba(0,0,0,.2); }
    .sidebar.open { transform: translateX(0); }
    .main { margin-left: 0; }
    .topbar { padding: 12px 16px; gap: 10px; }
    .topbar-title { font-size: 18px; }
    .hamburger { display: flex; }
    .topbar .btn-ghost { display: none; }
    .content { padding: 16px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 20px; }
    .stat-value { font-size: 24px; } .stat-card { padding: 16px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
    .profile-hero { flex-direction: column; text-align: center; gap: 16px; padding: 24px 20px; }
    .modal-overlay { align-items: flex-end; }
    .modal { width: 100% !important; max-height: 92vh; border-radius: 20px 20px 0 0; padding: 24px 20px; }
    .umkm-grid { grid-template-columns: 1fr; }
    .filter-bar { flex-direction: column; align-items: stretch; }
    .search-wrap { min-width: 100%; }
}
@media (max-width: 400px) {
    .stats-grid { grid-template-columns: 1fr; }
    .stat-value { font-size: 28px; }
}
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--bg); }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
</style>
</head>
<body>



<?php
$spesArr = [];
if ($mentor && !empty($mentor->spesialisasi)) {
    $raw = $mentor->spesialisasi;
    if (is_array($raw)) {
        $spesArr = array_values(array_filter(array_map('trim', $raw)));
    } elseif (is_string($raw)) {
        $decoded = json_decode($raw, true);
        $spesArr = is_array($decoded)
            ? array_values(array_filter(array_map('trim', $decoded)))
            : array_values(array_filter(array_map('trim', explode(',', $raw))));
    }
}
?>



<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-box">
        <div class="brand-icon">
    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
    </svg>
</div>
            <div>
                <div class="brand-name">KAJI Indonesia</div>
                <div class="brand-role">Mentor</div>
            </div>
        </div>
    </div>

    <div class="nav-section">
        <div class="nav-label">Menu Utama</div>
        <div class="nav-item active" onclick="showPage('beranda')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Beranda
        </div>
        <div class="nav-item" onclick="showPage('umkm')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            UMKM Binaan
            <?php if($totalUmkm > 0): ?>
                <span style="margin-left:auto;background:var(--accent-light);color:var(--accent);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;border:1px solid #a7d7c566"><?php echo e($totalUmkm); ?></span>
            <?php endif; ?>
        </div>
        <div class="nav-item" onclick="showPage('ulasan')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Ulasan
            <?php if($totalUlasan > 0): ?>
                <span style="margin-left:auto;background:#e3f0fa;color:var(--accent3);font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;border:1px solid #bdd5ea"><?php echo e($totalUlasan); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="nav-section">
        <div class="nav-label">Akun</div>
        <div class="nav-item" onclick="showPage('profil')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profil Saya
        </div>
        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Keluar
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none"><?php echo csrf_field(); ?></form>
    </div>

    <div class="sidebar-user">
        <div class="user-card" onclick="showPage('profil')">
            <div class="user-avatar">
                <?php if($mentor?->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $mentor->foto)); ?>" alt="<?php echo e(auth()->user()->name); ?>">
                <?php else: ?>
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                <?php endif; ?>
            </div>
            <div>
                <div class="user-name"><?php echo e(auth()->user()->name); ?></div>
                <div class="user-role">Mentor</div>
            </div>
        </div>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>


<main class="main">
<header class="topbar">
    <button class="hamburger" onclick="toggleSidebar()" aria-label="Toggle Menu">
        <span></span><span></span><span></span>
    </button>
    <div class="topbar-title" id="page-title">Dashboard Mentor</div>
    <div style="display:flex;gap:10px;align-items:center">
        <span style="font-size:13px;color:var(--text-muted)">Halo, <?php echo e(auth()->user()->name); ?> 👋</span>
        <a href="<?php echo e(url('/')); ?>" target="_blank" class="btn btn-ghost" style="font-size:13px;padding:8px 16px">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2z"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
            Lihat Website
        </a>
    </div>
</header>

<div class="content">

    
    <div class="page-section active" id="page-beranda">
        <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>
        <?php if(session('error')): ?><div class="alert alert-error">⚠️ <?php echo e(session('error')); ?></div><?php endif; ?>

        
        <?php if($statusMentor === 'pending'): ?>
        <div class="status-banner pending">
            <div style="font-size:24px;flex-shrink:0">⏳</div>
            <div class="status-banner-text">
                <strong>Akun mentor Anda sedang ditinjau.</strong> Admin akan memverifikasi data Anda dalam 1–3 hari kerja. Anda dapat melengkapi profil sambil menunggu.
            </div>
        </div>
        <?php elseif($statusMentor === 'approved'): ?>
        <div class="status-banner approved">
            <div style="font-size:24px;flex-shrink:0">✅</div>
            <div class="status-banner-text">
                <strong>Akun mentor Anda aktif.</strong> Profil Anda sudah tampil di halaman publik dan UMKM dapat memilih Anda sebagai mentor.
            </div>
        </div>
        <?php elseif($statusMentor === 'rejected'): ?>
        <div class="status-banner rejected">
            <div style="font-size:24px;flex-shrink:0">❌</div>
            <div class="status-banner-text">
                <strong>Pendaftaran ditolak.</strong>
                <?php if($mentor?->rejection_reason): ?> Alasan: <?php echo e($mentor->rejection_reason); ?>. <?php endif; ?>
                Silakan perbarui profil dan hubungi admin.
            </div>
        </div>
        <?php endif; ?>

        
        <div class="stats-grid">
            <div class="stat-card green">
                <div class="stat-icon">🏠</div>
                <div class="stat-label">UMKM Binaan</div>
                <div class="stat-value"><?php echo e($totalUmkm); ?></div>
                <div class="stat-sub">UMKM terhubung</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-icon">⭐</div>
                <div class="stat-label">Rating</div>
                <div class="stat-value"><?php echo e(number_format($avgRating, 1)); ?></div>
                <div class="stat-sub">dari 5.0</div>
            </div>
            <div class="stat-card blue">
                <div class="stat-icon">💬</div>
                <div class="stat-label">Total Ulasan</div>
                <div class="stat-value"><?php echo e($totalUlasan); ?></div>
                <div class="stat-sub">dari UMKM</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-icon">📍</div>
                <div class="stat-label">Lokasi</div>
                <div class="stat-value" style="font-size:16px;margin-top:6px;line-height:1.4"><?php echo e($mentor?->kabupaten ?? '-'); ?></div>
                <div class="stat-sub"><?php echo e($mentor?->provinsi ?? ''); ?></div>
            </div>
        </div>

        
        <div class="section-header">
            <div class="section-title">UMKM Binaan Terbaru <span><?php echo e($totalUmkm); ?> total</span></div>
            <?php if($totalUmkm > 6): ?>
            <button class="btn btn-outline btn-sm" onclick="showPage('umkm')">Lihat Semua →</button>
            <?php endif; ?>
        </div>

        <?php if($umkmList->isEmpty()): ?>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)">
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <h3>Belum ada UMKM yang terhubung</h3>
                <p>UMKM yang memilih Anda sebagai mentor akan tampil di sini. Pastikan profil Anda lengkap agar mudah ditemukan.</p>
                <button class="btn btn-primary" style="margin-top:20px" onclick="showPage('profil')">Lengkapi Profil →</button>
            </div>
        </div>
        <?php else: ?>
        <div class="umkm-grid">
            <?php $__currentLoopData = $umkmList->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $owner = $umkm->user;
                $initial = strtoupper(substr($umkm->nama_usaha ?? $umkm->nama ?? 'U', 0, 1));
            ?>
            <div class="umkm-card">
            <div class="umkm-card-header">
    <div class="umkm-avatar">
        <?php if($umkm->logo): ?>
            <img src="<?php echo e(asset('storage/' . $umkm->logo)); ?>"
                 alt="<?php echo e($umkm->nama_usaha ?? $umkm->nama); ?>"
                 style="width:100%;height:100%;object-fit:contain;background:#fff;padding:4px;">
        <?php elseif($umkm->foto_produk): ?>
            <img src="<?php echo e(asset('storage/' . $umkm->foto_produk)); ?>"
                 alt="<?php echo e($umkm->nama_usaha ?? $umkm->nama); ?>"
                 style="width:100%;height:100%;object-fit:cover;">
        <?php else: ?>
            <?php echo e($initial); ?>

        <?php endif; ?>
    </div>
    <div style="flex:1;min-width:0">
                        <div class="umkm-name"><?php echo e($umkm->nama_usaha ?? $umkm->nama ?? '-'); ?></div>
                        <div class="umkm-owner"><?php echo e($owner?->name ?? '-'); ?></div>
                    </div>
                </div>
                <div class="umkm-card-body">
                    <?php if($umkm->deskripsi): ?>
                    <div class="umkm-desc"><?php echo e($umkm->deskripsi); ?></div>
                    <?php endif; ?>
                    <div class="umkm-meta">
                        <?php if($umkm->kategori): ?>
                        <span class="umkm-chip green"><?php echo e($umkm->kategori); ?></span>
                        <?php endif; ?>
                        <?php if($umkm->kota ?? $umkm->kabupaten): ?>
                        <span class="umkm-chip blue">📍 <?php echo e($umkm->kota ?? $umkm->kabupaten); ?></span>
                        <?php endif; ?>
                        <?php if($umkm->status): ?>
                        <span class="umkm-chip <?php echo e($umkm->status === 'approved' ? 'green' : ($umkm->status === 'rejected' ? 'orange' : '')); ?>">
                            <?php echo e(ucfirst($umkm->status)); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="umkm-card-footer">
    <span class="umkm-date">Bergabung <?php echo e(\Carbon\Carbon::parse($umkm->created_at)->translatedFormat('d M Y')); ?></span>
    <div style="display:flex;gap:6px;align-items:center;">
        <button onclick="lihatProdukUmkm(<?php echo e($umkm->id); ?>, '<?php echo e(addslashes($umkm->nama_usaha ?? $umkm->nama)); ?>')"
                class="btn btn-sm btn-outline" style="font-size:11px;padding:5px 10px;">
            📦 Produk
        </button>
        <?php if($owner?->phone): ?>
        <a href="https://wa.me/<?php echo e(preg_replace('/\D/','',$owner->phone)); ?>" target="_blank"
           class="btn btn-sm" style="background:#e8f5e4;color:#25d366;border:1px solid #a7d7c566;gap:5px;padding:5px 11px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.12 1.524 5.847L.073 23.927l6.224-1.427C7.88 23.445 9.895 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.891 0-3.655-.52-5.165-1.424l-.37-.22-3.694.847.875-3.596-.242-.373A9.935 9.935 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            WA
        </a>
        <?php endif; ?>
    </div>
</div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="page-section" id="page-umkm">
        <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>

        <div class="section-header">
            <div class="section-title">UMKM Binaan <span><?php echo e($totalUmkm); ?> terhubung</span></div>
        </div>

        <?php if(!$umkmList->isEmpty()): ?>
        <div class="filter-bar">
            <div class="search-wrap">
                <svg class="search-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" class="search-input" id="umkm-search" placeholder="Cari nama UMKM atau pemilik..." oninput="filterUmkm(this.value)">
            </div>
        </div>
        <?php endif; ?>

        <?php if($umkmList->isEmpty()): ?>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)">
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <h3>Belum ada UMKM yang terhubung</h3>
                <p>UMKM yang memilih Anda sebagai mentor akan otomatis tampil di sini.</p>
            </div>
        </div>
        <?php else: ?>
        <div class="umkm-grid" id="umkm-grid">
            <?php $__currentLoopData = $umkmList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $owner   = $umkm->user;
                $initial = strtoupper(substr($umkm->nama_usaha ?? $umkm->nama ?? 'U', 0, 1));
                $namaUmkm = $umkm->nama_usaha ?? $umkm->nama ?? '-';
            ?>
            <div class="umkm-card" data-nama="<?php echo e(strtolower($namaUmkm)); ?>" data-owner="<?php echo e(strtolower($owner?->name ?? '')); ?>">
                <div class="umkm-card-header">
                <div class="umkm-avatar">
    <?php if($umkm->logo): ?>
        <img src="<?php echo e(asset('storage/' . $umkm->logo)); ?>"
             alt="<?php echo e($namaUmkm); ?>"
             style="width:100%;height:100%;object-fit:contain;background:#fff;padding:4px;">
    <?php elseif($umkm->foto_produk): ?>
        <img src="<?php echo e(asset('storage/' . $umkm->foto_produk)); ?>"
             alt="<?php echo e($namaUmkm); ?>"
             style="width:100%;height:100%;object-fit:cover;">
    <?php else: ?>
        <?php echo e($initial); ?>

    <?php endif; ?>
</div>
                    <div style="flex:1;min-width:0">
                        <div class="umkm-name"><?php echo e($namaUmkm); ?></div>
                        <div class="umkm-owner"><?php echo e($owner?->name ?? '-'); ?></div>
                    </div>
                </div>
                <div class="umkm-card-body">
                    <?php if($umkm->deskripsi): ?>
                    <div class="umkm-desc"><?php echo e($umkm->deskripsi); ?></div>
                    <?php endif; ?>
                    <div class="umkm-meta">
                        <?php if($umkm->kategori): ?>
                        <span class="umkm-chip green"><?php echo e($umkm->kategori); ?></span>
                        <?php endif; ?>
                        <?php if($umkm->kota ?? $umkm->kabupaten): ?>
                        <span class="umkm-chip blue">📍 <?php echo e($umkm->kota ?? $umkm->kabupaten); ?></span>
                        <?php endif; ?>
                        <?php if($owner?->phone): ?>
                        <span class="umkm-chip">📞 <?php echo e($owner->phone); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($owner?->email): ?>
                    <div style="font-size:12px;color:var(--text-muted);display:flex;align-items:center;gap:6px">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <?php echo e($owner->email); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <div class="umkm-card-footer">
    <span class="umkm-date"><?php echo e(\Carbon\Carbon::parse($umkm->created_at)->translatedFormat('d M Y')); ?></span>
    <div style="display:flex;gap:6px;align-items:center;">
        
        <button onclick="lihatProdukUmkm(<?php echo e($umkm->id); ?>, '<?php echo e(addslashes($namaUmkm)); ?>')"
                class="btn btn-sm btn-outline" style="font-size:11px;padding:5px 10px;">
            📦 Produk
        </button>
        <?php if($owner?->phone): ?>
        <a href="https://wa.me/<?php echo e(preg_replace('/\D/','',$owner->phone)); ?>" target="_blank"
           class="btn btn-sm" style="background:#e8f5e4;color:#25d366;border:1px solid #a7d7c566;gap:5px;padding:5px 11px">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.12 1.524 5.847L.073 23.927l6.224-1.427C7.88 23.445 9.895 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.891 0-3.655-.52-5.165-1.424l-.37-.22-3.694.847.875-3.596-.242-.373A9.935 9.935 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            WA
        </a>
        <?php endif; ?>
    </div>
</div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div id="umkm-empty-search" style="display:none;text-align:center;padding:40px;color:var(--text-muted);background:var(--surface);border:1px solid var(--border);border-radius:var(--radius)">
            <div style="font-size:36px;margin-bottom:12px">🔍</div>
            <div style="font-size:14px;font-weight:600;color:var(--text)">Tidak ditemukan</div>
            <div style="font-size:13px;margin-top:4px">Coba kata kunci lain</div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="page-section" id="page-ulasan">
        <div class="section-header">
            <div class="section-title">Ulasan dari UMKM <span><?php echo e($totalUlasan); ?> ulasan</span></div>
        </div>

        <?php $ulasanList = $mentor ? $mentor->ulasanList()->with('user')->latest()->get() : collect(); ?>

        <?php if($ulasanList->isEmpty()): ?>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)">
            <div class="empty-state">
                <div class="empty-icon">💬</div>
                <h3>Belum ada ulasan</h3>
                <p>Ulasan dari UMKM binaan Anda akan tampil di sini.</p>
            </div>
        </div>
        <?php else: ?>
        
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px;margin-bottom:24px;box-shadow:var(--shadow);display:flex;align-items:center;gap:32px;flex-wrap:wrap">
            <div style="text-align:center;flex-shrink:0">
                <div style="font-size:52px;font-weight:800;color:var(--text);line-height:1"><?php echo e(number_format($avgRating, 1)); ?></div>
                <div style="color:#f59e0b;font-size:22px;margin:6px 0">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?php echo e($i <= round($avgRating) ? '★' : '☆'); ?>

                    <?php endfor; ?>
                </div>
                <div style="font-size:12px;color:var(--text-muted)"><?php echo e($totalUlasan); ?> ulasan</div>
            </div>
            <div style="flex:1;min-width:200px">
                <?php for($star = 5; $star >= 1; $star--): ?>
                <?php $count = $ulasanList->where('rating', $star)->count(); $pct = $totalUlasan ? round($count / $totalUlasan * 100) : 0; ?>
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

        <div class="ulasan-list">
            <?php $__currentLoopData = $ulasanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="ulasan-card">
                <div class="ulasan-header">
                    <div>
                        <div class="ulasan-reviewer"><?php echo e($ulasan->user?->name ?? 'Anonim'); ?></div>
                        <div class="ulasan-date"><?php echo e(\Carbon\Carbon::parse($ulasan->created_at)->translatedFormat('d M Y')); ?></div>
                    </div>
                    <div style="background:var(--surface2);padding:4px 10px;border-radius:20px;font-size:12px;font-weight:700;color:#f59e0b;border:1px solid #fcd34d66">
                        ★ <?php echo e($ulasan->rating); ?>.0
                    </div>
                </div>
                <div class="ulasan-stars">
                    <?php for($i = 1; $i <= 5; $i++): ?><?php echo e($i <= $ulasan->rating ? '★' : '☆'); ?><?php endfor; ?>
                </div>
               
<?php if($ulasan->komentar && trim($ulasan->komentar) !== ''): ?>
    <div class="ulasan-text">"<?php echo e($ulasan->komentar); ?>"</div>
<?php else: ?>
    <div style="font-size:12px;color:var(--text-muted);font-style:italic;display:flex;align-items:center;gap:5px">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        Tidak ada komentar tertulis
    </div>
<?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="page-section" id="page-profil">
        <?php if(session('success')): ?><div class="alert alert-success">✅ <?php echo e(session('success')); ?></div><?php endif; ?>

        <div class="profile-hero">
            <div class="profile-avatar-xl">
                <?php if($mentor?->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $mentor->foto)); ?>" alt="<?php echo e(auth()->user()->name); ?>">
                <?php else: ?>
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                <?php endif; ?>
            </div>
            <div class="profile-hero-info">
                <h2><?php echo e($mentor?->full_name ?? $mentor?->nama ?? auth()->user()->name); ?></h2>
                <p>Mentor · Bergabung sejak <?php echo e(\Carbon\Carbon::parse(auth()->user()->created_at)->translatedFormat('F Y')); ?></p>
                <?php if($mentor?->displayed_spesialisasi): ?>
                <p style="margin-top:4px;opacity:.8"><?php echo e($mentor->displayed_spesialisasi); ?></p>
                <?php endif; ?>
            </div>
            <button class="btn" style="background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.3);margin-left:auto;flex-shrink:0" onclick="openModal('modal-profil')">
                ✏️ Edit Profil
            </button>
        </div>

        <div class="profile-form-card">
            <div class="form-row">
                <div class="form-group">
                    <div class="form-label">Nama Lengkap</div>
                    <div class="form-static"><?php echo e($mentor?->full_name ?? $mentor?->nama ?? auth()->user()->name); ?></div>
                </div>
                <div class="form-group">
                    <div class="form-label">Email</div>
                    <div class="form-static"><?php echo e(auth()->user()->email); ?></div>
                </div>
                <div class="form-group">
                    <div class="form-label">No. Telepon / WhatsApp</div>
                    <div class="form-static">
                        <?php if($mentor?->phone ?? auth()->user()->phone): ?>
                            <span style="color:#25d366">✓</span> <?php echo e($mentor?->phone ?? auth()->user()->phone); ?>

                        <?php else: ?>
                            <span style="color:var(--text-muted);font-style:italic">Belum diisi</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">Lokasi</div>
                    <div class="form-static"><?php echo e($mentor?->alamat_tampil ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="form-group">
                <div class="form-label">Spesialisasi</div>
                <div class="form-static">
                    <?php if(count($spesArr) > 0): ?>
                        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-top:2px">
                            <?php $__currentLoopData = $spesArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="padding:3px 12px;border-radius:20px;font-size:12px;font-weight:600;background:var(--accent-light);color:var(--accent);border:1px solid #a7d7c566"><?php echo e($spes); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <span style="color:var(--text-muted);font-style:italic">Belum diisi</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">Bio / Tentang Saya</div>
                <div class="form-static" style="min-height:80px;line-height:1.7">
                    <?php echo e($mentor?->bio ?? 'Belum ada bio.'); ?>

                </div>
            </div>

            
<?php
$sosmedIconsMentor = [
    'instagram' => '<svg viewBox="0 0 24 24" width="20" height="20"><defs><radialGradient id="igm" cx="30%" cy="107%" r="150%"><stop offset="0%" stop-color="#ffd879"/><stop offset="40%" stop-color="#fd1d1d"/><stop offset="100%" stop-color="#833ab4"/></radialGradient></defs><rect x="2" y="2" width="20" height="20" rx="6" fill="url(#igm)"/><circle cx="12" cy="12" r="4.5" stroke="white" stroke-width="1.5" fill="none"/><circle cx="17" cy="7" r="1.2" fill="white"/></svg>',
    'linkedin'  => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#0077B5"/><path d="M7.5 9.5H5v9h2.5v-9zm-1.25-4a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm3.75 4h2.4v1.24h.04c.33-.63 1.15-1.29 2.37-1.29 2.53 0 3 1.67 3 3.84v4.21H15.3v-3.73c0-.89-.02-2.03-1.24-2.03-1.24 0-1.43.97-1.43 1.97v3.79H10V9.5z" fill="white"/></svg>',
    'twitter'   => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#14171A"/><path d="M17.5 4h2.5l-5.4 6.2 6.4 8.3h-5l-3.9-5.1-4.5 5.1H5.1l5.8-6.6L4.5 4H9.6l3.5 4.6L17.5 4zm-.9 12.9h1.4L7.6 5.4H6.1l10.5 11.5z" fill="white"/></svg>',
    'youtube'   => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#FF0000"/><path d="M19.6 8.2s-.2-1.3-.8-1.9c-.7-.8-1.5-.8-1.9-.8C14.7 5.4 12 5.4 12 5.4s-2.7 0-4.9.1c-.4 0-1.2.1-1.9.8-.6.6-.8 1.9-.8 1.9S4.2 9.5 4.2 11v1.3c0 1.5.2 2.9.2 2.9s.2 1.3.8 1.9c.7.8 1.7.7 2.1.8C8.7 18 12 18 12 18s2.7 0 4.9-.2c.4 0 1.2-.1 1.9-.8.6-.6.8-1.9.8-1.9s.2-1.4.2-2.9V11c0-1.5-.2-2.8-.2-2.8zm-11.4 5.8V9.7l5.3 2.2-5.3 2.1z" fill="white"/></svg>',
    'facebook'  => '<svg viewBox="0 0 24 24" width="20" height="20"><rect width="24" height="24" rx="5" fill="#1877F2"/><path d="M16 12h-2.5v7h-3v-7H9v-2.5h1.5v-1.6C10.5 6.1 11.5 5 13.4 5H16v2.5h-1.6c-.7 0-.9.4-.9.9v1.1H16L15.7 12z" fill="white"/></svg>',
];

$sosmedDataMentor = [];
if ($mentor && $mentor->sosmed) {
    $rawM = $mentor->getRawOriginal('sosmed');
    $decM = is_string($rawM) ? json_decode($rawM, true) : $rawM;
    $sosmedDataMentor = is_array($decM) ? $decM : [];
}

$sosmedCfgMentor = [
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

<hr style="border:none;border-top:1px solid var(--border);margin:8px 0 18px">
<div class="form-label" style="margin-bottom:14px">Media Sosial</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px">
    <?php $__currentLoopData = $sosmedCfgMentor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $val = $sosmedDataMentor[$key] ?? null; ?>
        <div style="display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:12px;
                    border:1.5px solid <?php echo e($val ? $cfg['border'] : 'var(--border)'); ?>;
                    background:<?php echo e($val ? $cfg['bg'] : 'var(--surface2)'); ?>">
            <div style="width:36px;height:36px;border-radius:10px;flex-shrink:0;display:flex;
                        align-items:center;justify-content:center;
                        background:<?php echo e($val ? '#fff' : 'var(--border)'); ?>;
                        border:1px solid <?php echo e($val ? $cfg['border'] : 'transparent'); ?>">
                <?php echo $sosmedIconsMentor[$key]; ?>

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

            
            <hr style="border:none;border-top:1px solid var(--border);margin:8px 0 18px">
            <div class="form-label">Status Akun</div>
            <div style="display:flex;align-items:center;gap:10px">
                <?php if($statusMentor === 'approved'): ?>
                    <span class="badge badge-approved"><span class="badge-dot"></span>Aktif & Terverifikasi</span>
                <?php elseif($statusMentor === 'pending'): ?>
                    <span class="badge badge-pending"><span class="badge-dot"></span>Menunggu Verifikasi</span>
                <?php elseif($statusMentor === 'rejected'): ?>
                    <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
                <?php else: ?>
                    <span class="badge badge-pending"><span class="badge-dot"></span>Belum Daftar</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<div class="modal-overlay" id="modal-produk-umkm">
    <div class="modal" style="width:680px;max-width:95vw;">
        <div class="modal-header">
            <div class="modal-title">
                Produk UMKM
                <small id="modal-produk-umkm-nama">-</small>
            </div>
            <button class="modal-close" onclick="closeModal('modal-produk-umkm')">×</button>
        </div>
        <div id="modal-produk-umkm-body" style="min-height:120px;">
            <div style="text-align:center;padding:40px;color:var(--text-muted)">
                <div style="font-size:32px;margin-bottom:8px">⏳</div>
                Memuat produk...
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-ghost" onclick="closeModal('modal-produk-umkm')">Tutup</button>
        </div>
    </div>
</div>
</main>


<div class="modal-overlay" id="modal-profil">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">
                Edit Profil
                <small>Perubahan langsung tersimpan</small>
            </div>
            <button class="modal-close" onclick="closeModal('modal-profil')">×</button>
        </div>
        <form method="POST" action="<?php echo e(route('mentor.profil.update')); ?>" enctype="multipart/form-data" autocomplete="off">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap *</label>
                    <input class="form-input" type="text" name="nama" value="<?php echo e($mentor?->full_name ?? $mentor?->nama ?? auth()->user()->name); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon / WhatsApp</label>
                    <input class="form-input" type="text" name="phone" value="<?php echo e($mentor?->phone ?? auth()->user()->phone ?? ''); ?>" placeholder="6281234567890">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasi</label>
                <input class="form-input" type="text" name="lokasi" value="<?php echo e($mentor?->lokasi ?? ''); ?>" placeholder="Contoh: Surabaya, Jawa Timur">
            </div>

            
<?php
$sosmedFieldsMentor = [
    'instagram' => ['label'=>'Instagram', 'placeholder'=>'username (tanpa @)', 'prefix'=>'@', 'hint'=>'Contoh: namaakun'],
    'linkedin'  => ['label'=>'LinkedIn',  'placeholder'=>'URL atau username',   'prefix'=>'',  'hint'=>'Contoh: https://linkedin.com/in/namaakun'],
    'twitter'   => ['label'=>'Twitter / X','placeholder'=>'username (tanpa @)', 'prefix'=>'@', 'hint'=>'Contoh: namaakun'],
    'youtube'   => ['label'=>'YouTube',   'placeholder'=>'URL channel YouTube', 'prefix'=>'',  'hint'=>'Contoh: https://youtube.com/@namaakun'],
    'facebook'  => ['label'=>'Facebook',  'placeholder'=>'URL halaman Facebook','prefix'=>'',  'hint'=>'Contoh: https://facebook.com/namaakun'],
];

$sosmedDataModal = [];
if ($mentor && $mentor->sosmed) {
    $rawModal = $mentor->getRawOriginal('sosmed');
    $decModal = is_string($rawModal) ? json_decode($rawModal, true) : $rawModal;
    $sosmedDataModal = is_array($decModal) ? $decModal : [];
}
?>

<div class="form-group">
    <label class="form-label">Media Sosial</label>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <?php $__currentLoopData = $sosmedFieldsMentor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $val = $sosmedDataModal[$key] ?? ''; ?>
        <div style="margin-bottom:0">
            <label class="form-label" style="display:flex;align-items:center;gap:8px;margin-bottom:6px">
                <?php echo $sosmedIconsMentor[$key]; ?>

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
</div>

            
            <div class="form-group">
                <label class="form-label">Spesialisasi</label>

                <?php
                $spesPresets = [
                    'Pemasaran Digital', 'Manajemen Keuangan', 'Pengembangan Produk',
                    'Strategi Bisnis', 'SDM & Organisasi', 'Ekspor & Impor',
                    'Sertifikasi Halal', 'Branding & Desain', 'E-Commerce',
                    'Produksi & Operasional', 'Legalitas Usaha', 'Akses Permodalan',
                ];
                // $spesArr sudah tersedia dari @php di atas (parseSpesialisasi)
                $savedSpesStr = implode(',', $spesArr);
                // Item custom = yang ada di DB tapi bukan preset
                $spesCustom = array_values(array_filter($spesArr, fn($v) => !in_array($v, $spesPresets)));
                ?>

                
                <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:10px" id="spes-chips">
                    <?php $__currentLoopData = $spesPresets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isActive = in_array($preset, $spesArr); ?>
                    <button type="button"
                        class="spes-chip"
                        onclick="toggleSpesChip(this)"
                        data-active="<?php echo e($isActive ? '1' : '0'); ?>"
                        style="padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;
                               border:1.5px solid <?php echo e($isActive ? 'var(--accent)' : '#d1d5db'); ?>;
                               background:<?php echo e($isActive ? 'var(--accent)' : '#f9fafb'); ?>;
                               color:<?php echo e($isActive ? '#fff' : '#4b5563'); ?>;
                               cursor:pointer;font-family:inherit;transition:all .15s">
                        <?php echo e($preset); ?>

                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div style="display:flex;gap:8px;margin-bottom:6px">
                    <input type="text" id="spes-custom-input" placeholder="Tambah spesialisasi lain..." class="form-input" style="flex:1"
                           onkeydown="if(event.key==='Enter'){event.preventDefault();addSpesCustom();}">
                    <button type="button" onclick="addSpesCustom()"
                        style="padding:9px 14px;font-size:12px;font-weight:600;color:#fff;background:var(--accent);border:none;border-radius:8px;cursor:pointer;font-family:inherit;white-space:nowrap">
                        + Tambah
                    </button>
                </div>

                
                <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:6px" id="spes-custom-tags">
                    <?php $__currentLoopData = $spesCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;background:#ede9fe;color:#5b21b6;border:1.5px solid #c4b5fd">
                        <?php echo e($item); ?>

                        <button type="button" onclick="removeSpesTag(this,'<?php echo e($item); ?>')"
                            style="background:none;border:none;cursor:pointer;font-size:15px;line-height:1;color:inherit;padding:0;opacity:.7">×</button>
                    </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <input type="hidden" name="spesialisasi" id="spes-value" value="<?php echo e($savedSpesStr); ?>">
                <div style="font-size:11px;color:var(--text-muted)">
                    <span id="spes-count"><?php echo e(count($spesArr)); ?></span> spesialisasi dipilih
                </div>

                
                <div style="margin-top:14px">
                    <label class="form-label">Yang Ditampilkan di Publik</label>
                    <select name="displayed_spesialisasi" id="spes-displayed" class="form-select">
                        <?php $__currentLoopData = $spesArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item); ?>" <?php echo e(($mentor?->displayed_spesialisasi === $item) ? 'selected' : ''); ?>><?php echo e($item); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if(count($spesArr) === 0): ?>
                        <option value="" disabled selected>— pilih spesialisasi dulu —</option>
                        <?php endif; ?>
                    </select>
                    <div class="form-hint">Spesialisasi utama yang tampil di kartu mentor publik.</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Bio</label>
                <textarea class="form-textarea" name="bio" rows="4" placeholder="Ceritakan pengalaman dan keahlian Anda..."><?php echo e($mentor?->bio ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Profil</label>
                <label class="upload-area" for="mentor-foto" id="mentor-foto-area" style="position:relative;overflow:hidden;min-height:110px">
                    <?php if($mentor?->foto): ?>
                    <img id="mentor-foto-preview"
                         src="<?php echo e(asset('storage/' . $mentor->foto)); ?>"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
                    <div id="mentor-foto-overlay"
                         style="position:absolute;inset:0;background:rgba(0,0,0,.45);border-radius:12px;z-index:2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        <span style="font-size:12px;font-weight:600;color:#fff">Ganti Foto</span>
                    </div>
                    <?php else: ?>
                    <div class="upload-icon">📷</div>
                    <div class="upload-text">Klik untuk upload atau <span>drag & drop</span></div>
                    <div class="upload-fname" id="mentor-foto-name"></div>
                    <?php endif; ?>
                </label>
                <input type="file" id="mentor-foto" name="foto" accept="image/*" style="display:none" onchange="onMentorFotoChange(this)">
                <div style="font-size:11px;color:var(--text-muted);margin-top:5px">JPG, PNG · Maks 2 MB</div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-profil')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
/* ================================================================
   PRODUK UMKM MODAL
================================================================ */
function lihatProdukUmkm(produkId, namaUmkm) {
    document.getElementById('modal-produk-umkm-nama').textContent = namaUmkm;
    document.getElementById('modal-produk-umkm-body').innerHTML = `
        <div style="text-align:center;padding:40px;color:var(--text-muted)">
            <div style="font-size:32px;margin-bottom:8px">⏳</div>
            Memuat produk...
        </div>`;
    openModal('modal-produk-umkm');

    fetch(`/api/mentor/produk-umkm/${produkId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        const body = document.getElementById('modal-produk-umkm-body');
        if (!data.length) {
            body.innerHTML = `
                <div style="text-align:center;padding:40px;color:var(--text-muted)">
                    <div style="font-size:40px;margin-bottom:12px">📦</div>
                    <div style="font-size:14px;font-weight:600;color:var(--text)">Belum ada produk</div>
                    <div style="font-size:13px;margin-top:4px">UMKM ini belum menambahkan produk.</div>
                </div>`;
            return;
        }
        body.innerHTML = `<div class="produk-grid-modal">` +
            data.map(p => `
                <div class="produk-card-modal">
                    <div class="produk-card-modal-img">
                        ${p.foto
                            ? `<img src="${p.foto}" alt="${p.nama}">`
                            : '📦'}
                    </div>
                    <div class="produk-card-modal-body">
                        ${p.is_unggulan ? '<span style="font-size:10px;color:#f59e0b;font-weight:700;">⭐ Unggulan</span>' : ''}
                        <div class="produk-card-modal-name">${p.nama}</div>
                        <div class="produk-card-modal-price">${p.harga}</div>
                        ${p.deskripsi ? `<div class="produk-card-modal-desc">${p.deskripsi}</div>` : ''}
                        ${p.stok ? `<div style="font-size:11px;color:var(--text-muted);margin-top:4px">Stok: ${p.stok} ${p.satuan ?? ''}</div>` : ''}
                    </div>
                </div>`).join('') +
        `</div>`;
    })
    .catch(() => {
        document.getElementById('modal-produk-umkm-body').innerHTML = `
            <div style="text-align:center;padding:40px;color:var(--accent2)">
                ⚠️ Gagal memuat produk.
            </div>`;
    });
}
/* ================================================================
   SIDEBAR TOGGLE
================================================================ */
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sidebar-overlay').classList.toggle('open');
    document.body.style.overflow = document.getElementById('sidebar').classList.contains('open') ? 'hidden' : '';
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
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
    const titles = { beranda: 'Dashboard Mentor', umkm: 'UMKM Binaan', ulasan: 'Ulasan', profil: 'Profil Saya' };
    document.getElementById('page-title').textContent = titles[id] || 'Dashboard';
    document.querySelectorAll('.nav-item').forEach(item => {
        if ((item.getAttribute('onclick') || '').includes("'" + id + "'")) item.classList.add('active');
    });
}

/* ================================================================
   MODAL
================================================================ */
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
});

/* ================================================================
   FILTER UMKM
================================================================ */
function filterUmkm(q) {
    const keyword = q.toLowerCase().trim();
    const cards   = document.querySelectorAll('#umkm-grid .umkm-card');
    let visible   = 0;
    cards.forEach(card => {
        const nama  = card.dataset.nama  || '';
        const owner = card.dataset.owner || '';
        const match = !keyword || nama.includes(keyword) || owner.includes(keyword);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    const emptyEl = document.getElementById('umkm-empty-search');
    if (emptyEl) emptyEl.style.display = visible === 0 ? 'block' : 'none';
}

/* ================================================================
   SPESIALISASI – state helpers
================================================================ */
function getSpesArr() {
    const v = document.getElementById('spes-value').value;
    return v ? v.split(',').map(s => s.trim()).filter(Boolean) : [];
}

function setSpesValue(arr) {
    // Deduplicate
    arr = [...new Set(arr.filter(Boolean))];

    document.getElementById('spes-value').value = arr.join(',');

    const count = document.getElementById('spes-count');
    if (count) count.textContent = arr.length;

    // Sync dropdown "displayed_spesialisasi"
    const select = document.getElementById('spes-displayed');
    if (!select) return;
    const prev = select.value;
    select.innerHTML = '';
    if (arr.length === 0) {
        const opt = document.createElement('option');
        opt.value = ''; opt.textContent = '— pilih spesialisasi dulu —';
        opt.disabled = true; opt.selected = true;
        select.appendChild(opt);
        return;
    }
    arr.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item; opt.textContent = item;
        if (item === prev) opt.selected = true;
        select.appendChild(opt);
    });
    // Jika nilai sebelumnya tidak ada lagi, pakai item pertama
    if (!arr.includes(prev)) select.value = arr[0];
}

/* ================================================================
   SPESIALISASI – toggle preset chip
================================================================ */
function toggleSpesChip(btn) {
    const label = btn.textContent.trim();
    let arr = getSpesArr();
    const isActive = btn.dataset.active === '1';
    if (isActive) {
        btn.dataset.active = '0';
        btn.style.background  = '#f9fafb';
        btn.style.borderColor = '#d1d5db';
        btn.style.color       = '#4b5563';
        arr = arr.filter(v => v !== label);
    } else {
        btn.dataset.active = '1';
        btn.style.background  = 'var(--accent)';
        btn.style.borderColor = 'var(--accent)';
        btn.style.color       = '#fff';
        if (!arr.includes(label)) arr.push(label);
    }
    setSpesValue(arr);
}

/* ================================================================
   SPESIALISASI – tambah custom tag
================================================================ */
function addSpesCustom() {
    const input = document.getElementById('spes-custom-input');
    const label = input.value.trim();
    if (!label) return;

    let arr = getSpesArr();
    if (arr.includes(label)) { input.value = ''; return; } // sudah ada, skip

    arr.push(label);
    setSpesValue(arr);

    // Render tag visual
    const container = document.getElementById('spes-custom-tags');
    const span = document.createElement('span');
    span.style.cssText = 'display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;background:#ede9fe;color:#5b21b6;border:1.5px solid #c4b5fd';
    // Simpan label di data-attribute agar removeSpesTag tidak bergantung pada teks
    span.dataset.label = label;
    span.innerHTML = label + ' <button type="button" onclick="removeSpesTag(this)" style="background:none;border:none;cursor:pointer;font-size:15px;line-height:1;color:inherit;padding:0;opacity:.7">×</button>';
    container.appendChild(span);

    input.value = '';
}

/* ================================================================
   SPESIALISASI – hapus custom tag
================================================================ */
function removeSpesTag(btn) {
    const span  = btn.closest('span');
    const label = span.dataset.label || span.textContent.replace('×', '').trim();
    span.remove();
    const arr = getSpesArr().filter(v => v !== label);
    setSpesValue(arr);
}

/* ================================================================
   FOTO PROFIL PREVIEW
================================================================ */
function onMentorFotoChange(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        const area    = document.getElementById('mentor-foto-area');
        const preview = document.getElementById('mentor-foto-preview');
        let   overlay = document.getElementById('mentor-foto-overlay');

        if (preview) {
            preview.src = e.target.result;
        } else {
            const img = document.createElement('img');
            img.id = 'mentor-foto-preview';
            img.src = e.target.result;
            img.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1';
            area.appendChild(img);
        }

        // Buat / update overlay
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'mentor-foto-overlay';
            overlay.style.cssText = 'position:absolute;inset:0;background:rgba(0,0,0,.45);border-radius:12px;z-index:2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px';
            area.appendChild(overlay);
        }
        overlay.style.display = 'flex';
        overlay.innerHTML = `<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg><span style="font-size:12px;font-weight:600;color:#fff">✓ ${file.name}</span>`;

        // Sembunyikan placeholder
        area.querySelectorAll('.upload-icon,.upload-text,.upload-fname').forEach(el => el.style.display = 'none');
    };
    reader.readAsDataURL(file);
}

/* ================================================================
   INIT
================================================================ */
document.addEventListener('DOMContentLoaded', function() {
    // ---- Routing hash / session ----
    const hash = window.location.hash.replace('#', '');
    if (['beranda', 'umkm', 'ulasan', 'profil'].includes(hash)) {
        showPage(hash);
    }
    

    // ---- Pastikan visual chip sesuai data-active dari server ----
    // (Blade sudah set inline style, tapi ini sebagai safety-net)
    document.querySelectorAll('.spes-chip').forEach(btn => {
        if (btn.dataset.active === '1') {
            btn.style.background  = 'var(--accent)';
            btn.style.borderColor = 'var(--accent)';
            btn.style.color       = '#fff';
        } else {
            btn.style.background  = '#f9fafb';
            btn.style.borderColor = '#d1d5db';
            btn.style.color       = '#4b5563';
        }
    });
});
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\webkajiindonesia\resources\views/pages/mentor/dashboard.blade.php ENDPATH**/ ?>