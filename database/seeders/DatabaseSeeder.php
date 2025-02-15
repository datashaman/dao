<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $shortSword = Item::create([
            'item_type' => 'weapon',
            'name' => 'Short Sword',
            'dice_count' => 1,
            'dice_size' => 4,
            'base_modifier' => 1,
        ]);

        $buckler = Item::create([
            'item_type' => 'armour',
            'name' => 'Buckler',
            'defence' => 2,
        ]);

        $healingPotion = Item::create([
            'item_type' => 'potion',
            'name' => 'Healing Potion',
            'modifier' => 2,
            'quantifiable' => true,
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $playerCharacter = $user->characters()->create([
            'name' => 'Errant Monk',

            'attributes' => [
                'strength' => 2,
                'constitution' => 2,
                'dexterity' => 2,
            ],

            'equipment' => [
                [
                    'slot' => 'left-hand',
                    'item_id' => $shortSword->id,
                ],
                [
                    'slot' => 'right-hand',
                    'item_id' => $buckler->id,
                ],
            ],

            'inventory' => [
                'items' => [
                    [
                        'position' => [0, 0],
                        'quantity' => 3,
                        'item_id' => $healingPotion->id,
                    ],
                ],
                'size' => [4, 4],
            ],
        ]);

        $enemyCharacter = Character::query()->create([
            'name' => 'Gibbering Wreck',

            'attributes' => [
                'strength' => 2,
                'constitution' => 2,
                'dexterity' => 2,
            ],

            'equipment' => [
                [
                    'slot' => 'left-hand',
                    'item_id' => $shortSword->id,
                ],
            ],
        ]);

        $contest = $user->contests()->create([
            'name' => 'Test Contest',
            'min_contestants' => 1,
            'max_contestants' => 1,

            'contestants' => [
                [
                    'character_id' => $playerCharacter->id,
                    'status' => 'ready',
                ],
                [
                    'character_id' => $enemyCharacter->id,
                    'status' => 'ready',
                ],
            ],
        ]);
    }
}
