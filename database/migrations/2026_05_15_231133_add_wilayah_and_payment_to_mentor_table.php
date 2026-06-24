<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            // Wilayah administratif
            $table->string('provinsi')->nullable()->after('gmaps_location');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');

            // Bukti pembayaran
            $table->string('bukti_transfer')->nullable()->after('ktp_scan');

            // Persetujuan syarat & ketentuan
            $table->boolean('agree_terms')->default(false)->after('bukti_transfer');
        });
    }

    public function down(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->dropColumn([
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan',
                'bukti_transfer',
                'agree_terms',
            ]);
        });
    }
};