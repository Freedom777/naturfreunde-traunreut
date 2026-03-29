<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMessagesWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 3;
    protected static ?string $heading = 'Letzte Nachrichten';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::latest()->limit(5)
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Eingegangen')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Name'),

                TextColumn::make('email')
                    ->label('E-Mail'),

                TextColumn::make('message')
                    ->label('Nachricht')
                    ->limit(50)
                    ->tooltip(fn (ContactMessage $record) => $record->message),

                IconColumn::make('read')
                    ->label('Gelesen')
                    ->boolean(),
            ])
            ->actions([
                Action::make('markRead')
                    ->label('Als gelesen markieren')
                    ->icon('heroicon-o-check')
                    ->hidden(fn (ContactMessage $record) => $record->read)
                    ->action(fn (ContactMessage $record) => $record->update(['read' => true])),
            ])
            ->paginated(false);
    }
}
