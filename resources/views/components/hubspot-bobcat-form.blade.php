<section id="cotizacion" class="bg-[#ff6001] px-4 py-14 text-white">
    <div class="mx-auto max-w-[1200px]">
        <div class="mx-auto max-w-[920px] text-center">
            <p class="text-[14px] font-bold uppercase tracking-wide text-white/80">
                Cotización Ruguex
            </p>

            <h2 class="mt-2 text-[34px] font-bold leading-10 md:text-[42px] md:leading-[50px]">
                ¿Necesitas ayuda para elegir la llanta correcta?
            </h2>

            <p class="mx-auto mt-4 max-w-[820px] text-[18px] leading-8 text-white/90">
                Déjanos tus datos y un especialista Ruguex te ayudará a confirmar medida, tipo de llanta y compatibilidad para tu minicargador Bobcat.
            </p>
        </div>

        <div class="mx-auto mt-10 max-w-[980px] rounded-[8px] bg-black p-5 shadow-2xl md:p-8">
            <div id="hubspot-bobcat-form" class="hubspot-bobcat-form min-h-[360px]">
                <div id="hubspot-bobcat-loading" class="flex min-h-[320px] items-center justify-center text-center">
                    <div>
                        <p class="text-[20px] font-bold text-white">
                            Cargando formulario de cotización...
                        </p>
                        <p class="mt-2 text-[14px] text-white/65">
                            En unos segundos podrás enviar tus datos.
                        </p>
                    </div>
                </div>
            </div>

            <noscript>
                <p class="text-white">
                    Para cargar el formulario necesitas activar JavaScript. También puedes cotizar por WhatsApp:
                    <a class="font-bold underline" href="https://wa.me/528332395885">
                        Contactar Ruguex
                    </a>
                </p>
            </noscript>
        </div>
    </div>
</section>

@once
    @push('meta')
        <style>
            .hubspot-bobcat-form form {
                max-width: 100% !important;
            }

            .hubspot-bobcat-form label,
            .hubspot-bobcat-form legend,
            .hubspot-bobcat-form .hs-form-field > label,
            .hubspot-bobcat-form .hs-error-msg,
            .hubspot-bobcat-form .hs-main-font-element {
                color: #ffffff !important;
                font-weight: 700 !important;
            }

            .hubspot-bobcat-form input,
            .hubspot-bobcat-form select,
            .hubspot-bobcat-form textarea {
                width: 100% !important;
                min-height: 46px !important;
                border: 1px solid rgba(255,255,255,.25) !important;
                background: #ffffff !important;
                color: #111111 !important;
                border-radius: 0 !important;
                padding: 10px 12px !important;
                font-size: 15px !important;
            }

            .hubspot-bobcat-form textarea {
                min-height: 110px !important;
            }

            .hubspot-bobcat-form .hs-button,
            .hubspot-bobcat-form input[type="submit"] {
                width: auto !important;
                min-width: 180px !important;
                border: 0 !important;
                background: #ff6001 !important;
                color: #ffffff !important;
                font-weight: 900 !important;
                padding: 14px 26px !important;
                cursor: pointer !important;
                transition: .2s ease !important;
            }

            .hubspot-bobcat-form .hs-button:hover,
            .hubspot-bobcat-form input[type="submit"]:hover {
                background: #ffffff !important;
                color: #000000 !important;
            }

            .hubspot-bobcat-form .hs-error-msgs {
                margin-top: 5px !important;
            }

            .hubspot-bobcat-form .submitted-message {
                color: #ffffff !important;
                font-size: 20px !important;
                font-weight: 800 !important;
                line-height: 1.5 !important;
            }
        </style>
    @endpush

    <script>
        window.dataLayer = window.dataLayer || [];

        function ruguexLoadHubSpotBobcatForm() {
            const target = document.getElementById('hubspot-bobcat-form');

            if (!target || target.dataset.loaded === 'true') {
                return;
            }

            target.dataset.loaded = 'true';

            function createHubSpotForm() {
                if (!window.hbspt || !window.hbspt.forms) {
                    target.dataset.loaded = 'false';
                    return;
                }

                const loading = document.getElementById('hubspot-bobcat-loading');

                if (loading) {
                    loading.remove();
                }

                window.hbspt.forms.create({
                    region: 'na1',
                    portalId: '7547674',
                    formId: 'f8177bc5-6a7b-4364-92a4-1731bef2ecdd',
                    target: '#hubspot-bobcat-form',

                    onFormReady: function () {
                        window.dataLayer.push({
                            event: 'hubspot_form_ready',
                            form_id: 'f8177bc5-6a7b-4364-92a4-1731bef2ecdd',
                            form_name: 'Formulario Bobcat Ruguex',
                            page_path: window.location.pathname,
                            page_title: document.title || '',
                            site_section: 'llantas_bobcat'
                        });
                    },

                    onFormSubmitted: function () {
                        window.dataLayer.push({
                            event: 'generate_lead',
                            lead_source: 'hubspot_form',
                            form_id: 'f8177bc5-6a7b-4364-92a4-1731bef2ecdd',
                            form_name: 'Formulario Bobcat Ruguex',
                            page_path: window.location.pathname,
                            page_title: document.title || '',
                            site_section: 'llantas_bobcat'
                        });
                    }
                });
            }

            if (window.hbspt && window.hbspt.forms) {
                createHubSpotForm();
                return;
            }

            const existingScript = document.querySelector('script[src*="js.hsforms.net/forms/embed/v2.js"]');

            if (existingScript) {
                existingScript.addEventListener('load', createHubSpotForm, { once: true });
                return;
            }

            const script = document.createElement('script');
            script.src = 'https://js.hsforms.net/forms/embed/v2.js';
            script.charset = 'utf-8';
            script.type = 'text/javascript';
            script.async = true;
            script.onload = createHubSpotForm;
            script.onerror = function () {
                target.innerHTML = `
                    <div class="rounded-[6px] border border-white/20 bg-white/10 p-6 text-center">
                        <p class="text-[22px] font-bold text-white">No se pudo cargar el formulario.</p>
                        <p class="mt-2 text-white/75">Puedes cotizar directamente por WhatsApp y un asesor Ruguex te atenderá.</p>
                        <a
                            href="https://wa.me/528332395885?text=Hola%20RUGUEX,%20quiero%20cotizar%20llantas%20para%20Bobcat."
                            target="_blank"
                            rel="noopener"
                            class="mt-5 inline-flex bg-[#01a300] px-6 py-3 text-[15px] font-bold text-white"
                        >
                            Cotizar por WhatsApp
                        </a>
                    </div>
                `;
            };

            document.body.appendChild(script);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const formSection = document.getElementById('cotizacion');

            if (!formSection) {
                return;
            }

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            ruguexLoadHubSpotBobcatForm();
                            observer.disconnect();
                        }
                    });
                }, {
                    rootMargin: '350px 0px'
                });

                observer.observe(formSection);
            } else {
                setTimeout(ruguexLoadHubSpotBobcatForm, 1500);
            }
        });
    </script>
@endonce 