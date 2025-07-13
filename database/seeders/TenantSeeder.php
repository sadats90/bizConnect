<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder {
    public function run(): void {
        Tenant::create(['name' => 'Team 1', 'domain' => 'team1']);
        Tenant::create(['name' => 'Team 2', 'domain' => 'team2']);
    }
}