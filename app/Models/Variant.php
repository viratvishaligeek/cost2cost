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
        'id',
        'product_id',
        'combo',
        'name',
        'dimension',
        'weight',
        'gst',
        'mrp',
        'discount_type',
        'discount_erp',
        'discount_web',
        'discount_app',
        'low_stock',
        'sell_erp',
        'sell_web',
        'sell_app',
        'min_order',
        'base_erp',
        'base_web',
        'base_app',
        'max_order',
        'isbn',
        'version',
        'old_isbn',
        'on_rent',
        'security_amount',
        'rent_amount',
        'rent_return',
        'status',
        'stock',
        'refundable',
        'refund_limit',
        'short_description',
        'description',
        'toc',
        'syllabus',
        'tags',
        'default',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'variant_options')
            ->withPivot('value_id');
    }

    protected $hidden = [
        'tenant_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
