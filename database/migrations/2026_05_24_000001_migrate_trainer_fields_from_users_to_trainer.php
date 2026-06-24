<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pemetaan kolom: users → trainer
     *
     * users.bio               → trainer.bio
     * users.bidang_keahlian   → trainer.bidang
     * users.foto              → trainer.foto
     * users.no_hp             → trainer.no_hp
     * users.nik               → trainer.nik
     * users.npwp              → trainer.npwp
     * users.academic_degree   → trainer.academic_degree
     * users.ijazah_file       → trainer.ijazah_file  (kolom baru)
     * users.ijazah_type       → trainer.ijazah_type
     * users.experience        → trainer.experience
     * users.ktp_scan          → trainer.ktp_scan
     * users.bnsp_certificate  → trainer.bnsp_certificate
     * users.white_bg_photo    → trainer.white_bg_photo
     * users.bukti_transfer    → trainer.bukti_transfer
     * users.drive_link_documentation → trainer.drive_link_documentation
     * users.location          → trainer.lokasi
     * users.gmaps_location    → trainer.gmaps_location
     * users.provinsi          → trainer.provinsi
     * users.kabupaten         → trainer.kabupaten
     * users.kecamatan         → trainer.kecamatan
     * users.kelurahan         → trainer.kelurahan
     * users.trainer_applied_at → trainer.applied_at  (sudah ada)
     *
     * Tetap di users (tidak dipindah):
     * users.trainer_status
     * users.trainer_rejection_reason
     * users.trainer_applied_at (tetap sebagai referensi waktu apply)
     */

    public function up(): void
    {
        // ----------------------------------------------------------------
        // STEP 1: Tambah kolom ijazah_file ke tabel trainer (belum ada)
        // ----------------------------------------------------------------
        Schema::table('trainer', function (Blueprint $table) {
            $table->string('ijazah_file')->nullable()->after('ijazah_type');
        });

        // ----------------------------------------------------------------
        // STEP 2: Pindahkan data dari users → trainer
        //         Hanya untuk user yang punya trainer_status != 'none'
        //         (artinya pernah mengisi form pendaftaran trainer)
        // ----------------------------------------------------------------
        $usersWithTrainerData = DB::table('users')
            ->whereNotIn('trainer_status', ['none'])
            ->whereNotNull('trainer_status')
            ->get();

        foreach ($usersWithTrainerData as $user) {
            // Cek apakah sudah ada record di trainer dengan user_id ini
            $existingTrainer = DB::table('trainer')
                ->where('user_id', $user->id)
                ->first();

            if ($existingTrainer) {
                // Update record trainer yang sudah ada
                DB::table('trainer')
                    ->where('user_id', $user->id)
                    ->update([
                        'nama'                    => $user->name,
                        'full_name'               => $user->name,
                        'email'                   => $user->email,
                        'no_hp'                   => $user->no_hp ?? $user->phone,
                        'bio'                     => $user->bio,
                        'bidang'                  => $user->bidang_keahlian,
                        'foto'                    => $user->foto,
                        'nik'                     => $user->nik,
                        'npwp'                    => $user->npwp,
                        'academic_degree'         => $user->academic_degree,
                        'ijazah_file'             => $user->ijazah_file,
                        'ijazah_type'             => $user->ijazah_type,
                        'experience'              => $user->experience,
                        'ktp_scan'                => $user->ktp_scan,
                        'bnsp_certificate'        => $user->bnsp_certificate,
                        'white_bg_photo'          => $user->white_bg_photo,
                        'bukti_transfer'          => $user->bukti_transfer,
                        'drive_link_documentation'=> $user->drive_link_documentation,
                        'lokasi'                  => $user->location,
                        'gmaps_location'          => $user->gmaps_location,
                        'provinsi'                => $user->provinsi,
                        'kabupaten'               => $user->kabupaten,
                        'kecamatan'               => $user->kecamatan,
                        'kelurahan'               => $user->kelurahan,
                        'applied_at'              => $user->trainer_applied_at,
                        'status'                  => $user->trainer_status,
                        'rejection_reason'        => $user->trainer_rejection_reason ?? $user->rejection_reason,
                        'updated_at'              => now(),
                    ]);
            } else {
                // Buat record trainer baru
                DB::table('trainer')->insert([
                    'user_id'                 => $user->id,
                    'nama'                    => $user->name,
                    'full_name'               => $user->name,
                    'email'                   => $user->email,
                    'no_hp'                   => $user->no_hp ?? $user->phone,
                    'bio'                     => $user->bio,
                    'bidang'                  => $user->bidang_keahlian,
                    'foto'                    => $user->foto,
                    'nik'                     => $user->nik,
                    'npwp'                    => $user->npwp,
                    'academic_degree'         => $user->academic_degree,
                    'ijazah_file'             => $user->ijazah_file,
                    'ijazah_type'             => $user->ijazah_type,
                    'experience'              => $user->experience,
                    'ktp_scan'                => $user->ktp_scan,
                    'bnsp_certificate'        => $user->bnsp_certificate,
                    'white_bg_photo'          => $user->white_bg_photo,
                    'bukti_transfer'          => $user->bukti_transfer,
                    'drive_link_documentation'=> $user->drive_link_documentation,
                    'lokasi'                  => $user->location,
                    'gmaps_location'          => $user->gmaps_location,
                    'provinsi'                => $user->provinsi,
                    'kabupaten'               => $user->kabupaten,
                    'kecamatan'               => $user->kecamatan,
                    'kelurahan'               => $user->kelurahan,
                    'applied_at'              => $user->trainer_applied_at,
                    'status'                  => $user->trainer_status,
                    'rejection_reason'        => $user->trainer_rejection_reason ?? $user->rejection_reason,
                    'agree_terms'             => 1,
                    'created_at'              => $user->created_at,
                    'updated_at'              => now(),
                ]);
            }
        }

        // ----------------------------------------------------------------
        // STEP 3: Drop kolom trainer dari tabel users
        //         Kolom yang TETAP di users:
        //         - trainer_status (untuk cek status di middleware/auth)
        //         - trainer_rejection_reason (notifikasi ke user)
        //         - trainer_applied_at (timestamp kapan apply)
        // ----------------------------------------------------------------
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'bidang_keahlian',
                'foto',
                'no_hp',
                'nik',
                'npwp',
                'academic_degree',
                'ijazah_file',
                'ijazah_type',
                'experience',
                'ktp_scan',
                'bnsp_certificate',
                'white_bg_photo',
                'bukti_transfer',
                'drive_link_documentation',
                'location',
                'gmaps_location',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan',
                'rejection_reason',   // ini duplikat dari trainer_rejection_reason
            ]);
        });
    }

    public function down(): void
    {
        // ----------------------------------------------------------------
        // Rollback: Kembalikan kolom ke users
        // ----------------------------------------------------------------
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable();
            $table->string('bidang_keahlian')->nullable();
            $table->string('foto')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->string('academic_degree')->nullable();
            $table->string('ijazah_file')->nullable();
            $table->string('ijazah_type')->nullable();
            $table->text('experience')->nullable();
            $table->string('ktp_scan')->nullable();
            $table->string('bnsp_certificate')->nullable();
            $table->string('white_bg_photo')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->string('drive_link_documentation')->nullable();
            $table->string('location')->nullable();
            $table->string('gmaps_location')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->text('rejection_reason')->nullable();
        });

        // Kembalikan data dari trainer ke users
        $trainers = DB::table('trainer')->whereNotNull('user_id')->get();

        foreach ($trainers as $trainer) {
            DB::table('users')
                ->where('id', $trainer->user_id)
                ->update([
                    'bio'                     => $trainer->bio,
                    'bidang_keahlian'         => $trainer->bidang,
                    'foto'                    => $trainer->foto,
                    'no_hp'                   => $trainer->no_hp,
                    'nik'                     => $trainer->nik,
                    'npwp'                    => $trainer->npwp,
                    'academic_degree'         => $trainer->academic_degree,
                    'ijazah_file'             => $trainer->ijazah_file,
                    'ijazah_type'             => $trainer->ijazah_type,
                    'experience'              => $trainer->experience,
                    'ktp_scan'                => $trainer->ktp_scan,
                    'bnsp_certificate'        => $trainer->bnsp_certificate,
                    'white_bg_photo'          => $trainer->white_bg_photo,
                    'bukti_transfer'          => $trainer->bukti_transfer,
                    'drive_link_documentation'=> $trainer->drive_link_documentation,
                    'location'                => $trainer->lokasi,
                    'gmaps_location'          => $trainer->gmaps_location,
                    'provinsi'                => $trainer->provinsi,
                    'kabupaten'               => $trainer->kabupaten,
                    'kecamatan'               => $trainer->kecamatan,
                    'kelurahan'               => $trainer->kelurahan,
                    'rejection_reason'        => $trainer->rejection_reason,
                ]);
        }

        // Hapus kolom ijazah_file dari trainer (yang ditambah di up())
        Schema::table('trainer', function (Blueprint $table) {
            $table->dropColumn('ijazah_file');
        });
    }
};