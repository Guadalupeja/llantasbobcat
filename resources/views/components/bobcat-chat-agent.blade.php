@php
    use Carbon\Carbon;
    use App\Services\RuguexPriceService;

    $now = Carbon::now('America/Mexico_City');
    $isBusinessHours = $now->isWeekday() && $now->hour >= 9 && $now->hour < 18;

    $storeProducts = collect(require resource_path('data/store-products.php'));
    $storeProducts = app(RuguexPriceService::class)->applyTo($storeProducts);

    $normalizeSize = function (?string $size) {
        $size = trim((string) $size);
        $size = str_replace(['×', 'x'], 'X', $size);
        $size = preg_replace('/\s+/', '', $size);

        if (str_contains($size, '10-16.5') || str_contains($size, '10X16.5') || str_contains($size, '31X10-20')) {
            return '10-16.5';
        }

        if (str_contains($size, '12-16.5') || str_contains($size, '12X16.5') || str_contains($size, '33X12-20')) {
            return '12-16.5';
        }

  
        return null;
    };

    $normalizeType = function (?string $type) {
        $value = str($type ?? '')->lower()->ascii()->toString();

        if (str_contains($value, 'solida') || str_contains($value, 'sólida')) {
            return 'solida';
        }

        if (str_contains($value, 'neumatica') || str_contains($value, 'neumática')) {
            return 'neumatica';
        }

        return null;
    };

    $chatProducts = [
        'solida' => [
            '10-16.5' => [],
            '12-16.5' => [],
        ],
        'neumatica' => [
            '10-16.5' => [],
            '12-16.5' => [],
        ],
    ];

    foreach ($storeProducts as $item) {
        $type = $normalizeType($item['tire_type'] ?? null);

        if (! $type) {
            continue;
        }

        foreach (($item['sizes'] ?? []) as $size) {
            $normalizedSize = $normalizeSize($size);

            if (! $normalizedSize) {
                continue;
            }

            $chatProducts[$type][$normalizedSize][] = [
                'label' => $item['name'] ?? 'Llanta para Bobcat',
                'description' => trim(($item['brand'] ?? 'Ruguex') . ' ' . (($item['line'] ?? '') ?: '')),
                'price' => ! empty($item['price_label'])
                    ? str_replace(' MXN IVA incluido', ' MXN · IVA incluido', $item['price_label'])
                    : 'Precio bajo consulta',
                'image' => $item['image'] ?? '',
                'url' => $item['url'] ?? '#',
                'whatsapp_text' => 'Hola RUGUEX, quiero cotizar ' . ($item['name'] ?? 'una llanta para Bobcat') . '.',
            ];
        }
    }

    $chatProductsJson = json_encode($chatProducts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $whatsappNumber = '528332395885';
    $agentLogo = asset('icons/android-chrome-192x192.png');
    $isBusinessHours = $now->isWeekday() && $now->hour >= 8 && $now->hour < 18;
@endphp

<div
    x-data="ruguexBobcatAgent({{ $chatProductsJson }}, {{ $isBusinessHours ? 'true' : 'false' }})"
    class="fixed bottom-5 left-5 z-[9998] font-sans"
>
    <div
        x-show="isOpen"
        x-transition
        class="mb-3 flex h-[610px] w-[340px] max-w-[calc(100vw-24px)] flex-col overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-[0_18px_50px_rgba(15,23,42,.24)]"
        style="display: none;"
    >
        <div class="bg-[#ff6001] px-4 py-4 text-white">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-black ring-2 ring-white/30">
                        <img
                            src="{{ asset('icons/android-chrome-192x192.png') }}"
                            alt="Ruguex"
                            class="h-full w-full object-cover"
                        >
                    </div>

                    <div>
                        <p class="text-[15px] font-black uppercase leading-none">Agente Ruguex</p>
                        <p class="mt-1 text-[12px] text-white/90">Asistente para llantas Bobcat</p>
                    </div>
                </div>

                <button
                    type="button"
                    @click="isOpen = false"
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 text-[20px] leading-none text-white hover:bg-white/25"
                    aria-label="Cerrar agente virtual"
                >
                    ×
                </button>
            </div>
        </div>

        <div
            x-ref="messagesContainer"
            class="flex-1 space-y-4 overflow-y-auto bg-[#f5f7fb] px-4 py-4"
        >
            <template x-for="message in messages" :key="message.id">
                <div>
                    <template x-if="message.type === 'bot' && message.kind === 'text'">
                        <div class="flex items-start gap-2">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-full bg-black ring-1 ring-[#ff6001]/40">
                        <img
                            src="{{ $agentLogo }}"
                            alt="Ruguex"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >
                    </div>

                            <div class="max-w-[82%] rounded-[16px] rounded-tl-md bg-white px-4 py-3 text-[14px] leading-6 text-slate-800 shadow-sm">
                                <p x-text="message.text"></p>
                            </div>
                        </div>
                    </template>

                    <template x-if="message.type === 'bot' && message.kind === 'options'">
                        <div class="flex items-start gap-2">
<div class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-full bg-black ring-1 ring-[#ff6001]/40">
    <img
        src="{{ $agentLogo }}"
        alt="Ruguex"
        class="h-full w-full object-cover"
        loading="lazy"
    >
</div>

                            <div class="max-w-[88%] rounded-[16px] rounded-tl-md bg-white px-4 py-3 shadow-sm">
                                <p class="text-[14px] leading-6 text-slate-800" x-text="message.text"></p>

                                <div class="mt-3 flex flex-wrap gap-2">
                                    <template x-for="option in message.options" :key="option.label">
                                        <button
                                            type="button"
                                            class="rounded-full border border-slate-300 bg-white px-4 py-2 text-[13px] font-semibold text-slate-700 transition hover:border-[#ff6001] hover:text-[#ff6001] disabled:cursor-not-allowed disabled:opacity-50"
                                            :disabled="option.disabled"
                                            @click="handleOption(option)"
                                        >
                                            <span x-text="option.label"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="message.type === 'bot' && message.kind === 'products'">
                        <div class="flex items-start gap-2">
<div class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-full bg-black ring-1 ring-[#ff6001]/40">
    <img
        src="{{ $agentLogo }}"
        alt="Ruguex"
        class="h-full w-full object-cover"
        loading="lazy"
    >
</div>

                            <div class="max-w-[88%] rounded-[16px] rounded-tl-md bg-white px-4 py-3 shadow-sm" :data-product-block="message.blockId">
                                <p class="text-[14px] leading-6 text-slate-800" x-text="message.text"></p>

                                <div class="mt-3 space-y-3">
                                    <template x-for="product in message.products" :key="product.url">
                                        <a
                                            :href="product.url"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="block overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:border-[#ff6001] hover:shadow-md"
                                            @click="trackProductClick(product)"
                                        >
                                            <div class="flex h-[145px] items-center justify-center bg-slate-100 p-3">
                                                <img
                                                    :src="product.image"
                                                    :alt="product.label"
                                                    class="max-h-[120px] w-auto object-contain"
                                                    loading="lazy"
                                                >
                                            </div>

                                            <div class="p-4">
                                                <p class="text-sm font-bold text-slate-900" x-text="product.label"></p>
                                                <p class="mt-2 text-sm leading-6 text-slate-600" x-text="product.description"></p>
                                                <p class="mt-3 text-sm font-black text-[#ff6001]" x-text="product.price"></p>

                                                <span class="mt-3 inline-flex items-center text-sm font-semibold text-[#ff6001]">
                                                    Ver producto →
                                                </span>
                                            </div>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="message.type === 'user'">
                        <div class="flex justify-end">
                            <div class="max-w-[78%] rounded-[16px] rounded-br-md bg-[#111827] px-4 py-3 text-white shadow-sm">
                                <p class="text-[14px] font-medium leading-6" x-text="message.text"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <template x-if="isTyping">
                <div class="flex items-start gap-2">
<div class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-full bg-black ring-1 ring-[#ff6001]/40">
    <img
        src="{{ $agentLogo }}"
        alt="Ruguex"
        class="h-full w-full object-cover"
        loading="lazy"
    >
</div>

                    <div class="rounded-[16px] rounded-tl-md bg-white px-4 py-3 shadow-sm">
                        <div class="flex gap-1">
                            <span class="h-2.5 w-2.5 animate-bounce rounded-full bg-slate-400"></span>
                            <span class="h-2.5 w-2.5 animate-bounce rounded-full bg-slate-400 [animation-delay:.15s]"></span>
                            <span class="h-2.5 w-2.5 animate-bounce rounded-full bg-slate-400 [animation-delay:.3s]"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>



<div
    x-show="showForm"
    x-transition
    class="border-t border-slate-200 bg-white p-4"
    style="display: none;"
>
    <form class="space-y-3" @submit.prevent="submitQuoteForm">
        <div>
            <label class="mb-1 block text-[12px] font-bold text-slate-700">Nombre</label>
            <input
                type="text"
                x-model="leadForm.nombre"
                required
                class="h-10 w-full rounded-lg border border-slate-300 px-3 text-[14px] outline-none focus:border-[#ff6001]"
            >
        </div>

        <div>
            <label class="mb-1 block text-[12px] font-bold text-slate-700">Empresa</label>
            <input
                type="text"
                x-model="leadForm.empresa"
                class="h-10 w-full rounded-lg border border-slate-300 px-3 text-[14px] outline-none focus:border-[#ff6001]"
            >
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="mb-1 block text-[12px] font-bold text-slate-700">Tipo de llanta</label>
                <input
                    type="text"
                    x-model="leadForm.tipo_llanta"
                    readonly
                    class="h-10 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-[14px]"
                >
            </div>

            <div>
                <label class="mb-1 block text-[12px] font-bold text-slate-700">Medida</label>
                <input
                    type="text"
                    x-model="leadForm.medida"
                    readonly
                    class="h-10 w-full rounded-lg border border-slate-300 bg-slate-100 px-3 text-[14px]"
                >
            </div>
        </div>

        <div>
            <label class="mb-1 block text-[12px] font-bold text-slate-700">Teléfono</label>
            <input
                type="tel"
                x-model="leadForm.telefono"
                required
                class="h-10 w-full rounded-lg border border-slate-300 px-3 text-[14px] outline-none focus:border-[#ff6001]"
            >
        </div>

        <div>
            <label class="mb-1 block text-[12px] font-bold text-slate-700">Correo</label>
            <input
                type="email"
                x-model="leadForm.correo"
                required
                class="h-10 w-full rounded-lg border border-slate-300 px-3 text-[14px] outline-none focus:border-[#ff6001]"
            >
        </div>

        <div>
            <label class="mb-1 block text-[12px] font-bold text-slate-700">Mensaje</label>
            <textarea
                x-model="leadForm.mensaje"
                rows="3"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-[14px] outline-none focus:border-[#ff6001]"
                placeholder="Cuéntanos si tienes modelo Bobcat, cantidad o dudas de medida."
            ></textarea>
        </div>

        <template x-if="formMessage">
            <p class="rounded-lg bg-slate-100 px-3 py-2 text-[13px] font-semibold text-slate-700" x-text="formMessage"></p>
        </template>

        <div class="grid grid-cols-2 gap-3">
            <button
                type="button"
                @click="showForm = false"
                class="h-11 rounded-lg border border-slate-300 text-[14px] font-bold text-slate-700"
            >
                Cancelar
            </button>

            <button
                type="submit"
                :disabled="isSubmitting"
                class="h-11 rounded-lg bg-[#ff6001] text-[14px] font-black text-white disabled:cursor-not-allowed disabled:opacity-60"
            >
                <span x-show="!isSubmitting">Enviar solicitud</span>
                <span x-show="isSubmitting">Enviando...</span>
            </button>
        </div>
    </form>
</div>


        <div class="border-t border-slate-200 bg-white px-4 py-3">
            <p class="text-center text-[11px] text-slate-500">
                El agente te ayuda a encontrar productos. Para disponibilidad final, compra en línea o cotiza.
            </p>
        </div>
    </div>

    <button
        type="button"
        @click="toggleAgent"
        class="flex items-center gap-3 rounded-full bg-black px-5 py-3 text-[14px] font-bold text-white shadow-[0_12px_30px_rgba(0,0,0,.25)] transition hover:-translate-y-0.5 hover:bg-[#ff6001]"
        aria-label="Abrir agente virtual Ruguex"
    >
        <span class="flex h-8 w-8 items-center justify-center overflow-hidden rounded-full bg-white">
            <img
                src="{{ asset('icons/android-chrome-192x192.png') }}"
                alt="Ruguex"
                class="h-full w-full object-cover"
            >
        </span>

        <span>Agente virtual Ruguex</span>
    </button>
</div>

@once
    @push('scripts')
        <script>
            function ruguexBobcatAgent(products, isBusinessHours) {
                return {
                    products,
                    isBusinessHours,
                    isOpen: false,
                    messages: [],
                    isTyping: false,
                    selectedType: null,
                    selectedMeasure: null,

                    showForm: false,
isSubmitting: false,
formMessage: '',
leadForm: {
    nombre: '',
    empresa: '',
    tipo_llanta: '',
    medida: '',
    telefono: '',
    correo: '',
    mensaje: '',
},

                    toggleAgent() {
                        this.isOpen = !this.isOpen;

                        if (this.isOpen && this.messages.length === 0) {
                            this.startConversation();
                        }

                        window.dataLayer = window.dataLayer || [];
                        window.dataLayer.push({
                            event: 'chat_ruguex_open',
                            site_section: 'llantas_bobcat',
                        });
                    },

showQuoteForm() {
    this.showForm = true;
    this.formMessage = '';

    this.leadForm.tipo_llanta = this.selectedType === 'solida' ? 'Sólida' : 'Neumática';

    const measureLabels = {
        '10-16.5': '10-16.5 (31X10-20/7.5)',
        '12-16.5': '12-16.5 (33X12-20/7.5)',
    };

    this.leadForm.medida = measureLabels[this.selectedMeasure] || this.selectedMeasure || '';

    this.addBotMessage('Perfecto. Llena tus datos y enviaremos tu solicitud al equipo de ventas Ruguex.');

    this.scrollToBottom();
},

async submitQuoteForm() {
    this.isSubmitting = true;
    this.formMessage = '';

    try {
        const response = await fetch('{{ route('chat.ruguex.lead.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                ...this.leadForm,
                origen: 'chat_ruguex_bobcat',
            }),
        });

        const data = await response.json();

        if (!response.ok || !data.ok) {
            throw new Error(data.message || 'No fue posible enviar tu solicitud.');
        }

        this.formMessage = data.message || 'Gracias. En breve será contactado por ventas.';
        this.showForm = false;

        this.addBotMessage('Gracias. Ya enviamos tu solicitud al equipo de ventas Ruguex.');

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'generate_lead',
            lead_source: 'chat_ruguex_bobcat',
            form_name: 'Chat Ruguex Bobcat',
            tipo_llanta: this.leadForm.tipo_llanta,
            medida: this.leadForm.medida,
            page_path: window.location.pathname,
            page_title: document.title || '',
            site_section: 'llantas_bobcat',
        });
    } catch (error) {
        this.formMessage = error.message || 'No fue posible enviar tu solicitud. Intenta nuevamente.';
    } finally {
        this.isSubmitting = false;
        this.scrollToBottom();
    }
},


                    async startConversation() {
                        await this.botReply(() => {
                            this.addBotMessage('¡Hola! Soy el agente virtual de Ruguex. Te ayudo a encontrar llantas para Bobcat.');
                        });

                        await this.botReply(() => {
                            this.addBotOptions('Primero dime qué tipo de llanta necesitas:', [
                                { label: 'Sólida', value: 'solida', action: 'type' },
                                { label: 'Neumática', value: 'neumatica', action: 'type' },
                            ]);
                        });
                    },

                    async handleOption(option) {
                        this.disableCurrentOptions();
                        this.addUserMessage(option.label);

                        if (option.action === 'type') {
                            this.selectedType = option.value;

                            await this.botReply(() => {
                                this.addBotOptions('Perfecto. Ahora dime qué medida necesitas:', [
                                    { label: '10-16.5', value: '10-16.5', action: 'measure' },
                                    { label: '12-16.5', value: '12-16.5', action: 'measure' },
                                ]);
                            });

                            return;
                        }

                        if (option.action === 'measure') {
                            this.selectedMeasure = option.value;

                            const currentProducts = this.products?.[this.selectedType]?.[this.selectedMeasure] ?? [];
                            let productBlockId = null;

                            await this.botReply(() => {
                                if (currentProducts.length > 0) {
                                    this.addBotMessage('Estas opciones están disponibles con precio real de tienda:');
                                    productBlockId = this.addBotProducts(currentProducts);
                                } else {
                                    this.addBotMessage('No encontré productos cargados para esa combinación. Podemos ayudarte por cotización.');
                                }
                            }, 'none');

                            if (productBlockId) {
                                this.scrollToProductBlock(productBlockId);
                            }

                            setTimeout(() => {
                                this.addBotOptions('¿Qué quieres hacer ahora?', this.getFinalActions(), false);
                            }, 400);

                            return;
                        }

                        if (option.action === 'final_action') {
                            if (option.value === 'restart') {
                                this.selectedType = null;
                                this.selectedMeasure = null;
                                await this.startConversation();
                                return;
                            }

                            if (option.value === 'quote') {
    this.showQuoteForm();
    return;
}

                            if (option.value === 'whatsapp') {
                                if (!this.isBusinessHours) {
                                    this.addBotMessage('Nuestro horario de atención por WhatsApp es de lunes a viernes de 9:00 a 18:00.');
                                    return;
                                }

                                window.dataLayer = window.dataLayer || [];
                                window.dataLayer.push({
                                    event: 'chat_whatsapp_click',
                                    tipo_llanta: this.selectedType,
                                    medida: this.selectedMeasure,
                                    source: 'chat_ruguex_bobcat',
                                    site_section: 'llantas_bobcat',
                                });

                                const text = encodeURIComponent(`Hola RUGUEX, necesito ayuda con llantas Bobcat ${this.selectedType || ''} medida ${this.selectedMeasure || ''}.`);
                                window.open(`https://wa.me/{{ $whatsappNumber }}?text=${text}`, '_blank', 'noopener,noreferrer');
                            }
                        }
                    },

            getFinalActions() {
                const actions = [
                    { label: 'Solicitar cotización', value: 'quote', action: 'final_action' },
                    { label: 'Buscar otra medida', value: 'restart', action: 'final_action' },
                ];

                if (this.isBusinessHours) {
                    actions.splice(1, 0, {
                        label: 'Hablar con asesor por WhatsApp',
                        value: 'whatsapp',
                        action: 'final_action'
                    });
                }

                return actions;
            },

                    addBotMessage(text) {
                        this.messages.push({
                            id: Date.now() + Math.random(),
                            type: 'bot',
                            kind: 'text',
                            text,
                        });

                        this.scrollToBottom();
                    },

                    addBotOptions(text, options, shouldScroll = true) {
                        this.messages.push({
                            id: Date.now() + Math.random(),
                            type: 'bot',
                            kind: 'options',
                            text,
                            options: options.map(option => ({
                                ...option,
                                disabled: false,
                            })),
                        });

                        if (shouldScroll) {
                            this.scrollToBottom();
                        }
                    },

                    addBotProducts(products) {
                        const productBlockId = 'products-' + Date.now();

                        this.messages.push({
                            id: Date.now() + Math.random(),
                            type: 'bot',
                            kind: 'products',
                            text: 'Da clic en la opción que deseas revisar.',
                            products,
                            blockId: productBlockId,
                        });

                        return productBlockId;
                    },

                    addUserMessage(text) {
                        this.messages.push({
                            id: Date.now() + Math.random(),
                            type: 'user',
                            kind: 'text',
                            text,
                        });

                        this.scrollToBottom();
                    },

                    disableCurrentOptions() {
                        const lastMessage = this.messages[this.messages.length - 1];

                        if (lastMessage && lastMessage.kind === 'options') {
                            lastMessage.options = lastMessage.options.map(option => ({
                                ...option,
                                disabled: true,
                            }));
                        }
                    },

                    async botReply(callback, scrollMode = 'bottom') {
                        this.isTyping = true;
                        this.scrollToBottom();

                        await new Promise(resolve => setTimeout(resolve, 650));

                        this.isTyping = false;
                        callback();

                        if (scrollMode === 'bottom') {
                            this.scrollToBottom();
                        }
                    },

                    scrollToBottom() {
                        this.$nextTick(() => {
                            const container = this.$refs.messagesContainer;

                            if (container) {
                                container.scrollTop = container.scrollHeight;
                            }
                        });
                    },

                    scrollToProductBlock(blockId) {
                        this.$nextTick(() => {
                            setTimeout(() => {
                                const container = this.$refs.messagesContainer;
                                const element = container?.querySelector(`[data-product-block="${blockId}"]`);

                                if (container && element) {
                                    container.scrollTo({
                                        top: Math.max(element.offsetTop - 6, 0),
                                        behavior: 'smooth',
                                    });
                                }
                            }, 80);
                        });
                    },

                    trackProductClick(product) {
                        window.dataLayer = window.dataLayer || [];
                        window.dataLayer.push({
                            event: 'selector_producto_click',
                            tipo_llanta: this.selectedType,
                            medida: this.selectedMeasure,
                            opcion: product.label,
                            url: product.url,
                            site_section: 'llantas_bobcat',
                        });
                    }
                }
            }
        </script>
    @endpush
@endonce