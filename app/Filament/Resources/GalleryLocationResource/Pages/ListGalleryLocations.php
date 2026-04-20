<?php
namespace App\Filament\Resources\GalleryLocationResource\Pages;
use App\Filament\Resources\GalleryLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListGalleryLocations extends ListRecords {
    protected static string $resource = GalleryLocationResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
    protected static string|\UnitEnum|null $navigationGroup = 'Galerie';
}
