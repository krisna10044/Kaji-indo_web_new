<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── STEP 1: Hapus kolom yang tidak dipakai ─────────────────────────
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'title',             // duplikat → sudah ada 'judul'
                'short_description', // duplikat → sudah ada 'deskripsi'
                'durasi',            // dipindah ke events nanti
                'kuota',             // dipindah ke events nanti
            ]);
        });

        // ── STEP 2: Rename kolom ke nama Indonesia ─────────────────────────
        Schema::table('programs', function (Blueprint $table) {
            $table->renameColumn('full_description', 'deskripsi_panjang');
            $table->renameColumn('curriculum',       'konten_kurikulum');
            $table->renameColumn('materials',        'konten_materi');
        });

        // ── STEP 3: Ubah tipe kolom konten menjadi LONGTEXT (untuk rich text Quill) ──
        DB::statement('ALTER TABLE programs MODIFY deskripsi_panjang LONGTEXT NULL');
        DB::statement('ALTER TABLE programs MODIFY konten_kurikulum  LONGTEXT NULL');
        DB::statement('ALTER TABLE programs MODIFY konten_materi     LONGTEXT NULL');

        // ── STEP 4: Tambah kolom baru ──────────────────────────────────────
        Schema::table('programs', function (Blueprint $table) {
            // tipe program: kurikulum / materi
            $table->enum('tipe', ['kurikulum', 'materi'])
                  ->default('kurikulum')
                  ->after('slug');

            // tanggal pelaksanaan
            $table->date('tanggal')
                  ->nullable()
                  ->after('bahasa');

            // thumbnail program
            $table->string('gambar')
                  ->nullable()
                  ->after('tanggal');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['tipe', 'tanggal', 'gambar']);
            $table->renameColumn('deskripsi_panjang', 'full_description');
            $table->renameColumn('konten_kurikulum',  'curriculum');
            $table->renameColumn('konten_materi',     'materials');
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('kuota')->nullable();
        });
    }
};