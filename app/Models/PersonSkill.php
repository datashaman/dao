<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonSkill extends Model
{
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function skillLevel(): BelongsTo
    {
        return $this->belongsTo(SkillLevel::class);
    }
}
