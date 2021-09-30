<?php

namespace Guysolamour\Callmebot\Facades;

use Illuminate\Support\Facades\Facade;

class Whatsapp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'callmebot-whatsapp';
    }
}
