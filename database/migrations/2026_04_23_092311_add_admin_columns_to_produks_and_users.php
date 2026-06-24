<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom status & catatan_admin ke tabel produks,
     * dan suspended_at ke tabel users untuk keperluan Admin Dashboard.
     */
    public function up(): void
    {
        // Tambah status approval ke produk
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'status')) {
                $table->string('status')->default('pending')->after('kategori')
                      ->comment('pending | approved | rejected');
            }
            if (!Schema::hasColumn('produks', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('status');
            }
            if (!Schema::hasColumn('produks', 'harga')) {
                $table->unsignedBigInteger('harga')->default(0)->after('nama');
            }
        });

        // Tambah suspended_at ke users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'suspended_at')) {
                $table->timestamp('suspended_at')->nullable()->after('remember_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn(['status', 'catatan_admin']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('suspended_at');
        });
    }
};