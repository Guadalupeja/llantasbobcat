<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request as HttpRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class RgxAssistantAdapterTest extends TestCase
{
    private string $token =
        'test-bobcat-adapter-private-token-0000000001';

    private function configureCore(): void
    {
        config()->set(
            'services.ruguex_core.url',
            'https://core.example.test'
        );

        config()->set(
            'services.ruguex_core.token',
            $this->token
        );

        config()->set(
            'services.ruguex_core.timeout',
            30
        );
    }

    private function payload(): array
    {
        return [
            'message' => 'Busco una llanta 10-16.5 para Bobcat.',

            'conversation_id' => '550e8400-e29b-41d4-a716-446655440000',

            'history' => [],
        ];
    }

    public function test_adapter_route_uses_web_middleware_for_same_origin_protection(): void
    {
        $route = app('router')
            ->getRoutes()
            ->getByName(
                'chat.ruguex.message'
            );

        $this->assertNotNull(
            $route
        );

        $middleware =
            $route->gatherMiddleware();

        /*
         * La ruta vive en routes/web.php.
         * Por eso conserva sesión y la protección
         * CSRF same-origin del grupo web.
         */
        $this->assertContains(
            'web',
            $middleware
        );

        $this->assertContains(
            'throttle:12,5',
            $middleware
        );
    }

    public function test_adapter_generates_private_scope_and_ignores_browser_authority(): void
    {
        $this->configureCore();

        Http::fake([
            'https://core.example.test/api/rgx-assistant/v1/message' => Http::response([
                'answer' => 'Respuesta del Core.',

                'product' => null,

                'quote' => null,

                'advisor_contact' => null,

                'advisor_request' => null,
            ], 200),
        ]);

        $payload = $this->payload();

        /*
         * Datos maliciosos que jamás deben
         * cruzar hacia el Core.
         */
        $payload['scope'] =
            '550e8400-e29b-41d4-a716-446655440099';

        $payload['site_id'] =
            'montacargas';

        $payload['site_origin'] =
            'evil.example';

        $payload['default_vertical'] =
            'montacargas';

        $response = $this->postJson(
            '/chat-ruguex/message',
            $payload
        );

        $response
            ->assertOk()
            ->assertJsonPath(
                'answer',
                'Respuesta del Core.'
            );

        $scope = session(
            'rgx_chatbot.adapter_scope'
        );

        $this->assertIsString($scope);
        $this->assertTrue(
            Str::isUuid($scope)
        );

        $this->assertNotSame(
            $payload['scope'],
            $scope
        );

        Http::assertSent(
            function (
                HttpRequest $request
            ) use ($scope): bool {
                $data = $request->data();

                $this->assertSame(
                    $this->token,
                    $request->header(
                        'Authorization'
                    )[0]
                        ? substr(
                            $request->header(
                                'Authorization'
                            )[0],
                            7
                        )
                        : null
                );

                $this->assertSame(
                    $scope,
                    $data['scope']
                );

                $this->assertSame(
                    '550e8400-e29b-41d4-a716-446655440000',
                    $data['conversation_id']
                );

                $this->assertArrayNotHasKey(
                    'site_id',
                    $data
                );

                $this->assertArrayNotHasKey(
                    'site_origin',
                    $data
                );

                $this->assertArrayNotHasKey(
                    'default_vertical',
                    $data
                );

                return true;
            }
        );
    }

    public function test_adapter_reuses_same_scope_within_session(): void
    {
        $this->configureCore();

        $scopes = [];

        Http::fake(
            function (
                HttpRequest $request
            ) use (&$scopes) {
                $scopes[] =
                    $request->data()['scope'];

                return Http::response([
                    'answer' => 'OK',
                    'product' => null,
                    'quote' => null,
                    'advisor_contact' => null,
                    'advisor_request' => null,
                ], 200);
            }
        );

        $this->postJson(
            '/chat-ruguex/message',
            $this->payload()
        )->assertOk();

        $this->postJson(
            '/chat-ruguex/message',
            $this->payload()
        )->assertOk();

        $this->assertCount(
            2,
            $scopes
        );

        $this->assertSame(
            $scopes[0],
            $scopes[1]
        );

        $this->assertTrue(
            Str::isUuid(
                $scopes[0]
            )
        );
    }

    public function test_adapter_fails_closed_without_private_configuration(): void
    {
        config()->set(
            'services.ruguex_core.url',
            ''
        );

        config()->set(
            'services.ruguex_core.token',
            ''
        );

        Http::fake();

        $this
            ->postJson(
                '/chat-ruguex/message',
                $this->payload()
            )
            ->assertStatus(503);

        Http::assertNothingSent();
    }

    public function test_adapter_maps_core_failure_without_exposing_response(): void
    {
        $this->configureCore();

        Http::fake([
            '*' => Http::response([
                'error' => 'Detalle interno sensible.',
            ], 500),
        ]);

        $this
            ->postJson(
                '/chat-ruguex/message',
                $this->payload()
            )
            ->assertStatus(502)
            ->assertExactJson([
                'error' => 'El asistente no pudo responder en este momento.',
            ]);
    }
}
