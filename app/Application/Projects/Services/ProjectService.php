<?php

namespace App\Application\Projects\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    public function create(array $data): Project
    {
        $tenant = app('currentTenant');
        $team = Auth::user()->team;

        return Project::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'team_id' => $team->id,
            'tenant_id' => $tenant->id,
        ]);
    }

    public function all()
    {
        return Project::forCurrentTenant()->get();
    }

    public function find(int $id): ?Project
    {
        return Project::forCurrentTenant()->find($id);
    }
}
