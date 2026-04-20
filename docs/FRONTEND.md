# Фронтенд — компоненты и страницы

## Alpine.js — важно для Livewire 4

Livewire 4 встраивает Alpine.js и запускает его сам на страницах с Livewire-компонентами.
На страницах без Livewire запуск делает `app.js`.

**`resources/js/app.js`:**
```js
import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;

// Запускаем Alpine только если на странице нет Livewire-компонентов
document.addEventListener('DOMContentLoaded', () => {
    if (!document.querySelector('[wire\\:id]')) {
        Alpine.start();
    }
});
```

На страницах с Livewire (`/` с `<livewire:calendar-section>`) Alpine запускает Livewire.
На страницах без Livewire (`/galerie`, `/wer-macht-was` и др.) Alpine запускает `app.js`.

## Blade-компоненты (`resources/views/components/`)

### `layouts/app.blade.php`
Главный layout. Подключает:
- Google Fonts (Playfair Display, Nunito)
- Vite (Tailwind + Alpine.js)
- navbar, footer
- `@stack('scripts')` — для push-скриптов из компонентов
- Автоскролл к `#kontakt` при flash `success`

### `navbar.blade.php`
- Фиксированный navbar с `backdrop-blur`
- Alpine.js: `open` (мобильное меню), `vereinOpen` (дропдаун Verein)
- Дропдаун **Verein**: Über uns, Wer macht was?, Vereinsleben, Vereinshütte, Vereinschronik, Vereinsjubiläum
- Hamburger-анимация на мобиле
- ⚠️ **БАГ:** на странице `/wer-macht-was` hamburger пропадает при скролле (см. BUGS_AND_TODO.md)

### `footer.blade.php`
- 4 колонки: бренд + соцсети, Navigation, Verband, Rechtliches
- Адаптив: `grid-cols-2 md:grid-cols-[2fr_1fr_1fr_1fr]`
- Соцсети: Instagram (`?utm_source=site_nf`), Facebook (`?utm_source=site_nf`), Email

### `event-card.blade.php`
Props: `:event`
- Цветной бейдж даты (цвет из `$event->date_color`)
- Тег категории
- Кнопка **In Google Kalender** (ссылка из `$event->google_calendar_url`)

### `gallery-section.blade.php`
- Режим **albums**: сетка карточек альбомов с обложкой
- Режим **album**: открытый альбом с сеткой фото
- Alpine.js: `gallerySection()` — переключение режимов, `openAlbum(id)`, `closeAlbum()`
- Читает хэш URL при загрузке (`#album-{id}`) → автооткрытие альбома
- Встроенный **Lightbox**: навигация стрелками, Esc для закрытия
- `is_wide` определяется автоматически по соотношению сторон фото

### `contact-section.blade.php`
- Контактная информация (4 карточки)
- Форма с валидацией Laravel (`@error`)
- Flash-сообщение об успехе

### `calendar-section.blade.php` (устарел)
⚠️ Заменён на Livewire компонент `livewire/calendar-section.blade.php`
Оставлен в папке но не используется.

---

## Livewire-компоненты

### `CalendarSection` (`app/Livewire/CalendarSection.php`)
- Свойства: `$year`, `$month`
- Методы: `prevMonth()`, `nextMonth()`
- Polling отключён (`$pollingInterval = null`)
- Подключение в `home.blade.php`: `<livewire:calendar-section />`

---

## Страницы (`resources/views/pages/`)

| Файл | Маршрут | Тип |
|------|---------|-----|
| `home.blade.php` | `/` | Динамическая |
| `gallery.blade.php` | `/galerie` | Динамическая |
| `team.blade.php` | `/wer-macht-was` | Динамическая |
| `jubilee.blade.php` | `/vereinsjubilaeum` | Динамическая |
| `vereinsleben.blade.php` | `/vereinsleben` | Статика |
| `vereinshuette.blade.php` | `/vereinshuette` | Статика (фото — Unsplash заглушки) |
| `vereinschronik.blade.php` | `/vereinschronik` | Статика (фото из `/storage/chronic/`) |
| `impressum.blade.php` | `/impressum` | Статика |
| `datenschutz.blade.php` | `/datenschutz` | Статика |

---

## Tailwind v4 — кастомные классы

```
bg-green-deep     #1e3a0f
bg-green-mid      #2f5c1a
bg-green-accent   #4e8b2c
bg-green-light    #7ab648
bg-cream          #f4efe6
bg-cream-dark     #e8e0d0
bg-gold           #c8861a
bg-gold-light     #e8a832

font-playfair     Playfair Display, serif
font-nunito       Nunito, sans-serif
```

Глобальные CSS-классы (`app.css`):
```
.section-label    — маленький цветной заголовок секции
.section-title    — большой заголовок (с em → green-accent)
.section-lead     — подзаголовок/лид секции
.btn-primary      — золотая кнопка
.btn-outline      — прозрачная кнопка с рамкой
.gallery-grid     — сетка галереи (4 колонки → адаптив)
.gallery-item     — карточка фото с hover-эффектом
.gallery-item.wide — широкая карточка (2 колонки)
.g-overlay        — оверлей при hover на фото
.tab-btn          — кнопка-таб (active состояние)
```

---

## Статичные файлы в storage

```
storage/app/public/
├── gallery/          ← фото галереи (загружаются через Filament)
├── team/             ← фото команды (WebP, конвертируются командой)
├── chronic/          ← фото для страницы Vereinschronik
│   ├── 01-haus-bw.webp
│   ├── 02-haus-color.webp
│   ├── 03-haus-build.webp
│   ├── 04-haus-build.webp
│   ├── 05-haus-build.webp
│   ├── 06-team-all.webp
│   └── 07-team-leave.webp
└── Beitrittserklärung.pdf  ← форма вступления в клуб
```

---

## Google Calendar интеграция

Без OAuth — просто ссылки вида:
```
https://calendar.google.com/calendar/render?action=TEMPLATE
  &text=Titel+–+NaturFreunde+Traunreut
  &dates=20260308T110000/20260308T150000
  &details=Beschreibung
  &location=Ort
```

Время передаётся **без UTC-суффикса** (без `Z`) чтобы Google воспринял как локальное время.
Timezone в `.env`: `APP_TIMEZONE=Europe/Berlin`

Генерируется в `Event::getGoogleCalendarUrlAttribute()`.
