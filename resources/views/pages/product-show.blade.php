@extends('layouts.app')

@section('title', $product['meta_title'] ?? $product['name'])

@section('meta_description', $product['meta_description'] ?? $product['excerpt'])

@section('content')

<section class="bg-[#f5f5f5] py-10">
    <div class="mx-auto max-w-[1200px] px-4">
        <nav class="mb-5 text-[14px] text-[#666]">
            <a href="{{ route('home') }}" class="hover:text-[#ff6001]">Inicio</a>
            <span class="mx-2">/</span>
            <span>{{ $product['model'] }}</span>
        </nav>

        <div class="grid gap-8 bg-white p-5 shadow-sm lg:grid-cols-[.9fr_1.1fr] lg:p-8">
            <div>
                <div class="overflow-hidden bg-[#f7f7f7]">
                    <x-optimized-image
                        :src="$product['image']"
                        :alt="$product['name']"
                        class="h-auto w-full object-cover"
                        loading="eager"
                        fetchpriority="high"
                        width="640"
                        height="420"
                    />
                </div>

                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                    @foreach ($product['sizes'] as $size)
                        <div class="border border-[#eee] p-4 text-center">
                            <p class="text-[13px] font-bold uppercase text-[#ff6001]">Medida</p>
                            <p class="mt-1 text-[20px] font-bold text-black">{{ $size }}</p>
                        </div>
                    @endforeach

                    <div class="border border-[#eee] p-4 text-center">
                        <p class="text-[13px] font-bold uppercase text-[#ff6001]">Modelo</p>
                        <p class="mt-1 text-[20px] font-bold text-black">{{ $product['model'] }}</p>
                    </div>
                </div>
            </div>

            <div>
                <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Llantas para minicargador Bobcat</p>

                <h1 class="mt-2 text-[34px] font-bold leading-[42px] text-black">{{ $product['name'] }}</h1>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($product['tire_types'] as $type)
                        <span class="bg-black px-3 py-1 text-[13px] font-bold text-white">{{ $type }}</span>
                    @endforeach
                    @foreach ($product['sizes'] as $size)
                        <span class="bg-[#ff6001] px-3 py-1 text-[13px] font-bold text-white">{{ $size }}</span>
                    @endforeach
                </div>

                <p class="mt-5 text-[16px] leading-8 text-[#333]">{{ str_replace('\\n', ' ', $product['excerpt']) }}</p>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                    <a href="#productos-compatibles" class="inline-flex items-center justify-center bg-[#ff6001] px-7 py-4 text-[16px] font-bold text-white transition hover:bg-black">
                        Ver llantas disponibles
                    </a>
                    <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20{{ urlencode($product['name']) }}." target="_blank" rel="noopener" class="inline-flex items-center justify-center bg-[#01a300] px-7 py-4 text-[16px] font-bold text-white transition hover:bg-[#018a00]">
                        Cotizar por WhatsApp
                    </a>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="border-l-4 border-[#ff6001] bg-[#f7f7f7] p-5">
                        <h2 class="text-[20px] font-bold text-black">Selección rápida</h2>
                        <p class="mt-2 text-[15px] leading-7 text-[#555]">Opciones para trabajar con mejor tracción, resistencia y continuidad operativa.</p>
                    </div>
                    <div class="border-l-4 border-black bg-[#f7f7f7] p-5">
                        <h2 class="text-[20px] font-bold text-black">Asesoría Ruguex</h2>
                        <p class="mt-2 text-[15px] leading-7 text-[#555]">Validamos medida, rin, carga y tipo de superficie antes de cotizar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="productos-compatibles" class="bg-white py-14">
    <div class="mx-auto max-w-[1200px] px-4">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Opciones para comprar o cotizar</p>
                <h2 class="mt-2 text-[30px] font-bold leading-[38px] text-black">Llantas disponibles para {{ $product['model'] }}</h2>
                <p class="mt-2 max-w-[760px] text-[16px] leading-7 text-[#555]">Revisa opciones por medida, tipo de llanta y aplicación. Puedes comprar en línea o solicitar asesoría directa.</p>
            </div>
            @if ($compatibleItems->isNotEmpty())
                <p class="text-[14px] font-bold text-[#ff6001]">{{ $compatibleItems->count() }} opciones disponibles</p>
            @endif
        </div>

        @if ($compatibleItems->isEmpty())
            <div class="grid gap-8 lg:grid-cols-[.85fr_1.15fr]">
                <div class="bg-[#f7f7f7] p-8">
                    <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">Cotización especializada</p>
                    <h3 class="mt-2 text-[30px] font-bold leading-[38px] text-black">Llanta para {{ $product['model'] }} bajo disponibilidad</h3>
                    <p class="mt-4 text-[16px] leading-8 text-[#555]">Este modelo puede requerir una medida especial o validación de equivalencia. Envíanos los datos de tu equipo y te confirmamos la mejor opción disponible.</p>
                    <ul class="mt-5 space-y-3 text-[15px] text-[#333]">
                        <li>✓ Validación de medida y tipo de rin.</li>
                        <li>✓ Recomendación entre llanta sólida o neumática.</li>
                        <li>✓ Cotización según carga, superficie y operación.</li>
                    </ul>
                    <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20llantas%20para%20{{ urlencode($product['model']) }}." target="_blank" rel="noopener" class="mt-6 inline-flex bg-[#01a300] px-6 py-3 text-[15px] font-bold text-white transition hover:bg-[#018a00]">Solicitar cotización</a>
                </div>

                <div>
                    <h3 class="mb-5 text-[24px] font-bold text-black">Opciones populares para minicargadores</h3>
                    <div class="grid gap-5 sm:grid-cols-2">
                        @foreach ($featuredStoreProducts->take(4) as $item)
                            <article class="border border-[#eee] bg-white p-4 shadow-sm">
                                <div class="flex h-[150px] items-center justify-center bg-[#fafafa]">
                                    <x-optimized-image
                                        :src="$item['image']"
                                        :alt="$item['name']"
                                        class="max-h-[125px] w-auto object-contain"
                                        width="300"
                                        height="300"
                                    />
                                </div>
                               <h4 class="mt-4 line-clamp-2 text-[17px] font-bold leading-6 text-black">
    {{ $item['name'] }}
</h4>

@if (! empty($item['price_label']))
    <div class="mt-2">
        <p class="text-[18px] font-black leading-6 text-[#ff6001]">
            {{ str_replace(' MXN IVA incluido', ' MXN', $item['price_label']) }}
        </p>

        <p class="text-[12px] font-bold text-[#666]">
            IVA incluido
        </p>
    </div>
@else
    <p class="mt-2 text-[15px] font-bold text-[#ff6001]">
        Precio bajo consulta
    </p>
@endif

<a href="{{ $item['url'] }}" target="_blank" rel="noopener" class="mt-3 inline-flex w-full items-center justify-center bg-black px-4 py-2 text-[13px] font-bold text-white transition hover:bg-[#ff6001]">
    Ver producto
</a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($compatibleItems as $item)
                    <article class="group overflow-hidden border border-[#eee] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex h-[230px] items-center justify-center bg-[#fafafa] p-5">
                            <x-optimized-image
                                :src="$item['image']"
                                :alt="$item['name']"
                                class="max-h-[190px] w-auto object-contain transition group-hover:scale-105"
                                width="300"
                                height="300"
                            />
                        </div>
                        <div class="p-5">
                            <div class="mb-3 flex flex-wrap gap-2">
                                <span class="bg-black px-3 py-1 text-[12px] font-bold text-white">{{ $item['tire_type'] }}</span>
                                @foreach ($item['sizes'] as $size)
                                    <span class="bg-[#ff6001] px-3 py-1 text-[12px] font-bold text-white">{{ $size }}</span>
                                @endforeach
                            </div>
                            <h3 class="text-[19px] font-bold leading-7 text-black">{{ $item['name'] }}</h3>
                            <div class="mt-4 grid grid-cols-2 gap-3 border-t border-[#eee] pt-4 text-[14px] text-[#555]">
                                <div><p class="font-bold text-black">Marca</p><p>{{ $item['brand'] }}</p></div>
                                <div><p class="font-bold text-black">Modelo</p><p>{{ $item['line'] ?: 'Consultar' }}</p></div>
                                <div><p class="font-bold text-black">Turnos</p><p>{{ $item['turns'] ?: 'Consultar' }}</p></div>
<div>
    <p class="font-bold text-black">Precio</p>

    @if (! empty($item['price_label']))
        <p class="text-[18px] font-black leading-6 text-[#ff6001]">
            {{ str_replace(' MXN IVA incluido', ' MXN', $item['price_label']) }}
        </p>

        <p class="mt-1 text-[12px] font-bold text-[#666]">
            IVA incluido
        </p>
    @else
        <p class="font-bold text-[#ff6001]">
            Precio bajo consulta
        </p>
    @endif
</div>                            </div>
<div class="mt-5 grid gap-3 sm:grid-cols-2">
    <a
        href="{{ $item['url'] }}"
        target="_blank"
        rel="noopener"
        class="inline-flex items-center justify-center bg-[#ff6001] px-4 py-3 text-[14px] font-bold text-white transition hover:bg-black"
    >
        Comprar en línea
    </a>

    <a
        href="https://wa.me/528332395885?text={{ urlencode($item['whatsapp_text']) }}"
        target="_blank"
        rel="noopener"
        class="inline-flex items-center justify-center bg-[#01a300] px-4 py-3 text-[14px] font-bold text-white transition hover:bg-[#018a00]"
    >
        Cotizar
    </a>
</div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

@if ($relatedProducts->isNotEmpty())
<section class="bg-[#f5f5f5] py-14">
    <div class="mx-auto max-w-[1200px] px-4">
        <h2 class="mb-6 text-[28px] font-bold text-black">Otros modelos Bobcat que podrían interesarte</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($relatedProducts as $related)
                <a href="{{ route('products.show', $related['slug']) }}" class="block bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <x-optimized-image
                    :src="$related['image']"
                    :alt="$related['name']"
                    class="h-[130px] w-full object-cover"
                    width="320"
                    height="180"
                />
                    <p class="mt-4 text-[13px] font-bold uppercase text-[#ff6001]">{{ $related['model'] }}</p>
                    <h3 class="mt-1 text-[17px] font-bold leading-6 text-black">{{ $related['name'] }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
