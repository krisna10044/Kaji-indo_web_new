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
    Schema::table('programs', function (Blueprint $table) {
        $table->string('materi_type')->nullable()->after('program_selesai'); // pdf / youtube
        $table->string('materi_youtube')->nullable()->after('materi_type');
        $table->string('materi_pdf')->nullable()->after('materi_youtube');
        $table->string('akses_mulai')->nullable()->after('materi_pdf');
        $table->string('akses_selesai')->nullable()->after('akses_mulai');
    });
}

public function down(): void
{
    Schema::table('programs', function (Blueprint $table) {
        $table->dropColumn(['materi_type', 'materi_youtube', 'materi_pdf', 'akses_mulai', 'akses_selesai']);
    });
}
};
