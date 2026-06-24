<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'title')) {
                $table->string('title')->nullable()->after('id');
            }
            if (!Schema::hasColumn('programs', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title');
            }
            if (!Schema::hasColumn('programs', 'short_description')) {
                $table->text('short_description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('programs', 'full_description')) {
                $table->longText('full_description')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('programs', 'target')) {
                $table->string('target')->nullable()->after('full_description');
            }
            if (!Schema::hasColumn('programs', 'curriculum')) {
                $table->longText('curriculum')->nullable()->after('target');
            }
            if (!Schema::hasColumn('programs', 'materials')) {
                $table->longText('materials')->nullable()->after('curriculum');
            }
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $cols = ['title', 'slug', 'short_description', 'full_description',
                     'target', 'curriculum', 'materials'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('programs', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};