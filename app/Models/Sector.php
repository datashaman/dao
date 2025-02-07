<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    public function universe(): BelongsTo
    {
        return $this->belongsTo(Universe::class);
    }

    public function planets(): HasMany
    {
        return $this->hasMany(Planet::class);
    }
}
