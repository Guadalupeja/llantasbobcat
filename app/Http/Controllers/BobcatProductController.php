<?php

namespace App\Http\Controllers;

use App\Services\RuguexPriceService;
use Illuminate\Support\Collection;

class BobcatProductController extends Controller
{
    public function index()
    {
        $products = $this->bobcatProducts();
        $storeProducts = $this->storeProducts();

        $products = $products->map(function ($product) use ($storeProducts) {
            $product['compatible_count'] = $storeProducts
                ->whereIn('id', $product['compatible_store_product_ids'] ?? [])
                ->count();

            return $product;
        });

        $models = $products->pluck('model')->filter()->unique()->values();
        $sizes = $products->flatMap(fn ($product) => $product['sizes'] ?? [])->filter()->unique()->values();

        $featuredStoreProducts = $storeProducts
            ->filter(fn ($item) => ! empty($item['image']) && ! empty($item['price']))
            ->take(8)
            ->values();

        return view('pages.home', compact('products', 'models', 'sizes', 'featuredStoreProducts'));
    }

public function type(string $type)
{
    abort_unless(in_array($type, ['neumatica', 'solida']), 404);

    $label = $type === 'neumatica' ? 'Neumática' : 'Sólida';

    $products = $this->bobcatProducts()
        ->filter(function ($product) use ($type) {
            $types = collect($product['tire_types'] ?? [])
                ->map(fn ($value) => str($value)->lower()->ascii()->toString());

            return $types->contains(fn ($value) => str_contains($value, $type));
        })
        ->values();

    return view('pages.tire-type', compact('products', 'type', 'label'));
}
public function tireType(string $type)
{
    return $this->type($type);
}

    public function show(string $slug)
    {
        $product = $this->bobcatProducts()->firstWhere('slug', $slug);

        abort_if(! $product, 404);

        $storeProducts = $this->storeProducts();

        $compatibleItems = $storeProducts
            ->whereIn('id', $product['compatible_store_product_ids'] ?? [])
            ->values();

        $featuredStoreProducts = $storeProducts
            ->filter(fn ($item) => ! empty($item['image']) && ! empty($item['price']))
            ->take(6)
            ->values();

        $relatedProducts = $this->bobcatProducts()
            ->filter(function ($item) use ($product) {
                if ($item['id'] === $product['id']) {
                    return false;
                }

                return count(array_intersect($item['sizes'] ?? [], $product['sizes'] ?? [])) > 0;
            })
            ->take(4)
            ->values();

        return view('pages.product-show', compact('product', 'compatibleItems', 'featuredStoreProducts', 'relatedProducts'));
    }

    private function bobcatProducts(): Collection
    {
        return collect(require resource_path('data/bobcat-products.php'))
            ->map(function (array $product) {
                $product['excerpt'] = $this->cleanProductText($product['excerpt'] ?? '');
                $product['description'] = $this->cleanProductText($product['description'] ?? $product['excerpt'] ?? '');

                return $product;
            });
    }

    private function storeProducts(): Collection
    {
        $storeProducts = collect(require resource_path('data/store-products.php'));

        return app(RuguexPriceService::class)->applyTo($storeProducts);
    }

    private function cleanProductText(?string $text): string
    {
        $text = (string) $text;

        $text = str_replace(['\r\n', '\r', '\n'], "
", $text);
        $text = preg_replace('/\[elementor-template[^\]]*\]/i', '', $text);
        $text = preg_replace('/\[[a-zA-Z0-9_\-]+[^\]]*\]/', '', $text);
        $text = preg_replace('/[ 	]+/', ' ', $text);
        $text = preg_replace("/
{3,}/", "

", $text);

        return trim($text);
    }
}
