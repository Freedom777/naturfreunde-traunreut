<?php

namespace App\Filament\Resources\GalleryPhotoResource\Pages;

use App\Filament\Resources\GalleryPhotoResource;
use App\Models\City;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryPhoto extends CreateRecord
{
    protected static string $resource = GalleryPhotoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->resolveCityFromUnbekannt($data);
    }

    private function resolveCityFromUnbekannt(array $data): array
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
}
