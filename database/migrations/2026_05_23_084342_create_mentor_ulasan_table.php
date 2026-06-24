<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_ulasan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('mentor')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('rating')->default(5)->comment('1–5 bintang');
            $table->text('komentar')->nullable();
            $table->timestamps();

            // Satu user UMKM hanya boleh memberi 1 ulasan per mentor
            $table->unique(['mentor_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_ulasan');
    }
};