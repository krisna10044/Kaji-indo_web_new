<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'trainer_id')) {
                $table->foreignId('trainer_id')->nullable()
                      ->constrained('mentor')->nullOnDelete()->after('id');
            }
            if (!Schema::hasColumn('programs', 'judul')) {
                $table->string('judul')->nullable()->after('trainer_id');
            }
            if (!Schema::hasColumn('programs', 'metode')) {
                $table->string('metode')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('programs', 'tingkat')) {
                $table->string('tingkat')->nullable()->after('metode');
            }
            if (!Schema::hasColumn('programs', 'kuota')) {
                $table->unsignedInteger('kuota')->nullable()->after('tingkat');
            }
            if (!Schema::hasColumn('programs', 'bahasa')) {
                $table->string('bahasa')->default('Bahasa Indonesia')->after('kuota');
            }
            if (!Schema::hasColumn('programs', 'status')) {
                $table->string('status')->default('pending')->after('bahasa');
            }
            if (!Schema::hasColumn('programs', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('status');
            }
            if (!Schema::hasColumn('programs', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('catatan_admin');
            }
            if (!Schema::hasColumn('programs', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()
                      ->constrained('users')->nullOnDelete()->after('approved_at');
            }
            if (!Schema::hasColumn('programs', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('approved_by');
            }
            if (!Schema::hasColumn('programs', 'rejected_by')) {
                $table->foreignId('rejected_by')->nullable()
                      ->constrained('users')->nullOnDelete()->after('rejected_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $cols = ['trainer_id', 'judul', 'metode', 'tingkat', 'kuota',
                     'bahasa', 'status', 'catatan_admin',
                     'approved_at', 'approved_by', 'rejected_at', 'rejected_by'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('programs', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};