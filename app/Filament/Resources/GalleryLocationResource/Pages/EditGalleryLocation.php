<?php

namespace App\Filament\Resources\GalleryLocationResource\Pages;

use App\Filament\Resources\GalleryLocationResource;
use App\Models\City;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGalleryLocation extends EditRecord
{
    protected static string $resource = GalleryLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }

    // При открытии формы — восстановить state_code из города
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!empty($data['city_id'])) {
            $city = City::find($data['city_id']);
            $data['state_code'] = $city?->state_code;
        }

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

        unset($data['state_code'], $data['new_city_name']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
