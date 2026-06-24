<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            // Kolom untuk KURIKULUM
            $table->unsignedInteger('jumlah_materi')->nullable()->after('konten_kurikulum');
            $table->decimal('total_jam', 5, 1)->nullable()->after('jumlah_materi');
            $table->unsignedInteger('jumlah_sesi')->nullable()->after('total_jam');
            $table->boolean('sertifikat')->default(false)->after('jumlah_sesi');

            // Kolom untuk MODUL (simpel: judul + deskripsi + urutan + kurikulum_id)
            $table->unsignedInteger('urutan')->nullable()->after('sertifikat');
            $table->unsignedBigInteger('kurikulum_id')->nullable()->after('urutan');

            $table->foreign('kurikulum_id')
                  ->references('id')
                  ->on('programs')
                  ->onDelete('cascade'); // hapus modul jika kurikulum dihapus
        });

        // Update enum tipe: tambah 'modul'
        DB::statement("ALTER TABLE programs MODIFY COLUMN tipe ENUM('kurikulum','materi','modul') NOT NULL DEFAULT 'kurikulum'");
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['kurikulum_id']);
            $table->dropColumn([
                'jumlah_materi', 'total_jam', 'jumlah_sesi',
                'sertifikat', 'urutan', 'kurikulum_id',
            ]);
        });
        DB::statement("ALTER TABLE programs MODIFY COLUMN tipe ENUM('kurikulum','materi') NOT NULL DEFAULT 'kurikulum'");
    }
};