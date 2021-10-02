<?php

namespace Guysolamour\Callmebot\Facades;

use Illuminate\Support\Facades\Facade;

class Facebook extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'callmebot-facebook';
    }
}
