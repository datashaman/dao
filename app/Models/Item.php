<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    use HasUlids;

    protected $casts = [
        'quantifiable' => 'boolean',
    ];

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

    public function calculateDamage(string $type = 'rand'): int
    {
        return $this->rollDice($type)
            + ($this->base_modifier ?? 0)
            + ($this->modifier ?? 0);
    }

    protected function rollDice(
        string $type = 'rand'
    ): int {
        $roll = 0;

        for ($i = 0; $i < $this->dice_count; $i++) {
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
