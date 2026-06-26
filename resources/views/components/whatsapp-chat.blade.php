@php
    $whatsappNumber = '528332395885';
    $defaultText = 'Hola RUGUEX, quiero cotizar llantas para Bobcat.';
    $encodedDefaultText = rawurlencode($defaultText);
@endphp

<div class="fixed bottom-5 right-5 z-[9999] font-sans">
    <div
        id="ruguex-whatsapp-panel"
        class="hidden w-[310px] overflow-hidden rounded-[18px] bg-white shadow-[0_12px_35px_rgba(0,0,0,.28)] sm:w-[340px]"
    >
        <div class="flex items-start gap-3 bg-[#ff6001] p-4 text-white">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-black text-[10px] font-black">
                RUGUEX
            </div>

            <div class="min-w-0 flex-1">
                <p class="text-[15px] font-black leading-5">RUGUEX</p>
                <p class="mt-1 flex items-center gap-2 text-[12px] leading-4 text-white/90">
                    <span class="h-2 w-2 rounded-full bg-[#20e070]"></span>
                    Normalmente responde en cuestión de minutos.
                </p>
            </div>

            <button
                type="button"
                id="ruguex-whatsapp-close"
                class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 text-[20px] leading-none text-white transition hover:bg-white/25"
                aria-label="Cerrar chat de WhatsApp"
            >
                ×
            </button>
        </div>

        <div class="bg-[#f7f7f7] p-4">
            <div class="rounded-[12px] bg-[#eaffd8] p-4 text-[14px] leading-6 text-black shadow-sm">
                ¿Tienes alguna pregunta? Estoy encantado de poder ayudarte.
            </div>

            <a
                href="https://wa.me/{{ $whatsappNumber }}?text={{ $encodedDefaultText }}"
                target="_blank"
                rel="noopener"
                data-whatsapp-location="chat_widget_panel"
                data-whatsapp-text="{{ $defaultText }}"
                class="mt-4 flex w-full items-center justify-center rounded-[16px] bg-[#20d366] px-5 py-4 text-[15px] font-black text-white transition hover:bg-[#16b956]"
            >
                Enviar WhatsApp
            </a>

            <div class="mt-4 flex items-center justify-center gap-2 text-[11px] text-[#777]">
                <span class="h-2 w-2 rounded-full bg-[#20d366]"></span>
                <span>En línea</span>
                <span>|</span>
                <span>Privacidad protegida</span>
            </div>
        </div>
    </div>

    <button
        type="button"
        id="ruguex-whatsapp-toggle"
        class="mt-3 flex h-12 items-center justify-center gap-3 rounded-full bg-[#f1f1f1] px-5 text-[14px] font-medium text-[#333] shadow-[0_4px_18px_rgba(0,0,0,.22)] transition hover:bg-white"
        aria-label="Abrir chat de WhatsApp"
    >
<span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#25D366]">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 32 32"
        class="h-4 w-4 fill-white"
        aria-hidden="true"
    >
        <path d="M16.04 3C8.86 3 3.02 8.82 3.02 15.98c0 2.29.6 4.53 1.74 6.5L3 29l6.69-1.72a13.02 13.02 0 0 0 6.35 1.62h.01c7.17 0 13.01-5.82 13.01-12.98S23.22 3 16.04 3Zm0 23.7h-.01c-1.92 0-3.8-.52-5.44-1.49l-.39-.23-3.97 1.02 1.06-3.86-.25-.4a10.76 10.76 0 0 1-1.66-5.76c0-5.95 4.87-10.79 10.86-10.79 2.9 0 5.63 1.13 7.68 3.17a10.72 10.72 0 0 1 3.18 7.62c0 5.95-4.87 10.78-10.86 10.78Zm5.95-8.07c-.33-.16-1.94-.95-2.24-1.06-.3-.11-.52-.16-.74.16-.22.33-.85 1.06-1.04 1.28-.19.22-.38.25-.71.08-.33-.16-1.38-.51-2.63-1.62-.97-.86-1.63-1.93-1.82-2.26-.19-.33-.02-.51.14-.67.15-.15.33-.38.49-.57.16-.19.22-.33.33-.55.11-.22.05-.41-.03-.57-.08-.16-.74-1.77-1.01-2.43-.27-.64-.54-.55-.74-.56h-.63c-.22 0-.57.08-.87.41-.3.33-1.14 1.11-1.14 2.71s1.17 3.14 1.33 3.36c.16.22 2.3 3.5 5.57 4.91.78.34 1.39.54 1.86.69.78.25 1.49.21 2.05.13.63-.09 1.94-.79 2.21-1.55.27-.76.27-1.42.19-1.55-.08-.14-.3-.22-.63-.38Z" />
    </svg>
</span>
        <span>Cotiza por WhatsApp</span>
        <span class="hidden h-8 w-8 items-center justify-center rounded-full bg-black text-[8px] font-black text-[#ff6001] sm:flex">
            RUGUEX
        </span>
    </button>
</div>

@once
    <script>
        window.dataLayer = window.dataLayer || [];

        function ruguexTrack(eventName, payload) {
            window.dataLayer.push(Object.assign({
                event: eventName,
                page_path: window.location.pathname,
                page_title: document.title || '',
                site_section: 'llantas_bobcat'
            }, payload || {}));
        }

        document.addEventListener('DOMContentLoaded', function () {
            const panel = document.getElementById('ruguex-whatsapp-panel');
            const toggle = document.getElementById('ruguex-whatsapp-toggle');
            const close = document.getElementById('ruguex-whatsapp-close');

            if (toggle && panel) {
                toggle.addEventListener('click', function () {
                    panel.classList.toggle('hidden');

                    ruguexTrack('whatsapp_widget_open', {
                        whatsapp_location: 'floating_button'
                    });
                });
            }

            if (close && panel) {
                close.addEventListener('click', function () {
                    panel.classList.add('hidden');
                });
            }

            document.addEventListener('click', function (event) {
                const link = event.target.closest('a[href*="wa.me"], a[href*="api.whatsapp.com"]');

                if (! link) {
                    return;
                }

                ruguexTrack('whatsapp_click', {
                    whatsapp_location: link.dataset.whatsappLocation || 'site_link',
                    whatsapp_text: link.dataset.whatsappText || '',
                    link_url: link.href
                });
            }, true);
        });
    </script>
@endonce