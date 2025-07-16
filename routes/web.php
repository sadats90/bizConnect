<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tenant;
use App\Application\User\Services\UserService;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\IdentifyTenant;

// Middleware to identify tenant should be applied globally or inside middleware group

// Routes for tenant-specific subdomains
Route::domain('{tenant}.bizconnect.test')
    ->group(function () {

        require __DIR__.'/auth.php';

        Route::get('/', function () {
            $tenant = app('currentTenant');
            return "Welcome to tenant: " . $tenant->name;
        });

        Route::get('/dashboard', function () {
            $tenant = app('currentTenant');
            return "Dashboard for: " . $tenant->name;
        });

      

    });

// Central domain routes (non-tenant)
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test-ddd', function (UserService $userService) {
    $user = $userService->getUserById(1);
    return $user->displayName();
});
