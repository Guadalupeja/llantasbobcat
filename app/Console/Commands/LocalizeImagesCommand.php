<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LocalizeImagesCommand extends Command
{
    protected $signature = 'images:localize
        {--quality=82 : Calidad del WebP}
        {--force : Descargar aunque ya exista}';

    protected $description = 'Descarga imágenes remotas del sitio y genera versiones locales optimizadas.';

    private array $allowedHosts = [
        'llantasbobcat.com',
        'cdn-fnckj.nitrocdn.com',
        'llantasdemontacargas.com',
    ];

    public function handle(): int
    {
        $urls = $this->collectImageUrls();

        if (empty($urls)) {
            $this->warn('No encontré URLs remotas de imágenes.');
            return self::SUCCESS;
        }

        $this->info('Imágenes encontradas: ' . count($urls));

        File::ensureDirectoryExists(public_path('images/migrated/originals'));
        File::ensureDirectoryExists(public_path('images/migrated/webp'));

        $manifest = [];

        foreach ($urls as $url) {
            try {
                $result = $this->downloadAndOptimize($url);

                if ($result) {
                    $manifest[$url] = $result;
                    $this->line('OK: ' . $url);
                }
            } catch (\Throwable $e) {
                $this->error('ERROR: ' . $url);
                $this->line($e->getMessage());
            }
        }

        $this->writeManifest($manifest);

        $this->info('Manifest creado en resources/data/local-images.php');
        $this->info('Listo. Ahora actualiza tus vistas para usar <x-optimized-image>.');

        return self::SUCCESS;
    }

    private function collectImageUrls(): array
    {
        $paths = [
            resource_path('data'),
            resource_path('views'),
        ];

        $urls = [];

        foreach ($paths as $path) {
            if (! File::exists($path)) {
                continue;
            }

            foreach (File::allFiles($path) as $file) {
                $content = File::get($file->getPathname());

                preg_match_all(
                    '/https?:\/\/[^\s\'")<>]+?\.(?:jpg|jpeg|png|webp|gif)(?:\?[^\s\'")<>]*)?/i',
                    $content,
                    $matches
                );

                foreach ($matches[0] ?? [] as $match) {
                    $cleanUrl = html_entity_decode($match, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $cleanUrl = rtrim($cleanUrl, '.');

                    if ($this->isAllowedImage($cleanUrl)) {
                        $urls[] = $cleanUrl;
                    }
                }
            }
        }

        return collect($urls)
            ->unique()
            ->values()
            ->all();
    }

    private function isAllowedImage(string $url): bool
    {
        $host = parse_url($url, PHP_URL_HOST);

        return in_array($host, $this->allowedHosts, true);
    }

    private function downloadAndOptimize(string $url): ?array
    {
        $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH) ?? '');
        $extension = strtolower($pathInfo['extension'] ?? 'jpg');

        if (! in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            $extension = 'jpg';
        }

        $baseName = Str::slug($pathInfo['filename'] ?? md5($url));

        if (blank($baseName)) {
            $baseName = md5($url);
        }

        $hash = substr(md5($url), 0, 8);
        $fileName = "{$baseName}-{$hash}.{$extension}";
        $webpName = "{$baseName}-{$hash}.webp";

        $originalPath = public_path("images/migrated/originals/{$fileName}");
        $webpPath = public_path("images/migrated/webp/{$webpName}");

        if (! File::exists($originalPath) || $this->option('force')) {
            $response = Http::timeout(30)
                ->retry(2, 500)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 RuguexImageMigrator/1.0',
                ])
                ->get($url);

            if (! $response->successful()) {
                throw new \RuntimeException('HTTP ' . $response->status());
            }

            File::put($originalPath, $response->body());
        }

        $this->createWebp($originalPath, $webpPath, (int) $this->option('quality'));

        return [
            'original_url' => $url,
            'fallback_path' => "images/migrated/originals/{$fileName}",
            'fallback_url' => asset("images/migrated/originals/{$fileName}"),
            'webp_path' => File::exists($webpPath) ? "images/migrated/webp/{$webpName}" : null,
            'webp_url' => File::exists($webpPath) ? asset("images/migrated/webp/{$webpName}") : null,
        ];
    }

    private function createWebp(string $sourcePath, string $targetPath, int $quality): void
    {
        if (! function_exists('imagewebp')) {
            return;
        }

        $contents = @file_get_contents($sourcePath);

        if (! $contents) {
            return;
        }

        $image = @imagecreatefromstring($contents);

        if (! $image) {
            return;
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        @imagewebp($image, $targetPath, max(60, min(95, $quality)));

        imagedestroy($image);
    }

    private function writeManifest(array $manifest): void
    {
        ksort($manifest);

        $export = var_export($manifest, true);

        File::put(
            resource_path('data/local-images.php'),
            "<?php\n\nreturn {$export};\n"
        );
    }
}