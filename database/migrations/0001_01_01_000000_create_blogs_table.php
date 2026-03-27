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
            $table->string('name')->index();
            $table->string('slug');
            $table->string('featured_image')->nullable();
            $table->foreignId('author_id')->index();
            $table->foreignId('publisher_id')->index();
            $table->date('publish_date');
            $table->longText('tags')->nullable();
            $table->string('category_id', 100)->index();
            $table->bigInteger('tenant_id')->index();
            $table->longText('description')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
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
