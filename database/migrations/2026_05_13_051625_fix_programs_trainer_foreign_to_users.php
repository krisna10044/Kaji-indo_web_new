<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['trainer_id']);
            $table->foreign('trainer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['trainer_id']);
            $table->foreign('trainer_id')
                  ->references('id')
                  ->on('mentor')
                  ->onDelete('set null');
        });
    }
};