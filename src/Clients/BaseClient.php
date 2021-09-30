<?php

namespace Guysolamour\Callmebot\Clients;

use Illuminate\Support\Str;


abstract class BaseClient
{
    protected const BASE_URL = "https://api.callmebot.com";

    abstract public function send(array $data = []);
    
    abstract protected function isValid() :bool;

    protected function BuildUrl(string $url = ''): string {
        $url = Str::start($url, '/');

        return self::BASE_URL . $url;
    }
}
