<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryPhotoResource\Pages;
use App\Models\City;
use App\Models\GalleryPhoto;
use App\Models\State;
use App\Services\ExifExtractorService;
use App\Services\GeocoderService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoResource extends Resource
{
    protected static ?string $model = GalleryPhoto::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Fotos';
    protected static ?string $modelLabel = 'Foto';
    protected static ?string $pluralModelLabel = 'Fotos';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ── Альбом ──
            Select::make('gallery_location_id')
                ->label('Wanderung / Album')
                ->relationship('location', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->columnSpanFull(),

            // ── Загрузка фото ──
            FileUpload::make('path')
                ->label('Foto')
                ->image()
                ->directory('gallery')
                ->imageEditor()
                ->maxSize(12288) // 12 MB
                ->required()
                ->columnSpanFull()
                ->live()
                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                    if (!$state) {
                        return;
                    }

                    $fullPath = Storage::path($state);

                    // Извлекаем EXIF
                    $exif = app(ExifExtractorService::class)->extract($fullPath);

                    // Дата съёмки
                    if ($exif['taken_at_date']) {
                        $set('taken_at_date', $exif['taken_at_date']);
                        $set('date_from_exif', true);
                    } else {
                        $set('date_from_exif', false);
                    }

                    // GPS → город
                    if ($exif['gps']) {
                        $cityId = app(GeocoderService::class)->getCityId(
                            $exif['gps']['lat'],
                            $exif['gps']['lng'],
                        );

                        if ($cityId) {
                            $city = City::find($cityId);
                            $set('city_id', $cityId);
                            $set('state_code', $city?->state_code);
                            $set('gps_found', true);
                            return;
                        }
                    }

                    // GPS не найден или город не определён
                    $set('gps_found', false);
                    $set('state_code', 'UN');
                    $set('city_id', null);
                }),

            // ── Скрытые служебные поля ──
            \Filament\Forms\Components\Hidden::make('date_from_exif')->default(false),
            \Filament\Forms\Components\Hidden::make('gps_found')->default(false),

            // ── Дата съёмки ──
            DatePicker::make('taken_at_date')
                ->label(fn (Get $get) => $get('date_from_exif')
                    ? 'Aufnahmedatum (aus EXIF)'
                    : 'Aufnahmedatum'
                )
                ->displayFormat('d.m.Y')
                ->nullable(),

            // ── Подпись ──
            TextInput::make('caption')
                ->label('Bildunterschrift')
                ->placeholder('z.B. Gipfelpanorama Kampenwand')
                ->maxLength(200)
                ->nullable(),

            // ── Штат ──
            Select::make('state_code')
                ->label(fn (Get $get) => $get('gps_found')
                    ? 'Bundesland (aus GPS ermittelt)'
                    : 'Bundesland'
                )
                ->options(fn () => State::orderBy('name')
                    ->get()
                    ->mapWithKeys(fn ($state) => [
                        $state->code => "{$state->emoji} {$state->name}",
                    ])
                    ->toArray()
                )
                ->default('UN')
                ->live()
                ->afterStateUpdated(fn (Set $set) => $set('city_id', null))
                ->dehydrated(false),

            // ── Город (список) ──
            Select::make('city_id')
                ->label(fn (Get $get) => $get('gps_found')
                    ? 'Stadt (aus GPS ermittelt)'
                    : 'Stadt'
                )
                ->options(fn (Get $get) => self::getCityOptions($get('state_code')))
                ->searchable()
                ->nullable()
                ->disabled(fn (Get $get) => blank($get('state_code')))
                ->hidden(fn (Get $get) => $get('state_code') === 'UN')
                ->live(),

            // ── Текстовый ввод для Unbekannt ──
            TextInput::make('new_city_name')
                ->label('Stadtname')
                ->placeholder('Stadtname eingeben (optional)...')
                ->hidden(fn (Get $get) => $get('state_code') !== 'UN')
                ->dehydrated(false)
                ->nullable(),

            // ── Служебные ──
            TextInput::make('sort_order')
                ->label('Reihenfolge')
                ->numeric()
                ->default(0),

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
                    ->label('Wanderung')
                    ->limit(35)
                    ->searchable(),

                TextColumn::make('city.name')
                    ->label('Stadt')
                    ->placeholder('—'),

                TextColumn::make('caption')
                    ->label('Bildunterschrift')
                    ->limit(40)
                    ->placeholder('—'),

                TextColumn::make('taken_at_date')
                    ->label('Datum')
                    ->date('d.m.Y')
                    ->placeholder('—')
                    ->sortable(),

                IconColumn::make('published')
                    ->label('Online')
                    ->boolean(),
            ])
            ->defaultSort('taken_at_date', 'desc')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('gallery_location_id')
                    ->label('Wanderung')
                    ->relationship('location', 'name'),

                SelectFilter::make('city_id')
                    ->label('Stadt')
                    ->relationship('city', 'name'),
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

    private static function getCityOptions(?string $stateCode): array
    {
        if (blank($stateCode)) {
            return [];
        }

        return City::where('state_code', $stateCode)
            ->orderBy('zip_code')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn (City $city) => [
                $city->id => $city->zip_code
                    ? "{$city->zip_code} — {$city->name}"
                    : $city->name,
            ])
            ->toArray();
    }
}
