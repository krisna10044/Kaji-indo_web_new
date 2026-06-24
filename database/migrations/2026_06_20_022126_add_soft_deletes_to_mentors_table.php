<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->softDeletes(); // menambah kolom deleted_at nullable
        });
    }

    public function down(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->dropSoftDeletes(); // hapus kolom deleted_at jika rollback
        });
    }
};