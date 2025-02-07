<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfessionLevel extends Model
{
    public function professions(): HasMany
    {
        return $this->hasMany(Profession::class);
    }
}
