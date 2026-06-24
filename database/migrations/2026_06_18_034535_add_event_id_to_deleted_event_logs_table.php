<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('deleted_event_logs', function (Blueprint $table) {
        $table->unsignedBigInteger('event_id')->nullable()->after('trainer_user_id');
    });
}

public function down()
{
    Schema::table('deleted_event_logs', function (Blueprint $table) {
        $table->dropColumn('event_id');
    });
}
};
