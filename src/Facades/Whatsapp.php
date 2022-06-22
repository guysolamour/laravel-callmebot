<?php

namespace Guysolamour\Callmebot\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Send message to a whatsapp contact
 *
 * @method static \Guysolamour\Callmebot\Clients\Whatsapp phone(int $phone)
 * @method static \Guysolamour\Callmebot\Clients\Whatsapp send(array $data = [])
 * @method static \Guysolamour\Callmebot\Clients\Whatsapp apikey(?string $apikey)
 * @method static \Guysolamour\Callmebot\Clients\Whatsapp message(string $message)
 */
class Whatsapp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'callmebot-whatsapp';
    }
}
