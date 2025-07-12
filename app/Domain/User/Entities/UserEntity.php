<?php

namespace App\Domain\User\Entities;

class UserEntity
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {}

    public function displayName(): string
    {
        return strtoupper($this->name);
    }
}
