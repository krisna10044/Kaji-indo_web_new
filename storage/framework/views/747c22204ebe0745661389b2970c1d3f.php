<?php $__env->startSection('title', 'Sertifikat - ' . $program->judul); ?>
<?php $__env->startSection('content'); ?>
<section class="bg-gray-50 py-12 px-4 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
            <a href="<?php echo e(route('pelatihan.detail', $program->id)); ?>"
               class="text-green-700 hover:underline text-sm font-semibold">← Kembali ke Program</a>
            <a href="<?php echo e(route('pelatihan.sertifikat.download', $program->id)); ?>"
               class="bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-green-800 transition">
                ⬇️ Download PDF
            </a>
        </div>

        
        <div style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:3px solid #86efac;
                    border-radius:20px;padding:48px 40px;text-align:center;
                    box-shadow:0 8px 32px rgba(21,128,61,.12);position:relative;overflow:hidden">
            
            <div style="position:absolute;top:0;left:0;width:80px;height:80px;
                        border-right:3px solid #86efac;border-bottom:3px solid #86efac;
                        border-radius:0 0 60px 0;opacity:.4"></div>
            <div style="position:absolute;bottom:0;right:0;width:80px;height:80px;
                        border-left:3px solid #86efac;border-top:3px solid #86efac;
                        border-radius:60px 0 0 0;opacity:.4"></div>

            <div style="font-size:48px;margin-bottom:8px">🏆</div>
            <div style="font-size:13px;font-weight:700;color:#15803d;letter-spacing:3px;
                        text-transform:uppercase;margin-bottom:4px">Sertifikat Kelulusan</div>
            <div style="font-size:11px;color:#86efac;letter-spacing:2px;margin-bottom:32px">
                KAJI INDONESIA
            </div>

            <div style="font-size:13px;color:#6b7280;margin-bottom:8px">Diberikan kepada</div>
            <div style="font-family:Georgia,serif;font-size:32px;font-weight:700;
                        color:#14532d;margin-bottom:4px">
                <?php echo e($user->name); ?>

            </div>
            <div style="font-size:12px;color:#9ca3af;margin-bottom:28px"><?php echo e($user->email); ?></div>

            <div style="font-size:13px;color:#6b7280;margin-bottom:8px">
                Telah menyelesaikan program pelatihan
            </div>
            <div style="font-family:Georgia,serif;font-size:20px;font-weight:700;
                        color:#15803d;margin-bottom:8px;padding:0 20px">
                <?php echo e($program->judul); ?>

            </div>

            <div style="display:inline-block;background:#fff;border:1px solid #d1fae5;
                        border-radius:8px;padding:6px 16px;font-size:12px;color:#6b7280;margin-bottom:28px">
                📅 Diselesaikan pada:
                <strong style="color:#15803d">
                    <?php echo e(\Carbon\Carbon::parse($tanggalSelesai)->translatedFormat('d F Y')); ?>

                </strong>
            </div>

            <div style="height:1px;background:linear-gradient(90deg,transparent,#86efac,transparent);margin:20px 0"></div>

            <div style="display:flex;justify-content:center;gap:40px;flex-wrap:wrap">
                <div style="text-align:center">
                    <div style="height:40px;border-bottom:2px solid #15803d;width:160px;margin:0 auto"></div>
                    <div style="font-size:12px;font-weight:700;color:#15803d;margin-top:6px">
                        <?php echo e($trainerGelar); ?>

                    </div>
                    <div style="font-size:10px;color:#9ca3af">Trainer / Pengajar</div>
                </div>
                <div style="text-align:center">
                    <div style="height:40px;border-bottom:2px solid #15803d;width:160px;margin:0 auto"></div>
                    <div style="font-size:12px;font-weight:700;color:#15803d;margin-top:6px">
                        KAJI Indonesia
                    </div>
                    <div style="font-size:10px;color:#9ca3af">Penyelenggara</div>
                </div>
            </div>

            <div style="margin-top:20px;font-size:10px;color:#d1d5db;letter-spacing:1px">
                ID: KAJI-<?php echo e(str_pad($program->id, 4, '0', STR_PAD_LEFT)); ?>-<?php echo e(str_pad($user->id, 6, '0', STR_PAD_LEFT)); ?>-<?php echo e(\Carbon\Carbon::parse($tanggalSelesai)->format('Ymd')); ?>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/sertifikat.blade.php ENDPATH**/ ?>