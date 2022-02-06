<?php

namespace App\Facades;

use Datto\JsonRpc\Http\Client;
use Illuminate\Support\Facades\Facade;

/**
 * class JRpcClient
 * @package App\Facades
 * @mixin Client
 * @method static Client notify(string $method, array $arguments)
 * @method static getContext(array $options)
 *
 */
class JRpcClient extends Facade
{
    public static function client(): Client
    {
        return self::getFacadeRoot();
    }

    protected static function getFacadeAccessor()
    {
        return 'jrpc-client';
    }
}
