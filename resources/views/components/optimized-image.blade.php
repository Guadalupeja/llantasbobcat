@props([
    'src',
    'alt' => 'Llantas para Bobcat',
    'class' => '',
    'loading' => 'lazy',
    'fetchpriority' => null,
    'width' => null,
    'height' => null,
    'sizes' => null,
])

@php
    $fallback = \App\Support\LocalImage::url($src);
    $webp = \App\Support\LocalImage::webp($src);
@endphp

<picture>
    @if ($webp)
        <source srcset="{{ $webp }}" type="image/webp" @if($sizes) sizes="{{ $sizes }}" @endif>
    @endif

    <img
        src="{{ $fallback }}"
        alt="{{ \App\Support\LocalImage::alt($alt) }}"
        class="{{ $class }}"
        loading="{{ $loading }}"
        decoding="async"
        @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
    >
</picture>
