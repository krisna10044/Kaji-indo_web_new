<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard UMKM – KAJI Indonesia</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #f8f4ef;
    --surface: #ffffff;
    --surface2: #f2ede7;
    --border: #e8e0d6;
    --accent: #2d6a4f;
    --accent-light: #e8f5e9;
    --accent2: #e76f51;
    --accent3: #457b9d;
    --text: #1a1a2e;
    --text-muted: #7a7065;
    --radius: 16px;
    --shadow: 0 2px 16px rgba(45,106,79,.07);
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

  /* ============ SIDEBAR ============ */
  .sidebar {
    width: 265px; min-height: 100vh; background: var(--accent);
    display: flex; flex-direction: column; position: fixed; top: 0; left: 0; z-index: 100;
  }
  .sidebar-brand { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,.12); }
  .brand-box { display: flex; align-items: center; gap: 12px; }
  .brand-icon { width: 42px; height: 42px; background: rgba(255,255,255,.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; }
  .brand-icon svg { color: #fff; }
  .brand-name { font-family: 'Cormorant Garamond', serif; font-size: 20px; color: #fff; font-weight: 700; }
  .brand-role { font-size: 11px; color: rgba(255,255,255,.6); letter-spacing: 1.5px; text-transform: uppercase; }

  .nav-section { padding: 20px 16px 8px; }
  .nav-label { font-size: 10px; color: rgba(255,255,255,.4); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; padding-left: 10px; }
  .nav-item {
    display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 12px;
    cursor: pointer; color: rgba(255,255,255,.7); font-size: 14px; font-weight: 500;
    margin-bottom: 3px; transition: all .2s; text-decoration: none;
  }
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
  .btn-ghost { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--border); }
  .btn-sm { padding: 6px 14px; font-size: 12px; border-radius: 8px; }
  .btn-outline { background: transparent; border: 1.5px solid var(--accent); color: var(--accent); }
  .btn-outline:hover { background: var(--accent); color: #fff; }
  .btn-danger { background: #fff0ed; color: var(--accent2); border: 1.5px solid #e76f5133; }
  .btn-danger:hover { background: var(--accent2); color: #fff; }
  .btn-gold { background: #fff8e1; color: #b45309; border: 1.5px solid #fcd34d66; }
  .btn-gold:hover { background: #f59e0b; color: #fff; }

  .content { padding: 32px; }

  /* ============ STATS ============ */
  .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }
  .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 22px; box-shadow: var(--shadow); position: relative; overflow: hidden; }
  .stat-card.mentor-active-box { border-left: 4px solid var(--accent); }
  .stat-card.mentor-empty-box { border-left: 4px solid var(--accent2); }
  .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px; }
  .stat-icon.green { background: var(--accent-light); }
  .stat-icon.orange { background: #fff3ed; }
  .stat-icon.blue { background: #e3f0fa; }
  .stat-label { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
  .stat-value { font-size: 28px; font-weight: 800; color: var(--text); }
  .stat-sub { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

  /* ============ SECTION HEADER ============ */
  .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
  .section-title { font-size: 17px; font-weight: 700; }
  .section-title span { color: var(--text-muted); font-weight: 400; font-size: 14px; margin-left: 8px; }
  .section-actions { display: flex; gap: 10px; align-items: center; }

  /* ============ PRODUK ITEMS GRID ============ */
  .items-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-bottom: 28px; }
  .item-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); transition: all .25s; position: relative; }
  .item-card:hover { transform: translateY(-3px); box-shadow: 0 12px 36px rgba(45,106,79,.12); }
  .item-card.is-unggulan { border: 2px solid #f59e0b; }
  .item-img { width: 100%; height: 150px; background: var(--surface2); display: flex; align-items: center; justify-content: center; font-size: 40px; position: relative; overflow: hidden; }
  .item-img img { width: 100%; height: 100%; object-fit: cover; }
  .unggulan-ribbon { position: absolute; top: 0; left: 0; background: linear-gradient(135deg,#f59e0b,#d97706); color: #fff; font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 0 0 10px 0; letter-spacing: .5px; z-index: 2; }
  .item-body { padding: 14px; }
  .item-category { font-size: 10px; color: var(--accent); text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 4px; }
  .item-name { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
  .item-desc { font-size: 12px; color: var(--text-muted); line-height: 1.5; margin-bottom: 8px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
  .item-price { font-size: 14px; font-weight: 700; color: var(--accent); margin-bottom: 10px; }
  .item-stok { font-size: 11px; color: var(--text-muted); }
  .item-actions { display: flex; gap: 6px; flex-wrap: wrap; padding: 0 14px 14px; }

  /* ============ TABLE ============ */
  .table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 28px; box-shadow: var(--shadow); }
  table { width: 100%; border-collapse: collapse; }
  thead th { padding: 14px 18px; text-align: left; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-muted); background: var(--surface2); border-bottom: 1px solid var(--border); }
  tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: #f9f7f4; }
  tbody td { padding: 14px 18px; font-size: 13px; }
  .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
  .badge-pending  { background: #fff8e1; color: #f59e0b; border: 1px solid #fcd34d66; }
  .badge-approved { background: var(--accent-light); color: var(--accent); border: 1px solid #a7d7c566; }
  .badge-rejected { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }
  .badge-gold     { background: #fff8e1; color: #b45309; border: 1px solid #fcd34d66; }
  .badge-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

  /* ============ ALERT ============ */
  .alert { padding: 14px 18px; border-radius: 10px; font-size: 13px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
  .alert-success { background: var(--accent-light); color: var(--accent); border: 1px solid #a7d7c566; }
  .alert-error   { background: #fff0ed; color: var(--accent2); border: 1px solid #e76f5166; }

  /* ============ FORM ============ */
  .profile-hero { background: linear-gradient(135deg, var(--accent) 0%, #1b4332 100%); border-radius: var(--radius); padding: 32px; margin-bottom: 24px; display: flex; align-items: center; gap: 24px; box-shadow: var(--shadow); }
  .profile-avatar-xl { width: 80px; height: 80px; border-radius: 18px; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: 800; color: #fff; border: 3px solid rgba(255,255,255,.3); flex-shrink: 0; overflow: hidden; }
  .profile-avatar-xl img { width: 100%; height: 100%; object-fit: cover; }
  .profile-hero-info h2 { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 4px; }
  .profile-hero-info p { color: rgba(255,255,255,.7); font-size: 14px; }
  .profile-form-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 28px; box-shadow: var(--shadow); }
  .form-group { margin-bottom: 18px; }
  .form-label { display: block; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
  .form-input, .form-textarea, .form-select { width: 100%; padding: 11px 14px; background: var(--surface2); border: 1.5px solid var(--border); border-radius: 10px; color: var(--text); font-family: inherit; font-size: 14px; transition: border .2s; }
  .form-input:focus, .form-textarea:focus, .form-select:focus { outline: none; border-color: var(--accent); background: #fff; }
  .form-textarea { min-height: 90px; resize: vertical; }
  .form-static { padding: 11px 14px; background: var(--bg); border: 1.5px solid var(--border); border-radius: 10px; font-size: 14px; color: var(--text); }
  .form-hint { font-size: 11px; color: var(--text-muted); margin-top: 5px; }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
  .form-divider { border: none; border-top: 1px solid var(--border); margin: 8px 0 18px; }

  .upload-area { position: relative; width: 100%; min-height: 110px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; padding: 24px; border: 2px dashed #2d6a4f66; border-radius: 14px; background: #faf8f5; text-align: center; cursor: pointer; transition: all .2s; }
  .upload-area:hover { background: #eef8f1; border-color: var(--accent); }
  .upload-icon { font-size: 36px; line-height: 1; }
  .upload-text { font-size: 13px; color: var(--text-muted); line-height: 1.6; }
  .upload-text span { color: var(--accent); font-weight: 700; }
  .upload-fname { margin-top: 4px; font-size: 12px; font-weight: 600; color: var(--accent); word-break: break-word; }

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

  /* ============ UNGGULAN BANNER ============ */
  .unggulan-banner { background: linear-gradient(135deg, #fff8e1, #fffde7); border: 2px solid #fcd34d; border-radius: var(--radius); padding: 20px 24px; margin-bottom: 24px; display: flex; align-items: center; gap: 16px; }
  .unggulan-banner-icon { font-size: 36px; flex-shrink: 0; }
  .unggulan-banner-info h3 { font-size: 15px; font-weight: 700; color: #92400e; margin-bottom: 4px; }
  .unggulan-banner-info p { font-size: 12px; color: #b45309; line-height: 1.5; }

  /* ============ PAGE SECTIONS ============ */
  .page-section { display: none; }
  .page-section.active { display: block; }

  /* ============ EMPTY STATE ============ */
  .empty-state { text-align: center; padding: 60px 20px; color: var(--text-muted); }
  .empty-state .empty-icon { font-size: 48px; margin-bottom: 16px; }
  .empty-state h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; color: var(--text); }
  .empty-state p { font-size: 13px; line-height: 1.6; }

  /* ============ HAMBURGER ============ */
  .hamburger-btn { display: none; flex-direction: column; justify-content: center; gap: 5px; width: 38px; height: 38px; background: var(--surface2); border: 1px solid var(--border); border-radius: 10px; cursor: pointer; padding: 8px; flex-shrink: 0; }
  .hamburger-btn span { display: block; width: 100%; height: 2px; background: var(--text); border-radius: 2px; }
  .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 99; }
  .sidebar-overlay.open { display: block; }

  ::-webkit-scrollbar { width: 5px; }
  ::-webkit-scrollbar-track { background: var(--bg); }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

  @media (min-width: 769px) and (max-width: 1100px) {
    .sidebar { width: 220px; }
    .main { margin-left: 220px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .items-grid { grid-template-columns: repeat(2, 1fr); }
    .content { padding: 24px 20px; }
    .topbar { padding: 14px 20px; }
    .modal { width: 90vw !important; }
  }

  @media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); transition: transform .3s ease; width: 260px; z-index: 100; box-shadow: 4px 0 24px rgba(0,0,0,.2); }
    .sidebar.open { transform: translateX(0); }
    .main { margin-left: 0 !important; }
    .topbar { padding: 12px 16px !important; gap: 8px; }
    .topbar-title { font-size: 18px !important; }
    .topbar .btn-ghost { display: none; }
    .hamburger-btn { display: flex !important; }
    .content { padding: 16px !important; }
    .stats-grid { grid-template-columns: 1fr 1fr !important; gap: 10px !important; margin-bottom: 16px !important; }
    .stats-grid .stat-card:nth-child(3) { grid-column: span 2 !important; }
    .stat-card { padding: 14px !important; }
    .stat-value { font-size: 22px !important; }
    .items-grid { grid-template-columns: 1fr !important; }
    .section-header { flex-direction: column !important; align-items: flex-start !important; gap: 8px !important; }
    .section-actions { width: 100%; flex-wrap: wrap; }
    .form-row, .form-row-3 { grid-template-columns: 1fr; gap: 0; }
    .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .modal-overlay { align-items: flex-end; }
    .modal { width: 100% !important; max-height: 92vh; border-radius: 20px 20px 0 0; padding: 24px 20px; }
    .profile-hero { flex-direction: column; text-align: center; gap: 16px; padding: 24px 20px; }
    .unggulan-banner { flex-direction: column; text-align: center; }
  }
  @media (max-width: 400px) {
    .stats-grid { grid-template-columns: 1fr !important; }
    .stats-grid .stat-card:nth-child(3) { grid-column: span 1 !important; }
  }
</style>
</head>
<body>

<div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>


<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-box">
      <div class="brand-icon">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
        </svg>
      </div>
      <div>
        <div class="brand-name">KAJI Indonesia</div>
        <div class="brand-role">UMKM</div>
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

    <div class="nav-item" onclick="showPage('profil-umkm')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>
      </svg>
      Profil UMKM
      <span class="nav-badge"><?php echo e($stats['total_produk']); ?></span>
    </div>

    
    <?php if($myUmkm): ?>
    <div class="nav-item" onclick="showPage('produk-items')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
      </svg>
      Produk Saya
      <?php if($produkItems->count() > 0): ?>
        <span class="nav-badge"><?php echo e($produkItems->count()); ?></span>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if($myUmkm): ?>
<div class="nav-item" onclick="showPage('produk-terhapus')">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
    </svg>
    Produk Terhapus
    <?php if($produkTerhapus->count() > 0): ?>
        <span class="nav-badge" style="background:#9ca3af;"><?php echo e($produkTerhapus->count()); ?></span>
    <?php endif; ?>
</div>
<?php endif; ?>

    <div class="nav-item" onclick="showPage('program')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
      </svg>
      Program Tersedia
    </div>
  </div>

  <div class="nav-section">
    <div class="nav-label">Akun</div>

    <div class="nav-item" onclick="showPage('profil')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>
      Profil Saya
    </div>

    <a href="<?php echo e(route('logout')); ?>"
       onclick="event.preventDefault(); document.getElementById('logout-form-umkm').submit();"
       class="nav-item">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
      </svg>
      Keluar
    </a>
    <form id="logout-form-umkm" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none"><?php echo csrf_field(); ?></form>
  </div>

  <div class="sidebar-user">
    <div class="user-card" onclick="showPage('profil')">
      <div class="user-avatar">
        <?php if($user->profile_photo_path): ?>
          <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>">
        <?php else: ?>
          <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

        <?php endif; ?>
      </div>
      <div>
        <div class="user-name"><?php echo e($user->name); ?></div>
        <div class="user-role">Mitra UMKM · <?php echo e($user->location ?? 'Indonesia'); ?></div>
      </div>
    </div>
  </div>
</aside>


<main class="main">
  <header class="topbar">
    <button class="hamburger-btn" onclick="toggleSidebar()">
      <span></span><span></span><span></span>
    </button>
    <div class="topbar-title" id="page-title">Dashboard UMKM</div>
    <div style="display:flex;gap:10px;align-items:center">
      <span style="font-size:13px;color:var(--text-muted)">Halo, <?php echo e($user->name); ?> 👋</span>
      <a href="<?php echo e(route('profile')); ?>" class="btn btn-ghost" style="font-size:13px;padding:8px 16px;">
        ← Profil
      </a>
    </div>
  </header>

  <div class="content">

    <?php if(session('success')): ?>
      <div class="alert alert-success">✅ <?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
      <div class="alert alert-error">⚠️ <?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <div class="page-section active" id="page-beranda">

    <div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">📦</div>
        <div class="stat-label">Total Produk</div>
        <div class="stat-value"><?php echo e($produkItems->count()); ?></div>
        <div class="stat-sub">
            <?php $unggulan = $produkItems->where('is_unggulan', true)->first(); ?>
            <?php echo e($unggulan ? '⭐ ' . $unggulan->nama : 'Belum ada produk unggulan'); ?>

        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">👨‍🏫</div>
        <div class="stat-label">Mentor Aktif</div>
        <div class="stat-value"><?php echo e($myMentors->count()); ?></div>
        <div class="stat-sub"><?php echo e($myMentors->count() > 0 ? $myMentors->first()->full_name ?? $myMentors->first()->nama : 'Belum ada mentor'); ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">📋</div>
        <div class="stat-label">Program Diikuti</div>
        <div class="stat-value"><?php echo e($stats['program_diikuti']); ?></div>
        <div class="stat-sub">Terdaftar aktif</div>
    </div>
</div>

      
      <?php if($myMentors->count() > 0): ?>
    <div style="margin-bottom:32px;">
        <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:1.5px;font-weight:700;margin-bottom:12px;">
            👨‍🏫 Mentor Pendamping Anda (<?php echo e($myMentors->count()); ?>)
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <?php $__currentLoopData = $myMentors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="stat-card mentor-active-box" style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:16px 20px;">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div style="width:44px;height:44px;border-radius:50%;overflow:hidden;background:var(--accent-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--accent);">
                        <?php if($m->white_bg_photo): ?>
                            <img src="<?php echo e(asset('storage/' . $m->white_bg_photo)); ?>" style="width:100%;height:100%;object-fit:cover;">
                        <?php elseif($m->foto): ?>
                            <img src="<?php echo e(asset('storage/' . $m->foto)); ?>" style="width:100%;height:100%;object-fit:cover;">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr($m->full_name ?? $m->nama, 0, 2))); ?>

                        <?php endif; ?>
                    </div>
                    <div>
                    <div style="font-size:15px;font-weight:700;color:var(--text);"><?php echo e($m->full_name ?? $m->nama); ?></div>


<div style="font-size:12px;color:var(--text-muted);margin-top:2px;">
    📞 <?php echo e($m->phone ?? '-'); ?> &nbsp;|&nbsp; 📧 <?php echo e($m->email ?? '-'); ?>

</div>


<?php
    $mSpes = [];
    $rawMSpes = $m->spesialisasi;
    if (is_array($rawMSpes)) {
        $mSpes = array_values(array_filter(array_map('trim', $rawMSpes)));
    } elseif (is_string($rawMSpes) && $rawMSpes) {
        $dec = json_decode($rawMSpes, true);
        $mSpes = is_array($dec)
            ? array_values(array_filter(array_map('trim', $dec)))
            : array_values(array_filter(array_map('trim', explode(',', $rawMSpes))));
    }
?>
<?php if(count($mSpes) > 0): ?>
<div style="display:flex;flex-wrap:wrap;gap:4px;margin-top:6px;">
    <?php $__currentLoopData = array_slice($mSpes, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span style="display:inline-block;background:var(--accent-light);color:var(--accent);
                 font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;
                 text-transform:uppercase;letter-spacing:.5px;">
        <?php echo e($s); ?>

    </span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($mSpes) > 3): ?>
                    <span style="font-size:10px;color:var(--text-muted);align-self:center;">
                        +<?php echo e(count($mSpes) - 3); ?> lainnya
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                    </div>
                </div>

                
                <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">

                <?php
                    $mSosmed = [];
                    if (!empty($m->sosmed)) {
                        $dec = is_array($m->sosmed) ? $m->sosmed : json_decode($m->sosmed, true);
                        $mSosmed = is_array($dec) ? $dec : [];
                    }
                    $mSosmedCfg = [
                        'instagram' => [
                            'prefix' => 'https://instagram.com/',
                            'title'  => 'Instagram',
                            'svg'    => '<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
                            'bg'     => 'linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888)',
                        ],
                        'twitter' => [
                            'prefix' => 'https://x.com/',
                            'title'  => 'X / Twitter',
                            'svg'    => '<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.259 5.63 5.905-5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                            'bg'     => '#000',
                        ],
                        'linkedin' => [
                            'prefix' => 'https://linkedin.com/in/',
                            'title'  => 'LinkedIn',
                            'svg'    => '<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
                            'bg'     => '#0077b5',
                        ],
                        'youtube' => [
                            'prefix' => 'https://youtube.com/@',
                            'title'  => 'YouTube',
                            'svg'    => '<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                            'bg'     => '#ff0000',
                        ],
                    ];
                ?>

                <?php $__currentLoopData = $mSosmedCfg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($mSosmed[$key])): ?>
                    <?php
                        $val = $mSosmed[$key];
                        $url = str_starts_with($val, 'http') ? $val : ($cfg['prefix'] . ltrim($val, '/'));
                    ?>
                    <a href="<?php echo e($url); ?>" target="_blank" rel="noopener noreferrer"
                       title="<?php echo e($cfg['title']); ?>"
                       style="display:inline-flex;align-items:center;justify-content:center;
                              width:30px;height:30px;border-radius:8px;
                              background:<?php echo e($cfg['bg']); ?>;color:#fff;
                              text-decoration:none;flex-shrink:0;opacity:.9;transition:opacity .2s;"
                       onmouseover="this.style.opacity='1';this.style.transform='translateY(-1px)'"
                       onmouseout="this.style.opacity='.9';this.style.transform='translateY(0)'">
                        <?php echo $cfg['svg']; ?>

                    </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if($m->phone): ?>
                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $m->phone)); ?>"
                   target="_blank" class="btn btn-sm"
                   style="background:#25d366;color:#fff;font-size:12px;border-radius:8px;">
                   💬 Chat
                </a>
                <?php endif; ?>

                
                <button type="button"
                        onclick="bukaMOdalLepasMentor('<?php echo e($m->id); ?>', '<?php echo e(addslashes($m->full_name ?? $m->nama)); ?>')"
                        class="btn btn-danger btn-sm" style="font-size:12px;">
                    Lepas
                </button>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php else: ?>
    <div class="stat-card mentor-empty-box" style="margin-bottom:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;background:#fffcfb;">
        <div style="display:flex;align-items:center;gap:16px;">
            <div class="stat-icon orange" style="margin-bottom:0;font-size:22px;width:48px;height:48px;border-radius:50%;">📢</div>
            <div>
                <div style="font-size:15px;font-weight:700;color:var(--text);">Anda Belum Memiliki Mentor Pendamping</div>
                <div style="font-size:12px;color:var(--text-muted);margin-top:2px;">Hubungkan UMKM Anda dengan pembimbing terbaik kami. Bisa lebih dari satu!</div>
            </div>
        </div>
        <a href="<?php echo e(route('umkm.pembimbing')); ?>" class="btn btn-ghost" style="font-size:12px;padding:8px 16px;border-radius:8px;border-color:var(--accent2);color:var(--accent2);">
            Cari Mentor →
        </a>
    </div>
<?php endif; ?>

      
      <?php if($unggulan): ?>
      <div class="unggulan-banner" style="margin-bottom:24px;">
        <div class="unggulan-banner-icon">⭐</div>
        <div class="unggulan-banner-info" style="flex:1;">
          <h3>Produk Unggulan: <?php echo e($unggulan->nama); ?></h3>
          <p>Produk ini tampil di halaman publik UMKM Anda sebagai produk andalan.
             Harga: <strong><?php echo e($unggulan->harga_format); ?></strong>
             <?php if($unggulan->stok): ?> · Stok: <?php echo e($unggulan->stok); ?> <?php endif; ?>
          </p>
        </div>
        <button onclick="showPage('produk-items')" class="btn btn-gold btn-sm">Kelola Produk →</button>
      </div>
      <?php endif; ?>

      <div class="section-header">
        <div class="section-title">Status Pengajuan UMKM <span>terbaru</span></div>
      </div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>Nama UMKM</th><th>Kategori</th><th>Diajukan</th><th>Status</th></tr></thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $myProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><strong><?php echo e($product->nama); ?></strong></td>
              <td><?php echo e($product->kategori); ?></td>
              <td><?php echo e($product->created_at->translatedFormat('d M Y')); ?></td>
              <td>
                <?php if($product->status == 'approved'): ?>
                  <span class="badge badge-approved"><span class="badge-dot"></span>Disetujui</span>
                <?php elseif($product->status == 'rejected'): ?>
                  <span class="badge badge-rejected"><span class="badge-dot"></span>Ditolak</span>
                <?php else: ?>
                  <span class="badge badge-pending"><span class="badge-dot"></span>Pending</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4" style="text-align:center;color:#7a7065;padding:40px;">Belum ada riwayat pengajuan UMKM.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    
<div class="page-section" id="page-profil-umkm">

  <?php if(!$myUmkm): ?>
    <div class="empty-state">
      <div class="empty-icon">🛍️</div>
      <h3>Profil usaha belum tersedia</h3>
      <p>Hubungi admin untuk mendaftarkan usaha Anda.</p>
    </div>
  <?php else: ?>
    <div class="profile-hero">
      <div class="profile-avatar-xl">
        <?php if($myUmkm->logo): ?>
          <img src="<?php echo e(asset('storage/' . $myUmkm->logo)); ?>" alt="Logo <?php echo e($myUmkm->nama); ?>"
               style="object-fit:contain;padding:4px;background:#fff;">
        <?php elseif($myUmkm->foto_produk): ?>
          <img src="<?php echo e(asset('storage/' . $myUmkm->foto_produk)); ?>" alt="<?php echo e($myUmkm->nama); ?>">
        <?php else: ?>
          🛍️
        <?php endif; ?>
      </div>
      <div class="profile-hero-info">
        <h2><?php echo e($myUmkm->nama); ?></h2>
        <p><?php echo e($myUmkm->kategori); ?> · Terdaftar <?php echo e($myUmkm->created_at->translatedFormat('F Y')); ?></p>
      </div>
      <?php if($myUmkm->status == 'approved'): ?>
        <span class="badge badge-approved" style="margin-left:auto"><span class="badge-dot"></span>Disetujui</span>
      <?php elseif($myUmkm->status == 'rejected'): ?>
        <span class="badge badge-rejected" style="margin-left:auto"><span class="badge-dot"></span>Ditolak</span>
      <?php else: ?>
        <span class="badge badge-pending" style="margin-left:auto"><span class="badge-dot"></span>Menunggu Persetujuan</span>
      <?php endif; ?>
      <button class="btn" style="background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.3);"
        onclick="openModal('modal-edit-usaha')">Edit Data Usaha</button>
    </div>

    <div class="profile-form-card">
      <div class="form-row">
        <div class="form-group">
          <div class="form-label">Nama Usaha</div>
          <div class="form-static"><?php echo e($myUmkm->nama); ?></div>
        </div>
        <div class="form-group">
          <div class="form-label">Kategori</div>
          <div class="form-static"><?php echo e($myUmkm->kategori); ?></div>
        </div>
        <div class="form-group">
          <div class="form-label">No. WhatsApp Usaha</div>
          <div class="form-static"><?php echo e($myUmkm->kontak ?? '-'); ?></div>
        </div>
        <div class="form-group">
          <div class="form-label">Logo Usaha</div>
          <div class="form-static" style="padding:10px;display:flex;align-items:center;gap:10px;">
            <?php if($myUmkm->logo): ?>
              <img src="<?php echo e(asset('storage/' . $myUmkm->logo)); ?>"
                   alt="Logo <?php echo e($myUmkm->nama); ?>"
                   style="height:52px;width:52px;object-fit:contain;border-radius:10px;
                          border:1px solid var(--border);background:#fff;padding:4px;">
              <span style="font-size:12px;color:var(--text-muted);">Logo terdaftar</span>
            <?php else: ?>
              <span style="color:var(--text-muted);font-style:italic;">Belum ada logo</span>
            <?php endif; ?>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label">Status Verifikasi</div>
          <div class="form-static">
            <?php if($myUmkm->status == 'approved'): ?>
              <span style="color:var(--accent)">✓ Sudah diverifikasi admin</span>
            <?php elseif($myUmkm->status == 'rejected'): ?>
              <span style="color:var(--accent2)">✗ Ditolak · <?php echo e($myUmkm->rejection_reason); ?></span>
            <?php else: ?>
              <span style="color:#f59e0b">⏳ Menunggu verifikasi admin</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="form-label">Deskripsi Usaha</div>
        <div class="form-static" style="min-height:80px;line-height:1.6;"><?php echo e($myUmkm->deskripsi); ?></div>
      </div>
    </div>
  <?php endif; ?>
</div>

    
    <div class="page-section" id="page-produk-items">

      <?php if(!$myUmkm): ?>
        
        <div class="empty-state">
          <div class="empty-icon">⏳</div>
          <h3>Profil UMKM Belum Disetujui</h3>
          <p>Anda baru bisa menambahkan produk setelah profil UMKM disetujui oleh admin.</p>
          <button class="btn btn-ghost" style="margin-top:16px;" onclick="showPage('profil-umkm')">Lihat Status UMKM</button>
        </div>
      <?php else: ?>
        

        
        <?php if($unggulan): ?>
        <div class="unggulan-banner" style="margin-bottom:24px;">
          <div class="unggulan-banner-icon">⭐</div>
          <div class="unggulan-banner-info" style="flex:1;">
            <h3>Produk Unggulan Saat Ini: <?php echo e($unggulan->nama); ?></h3>
            <p>Produk ini ditampilkan sebagai andalan di halaman publik UMKM Anda. Ganti dengan klik "Jadikan Unggulan" pada produk lain.</p>
          </div>
        </div>
        <?php endif; ?>

        <div class="section-header">
          <div class="section-title">
            Produk Saya
            <span><?php echo e($produkItems->count()); ?> produk · dari <?php echo e($myUmkm->nama); ?></span>
          </div>
          <button class="btn btn-primary" onclick="openModal('modal-tambah-item')">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Produk
          </button>
        </div>

        <?php if($produkItems->count() > 0): ?>
        <div class="items-grid">
          <?php $__currentLoopData = $produkItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="item-card <?php echo e($item->is_unggulan ? 'is-unggulan' : ''); ?>">
            <div class="item-img">
              <?php if($item->is_unggulan): ?>
                <div class="unggulan-ribbon">⭐ Unggulan</div>
              <?php endif; ?>
              <?php if($item->foto): ?>
                <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" alt="<?php echo e($item->nama); ?>">
              <?php else: ?>
                📦
              <?php endif; ?>
            </div>
            <div class="item-body">
              <div class="item-category"><?php echo e($item->kategori ?? 'Umum'); ?></div>
              <div class="item-name"><?php echo e($item->nama); ?></div>
              <div class="item-desc"><?php echo e($item->deskripsi); ?></div>
              <div class="item-price"><?php echo e($item->harga_format); ?></div>
              <?php if($item->stok): ?>
                <div class="item-stok">Stok: <?php echo e($item->stok); ?> <?php echo e($item->satuan); ?></div>
              <?php endif; ?>
            </div>
            <div class="item-actions">
              
              <?php if($item->is_unggulan): ?>
                <form method="POST" action="<?php echo e(route('produk-item.unset-unggulan', $item->id)); ?>" style="flex:1;">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-gold btn-sm" style="width:100%;">⭐ Lepas Unggulan</button>
                </form>
              <?php else: ?>
                <form method="POST" action="<?php echo e(route('produk-item.set-unggulan', $item->id)); ?>" style="flex:1;">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-ghost btn-sm" style="width:100%;">☆ Jadikan Unggulan</button>
                </form>
              <?php endif; ?>

              
              <button class="btn btn-outline btn-sm" onclick="openEditItem(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->nama)); ?>', '<?php echo e(addslashes($item->deskripsi ?? '')); ?>', '<?php echo e($item->kategori); ?>', <?php echo e($item->harga); ?>, '<?php echo e(addslashes($item->stok ?? '')); ?>', '<?php echo e(addslashes($item->satuan ?? '')); ?>')">
                ✏️
              </button>

              
              <button type="button" class="btn btn-danger btn-sm"
    onclick="konfirmasiHapus(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->nama)); ?>')">
    🗑
</button>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
          <div class="empty-icon">📦</div>
          <h3>Belum Ada Produk</h3>
          <p>Tambahkan produk-produk yang Anda jual. Salah satunya bisa dijadikan <strong>produk unggulan</strong> yang tampil menonjol di halaman publik.</p>
          <button class="btn btn-primary" style="margin-top:16px;" onclick="openModal('modal-tambah-item')">+ Tambah Produk Pertama</button>
        </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    
<div class="page-section" id="page-produk-terhapus">

    <?php if(!$myUmkm): ?>
        <div class="empty-state">
            <div class="empty-icon">⏳</div>
            <h3>Profil UMKM Belum Disetujui</h3>
        </div>
    <?php else: ?>
        <div class="section-header">
            <div class="section-title">
                Produk Terhapus
                <span><?php echo e($produkTerhapus->count()); ?> produk · bisa dipulihkan</span>
            </div>
        </div>

        <?php if($produkTerhapus->count() > 0): ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Dihapus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $produkTerhapus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:40px;height:40px;border-radius:8px;overflow:hidden;background:var(--surface2);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:18px;">
                                    <?php if($item->foto): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" style="width:100%;height:100%;object-fit:cover;">
                                    <?php else: ?>
                                        📦
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:13px;"><?php echo e($item->nama); ?></div>
                                    <div style="font-size:11px;color:var(--text-muted);"><?php echo e(\Illuminate\Support\Str::limit($item->deskripsi ?? '', 40)); ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;"><?php echo e($item->kategori ?? '-'); ?></td>
                        <td style="font-size:13px;"><?php echo e($item->harga_format); ?></td>
                        <td style="font-size:12px;color:var(--text-muted);"><?php echo e($item->deleted_at->diffForHumans()); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('produk-item.restore', $item->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline btn-sm">
                                    ♻️ Pulihkan
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon">🗑️</div>
            <h3>Tidak Ada Produk Terhapus</h3>
            <p>Produk yang dihapus akan muncul di sini dan bisa dipulihkan kapan saja.</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

    
    <div class="page-section" id="page-program">
      <div class="section-header">
        <div class="section-title">Program Tersedia <span>dari Pembimbing / Trainer</span></div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Nama Program</th>
              <th>Pembimbing</th>
              <th>Tipe</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $availablePrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
  <td>
    <strong><?php echo e($program->judul); ?></strong>
    <?php if(in_array($program->id, $joinedProgramIds)): ?>
      <div style="margin-top:4px;">
        <span class="badge badge-approved" style="font-size:10px;">
          <span class="badge-dot"></span>Sudah Terdaftar
        </span>
      </div>
    <?php endif; ?>
  </td>
  <td><?php echo e($program->trainer->name ?? 'Trainer Profesional'); ?></td>
  <td><span style="text-transform:capitalize"><?php echo e($program->tipe); ?></span></td>
  <td><?php echo e($program->tanggal ? $program->tanggal->translatedFormat('d M Y') : '-'); ?></td>
  <td>
    <?php if(in_array($program->id, $joinedProgramIds)): ?>
      <span class="badge badge-approved"><span class="badge-dot"></span>Dibuka</span>
    <?php else: ?>
      <span class="badge badge-approved"><span class="badge-dot"></span>Dibuka</span>
    <?php endif; ?>
  </td>
  <td>
    <a href="<?php echo e(route('pelatihan.detail', $program->id)); ?>" 
       class="btn btn-sm <?php echo e(in_array($program->id, $joinedProgramIds) ? 'btn-ghost' : 'btn-primary'); ?>" 
       style="text-decoration:none;">
      <?php echo e(in_array($program->id, $joinedProgramIds) ? 'Lihat Detail' : 'Detail'); ?>

    </a>
  </td>
</tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" style="text-align:center;color:#7a7065;padding:40px;">Belum ada program pelatihan aktif.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    
    <div class="page-section" id="page-profil">
      <div class="profile-hero">
        <div class="profile-avatar-xl">
          <?php if($user->profile_photo_path): ?>
            <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>" alt="<?php echo e($user->name); ?>">
          <?php else: ?>
            <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

          <?php endif; ?>
        </div>
        <div class="profile-hero-info">
          <h2><?php echo e($user->name); ?></h2>
          <p>Mitra UMKM · Bergabung sejak <?php echo e(\Carbon\Carbon::parse($user->created_at)->translatedFormat('F Y')); ?></p>
        </div>
        <button class="btn" style="background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.3);margin-left:auto"
          onclick="openModal('modal-profil')">Edit Profil</button>
      </div>

      <div class="profile-form-card">
        <div class="form-row">
          <div class="form-group">
            <div class="form-label">Nama Lengkap</div>
            <div class="form-static"><?php echo e($user->name); ?></div>
          </div>
          <div class="form-group">
            <div class="form-label">Email</div>
            <div class="form-static"><?php echo e($user->email); ?></div>
          </div>
          <div class="form-group">
            <div class="form-label">No. Telepon / WhatsApp</div>
            <div class="form-static">
              <?php if($user->phone): ?>
                <span style="color:#25d366">✓</span> <?php echo e($user->phone); ?>

              <?php else: ?>
                <span style="color:var(--text-muted);font-style:italic">Belum diisi</span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label">Lokasi</div>
            <div class="form-static"><?php echo e($user->location ?? '-'); ?></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>


<div class="modal-overlay" id="modal-tambah-item">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">
        Tambah Produk
        <small>Produk dari usaha: <?php echo e($myUmkm->nama ?? '-'); ?></small>
      </div>
      <button class="modal-close" onclick="closeModal('modal-tambah-item')">×</button>
    </div>
    <form method="POST" action="<?php echo e(route('produk-item.store')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Produk *</label>
          <input class="form-input" type="text" name="nama" placeholder="Contoh: Batik Kawung Ukuran L" required>
        </div>
        <div class="form-group">
          <label class="form-label">Kategori</label>
          <select class="form-select" name="kategori">
            <option value="">-- Pilih --</option>
            <option>Kuliner</option><option>Fashion</option><option>Kerajinan</option>
            <option>Teknologi</option><option>Pertanian</option><option>Jasa</option><option>Lainnya</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Deskripsi Produk</label>
        <textarea class="form-textarea" name="deskripsi" rows="3" placeholder="Ceritakan keunggulan produk ini..."></textarea>
      </div>

      <div class="form-row-3">
        <div class="form-group">
          <label class="form-label">Harga (Rp)</label>
          <input class="form-input" type="number" name="harga" placeholder="0" min="0">
          <div class="form-hint">Isi 0 jika harga perlu negosiasi</div>
        </div>
        <div class="form-group">
          <label class="form-label">Stok</label>
          <input class="form-input" type="text" name="stok" placeholder="Contoh: 50, Ready, Habis">
        </div>
        <div class="form-group">
          <label class="form-label">Satuan</label>
          <input class="form-input" type="text" name="satuan" placeholder="pcs, kg, lusin...">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Foto Produk</label>
        <label class="upload-area" for="item-foto" style="position:relative;overflow:hidden;min-height:100px;">
          <img id="item-foto-preview" src="" alt="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
          <div class="upload-icon" id="item-upload-icon">📸</div>
          <div class="upload-text" id="item-upload-text">Klik upload · PNG/JPG max 5 MB</div>
          <div class="upload-fname" id="item-foto-name"></div>
        </label>
        <input type="file" id="item-foto" name="foto" accept="image/*" style="display:none" onchange="onFotoChange(this,'item')">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('modal-tambah-item')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Produk</button>
      </div>
    </form>
  </div>
</div>


<div class="modal-overlay" id="modal-edit-item">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">
        Edit Produk
        <small>Ubah informasi produk</small>
      </div>
      <button class="modal-close" onclick="closeModal('modal-edit-item')">×</button>
    </div>
    <form method="POST" id="form-edit-item" action="" enctype="multipart/form-data">
      <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Produk *</label>
          <input class="form-input" type="text" name="nama" id="edit-nama" required>
        </div>
        <div class="form-group">
          <label class="form-label">Kategori</label>
          <select class="form-select" name="kategori" id="edit-kategori">
            <option value="">-- Pilih --</option>
            <option>Kuliner</option><option>Fashion</option><option>Kerajinan</option>
            <option>Teknologi</option><option>Pertanian</option><option>Jasa</option><option>Lainnya</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Deskripsi</label>
        <textarea class="form-textarea" name="deskripsi" id="edit-deskripsi" rows="3"></textarea>
      </div>

      <div class="form-row-3">
        <div class="form-group">
          <label class="form-label">Harga (Rp)</label>
          <input class="form-input" type="number" name="harga" id="edit-harga" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Stok</label>
          <input class="form-input" type="text" name="stok" id="edit-stok">
        </div>
        <div class="form-group">
          <label class="form-label">Satuan</label>
          <input class="form-input" type="text" name="satuan" id="edit-satuan">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Ganti Foto (opsional)</label>
        <label class="upload-area" for="edit-item-foto" style="position:relative;overflow:hidden;min-height:90px;">
          <img id="edit-foto-preview" src="" alt="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
          <div class="upload-icon">📸</div>
          <div class="upload-text">Klik untuk ganti foto produk</div>
        </label>
        <input type="file" id="edit-item-foto" name="foto" accept="image/*" style="display:none" onchange="onFotoChange(this,'edit')">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('modal-edit-item')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>


<div class="modal-overlay" id="modal-profil">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Profil<small>Perubahan akan langsung tersimpan</small></div>
      <button class="modal-close" onclick="closeModal('modal-profil')">×</button>
    </div>
    <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Lengkap *</label>
          <input class="form-input" type="text" name="name" value="<?php echo e($user->name); ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label">Email *</label>
          <input class="form-input" type="email" name="email" value="<?php echo e($user->email); ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label">No. Telepon / WhatsApp</label>
          <input class="form-input" type="text" name="phone" value="<?php echo e($user->phone ?? ''); ?>" placeholder="628123456789">
        </div>
        <div class="form-group">
          <label class="form-label">Lokasi</label>
          <input class="form-input" type="text" name="location" value="<?php echo e($user->location ?? ''); ?>" placeholder="Surabaya, Jawa Timur">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Foto Profil</label>
        <label class="upload-area" for="modal-profil-foto" style="position:relative;overflow:hidden;min-height:90px;">
          <?php if($user->profile_photo_path): ?>
            <img id="modal-profil-foto-preview" src="<?php echo e(asset('storage/'.$user->profile_photo_path)); ?>" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
          <?php else: ?>
            <img id="modal-profil-foto-preview" src="" alt="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:12px;z-index:1">
            <div class="upload-icon" id="modal-profil-upload-icon">📷</div>
            <div class="upload-text">Klik untuk upload foto</div>
          <?php endif; ?>
        </label>
        <input type="file" id="modal-profil-foto" name="profile_photo" accept="image/*" style="display:none" onchange="onFotoChange(this,'profil-modal')">
      </div>
      <hr class="form-divider">
      <div class="form-group">
        <label class="form-label">Password Baru <span style="color:var(--text-muted);font-weight:400;text-transform:none;letter-spacing:0">(kosongkan jika tidak diubah)</span></label>
        <input class="form-input" type="password" name="password" placeholder="Min. 8 karakter" autocomplete="new-password">
      </div>
      <div class="form-group">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input class="form-input" type="password" name="password_confirmation" placeholder="Ulangi password baru" autocomplete="new-password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('modal-profil')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>


<?php if($myUmkm): ?>
<div class="modal-overlay" id="modal-edit-usaha">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">
        Edit Data Usaha
        <small>Perubahan akan menunggu persetujuan ulang admin</small>
      </div>
      <button class="modal-close" onclick="closeModal('modal-edit-usaha')">×</button>
    </div>
    <form method="POST" action="<?php echo e(route('dashboard.produk.update', $myUmkm->id)); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Usaha *</label>
          <input class="form-input" type="text" name="nama" value="<?php echo e($myUmkm->nama); ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label">Kategori *</label>
          <select class="form-select" name="kategori" required>
            <option value="" disabled>-- Pilih --</option>
            <?php $__currentLoopData = ['Kuliner','Fashion','Kerajinan','Teknologi','Pertanian','Jasa','Lainnya']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($kat); ?>" <?php echo e($myUmkm->kategori == $kat ? 'selected' : ''); ?>><?php echo e($kat); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Deskripsi Usaha *</label>
        <textarea class="form-textarea" name="deskripsi" rows="4" required><?php echo e($myUmkm->deskripsi); ?></textarea>
      </div>

      <div class="form-group">
        <label class="form-label">No. WhatsApp Usaha</label>
        <input class="form-input" type="text" name="kontak" value="<?php echo e($myUmkm->kontak ?? ''); ?>" placeholder="628123456789">
      </div>

      <div class="form-group">
  <label class="form-label">
    Logo Usaha
    <span style="color:var(--text-muted);font-weight:400;text-transform:none;
                 letter-spacing:0;font-size:11px;">
      PNG transparan disarankan · persegi · max 2 MB
    </span>
  </label>

  <?php if($myUmkm->logo): ?>
    <div style="margin-bottom:10px;display:flex;align-items:center;gap:10px;">
      <img src="<?php echo e(asset('storage/' . $myUmkm->logo)); ?>"
           style="height:48px;width:48px;object-fit:contain;border-radius:10px;
                  border:1px solid var(--border);background:#fff;padding:4px;">
      <span style="font-size:12px;color:var(--text-muted);">
        Logo saat ini · upload baru untuk mengganti
      </span>
    </div>
  <?php endif; ?>

  <label class="upload-area" for="usaha-logo-foto"
         style="position:relative;overflow:hidden;min-height:90px;">
    <img id="usaha-logo-foto-preview" src="" alt=""
         style="display:none;position:absolute;inset:0;width:100%;height:100%;
                object-fit:contain;border-radius:12px;z-index:1;background:#fff;padding:12px;">
    <div class="upload-icon" id="usaha-logo-foto-upload-icon">🏷️</div>
    <div class="upload-text" id="usaha-logo-foto-upload-text">
      Klik untuk upload logo · PNG/JPG max 2 MB
    </div>
  </label>
  <input type="file" id="usaha-logo-foto" name="logo" accept="image/*"
         style="display:none"
         onchange="onFotoChange(this, 'usaha-logo-foto')">
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('modal-edit-usaha')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>


<div class="modal-overlay" id="modal-lepas-mentor">
  <div class="modal" style="max-width:420px;">
    <div class="modal-header">
      <div class="modal-title">
        Lepas Mentor?
        <small>Tindakan ini tidak dapat dibatalkan</small>
      </div>
      <button class="modal-close" onclick="closeModal('modal-lepas-mentor')">×</button>
    </div>

    <div style="text-align:center;padding:8px 0 20px;">
      <div style="width:64px;height:64px;background:#fff0ed;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px;">
        👨‍🏫
      </div>
      <p style="font-size:15px;font-weight:700;color:var(--text);margin-bottom:8px;" id="modal-lepas-nama">
        Nama Mentor
      </p>
      <p style="font-size:13px;color:var(--text-muted);line-height:1.6;">
        Anda akan melepas hubungan pendampingan dengan mentor ini.<br>
        Anda dapat menghubungkan kembali kapan saja.
      </p>
      <div style="margin-top:16px;padding:12px 16px;background:#fff8e1;border:1px solid #fcd34d66;border-radius:10px;font-size:12px;color:#92400e;">
        ⚠️ Setelah dilepas, Anda tidak bisa memberi ulasan untuk mentor ini.
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-ghost" onclick="closeModal('modal-lepas-mentor')">
        Batal
      </button>
      <form id="form-lepas-mentor" method="POST" action="" style="margin:0;">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger">
          🗑 Ya, Lepas Mentor
        </button>
      </form>
    </div>
  </div>
</div>
<script>

  /* ── MODAL LEPAS MENTOR ── */
function bukaMOdalLepasMentor(mentorId, mentorNama) {
    document.getElementById('modal-lepas-nama').textContent = mentorNama;
    document.getElementById('form-lepas-mentor').action = '/dashboard-umkm/lepas-mentor/' + mentorId;
    openModal('modal-lepas-mentor');
}
  /* ── NAVIGASI ── */
  function showPage(id) {
    closeSidebar();
    document.querySelectorAll('.page-section').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    const pageEl = document.getElementById('page-' + id);
    if (pageEl) pageEl.classList.add('active');

    const titles = {
  'beranda':      'Dashboard UMKM',
  'profil-umkm':  'Data Usaha',       
  'produk-items': 'Produk Saya',
  'program':      'Program Tersedia',
  'profil':       'Akun Saya',        
  'produk-terhapus': 'Produk Terhapus',

};
    document.getElementById('page-title').textContent = titles[id] || 'Dashboard UMKM';

    document.querySelectorAll('.nav-item').forEach(item => {
      const oc = item.getAttribute('onclick') || '';
      if (oc.includes("'" + id + "'")) item.classList.add('active');
    });
  }

  /* ── SIDEBAR MOBILE ── */
  function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('sidebar-overlay').classList.toggle('open');
    document.body.style.overflow = document.querySelector('.sidebar').classList.contains('open') ? 'hidden' : '';
  }
  function closeSidebar() {
    document.querySelector('.sidebar').classList.remove('open');
    document.getElementById('sidebar-overlay').classList.remove('open');
    document.body.style.overflow = '';
  }

  /* ── MODAL ── */
  function openModal(id)  { document.getElementById(id).classList.add('open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }
  document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
  });

  /* ── OPEN EDIT ITEM ── */
  function openEditItem(id, nama, deskripsi, kategori, harga, stok, satuan) {
    document.getElementById('form-edit-item').action = '/dashboard/produk-item/' + id;
    document.getElementById('edit-nama').value      = nama;
    document.getElementById('edit-deskripsi').value = deskripsi;
    document.getElementById('edit-harga').value     = harga;
    document.getElementById('edit-stok').value      = stok;
    document.getElementById('edit-satuan').value    = satuan;

    // Set selected kategori
    const sel = document.getElementById('edit-kategori');
    for (let opt of sel.options) {
      opt.selected = opt.value === kategori;
    }

    // Reset foto preview
    const prev = document.getElementById('edit-foto-preview');
    prev.src = ''; prev.style.display = 'none';

    openModal('modal-edit-item');
  }

  /* ── UPLOAD PREVIEW ── */
  function onFotoChange(input, prefix) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById(prefix + '-foto-preview');
      if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }

      const icon = document.getElementById(prefix + '-upload-icon');
      if (icon) icon.style.display = 'none';

      const text = document.getElementById(prefix + '-upload-text');
      if (text) text.style.display = 'none';

      const fname = document.getElementById(prefix + '-foto-name');
      if (fname) fname.textContent = '✓ ' + input.files[0].name;
    };
    reader.readAsDataURL(input.files[0]);
  }

  /* ── INIT: cek hash URL ── */
  document.addEventListener('DOMContentLoaded', function () {
    const hash = window.location.hash.replace('#', '');
    const valid = ['beranda','profil-umkm','produk-items','produk-terhapus','program','profil'];
    if (valid.includes(hash)) showPage(hash);
  });

  /* ── KONFIRMASI HAPUS PRODUK ── */
function konfirmasiHapus(id, nama) {
    document.getElementById('modal-hapus-nama').textContent = nama;
    document.getElementById('form-hapus-item').action = '/dashboard/produk-item/' + id;
    openModal('modal-hapus-item');
}
</script>


<div class="modal-overlay" id="modal-hapus-item">
  <div class="modal" style="max-width:420px;">
    <div class="modal-header">
      <div class="modal-title">
        Hapus Produk?
        <small>Produk bisa dipulihkan di menu Produk Terhapus</small>
      </div>
      <button class="modal-close" onclick="closeModal('modal-hapus-item')">×</button>
    </div>

    <div style="text-align:center;padding:8px 0 20px;">
      <div style="width:64px;height:64px;background:#fff0ed;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:28px;">
        🗑️
      </div>
      <p style="font-size:15px;font-weight:700;color:var(--text);margin-bottom:8px;" id="modal-hapus-nama">
        Nama Produk
      </p>
      <p style="font-size:13px;color:var(--text-muted);line-height:1.6;">
        Produk ini akan dipindahkan ke <strong>Produk Terhapus</strong>.<br>
        Anda bisa memulihkannya kapan saja.
      </p>
      <div style="margin-top:16px;padding:12px 16px;background:#f0fdf4;border:1px solid #86efac66;border-radius:10px;font-size:12px;color:#166534;display:flex;align-items:center;gap:8px;">
        <span style="font-size:16px;">♻️</span>
        <span>Produk tidak langsung hilang — tersimpan di menu <strong>Produk Terhapus</strong></span>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-ghost" onclick="closeModal('modal-hapus-item')">
        Batal
      </button>
      <form id="form-hapus-item" method="POST" action="" style="margin:0;">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger">
          🗑️ Ya, Hapus Produk
        </button>
      </form>
    </div>
  </div>
</div>
</body>
</html><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/profile/dashboard-umkm.blade.php ENDPATH**/ ?>