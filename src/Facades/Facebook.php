<?php

namespace Guysolamour\Callmebot\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * Send message to a facebook contact
 *
 * @method static \Guysolamour\Callmebot\Clients\Facebook phone(int $phone)
 * @method static \Guysolamour\Callmebot\Clients\Facebook send(array $data = [])
 * @method static \Guysolamour\Callmebot\Clients\Facebook apikey(?string $apikey)
 * @method static \Guysolamour\Callmebot\Clients\Facebook message(string $message)
 */
class Facebook extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'callmebot-facebook';
    }
}
