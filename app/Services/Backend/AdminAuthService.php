<?php

namespace App\Services\Backend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthService
{
    /**
     * Handle the admin authentication logic.
     */
    public function authenticate(array $credentials, $request): void
    {
        if (!Auth::guard('admin')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ('The provided credentials do not match our records.'),
            ]);
        }

        $request->session()->regenerate();
    }
}
