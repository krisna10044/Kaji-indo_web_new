<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('produks', function (Blueprint $table) {
        // Mengubah istilah foto menjadi logo (atau menambah kolom logo)
        $table->string('logo')->nullable()->after('id');
        
        // Kolom Alamat Detail
        $table->string('provinsi')->nullable();
        $table->string('kabupaten_kota')->nullable();
        $table->string('kecamatan')->nullable();
        $table->string('kelurahan')->nullable();
        
        // Kolom untuk Peta
        $table->string('latitude')->nullable();
        $table->string('longitude')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            //
        });
    }
};
