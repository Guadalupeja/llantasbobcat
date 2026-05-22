@extends('layouts.app')

@section('title', 'Llantas Bobcat | Llantas para minicargadores Bobcat')

@section('meta_description', 'Encuentra llantas sólidas y neumáticas para minicargadores Bobcat. Opciones para modelos S650, S770, S850, S590, S750 y más.')

@section('content')

<section class="relative overflow-hidden bg-neutral-950 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-neutral-950 via-neutral-900 to-orange-950"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-28">
        <div>
            <p class="mb-4 inline-flex rounded-full bg-orange-600/20 px-4 py-2 text-sm font-bold text-orange-300 ring-1 ring-orange-500/30">
                Llantas para minicargadores Bobcat
            </p>

            <h1 class="text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl">
                Llantas sólidas y neumáticas para Bobcat
            </h1>

            <p class="mt-6 max-w-2xl text-lg leading-8 text-neutral-300">
                Encuentra opciones de llanta para minicargadores Bobcat según modelo, medida y tipo de aplicación.
                Te ayudamos a elegir entre llanta sólida o neumática.
            </p>

            <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                <a
                    href="#modelos"
                    class="rounded-full bg-orange-600 px-7 py-3 text-center text-sm font-bold text-white transition hover:bg-orange-700"
                >
                    Ver modelos
                </a>

                <a
                    href="https://wa.me/5212222273866"
                    target="_blank"
                    rel="noopener"
                    class="rounded-full bg-white px-7 py-3 text-center text-sm font-bold text-neutral-950 transition hover:bg-neutral-200"
                >
                    Cotizar por WhatsApp
                </a>
            </div>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/10 p-6 shadow-2xl backdrop-blur">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-white p-5 text-neutral-950">
                    <p class="text-sm font-bold text-orange-600">Tipo</p>
                    <p class="mt-2 text-2xl font-black">Sólida</p>
                    <p class="mt-2 text-sm text-neutral-600">Mayor resistencia contra ponchaduras.</p>
                </div>

                <div class="rounded-2xl bg-white p-5 text-neutral-950">
                    <p class="text-sm font-bold text-orange-600">Tipo</p>
                    <p class="mt-2 text-2xl font-black">Neumática</p>
                    <p class="mt-2 text-sm text-neutral-600">Buena tracción y amortiguación.</p>
                </div>

                <div class="rounded-2xl bg-white p-5 text-neutral-950 sm:col-span-2">
                    <p class="text-sm font-bold text-orange-600">Medidas comunes</p>
                    <p class="mt-2 text-2xl font-black">10-16.5 / 12-16.5 / 14-17.5</p>
                    <p class="mt-2 text-sm text-neutral-600">
                        Medidas frecuentes en minicargadores Bobcat de diferentes capacidades.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="modelos" class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-wide text-orange-600">
                Catálogo Bobcat
            </p>

            <h2 class="mt-3 text-3xl font-black tracking-tight text-neutral-950 sm:text-4xl">
                Próximo paso: aquí cargaremos los modelos desde Laravel
            </h2>

            <p class="mt-4 text-base leading-7 text-neutral-600">
                En el siguiente paso crearemos el archivo de datos con los modelos Bobcat detectados
                del sitio actual y generaremos tarjetas dinámicas.
            </p>
        </div>

        <div class="mt-10 rounded-3xl border border-dashed border-neutral-300 bg-neutral-50 p-8 text-center">
            <p class="text-lg font-bold text-neutral-800">
                Base del proyecto lista.
            </p>
            <p class="mt-2 text-sm text-neutral-600">
                Después agregaremos tarjetas, imágenes, filtros y rutas individuales.
            </p>
        </div>
    </div>
</section>

@endsection