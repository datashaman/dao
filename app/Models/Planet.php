<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Planet extends Model
{
    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }

    public function nativePeople(): HasMany
    {
        return $this->hasMany(Person::class, 'home_planet_id');
    }

    public function modifiers(): MorphMany
    {
        return $this->morphMany(Modifier::class, 'entity');
    }
}
