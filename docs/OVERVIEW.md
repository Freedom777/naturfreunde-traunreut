# NaturFreunde Traunreut — Projektübersicht

## Stack

- **Laravel 13** + PHP 8.3+ (production: PHP 8.5)
- **Filament 5** — Admin-Panel (`/admin`)
- **Tailwind CSS v4** — Styling (кастомные цвета через `@theme` в `app.css`)
- **Alpine.js 3** — интерактивность (галерея, navbar, lightbox)
- **Livewire 4** — календарь (`CalendarSection`)
- **Intervention Image v4** (`intervention/image-laravel`) — конвертация фото в WebP
- **MySQL 8**

## Структура проекта

```
app/
├── Console/Commands/
│   └── ImportTeamPhotos.php        ← импорт фото команды с конвертацией в WebP
├── Http/Controllers/
│   ├── HomeController.php          ← главная страница
│   ├── GalleryController.php       ← страница галереи
│   ├── ContactController.php       ← обработка контактной формы
│   ├── TeamController.php          ← страница "Wer macht was?"
│   └── JubileeController.php       ← страница юбиляров
├── Livewire/
│   └── CalendarSection.php         ← интерактивный календарь с переключением месяцев
├── Models/
│   ├── Event.php                   ← события (accessor: google_calendar_url)
│   ├── GalleryLocation.php         ← альбомы походов
│   ├── GalleryPhoto.php            ← фото (accessor: is_wide, url)
│   ├── GeocodeCache.php            ← кэш геокодирования
│   ├── State.php                   ← федеральные земли Германии
│   ├── City.php                    ← города Германии
│   ├── TeamMember.php              ← члены команды
│   ├── Member.php                  ← члены клуба (юбиляры)
│   └── ContactMessage.php          ← сообщения с контактной формы
├── Services/
│   ├── ExifExtractorService.php    ← извлечение GPS и даты из EXIF
│   └── GeocoderService.php         ← Nominatim reverse geocoding + кэш
└── Filament/
    ├── Resources/
    │   ├── EventResource.php
    │   ├── GalleryLocationResource.php
    │   ├── GalleryPhotoResource.php
    │   ├── GalleryLocationResource.php  ← орте (локации)
    │   ├── TeamMemberResource.php
    │   ├── MemberResource.php
    │   └── ContactMessageResource.php
    └── Widgets/
        ├── StatsOverview.php
        ├── UpcomingEventsWidget.php
        └── LatestMessagesWidget.php
```

## Маршруты (routes/web.php)

```
GET  /                    → HomeController@index
GET  /galerie             → GalleryController@index
POST /kontakt             → ContactController@store
GET  /wer-macht-was       → TeamController@index
GET  /vereinsjubilaeum    → JubileeController@index
GET  /vereinsleben        → view pages.vereinsleben (статика)
GET  /vereinshuette       → view pages.vereinshuette (статика)
GET  /vereinschronik      → view pages.vereinschronik (статика)
GET  /impressum           → view pages.impressum (статика)
GET  /datenschutz         → view pages.datenschutz (статика)
```

## Конфигурация

### Tailwind v4 (resources/css/app.css)
```css
@import "tailwindcss";
@theme {
  --color-green-deep: #1e3a0f;
  --color-green-mid: #2f5c1a;
  --color-green-accent: #4e8b2c;
  --color-gold: #c8861a;
  --color-gold-light: #e8a832;
  --color-cream: #f4efe6;
  --color-cream-dark: #e8e0d0;
  --font-playfair: "Playfair Display", serif;
  --font-nunito: "Nunito", sans-serif;
}
```

### config/naturfreunde.php
```php
'jubilee_years' => [10, 25, 30, 40, 50, 75]  // из .env JUBILEE_YEARS
```

## Сборка

```bash
npm install
npm run build       # продакшен
npm run dev         # разработка с hot reload
```

После обновления зависимостей (напр. апгрейд Filament):

```bash
php artisan filament:upgrade
php artisan optimize:clear
npm run build
```

## Миграции и сидеры

```bash
php artisan migrate
php artisan db:seed   # запускает StateSeeder, CitySeeder, TeamMemberSeeder, MemberSeeder
```

CSV-файлы сидеров: `database/seeders/data/`
- `team_members.csv`
- `members.csv`
- `states.csv` (создан вручную)
- `cities.csv` (19 568 городов Германии)
