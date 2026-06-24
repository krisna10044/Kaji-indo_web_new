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
    Schema::table('users', function (Blueprint $table) {
        $table->string('nik')->nullable();
        $table->string('npwp')->nullable();
        $table->string('academic_degree')->nullable(); // Nama + Gelar
        $table->string('ijazah_file')->nullable();
        $table->text('experience')->nullable(); // Pengalaman pendampingan
        $table->string('ktp_scan')->nullable();
        $table->string('bnsp_certificate')->nullable();
        $table->string('white_bg_photo')->nullable();
        $table->string('drive_link_documentation')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
