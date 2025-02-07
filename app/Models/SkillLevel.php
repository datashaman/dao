<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SkillLevel extends Model
{
    public function personSkills(): HasMany
    {
        return $this->hasMany(PersonSkill::class);
    }

    public function skills(): HasManyThrough
    {
        return $this->hasManyThrough(Skill::class, PersonSkill::class);
    }
}
