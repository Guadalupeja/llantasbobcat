<?php

namespace Tests\Feature;

use Tests\TestCase;

class RgxAssistantFrontendTest extends TestCase
{
    public function test_layout_mounts_ai_chat_and_keeps_whatsapp(): void
    {
        $layout = file_get_contents(
            resource_path(
                'views/layouts/app.blade.php'
            )
        );

        $this->assertIsString($layout);

        $this->assertStringContainsString(
            'meta name="csrf-token"',
            $layout
        );

        $this->assertStringContainsString(
            '<x-bobcat-chat-agent-ai />',
            $layout
        );

        $this->assertStringContainsString(
            '<x-whatsapp-chat />',
            $layout
        );
    }

    public function test_browser_frontend_uses_only_same_origin_adapter(): void
    {
        $service = file_get_contents(
            resource_path(
                'js/services/rgx-assistant-api.js'
            )
        );

        $app = file_get_contents(
            resource_path(
                'js/app.js'
            )
        );

        $blade = file_get_contents(
            resource_path(
                'views/components/bobcat-chat-agent-ai.blade.php'
            )
        );

        $this->assertIsString($service);
        $this->assertIsString($app);
        $this->assertIsString($blade);

        $this->assertStringContainsString(
            "'/chat-ruguex/message'",
            $service
        );

        $browserSources =
            $service
            ."\n"
            .$app
            ."\n"
            .$blade;

        $this->assertStringNotContainsString(
            'RGX_ASSISTANT_CORE_TOKEN',
            $browserSources
        );

        $this->assertStringNotContainsString(
            '/api/rgx-assistant/v1/message',
            $browserSources
        );

        $this->assertStringNotContainsString(
            '127.0.0.1:8018',
            $browserSources
        );

        $this->assertStringNotContainsString(
            'Bearer ',
            $browserSources
        );
    }
}
