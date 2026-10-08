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
        if (Schema::hasTable('hero_slides') && !Schema::hasColumn('hero_slides', 'image_mobile')) {
            Schema::table('hero_slides', function (Blueprint $table) {
                $table->string('image_mobile')->nullable()->after('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('hero_slides') && Schema::hasColumn('hero_slides', 'image_mobile')) {
            Schema::table('hero_slides', function (Blueprint $table) {
                $table->dropColumn('image_mobile');
            });
        }
    }
};
