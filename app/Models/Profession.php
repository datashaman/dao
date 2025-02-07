<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Profession extends Model
{
    public function professionLevel(): BelongsTo
    {
        return $this->belongsTo(ProfessionLevel::class);
    }

    public function personProfessions(): HasMany
    {
        return $this->hasMany(PersonProfession::class);
    }

    public function people(): HasManyThrough
    {
        return $this->hasManyThrough(Person::class, PersonProfession::class);
    }
}
