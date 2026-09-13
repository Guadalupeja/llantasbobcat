import {
    sendRgxAssistantMessage,
} from '../services/rgx-assistant-api';

export default function bobcatAiChat() {
    return {
        isOpen: false,
        showPreview: true,
        messages: [],
        chatInput: '',
        isChatting: false,
        claudeHistory: [],
        conversationId: null,
        chatStartedTracked: false,
        trackedProductKeys: [],
        trackedQuoteKeys: [],
        advisorSubmissionTracked: false,

        init() {
            this.restart();
        },

        newConversationId() {
            if (
                window.crypto
                && typeof window.crypto.randomUUID
                    === 'function'
            ) {
                return window.crypto.randomUUID();
            }

            const bytes =
                new Uint8Array(16);

            window.crypto.getRandomValues(
                bytes
            );

            bytes[6] =
                (bytes[6] & 0x0f) | 0x40;

            bytes[8] =
                (bytes[8] & 0x3f) | 0x80;

            const hex =
                Array.from(bytes)
                    .map(
                        value =>
                            value
                                .toString(16)
                                .padStart(2, '0')
                    );

            return [
                hex.slice(0, 4).join(''),
                hex.slice(4, 6).join(''),
                hex.slice(6, 8).join(''),
                hex.slice(8, 10).join(''),
                hex.slice(10, 16).join(''),
            ].join('-');
        },

        csrfToken() {
            return document
                .querySelector(
                    'meta[name="csrf-token"]'
                )
                ?.getAttribute('content')
                || '';
        },

        openChat() {
            this.isOpen = true;
            this.showPreview = false;
            this.trackChatStarted();
            this.scrollToBottom();
        },

        closeChat() {
            this.isOpen = false;
            this.showPreview = true;
        },

        restart() {
            this.messages = [];
            this.chatInput = '';
            this.isChatting = false;
            this.claudeHistory = [];
            this.conversationId =
                this.newConversationId();

            this.chatStartedTracked = false;
            this.trackedProductKeys = [];
            this.trackedQuoteKeys = [];
            this.advisorSubmissionTracked =
                false;

            this.bot(
                'Hola. Soy el asistente virtual de RUGUEX. '
                + 'Cuéntame qué llanta necesitas para tu minicargador Bobcat. '
                + 'Puedes decirme el tipo de llanta, medida, modelo o equipo.'
            );

            if (this.isOpen) {
                this.trackChatStarted();
            }
        },

        bot(
            text,
            product = null,
            quote = null,
            advisorContact = null,
            advisorRequest = null
        ) {
            this.messages.push({
                id:
                    this.newConversationId(),

                role:
                    'bot',

                text,
                product,
                quote,
                advisorContact,
                advisorRequest,
            });

            this.scrollToBottom();
        },

        user(text) {
            this.messages.push({
                id:
                    this.newConversationId(),

                role:
                    'user',

                text,
            });

            this.scrollToBottom();
        },

        async sendChatMessage() {
            if (this.isChatting) {
                return;
            }

            const message =
                this.chatInput?.trim() || '';

            if (!message) {
                return;
            }

            const history =
                this.claudeHistory
                    .slice(-8);

            this.user(message);

            this.chatInput = '';
            this.isChatting = true;

            try {
                const {
                    answer,
                    product,
                    quote,
                    advisorContact,
                    advisorRequest,
                } =
                    await sendRgxAssistantMessage({
                        message,
                        history,

                        conversationId:
                            this.conversationId,

                        csrfToken:
                            this.csrfToken(),
                    });

                this.bot(
                    answer,
                    product,
                    quote,
                    advisorContact,
                    advisorRequest
                );

                this.trackProductResolved(
                    product
                );

                this.trackQuoteGenerated(
                    quote,
                    product
                );

                this.trackAdvisorSubmitted(
                    advisorRequest
                );

                this.claudeHistory.push(
                    {
                        role:
                            'user',

                        text:
                            message,
                    },
                    {
                        role:
                            'assistant',

                        text:
                            answer,
                    }
                );

                this.claudeHistory =
                    this.claudeHistory
                        .slice(-8);
            } catch (error) {
                this.bot(
                    error?.message
                    || 'No pude responder en este momento. Intenta nuevamente.'
                );
            } finally {
                this.isChatting = false;
                this.scrollToBottom();
            }
        },

        requestAdvisorCallback() {
            if (this.isChatting) {
                return;
            }

            this.chatInput =
                'Prefiero dejar mis datos para que un especialista me contacte.';

            this.sendChatMessage();
        },

        pushChatbotEvent(
            event,
            product = null
        ) {
            const allowedEvents = [
                'rgx_chatbot_started',
                'rgx_chatbot_product_resolved',
                'rgx_chatbot_store_click',
                'rgx_chatbot_quote_generated',
                'rgx_chatbot_specialist_submitted',
            ];

            if (
                !allowedEvents.includes(
                    event
                )
            ) {
                return;
            }

            const payload = {
                event,
                brand:
                    'RUGUEX',

                channel:
                    'Chatbot IA',
            };

            const productId =
                Number(
                    product?.product_id
                );

            if (
                Number.isInteger(
                    productId
                )
                && productId > 0
                && [
                    'rgx_chatbot_product_resolved',
                    'rgx_chatbot_store_click',
                    'rgx_chatbot_quote_generated',
                ].includes(event)
            ) {
                payload.product_id =
                    productId;
            }

            window.dataLayer =
                window.dataLayer || [];

            window.dataLayer.push(
                payload
            );
        },

        trackChatStarted() {
            if (
                this.chatStartedTracked
            ) {
                return;
            }

            this.chatStartedTracked =
                true;

            this.pushChatbotEvent(
                'rgx_chatbot_started'
            );
        },

        trackProductResolved(
            product
        ) {
            if (!product) {
                return;
            }

            const key =
                String(
                    product.product_id
                    || product.url
                    || ''
                ).trim();

            if (
                !key
                || this.trackedProductKeys
                    .includes(key)
            ) {
                return;
            }

            this.trackedProductKeys
                .push(key);

            this.pushChatbotEvent(
                'rgx_chatbot_product_resolved',
                product
            );
        },

        trackStoreClick(
            product
        ) {
            this.pushChatbotEvent(
                'rgx_chatbot_store_click',
                product
            );
        },

        trackQuoteGenerated(
            quote,
            product = null
        ) {
            const key =
                String(
                    quote?.folio || ''
                ).trim();

            if (
                !key
                || this.trackedQuoteKeys
                    .includes(key)
            ) {
                return;
            }

            this.trackedQuoteKeys
                .push(key);

            this.pushChatbotEvent(
                'rgx_chatbot_quote_generated',
                product
            );
        },

        trackAdvisorSubmitted(
            advisorRequest
        ) {
            if (
                this.advisorSubmissionTracked
                || advisorRequest?.status
                    !== 'submitted'
            ) {
                return;
            }

            this.advisorSubmissionTracked =
                true;

            this.pushChatbotEvent(
                'rgx_chatbot_specialist_submitted'
            );
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container =
                    this.$refs
                        .messagesContainer;

                if (container) {
                    container.scrollTop =
                        container.scrollHeight;
                }
            });
        },
    };
}
