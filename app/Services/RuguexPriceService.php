<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RuguexPriceService
{
    public function applyTo(Collection $storeProducts): Collection
    {
        $ids = $storeProducts
            ->pluck('id')
            ->filter()
            ->unique()
            ->values()
            ->all();

        $prices = $this->getPricesForIds($ids);

        return $storeProducts->map(function (array $item) use ($prices) {
            $livePrice = $prices->get((int) $item['id']);

            $item['live_price'] = $livePrice;

            /**
             * Este es el precio real que se imprimirá en Blade.
             * No ponemos fallback tipo "Ver precio en tienda".
             */
            $item['price_label'] = $livePrice['price_mxn_with_iva_formatted'] ?? null;

            /**
             * Si el endpoint trae datos actualizados, usamos esos.
             */
            $item['url'] = $livePrice['permalink'] ?? ($item['url'] ?? '#');
            $item['image'] = $livePrice['image'] ?? ($item['image'] ?? null);

            $item['is_in_stock'] = $livePrice['is_in_stock'] ?? true;
            $item['stock_status'] = $livePrice['stock_status'] ?? null;

            return $item;
        });
    }

    public function getPricesForIds(array $ids): Collection
    {
        $endpoint = config('services.ruguex_prices.endpoint');

        if (! $endpoint || empty($ids)) {
            return collect();
        }

        $ids = collect($ids)
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->sort()
            ->values()
            ->all();

        $cacheMinutes = config('services.ruguex_prices.cache_minutes', 15);

        /**
         * v2 para evitar leer una caché vieja o dañada.
         */
        $cacheKey = 'ruguex_prices_v2_' . md5(implode(',', $ids));

        $cachedProducts = Cache::remember(
            $cacheKey,
            now()->addMinutes($cacheMinutes),
            function () use ($endpoint, $ids) {
                $prices = collect();

                foreach (array_chunk($ids, 30) as $chunk) {
                    try {
                        $response = Http::timeout(10)->get($endpoint, [
                            'ids' => implode(',', $chunk),
                        ]);

                        if (! $response->successful()) {
                            continue;
                        }

                        $data = $response->json();

                        $products = collect($data['products'] ?? []);

                        $prices = $prices->merge($products);
                    } catch (\Throwable $exception) {
                        report($exception);

                        continue;
                    }
                }

                /**
                 * Guardamos arrays simples en caché, no Collections.
                 */
                return $prices
                    ->filter(fn ($item) => is_array($item) && isset($item['id']))
                    ->values()
                    ->all();
            }
        );

        if (! is_array($cachedProducts)) {
            return collect();
        }

        return collect($cachedProducts)
            ->filter(fn ($item) => is_array($item) && isset($item['id']))
            ->keyBy(fn ($item) => (int) $item['id']);
    }
}