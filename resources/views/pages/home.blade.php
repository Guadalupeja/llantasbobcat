@extends('layouts.app')

@php
    $seoYear = date('Y');

    $seoTitle = 'Llantas para Bobcat | Compra en línea Ruguex';

    $seoDescription = "Mejores llantas Bobcat {$seoYear}: sólidas y neumáticas para minicargador. Compra en línea, cotiza por WhatsApp y recibe asesoría Ruguex.";
@endphp

@section('title', $seoTitle)

@section('meta_description', $seoDescription)
@push('meta')
<style>
    @@keyframes bobcatHeroProducts {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .bobcat-hero-products {
        overflow: hidden;
        position: relative;
    }

    .bobcat-hero-products-track {
        display: flex;
        gap: 12px;
        width: max-content;
        animation: bobcatHeroProducts 34s linear infinite;
    }

    .bobcat-hero-products:hover .bobcat-hero-products-track {
        animation-play-state: paused;
    }

    .bobcat-hero-product-card {
        width: 285px;
        min-width: 285px;
        height: 142px;
        display: grid;
        grid-template-columns: 82px 1fr;
        gap: 10px;
        background: #fff;
        color: #000;
        padding: 10px;
        overflow: hidden;
    }

    .bobcat-hero-product-image {
        width: 82px;
        height: 122px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f7f7f7;
        padding: 6px;
    }

    .bobcat-hero-product-image img {
        max-height: 100px;
        width: auto;
    }

    .bobcat-hero-product-info {
        min-width: 0;
        display: flex;
        flex-direction: column;
        height: 122px;
    }

    .bobcat-hero-product-badges {
        display: flex;
        flex-wrap: nowrap;
        gap: 4px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .bobcat-hero-product-badges span {
        white-space: nowrap;
        font-size: 10px;
        line-height: 1;
        font-weight: 800;
        padding: 5px 7px;
    }

    .bobcat-hero-product-title {
        min-height: 32px;
        max-height: 32px;
        overflow: hidden;
        font-size: 12px;
        line-height: 16px;
        font-weight: 800;
        color: #000;
    }

    .bobcat-hero-product-price {
        margin-top: auto;
        padding-top: 5px;
    }

    .bobcat-hero-product-price strong {
        display: block;
        font-size: 16px;
        line-height: 18px;
        color: #ff6001;
        font-weight: 900;
        white-space: nowrap;
    }

    .bobcat-hero-product-price small {
        display: block;
        font-size: 11px;
        line-height: 13px;
        color: #555;
        font-weight: 700;
    }

    .bobcat-hero-product-button {
        display: inline-flex;
        align-self: flex-start;
        margin-top: 5px;
        background: #ff6001;
        color: #fff;
        font-size: 11px;
        line-height: 1;
        font-weight: 900;
        padding: 7px 12px;
    }

    @@media (max-width: 640px) {
        .bobcat-hero-product-card {
            width: 260px;
            min-width: 260px;
        }
    }
</style>

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "¿Qué llanta usa un minicargador Bobcat?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Depende del modelo Bobcat. Algunas medidas comunes son 10-16.5, 12-16.5, 14-17.5, 23 x 5.70-12 y 27 x 8.5-15. Lo recomendable es validar el modelo del equipo y la medida actual de la llanta."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Conviene llanta sólida o neumática para Bobcat?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "La llanta sólida ayuda a reducir paros por ponchaduras en obra, reciclaje y patios industriales. La llanta neumática ofrece tracción y amortiguación para terrenos irregulares."
            }
        },
        {
            "@@type": "Question",
            "name": "¿Puedo comprar en línea o cotizar por WhatsApp?",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "Sí. Ruguex ofrece productos en tienda en línea y atención por WhatsApp para confirmar medida, compatibilidad, disponibilidad y aplicación."
            }
        }
    ]
}
</script>
@endpush

@section('content')

@php
    $heroStoreProducts = $featuredStoreProducts
        ->filter(fn ($item) => ! empty($item['price_label']))
        ->take(8)
        ->values();
@endphp

{{-- HERO COMERCIAL --}}
<section class="relative overflow-hidden bg-[#ff6001]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.28),transparent_32%),linear-gradient(135deg,#ff6001_0%,#e15400_46%,#111_100%)]"></div>

    <div class="relative mx-auto grid max-w-[1200px] items-center gap-8 px-4 py-10 lg:grid-cols-[.92fr_1.08fr] lg:py-14">
        {{-- COPY --}}
        <div class="text-center lg:text-left">
            <p class="mb-4 inline-flex rounded-full bg-black/25 px-4 py-2 text-[13px] font-bold uppercase tracking-wide text-white">
                Llantas para minicargadores Bobcat
            </p>

            <h1 class="max-w-[620px] text-[34px] font-bold leading-[40px] text-white md:text-[44px] md:leading-[52px] lg:mx-0">
                Llantas para Bobcat con precio en línea y asesoría por WhatsApp
            </h1>

            <p class="mt-5 max-w-[620px] text-[17px] leading-8 text-white/90 lg:mx-0">
                Encuentra llantas sólidas y neumáticas para minicargadores Bobcat. Compra en línea con precio final en MXN o solicita ayuda para confirmar medida, rin y aplicación.
            </p>

            <div class="mt-7 grid gap-3 sm:grid-cols-2 lg:max-w-[590px]">
                <a href="#productos-destacados" class="inline-flex items-center justify-center bg-black px-6 py-4 text-[15px] font-bold text-white transition hover:bg-[#222]">
                    Comprar en tienda
                </a>

                <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20llantas%20para%20Bobcat." target="_blank" rel="noopener" class="inline-flex items-center justify-center bg-[#01a300] px-6 py-4 text-[15px] font-bold text-white transition hover:bg-[#018a00]">
                    Cotizar por WhatsApp
                </a>

                <a href="#cotizacion" class="inline-flex items-center justify-center bg-white px-6 py-4 text-[15px] font-bold text-black transition hover:bg-[#f2f2f2]">
                    Solicitar cotización
                </a>

                <a href="#selector-bobcat" class="inline-flex items-center justify-center border-2 border-white px-6 py-4 text-[15px] font-bold text-white transition hover:bg-white hover:text-black">
                    Buscar por modelo
                </a>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-3 lg:max-w-[590px]">
                <div class="bg-white/95 p-4 text-center shadow-md">
                    <p class="text-[22px] font-bold leading-none text-black">10-16.5</p>
                    <p class="mt-1 text-[13px] text-[#555]">medida común</p>
                </div>

                <div class="bg-white/95 p-4 text-center shadow-md">
                    <p class="text-[22px] font-bold leading-none text-black">12-16.5</p>
                    <p class="mt-1 text-[13px] text-[#555]">sólida o neumática</p>
                </div>

                <div class="bg-white/95 p-4 text-center shadow-md">
                    <p class="text-[22px] font-bold leading-none text-black">14-17.5</p>
                    <p class="mt-1 text-[13px] text-[#555]">equipos grandes</p>
                </div>
            </div>
        </div>

        {{-- CARD DERECHA --}}
        <div class="relative min-w-0">
            <div class="absolute -inset-4 bg-black/25 blur-2xl"></div>

            <div class="relative overflow-hidden bg-white p-4 shadow-2xl md:p-5">
                <div class="grid gap-4 md:grid-cols-[1.05fr_.95fr]">
                    <div class="flex min-h-[245px] items-center justify-center bg-[#f6f6f6] p-4">
                        <x-optimized-image
                            :src="$products->first()['image'] ?? ''"
                            alt="Llantas para minicargadores Bobcat"
                            class="h-auto max-h-[245px] w-auto object-contain"
                            loading="eager"
                            fetchpriority="high"
                            width="640"
                            height="420"
                        />
                    </div>

                    <div class="grid gap-3">
                        <div class="border border-[#eee] p-4 text-center">
                            <p class="text-[26px] font-bold leading-none text-[#ff6001]">{{ $products->count() }}</p>
                            <p class="mt-1 text-[13px] text-[#555]">modelos Bobcat</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="border border-[#eee] p-4 text-center">
                                <p class="text-[20px] font-bold leading-none text-[#ff6001]">Sólida</p>
                                <p class="mt-1 text-[12px] text-[#555]">anti ponchaduras</p>
                            </div>

                            <div class="border border-[#eee] p-4 text-center">
                                <p class="text-[20px] font-bold leading-none text-[#ff6001]">Neumática</p>
                                <p class="mt-1 text-[12px] text-[#555]">tracción</p>
                            </div>
                        </div>

                        <a
                            href="#selector-bobcat"
                            class="inline-flex items-center justify-center bg-black px-5 py-3 text-[14px] font-bold text-white transition hover:bg-[#ff6001]"
                        >
                            Encontrar mi llanta
                        </a>
                    </div>
                </div>

                {{-- MINI BANNER DE PRODUCTOS --}}
                @if ($heroStoreProducts->isNotEmpty())
                    <div id="productos-destacados" class="mt-4 overflow-hidden bg-black p-4 text-white">
                        <div class="mb-3 flex items-end justify-between gap-3">
                            <div>
                                <p class="text-[12px] font-bold uppercase tracking-wide text-[#ff6001]">
                                    Compra en línea
                                </p>

                                <h2 class="mt-1 text-[19px] font-bold leading-6 text-white">
                                    Llantas Bobcat con el mejor precio
                                </h2>
                            </div>

                            <a
                                href="https://llantasdemontacargas.com/tienda-en-linea/?swoof=1&product_cat=llantas-minicargadores"
                                target="_blank"
                                rel="noopener"
                                class="hidden shrink-0 bg-[#ff6001] px-4 py-2 text-[12px] font-bold text-white transition hover:bg-white hover:text-black sm:inline-flex"
                            >
                                Ver tienda
                            </a>
                        </div>

                        <div class="bobcat-hero-products overflow-hidden">
                            <div class="bobcat-hero-products-track flex w-max gap-3">
                                @foreach ($heroStoreProducts->concat($heroStoreProducts) as $item)
                                    <a
                                        href="{{ $item['url'] }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="bobcat-hero-product-card group"
                                    >
                                        <div class="bobcat-hero-product-image">
                                            <x-optimized-image
                                                :src="$item['image']"
                                                :alt="$item['name']"
                                                class="transition group-hover:scale-105"
                                                width="300"
                                                height="300"
                                            />
                                        </div>

                                        <div class="bobcat-hero-product-info">
                                            <div class="bobcat-hero-product-badges">
                                                <span class="bg-black text-white">
                                                    {{ $item['tire_type'] }}
                                                </span>

                                                @foreach (($item['sizes'] ?? []) as $size)
                                                    <span class="bg-[#ff6001] text-white">
                                                        {{ $size }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            <h3 class="bobcat-hero-product-title">
                                                {{ $item['name'] }}
                                            </h3>

                                            @if (! empty($item['price_label']))
                                                <div class="bobcat-hero-product-price">
                                                    <strong>
                                                        {{ str_replace(' MXN IVA incluido', ' MXN', $item['price_label']) }}
                                                    </strong>
                                                    <small>IVA incluido</small>
                                                </div>
                                            @endif

                                            <span class="bobcat-hero-product-button transition group-hover:bg-black">
                                                Comprar
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- SEÑALES DE CONFIANZA --}}
<section class="bg-white py-6">
    <div class="mx-auto max-w-[1200px] px-4">
        <h2 class="sr-only">Compra llantas para Bobcat con respaldo Ruguex</h2>

        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-5">
            <div class="border border-[#eee] bg-[#fafafa] p-4 text-center">
                <p class="text-[13px] font-bold uppercase text-[#ff6001]">Precio final</p>
                <p class="mt-1 text-[14px] text-[#555]">MXN con IVA incluido</p>
            </div>

            <div class="border border-[#eee] bg-[#fafafa] p-4 text-center">
                <p class="text-[13px] font-bold uppercase text-[#ff6001]">Tienda en línea</p>
                <p class="mt-1 text-[14px] text-[#555]">compra directa</p>
            </div>

            <div class="border border-[#eee] bg-[#fafafa] p-4 text-center">
                <p class="text-[13px] font-bold uppercase text-[#ff6001]">WhatsApp</p>
                <p class="mt-1 text-[14px] text-[#555]">asesoría rápida</p>
            </div>

            <div class="border border-[#eee] bg-[#fafafa] p-4 text-center">
                <p class="text-[13px] font-bold uppercase text-[#ff6001]">Trabajo pesado</p>
                <p class="mt-1 text-[14px] text-[#555]">sólidas y neumáticas</p>
            </div>

            <div class="border border-[#eee] bg-[#fafafa] p-4 text-center">
                <p class="text-[13px] font-bold uppercase text-[#ff6001]">Ruguex</p>
                <p class="mt-1 text-[14px] text-[#555]">atención especializada</p>
            </div>
        </div>
    </div>
</section>

{{-- SELECTOR --}}
<section id="selector-bobcat" class="bg-black py-12">
    <div class="mx-auto max-w-[1200px] px-4">
        <div class="mb-7 text-center">
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Selector de llantas Bobcat</p>
            <h2 class="mt-2 text-[32px] font-bold leading-10 text-white">Encuentra la llanta correcta para tu Bobcat</h2>
            <p class="mx-auto mt-2 max-w-[800px] text-[16px] leading-7 text-white/70">
                Filtra por modelo, tipo de llanta o medida. Te mostraremos opciones para comprar en línea o cotizar por WhatsApp.
            </p>
        </div>

        <div class="bg-white p-5 shadow-xl">
            <div class="grid gap-4 lg:grid-cols-4">
                <div>
                    <label class="mb-2 block text-[14px] font-bold text-black" for="filter-search">Buscar modelo</label>
                    <input id="filter-search" type="search" placeholder="Ej. S650, S770, Earthforce..." class="h-[46px] w-full border border-[#ddd] bg-white px-3 text-[14px] text-black outline-none focus:border-[#ff6001]">
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-bold text-black" for="filter-model">Modelo Bobcat</label>
                    <select id="filter-model" class="h-[46px] w-full border border-[#ddd] bg-white px-3 text-[14px] text-black outline-none focus:border-[#ff6001]">
                        <option value="">Todos los modelos</option>
                        @foreach ($models as $model)
                            <option value="{{ str($model)->slug() }}">{{ $model }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-bold text-black" for="filter-type">Tipo de llanta</label>
                    <select id="filter-type" class="h-[46px] w-full border border-[#ddd] bg-white px-3 text-[14px] text-black outline-none focus:border-[#ff6001]">
                        <option value="">Todas</option>
                        <option value="solida">Sólida</option>
                        <option value="neumatica">Neumática</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-[14px] font-bold text-black" for="filter-size">Medida</label>
                    <select id="filter-size" class="h-[46px] w-full border border-[#ddd] bg-white px-3 text-[14px] text-black outline-none focus:border-[#ff6001]">
                        <option value="">Todas</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p id="bobcat-results-count" class="text-[14px] font-bold text-[#ff6001]">Mostrando modelos Bobcat</p>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button id="clear-bobcat-filters" type="button" class="inline-flex h-[44px] items-center justify-center border border-black px-5 text-[14px] font-bold text-black transition hover:bg-black hover:text-white">
                        Limpiar filtros
                    </button>

                    <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20no%20estoy%20seguro%20de%20la%20medida%20de%20mi%20Bobcat.%20Quiero%20asesoría." target="_blank" rel="noopener" class="inline-flex h-[44px] items-center justify-center bg-[#01a300] px-5 text-[14px] font-bold text-white transition hover:bg-[#018a00]">
                        No sé mi medida
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CATÁLOGO DE MODELOS --}}
<section class="bg-[#f5f5f5] py-14">
    <div class="mx-auto max-w-[1200px] px-4">
        <div class="mb-9 text-center">
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Catálogo Bobcat</p>
            <h2 class="mt-2 text-[32px] font-bold leading-10 text-black">Llantas por modelo de minicargador Bobcat</h2>
            <p class="mx-auto mt-3 max-w-[820px] text-[16px] leading-7 text-[#555]">
                Entra a tu modelo para ver medidas, opciones recomendadas y productos disponibles para compra o cotización.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="js-bobcat-card group overflow-hidden bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                    data-model="{{ str($product['model'])->slug() }}"
                    data-types="{{ collect($product['tire_types'])->map(fn($type) => str($type)->lower()->ascii())->implode(' ') }}"
                    data-sizes="{{ implode(' ', $product['sizes'] ?? []) }}"
                    data-search="{{ $product['name'] }} {{ $product['model'] }} {{ implode(' ', $product['sizes'] ?? []) }} {{ implode(' ', $product['tire_types'] ?? []) }}">
                    <a href="{{ route('products.show', $product['slug']) }}" class="block">
                        <div class="relative flex h-[230px] items-center justify-center bg-[#fafafa]">
                            <x-optimized-image
                                :src="$product['image']"
                                :alt="$product['name']"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                width="420"
                                height="260"
                            />

                            <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                                @foreach ($product['tire_types'] as $type)
                                    <span class="bg-black px-3 py-1 text-[12px] font-bold text-white">{{ $type }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-5">
                            <p class="text-[13px] font-bold uppercase text-[#ff6001]">{{ $product['model'] }}</p>

                            <h3 class="mt-1 text-[21px] font-bold leading-7 text-black">{{ $product['name'] }}</h3>

                            <p class="mt-3 line-clamp-3 text-[14px] leading-6 text-[#555]">{{ trim(preg_replace('/\s+/', ' ', str_replace('\\n', ' ', $product['excerpt'] ?? ''))) }}</p>

                            <div class="mt-4 grid grid-cols-2 gap-3 border-t border-[#eee] pt-4 text-[14px]">
                                <div>
                                    <p class="font-bold text-black">Medida</p>
                                    <p class="text-[#555]">{{ implode(' / ', $product['sizes'] ?? ['Consultar']) }}</p>
                                </div>

                                <div>
                                    <p class="font-bold text-black">Opciones</p>
                                    <p class="text-[#555]">{{ $product['compatible_count'] > 0 ? $product['compatible_count'] . ' disponibles' : 'Cotizar' }}</p>
                                </div>
                            </div>

                            <span class="mt-5 inline-flex w-full items-center justify-center bg-[#ff6001] px-4 py-3 text-[14px] font-bold text-white transition group-hover:bg-black">
                                Ver llantas compatibles para {{ $product['model'] }}
                            </span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <div id="bobcat-no-results" class="mt-8 hidden bg-white p-8 text-center shadow-sm">
            <h3 class="text-[22px] font-bold text-black">No encontramos coincidencias con esos filtros</h3>
            <p class="mx-auto mt-3 max-w-[620px] text-[15px] leading-7 text-[#555]">Escríbenos por WhatsApp y te ayudamos a identificar la medida correcta para tu Bobcat.</p>
            <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20ayuda%20para%20encontrar%20llantas%20para%20mi%20Bobcat." target="_blank" rel="noopener" class="mt-5 inline-flex bg-[#01a300] px-6 py-3 text-[15px] font-bold text-white transition hover:bg-[#018a00]">Cotizar por WhatsApp</a>
        </div>
    </div>
</section>

{{-- SÓLIDA VS NEUMÁTICA --}}
<section class="bg-white py-14">
    <div class="mx-auto max-w-[1200px] px-4">
        <div class="mb-9 text-center">
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Elige la opción adecuada</p>
            <h2 class="mt-2 text-[32px] font-bold leading-10 text-black">¿Llanta sólida o neumática para Bobcat?</h2>
            <p class="mx-auto mt-3 max-w-[820px] text-[16px] leading-7 text-[#555]">
                La elección correcta depende del terreno, la carga, el riesgo de ponchaduras y el tipo de operación de tu minicargador.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <article class="border-t-4 border-[#ff6001] bg-[#f7f7f7] p-7">
                <h3 class="text-[26px] font-bold leading-8 text-black">Llanta sólida para Bobcat</h3>
                <p class="mt-4 text-[16px] leading-7 text-[#555]">
                    Recomendada para obra, reciclaje, patios industriales, superficies con clavos, metal, piedra o escombro. Ayuda a reducir paros por ponchaduras.
                </p>

                <ul class="mt-5 space-y-3 text-[15px] text-[#333]">
                    <li>✓ Mayor resistencia contra cortes y ponchaduras.</li>
                    <li>✓ Buena opción para trabajo severo y operación continua.</li>
                    <li>✓ Reduce tiempos muertos por reparaciones.</li>
                </ul>

                <a href="{{ url('/tipo-de-llanta/solida') }}" class="mt-6 inline-flex bg-black px-6 py-3 text-[15px] font-bold text-white transition hover:bg-[#ff6001]">
                    Ver llantas sólidas
                </a>
            </article>

            <article class="border-t-4 border-black bg-[#f7f7f7] p-7">
                <h3 class="text-[26px] font-bold leading-8 text-black">Llanta neumática para Bobcat</h3>
                <p class="mt-4 text-[16px] leading-7 text-[#555]">
                    Recomendada cuando buscas tracción, amortiguación y mejor absorción de impactos en terreno irregular o aplicaciones donde el confort importa.
                </p>

                <ul class="mt-5 space-y-3 text-[15px] text-[#333]">
                    <li>✓ Buena tracción en superficies irregulares.</li>
                    <li>✓ Mejor amortiguación frente a impactos.</li>
                    <li>✓ Disponible en medidas comunes para minicargador.</li>
                </ul>

                <a href="{{ url('/tipo-de-llanta/neumatica') }}" class="mt-6 inline-flex bg-[#ff6001] px-6 py-3 text-[15px] font-bold text-white transition hover:bg-black">
                    Ver llantas neumáticas
                </a>
            </article>
        </div>
    </div>
</section>

{{-- ASESORÍA / PROCESO --}}
<section class="bg-black py-14 text-white">
    <div class="mx-auto grid max-w-[1200px] gap-8 px-4 lg:grid-cols-[.9fr_1.1fr]">
        <div>
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Ruguex</p>
            <h2 class="mt-2 text-[32px] font-bold leading-10">Compra con asesoría para evitar errores de medida</h2>
            <p class="mt-4 text-[16px] leading-7 text-white/75">
                Si no estás seguro de qué llanta usa tu Bobcat, envíanos el modelo o una foto de la llanta actual. Te ayudamos a validar medida, rin, tipo de llanta y aplicación.
            </p>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20asesoría%20para%20comprar%20llantas%20para%20Bobcat." target="_blank" rel="noopener" class="inline-flex items-center justify-center bg-[#01a300] px-7 py-4 text-[16px] font-bold text-white transition hover:bg-[#018a00]">
                    Enviar datos por WhatsApp
                </a>

                <a href="#cotizacion" class="inline-flex items-center justify-center bg-white px-7 py-4 text-[16px] font-bold text-black transition hover:bg-[#ff6001] hover:text-white">
                    Solicitar cotización
                </a>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <article class="bg-white p-5 text-black">
                <p class="text-[34px] font-bold leading-none text-[#ff6001]">1</p>
                <h3 class="mt-3 text-[19px] font-bold">Dinos tu modelo</h3>
                <p class="mt-2 text-[14px] leading-6 text-[#555]">S650, S770, S590, S850, Earthforce y más.</p>
            </article>

            <article class="bg-white p-5 text-black">
                <p class="text-[34px] font-bold leading-none text-[#ff6001]">2</p>
                <h3 class="mt-3 text-[19px] font-bold">Validamos medida</h3>
                <p class="mt-2 text-[14px] leading-6 text-[#555]">Revisamos medida, rin y equivalencias.</p>
            </article>

            <article class="bg-white p-5 text-black">
                <p class="text-[34px] font-bold leading-none text-[#ff6001]">3</p>
                <h3 class="mt-3 text-[19px] font-bold">Compra o cotiza</h3>
                <p class="mt-2 text-[14px] leading-6 text-[#555]">Te damos opción en tienda o atención directa.</p>
            </article>
        </div>
    </div>
</section>

{{-- FAQ SEO --}}
<section class="bg-[#f5f5f5] py-14">
    <div class="mx-auto max-w-[950px] px-4">
        <div class="mb-8 text-center">
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Preguntas frecuentes</p>
            <h2 class="mt-2 text-[32px] font-bold leading-10 text-black">Dudas comunes sobre llantas para Bobcat</h2>
        </div>

        <div class="space-y-4">
            <details class="bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-[18px] font-bold text-black">
                    ¿Qué llanta usa un minicargador Bobcat?
                </summary>
                <p class="mt-3 text-[15px] leading-7 text-[#555]">
                    Depende del modelo. Algunas medidas comunes son 10-16.5, 12-16.5, 14-17.5, 23 x 5.70-12 y 27 x 8.5-15. Lo ideal es confirmar el modelo del equipo y la medida actual montada.
                </p>
            </details>

            <details class="bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-[18px] font-bold text-black">
                    ¿Conviene más una llanta sólida o neumática para Bobcat?
                </summary>
                <p class="mt-3 text-[15px] leading-7 text-[#555]">
                    La sólida conviene cuando quieres evitar ponchaduras en superficies agresivas. La neumática puede ser mejor si buscas tracción, amortiguación y desempeño en terreno irregular.
                </p>
            </details>

            <details class="bg-white p-5 shadow-sm">
                <summary class="cursor-pointer text-[18px] font-bold text-black">
                    ¿Puedo comprar en línea y también recibir asesoría?
                </summary>
                <p class="mt-3 text-[15px] leading-7 text-[#555]">
                    Sí. Puedes comprar en la tienda en línea o escribir por WhatsApp para validar compatibilidad antes de hacer tu compra.
                </p>
            </details>
        </div>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="bg-black py-14 text-white">
    <div class="mx-auto grid max-w-[1200px] items-center gap-8 px-4 lg:grid-cols-[1fr_auto]">
        <div>
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">
                Atención Ruguex
            </p>

            <h2 class="mt-2 text-[32px] font-bold leading-10">
                ¿No estás seguro de qué llanta usa tu Bobcat?
            </h2>

            <p class="mt-4 max-w-[760px] text-[16px] leading-7 text-white/75">
                Envíanos el modelo de tu minicargador, la medida actual o una foto de la llanta. Te ayudamos a elegir una opción compatible antes de comprar.
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a
                href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20necesito%20ayuda%20para%20elegir%20llantas%20para%20mi%20Bobcat."
                target="_blank"
                rel="noopener"
                class="inline-flex items-center justify-center bg-[#01a300] px-7 py-4 text-[16px] font-bold text-white transition hover:bg-[#018a00]"
            >
                Cotizar por WhatsApp
            </a>

            <a
                href="#cotizacion"
                class="inline-flex items-center justify-center bg-[#ff6001] px-7 py-4 text-[16px] font-bold text-white transition hover:bg-white hover:text-black"
            >
                Llenar formulario
            </a>
        </div>
    </div>
</section>

<x-hubspot-bobcat-form />

@endsection
