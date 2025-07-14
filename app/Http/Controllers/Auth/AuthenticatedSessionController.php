<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {   
      // Authenticate user credentials
    $request->authenticate();

    $user = Auth::user();

    // Get current tenant from middleware
    $tenant = app('currentTenant');

    // Check if tenant is set and matches user's tenant_id
    if (!$tenant || $user->tenant_id !== $tenant->id) {
        Auth::logout(); // logout user if tenant mismatch
        return response()->json([
            'message' => 'Invalid tenant for this user.'
        ], 403); // Forbidden
    }

    // Create API token after tenant validation
    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
