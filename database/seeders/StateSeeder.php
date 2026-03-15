<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            ['emoji' => '🐻', 'code' => 'BW', 'name' => 'Baden-Württemberg'],
            ['emoji' => '🦁', 'code' => 'BY', 'name' => 'Bayern'],
            ['emoji' => '🗼', 'code' => 'BE', 'name' => 'Berlin'],
            ['emoji' => '🦅', 'code' => 'BB', 'name' => 'Brandenburg'],
            ['emoji' => '🔑', 'code' => 'HB', 'name' => 'Bremen'],
            ['emoji' => '⚓', 'code' => 'HH', 'name' => 'Hamburg'],
            ['emoji' => '🏦', 'code' => 'HE', 'name' => 'Hessen'],
            ['emoji' => '🌊', 'code' => 'MV', 'name' => 'Mecklenburg-Vorpommern'],
            ['emoji' => '🐴', 'code' => 'NI', 'name' => 'Niedersachsen'],
            ['emoji' => '🌉', 'code' => 'NW', 'name' => 'Nordrhein-Westfalen'],
            ['emoji' => '🍷', 'code' => 'RP', 'name' => 'Rheinland-Pfalz'],
            ['emoji' => '⛏️', 'code' => 'SL', 'name' => 'Saarland'],
            ['emoji' => '🏰', 'code' => 'SN', 'name' => 'Sachsen'],
            ['emoji' => '🌾', 'code' => 'ST', 'name' => 'Sachsen-Anhalt'],
            ['emoji' => '⛵', 'code' => 'SH', 'name' => 'Schleswig-Holstein'],
            ['emoji' => '🌲', 'code' => 'TH', 'name' => 'Thüringen'],
            ['emoji' => '❓', 'code' => 'UN', 'name' => 'Unbekannt'],
        ];

        foreach ($states as $state) {
            State::firstOrCreate(
                ['code' => $state['code']],
                [
                    'emoji' => $state['emoji'],
                    'name' => $state['name']
                ]
            );
        }
    }
}
