<?php

namespace Database\Seeders;

use App\Models\Race;
use App\Models\TitleType;
use App\Models\Universe;
use App\Models\User;
use App\Support\NameGenerator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(NameGenerator $nameGenerator): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $universe = Universe::create([
            'name' => 'Test Universe',
        ]);

        $maxSectors = rand(1, 5);

        for ($x = 1; $x <= $maxSectors; $x++) {
            $sector = $universe->sectors()->create([
                'name' => "Sector $x",
            ]);

            $maxPlanets = rand(1, 7);

            for ($y = 0; $y < $maxPlanets; $y++) {
                $planet = $sector->planets()->create([
                    "name" => $nameGenerator->generate(false),
                ]);

                $maxRegions = rand(1, 7);

                for ($z = 0; $z < $maxRegions; $z++) {
                    $region = $planet->regions()->create([
                        "name" => $nameGenerator->generate(),
                    ]);
                }
            }
        }

        $limited = TitleType::create([
            'name' => 'Limited',
        ]);

        $progenitor = $limited->titles()->create([
            'name' => 'Progenitor',
        ]);

        $unique = TitleType::create([
            'name' => 'Unique',
        ]);

        $human = Race::create([
            'name' => 'Human',
        ]);

        $person = $user->people()->create([
            'family_name' => 'Zachary',
            'given_name' => 'Atwood',
            'honorific' => 'Lord',
            'birth_region_id' => $region->id,
            'current_region_id' => $region->id,
            'race_id' => $human->id,
        ]);

        $person->titles()->save($progenitor);
    }
}

