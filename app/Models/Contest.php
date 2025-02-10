<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contest extends Model
{
    use HasFactory;
    use HasUlids;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contestants(): HasMany
    {
        return $this->hasMany(Contestant::class);
    }
}
