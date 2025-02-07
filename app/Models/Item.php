<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Item extends Model
{
    public function modifiers(): MorphMany
    {
        return $this->morphMany(Modifier::class, 'entity');
    }

    public function persons(): MorphToMany
    {
        return $this
            ->morphToMany(Person::class, 'entity');
    }

    public function attributes(): BelongsToMany
    {
        return $this
            ->belongsToMany(Attribute::class)
            ->withPivot(['value', 'max_value']);
    }
}
