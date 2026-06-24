<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HalalCenterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KonsultanController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UmkmMentorUlasanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trainerpelatihancontroller;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PendaftaranProgramController;
use App\Http\Controllers\ProdukItemController;
use App\Http\Controllers\UmkmDashboardController;
use App\Http\Controllers\Auth\GoogleController;

// =====================
// HALAMAN UMUM (Bebas Akses)
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/media', [MediaController::class, 'index'])->name('media');


// Auth System
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Google OAuth
Route::get('/auth/google',          [App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'callback']);


// Pelatihan, UMKM, Halal, Konsultan (Prefix Groups)
Route::prefix('pelatihan')->name('pelatihan.')->group(function () {
    // Bebas akses
    Route::get('/', [PelatihanController::class, 'program'])->name('index');
    Route::get('/program', [PelatihanController::class, 'program'])->name('program');
    Route::get('/event', [PelatihanController::class, 'event'])->name('event');
    Route::get('/mentor', [PelatihanController::class, 'pembimbing'])->name('pembimbing');
    Route::get('/mentor/search', [PelatihanController::class, 'searchMentor'])->name('pembimbing.search');

    // Wajib login
    Route::middleware('auth')->group(function () {
        Route::get('/program/{id}', [PelatihanController::class, 'detailProgram'])->name('detail');
        Route::get('/event/{id}', [PelatihanController::class, 'detailEvent'])->name('event.detail');
        Route::get('/mentor/{id}', [PelatihanController::class, 'detailMentor'])->name('mentor.detail');
       Route::post('/mentor/{id}/ulasan', [PelatihanController::class, 'simpanUlasanTrainer'])->name('mentor.ulasan');

        Route::get('/program/{id}/daftar', [App\Http\Controllers\PendaftaranProgramController::class, 'create'])->name('pendaftaran.create');
        Route::post('/program/{id}/daftar', [App\Http\Controllers\PendaftaranProgramController::class, 'store'])->name('pendaftaran.store');

        Route::post('/modul/{modul}/selesai', [PelatihanController::class, 'tandaiModulSelesai'])->name('modul.selesai');
        Route::get('/program/{program}/sertifikat', [PelatihanController::class, 'sertifikat'])->name('sertifikat');
        Route::get('/program/{program}/sertifikat/download', [PelatihanController::class, 'downloadSertifikat'])->name('sertifikat.download');
    });
});

Route::prefix('umkm')->group(function () {
    // Bebas akses
    Route::get('/', [UmkmController::class, 'index'])->name('umkm');
    Route::get('/produk', [UmkmController::class, 'produk'])->name('umkm.produk');
    Route::get('/pembimbing', [UmkmController::class, 'pembimbing'])->name('umkm.pembimbing');
    Route::get('/peta-data', [UmkmController::class, 'petaData'])->name('umkm.peta-data');
    Route::get('/peta-data-mentor', [UmkmController::class, 'petaDataMentor'])->name('umkm.peta-data-mentor');

    // Wajib login
    Route::middleware('auth')->group(function () {
        Route::get('/pembimbing/{id}', [UmkmController::class, 'showMentor'])->name('umkm.mentor.detail');
        Route::get('/lokasi', [UmkmController::class, 'lokasi'])->name('umkm.lokasi');
        Route::post('/pembimbing/{id}/ulasan', [UmkmMentorUlasanController::class, 'store'])->name('umkm.mentor.ulasan.store');
        Route::delete('/pembimbing/{mentorId}/ulasan/{ulasanId}', [UmkmMentorUlasanController::class, 'destroy'])->name('umkm.mentor.ulasan.destroy');

        // ✅ profil/{id} HARUS di atas {id} agar tidak bentrok
        Route::get('/produk/profil/{id}', [UmkmController::class, 'produkProfil'])->name('produk.profil');
        Route::get('/produk/{id}', [UmkmController::class, 'produkDetail'])->name('produk.show');
    });
});

Route::prefix('halal-center')->group(function () {
    Route::get('/', [HalalCenterController::class, 'index'])->name('halal-center');
    Route::get('/gratis', [HalalCenterController::class, 'gratis'])->name('halal-center.gratis');
    Route::get('/berbayar', [HalalCenterController::class, 'berbayar'])->name('halal-center.berbayar');
});

Route::prefix('konsultan')->group(function () {
    Route::get('/', [KonsultanController::class, 'index'])->name('konsultan');
    Route::get('/layanan', [KonsultanController::class, 'layanan'])->name('konsultan.layanan');
    Route::get('/paket', [KonsultanController::class, 'paket'])->name('konsultan.paket');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');
    Route::delete('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::get('/profile/riwayat-pendaftaran', [App\Http\Controllers\PendaftaranProgramController::class, 'riwayat'])->name('pendaftaran.riwayat');

    // Notifikasi
    Route::get('/profile/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::post('/profile/notifications', [ProfileController::class, 'updateNotifications'])->name('profile.notifications.update');

    // Daftar UMKM
    Route::get('/profile/daftar-umkm', [ProfileController::class, 'showDaftarUmkm'])->name('profile.daftar-umkm');
    Route::post('/profile/simpan-umkm', [ProfileController::class, 'simpanUmkm'])->name('profile.simpan-umkm');

    // Daftar Mentor
    Route::get('/profile/daftar-mentor', [ProfileController::class, 'showDaftarMentor'])->name('profile.daftar-mentor');
    Route::post('/profile/simpan-mentor', [ProfileController::class, 'simpanMentor'])->name('profile.simpan-mentor');

    // Daftar Trainer
    Route::get('/profile/daftar-trainer', [ProfileController::class, 'showDaftarTrainer'])->name('profile.daftar-trainer');
    Route::post('/profile/simpan-trainer', [ProfileController::class, 'simpanTrainer'])->name('profile.simpan-trainer');

    // Dashboard UMKM
    Route::get('/dashboard-umkm', [App\Http\Controllers\UmkmDashboardController::class, 'index'])
         ->name('dashboard-umkm');
    Route::post('/dashboard-umkm/join-program/{id}', [App\Http\Controllers\UmkmDashboardController::class, 'joinProgram'])
         ->name('dashboard.umkm.join-program');
    Route::get('/dashboard-umkm/produk/{id}/edit', [\App\Http\Controllers\UmkmDashboardController::class, 'editProduk'])
         ->name('dashboard.produk.edit');
    Route::put('/dashboard-umkm/produk/{id}/update', [\App\Http\Controllers\UmkmDashboardController::class, 'updateProduk'])
         ->name('dashboard.produk.update');
    Route::post('/dashboard/produk-item/{id}/restore', [ProdukItemController::class, 'restore'])
         ->name('produk-item.restore');

    Route::post('/dashboard-umkm/pilih-mentor/{mentorId}', [UmkmDashboardController::class, 'pilihMentor'])
         ->name('umkm.pilih-mentor');
    Route::delete('/dashboard-umkm/lepas-mentor/{mentorId}', [UmkmDashboardController::class, 'lepasMentor'])
         ->name('umkm.lepas-mentor');


         Route::post('/dashboard/produk-item',              [ProdukItemController::class, 'store'])->name('produk-item.store');
         Route::put('/dashboard/produk-item/{id}',          [ProdukItemController::class, 'update'])->name('produk-item.update');
         Route::delete('/dashboard/produk-item/{id}',       [ProdukItemController::class, 'destroy'])->name('produk-item.destroy');
         Route::post('/dashboard/produk-item/{id}/unggulan',[ProdukItemController::class, 'setUnggulan'])->name('produk-item.set-unggulan');
         Route::post('/dashboard/produk-item/{id}/unset',   [ProdukItemController::class, 'unsetUnggulan'])->name('produk-item.unset-unggulan');

    // Dashboard Trainer
    Route::get('/trainer/dashboard', [App\Http\Controllers\TrainerController::class, 'index'])
         ->name('trainer.dashboard')
         ->middleware('trainer');
        
     // Dashboard Mentor
Route::middleware('mentor')->group(function () {
    Route::get('/mentor/dashboard', [App\Http\Controllers\MentorController::class, 'index'])
         ->name('mentor.dashboard');

    Route::put('/mentor/profil/update', [App\Http\Controllers\MentorController::class, 'updateProfil'])
         ->name('mentor.profil.update');

    Route::get('/api/mentor/produk-umkm/{produkId}', [App\Http\Controllers\MentorController::class, 'getProdukUmkm']);
});

    // Absensi
    Route::post('/absensi/{pelatihan}/submit', [AbsensiController::class, 'submit'])
        ->name('absensi.submit');
    Route::get('/trainer/kurikulum/{pelatihan}/absensi', [AbsensiController::class, 'daftarAbsensi'])
        ->name('trainer.absensi.daftar');
    Route::get('/trainer/kurikulum/{pelatihan}/absensi/export', [AbsensiController::class, 'exportCsv'])
        ->name('trainer.absensi.export');

        Route::get('/trainer/program/{id}/peserta', [App\Http\Controllers\TrainerController::class, 'getPeserta'])
        ->name('trainer.peserta.index');
    Route::get('/trainer/program/{id}/peserta/export', [App\Http\Controllers\TrainerController::class, 'exportPesertaCsv'])
        ->name('trainer.peserta.export');

    // Trainer Program
    Route::post('/trainer/pelatihan/store', [App\Http\Controllers\TrainerController::class, 'storeProgram'])
        ->name('trainer.pelatihan.store');
    Route::put('/trainer/pelatihan/{id}', [App\Http\Controllers\TrainerController::class, 'updateProgram'])
        ->name('trainer.pelatihan.update');
    Route::delete('/trainer/pelatihan/{id}', [App\Http\Controllers\TrainerController::class, 'destroyProgram'])
        ->name('trainer.pelatihan.destroy');

    // Trainer Event
    Route::post('/trainer/event/store', [App\Http\Controllers\TrainerController::class, 'storeEvent'])
        ->name('trainer.event.store');
    Route::put('/trainer/event/{id}', [App\Http\Controllers\TrainerController::class, 'updateEvent'])
        ->name('trainer.event.update');
    Route::delete('/trainer/event/{id}', [App\Http\Controllers\TrainerController::class, 'destroyEvent'])
        ->name('trainer.event.destroy');

    // Trainer Profile
    Route::put('/trainer/profil/update', [App\Http\Controllers\TrainerController::class, 'updateProfil'])
        ->name('trainer.profil.update');
    
        Route::post('/trainer/profil/bidang', [App\Http\Controllers\TrainerController::class, 'updateDisplayedBidang'])
    ->name('trainer.profil.bidang');

    Route::post('/trainer/deleted-log/read', [App\Http\Controllers\TrainerController::class, 'markDeletedLogRead'])
    ->name('trainer.deleted-log.read');

    Route::post('/trainer/deleted-log/{id}/restore', [App\Http\Controllers\TrainerController::class, 'restoreProgram'])
    ->name('trainer.program.restore');
Route::post('/trainer/deleted-log/mark-read', [App\Http\Controllers\TrainerController::class, 'markDeletedLogRead'])
    ->name('trainer.deleted-log.mark-read');
    Route::post('/trainer/deleted-event-log/mark-read', [App\Http\Controllers\TrainerController::class, 'markDeletedEventLogRead'])
    ->name('trainer.deleted-event-log.mark-read');

Route::post('/trainer/deleted-event-log/{id}/restore', [App\Http\Controllers\TrainerController::class, 'restoreEvent'])
    ->name('trainer.deleted-event-log.restore');

    // =========================
// TRAINER KURIKULUM & MATERI
// =========================
Route::post('/kurikulum',        [Trainerpelatihancontroller::class, 'storeKurikulum'])  ->name('trainer.kurikulum.store');
Route::put('/kurikulum/{id}',    [Trainerpelatihancontroller::class, 'updateKurikulum']) ->name('trainer.kurikulum.update');
Route::delete('/kurikulum/{id}', [Trainerpelatihancontroller::class, 'destroy'])         ->name('trainer.kurikulum.destroy');

Route::post('/modul',            [Trainerpelatihancontroller::class, 'storeModul'])      ->name('trainer.modul.store');
Route::put('/modul/{id}',        [Trainerpelatihancontroller::class, 'updateModul'])     ->name('trainer.modul.update');
Route::delete('/modul/{id}',     [Trainerpelatihancontroller::class, 'destroy'])         ->name('trainer.modul.destroy');
});

// =========================================================
// GRUP ADMIN (KHUSUS ADMIN)
// =========================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // ── Approval Program ─────────────────────────────────────────────
    Route::get('/approval/program/counts',             [AdminController::class, 'approvalProgramCounts'])->name('approval.program.counts'); 
    Route::get('/approval/program/export-csv',         [AdminController::class, 'exportCsvApproval'])->name('approval.program.export-csv');
    Route::get('/approval/program',                    [AdminController::class, 'approvalProgram'])->name('approval.program');
    
    // ← Spesifik dulu, sebelum {program} generic
    Route::post('/approval/program/deleted/{id}/restore',  [AdminController::class, 'restoreProgramAdmin'])->name('approval.program.restore');
    Route::delete('/approval/program/deleted/{id}',        [AdminController::class, 'destroyDeletedLog'])->name('approval.program.deleted.destroy');
    
    // ← Generic belakangan
    Route::post('/approval/program/{program}/approve', [AdminController::class, 'approveProgram'])->name('approval.program.approve');
    Route::post('/approval/program/{program}/reject',  [AdminController::class, 'rejectProgram'])->name('approval.program.reject');
    Route::delete('/approval/program/{program}',       [AdminController::class, 'destroyProgram'])->name('approval.program.delete');
    // ── Approval Produk ──────────────────────────────────────────────
    Route::get('/approval/produk',                     [AdminController::class, 'approvalProduk'])->name('approval.produk');
    Route::post('/approval/produk/{produk}/approve',   [AdminController::class, 'approveProduk'])->name('approval.produk.approve');
    Route::post('/approval/produk/{produk}/reject',    [AdminController::class, 'rejectProduk'])->name('approval.produk.reject');
    Route::delete('/approval/produk/{produk}',         [AdminController::class, 'destroyProduk'])->name('approval.produk.destroy');
    Route::delete('/approval/produk/{produk}/destroy-umkm',        [AdminController::class, 'destroyUmkm'])->name('approval.umkm.destroy');
    Route::delete('/approval/produk/{produkId}/item/{itemId}',     [AdminController::class, 'destroyProdukItem'])->name('approval.umkm.item.destroy');
    Route::post('/approval/produk/deleted/{id}/restore',  [AdminController::class, 'restoreProduk'])->name('approval.produk.restore');
Route::delete('/approval/produk/deleted/{id}/force',  [AdminController::class, 'forceDeleteProduk'])->name('approval.produk.force-delete');

    Route::get('/approval/produk/export-csv', [AdminController::class, 'exportCsvProduk'])
    ->name('approval.produk.export-csv');

  
// ── Approval Event ───────────────────────────────────────────────
Route::get('/approval/event',                          [AdminController::class, 'approvalEvent'])->name('approval.event');
Route::post('/approval/event/{event}/approve',         [AdminController::class, 'approveEvent'])->name('approval.event.approve');
Route::post('/approval/event/{event}/reject',          [AdminController::class, 'rejectEvent'])->name('approval.event.reject');
Route::post('/approval/event/{event}/restore',         [AdminController::class, 'restoreEventAdmin'])->name('approval.event.restore');
Route::delete('/approval/event/{id}/force-delete',     [AdminController::class, 'forceDeleteEvent'])->name('approval.event.force-delete'); // ← tambah di sini
Route::delete('/approval/event/{event}',               [AdminController::class, 'destroyEvent'])->name('approval.event.destroy');

    // ── Approval Trainer ─────────────────────────────────────────────
    Route::get('/approval/trainer',                        [AdminController::class, 'approvalTrainer'])->name('approval.trainer');
    Route::post('/approval/trainer/{trainer}/approve',     [AdminController::class, 'approveTrainer'])->name('trainer.approve');
    Route::post('/approval/trainer/{trainer}/reject',      [AdminController::class, 'rejectTrainer'])->name('trainer.reject');
    Route::post('/approval/trainer/{id}/restore',          [AdminController::class, 'restoreTrainer'])->name('trainer.restore');
Route::delete('/approval/trainer/{id}/force-delete',   [AdminController::class, 'forceDeleteTrainer'])->name('trainer.force-delete');
Route::delete('/approval/trainer/{trainer}',           [AdminController::class, 'destroyTrainer'])->name('trainer.destroy');


    // ── Approval Mentor ──────────────────────────────────────────────
    Route::get('/approval/mentor',                     [AdminController::class, 'approvalMentor'])->name('approval.mentor');
    Route::post('/approval/mentor/{mentor}/approve',   [AdminController::class, 'approveMentor'])->name('approval.mentor.approve');
    Route::post('/approval/mentor/{mentor}/reject',    [AdminController::class, 'rejectMentor'])->name('approval.mentor.reject');
    Route::post('/approval/mentor/{id}/restore',       [AdminController::class, 'restoreMentor'])->name('approval.mentor.restore');
Route::delete('/approval/mentor/{id}/force-delete',[AdminController::class, 'forceDeleteMentor'])->name('approval.mentor.force-delete');
    Route::delete('/approval/mentor/{mentor}',         [AdminController::class, 'destroyMentor'])->name('approval.mentor.destroy');

    // ── Manajemen Pengguna ───────────────────────────────────────────
    Route::get('/pengguna',                            [AdminController::class, 'pengguna'])->name('pengguna');
    Route::get('/pengguna/export',                     [AdminController::class, 'exportCsvPengguna'])->name('pengguna.export'); 
    Route::post('/pengguna/{user}/verifikasi',         [AdminController::class, 'verifikasiPengguna'])->name('pengguna.verifikasi');
    Route::post('/pengguna/{user}/suspend',            [AdminController::class, 'suspendPengguna'])->name('pengguna.suspend');
    Route::post('/pengguna/{user}/unsuspend',          [AdminController::class, 'unsuspendPengguna'])->name('pengguna.unsuspend');

    Route::get('/pendaftaran',                   [AdminController::class, 'pendaftaranIndex'])->name('pendaftaran.index');
    Route::post('/pendaftaran/{id}/approve',     [AdminController::class, 'pendaftaranApprove'])->name('pendaftaran.approve');
    Route::post('/pendaftaran/{id}/reject',      [AdminController::class, 'pendaftaranReject'])->name('pendaftaran.reject');

    // ── Dokumentasi Kegiatan ─────────────────────────────────────────  ← TAMBAH DI SINI
    Route::get('/dokumentasi',                    [MediaController::class, 'adminIndex'])  ->name('dokumentasi.index');
    Route::get('/dokumentasi/tambah',             [MediaController::class, 'adminCreate']) ->name('dokumentasi.create');
    Route::post('/dokumentasi',                   [MediaController::class, 'adminStore'])  ->name('dokumentasi.store');
    Route::get('/dokumentasi/{dokumentasi}/edit', [MediaController::class, 'adminEdit'])   ->name('dokumentasi.edit');
    Route::put('/dokumentasi/{dokumentasi}',      [MediaController::class, 'adminUpdate']) ->name('dokumentasi.update');
    Route::delete('/dokumentasi/{dokumentasi}',   [MediaController::class, 'adminDestroy'])->name('dokumentasi.destroy');
});