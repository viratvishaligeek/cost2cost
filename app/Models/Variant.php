<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use BelongsToTenant, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'product_id',
        'combo',
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
        'additional_details',
        'custom_table',
        'default',
        'status',
        'tenant_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function images()
    {
        return $this->hasOne(ProductImage::class, 'variant_id');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'variant_options', 'variant_id', 'option_id')
            ->withPivot('value_id', 'product_id')
            ->withTimestamps();
    }
    protected $hidden = [
        'tenant_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
