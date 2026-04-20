<?php
namespace App\Filament\Resources\GalleryPhotoResource\Pages;
use App\Filament\Resources\GalleryPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListGalleryPhotos extends ListRecords {
    protected static string $resource = GalleryPhotoResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
    protected static string|\UnitEnum|null $navigationGroup = 'Galerie';
}
