<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantUserTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = \App\Models\Tenant::create([
        'name' => 'Team One',
        'domain' => 'team1',
    ]);

    $team = \App\Models\Team::create([
        'tenant_id' => $tenant->id,
        'name' => 'Alpha Team',
    ]);

    \App\Models\User::create([
        'name' => 'Tenant Admin',
        'email' => 'admin@team1.bizconnect.test',
        'password' => bcrypt('password'),
        'tenant_id' => $tenant->id,
        'team_id' => $team->id,
    ]);
    }
}
