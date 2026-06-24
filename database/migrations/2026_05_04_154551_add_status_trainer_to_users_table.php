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
        // Cek dulu apakah kolom sudah ada, jika belum baru buat
        if (!Schema::hasColumn('users', 'trainer_status')) {
            $table->string('trainer_status')->default('none')->after('role');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'trainer_status')) {
            $table->dropColumn('trainer_status');
        }
    });
}
};
