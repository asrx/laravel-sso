<?php

return [
    /**
     * sso table name
     */
    'table' => 'sso',

    /**
     * SSO controller will use this guard to login user.
     */
    'guard' => 'sso',

    /**
     * sso ticket cache
     */
    'cache_prefix' => 'laravel.sso.',

    /**
     * expires time
     */
    'ttl' => 7200,
    
    /**
     * Redirect to this address when after SSO login.
     */
    'redirect' => env('APP_URL')
];