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
            $table->string('slug')->unique()->after('name')->nullable();
            $table->string('tagline')->nullable()->after('description');
            $table->string('photo_exterior')->nullable()->after('image_path');
            $table->string('photo_interior')->nullable()->after('photo_exterior');
            $table->string('instagram_username')->nullable()->after('whatsapp_number');
            $table->string('tiktok_username')->nullable()->after('instagram_username');
            $table->integer('established_year')->nullable()->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cafes', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'tagline',
                'photo_exterior',
                'photo_interior',
                'instagram_username',
                'tiktok_username',
                'established_year',
            ]);
        });
    }
};
