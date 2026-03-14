<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Veranstaltungen';
    protected static ?string $modelLabel = 'Veranstaltung';
    protected static ?string $pluralModelLabel = 'Veranstaltungen';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Titel')
                ->required()
                ->maxLength(200)
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Beschreibung')
                ->rows(3)
                ->columnSpanFull(),

            TextInput::make('location')
                ->label('Ort / Treffpunkt')
                ->placeholder('z.B. TUS Parkplatz, Traunreut'),

            Select::make('category')
                ->label('Kategorie')
                ->options([
                    'wanderung'    => '🥾 Wanderung',
                    'sport'        => '🎯 Sport',
                    'umwelt'       => '♻️ Umwelt',
                    'gemeinschaft' => '☕ Gemeinschaft',
                    'kultur'       => '🎭 Kultur',
                    'other'        => '📌 Sonstiges',
                ])
                ->default('wanderung')
                ->required(),

            DateTimePicker::make('starts_at')
                ->label('Beginn')
                ->required()
                ->seconds(false),

            DateTimePicker::make('ends_at')
                ->label('Ende (optional)')
                ->seconds(false)
                ->after('starts_at'),

            Toggle::make('all_day')
                ->label('Ganztägig')
                ->default(false),

            Toggle::make('guests_welcome')
                ->label('Gäste willkommen')
                ->default(true),

            Toggle::make('published')
                ->label('Veröffentlicht')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('starts_at')
                    ->label('Datum')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Titel')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('category')
                    ->label('Kategorie')
                    ->badge()
                    ->color(fn (string $state) => match($state) {
                        'wanderung'    => 'success',
                        'sport'        => 'info',
                        'umwelt'       => 'warning',
                        'gemeinschaft' => 'danger',
                        default        => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match($state) {
                        'wanderung'    => '🥾 Wanderung',
                        'sport'        => '🎯 Sport',
                        'umwelt'       => '♻️ Umwelt',
                        'gemeinschaft' => '☕ Gemeinschaft',
                        'kultur'       => '🎭 Kultur',
                        default        => '📌 Sonstiges',
                    }),

                TextColumn::make('location')
                    ->label('Ort')
                    ->limit(30)
                    ->placeholder('—'),

                IconColumn::make('published')
                    ->label('Online')
                    ->boolean(),
            ])
            ->defaultSort('starts_at')
            ->filters([
                SelectFilter::make('category')->options([
                    'wanderung'    => 'Wanderung',
                    'sport'        => 'Sport',
                    'umwelt'       => 'Umwelt',
                    'gemeinschaft' => 'Gemeinschaft',
                    'kultur'       => 'Kultur',
                ]),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit'   => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
