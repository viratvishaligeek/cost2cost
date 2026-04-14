<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use BelongsToTenant, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'sub_category_id',
        'origin',
        'refundable',
        'refund_limit',
        'sku',
        'bar_code',
        'hsn_code',
        'base_price',
        'gst',
        'mrp',
        'sell_price',
        'discount_type',
        'discount',
        'weight',
        'dimension',
        'stock',
        'stock_status',
        'low_stock',
        'min_order',
        'max_order',
        'short_description',
        'description',
        'top_product',
        'featured_product',
        'tags',
        'has_variation',
        'status',
        'custom_table',
        'tenant_id'
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    protected $hidden = [
        'tenant_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
