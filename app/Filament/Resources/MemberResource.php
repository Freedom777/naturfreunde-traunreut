<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Jubilare';
    protected static ?string $modelLabel = 'Mitglied';
    protected static ?string $pluralModelLabel = 'Mitglieder';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(150),

            TextInput::make('year_joined')
                ->label('Eintrittsjahr')
                ->required()
                ->numeric()
                ->minValue(1895)
                ->maxValue((int) date('Y'))
                ->placeholder('z.B. 1986')
                ->helperText('Aktuell ' . ((int) date('Y') - 0) . ' → Mitgliedsjahre werden automatisch berechnet'),

            Toggle::make('active')
                ->label('Aktiv')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('year_joined')
                    ->label('Eintrittsjahr')
                    ->sortable(),

                TextColumn::make('years')
                    ->label('Jahre Mitglied')
                    ->badge()
                    ->color(fn (Member $record) => $record->is_jubilee ? 'success' : 'gray')
                    ->formatStateUsing(fn (Member $record) => $record->years . ' Jahre'
                        . ($record->is_jubilee ? ' 🎉' : '')),

                IconColumn::make('active')
                    ->label('Aktiv')
                    ->boolean(),
            ])
            ->defaultSort('year_joined')
            ->filters([
                TernaryFilter::make('active')
                    ->label('Status')
                    ->placeholder('Alle')
                    ->trueLabel('Aktiv')
                    ->falseLabel('Inaktiv'),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit'   => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
