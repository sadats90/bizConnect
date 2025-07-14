<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tenant;
use App\Application\User\Services\UserService;
use App\Http\Middleware\identifyTenant;




Route::domain('{tenant}.bizconnect.test')
    ->group(function () {

        require __DIR__.'/auth.php';
        Route::get('/', function () {
            $tenant = app('currentTenant'); // Retrieved from IdentifyTenant middleware
            return "Welcome to tenant: " . $tenant->name;
        });

        Route::get('/dashboard', function () {
            $tenant = app('currentTenant');
            return "Dashboard for: " . $tenant->name;
        });
    });

// Central domain routes
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test-ddd', function (UserService $userService) {
    $user = $userService->getUserById(1);
    return $user->displayName();
});


