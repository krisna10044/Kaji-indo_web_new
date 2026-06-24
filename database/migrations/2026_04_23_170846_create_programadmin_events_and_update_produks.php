<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Tabel programs ───────────────────────────────────────
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->nullable()->constrained('mentor')->nullOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('metode')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('durasi')->nullable();
            $table->unsignedInteger('kuota')->nullable();
            $table->string('bahasa')->default('Bahasa Indonesia');
            $table->string('status')->default('pending'); // pending|approved|rejected
            $table->text('catatan_admin')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('rejected_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // ── Tabel events ─────────────────────────────────────────
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->nullable()->constrained('mentor')->nullOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('tanggal')->nullable();
            $table->unsignedInteger('kapasitas')->nullable();
            $table->string('status')->default('pending'); // pending|approved|rejected
            $table->text('catatan_admin')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('rejected_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // ── Tambah kolom ke produks ──────────────────────────────
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'harga')) {
                $table->unsignedBigInteger('harga')->default(0)->after('nama');
            }
            if (!Schema::hasColumn('produks', 'kategori')) {
                $table->string('kategori')->nullable()->after('harga');
            }
            if (!Schema::hasColumn('produks', 'status')) {
                $table->string('status')->default('pending')->after('kategori');
            }
            if (!Schema::hasColumn('produks', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('status');
            }
            if (!Schema::hasColumn('produks', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('catatan_admin');
            }
            if (!Schema::hasColumn('produks', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->after('approved_at');
            }
            if (!Schema::hasColumn('produks', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('approved_by');
            }
            if (!Schema::hasColumn('produks', 'rejected_by')) {
                $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete()->after('rejected_at');
            }
            if (!Schema::hasColumn('produks', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            }
        });

        // ── Tambah suspended_at ke users ─────────────────────────
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'suspended_at')) {
                $table->timestamp('suspended_at')->nullable()->after('remember_token');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('programs');

        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn(['status', 'catatan_admin', 'approved_at', 'approved_by', 'rejected_at', 'rejected_by', 'user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('suspended_at');
        });
    }
};