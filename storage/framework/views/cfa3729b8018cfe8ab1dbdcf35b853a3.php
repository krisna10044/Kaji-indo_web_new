<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family: DejaVu Sans, sans-serif; background: #fff; }
    .cert {
        width:100%; height:100vh;
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 8px solid #86efac;
        padding: 48px 56px;
        text-align: center;
        position: relative;
    }
    .corner-tl { position:absolute;top:16px;left:16px;width:60px;height:60px;border-right:3px solid #86efac;border-bottom:3px solid #86efac;border-radius:0 0 40px 0;opacity:.5 }
    .corner-br { position:absolute;bottom:16px;right:16px;width:60px;height:60px;border-left:3px solid #86efac;border-top:3px solid #86efac;border-radius:40px 0 0 0;opacity:.5 }
    h1 { font-size:36px; color:#14532d; margin:16px 0 4px; }
    .label { font-size:11px; color:#6b7280; letter-spacing:2px; text-transform:uppercase; }
    .program { font-size:20px; color:#15803d; font-weight:bold; margin:10px 0; }
    .divider { height:1px; background:#86efac; margin:24px 0; }
    .sign { display:inline-block; width:160px; border-bottom:2px solid #15803d;
            margin:0 30px; padding-bottom:4px; }
    .sign-name { font-size:11px; color:#15803d; font-weight:bold; margin-top:5px; }
    .sign-role { font-size:9px; color:#9ca3af; }
    .cert-id { font-size:9px; color:#d1d5db; margin-top:20px; letter-spacing:1px; }
</style>
</head>
<body>
<div class="cert">
    <div class="corner-tl"></div>
    <div class="corner-br"></div>
    <div style="font-size:11px;color:#15803d;letter-spacing:3px;text-transform:uppercase;font-weight:700">
        Sertifikat Kelulusan
    </div>
    <div style="font-size:9px;color:#86efac;letter-spacing:2px;margin-bottom:24px">KAJI INDONESIA</div>
    <div class="label">Diberikan kepada</div>
    <h1><?php echo e($user->name); ?></h1>
    <div style="font-size:11px;color:#9ca3af;margin-bottom:20px"><?php echo e($user->email); ?></div>
    <div class="label">Telah menyelesaikan program pelatihan</div>
    <div class="program"><?php echo e($program->judul); ?></div>
    <div style="font-size:11px;color:#6b7280;margin-top:8px">
        Diselesaikan pada:
        <strong style="color:#15803d">
            <?php echo e(\Carbon\Carbon::parse($tanggalSelesai)->translatedFormat('d F Y')); ?>

        </strong>
    </div>
    <div class="divider"></div>
    <div>
        <div class="sign">
            <div class="sign-name"><?php echo e($trainerGelar); ?></div>
            <div class="sign-role">Trainer / Pengajar</div>
        </div>
        <div class="sign">
            <div class="sign-name">KAJI Indonesia</div>
            <div class="sign-role">Penyelenggara</div>
        </div>
    </div>
    <div class="cert-id">
        ID: KAJI-<?php echo e(str_pad($program->id,4,'0',STR_PAD_LEFT)); ?>-<?php echo e(str_pad($user->id,6,'0',STR_PAD_LEFT)); ?>-<?php echo e(\Carbon\Carbon::parse($tanggalSelesai)->format('Ymd')); ?>

    </div>
</div>
</body>
</html><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/sertifikat-pdf.blade.php ENDPATH**/ ?>