<?php

namespace Guysolamour\Callmebot\Clients;

use Illuminate\Support\Facades\Http;
use Guysolamour\Callmebot\Exceptions\FacebookException;

class Facebook extends BaseClient
{

    public function send(array $data = []): void
    {
        $data = array_merge([
            'apikey' => $this->apikey,
            'text'   => $this->message,
        ], $data);

        if (!$data['apikey']) {
            throw new FacebookException('The api key is required.');
        }

        if (!$data['text']) {
            throw new FacebookException('The message can not be empty');
        }

        try {
            Http::get($this->buildUrl("facebook/send.php"), $data);
        } catch (\Throwable $th) {
        }

    }
}
