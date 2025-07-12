<?php

namespace App\Application\User\Services;

use App\Models\User;
use App\Domain\User\Entities\UserEntity;

class UserService
{
    public function getUserById(int $id): UserEntity
    {
        $user = User::findOrFail($id);

        return new UserEntity($user->id, $user->name, $user->email);
    }
}
