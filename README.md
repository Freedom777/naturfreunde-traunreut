# NaturFreunde Traunreut — Laravel Website

Website der Ortsgruppe Traunreut e.V. — modernes Redesign von naturfreunde-traunreut.de.

---

## Stack

| Компонент | Версия |
|---|---|
| Laravel | 13 |
| PHP | 8.3+ (Production: 8.5) |
| Filament | 5 (Admin-Panel) |
| Livewire | 4 |
| Tailwind CSS | 4 |
| Alpine.js | 3 |
| Intervention Image | 4 (WebP-Konvertierung) |
| MySQL | 8 |

---

## Lokale Entwicklung (Laragon / Windows)

```bash
# 1. .env konfigurieren
cp .env.example .env
php artisan key:generate
# DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL setzen

# 2. Abhängigkeiten installieren
composer install
npm install

# 3. Migrationen + Seed
php artisan migrate --seed

# 4. Storage-Link
php artisan storage:link

# 5. Filament Admin-User anlegen
php artisan tinker
# >>> App\Models\User::create([...])

# 6. Assets bauen
npm run build
# oder für Entwicklung:
npm run dev
```

### Wichtige .env-Werte

```
APP_URL=http://nf.test
APP_TIMEZONE=Europe/Berlin
FILESYSTEM_DISK=public
JUBILEE_YEARS=10,25,30,40,50,75
```

---

## Admin-Panel

Erreichbar unter: `/admin`

| Ressource | Funktion |
|---|---|
| Veranstaltungen | CRUD mit Datum, Kategorie, Ort |
| Wanderungen | Albumverwaltung (GalleryLocation) |
| Fotos | Upload mit EXIF-Extraktion + GPS-Geocoding |
| Team | Mitglieder mit Foto-Upload (WebP) |
| Jubilare | Mitglieder-Jubiläen nach Eintrittsjahr |
| Nachrichten | Eingehende Kontaktformular-Nachrichten |

---

## Projektstruktur

```
app/
├── Console/Commands/
│   └── ImportTeamPhotos.php     ← php artisan team:import-photos
├── Http/Controllers/
│   ├── HomeController.php
│   ├── GalleryController.php
│   ├── ContactController.php
│   ├── TeamController.php
│   └── JubileeController.php
├── Livewire/
│   └── CalendarSection.php      ← interaktiver Monatskalender
├── Models/
│   ├── Event.php
│   ├── GalleryLocation.php
│   ├── GalleryPhoto.php
│   ├── State.php / City.php      ← Bundesländer + Städte DE
│   ├── GeocodeCache.php         ← Nominatim-Cache
│   ├── TeamMember.php
│   ├── Member.php               ← Jubilare
│   └── ContactMessage.php
├── Services/
│   ├── ExifExtractorService.php  ← GPS + Datum aus EXIF
│   └── GeocoderService.php       ← Nominatim Reverse Geocoding
└── Filament/
    ├── Resources/               ← 6 Ressourcen
    └── Widgets/                 ← StatsOverview, UpcomingEvents, LatestMessages

resources/
├── css/app.css               ← Tailwind v4 @theme
├── js/app.js                 ← Alpine.js (startet nur ohne Livewire)
└── views/
    ├── components/layouts/      ← Haupt-Layout
    ├── components/              ← navbar, footer, event-card, gallery-section, contact-section
    ├── livewire/                ← calendar-section.blade.php
    └── pages/                   ← home, gallery, team, jubilee + 5 Statik-Seiten

docs/
├── OVERVIEW.md              ← Stack, Struktur, Konfiguration
├── DATABASE.md              ← Tabellen-Schema
├── FRONTEND.md              ← Blade-Komponenten, Alpine.js
├── ADMIN_AND_SERVICES.md    ← Filament, Services, Artisan-Befehle
└── BUGS_AND_TODO.md         ← Bekannte Bugs + TODO-Liste
```

---

## Google Calendar Integration

Kein API-Key, kein OAuth. Das `Event`-Model generiert eine direkte URL:

```
https://calendar.google.com/calendar/render?action=TEMPLATE
  &text=Titel
  &dates=20260308T110000/20260308T150000
  &details=Beschreibung
  &location=Ort
```

Zeit ohne `Z`-Suffix — Google interpretiert es als Lokalzeit (`APP_TIMEZONE=Europe/Berlin`).

---

## Erweiterungsideen

- **Spatie MediaLibrary** — automatische Thumbnail-Generierung beim Upload
- **ICS-Export** — `.ics`-Datei als Alternative zu Google Calendar
- **E-Mail-Benachrichtigung** — bei neuen Kontaktformular-Nachrichten (SMTP konfigurieren)
- **Spatie Translatable** — falls DE/EN Zweisprachigkeit gewünscht
