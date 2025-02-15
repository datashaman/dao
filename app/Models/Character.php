<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use MongoDB\Laravel\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $appends = [
        'defence',
        'health',
        'min_damage',
        'max_damage',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function health(): Attribute
    {
        return new Attribute(
            get: fn (mixed $value, array $attr) => max(2, (Arr::get($attr, 'attributes.constitution') * 2) + (Arr::get($attr, 'attributes.constitution') >= 15 ? 5 : 0))
        );
    }

    public function defenceModifier(): Attribute
    {
        return new Attribute(
            get: fn (mixed $value, array $attr) => max(
                -1,
                (int) floor(Arr::get($attr, 'attributes.dexterity') * 0.6 + (Arr::get($attr, 'attributes.dexterity') >= 15 ? 1 : 0)) - 2
            )
        );
    }

    public function weapons(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => collect(Arr::get($attr, 'equipment'))
                ->map(fn ($equipment) => Item::find($equipment['item_id']))
                ->where('item_type', 'weapon')
        );
    }

    public function shield(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => collect(Arr::get($attr, 'equipment'))
                ->map(fn ($equipment) => Item::find($equipment['item_id']))
                ->where('item_type', 'armour')
                ->first()
        );
    }

    public function defence(): Attribute
    {
        return new Attribute(
            get: fn (mixed $value, array $attr) => max(
                0,
                $this->shield->defence + $this->defence_modifier
            )
        );
    }

    public function damageModifier(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => max(
                -2,
                (int) floor(Arr::get($attr, 'attributes.strength') / 3)
                    + (Arr::get($attr, 'attributes.strength') >= 15 ? 1 : 0)
                    - 3
            )
        );
    }

    public function damage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this
                ->weapons
                ->sum('damage') + $this->damage_modifier
        );
    }

    public function minDamage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this
                ->weapons
                ->sum('min_damage') + $this->damage_modifier
        );
    }

    public function maxDamage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this
                ->weapons
                ->sum('max_damage') + $this->damage_modifier
        );
    }
}
