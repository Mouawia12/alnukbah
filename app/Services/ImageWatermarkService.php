<?php

namespace App\Services;

class ImageWatermarkService
{
    /**
     * Apply a textual watermark to an image stored on the public disk.
     *
     * @param  string  $relativePath  Relative path inside storage/app/public.
     * @param  string|null  $text     Optional custom text. Defaults to the app name.
     */
    public static function apply(string $relativePath, ?string $text = null): void
    {
        $relativePath = str_replace('\\', '/', ltrim($relativePath, '/'));
        if ($relativePath === '') {
            return;
        }

        $fullPath = storage_path('app/public/' . $relativePath);
        if (!is_file($fullPath) || !is_readable($fullPath)) {
            return;
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $image = self::createImageResource($fullPath, $extension);

        if (!$image) {
            return;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        if ($width === 0 || $height === 0) {
            imagedestroy($image);
            return;
        }

        $fontPath = public_path('assets/fonts/Tajawal-800.ttf');
        if (!is_file($fontPath)) {
            imagedestroy($image);
            return;
        }

        $watermarkText = trim($text ?? config('app.name', 'النخبة')) ?: 'النخبة';
        $fontSize = max(18, (int) round(min($width, $height) * 0.08));
        $margin = max(28, (int) round(min($width, $height) * 0.05));

        $bbox = imagettfbbox($fontSize, 0, $fontPath, $watermarkText);
        if (!$bbox) {
            imagedestroy($image);
            return;
        }

        $textWidth = abs($bbox[2] - $bbox[0]);
        $textHeight = abs($bbox[5] - $bbox[3]);

        $x = max($margin, $width - $textWidth - $margin);
        $y = max($margin + $textHeight, $height - $margin);

        imagealphablending($image, true);
        imagesavealpha($image, true);

        $shadowColor = imagecolorallocatealpha($image, 0, 0, 0, 90);
        imagettftext($image, $fontSize, 0, $x + 2, $y + 2, $shadowColor, $fontPath, $watermarkText);

        $textColor = imagecolorallocatealpha($image, 255, 255, 255, 70);
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $watermarkText);

        self::saveImageResource($image, $fullPath, $extension);
        imagedestroy($image);
    }

    /**
     * Create an image resource from a file based on its extension.
     */
    protected static function createImageResource(string $path, string $extension)
    {
        return match ($extension) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($path),
            'png' => @imagecreatefrompng($path),
            'webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            default => null,
        };
    }

    /**
     * Persist the modified image resource back to disk.
     */
    protected static function saveImageResource($image, string $path, string $extension): void
    {
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($image, $path, 90);
                break;
            case 'png':
                imagepng($image, $path, 6);
                break;
            case 'webp':
                if (function_exists('imagewebp')) {
                    imagewebp($image, $path, 90);
                }
                break;
        }
    }
}
