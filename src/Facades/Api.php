<?php


namespace Papiyas\Api\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Api
 * @package Papiyas\Api\Facades
 * @method static success(array $data = [])
 * @method static failure(int $apiCodeEnum = -1, string $forceMessage = '')
 *
 * @see \Papiyas\Api\Response\Api
 */
class Api extends Facade
{
    static protected function getFacadeAccessor()
    {
        return 'api';
    }
}
