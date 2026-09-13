export async function sendRgxAssistantMessage({
    message,
    history = [],
    conversationId = '',
    csrfToken = '',
}) {
    const response = await fetch(
        '/chat-ruguex/message',
        {
            method: 'POST',
            credentials: 'same-origin',

            headers: {
                'Content-Type':
                    'application/json',

                'Accept':
                    'application/json',

                'X-CSRF-TOKEN':
                    csrfToken,

                'X-Requested-With':
                    'XMLHttpRequest',
            },

            body: JSON.stringify({
                message,
                history,
                conversation_id:
                    conversationId,
            }),
        }
    );

    let data = {};

    try {
        data = await response.json();
    } catch {
        throw new Error(
            'El servidor devolvió una respuesta inválida.'
        );
    }

    if (!response.ok) {
        if (data.errors) {
            const firstError =
                Object.values(
                    data.errors
                )?.[0]?.[0];

            throw new Error(
                firstError
                || data.message
                || 'No fue posible enviar el mensaje.'
            );
        }

        throw new Error(
            data.error
            || data.message
            || 'El asistente no pudo responder.'
        );
    }

    if (
        typeof data.answer !== 'string'
        || !data.answer.trim()
    ) {
        throw new Error(
            'El asistente devolvió una respuesta vacía.'
        );
    }

    return {
        answer:
            data.answer,

        product:
            data.product ?? null,

        quote:
            data.quote ?? null,

        advisorContact:
            data.advisor_contact ?? null,

        advisorRequest:
            data.advisor_request ?? null,
    };
}
