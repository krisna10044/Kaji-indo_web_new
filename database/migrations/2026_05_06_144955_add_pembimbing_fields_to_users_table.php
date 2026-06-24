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
       Schema::table('users', function (Blueprint $table) {
           $table->boolean('is_pembimbing')->default(false)->after('trainer_status');
           $table->timestamp('pembimbing_expired_at')->nullable()->after('is_pembimbing');
       });
   }

   public function down(): void
   {
       Schema::table('users', function (Blueprint $table) {
           $table->dropColumn(['is_pembimbing', 'pembimbing_expired_at']);
       });
   }
};
