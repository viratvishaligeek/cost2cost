<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Backend\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Throwable;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AdminAuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }

    public function tryLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'password' => ['required', 'min:6'],
        ]);
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()
                ->with('error', "Too many login attempts. Please try again in {$seconds} seconds.")
                ->withInput();
        }
        try {
            $this->authService->authenticate($credentials, $request);
            RateLimiter::clear($throttleKey);

            return redirect()->intended('admin/dashboard')
                ->with('success', 'Welcome back to the Central Control Tower!');
        } catch (Throwable $e) {
            RateLimiter::hit($throttleKey, 60);
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                throw $e;
            }
            return back()
                ->with('error', 'Authentication failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
