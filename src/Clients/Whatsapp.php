<?php

namespace Guysolamour\Callmebot\Clients;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Guysolamour\Callmebot\Exceptions\WhatsappException;

class Whatsapp extends BaseClient
{
    private ?int $phone     = null;


    public function phone(int $phone) :self
    {
        $this->phone = $phone;

        return $this;
    }

    public function send(array $data = []) :void
    {
        $data = array_merge([
            'apikey' => $this->apikey,
            'phone'  => $this->phone,
            'text'   => $this->message,
        ], $data);

        if (!$data['apikey']) {
            throw new WhatsappException('The api key is required');
        }

        if (!$data['phone']) {
            throw new WhatsappException('The phone number is required');
        }

        if (!$data['text']) {
            throw new WhatsappException('The message can not be empty');
        }

        $url = $this->buildUrl("whatsapp.php");

        $response = Http::get($url, $data);

        if (Str::contains($response->body(), 'invalid')){
            throw new WhatsappException("Api key ['{$data['apikey']}'] is invalid.");
        }
    }
}
