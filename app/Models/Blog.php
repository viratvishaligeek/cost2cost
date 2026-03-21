<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'slug',
        'featured_image',
        'author_id',
        'publisher_id',
        'publish_date',
        'tags',
        'category_id',
        'tenant_id',
        'description',
        'status',

    ];
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Admin::class, 'publisher_id');
    }
}
