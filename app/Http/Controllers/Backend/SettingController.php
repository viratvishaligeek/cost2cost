<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function edit($page)
    {
        $user = Auth::user();
        $tenantId = $user->tenant_id;
        if ($tenantId === 0) {
            if ($page === 'global') {
                $pageName = 'Global Settings';
                return view('backend.setting.' . $page, compact('pageName'));
            }
            return redirect(route('admin.dashboard'))->with('error', 'Please select a tenant first.');
        }
        $tenant = TenantList($tenantId);
        if (!$tenant) {
            return redirect(route('admin.dashboard'))->with('error', 'Tenant not found.');
        }
        if ($page === 'global') {
            return redirect(route('admin.dashboard'))->with('error', 'Global settings are only for super-admin.');
        }
        $capital = ucfirst($page);
        $pageName = ($tenant->name ?? 'Tenant') . "'s " . $capital . ' Settings';
        return view('backend.setting.' . $page, compact('pageName'));
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $tenantId = $request->tenant_id ?? ($user->tenant_id ?? 1);
            foreach ($request->except('_token', 'tenant_id') as $key => $value) {
                Setting::updateOrCreate(
                    [
                        'option' => $key,
                        'tenant_id' => $tenantId,
                    ],
                    [
                        'value' => $value
                    ]
                );
            }
            Cache::forget('global_settings');
            return redirect()->back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings. ' . $e->getMessage());
        }
    }
}
