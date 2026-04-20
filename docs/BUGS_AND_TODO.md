# Known Bugs & TODO

## ✅ Завершённые апгрейды

### Апгрейд Laravel 12 → 13 + Filament 3 → 5 + Livewire 3 → 4
- Стек: Laravel 13, Filament 5, Livewire 4, PHP 8.4 (local) / 8.5 (production)
- Изменения: `composer.json`, типы Filament, namespace импортов, Alpine.js запуск, `config/cache.php`
- См. `ADMIN_AND_SERVICES.md` — раздел «Типизация в Filament 5»

---

## 🐛 Известные баги

### 1. Hamburger-меню пропадает на мобильном при скролле (team.blade.php)
**Страница:** `/wer-macht-was`
**Симптом:** При скролле вниз гамбургер-кнопка в navbar перестаёт быть видна/кликабельна.
**Предположение:** Карточки команды создают новый stacking context через `transform` или `overflow-hidden`,
перекрывая navbar несмотря на `z-50`.
**Попытки исправить:** Увеличение `z-index` до `z-[100]` сломало работу navbar полностью.
**Статус:** ❌ Не исправлено, требует исследования.

**Что попробовать:**
- Убрать `overflow-hidden` с секции `.bg-cream` на странице team
- Проверить есть ли `transform` на родительских элементах
- Добавить `isolation: isolate` на секцию с карточками
- Проверить в DevTools → Elements → computed styles на navbar при скролле

---

## 📋 TODO / Планы

### Галерея
- [ ] Thumbnail генерация при загрузке фото (сейчас отдаётся оригинал)
      → Рассмотреть `spatie/laravel-medialibrary` или кастомный job
- [ ] Пагинация в галерее при большом количестве фото
- [ ] Lazy loading изображений (частично есть `loading="lazy"`)

### Геокодирование фото
- [ ] `GeocoderService` + `ExifExtractorService` подключены, но не протестированы в продакшене
- [ ] При загрузке фото в Filament — автозаполнение `city_id` и `taken_at_date` из EXIF
      (реализовано в `GalleryPhotoResource`, требует тестирования с реальными фото с GPS)

### Контактная форма
- [ ] Email-уведомление администратору при новом сообщении
      (строка закомментирована в `ContactController::store()`)
      → Нужно настроить SMTP в `.env` и создать `Mailable`

### Navbar
- [ ] Проверить hamburger-баг на `/wer-macht-was` после апгрейда на Livewire 4

### Администрирование
- [ ] Livewire calendar (`CalendarSection`) — кнопки prevMonth/nextMonth работают,
      но нет визуальной индикации загрузки при переключении

### Страницы-заглушки
- [ ] `/vereinsleben` — статика, может понадобиться редактируемый контент
- [ ] `/vereinshuette` — статика, фото с оригинального сайта не загружены
      (используются Unsplash-заглушки)

### SEO
- [ ] Meta-теги title/description для каждой страницы
- [ ] `<meta name="google" content="notranslate">` — добавлен в layout,
      но стоит проверить работу в Chrome

### Производительность
- [ ] `N+1` запросы в галерее при загрузке `city.state` для каждой локации
      → Добавить `with(['city.state'])` везде где нужно
- [ ] Кэширование запросов для статичных данных (states, cities)
