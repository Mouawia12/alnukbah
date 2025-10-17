<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Config;

if (! function_exists('app_setting')) {
    /**
     * Retrieve the application setting for the given key.
     *
     * The helper first attempts to load the value from the custom settings table.
     * If the table is not available or the key is missing, it falls back to Laravel's config.
     */
    function app_setting(string $key, $default = null)
    {
        static $settings = null;

        if ($settings === null) {
            try {
                $settings = Setting::query()->pluck('value', 'key')->all();
            } catch (\Throwable $e) {
                $settings = [];
            }
        }

        if (array_key_exists($key, $settings)) {
            $value = $settings[$key];

            return $value === null ? $default : $value;
        }

        return Config::get($key, $default);
    }
}
