<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    use HasUlids;

    protected $appends = [
        'health',
        'min_damage',
        'max_damage',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function weapons(): Attribute
    {
        return Attribute::make(
            get: fn () => collect($this->equipment)
                ->map(fn($equipment) => Item::find($equipment['item_id']))
                ->filter(
                    fn($item) => $item->item_type === 'weapon'
                )
        );
    }

    public function shield(): Attribute
    {
        return Attribute::make(
            get: fn () => collect($this->equipment)
                ->map(fn($equipment) => Item::find($equipment['item_id']))
                ->filter(
                    fn($item) => $item->item_type === 'armour'
                )
        );
    }

    public function damage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this
                ->weapons
                ->sum('damage')
        );
    }

    public function minDamage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this
                ->weapons
                ->sum('min_damage')
        );
    }

    public function maxDamage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this
                ->weapons
                ->sum('max_damage')
        );
    }
}
