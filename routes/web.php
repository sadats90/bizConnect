<?php

use Illuminate\Support\Facades\Route;
use App\Application\User\Services\UserService;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::get('/test-ddd', function (UserService $userService) {
    $user = $userService->getUserById(1); // Adjust ID as needed

    return $user->displayName();
});

require __DIR__.'/auth.php';
