<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trainer', function (Blueprint $table) {
            // Relasi ke tabel users
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Data pribadi
            $table->string('full_name')->nullable()->after('nama');
            $table->string('phone', 20)->nullable()->after('full_name');
            $table->string('academic_degree')->nullable()->after('phone'); // nama lengkap + gelar
            $table->string('nik', 20)->nullable()->after('academic_degree');
            $table->string('npwp', 30)->nullable()->after('nik');
            $table->string('ijazah_type', 10)->nullable()->after('npwp'); // SMA/D3/S1/S2/S3
            $table->text('experience')->nullable()->after('ijazah_type');
            $table->text('bio')->nullable()->after('experience');

            // Lokasi
            $table->string('gmaps_location')->nullable()->after('lokasi');
            $table->string('provinsi')->nullable()->after('gmaps_location');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');

            // Dokumen
            $table->string('ktp_scan')->nullable()->after('kelurahan');
            $table->string('bnsp_certificate')->nullable()->after('ktp_scan');
            $table->string('white_bg_photo')->nullable()->after('bnsp_certificate');
            $table->string('bukti_transfer')->nullable()->after('white_bg_photo');
            $table->string('drive_link_documentation')->nullable()->after('bukti_transfer');

            // Status & approval
            $table->string('status')->default('pending')->after('drive_link_documentation'); // pending|approved|rejected
            $table->text('rejection_reason')->nullable()->after('status');
            $table->timestamp('reviewed_at')->nullable()->after('rejection_reason');
            $table->boolean('agree_terms')->default(false)->after('reviewed_at');
            $table->timestamp('applied_at')->nullable()->after('agree_terms');
        });
    }

    public function down(): void
    {
        Schema::table('trainer', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id', 'full_name', 'phone', 'academic_degree', 'nik', 'npwp',
                'ijazah_type', 'experience', 'bio', 'gmaps_location', 'provinsi',
                'kabupaten', 'kecamatan', 'kelurahan', 'ktp_scan', 'bnsp_certificate',
                'white_bg_photo', 'bukti_transfer', 'drive_link_documentation',
                'status', 'rejection_reason', 'reviewed_at', 'agree_terms', 'applied_at',
            ]);
        });
    }
};