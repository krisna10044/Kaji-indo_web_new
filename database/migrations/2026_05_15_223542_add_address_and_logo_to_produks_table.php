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
        // Tambahkan kolom yang dilaporkan error tadi
        if (!Schema::hasColumn('produks', 'owner')) {
            $table->string('owner')->nullable()->after('nama');
        }
        if (!Schema::hasColumn('produks', 'kontak')) {
            $table->string('kontak')->nullable()->after('owner');
        }
        if (!Schema::hasColumn('produks', 'logo')) {
            $table->string('logo')->nullable()->after('id');
        }
        
        // Tambahkan kolom wilayah jika belum ada
        $table->string('provinsi')->nullable();
        $table->string('kabupaten_kota')->nullable();
        $table->string('kecamatan')->nullable();
        $table->string('kelurahan')->nullable();
    });
}

public function down(): void
{
    Schema::table('produks', function (Blueprint $table) {
        $table->dropColumn(['owner', 'kontak', 'logo', 'provinsi', 'kabupaten_kota', 'kecamatan', 'kelurahan']);
    });
}
};
