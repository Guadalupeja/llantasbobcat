<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Llantas Bobcat | Llantas para minicargadores')</title>

    <meta name="description" content="@yield('meta_description', 'Llantas para minicargadores Bobcat. Opciones sólidas y neumáticas para diferentes modelos de cargadores compactos.')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-neutral-900 antialiased">

    <header class="border-b border-neutral-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="text-xl font-black tracking-tight text-neutral-950">
                Llantas<span class="text-orange-600">Bobcat</span>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-semibold text-neutral-700 md:flex">
                <a href="{{ url('/') }}" class="hover:text-orange-600">Inicio</a>
                <a href="{{ url('/tipo-de-llanta/neumatica') }}" class="hover:text-orange-600">Neumáticas</a>
                <a href="{{ url('/tipo-de-llanta/solida') }}" class="hover:text-orange-600">Sólidas</a>
                <a href="#contacto" class="hover:text-orange-600">Contacto</a>
            </nav>

            <a
                href="https://wa.me/5212222273866"
                target="_blank"
                rel="noopener"
                class="rounded-full bg-orange-600 px-5 py-2 text-sm font-bold text-white transition hover:bg-orange-700"
            >
                Cotizar
            </a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-neutral-950 text-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="text-lg font-black">
                        Llantas<span class="text-orange-500">Bobcat</span>
                    </p>
                    <p class="mt-3 max-w-xl text-sm leading-6 text-neutral-300">
                        Llantas sólidas y neumáticas para minicargadores Bobcat.
                        Atención comercial para selección de medida, tipo de llanta y aplicación.
                    </p>
                </div>

                <div class="md:text-right">
                    <p class="text-sm font-semibold text-neutral-200">
                        ¿Necesitas cotizar?
                    </p>
                    <a
                        href="https://wa.me/5212222273866"
                        target="_blank"
                        rel="noopener"
                        class="mt-3 inline-flex rounded-full bg-orange-600 px-5 py-2 text-sm font-bold text-white transition hover:bg-orange-700"
                    >
                        Enviar WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>