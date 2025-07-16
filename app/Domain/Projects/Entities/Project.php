<?php


namespace App\Domain\Projects\Entities;

class Project
{
    public function __construct(
        public readonly string $name,
        public readonly int $teamId,
        public readonly ?string $description = null
    ) {}
}
