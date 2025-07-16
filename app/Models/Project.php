<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'team_id', 'description', 'tenant_id'];

    public function scopeForCurrentTenant($query)
    {
        $tenant = app('currentTenant');
        return $tenant
            ? $query->where('tenant_id', $tenant->id)
            : $query->whereRaw('0 = 1');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
