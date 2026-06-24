<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->string('foto_detail')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks', function (Blueprint $table) {
            $table->dropColumn('foto_detail');
            $table->dropColumn('keterangan');
            $table->dropColumn('alamat');
        });
    }
};
