<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryLocationResource\Pages;
use App\Models\City;
use App\Models\GalleryLocation;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryLocationResource extends Resource
{
    protected static ?string $model = GalleryLocation::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Wanderungen';
    protected static ?string $modelLabel = 'Wanderung';
    protected static ?string $pluralModelLabel = 'Wanderungen';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([

            TextInput::make('name')
                ->label('Name der Wanderung')
                ->required()
                ->maxLength(200)
                ->placeholder('z.B. Wanderung Kampenwand September 2024')
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Beschreibung')
                ->rows(3)
                ->columnSpanFull(),

            DatePicker::make('date')
                ->label('Datum')
                ->displayFormat('d.m.Y'),

            Toggle::make('published')
                ->label('Veröffentlicht')
                ->default(true),

            // ── Штат ──
            Select::make('state_code')
                ->label('Bundesland')
                ->options(fn () => State::orderBy('name')
                    ->pluck('name', 'code')
                    ->map(fn ($name, $code) => $name) // просто name, key = code
                    ->toArray()
                )
                ->default('BY')
                ->live()
                ->afterStateUpdated(fn (Set $set) => $set('city_id', null))
                ->required()
                ->dehydrated(false), // не сохраняем в БД, только для фильтрации

            // ── Город (список по штату) ──
            Select::make('city_id')
                ->label('Stadt')
                ->options(fn (Get $get) => self::getCityOptions($get('state_code')))
                ->searchable()
                ->required()
                ->disabled(fn (Get $get) => blank($get('state_code')))
                ->hidden(fn (Get $get) => $get('state_code') === 'UN')
                ->live(),

            // ── Текстовый ввод для Unbekannt ──
            TextInput::make('new_city_name')
                ->label('Stadtname (unbekannt)')
                ->placeholder('Stadtname eingeben...')
                ->hidden(fn (Get $get) => $get('state_code') !== 'UN')
                ->dehydrated(false)
                ->live(),

            // ── Обложка альбома (только при редактировании) ──
            Select::make('cover_photo_id')
                ->label('Titelbild')
                ->options(fn (?GalleryLocation $record) => $record?->exists
                    ? $record->photos()
                        ->pluck('caption', 'id')
                        ->map(fn ($caption, $id) => $caption ?? "Foto #{$id}")
                        ->toArray()
                    : []
                )
                ->nullable()
                ->hidden(fn (?GalleryLocation $record) => !$record?->exists)
                ->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('city.name')
                    ->label('Stadt')
                    ->placeholder('—'),

                TextColumn::make('city.state_code')
                    ->label('Bundesland')
                    ->placeholder('—'),

                TextColumn::make('date')
                    ->label('Datum')
                    ->date('d.m.Y')
                    ->sortable(),

                TextColumn::make('photos_count')
                    ->label('Fotos')
                    ->counts('photos')
                    ->badge(),

                IconColumn::make('published')
                    ->label('Online')
                    ->boolean(),
            ])
            ->defaultSort('date', 'desc')
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGalleryLocations::route('/'),
            'create' => Pages\CreateGalleryLocation::route('/create'),
            'edit'   => Pages\EditGalleryLocation::route('/{record}/edit'),
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
