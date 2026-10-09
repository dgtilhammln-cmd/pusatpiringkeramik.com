<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('lead_type')->default('popup')->after('id');
            $table->string('ref_code')->nullable()->index()->after('lead_type');
            $table->unsignedBigInteger('seq_number')->nullable()->index()->after('ref_code');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['lead_type', 'ref_code', 'seq_number']);
        });
    }
};
