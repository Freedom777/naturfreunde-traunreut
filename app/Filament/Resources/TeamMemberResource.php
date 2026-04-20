<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Team';
    protected static ?string $modelLabel = 'Mitglied';
    protected static ?string $pluralModelLabel = 'Team';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $form): Schema
    {
        return $form->schema([

            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(100)
                ->columnSpanFull(),

            TextInput::make('role')
                ->label('Funktion')
                ->required()
                ->placeholder('z.B. 1. Vorstand, Kassier')
                ->maxLength(100),

            Select::make('group')
                ->label('Gruppe')
                ->options([
                    'Vorstand'            => 'Vorstand und Funktionen',
                    'Weitere Funktionen'  => 'Weitere Funktionen',
                ])
                ->required(),

            Textarea::make('bio')
                ->label('Beschreibung')
                ->placeholder('z.B. Leitet die Sitzungen und Versammlungen')
                ->rows(2)
                ->columnSpanFull(),

            FileUpload::make('photo')
                ->label('Foto')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('team')
                ->imageEditor()
                ->maxSize(4096)
                ->nullable()
                ->columnSpanFull(),

            TextInput::make('email')
                ->label('E-Mail')
                ->email()
                ->nullable(),

            TextInput::make('phone')
                ->label('Telefon')
                ->nullable()
                ->placeholder('+49 8621 9003115'),

            TextInput::make('phone_mobile')
                ->label('Mobil')
                ->nullable()
                ->placeholder('+49 170 2928458'),

            TextInput::make('sort_order')
                ->label('Reihenfolge')
                ->numeric()
                ->default(0),

            Toggle::make('active')
                ->label('Aktiv')
                ->default(true),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(fn (TeamMember $r) => 'https://ui-avatars.com/api/?name='.urlencode($r->name).'&background=2f5c1a&color=fff'),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label('Funktion')
                    ->badge()
                    ->color('success'),

                TextColumn::make('group')
                    ->label('Gruppe'),

                IconColumn::make('active')
                    ->label('Aktiv')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'Vorstand'           => 'Vorstand',
                        'Weitere Funktionen' => 'Weitere Funktionen',
                    ]),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit'   => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
