<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deleted_event_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer_user_id');
            $table->string('event_title');
            $table->date('event_tanggal')->nullable();
            $table->timestamp('deleted_at_by_admin');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('trainer_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deleted_event_logs');
    }
};