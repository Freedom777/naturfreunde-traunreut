<?php

namespace App\Console\Commands;

use App\Models\TeamMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class ImportTeamPhotos extends Command
{
    protected $signature   = 'team:import-photos {--path=team/imports}';
    protected $description = 'Import team member photos, converts all to WebP';

    protected array $supported = ['jpg', 'jpeg', 'webp', 'png'];

    public function handle(): void
    {
        $importPath = $this->option('path');
        $files      = Storage::disk('local')->files($importPath);

        if (empty($files)) {
            $this->error("No files found in storage/app/{$importPath}");
            return;
        }

        $manager = ImageManager::usingDriver(Driver::class);

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (!in_array($ext, $this->supported)) {
                $this->warn("Skipping unsupported format: {$file}");
                continue;
            }

            $filename = pathinfo($file, PATHINFO_FILENAME);

            $member = TeamMember::whereRaw('LOWER(name) LIKE ?', [
                '%' . strtolower(str_replace('-', '%', $filename)) . '%'
            ])->first();

            if (!$member) {
                $this->warn("No match found for: {$filename}");
                continue;
            }

            $newPath     = 'team/' . $filename . '.webp';
            $fullSrcPath = Storage::disk('local')->path($file);
            $fullDstPath = Storage::disk('public')->path($newPath);

            // Создаём папку если нет
            if (!is_dir(dirname($fullDstPath))) {
                mkdir(dirname($fullDstPath), 0775, true);
            }

            $manager->decodePath($fullSrcPath)
                ->scaleDown(width: 800)
                ->encodeUsingFormat(Format::WEBP, quality: 85)
                ->save($fullDstPath);

            $member->update(['photo' => $newPath]);
            $this->info("✓ {$member->name} → {$newPath}");
        }

        $this->info('Done!');
    }
}
