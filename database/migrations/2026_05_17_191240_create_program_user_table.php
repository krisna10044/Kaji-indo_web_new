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
    Schema::create('program_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID User UMKM
        $table->foreignId('program_id')->constrained()->onDelete('cascade'); // ID Program Pelatihan (sesuaikan nama tabel jika milik trainer berbeda)
        $table->string('status')->default('joined'); // status: joined, ongoing, completed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_user');
    }
};
