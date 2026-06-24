@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    $seoYear = date('Y');

    $seoLabel = $label ?? 'Bobcat';

    $seoTitle = Str::limit("Llantas {$seoLabel} para Bobcat | Ruguex", 60, '');

    $seoDescription = Str::limit(
        "Mejores llantas {$seoLabel} para Bobcat {$seoYear}. Revisa modelos, medidas y opciones para minicargador con compra en línea o cotización por WhatsApp.",
        160,
        ''
    );
@endphp

@section('title', $seoTitle)

@section('meta_description', $seoDescription)

@section('content')

<section class="relative overflow-hidden bg-[#ff6001] py-14 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.22),transparent_32%),linear-gradient(135deg,#ff6001_0%,#e15400_50%,#111_100%)]"></div>

    <div class="relative mx-auto max-w-[1200px] px-4">
        <p class="text-[14px] font-bold uppercase tracking-wide text-white/80">
            Llantas para minicargadores Bobcat
        </p>

        <h1 class="mt-2 text-[38px] font-bold leading-[46px]">
            Llantas {{ $label }} para Bobcat
        </h1>

        <p class="mt-4 max-w-[760px] text-[17px] leading-8 text-white/85">
            Encuentra modelos Bobcat compatibles y revisa opciones para comprar en línea o cotizar con asesoría Ruguex.
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
            <a href="{{ route('home') }}#selector-bobcat" class="inline-flex items-center justify-center bg-black px-6 py-3 text-[15px] font-bold text-white transition hover:bg-[#222]">
                Buscar por modelo
            </a>

            <a href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20llantas%20{{ urlencode($label) }}%20para%20Bobcat." target="_blank" rel="noopener" class="inline-flex items-center justify-center bg-[#01a300] px-6 py-3 text-[15px] font-bold text-white transition hover:bg-[#018a00]">
                Cotizar por WhatsApp
            </a>

            <a href="#cotizacion" class="inline-flex items-center justify-center bg-white px-6 py-3 text-[15px] font-bold text-black transition hover:bg-[#f2f2f2]">
                Solicitar cotización
            </a>
        </div>
    </div>
</section>

<section class="bg-[#f5f5f5] py-14">
    <div class="mx-auto max-w-[1200px] px-4">
        <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">
                    Modelos disponibles
                </p>

                <h2 class="mt-2 text-[30px] font-bold leading-[38px] text-black">
                    Bobcat compatibles con llanta {{ $label }}
                </h2>

                <p class="mt-2 max-w-[760px] text-[16px] leading-7 text-[#555]">
                    Selecciona tu modelo para ver medidas, opciones disponibles y productos recomendados de tienda.
                </p>
            </div>

            <p class="text-[14px] font-bold text-[#ff6001]">
                {{ $products->count() }} modelos encontrados
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product['slug']) }}" class="group block overflow-hidden bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative flex h-[230px] items-center justify-center bg-[#fafafa]">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">

                        <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                            @foreach ($product['tire_types'] as $type)
                                <span class="bg-black px-3 py-1 text-[12px] font-bold text-white">{{ $type }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-5">
                        <p class="text-[13px] font-bold uppercase text-[#ff6001]">
                            {{ $product['model'] }}
                        </p>

                        <h2 class="mt-1 text-[21px] font-bold leading-7 text-black">
                            {{ $product['name'] }}
                        </h2>

                        <p class="mt-3 line-clamp-3 text-[14px] leading-6 text-[#555]">
                            {{ trim(preg_replace('/\s+/', ' ', str_replace('\\n', ' ', $product['excerpt'] ?? 'Opciones para minicargador Bobcat con asesoría Ruguex.'))) }}
                        </p>

                        <div class="mt-4 grid grid-cols-2 gap-3 border-t border-[#eee] pt-4 text-[14px]">
                            <div>
                                <p class="font-bold text-black">Medida</p>
                                <p class="text-[#555]">{{ implode(' / ', $product['sizes'] ?? ['Consultar']) }}</p>
                            </div>

                            <div>
                                <p class="font-bold text-black">Opciones</p>
                                <p class="text-[#555]">
                                    {{ ($product['compatible_count'] ?? 0) > 0 ? $product['compatible_count'] . ' disponibles' : 'Cotizar' }}
                                </p>
                            </div>
                        </div>

                        <span class="mt-5 inline-flex w-full items-center justify-center bg-[#ff6001] px-4 py-3 text-[14px] font-bold text-white transition group-hover:bg-black">
                            Ver llantas compatibles para {{ $product['model'] }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-black py-12 text-white">
    <div class="mx-auto grid max-w-[1200px] items-center gap-6 px-4 md:grid-cols-[1fr_auto]">
        <div>
            <p class="text-[14px] font-bold uppercase tracking-wide text-[#ff6001]">
                Asesoría Ruguex
            </p>

            <h2 class="mt-2 text-[30px] font-bold leading-9">
                Cotiza llantas {{ $label }} para tu Bobcat
            </h2>

            <p class="mt-3 max-w-[760px] text-[16px] leading-7 text-white/75">
                Déjanos tus datos y te ayudamos a confirmar disponibilidad, precio y compatibilidad.
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <a
                href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20llantas%20{{ urlencode($label) }}%20para%20Bobcat."
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
                Solicitar cotización
            </a>
        </div>
    </div>
</section>

<x-hubspot-bobcat-form />

@endsection
