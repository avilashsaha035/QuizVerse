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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('facebook_link')->nullable()->after('contact_number');
            $table->string('linkedin_link')->nullable()->after('facebook_link');
            $table->string('instagram_link')->nullable()->after('linkedin_link');
            $table->string('whatsapp_link')->nullable()->after('instagram_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['facebook_link', 'linkedin_link', 'instagram_link', 'whatsapp_link']);
        });
    }
};
