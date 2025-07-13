<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;
use App\Application\User\Services\UserService;

// Tenant domain routes
Route::domain('{tenant}.bizconnect.test')->group(function () {
    Route::get('/', function ($tenant) {
        $tenantDomain = $tenant . '.bizconnect.test';
        $tenantModel = Tenant::where('domain', $tenantDomain)->first();

        if (!$tenantModel) {
            abort(404, 'Tenant not found');
        }

        return "Welcome to tenant: " . $tenantModel->name;
    });
});

// Central (non-tenant) routes
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test-ddd', function (UserService $userService) {
    $user = $userService->getUserById(1); // Adjust ID as needed
    return $user->displayName();
});

require __DIR__.'/auth.php';
