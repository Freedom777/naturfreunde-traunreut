<?php

namespace App\Filament\Resources\GalleryLocationResource\Pages;

use App\Filament\Resources\GalleryLocationResource;
use App\Models\City;
use App\Models\State;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryLocation extends CreateRecord
{
    protected static string $resource = GalleryLocationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Если выбран Unbekannt и введено название города — создаём запись
        if (($data['state_code'] ?? null) === 'UN' && !empty($data['new_city_name'])) {
            $unknownState = State::where('code', 'UN')->firstOrFail();

            $city = City::create([
                'state_code' => 'UN',
                'name'       => $data['new_city_name'],
                'zip_code'   => null,
                'is_district'=> false,
            ]);

            $data['city_id'] = $city->id;
        }

        unset($data['state_code'], $data['new_city_name']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
