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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->foreignId('author_id');
            $table->foreignId('publisher_id');
            $table->timestamp('publish_date');
            $table->string('tags')->nullable();
            $table->string('category_id', 100);
            $table->string('site_id', 10)->default(0);
            $table->longText('description')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
