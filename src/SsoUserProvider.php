<?php

namespace Cblink\Sso;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\DatabaseUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

/**
 * Class SsoUserProvider
 *
 * @package Cblink\Sso
 */
class SsoUserProvider extends DatabaseUserProvider
{
    /**
     * @param array $credentials
     * @return \Illuminate\Auth\GenericUser|UserContract|null
     * @throws SsoException
     */
    public function retrieveByCredentials(array $credentials)
    {
        $appId = Cache::get(config('sso.cache_prefix') . $credentials['ticket']);

        if (!$appId) {
            abort(401, 'invalid ticket');
        }

        $user = DB::table(config('sso.table'))->where('app_id', $appId)->first();

        return $this->getGenericUser($user);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array                                      $credentials
     *
     * @return mixed
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return  Cache::get(config('sso.cache_prefix') . $credentials['ticket']);
    }
}