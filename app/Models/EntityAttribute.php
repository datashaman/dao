<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class EntityAttribute extends Model
{
    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    public function people(): MorphToMany
    {
        return $this->morphedByMany(Person::class, 'entity');
    }

    public function items(): MorphToMany
    {
        return $this->morphedByMany(Item::class, 'entity');
    }
}
