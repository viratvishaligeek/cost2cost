<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $pageName = 'Dashboard';
        return view('backend.dashboard', compact('pageName'));
    }

    public function updateActiveSite(Request $request)
    {
        $user = Auth::user();
        if ($request->site_id == 'all') {
            $user->site_id = null;
        } else {
            $request->validate(['site_id' => 'exists:tenants,id']);
            $user->site_id = $request->site_id;
        }
        $user->save();
        return response()->json(['success' => true]);
    }

    public function clearCache()
    {
        try {
            Artisan::call('config:cache');
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('optimize:clear');
            return back()->with('success', 'Cache cleared successfully!');
        } catch (\Exception $e) {
            Log::error('Cache clear error: ' . $e->getMessage());
            return back()->with('error', 'Failed to clear cache. Please try again : ' . $e->getMessage());
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
}
