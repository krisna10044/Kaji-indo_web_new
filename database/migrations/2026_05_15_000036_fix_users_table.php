<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom username jika ada
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }

            // Tambah kolom role jika belum ada
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['umum', 'admin', 'trainer', 'umkm', 'mentor'])
                    ->default('umum')
                    ->after('password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->string('username')->unique()->after('name');
        });
    }
};
