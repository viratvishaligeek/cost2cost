<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope('site_filter', function (Builder $builder) {
            if (Auth::check()) {
                $userSiteId = Auth::user()->site_id;
                if (!is_null($userSiteId)) {
                    $builder->where('site_id', $userSiteId);
                }
            }
        });

        static::creating(function ($model) {
            if (Auth::check() && !is_null(Auth::user()->site_id)) {
                $model->site_id = Auth::user()->site_id;
            }
        });
    }
}
