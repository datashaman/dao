<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\ItemType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $weapon = ItemType::query()->create([
            'id' => 'weapon',
            'name' => 'Weapon',
        ]);

        $shield = ItemType::query()->create([
            'id' => 'shield',
            'name' => 'Shield',
        ]);

        $shortSword = $weapon->items()->create([
            'name' => 'Short Sword',
            'dice_count' => 1,
            'dice_size' => 4,
            'base_modifier' => 1,
        ]);

        $buckler = $shield->items()->create([
            'name' => 'Buckler',
            'defence' => 2,
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $character = $user->characters()->create([
            'name' => 'Errant Monk',
            'strength' => 10,
            'constitution' => 10,
            'dexterity' => 10,
        ]);

        $character->characterItems()->create([
            'item_id' => $shortSword->id,
            'equipped' => true,
        ]);

        $character->characterItems()->create([
            'item_id' => $buckler->id,
            'equipped' => true,
        ]);

        $enemy = Character::query()->create([
            'name' => 'Gibbering Wreck',
            'strength' => 10,
            'constitution' => 10,
            'dexterity' => 10,
        ]);

        $enemy->characterItems()->create([
            'item_id' => $buckler->id,
            'equipped' => true,
        ]);
    }
}
