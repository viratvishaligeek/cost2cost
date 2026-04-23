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
        Schema::create('seo_plugins', function (Blueprint $table) {
            $table->id();
            $table->longText('content_type');
            $table->longText('content_id');
            $table->longText('title')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_robot')->nullable();
            $table->longText('slug')->nullable();
            $table->longText('canonical_tag')->nullable();
            $table->longText('og_title')->nullable();
            $table->longText('og_type')->nullable();
            $table->longText('og_description')->nullable();
            $table->longText('og_url')->nullable();
            $table->longText('og_image')->nullable();
            $table->longText('og_site')->nullable();
            $table->longText('og_locale')->nullable();
            $table->longText('og_video')->nullable();
            $table->longText('og_audio')->nullable();
            $table->longText('twitter_card')->nullable();
            $table->longText('twitter_site')->nullable();
            $table->longText('twitter_title')->nullable();
            $table->longText('twitter_description')->nullable();
            $table->longText('twitter_image')->nullable();
            $table->longText('twitter_url')->nullable();
            $table->longText('indexing_switch')->nullable();
            $table->longText('fnf_switch')->nullable();
            $table->longText('schema')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_plugins');
    }
};
