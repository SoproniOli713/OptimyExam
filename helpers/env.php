<?php
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        if (!array_key_exists($key, $_ENV))
            return $default;
        $value = $_ENV[$key];
        return ($value !== false && $value !== '') ? $value : $default;
    }
}