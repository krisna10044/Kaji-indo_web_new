<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek dan tambahkan kolom hanya jika belum ada

            if (!Schema::hasColumn('users', 'gmaps_location')) {
                $table->string('gmaps_location')->nullable()->after('location');
            }

            if (!Schema::hasColumn('users', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('gmaps_location');
            }

            if (!Schema::hasColumn('users', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('provinsi');
            }

            if (!Schema::hasColumn('users', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten');
            }

            if (!Schema::hasColumn('users', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }

            if (!Schema::hasColumn('users', 'ijazah_type')) {
                $table->string('ijazah_type')->nullable()->after('drive_link_documentation');
            }

            if (!Schema::hasColumn('users', 'bukti_transfer')) {
                $table->string('bukti_transfer')->nullable()->after('white_bg_photo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gmaps_location',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan',
                'ijazah_type',
                'bukti_transfer',
            ]);
        });
    }
};