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
        if ($page === 'global') {
            $pageName = 'Global Settings';
            return view('backend.setting.' . $page, compact('pageName'));
        }
        $capital = ucfirst($page);
        $tenant = TenantList(Auth::user()->site_id);
        if (!empty($tenant)) {
            $pageName = ($tenant->name ?? 'Global') . "'s " . $capital . ' Settings';
            return view('backend.setting.' . $page, compact('pageName'));
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $siteId = $request->site_id ?? ($user->site_id ?? 0);
            foreach ($request->except('_token', 'site_id') as $key => $value) {
                Setting::updateOrCreate(
                    [
                        'option' => $key,
                        'site_id' => $siteId,
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
