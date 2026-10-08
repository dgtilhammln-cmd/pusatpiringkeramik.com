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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'price')) {
                $table->decimal('price', 15, 2)->nullable()->after('short_desc');
            }
            if (!Schema::hasColumn('services', 'rating')) {
                $table->decimal('rating', 3, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('services', 'sold_count')) {
                $table->string('sold_count')->nullable()->after('rating');
            }
            if (!Schema::hasColumn('services', 'shopee_link')) {
                $table->text('shopee_link')->nullable()->after('brochure');
            }
            if (!Schema::hasColumn('services', 'tokopedia_link')) {
                $table->text('tokopedia_link')->nullable()->after('shopee_link');
            }
            if (!Schema::hasColumn('services', 'tiktok_link')) {
                $table->text('tiktok_link')->nullable()->after('tokopedia_link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $cols = ['price', 'rating', 'sold_count', 'shopee_link', 'tokopedia_link', 'tiktok_link'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('services', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
