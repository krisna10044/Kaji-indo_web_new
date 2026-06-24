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
       
        if (!Schema::hasColumn('produks', 'nib')) {
            $table->string('nib')->nullable()->after('kontak');
        }
        if (!Schema::hasColumn('produks', 'id_tkm')) {
            $table->string('id_tkm')->nullable()->after('nib');
        }
    });
}

public function down(): void
{
    Schema::table('produks', function (Blueprint $table) {
        $table->dropColumn(['nib', 'id_tkm']);
    });
}
};
