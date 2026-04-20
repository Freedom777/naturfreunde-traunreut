# Admin-Panel & Сервисы

## Filament Admin (`/admin`)

> Текущая версия: **Filament 5** (Livewire 4 inside)

### Ресурсы

| Ресурс | Модель | Иконка | Sort |
|--------|--------|--------|------|
| EventResource | Event | calendar-days | 1 |
| GalleryLocationResource | GalleryLocation | map-pin | 2 |
| GalleryPhotoResource | GalleryPhoto | photo | 3 |
| GalleryLocationResource (Orte) | GalleryLocation | map-pin | 3 |
| TeamMemberResource | TeamMember | users | 4 |
| MemberResource | Member | trophy | 6 |
| ContactMessageResource | ContactMessage | envelope | 5 |

### ContactMessageResource
- Badge в навигации: количество непрочитанных сообщений (оранжевый)
- При открытии сообщения → автоматически помечается как прочитанное
- Создание через форму на сайте (canCreate = false)
- Фильтр: прочитано / не прочитано

### GalleryPhotoResource — логика формы
При загрузке фото (`FileUpload` с `->live()`):
1. Читает EXIF через `ExifExtractorService`
2. Если есть GPS → `GeocoderService::getCityId()` → заполняет `city_id` и `state_code`
3. Если есть `DateTimeOriginal` → заполняет `taken_at_date`
4. Если GPS не найден → показывает поля выбора штата/города (необязательные)
5. Штат по умолчанию: `UN` (Unbekannt)

### GalleryLocationResource — логика формы
- Штат по умолчанию: `BY` (Bayern)
- При выборе штата → загружается список городов
- При выборе `UN` → показывается текстовое поле для нового города
- Новый город создаётся в таблице `cities` автоматически
- `cover_photo_id` — показывается только при редактировании (не при создании)

### Dashboard Widgets
Все виджеты с `$pollingInterval = null` (polling отключён).

**StatsOverview:**
- Kommende Veranstaltungen
- Ungelesene Nachrichten
- Fotos in der Galerie
- Teammitglieder
- Jubilare (текущего года)

**UpcomingEventsWidget:** ближайшие 5 событий (таблица)

**LatestMessagesWidget:** последние 5 сообщений + кнопка "Als gelesen markieren"

### Типизация в Filament 5

В Filament 5 изменились типы свойств и namespace импортов. Требует учитывать при создании новых ресурсов:

```php
// Тип $navigationIcon и $navigationGroup
protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-...';
protected static string|\UnitEnum|null $navigationGroup = 'Gruppe';

// Метод form() использует Schema вместо Form
use Filament\Schemas\Schema;
public static function form(Schema $form): Schema { ... }

// Get/Set переехали
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

// Actions вынесены из Tables\Actions в корневой Actions
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

// $pollingInterval в виджетах больше не static
protected ?string $pollingInterval = null;
```

### FileUpload — диск и видимость

В Filament 5 дефолтный диск берётся из `FILESYSTEM_DISK` (раньше был `FILAMENT_FILESYSTEM_DISK`).
Обязательно указывать `->disk('public')->visibility('public')` для всех файловых полей:

```php
FileUpload::make('path')
    ->disk('public')
    ->visibility('public')
    ->directory('gallery')

ImageColumn::make('path')
    ->disk('public')
```

Также добавить в `.env`:
```
FILESYSTEM_DISK=public
```

---

## Сервисы

### ExifExtractorService
```php
app(ExifExtractorService::class)->extract($fullPath)
// Возвращает: ['gps' => ['lat' => float, 'lng' => float] | null, 'taken_at_date' => string | null]
```
- Читает `GPSLatitude`, `GPSLongitude`, `GPSLatitudeRef`, `GPSLongitudeRef`
- Конвертирует DMS → decimal degrees
- Читает `DateTimeOriginal` / `DateTimeDigitized` / `DateTime`
- Формат EXIF даты: `Y:m:d H:i:s`

### GeocoderService
```php
app(GeocoderService::class)->getCityId($lat, $lng)
// Возвращает: int|null (city_id)
```
Алгоритм:
1. Поиск в `geocode_cache` по bounding box (`findByPoint`)
2. Если не найдено → запрос к Nominatim API
3. Сопоставление по `zip_code` (приоритет) или `name`
4. Сохранение в `geocode_cache` с bbox от Nominatim
5. Возврат `city_id`

**User-Agent для Nominatim:** `NaturFreunde-Traunreut/1.0 (info@naturfreunde-traunreut.de)`

Регистрация в `AppServiceProvider`:
```php
$this->app->singleton(ExifExtractorService::class);
$this->app->singleton(GeocoderService::class);
```

---

## Artisan-команды

### `team:import-photos`
```bash
php artisan team:import-photos
php artisan team:import-photos --path=team/imports
```
- Читает файлы из `storage/app/local/team/imports/`
- Конвертирует в WebP (800px max width, quality 85)
- Сохраняет в `storage/app/public/team/`
- Сопоставляет по имени файла (kebab-case → поиск в БД)
- Использует Intervention Image v4: `ImageManager::usingDriver(Driver::class)`

---

## Создание пользователя (продакшен)

```bash
php artisan tinker
```
```php
App\Models\User::create([
    'name'              => 'Admin',
    'email'             => 'admin@naturfreunde-traunreut.de',
    'password'          => bcrypt('your-password'),
    'email_verified_at' => now(),
]);
```

Модель `User` реализует `FilamentUser` интерфейс с `canAccessPanel(): bool { return true; }`.

---

## Юбиляры — конфигурация

`.env`:
```
JUBILEE_YEARS=10,25,30,40,50,75
```

`config/naturfreunde.php`:
```php
'jubilee_years' => array_map('intval', explode(',', env('JUBILEE_YEARS', '10,25,30,40,50,75')))
```

Страница автоматически обновляется каждый год — `year_joined` хранится,
количество лет вычисляется как `date('Y') - year_joined`.
