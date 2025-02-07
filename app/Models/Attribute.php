<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Attribute extends Model
{
    public function modifiers(): HasMany
    {
        return $this->hasMany(Modifier::class);
    }

    public function persons(): MorphToMany
    {
        return $this
            ->morphToMany( Person::class, 'entity');
    }

    public function items(): BelongsToMany
    {
        return $this
            ->belongsToMany(Item::class)
            ->withPivot(['value', 'max_value']);
    }
}
