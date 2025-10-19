<?php

use App\Models\Setting;

if (!function_exists('app_setting')) {
    /**
     * Retrieve a configuration value from the settings table and fall back to config().
     *
     * @param  string  $key
     * @param  mixed|null  $default
     * @return mixed
     */
    function app_setting(string $key, $default = null)
    {
        static $cache = [];

        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }

        $value = Setting::query()->where('key', $key)->value('value');

        if (!is_null($value)) {
            return $cache[$key] = $value;
        }

        return $cache[$key] = config($key, $default);
    }
}
