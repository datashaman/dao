<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Universe extends Model
{
    public function sectors(): HasMany
    {
        return $this->hasMany(Sector::class);
    }

    public function planets(): HasManyThrough
    {
        return $this->hasManyThrough(Planet::class, Sector::class);
    }
}
