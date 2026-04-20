<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingEventsWidget extends BaseWidget
{
    protected ?string $pollingInterval = null;

    protected static ?int $sort = 2;
    protected static ?string $heading = 'Kommende Veranstaltungen';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::published()->upcoming()->limit(5)
            )
            ->columns([
                TextColumn::make('starts_at')
                    ->label('Datum')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Titel')
                    ->limit(40),

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
                    ->formatStateUsing(fn (Event $record) => $record->category_emoji . ' ' . $record->category_label),

                TextColumn::make('location')
                    ->label('Ort')
                    ->limit(30)
                    ->placeholder('—'),
            ])
            ->paginated(false);
    }
}
