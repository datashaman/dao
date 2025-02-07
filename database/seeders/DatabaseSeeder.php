<?php

namespace Database\Seeders;

use App\Models\Planet;
use App\Models\Universe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $universe = Universe::create([
            'name' => 'Test Universe',
        ]);

        $maxSectors = rand(1, 5);

        for ($x = 0; $x < $maxSectors; $x++) {
            $sector = $universe->sectors()->create([
                'name' => "Test Sector $x",
            ]);

            $maxPlanets = rand(1, 7);

            for ($y = 0; $y < $maxPlanets; $y++) {
                $planet = $sector->planets()->create([
                    "name" => "Test Planet $y",
                ]);

                $maxRegions = rand(1, 7);

                for ($z = 0; $z < $maxRegions; $z++) {
                    $region = $planet->regions()->create([
                        "name" => "Test Region $z",
                    ]);
                }
            }
        }
    }
}
