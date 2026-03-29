<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/team-members.csv');

        if (!file_exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        $file = fopen($path, 'r');
        $headers = fgetcsv($file); // пропускаем заголовок

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);

            TeamMember::firstOrCreate(
                ['name' => $data['name'], 'role' => $data['role']],
                [
                    'group'        => $data['group'],
                    'bio'          => $data['bio'] ?: null,
                    'email'        => $data['email'] ?: null,
                    'phone'        => $data['phone'] ?: null,
                    'phone_mobile' => $data['phone_mobile'] ?: null,
                    'sort_order'   => (int) $data['sort_order'],
                    'photo'        => null,
                    'active'       => true,
                ]
            );
        }

        fclose($file);

        $this->command->info('TeamMember seeder completed.');
    }
}
