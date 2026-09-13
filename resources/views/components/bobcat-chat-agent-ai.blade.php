@props([
    'title' => 'Agente virtual Ruguex',
])

<div
    x-data="bobcatAiChat"
    x-init="init()"
    class="fixed bottom-24 right-5 z-[9998]"
>
    <div
        x-show="!isOpen"
        class="flex items-end justify-end gap-3"
        style="display: none;"
    >
        <div
            x-show="showPreview"
            x-transition
            class="relative w-[250px] rounded-2xl bg-white px-5 py-4 text-slate-800 shadow-[0_12px_35px_rgba(0,0,0,0.20)]"
            style="display: none;"
        >
            <button
                type="button"
                @click.stop="showPreview = false"
                class="absolute right-3 top-2 text-2xl leading-none text-slate-500 transition hover:text-slate-800"
                aria-label="Cerrar vista previa"
            >
                &times;
            </button>

            <button
                type="button"
                @click="openChat"
                class="block w-full text-left"
            >
                <p class="pr-6 text-[15px] font-medium leading-7 text-slate-800">
                    ¿Qué llanta necesitas para tu Bobcat?
                </p>
            </button>
        </div>

        <button
            type="button"
            @click="openChat"
            class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#8b0000] text-white shadow-[0_12px_35px_rgba(0,0,0,0.35)] transition hover:scale-105"
            aria-label="Abrir chat"
        >
            <img
                src="{{ asset('img/chat/logo-rgx.png') }}"
                alt="Ruguex"
                class="h-full w-full object-cover"
                loading="lazy"
            >
        </button>
    </div>

    <div
        x-show="isOpen"
        x-transition
        class="flex h-[500px] w-[310px] max-w-[calc(100vw-18px)] flex-col overflow-hidden rounded-[20px] bg-white shadow-[0_18px_46px_rgba(0,0,0,0.30)] sm:h-[520px] sm:w-[320px]"
        style="display: none;"
    >
        <div class="flex items-center justify-between bg-[#8b0000] px-3.5 py-3 text-white">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-black">
                    <img
                        src="{{ asset('img/chat/logo-rgx.jpg') }}"
                        alt="Ruguex"
                        class="h-full w-full object-cover"
                        loading="lazy"
                    >
                </div>

                <div>
                    <p class="text-sm font-bold leading-none">
                        {{ $title }}
                    </p>

                    <div class="mt-1 flex items-center gap-2 text-xs text-white/90">
                        <span class="inline-block h-2.5 w-2.5 rounded-full bg-green-400"></span>
                        <span>En línea</span>
                    </div>
                </div>
            </div>

            <button
                type="button"
                @click="closeChat"
                class="text-[28px] leading-none text-white/90 transition hover:text-white"
                aria-label="Cerrar chat"
            >
                &times;
            </button>
        </div>

        <div
            x-ref="messagesContainer"
            class="flex-1 space-y-3 overflow-y-auto bg-[#f5f5f5] px-3 py-3"
        >
            <template
                x-for="message in messages"
                :key="message.id"
            >
                <div>
                    <template x-if="message.role === 'bot'">
                        <div class="flex items-end gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-black">
                                <img
                                    src="{{ asset('img/chat/logo-rgx.jpg') }}"
                                    alt="Ruguex"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >
                            </div>

                            <div class="max-w-[82%] rounded-[14px] rounded-bl-md bg-white px-3.5 py-2.5 text-slate-800 shadow-sm">
                                <p
                                    class="whitespace-pre-line text-[14px] leading-6"
                                    x-text="message.text"
                                ></p>

                                <template x-if="message.product && message.product.url">
                                    <div class="mt-3 overflow-hidden rounded-2xl border border-slate-200 bg-white">
                                        <img
                                            x-show="message.product.image"
                                            :src="message.product.image"
                                            :alt="message.product.title || 'Producto Ruguex'"
                                            class="h-32 w-full bg-slate-100 object-contain p-2"
                                            loading="lazy"
                                        >

                                        <div class="p-3">
                                            <p
                                                class="text-[11px] font-semibold uppercase tracking-[0.12em] text-slate-500"
                                                x-text="message.product.measure || message.product.model || ''"
                                            ></p>

                                            <p
                                                class="mt-1 text-sm font-bold leading-5 text-slate-900"
                                                x-text="message.product.title"
                                            ></p>

                                            <p
                                                x-show="message.product.sku"
                                                class="mt-2 text-xs text-slate-500"
                                            >
                                                SKU:
                                                <span x-text="message.product.sku"></span>
                                            </p>

                                            <p
                                                class="mt-2 text-base font-extrabold text-[#8b0000]"
                                                x-text="message.product.price_label || 'Consultar precio'"
                                            ></p>

                                            <p
                                                class="mt-1 text-xs font-semibold text-slate-600"
                                                x-text="message.product.is_in_stock ? 'En stock' : 'Consultar disponibilidad'"
                                            ></p>

                                            <a
                                                :href="message.product.url"
                                                @click="trackStoreClick(message.product)"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="mt-3 block rounded-full bg-[#8b0000] px-4 py-2.5 text-center text-sm font-bold text-white transition hover:bg-[#6e0000]"
                                            >
                                                Ver producto en tienda &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="message.quote && message.quote.folio">
                                    <div class="mt-3 rounded-2xl border border-[#8b0000]/20 bg-white p-3">
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.12em] text-slate-500">
                                            Cotización formal
                                        </p>

                                        <p class="mt-2 text-sm text-slate-700">
                                            Folio:
                                            <span
                                                class="font-bold text-slate-900"
                                                x-text="message.quote.folio"
                                            ></span>
                                        </p>

                                        <p
                                            x-show="message.quote.total_label"
                                            class="mt-2 text-base font-extrabold text-[#8b0000]"
                                            x-text="message.quote.total_label"
                                        ></p>

                                        <a
                                            x-show="message.quote.pdf_url"
                                            :href="message.quote.pdf_url"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="mt-3 block rounded-full bg-[#8b0000] px-4 py-2.5 text-center text-sm font-bold text-white transition hover:bg-[#6e0000]"
                                        >
                                            Ver cotización PDF &rarr;
                                        </a>
                                    </div>
                                </template>

                                <template x-if="message.advisorContact">
                                    <div class="mt-3 rounded-2xl border border-slate-200 bg-white p-3">
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.12em] text-slate-500">
                                            Atención con especialista
                                        </p>

                                        <p
                                            x-show="message.advisorContact.business_hours"
                                            class="mt-2 text-sm leading-5 text-slate-600"
                                        >
                                            Puedes comunicarte ahora o dejar tus datos para que un especialista te contacte.
                                        </p>

                                        <p
                                            x-show="!message.advisorContact.business_hours"
                                            class="mt-2 text-sm leading-5 text-slate-600"
                                        >
                                            Estamos fuera del horario de atención inmediata. Puedes dejar tus datos para recibir seguimiento.
                                        </p>

                                        <div class="mt-3 space-y-2">
                                            <a
                                                x-show="message.advisorContact.business_hours && message.advisorContact.whatsapp_url"
                                                :href="message.advisorContact.whatsapp_url"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="block rounded-full bg-[#25D366] px-4 py-2.5 text-center text-sm font-bold text-white"
                                            >
                                                WhatsApp
                                            </a>

                                            <a
                                                x-show="message.advisorContact.business_hours && message.advisorContact.tel_url"
                                                :href="message.advisorContact.tel_url"
                                                class="block rounded-full border border-[#8b0000] bg-white px-4 py-2.5 text-center text-sm font-bold text-[#8b0000]"
                                            >
                                                Llamar
                                                <span
                                                    x-show="message.advisorContact.phone_display"
                                                    x-text="message.advisorContact.phone_display"
                                                ></span>
                                            </a>

                                            <button
                                                x-show="message.advisorContact.callback_available"
                                                type="button"
                                                @click="requestAdvisorCallback()"
                                                :disabled="isChatting"
                                                class="w-full rounded-full bg-[#8b0000] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#6e0000] disabled:cursor-not-allowed disabled:opacity-60"
                                            >
                                                Que me contacten
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <template x-if="message.role === 'user'">
                        <div class="flex justify-end">
                            <div class="max-w-[78%] rounded-[14px] rounded-br-md bg-[#111827] px-3.5 py-2.5 text-white shadow-sm">
                                <p
                                    class="whitespace-pre-line text-[14px] font-medium leading-6"
                                    x-text="message.text"
                                ></p>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <div
                x-show="isChatting"
                class="flex items-end gap-3"
            >
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-black text-xs font-bold text-white">
                    RG
                </div>

                <div class="rounded-[14px] rounded-bl-md bg-white px-3.5 py-2.5 shadow-sm">
                    <div class="flex items-center gap-1.5">
                        <span class="h-2.5 w-2.5 animate-bounce rounded-full bg-slate-400"></span>
                        <span class="h-2.5 w-2.5 animate-bounce rounded-full bg-slate-400 [animation-delay:0.15s]"></span>
                        <span class="h-2.5 w-2.5 animate-bounce rounded-full bg-slate-400 [animation-delay:0.3s]"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200 bg-white p-3">
            <form
                @submit.prevent="sendChatMessage()"
                class="flex items-center gap-2"
            >
                <input
                    x-model="chatInput"
                    type="text"
                    maxlength="1200"
                    :disabled="isChatting"
                    placeholder="Escribe tu mensaje..."
                    autocomplete="off"
                    class="min-w-0 flex-1 rounded-full border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#8b0000] disabled:cursor-not-allowed disabled:opacity-60"
                >

                <button
                    type="submit"
                    :disabled="isChatting || !chatInput.trim()"
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#8b0000] text-white transition hover:bg-[#6e0000] disabled:cursor-not-allowed disabled:opacity-50"
                    aria-label="Enviar mensaje"
                >
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </form>

            <button
                type="button"
                @click="restart()"
                :disabled="isChatting"
                class="mt-2 w-full text-center text-xs font-semibold text-slate-500 transition hover:text-[#8b0000] disabled:opacity-50"
            >
                Reiniciar conversación
            </button>
        </div>
    </div>
</div>
