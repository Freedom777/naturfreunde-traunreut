# База данных — схема

## Таблицы

### `events`
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| title | string | Название события |
| description | text nullable | Описание |
| location | string nullable | Место проведения |
| category | string | wanderung / sport / umwelt / gemeinschaft / kultur / other |
| starts_at | datetime | Начало |
| ends_at | datetime nullable | Конец |
| all_day | boolean | Весь день |
| guests_welcome | boolean | Гости приветствуются |
| published | boolean | Опубликовано |

**Accessors в модели:**
- `category_emoji` — эмодзи категории
- `category_label` — название категории на немецком
- `google_calendar_url` — ссылка для добавления в Google Calendar
- `date_color` — цвет бейджа даты по категории

---

### `states` (федеральные земли)
| Поле | Тип | Описание |
|------|-----|----------|
| code | string PK | BY, BE, HH... |
| name | string | Bayern, Berlin... |
| emoji | string(10) | 🦁, 🐻... |

**Первичный ключ:** `code` (строковый, не автоинкремент)

---

### `cities`
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| state_code | string FK → states.code | |
| name | string | Название города |
| zip_code | unsigned int nullable | Почтовый индекс |
| is_district | boolean | Является ли районом |

---

### `gallery_locations` (альбомы походов)
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| city_id | bigint FK → cities | Город похода |
| name | string | Название альбома |
| description | text nullable | |
| date | date nullable | Дата похода |
| cover_photo_id | bigint FK → gallery_photos nullable | Обложка |
| published | boolean | |

---

### `gallery_photos`
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| gallery_location_id | bigint FK → gallery_locations | |
| city_id | bigint FK → cities nullable | Определяется из GPS |
| path | string | Путь в storage |
| caption | string nullable | Подпись |
| taken_at_date | date nullable | Дата съёмки (из EXIF) |
| sort_order | unsigned int | |
| published | boolean | |

**Accessors в модели:**
- `url` — публичный URL файла
- `is_wide` — широкое ли фото (соотношение сторон ≥ 1.5), вычисляется на лету

---

### `geocode_cache`
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| bbox_min_lat | decimal(7,4) | Bounding box от Nominatim |
| bbox_max_lat | decimal(7,4) | |
| bbox_min_lng | decimal(7,4) | |
| bbox_max_lng | decimal(7,4) | |
| city_id | bigint FK → cities nullable | |
| nominatim_response | json nullable | Полный ответ API |
| created_at | timestamp | |

**Поиск по точке:**
```php
GeocodeCache::findByPoint($lat, $lng)
// WHERE bbox_min_lat <= $lat AND bbox_max_lat >= $lat
// AND bbox_min_lng <= $lng AND bbox_max_lng >= $lng
```

---

### `team_members`
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| name | string | |
| role | string | 1. Vorstand, Kassier... |
| group | string | Vorstand / Weitere Funktionen |
| bio | text nullable | Краткое описание |
| photo | string nullable | Путь в storage (WebP) |
| email | string nullable | |
| phone | string nullable | |
| phone_mobile | string nullable | |
| sort_order | unsigned int | |
| active | boolean | |

---

### `members` (юбиляры)
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| name | string | |
| year_joined | unsigned smallint | Год вступления в клуб |
| active | boolean | |

**Accessors:**
- `years` — количество лет членства (текущий год - year_joined)
- `is_jubilee` — юбилейный ли год (из config `naturfreunde.jubilee_years`)

**Scope:**
- `jubilees()` — только члены с юбилеем в текущем году

---

### `contact_messages`
| Поле | Тип | Описание |
|------|-----|----------|
| id | bigint PK | |
| name | string | |
| email | string | |
| message | text | |
| read | boolean | Прочитано в админке |

---

## Связи

```
states ──< cities ──< gallery_locations ──< gallery_photos
                  └─< gallery_photos

gallery_locations >── cover_photo_id ──> gallery_photos

geocode_cache >── city_id ──> cities
team_members (независимая)
members (независимая)
events (независимая)
contact_messages (независимая)
```
