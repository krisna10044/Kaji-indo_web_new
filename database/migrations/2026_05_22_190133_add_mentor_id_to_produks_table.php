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
    Schema::table('produks', function (Blueprint $table) {
        // Menambahkan kolom mentor_id yang terhubung ke tabel mentor
        $table->foreignId('mentor_id')->nullable()->constrained('mentor')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('produks', function (Blueprint $table) {
        $table->dropForeign(['mentor_id']);
        $table->dropColumn('mentor_id');
    });
}
};
