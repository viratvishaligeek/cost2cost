<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionValue extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'option_id',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
