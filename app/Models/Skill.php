<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Skill extends Model
{
    public function skillType(): BelongsTo
    {
        return $this->belongsTo(SkillType::class);
    }

    public function personSkills(): HasMany
    {
        return $this->hasMany(PersonSkill::class);
    }

    public function persons(): HasManyThrough
    {
        return $this->hasManyThrough(Person::class, SkillLevel::class);
    }

    public function modifiers(): MorphMany
    {
        return $this->morphMany(Modifier::class, 'entity');
    }
}
