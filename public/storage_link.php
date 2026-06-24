<?php
// Jalankan sekali, lalu HAPUS file ini dari server!

$target = __DIR__ . '/../storage/app/public';
$link   = __DIR__ . '/storage';

if (is_link($link)) {
    echo "✅ Symlink sudah ada: $link → " . readlink($link);
} elseif (file_exists($link)) {
    echo "❌ Folder 'public/storage' sudah ada (bukan symlink). Hapus manual dulu.";
} else {
    if (symlink($target, $link)) {
        echo "✅ Symlink berhasil dibuat: $link → $target";
    } else {
        echo "❌ Gagal membuat symlink. Coba Opsi 2 (folder fisik).";
    }
}