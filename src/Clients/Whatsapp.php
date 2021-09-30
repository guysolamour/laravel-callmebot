<?php

namespace Guysolamour\Callmebot\Clients;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Guysolamour\Callmebot\Exceptions\WhatsappException;

class Whatsapp extends BaseClient
{
    private ?string $apikey  = null;

    private ?int $phone     = null;

    private string $message = '';


    public function apikey(string $apikey) :self
    {
        $this->apikey = $apikey;

        return $this;
    }

    public function phone(int $phone) :self
    {
        $this->phone = $phone;

        return $this;
    }

    public function message(string $message) :self
    {
        $this->message = $message;

        return $this;
    }

    protected function isValid(): bool
    {
        if (!$this->apikey) {
            throw new WhatsappException('The api key is required');
        }

        if (!$this->phone) {
            throw new WhatsappException('The phone number is required');
        }

        return true;
    }

    public function send(array $data = []) :void
    {
        $data = array_merge([
            'apikey' => $this->apikey,
            'phone'  => $this->phone,
            'text'   => $this->message,
        ], $data);


        $url = $this->buildUrl("whatsapp.php");

        $response = Http::get($url, $data);

        if (Str::contains($response->body(), 'invalid')){
            throw new WhatsappException("Api key ['{$data['apikey']}'] is invalid.");
        }

    }
}
