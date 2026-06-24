<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'rejection_reason')) {
            Schema::table('users', function (Blueprint $table) {
                $table->text('rejection_reason')->nullable()->after('trainer_status');
            });
        }
    }
    
    public function down(): void
    {
        if (Schema::hasColumn('users', 'rejection_reason')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('rejection_reason');
            });
        }
    }
};