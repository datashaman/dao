<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Bloodline extends Model
{
    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function modifiers(): MorphMany
    {
        return $this->morphMany(Modifier::class, 'entity');
    }
}
