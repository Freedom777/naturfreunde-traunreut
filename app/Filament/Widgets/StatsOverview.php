<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\Member;
use App\Models\TeamMember;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Kommende Veranstaltungen', Event::published()->upcoming()->count())
                ->description('Geplante Ereignisse')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('success'),

            Stat::make('Ungelesene Nachrichten', ContactMessage::where('read', false)->count())
                ->description('Neue Kontaktanfragen')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('warning'),

            Stat::make('Fotos in der Galerie', GalleryPhoto::where('published', true)->count())
                ->description('Veröffentlichte Fotos')
                ->descriptionIcon('heroicon-o-photo')
                ->color('info'),

            Stat::make('Teammitglieder', TeamMember::where('active', true)->count())
                ->description('Aktive Mitglieder')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

            Stat::make('Jubilare ' . date('Y'), Member::active()->jubilees()->count())
                ->description('Jubiläen dieses Jahr')
                ->descriptionIcon('heroicon-o-trophy')
                ->color('warning'),
        ];
    }
}
