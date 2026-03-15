<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Сначала штаты, потом города (порядок важен из-за FK)
        $this->call([
            StateSeeder::class,
            CitySeeder::class,
        ]);

        // ── Sample Events ────────────────────────────────────
        $events = [
            [
                'title'       => 'Rundwanderung Seeon',
                'description' => 'Rundwanderung in Seeon nach Ischl. Treffpunkt 11:00 Uhr beim TUS Parkplatz.',
                'location'    => 'TUS Parkplatz, Traunreut',
                'category'    => 'wanderung',
                'starts_at'   => '2026-03-08 11:00:00',
                'ends_at'     => '2026-03-08 15:00:00',
            ],
            [
                'title'       => 'Traunreuter Stadtschiessen',
                'description' => 'Sportschützengesellschaft Traunreut — wir nehmen wieder teil.',
                'location'    => 'Traunreut',
                'category'    => 'sport',
                'starts_at'   => '2026-03-10 09:00:00',
                'ends_at'     => '2026-03-14 17:00:00',
                'all_day'     => true,
            ],
            [
                'title'       => 'Müllsammelaktion',
                'description' => 'Treffpunkt 9:00 Uhr gegenüber dem Wertstoffhof. Handschuhe & Säcke werden gestellt. Danach Brotzeit um 12:00 Uhr.',
                'location'    => 'Wertstoffhof Traunreut',
                'category'    => 'umwelt',
                'starts_at'   => '2026-03-14 09:00:00',
                'ends_at'     => '2026-03-14 12:00:00',
            ],
            [
                'title'       => 'Geselliger Nachmittag',
                'description' => 'Gemütlicher Nachmittag im Café Arte. Freunde und Gäste herzlich willkommen!',
                'location'    => 'Café Arte, Traunreut',
                'category'    => 'gemeinschaft',
                'starts_at'   => '2026-03-26 14:30:00',
                'ends_at'     => '2026-03-26 18:00:00',
            ],
            [
                'title'       => 'Jahreshauptversammlung',
                'description' => 'Jährliche Mitgliederversammlung des Vereins.',
                'location'    => 'Vereinsheim Traunreut',
                'category'    => 'other',
                'starts_at'   => '2026-03-04 19:00:00',
                'ends_at'     => '2026-03-04 21:00:00',
            ],
            [
                'title'       => 'Ostermarsch',
                'description' => 'Gemeinsamer Ostermarsch — alle herzlich eingeladen.',
                'location'    => 'Traunreut Stadtmitte',
                'category'    => 'gemeinschaft',
                'starts_at'   => '2026-04-04 09:00:00',
                'ends_at'     => '2026-04-04 13:00:00',
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(
                ['title' => $event['title'], 'starts_at' => $event['starts_at']],
                array_merge(['guests_welcome' => true, 'published' => true, 'all_day' => false], $event)
            );
        }
    }
}
