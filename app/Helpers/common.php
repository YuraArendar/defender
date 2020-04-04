<?php

if (! function_exists('is_admin_part')) {

    /**
     * check if we are using admin panel
     *
     * @return bool
     */
    function is_admin_path()
    {
        return request()->server->get('HTTP_HOST') === 'admin.' . env('APP_HOST');
    }
}

if (! function_exists('is_developer_mode')) {

    /**
     * check if we are using admin panel
     *
     * @return bool
     */
    function is_developer_mode()
    {
        return env('APP_ENV') !== 'production';
    }
}
