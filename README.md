# NaturFreunde Traunreut — Laravel Website

## Stack
- **Laravel 12** + PHP 8.3+
- **Filament 3** — Admin-Panel
- **Tailwind CSS 4** — Styling
- **Alpine.js 3** — Galerie-Tabs, Lightbox
- **MySQL 8**

---

## Installation

```bash
# 1. Neues Laravel-Projekt erstellen
composer create-project laravel/laravel naturfreunde-traunreut
cd naturfreunde-traunreut

# 2. Filament installieren
composer require filament/filament:"^3.0"
php artisan filament:install --panels

# 3. Alpine.js (via CDN oder npm)
npm install alpinejs
# oder im layout.blade.php:
# <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

# 4. Dateien aus diesem Paket einkopieren
# Alle Dateien aus den jeweiligen Unterordnern in das Projekt kopieren.

# 5. .env konfigurieren
cp .env.example .env
php artisan key:generate
# DB_DATABASE, DB_USERNAME, DB_PASSWORD setzen

# 6. Migrationen + Seed
php artisan migrate --seed

# 7. Storage-Link für Fotos
php artisan storage:link

# 8. Filament Admin-User anlegen
php artisan make:filament-user

# 9. Assets builden
npm install && npm run build

# 10. Dev-Server starten
php artisan serve
```

---

## Projektstruktur

```
app/
├── Http/Controllers/
│   ├── HomeController.php       ← Startseite (Events + Galerie + Kalender)
│   ├── GalleryController.php    ← Vollständige Galerie-Seite
│   └── ContactController.php    ← Kontaktformular POST
│
├── Models/
│   ├── Event.php                ← google_calendar_url accessor
│   ├── GalleryLocation.php      ← Ort (Kampenwand, Seeon, …)
│   ├── GalleryPhoto.php         ← Foto mit FK auf GalleryLocation
│   └── ContactMessage.php       ← Eingehende Nachrichten
│
└── Filament/Resources/
    ├── EventResource.php        ← CRUD Veranstaltungen
    └── GalleryPhotoResource.php ← Upload + Verwaltung Fotos

database/migrations/
├── create_events_table.php
├── create_gallery_locations_table.php
├── create_gallery_photos_table.php
└── create_contact_messages_table.php

resources/views/
├── layouts/app.blade.php        ← Haupt-Layout
├── components/
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   ├── event-card.blade.php     ← Mit Google Calendar Button
│   ├── gallery-section.blade.php ← Tabs + Lightbox (Alpine.js)
│   ├── calendar-section.blade.php ← Monatskalender + Sidebar
│   ├── contact-section.blade.php  ← Formular + Validierung
│   └── lightbox.blade.php
└── pages/
    └── home.blade.php
```

---

## Google Calendar Integration

Keine OAuth-Authentifizierung nötig. Das `Event`-Model generiert automatisch
eine URL nach dem Schema:

```
https://calendar.google.com/calendar/render?action=TEMPLATE
  &text=Titel+–+NaturFreunde+Traunreut
  &dates=20260308T100000Z/20260308T140000Z
  &details=Beschreibung
  &location=Ort
```

Ein Klick öffnet Google Kalender im Browser — der Nutzer muss nur bestätigen.
Kein API-Key, kein OAuth erforderlich.

---

## Admin-Panel (Filament)

Erreichbar unter: `/admin`

| Ressource          | Funktion                                     |
|--------------------|----------------------------------------------|
| Veranstaltungen    | CRUD mit Datum, Kategorie, Ort               |
| Galerie-Fotos      | Upload + Lokation + Featured-Flag + Sortierung |
| Kontaktnachrichten | Eingehende Formularnachrichten lesen         |

---

## Erweiterungsideen

- **Spatie MediaLibrary** für automatische Thumbnail-Generierung
- **Livewire-Kalender** mit Monatswechsel ohne Seitenreload
- **ICS-Export** (`.ics`-Datei) als Alternative zu Google Calendar
- **Spatie Translatable** falls DE/EN Zweisprachigkeit gewünscht
