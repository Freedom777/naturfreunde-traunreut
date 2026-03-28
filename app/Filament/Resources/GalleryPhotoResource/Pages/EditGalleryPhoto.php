<?php

namespace App\Filament\Resources\GalleryPhotoResource\Pages;

use App\Filament\Resources\GalleryPhotoResource;
use App\Models\City;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGalleryPhoto extends EditRecord
{
    protected static string $resource = GalleryPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }

    // Восстановить state_code при открытии формы
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!empty($data['city_id'])) {
            $city = City::find($data['city_id']);
            $data['state_code'] = $city?->state_code ?? 'UN';
        } else {
            $data['state_code'] = 'UN';
        }

        $data['gps_found']      = false;
        $data['date_from_exif'] = false;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['state_code'] ?? null) === 'UN' && !empty($data['new_city_name'])) {
            $city = City::create([
                'state_code'  => 'UN',
                'name'        => $data['new_city_name'],
                'zip_code'    => null,
                'is_district' => false,
            ]);

            $data['city_id'] = $city->id;
        }

        unset($data['state_code'], $data['new_city_name'], $data['date_from_exif'], $data['gps_found']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
