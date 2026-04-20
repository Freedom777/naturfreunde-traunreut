<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Nachrichten';
    protected static ?string $modelLabel = 'Nachricht';
    protected static ?string $pluralModelLabel = 'Nachrichten';
    protected static ?int $navigationSort = 5;

    // Показываем badge с количеством непрочитанных
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('read', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'warning';
    }

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Name')
                ->disabled(),

            TextInput::make('email')
                ->label('E-Mail')
                ->disabled(),

            Textarea::make('message')
                ->label('Nachricht')
                ->disabled()
                ->rows(6)
                ->columnSpanFull(),

            Toggle::make('read')
                ->label('Gelesen')
                ->default(false),
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

                TextColumn::make('email')
                    ->label('E-Mail')
                    ->searchable(),

                TextColumn::make('message')
                    ->label('Nachricht')
                    ->limit(60)
                    ->tooltip(fn (ContactMessage $record) => $record->message),

                IconColumn::make('read')
                    ->label('Gelesen')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Eingegangen')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('read')
                    ->label('Status')
                    ->placeholder('Alle')
                    ->trueLabel('Gelesen')
                    ->falseLabel('Ungelesen'),
            ])
            ->actions([
                ViewAction::make()
                    ->after(function (ContactMessage $record) {
                        // Помечаем как прочитанное при открытии
                        $record->update(['read' => true]);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view'  => Pages\ViewContactMessage::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Создание через форму на сайте, не через админку
    }
}
