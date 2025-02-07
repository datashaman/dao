<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TitleType extends Model
{
    public function titles(): HasMany
    {
        return $this->hasMany(Title::class);
    }
}
