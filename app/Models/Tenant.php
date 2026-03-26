<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'domain',
        'status',
        'notes',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'tenant_id');
    }

    public function blogCategories()
    {
        return $this->hasMany(BlogCategory::class, 'tenant_id');
    }

    public function teams()
    {
        return $this->hasMany(Admin::class, 'tenant_id');
    }
}
