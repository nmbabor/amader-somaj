<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Get a site setting value (with optional default).
     */
    function setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('bn_number')) {
    /**
     * Convert English digits in a string to Bengali digits.
     */
    function bn_number($value): string
    {
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return str_replace($en, $bn, (string) $value);
    }
}