<?php

namespace Guysolamour\Callmebot\Clients;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Guysolamour\Callmebot\Exceptions\FacebookException;

class Facebook extends BaseClient
{

    public function send(array $data = []) :void
    {
        $data = array_merge([
            'apikey' => $this->apikey,
            'text'   => $this->message,
        ], $data);

        if (!$data['apikey']) {
            throw new FacebookException('The api key is required');
        }

        if (!$data['text']) {
            throw new FacebookException('The message can not be empty');
        }

        $url = $this->buildUrl("facebook/send.php");

        $response = Http::get($url, $data);

        if (Str::contains($response->body(), 'invalid')){
            throw new FacebookException("Api key ['{$data['apikey']}'] is invalid.");
        }
    }
}
