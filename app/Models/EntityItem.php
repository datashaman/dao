<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class EntityItem extends Model
{
    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    public function persons(): MorphToMany
    {
        return $this->morphedByMany( Person::class, 'entity');
    }

    public function regions(): MorphToMany
    {
        return $this->morphedByMany( Region::class, 'entity');
    }
}
