<?php

namespace App\Support;

use Illuminate\Support\Str;

class LocalImage
{
    public static function url(?string $url): string
    {
        if (empty($url)) {
            return '/images/placeholders/bobcat-placeholder.webp';
        }

        if (Str::startsWith($url, ['/images/', 'images/'])) {
            return '/' . ltrim($url, '/');
        }

        $manifest = self::manifest();

        if (! isset($manifest[$url])) {
            return $url;
        }

        $path = $manifest[$url]['fallback_path'] ?? null;

        if (! $path) {
            return $url;
        }

        return '/' . ltrim($path, '/');
    }

    public static function webp(?string $url): ?string
    {
        if (empty($url)) {
            return '/images/placeholders/bobcat-placeholder.webp';
        }

        if (Str::startsWith($url, ['/images/']) && Str::endsWith($url, '.webp')) {
            return $url;
        }

        $manifest = self::manifest();

        if (! isset($manifest[$url])) {
            return null;
        }

        $path = $manifest[$url]['webp_path'] ?? null;

        if (! $path) {
            return null;
        }

        return '/' . ltrim($path, '/');
    }

    public static function alt(?string $alt, string $fallback = 'Llantas para Bobcat'): string
    {
        return trim($alt ?: $fallback);
    }

    private static function manifest(): array
    {
        $manifestPath = resource_path('data/local-images.php');

        if (! file_exists($manifestPath)) {
            return [];
        }

        $manifest = require $manifestPath;

        return is_array($manifest) ? $manifest : [];
    }
}