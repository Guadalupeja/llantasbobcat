<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    @php
    $gtmId = config('services.gtm.id');
@endphp

@if (! empty($gtmId))
    <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'page_data',
            page_path: window.location.pathname,
            page_title: document.title || '',
            site_section: 'llantas_bobcat'
        });
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
            var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),
                dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;
            j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ $gtmId }}');
    </script>
    <!-- End Google Tag Manager -->
@endif


<title>@yield('title', 'Llantas para Bobcat | Ruguex')</title>

<meta name="description" content="@yield('meta_description', 'Compra y cotiza llantas para minicargadores Bobcat con asesoría Ruguex.')">

<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('icons/favicon-48x48.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('icons/favicon-96x96.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<meta name="theme-color" content="#ff6001">

@if (config('app.noindex'))
    <meta name="robots" content="noindex,nofollow,noarchive,nosnippet">
@else
    <meta name="robots" content="index,follow">
@endif

<link rel="canonical" href="{{ url()->current() }}">

<meta property="og:title" content="@yield('title', 'Llantas para Bobcat | Ruguex')">
<meta property="og:description" content="@yield('meta_description', 'Compra y cotiza llantas para minicargadores Bobcat con asesoría Ruguex.')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('meta')
</head>

<body class="min-h-screen overflow-x-hidden bg-[#f5f5f5] font-sans text-[14px] leading-6 text-black antialiased">

    {{-- TOP BAR --}}
    <div class="hidden bg-black py-3 text-[15px] text-white lg:block">
        <div class="mx-auto flex max-w-[1200px] items-center justify-between px-4">
            <div class="flex flex-wrap items-center gap-x-8 gap-y-2">
                <a href="tel:8332462205" class="flex items-center gap-2 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(83)3246-2205</span>
                </a>

                <a href="tel:8332395885" class="flex items-center gap-2 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(83)3239-5885</span>
                </a>

                <a href="tel:2222273866" class="flex items-center gap-2 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(22)2227-3866</span>
                </a>

                <a href="tel:5951124238" class="flex items-center gap-2 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(59)5112-4238</span>
                </a>

                <a href="tel:5557521715" class="flex items-center gap-2 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(55)5752-1715</span>
                </a>
            </div>

            <a href="mailto:ventas@llantasdemontacargas.com" class="flex items-center gap-2 transition hover:text-[#ee5a35]">
                <span class="text-[#ee5a35]">✉</span>
                <span>ventas@llantasdemontacargas.com</span>
            </a>
        </div>
    </div>

    {{-- MAIN HEADER --}}
    <header class="relative z-50 bg-black py-[10px] text-white">
        <div class="mx-auto flex max-w-[1200px] items-center px-4">
            {{-- Logo --}}
            <div class="flex w-[45%] items-center lg:w-[17%]">
                <a href="{{ url('/') }}" class="inline-block">
                    <x-optimized-image
                        src="https://cdn-fnckj.nitrocdn.com/OEigyWnrTCqTXTtoxkmZdbSZZjfcgSQv/assets/images/optimized/rev-47f8cd9/llantasbobcat.com/wp-content/uploads/2022/03/ruguex-llantas-para-montacargas-distrubuidor-trelleborg.png"
                        alt="Ruguex llantas para minicargadores Bobcat"
                        class="h-auto max-w-[150px] lg:max-w-[180px]"
                        loading="eager"
                        fetchpriority="high"
                        width="234"
                        height="90"
                    />
                </a>
            </div>

            {{-- Desktop menu --}}
            <nav class="hidden w-[67%] justify-center lg:flex">
                <ul class="flex h-[49px] items-center justify-center">
                    <li class="group relative">
                        <a href="#" class="flex h-[49px] items-center px-5 font-[Lato] text-[17px] font-medium text-white transition hover:text-[#ee5a35]">
                            Llantas para minicargador
                            <span class="ml-2 text-xs">▾</span>
                        </a>

                        <ul class="pointer-events-none absolute left-0 top-[49px] z-[999] min-w-[220px] translate-y-[-10px] border border-[#dadada] bg-black opacity-0 shadow-[0_10px_30px_rgba(45,45,45,0.20)] transition duration-300 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
                            <li>
                                <a href="{{ url('/tipo-de-llanta/neumatica') }}" class="block whitespace-nowrap bg-black px-[15px] py-[15px] font-[Lato] text-[17px] font-medium text-white transition hover:bg-[#ee5a35]">
                                    Neumática
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/tipo-de-llanta/solida') }}" class="block whitespace-nowrap bg-black px-[15px] py-[15px] font-[Lato] text-[17px] font-medium text-white transition hover:bg-[#ee5a35]">
                                    Sólida
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="https://llantasdemontacargas.com/tienda-en-linea/?swoof=1&product_cat=llantas-minicargadores" target="_blank" rel="noopener" class="flex h-[49px] items-center px-5 font-[Lato] text-[17px] font-medium text-white transition hover:text-[#ee5a35]">
                            Compra en línea
                        </a>
                    </li>

                    <li>
                        <a href="https://llantasparaminicargadores.com/" target="_blank" rel="noopener" class="flex h-[49px] items-center px-5 font-[Lato] text-[17px] font-medium text-white transition hover:text-[#ee5a35]">
                            Llantas para minicargadores
                        </a>
                    </li>

                    <li>
                        <a href="#contacto" class="flex h-[49px] items-center px-5 font-[Lato] text-[17px] font-medium text-white transition hover:text-[#ee5a35]">
                            Contacto
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- WhatsApp button desktop --}}
            <div class="hidden w-[16%] justify-end lg:flex">
                <a
                    href="https://wa.me/528332395885"
                    target="_blank"
                    rel="noopener"
                    class="inline-flex rounded-[3px] bg-[#01a300] px-6 py-3 text-[15px] font-medium leading-[15px] text-white transition hover:bg-[#018a00]"
                >
                    Contactar WhatsApp
                </a>
            </div>

            {{-- Mobile button --}}
            <div class="ml-auto flex items-center gap-3 lg:hidden">
                <a
                    href="https://wa.me/528332395885"
                    target="_blank"
                    rel="noopener"
                    class="rounded-[3px] bg-[#01a300] px-4 py-2 text-[13px] font-semibold text-white"
                >
                    WhatsApp
                </a>

                <button
                    type="button"
                    class="js-mobile-menu-button inline-flex h-10 w-10 items-center justify-center border border-white/30 text-white"
                    aria-label="Abrir menú"
                >
                    ☰
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div class="js-mobile-menu hidden border-t border-white/10 bg-black lg:hidden">
            <nav class="mx-auto max-w-[1200px] px-4 py-4">
                <ul class="space-y-1">
                    <li>
                        <span class="block px-3 py-2 text-[15px] font-semibold text-white">
                            Llantas para minicargador
                        </span>

                        <div class="ml-3 border-l border-white/20">
                            <a href="{{ url('/tipo-de-llanta/neumatica') }}" class="block px-3 py-2 text-white hover:text-[#ee5a35]">
                                Neumática
                            </a>
                            <a href="{{ url('/tipo-de-llanta/solida') }}" class="block px-3 py-2 text-white hover:text-[#ee5a35]">
                                Sólida
                            </a>
                        </div>
                    </li>

                    <li>
                        <a href="https://llantasdemontacargas.com/tienda-en-linea/?swoof=1&product_cat=llantas-minicargadores" target="_blank" rel="noopener" class="block px-3 py-2 text-white hover:text-[#ee5a35]">
                            Compra en línea
                        </a>
                    </li>

                    <li>
                        <a href="https://llantasparaminicargadores.com/" target="_blank" rel="noopener" class="block px-3 py-2 text-white hover:text-[#ee5a35]">
                            Llantas para minicargadores
                        </a>
                    </li>

                    <li>
                        <a href="#contacto" class="block px-3 py-2 text-white hover:text-[#ee5a35]">
                            Contacto
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

{{-- FOOTER --}}
<footer id="contacto" class="bg-black text-white">
    <div class="mx-auto grid max-w-[1200px] gap-10 px-4 py-14 lg:grid-cols-[1fr_1fr_1.15fr]">
        {{-- Columna marca --}}
        <div>
            <x-optimized-image
                src="https://cdn-fnckj.nitrocdn.com/OEigyWnrTCqTXTtoxkmZdbSZZjfcgSQv/assets/images/optimized/rev-47f8cd9/llantasbobcat.com/wp-content/uploads/2022/03/ruguex-llantas-para-montacargas-distrubuidor-trelleborg.png"
                alt="Ruguex"
                class="h-auto max-w-[234px]"
                width="234"
                height="90"
            />

            <p class="mt-5 text-[15px] leading-7 text-white/75">
                Llantas sólidas y neumáticas para minicargadores Bobcat.
                Te ayudamos a seleccionar la medida adecuada para tu equipo.
            </p>

            <div class="mt-6 rounded-[6px] border border-white/10 bg-white/[0.04] p-5">
                <h3 class="text-[18px] font-bold text-white">
                    Matriz Puebla
                </h3>

                <p class="mt-3 text-[14px] leading-6 text-white/75">
                    Atención comercial y técnica para selección, cotización y seguimiento de llantas Bobcat.
                </p>
            </div>
        </div>

        {{-- Columna enlaces --}}
        <div>
            <h3 class="mb-5 text-[22px] font-bold text-white">
                Enlaces
            </h3>

            <ul class="space-y-3 text-[15px] text-white/80">
                <li>
                    <a href="{{ url('/') }}" class="transition hover:text-[#ee5a35]">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="{{ url('/tipo-de-llanta/neumatica') }}" class="transition hover:text-[#ee5a35]">
                        Llantas neumáticas para Bobcat
                    </a>
                </li>

                <li>
                    <a href="{{ url('/tipo-de-llanta/solida') }}" class="transition hover:text-[#ee5a35]">
                        Llantas sólidas para Bobcat
                    </a>
                </li>

                <li>
                    <a href="#selector-bobcat" class="transition hover:text-[#ee5a35]">
                        Buscar llanta por modelo Bobcat
                    </a>
                </li>

                <li>
                    <a href="https://llantasdemontacargas.com/tienda-en-linea/?swoof=1&product_cat=llantas-minicargadores" target="_blank" rel="noopener" class="transition hover:text-[#ee5a35]">
                        Compra en línea
                    </a>
                </li>

                <li>
                    <a href="#cotizacion" class="transition hover:text-[#ee5a35]">
                        Solicitar cotización
                    </a>
                </li>
            </ul>

            <div class="mt-7 rounded-[6px] border border-white/10 bg-white/[0.04] p-5">
                <h3 class="text-[17px] font-bold text-white">
                    Almacenes con entrega y montaje
                </h3>

                <div class="mt-4 grid grid-cols-2 gap-x-6 gap-y-2 text-[14px] font-semibold uppercase text-white/85">
                    <span>EDOMEX</span>
                    <span>Puebla</span>
                    <span>Guanajuato</span>
                    <span>Nuevo León</span>
                    <span>San Luis Potosí</span>
                    <span>Jalisco</span>
                    <span>Aguascalientes</span>
                </div>

                <p class="mt-4 text-[14px] leading-6 text-white/70">
                    Consulta stock, disponibilidad y servicio de montaje para tu zona.
                </p>
            </div>
        </div>

        {{-- Columna contacto --}}
        <div>
            <h3 class="mb-5 text-[28px] font-bold text-white">
                Contacto
            </h3>

            <div class="space-y-4 text-[15px] text-white/85">
                <a href="mailto:ventas@llantasdemontacargas.com" class="flex items-start gap-3 transition hover:text-[#ee5a35]">
                    <span class="mt-[2px] text-[#ee5a35]">✉</span>
                    <span>ventas@llantasdemontacargas.com</span>
                </a>

                <div class="flex items-start gap-3">
                    <span class="mt-[2px] text-[#ee5a35]">⌖</span>
                    <span>
                        Avenida 125 Oriente #224, Guadalupe Hidalgo. Puebla. C.P. 72494.
                    </span>
                </div>
            </div>

            <div class="mt-6 grid gap-3 text-[16px] font-bold text-white">
                <a href="tel:8332462205" class="flex items-center gap-3 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(83)3246-2205</span>
                </a>

                <a href="tel:8332395885" class="flex items-center gap-3 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(83)3239-5885</span>
                </a>

                <a href="tel:2222273866" class="flex items-center gap-3 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(22)2227-3866</span>
                </a>

                <a href="tel:5951124238" class="flex items-center gap-3 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(59)5112-4238</span>
                </a>

                <a href="tel:5557521715" class="flex items-center gap-3 transition hover:text-[#ee5a35]">
                    <span class="text-[#ee5a35]">☎</span>
                    <span>(55)5752-1715</span>
                </a>
            </div>

            <a
                href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20llantas%20para%20Bobcat."
                target="_blank"
                rel="noopener"
                class="mt-6 inline-flex rounded-[3px] bg-[#01a300] px-6 py-3 text-[15px] font-bold leading-[15px] text-white transition hover:bg-[#018a00]"
            >
                Contactar WhatsApp
            </a>

            <div class="mt-7 overflow-hidden rounded-[6px] border border-white/10 bg-white/[0.04]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3773.012410584409!2d-98.2339686!3d18.975059299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cfb9e29c3d4487%3A0xc2a3504712bafde7!2sRUGUEX!5e0!3m2!1ses!2smx!4v1782329547879!5m2!1ses!2smx"
                    width="600"
                    height="260"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                    class="h-[260px] w-full"
                    title="Ubicación Ruguex Puebla"
                ></iframe>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 py-4">
        <div class="mx-auto flex max-w-[1200px] flex-col gap-2 px-4 text-center text-[13px] text-white/60 md:flex-row md:items-center md:justify-between md:text-left">
            <p>
                © {{ date('Y') }} Llantas Bobcat. Todos los derechos reservados.
            </p>

            <p>
                Ruguex | Llantas para montacargas y minicargadores
            </p>
        </div>
    </div>
</footer>

    {{-- Floating WhatsApp --}}
<x-whatsapp-chat />

</body>
</html>