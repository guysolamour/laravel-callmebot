<?php

namespace Guysolamour\Callmebot;

use Guysolamour\Callmebot\Channels\WhatsappChannel;
use Guysolamour\Callmebot\Clients\Whatsapp;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CB_DRIVERS = [
        'cbwhatsapp' => WhatsappChannel::class,
    ];

    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind('callmebot-whatsapp', function () {
            return new Whatsapp();
        });

        foreach (self::CB_DRIVERS as $driver => $classname) {
            Notification::resolved(function (ChannelManager $service) use ($driver, $classname) {
                $service->extend($driver, function ($app) use ($classname) {
                    return $app->make($classname);
                });
            });
        }
    }
}
