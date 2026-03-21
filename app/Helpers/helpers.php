<?php

use App\Models\Setting;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

if (!function_exists('GlobalSetting')) {
    function GlobalSetting($key, $tenant_id = null)
    {
        $tenantId = $tenant_id ?? 0;
        $value = Setting::where('tenant_id', $tenantId)->where('option', $key)->first();
        return $value->value ?? null;
    }
}

if (!function_exists('GetStatusBadge')) {
    function GetStatusBadge($status)
    {
        if ($status == 'active') {
            return '<span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Active</span></span>';
        } else if ($status == 'inactive') {
            return '<span class="badge badge-phoenix fs-10 badge-phoenix-danger"><span class="badge-label">Inactive</span></span>';
        } else if ($status == 'draft') {
            return '<span class="badge  badge-phoenix fs-10 badge-phoenix-secondary"><span class="badge-label">Draft</span></span>';
        } else if ($status == 'archived') {
            return '<span class="badge  badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Archived</span></span>';
        } else if ($status == 'published') {
            return '<span class="badge  badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Published</span></span>';
        } else if ($status == 'pending') {
            return '<span class="badge  badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span></span>';
        } else {
            return '';
        }
    }
}

if (!function_exists('TenantList')) {
    function TenantList($id = null)
    {
        if (is_null($id)) {
            $allTenant = (object)[
                'id' => 0,
                'name' => 'All Tenants',
                'domain' => 'all',
                'status' => 'active',
                'notes' => 'All Tenants',
            ];
            $tenants = Tenant::all();
            return collect([$allTenant])->merge($tenants);
        }
        return Tenant::find($id);
    }
}

function hasAnyPermission($permissions)
{
    if (empty($permissions)) {
        return true;
    }
    foreach ($permissions as $permission) {
        if (Auth::user()->can($permission)) {
            return true;
        }
    }
    return false;
}
