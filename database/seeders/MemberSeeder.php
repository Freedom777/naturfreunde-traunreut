<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/members.csv');

        if (!file_exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        $file    = fopen($path, 'r');
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);

            Member::firstOrCreate(
                ['name' => $data['name']],
                [
                    'year_joined' => (int) $data['year_joined'],
                    'active'      => true,
                ]
            );
        }

        fclose($file);

        $this->command->info('Member seeder completed.');
    }
}
