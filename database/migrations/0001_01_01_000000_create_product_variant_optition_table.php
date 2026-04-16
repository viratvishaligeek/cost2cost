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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->string('slug')->unique();
            $table->foreignId('brand_id')->index();
            $table->foreignId('category_id')->index();
            $table->bigInteger('sub_category_id')->nullable()->index();
            $table->string('origin', 100)->nullable();
            $table->enum('refundable', ['yes', 'no'])->default('no');
            $table->string('refund_limit', 50)->nullable();
            $table->string('sku', 50)->unique()->index()->nullable();
            $table->string('bar_code', 50)->nullable();
            $table->string('hsn_code', 50)->nullable();
            $table->decimal('base_price', 10, 2)->nullable();
            $table->bigInteger('gst')->nullable();
            $table->decimal('mrp', 10, 2)->index()->nullable();
            $table->decimal('sell_price', 10, 2)->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed');
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('weight')->nullable();
            $table->string('dimension', 50)->nullable();
            $table->bigInteger('stock')->nullable();
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'low_stock'])->default('in_stock')->index();
            $table->bigInteger('low_stock')->nullable();
            $table->bigInteger('min_order')->nullable();
            $table->bigInteger('max_order')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('top_product')->default(0);
            $table->boolean('featured_product')->default(0);
            $table->longText('tags')->nullable();
            $table->enum('has_variation', ['yes', 'no'])->default('no');
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft')->index();
            $table->longText('custom_table')->nullable();
            $table->bigInteger('tenant_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->foreignId('product_id')->index();
            $table->string('combo')->unique();
            $table->enum('refundable', ['yes', 'no'])->default('no');
            $table->string('refund_limit', 50)->nullable();
            $table->string('sku', 50)->unique()->index()->nullable();
            $table->string('bar_code', 50)->nullable();
            $table->string('hsn_code', 50)->nullable();
            $table->decimal('base_price', 10, 2)->nullable();
            $table->bigInteger('gst')->nullable();
            $table->decimal('mrp', 10, 2)->index()->nullable();
            $table->decimal('sell_price', 10, 2)->nullable();
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed');
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('weight')->nullable();
            $table->string('dimension', 50)->nullable();
            $table->bigInteger('stock')->nullable();
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'low_stock'])->default('in_stock')->index();
            $table->bigInteger('low_stock')->nullable();
            $table->bigInteger('min_order')->nullable();
            $table->bigInteger('max_order')->nullable();
            $table->longText('additional_details')->nullable();
            $table->longText('custom_table')->nullable();
            $table->boolean('default')->default(0);
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft')->index();
            $table->bigInteger('tenant_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('variant_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('variant_id');
            $table->bigInteger('option_id');
            $table->bigInteger('value_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->index();
            $table->bigInteger('variant_id')->nullable();
            $table->string('featured_image')->nullable();
            $table->longText('gallery')->nullable();
            $table->longText('lifestyle')->nullable();
            $table->longText('infographics')->nullable();
            $table->longText('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_options');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('variants');
        Schema::dropIfExists('products');
    }
};
