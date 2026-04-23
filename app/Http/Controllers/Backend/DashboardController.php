<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return View
     */
    public function dashboard()
    {
        $pageName = 'Dashboard';

        return view('backend.dashboard', compact('pageName'));
    }

    public function updateActiveTenant(Request $request)
    {
        $user = Auth::user();
        $tenantId = $request->input('tenant_id');
        try {
            if ($tenantId === '0' || $tenantId === 0) {
                $user->tenant_id = 0;
            } else {
                $request->validate([
                    'tenant_id' => 'required|integer|exists:tenants,id',
                ]);
                $user->tenant_id = (int) $tenantId;
            }
            $user->save();

            return response()->json([
                'success' => true,
                'tenant_id' => $user->tenant_id,
                'message' => $user->tenant_id === 0 ? 'Viewing all tenants' : 'Tenant selected successfully',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
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
