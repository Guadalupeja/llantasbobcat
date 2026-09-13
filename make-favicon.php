<?php

$source = __DIR__ . '/public/images/migrated/originals/ruguex-llantas-para-montacargas-distrubuidor-trelleborg-ab9cb209.png';

$outputDir = __DIR__ . '/public/icons';

if (! file_exists($source)) {
    exit("No existe la imagen fuente: {$source}\n");
}

if (! is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

$raw = file_get_contents($source);
$image = imagecreatefromstring($raw);

if (! $image) {
    exit("No se pudo abrir la imagen fuente.\n");
}

$width = imagesx($image);
$height = imagesy($image);

function makeIcon($image, $width, $height, $size, $path)
{
    $canvas = imagecreatetruecolor($size, $size);

    imagealphablending($canvas, true);
    imagesavealpha($canvas, true);

    // Fondo negro Ruguex
    $black = imagecolorallocate($canvas, 0, 0, 0);
    imagefilledrectangle($canvas, 0, 0, $size, $size, $black);

    // Padding para que el logo no toque los bordes
    $padding = (int) round($size * 0.12);

    $maxWidth = $size - ($padding * 2);
    $maxHeight = $size - ($padding * 2);

    // Escalar el logo completo, sin recortarlo
    $scale = min($maxWidth / $width, $maxHeight / $height);

    $newWidth = (int) round($width * $scale);
    $newHeight = (int) round($height * $scale);

    $dstX = (int) round(($size - $newWidth) / 2);
    $dstY = (int) round(($size - $newHeight) / 2);

    imagecopyresampled(
        $canvas,
        $image,
        $dstX,
        $dstY,
        0,
        0,
        $newWidth,
        $newHeight,
        $width,
        $height
    );

    imagepng($canvas, $path, 9);
    imagedestroy($canvas);
}

makeIcon($image, $width, $height, 16, $outputDir . '/favicon-16x16.png');
makeIcon($image, $width, $height, 32, $outputDir . '/favicon-32x32.png');
makeIcon($image, $width, $height, 48, $outputDir . '/favicon-48x48.png');
makeIcon($image, $width, $height, 96, $outputDir . '/favicon-96x96.png');
makeIcon($image, $width, $height, 180, $outputDir . '/apple-touch-icon.png');
makeIcon($image, $width, $height, 192, $outputDir . '/android-chrome-192x192.png');
makeIcon($image, $width, $height, 512, $outputDir . '/android-chrome-512x512.png');

// Para favicon.ico usamos 48x48, se verá mejor que 32x32.
copy($outputDir . '/favicon-48x48.png', __DIR__ . '/public/favicon.ico');

imagedestroy($image);

echo "Favicons cuadrados generados correctamente, sin recortar el logo.\n";