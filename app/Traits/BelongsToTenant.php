<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope('tenant_filter', function (Builder $builder) {
            if (request()->is('api/*')) {
                return;
            }
            if (Auth::check()) {
                $tenantId = Auth::user()->tenant_id;

                if (!is_null($tenantId) && $tenantId != 0) {
                    $builder->where('tenant_id', $tenantId);
                }
            }
        });

        static::creating(function ($model) {
            $tenantId = Auth::user()->tenant_id ?? null;
            if ($tenantId === 0 || is_null($tenantId)) {
                throw ValidationException::withMessages([
                    'tenant_id' => 'Please select a tenant first before creating data.'
                ]);
            }
            $model->tenant_id = $tenantId;
        });

        static::updating(function ($model) {
            $tenantId = Auth::user()->tenant_id ?? null;
            if ($tenantId === 0 || is_null($tenantId)) {
                throw ValidationException::withMessages([
                    'tenant_id' => 'Please select a tenant first before updating data.'
                ]);
            }
            $model->tenant_id = $tenantId;
        });

        static::deleting(function ($model) {
            $tenantId = Auth::user()->tenant_id ?? null;
            if ($tenantId === 0 || is_null($tenantId)) {
                throw ValidationException::withMessages([
                    'tenant_id' => 'Please select a tenant first before deleting data.'
                ]);
            }
        });
    }
}
