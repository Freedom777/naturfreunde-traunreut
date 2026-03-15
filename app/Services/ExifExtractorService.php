<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class ExifExtractorService
{
    /**
     * Извлечь все нужные данные из EXIF одним вызовом
     */
    public function extract(string $fullPath): array
    {
        if (!file_exists($fullPath) || !is_readable($fullPath)) {
            return $this->empty();
        }

        $exif = @exif_read_data($fullPath, 'EXIF', false);

        if (!$exif) {
            return $this->empty();
        }

        return [
            'gps'           => $this->extractGps($exif),
            'taken_at_date' => $this->extractDate($exif),
        ];
    }

    /**
     * Извлечь GPS координаты
     * Возвращает ['lat' => float, 'lng' => float] или null
     */
    private function extractGps(array $exif): ?array
    {
        if (
            empty($exif['GPSLatitude']) ||
            empty($exif['GPSLongitude']) ||
            empty($exif['GPSLatitudeRef']) ||
            empty($exif['GPSLongitudeRef'])
        ) {
            return null;
        }

        $lat = $this->convertDmsToDecimal(
            $exif['GPSLatitude'],
            $exif['GPSLatitudeRef']
        );

        $lng = $this->convertDmsToDecimal(
            $exif['GPSLongitude'],
            $exif['GPSLongitudeRef']
        );

        if ($lat === null || $lng === null) {
            return null;
        }

        return ['lat' => $lat, 'lng' => $lng];
    }

    /**
     * Извлечь дату съёмки
     */
    private function extractDate(array $exif): ?string
    {
        $raw = $exif['DateTimeOriginal']
            ?? $exif['DateTimeDigitized']
            ?? $exif['DateTime']
            ?? null;

        if (!$raw) {
            return null;
        }

        try {
            // EXIF формат: "2024:09:15 14:23:00"
            return Carbon::createFromFormat('Y:m:d H:i:s', $raw)?->toDateString();
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Конвертировать DMS (degrees, minutes, seconds) в decimal degrees
     */
    private function convertDmsToDecimal(array $dms, string $ref): ?float
    {
        if (count($dms) < 3) {
            return null;
        }

        $degrees = $this->fractionToFloat($dms[0]);
        $minutes = $this->fractionToFloat($dms[1]);
        $seconds = $this->fractionToFloat($dms[2]);

        $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);

        if (in_array(strtoupper($ref), ['S', 'W'])) {
            $decimal *= -1;
        }

        return round($decimal, 6);
    }

    /**
     * EXIF хранит числа как дроби "num/den"
     */
    private function fractionToFloat(string $fraction): float
    {
        if (!str_contains($fraction, '/')) {
            return (float) $fraction;
        }

        [$numerator, $denominator] = explode('/', $fraction);

        if ((float) $denominator == 0) {
            return 0.0;
        }

        return (float) $numerator / (float) $denominator;
    }

    private function empty(): array
    {
        return [
            'gps'           => null,
            'taken_at_date' => null,
        ];
    }
}
