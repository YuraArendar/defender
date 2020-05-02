<?php

if (!function_exists('is_admin_part')) {

    /**
     * check if we are using admin panel
     *
     * @return bool
     */
    function is_admin_path(): bool
    {
        return request()->server->get('HTTP_HOST') === 'admin.' . env('APP_HOST');
    }
}

if (!function_exists('is_developer_mode')) {

    /**
     * check if we are using admin panel
     *
     * @return bool
     */
    function is_developer_mode(): bool
    {
        return env('APP_ENV') !== 'production';
    }
}
