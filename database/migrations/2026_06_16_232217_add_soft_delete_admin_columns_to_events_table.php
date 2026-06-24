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
        Schema::table('events', function (Blueprint $table) {
            $table->timestamp('deleted_by_admin_at')->nullable()->after('status');
            $table->unsignedBigInteger('deleted_by_admin_id')->nullable()->after('deleted_by_admin_at');
            $table->text('deleted_reason')->nullable()->after('deleted_by_admin_id');
            $table->foreign('deleted_by_admin_id')->references('id')->on('users')->nullOnDelete();
        });
    }
    
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['deleted_by_admin_id']);
            $table->dropColumn(['deleted_by_admin_at', 'deleted_by_admin_id', 'deleted_reason']);
        });
    }
};
