<?php

namespace Guysolamour\Callmebot\Clients;

use Illuminate\Support\Str;


abstract class BaseClient
{
    protected const BASE_URL = "https://api.callmebot.com";

    protected ?string $apikey  = null;

    protected string $message = '';


    public function apikey(string $apikey): self
    {
        $this->apikey = $apikey;

        return $this;
    }


    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    abstract public function send(array $data = []);


    protected function BuildUrl(string $url = ''): string {
        $url = Str::start($url, '/');

        return self::BASE_URL . $url;
    }
}
