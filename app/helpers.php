<?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('app_setting')) {
    /**
     * Retrieve a setting value from the custom settings table if available.
     *
     * Falls back to Laravel's config helper when the database is unavailable
     * or the setting is not stored in the table.
     */
    function app_setting(string $key, $default = null)
    {
        static $cache = [];

        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }

        $value = null;

        try {
            if (class_exists(\App\Models\Setting::class) && Schema::hasTable('settings')) {
                $value = \App\Models\Setting::query()->where('key', $key)->value('value');
            }
        } catch (\Throwable $exception) {
            $value = null;
        }

        if ($value !== null) {
            return $cache[$key] = $value;
        }

        return $cache[$key] = config($key, $default);
    }
}
