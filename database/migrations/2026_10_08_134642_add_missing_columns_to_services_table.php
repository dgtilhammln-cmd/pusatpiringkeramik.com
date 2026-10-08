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
            if (!Schema::hasColumn('services', 'service_category_id')) {
                $table->unsignedBigInteger('service_category_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('services', 'brochure')) {
                $table->string('brochure')->nullable()->after('image');
            }
            if (!Schema::hasColumn('services', 'gallery')) {
                $table->json('gallery')->nullable()->after('brochure');
            }
            if (!Schema::hasColumn('services', 'specifications')) {
                $table->json('specifications')->nullable()->after('description');
            }
            if (!Schema::hasColumn('services', 'faqs')) {
                $table->json('faqs')->nullable()->after('specifications');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $cols = ['service_category_id', 'brochure', 'gallery', 'specifications', 'faqs'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('services', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
