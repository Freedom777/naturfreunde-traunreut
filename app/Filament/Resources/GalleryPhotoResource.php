<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryPhotoResource\Pages;
use App\Models\GalleryPhoto;
use App\Models\GalleryLocation;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleryPhotoResource extends Resource
{
    protected static ?string $model = GalleryPhoto::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Fotos';
    protected static ?string $modelLabel = 'Foto';
    protected static ?string $pluralModelLabel = 'Galerie-Fotos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('gallery_location_id')
                ->label('Ort / Lokation')
                ->relationship('location', 'name')
                ->searchable()
                ->required(),

            FileUpload::make('path')
                ->label('Foto hochladen')
                ->image()
                ->directory('gallery')
                ->imageEditor()
                ->maxSize(8192) // 8 MB
                ->columnSpanFull()
                ->required(),

            TextInput::make('caption')
                ->label('Bildunterschrift')
                ->placeholder('z.B. Gipfelpanorama Kampenwand — September 2024')
                ->maxLength(200)
                ->columnSpanFull(),

            TextInput::make('taken_at_date')
                ->label('Aufnahmedatum (Text)')
                ->placeholder('z.B. September 2024'),

            TextInput::make('sort_order')
                ->label('Reihenfolge')
                ->numeric()
                ->default(0),

            Toggle::make('featured')
                ->label('Hervorgehoben (breite Kachel)')
                ->default(false),

            Toggle::make('published')
                ->label('Veröffentlicht')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')
                    ->label('Vorschau')
                    ->square()
                    ->size(60),

                TextColumn::make('location.name')
                    ->label('Ort')
                    ->badge()
                    ->sortable(),

                TextColumn::make('caption')
                    ->label('Bildunterschrift')
                    ->limit(45)
                    ->placeholder('—'),

                TextColumn::make('taken_at_date')
                    ->label('Datum')
                    ->placeholder('—'),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('published')
                    ->label('Online')
                    ->boolean(),
            ])
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('gallery_location_id')
                    ->label('Ort')
                    ->relationship('location', 'name'),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGalleryPhotos::route('/'),
            'create' => Pages\CreateGalleryPhoto::route('/create'),
            'edit'   => Pages\EditGalleryPhoto::route('/{record}/edit'),
        ];
    }
}
