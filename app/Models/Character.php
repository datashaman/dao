<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Character extends Model
{
    use HasFactory;
    use HasUlids;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function characterItems(): HasMany
    {
        return $this->hasMany(CharacterItem::class);
    }

    public function items(): HasManyThrough
    {
        return $this->hasManyThrough(Item::class, CharacterItem::class);
    }

    public function contestants(): HasMany
    {
        return $this->hasMany(Contestant::class);
    }

    public function contests(): HasManyThrough
    {
        return $this->hasManyThrough(Contest::class, Contestant::class);
    }

    public function weapons(): Attribute
    {
        return Attribute::make(
            get: fn (): Collection => $this->characterItems()
                ->with(['item', 'item.itemType'])
                ->join('items', 'items.id', '=', 'character_items.item_id')
                ->where('character_items.equipped', true)
                ->where('items.item_type_id', 'weapon')
                ->get(['character_items.*'])
        );
    }

    public function shield(): Attribute
    {
        return Attribute::make(
            get: fn (): ?CharacterItem => $this->characterItems()
                ->with(['item', 'item.itemType'])
                ->join('items', 'items.id', '=', 'character_items.item_id')
                ->where('character_items.equipped', true)
                ->where('items.item_type_id', 'shield')
                ->first(['character_items.*'])
        );
    }

    public function damage(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attr) => $this->weapons->sum('damage')
        );
    }
}
