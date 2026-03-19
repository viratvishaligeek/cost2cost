<?php

use App\Models\Setting;
use App\Models\Tenant;

if (!function_exists('GlobalSetting')) {
    function GlobalSetting($key, $site_id = null)
    {
        $siteId = $site_id ?? 0;
        $value = Setting::where('site_id', $siteId)->where('option', $key)->first();
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
        } else {
            return '';
        }
    }
}
if (!function_exists('TenantList')) {
    function TenantList($id = null)
    {
        if (is_null($id)) {
            return Tenant::all();
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
        if (auth()->user()->can($permission)) {
            return true;
        }
    }

    return false;
}
