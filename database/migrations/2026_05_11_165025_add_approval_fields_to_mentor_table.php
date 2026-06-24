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
        Schema::table('mentor', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('nama');
            $table->string('phone')->nullable()->after('full_name');
            $table->string('email')->nullable()->after('phone');
            $table->string('gmaps_location')->nullable()->after('lokasi');
            $table->text('bio')->nullable()->after('deskripsi');
            $table->string('ktp_scan')->nullable()->after('bio');
            $table->string('white_bg_photo')->nullable()->after('ktp_scan');
            $table->string('status')->default('pending')->after('white_bg_photo');
            $table->string('rejection_reason')->nullable()->after('status');
            $table->timestamp('reviewed_at')->nullable()->after('rejection_reason');
            $table->foreignId('user_id')->nullable()->constrained('users')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['full_name', 'phone', 'email', 'gmaps_location', 'bio', 'ktp_scan', 'white_bg_photo', 'status', 'rejection_reason', 'reviewed_at', 'user_id']);
        });
    }
};
