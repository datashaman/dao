<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillType extends Model
{
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
