<?php

use App\Http\Controllers\BobcatProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirecciones SEO desde WordPress antiguo
|--------------------------------------------------------------------------
| 301 = URL antigua útil que debe conservar autoridad SEO.
| 410 = URL basura/demo/spam que no debe migrarse.
*/

/**
 * URLs antiguas de modelos Bobcat tipo blog/landing.
 * Se redirigen a la ficha nueva en Laravel.
 */
$legacyModelRedirects = [
    'minicargador-bobcat-s770' => 'producto/llanta-para-minicargador-s770-bobcat',
    'minicargador-bobcat-s630' => 'producto/llanta-para-minicargador-s630-bobcat',
    'minicargador-bobcat-s590' => 'producto/llanta-para-minicargador-s590-bobcat',
    'minicargador-bobcat-s550' => 'producto/llanta-para-minicargador-de-direccion-deslizante-s550-bobcat',
    'minicargador-bobcat-s530' => 'producto/llanta-para-cargador-de-direccion-deslizante-s530-bobcat',
    'minicargador-bobcat-s510' => 'producto/llanta-para-cargador-de-direccion-deslizante-s510-bobcat',
    'minicargador-bobcat-t2-s450' => 'producto/llanta-para-cargador-de-direccion-deslizante-t2-s450-bobcat',
    'minicargador-bobcat-it4-s450' => 'producto/llanta-para-cargador-de-direccion-deslizante-it4-s450-bobcat',
    'minicargador-bobcat-s100' => 'producto/llanta-para-cargador-de-direccion-deslizante-s100-bobcat',
    'minicargador-bobcat-earthforce-s18' => 'producto/minicargador-bobcat-earthforce-s18',
    'minicargador-bobcat-earthforce-s16' => 'producto/llanta-para-minicargador-bobcat-earthforce-s16',
    'minicargador-bobcat-s650' => 'producto/minicargador-bobcat-s650',
];

foreach ($legacyModelRedirects as $old => $new) {
    Route::redirect('/' . $old, '/' . $new, 301);
    Route::redirect('/' . $old . '/', '/' . $new, 301);
}

/**
 * URLs de tienda antigua WooCommerce.
 * El nuevo sitio Laravel manda la compra a la tienda Ruguex.
 */
$storeUrl = 'https://llantasdemontacargas.com/tienda-en-linea/?swoof=1&product_cat=llantas-minicargadores';

Route::redirect('/tienda', $storeUrl, 301);
Route::redirect('/tienda/', $storeUrl, 301);
Route::redirect('/shop', $storeUrl, 301);
Route::redirect('/shop/', $storeUrl, 301);

/**
 * Contacto antiguo.
 */
Route::redirect('/contact', '/#contacto', 301);
Route::redirect('/contact/', '/#contacto', 301);
Route::redirect('/contact-us', '/#contacto', 301);
Route::redirect('/contact-us/', '/#contacto', 301);

/**
 * Páginas corporativas antiguas.
 * Por ahora van al home porque el nuevo sitio ya concentra la información comercial.
 */
Route::redirect('/about', '/', 301);
Route::redirect('/about/', '/', 301);
Route::redirect('/about-us', '/', 301);
Route::redirect('/about-us/', '/', 301);
Route::redirect('/services', '/', 301);
Route::redirect('/services/', '/', 301);

/**
 * Páginas que no se deben migrar.
 * Incluye spam/hack, demos de tema, WooCommerce viejo, cuenta, carrito, wishlist, dashboard, etc.
 */
$goneUrls = [
    // Spam / hack
    'luchshie-kent-kazino-onlajn-dlya-igri-i-viigrishej',
    'putevoditel-po-kentu-luchshie-dostoprimechatelnosti-i-soveti-dlya-turistov',
    'discover-torzon-darknet-url-and-how-to-access-the-deep-web-safely',
    'download-coreldraw-full-crack',
    'kent-casino-ofitsialnij-sajt-obzor-i-vozmozhnosti',

    // WooCommerce viejo / cuenta / carrito
    'wishlist',
    'carrito',
    'finalizar-compra',
    'mi-cuenta',
    'checkout',
    'my-account',
    'my-wishlist',
    'shopping-cart',
    'track-my-order',
    'my-orders',

    // Tema / demo / layouts
    'sample-page',
    'home-1',
    'home-2',
    'home-3',
    'home-4',
    'demo',
    'test-flash-sale-page',
    'account-migration',
    'dashboard',
    'dashboard/import',
    'store-listing',

    // Tbay header/footer/megamenu
    'tbay_megamenu/electronics-devices-canvas',
    'tbay_megamenu/home-page',
    'tbay_megamenu/electronic-accessories',
    'tbay_megamenu/blog',
    'tbay_megamenu/page',
    'tbay_megamenu/electronics-devices',
    'tbay_megamenu/home-kitchen',
    'tbay_megamenu/shop',
    'tbay_footer/footer-01',
    'tbay_footer/footer-02',
    'tbay_footer/footer-03',
    'tbay_header/header-01',
    'tbay_header/header-02',
    'tbay_header/header-03',
    'tbay_header/header-04',

    // Posts demo
    'sail-your-colours-to-the-mast-2',
    'a-beginners-guide-to-fashion',
    'mindblowing-facts-about-furniture',
    '5-advices-no-one-will-give-you',
    'how-to-get-more-likes-on-facebook',
    '7-tips-to-delight-your-audience',
    'the-best-careers-for-introverts',
    'avoid-this-rookie-marketing-habit',
    'is-android-better-than-ios-5-reasons',
    'go-from-zero-to-hero-in-no-time',
    'stop-making-these-8-grammar-mistakes',
    'swiss-watches-why-are-they-the-best',

    // Elementos demo
    'top-rated-products',
    'team-member',
    'social-share',
    'recently-viewed-products',
    'product-elements',
    'product-categories-elements',
    'product-attribute',
    'post-elements',
    'on-sale-product',
    'newsletter',
    'instagram',
    'features',
    'brand',
    'best-selling-products',
    'addon-video',
    'addon-text',
    'addon-image',
    '404-2',
    'flash-sale',
    'become-a-vendor',
];

foreach ($goneUrls as $goneUrl) {
    Route::get('/' . $goneUrl, fn () => response('Gone', 410));
    Route::get('/' . $goneUrl . '/', fn () => response('Gone', 410));
}

/*
|--------------------------------------------------------------------------
| Rutas principales del nuevo sitio
|--------------------------------------------------------------------------
*/

Route::get('/', [BobcatProductController::class, 'index'])->name('home');

Route::get('/tipo-de-llanta/{type}', [BobcatProductController::class, 'tireType'])
    ->name('products.type');

Route::get('/producto/{slug}', [BobcatProductController::class, 'show'])
    ->name('products.show');

/**
 * Fallback:
 * Si una URL vieja no está en la lista, evita mostrar error técnico.
 * Puede dejarse 404 para que Google no indexe basura nueva.
 */
Route::fallback(fn () => response()->view('errors.404', [], 404));