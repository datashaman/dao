<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterItem extends Model
{
    use HasFactory;

    protected $casts = [
        'equipped' => 'boolean',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
