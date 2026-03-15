<?php

namespace App\Services;

use App\Models\City;
use App\Models\GeocodeCache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocoderService
{
    private const NOMINATIM_URL = 'https://nominatim.openstreetmap.org/reverse';
    private const USER_AGENT    = 'NaturFreunde-Traunreut/1.0 (info@naturfreunde-traunreut.de)';

    /**
     * Основной метод — вернуть city_id по координатам
     * Сначала ищем в кэше, потом идём в Nominatim
     */
    public function getCityId(float $lat, float $lng): ?int
    {
        // 1. Проверяем кэш
        $cached = GeocodeCache::findByPoint($lat, $lng);

        if ($cached) {
            return $cached->city_id;
        }

        // 2. Запрос к Nominatim
        $response = $this->callNominatim($lat, $lng);

        if (!$response) {
            return null;
        }

        // 3. Найти город в нашей таблице
        $cityId = $this->matchCity($response);

        // 4. Сохранить в кэш
        $this->saveToCache($response, $cityId);

        return $cityId;
    }

    /**
     * Запрос к Nominatim Reverse Geocoding API
     */
    private function callNominatim(float $lat, float $lng): ?array
    {
        try {
            $response = Http::withHeaders(['User-Agent' => self::USER_AGENT])
                ->timeout(5)
                ->get(self::NOMINATIM_URL, [
                    'lat'            => $lat,
                    'lon'            => $lng,
                    'format'         => 'json',
                    'addressdetails' => 1,
                ]);

            if (!$response->successful()) {
                Log::warning('Nominatim request failed', [
                    'status' => $response->status(),
                    'lat'    => $lat,
                    'lng'    => $lng,
                ]);
                return null;
            }

            return $response->json();

        } catch (\Throwable $e) {
            Log::error('Nominatim exception', [
                'message' => $e->getMessage(),
                'lat'     => $lat,
                'lng'     => $lng,
            ]);
            return null;
        }
    }

    /**
     * Попытаться найти город в нашей таблице по ответу Nominatim
     */
    private function matchCity(array $response): ?int
    {
        $address = $response['address'] ?? [];

        // Nominatim возвращает город в разных полях в зависимости от типа
        $cityName = $address['city']
            ?? $address['town']
            ?? $address['village']
            ?? $address['municipality']
            ?? null;

        $postcode = isset($address['postcode'])
            ? (int) $address['postcode']
            : null;

        if (!$cityName) {
            return null;
        }

        // Сначала ищем по почтовому индексу — самое точное совпадение
        if ($postcode) {
            $city = City::where('zip_code', $postcode)->first();
            if ($city) {
                return $city->id;
            }
        }

        // Потом по названию
        $city = City::where('name', $cityName)->first();

        return $city?->id;
    }

    /**
     * Сохранить результат в кэш
     */
    private function saveToCache(array $response, ?int $cityId): void
    {
        $bbox = $response['boundingbox'] ?? null;

        if (!$bbox || count($bbox) < 4) {
            return;
        }

        try {
            GeocodeCache::create([
                'bbox_min_lat'       => (float) $bbox[0],
                'bbox_max_lat'       => (float) $bbox[1],
                'bbox_min_lng'       => (float) $bbox[2],
                'bbox_max_lng'       => (float) $bbox[3],
                'city_id'            => $cityId,
                'nominatim_response' => $response,
            ]);
        } catch (\Throwable $e) {
            // Не критично если кэш не сохранился
            Log::warning('GeocodeCache save failed', ['message' => $e->getMessage()]);
        }
    }
}
