<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Item extends Model
{
    use HasFactory;
    use HasUlids;

    protected $casts = [
        'quantifiable' => 'boolean',
    ];

    public function itemType(): BelongsTo
    {
        return $this->belongsTo(ItemType::class);
    }

    public function characterItems(): HasMany
    {
        return $this->hasMany(CharacterItem::class);
    }

    public function characters(): HasManyThrough
    {
        return $this->hasManyThrough(Character::class, CharacterItem::class);
    }

    public function minDamage(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attr) => $this->calculateDamage('min')
        );
    }

    public function maxDamage(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attr) => $this->calculateDamage('max')
        );
    }

    public function damage(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attr) => $this->calculateDamage()
        );
    }

    public function calculateDamage(string $type = 'rand'): Attribute
    {
        return $this->rollDice($type)
            + ($this->base_modifier ?? 0)
            + ($this->modifier ?? 0);
    }

    protected function rollDice(
        string $type = 'rand'
    ): int {
        $roll = 0;

        for($i = 0; $i < $this->dice_count; $i++) {
            $roll += (int) match ($type) {
                'min' => 1,
                'max' => $this->dice_size,
                'avg' => (1 + $this->dice_size) / 2,
                'rand' => rand(1, $this->dice_size),
            };
        }

        return $roll;
    }
}
