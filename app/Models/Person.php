<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Person extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function homePlanet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function bloodline(): BelongsTo
    {
        return $this->belongsTo(Bloodline::class);
    }

    public function attributes(): MorphToMany
    {
        return $this
            ->morphToMany(Attribute::class, 'entity');
    }

    public function items(): MorphToMany
    {
        return $this
            ->morphToMany(Item::class, 'entity');
    }

    public function personProfessions(): HasMany
    {
        return $this->hasMany(PersonProfession::class);
    }

    public function professions(): HasManyThrough
    {
        return $this->hasManyThrough(Profession::class, PersonProfession::class);
    }

    public function personSkills(): HasMany
    {
        return $this->hasMany(PersonSkill::class);
    }

    public function skills(): HasManyThrough
    {
        return $this->hasManyThrough(Skill::class, PersonSkill::class);
    }

    public function titles(): BelongsToMany
    {
        return $this->belongsToMany(Title::class);
    }
}
