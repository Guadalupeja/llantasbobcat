<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class RgxAssistantAdapterController extends Controller
{
    public function __invoke(
        Request $request
    ): JsonResponse {
        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:1200',
            ],

            'conversation_id' => [
                'required',
                'uuid',
            ],

            'history' => [
                'sometimes',
                'array',
                'max:8',
            ],

            'history.*.role' => [
                'required_with:history',
                'string',
                'in:user,assistant',
            ],

            'history.*.text' => [
                'required_with:history',
                'string',
                'max:1200',
            ],
        ]);

        $coreUrl = rtrim(
            trim(
                (string) config(
                    'services.ruguex_core.url',
                    ''
                )
            ),
            '/'
        );

        $token = trim(
            (string) config(
                'services.ruguex_core.token',
                ''
            )
        );

        if (
            $coreUrl === ''
            || strlen($token) < 32
        ) {
            return response()->json([
                'error' => 'El asistente no está disponible en este momento.',
            ], 503);
        }

        $scope = $this->conversationScope(
            $request
        );

        $timeout = (int) config(
            'services.ruguex_core.timeout',
            30
        );

        $timeout = max(
            5,
            min(
                $timeout,
                90
            )
        );

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->withToken($token)
                ->connectTimeout(10)
                ->timeout($timeout)
                ->post(
                    $coreUrl
                        .'/api/rgx-assistant/v1/message',
                    [
                        'message' => $validated['message'],

                        'conversation_id' => $validated[
                                'conversation_id'
                            ],

                        /*
                         * Autoridad server-side.
                         * Nunca se toma del body.
                         */
                        'scope' => $scope,

                        'history' => $validated['history']
                            ?? [],
                    ]
                );
        } catch (
            ConnectionException
            |RequestException
            |Throwable $exception
        ) {
            Log::error(
                'RGX assistant adapter error',
                [
                    'exception' => $exception::class,
                ]
            );

            return response()->json([
                'error' => 'El asistente no pudo responder en este momento.',
            ], 502);
        }

        if (! $response->successful()) {
            Log::warning(
                'RGX assistant core non-success response',
                [
                    'status' => $response->status(),
                ]
            );

            return response()->json([
                'error' => 'El asistente no pudo responder en este momento.',
            ], 502);
        }

        $payload = $response->json();

        if (! is_array($payload)) {
            return response()->json([
                'error' => 'El asistente devolvió una respuesta inválida.',
            ], 502);
        }

        return response()->json(
            $payload
        );
    }

    private function conversationScope(
        Request $request
    ): string {
        $scope = $request
            ->session()
            ->get(
                'rgx_chatbot.adapter_scope'
            );

        if (
            ! is_string($scope)
            || ! Str::isUuid($scope)
        ) {
            $scope =
                (string) Str::uuid();

            $request
                ->session()
                ->put(
                    'rgx_chatbot.adapter_scope',
                    $scope
                );
        }

        return $scope;
    }
}
