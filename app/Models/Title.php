<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Title extends Model
{
    public function titleType(): BelongsTo
    {
        return $this->belongsTo(TitleType::class);
    }

    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function modifiers(): MorphMany
    {
        return $this->morphMany(Modifier::class, 'entity');
    }
}
