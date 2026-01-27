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
        Schema::table('cafes', function (Blueprint $table) {
            if (!Schema::hasColumn('cafes', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('cafes', 'google_maps_url')) {
                $table->text('google_maps_url')->nullable()->after('address');
            }
            if (!Schema::hasColumn('cafes', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('google_maps_url');
            }
            if (!Schema::hasColumn('cafes', 'instagram_url')) {
                $table->string('instagram_url')->nullable()->after('whatsapp_number');
            }
            if (!Schema::hasColumn('cafes', 'tiktok_url')) {
                $table->string('tiktok_url')->nullable()->after('instagram_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down needed as this is a fix migration
    }
};
