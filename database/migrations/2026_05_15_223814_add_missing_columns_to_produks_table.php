<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('produks', function (Blueprint $table) {
        // Cek dulu, kalau belum ada baru buat
        if (!Schema::hasColumn('produks', 'logo')) {
            $table->string('logo')->nullable()->after('id');
        }
        if (!Schema::hasColumn('produks', 'owner')) {
            $table->string('owner')->nullable()->after('nama');
        }
        if (!Schema::hasColumn('produks', 'kontak')) {
            $table->string('kontak')->nullable()->after('owner');
        }
        if (!Schema::hasColumn('produks', 'provinsi')) {
            $table->string('provinsi')->nullable();
        }
        if (!Schema::hasColumn('produks', 'kabupaten_kota')) {
            $table->string('kabupaten_kota')->nullable();
        }
        if (!Schema::hasColumn('produks', 'kecamatan')) {
            $table->string('kecamatan')->nullable();
        }
        if (!Schema::hasColumn('produks', 'kelurahan')) {
            $table->string('kelurahan')->nullable();
        }
    });
}
public function down(): void
{
    Schema::table('produks', function (Blueprint $table) {
        $cols = ['owner', 'kontak', 'logo', 'provinsi', 'kabupaten_kota', 'kecamatan', 'kelurahan'];
        foreach ($cols as $col) {
            if (Schema::hasColumn('produks', $col)) {
                $table->dropColumn($col);
            }
        }
    });
}
};
