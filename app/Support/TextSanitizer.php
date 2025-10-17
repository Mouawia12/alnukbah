<?php

namespace App\Support;

class TextSanitizer
{
    private const DEFAULT_ALLOWED_TAGS = '<p><br><strong><em><ul><ol><li><a>'; 

    public static function clean(?string $value, ?string $allowedTags = null): ?string
    {
        if ($value === null) {
            return null;
        }

        $sanitized = trim(strip_tags($value, $allowedTags ?? self::DEFAULT_ALLOWED_TAGS));

        if ($sanitized === '') {
            return null;
        }

        $sanitized = preg_replace('/on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $sanitized);
        $sanitized = preg_replace('/style\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $sanitized);
        $sanitized = preg_replace('/href\s*=\s*("javascript:[^"]*"|\'javascript:[^\']*\'|javascript:[^\s>]*)/i', 'href="#"', $sanitized);

        return $sanitized === '' ? null : $sanitized;
    }
}
