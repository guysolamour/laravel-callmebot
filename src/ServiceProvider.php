<?php

namespace Guysolamour\Callmebot;

use Guysolamour\Callmebot\Clients\Facebook;
use Guysolamour\Callmebot\Clients\Whatsapp;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Guysolamour\Callmebot\Channels\FacebookChannel;
use Guysolamour\Callmebot\Channels\WhatsappChannel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CB_DRIVERS = [
        'cbwhatsapp' => WhatsappChannel::class,
        'cbfacebook' => FacebookChannel::class,
    ];

    const CB_FACADES = [
        'callmebot-whatsapp' => Whatsapp::class,
        'callmebot-facebook' => Facebook::class,
    ];
    

    public function boot()
    {
    }

    public function register()
    {
        foreach (self::CB_FACADES as $alias => $classname) {
            $this->app->bind($alias, function () use ($classname) {
                return new $classname;
            });
        }

        foreach (self::CB_DRIVERS as $driver => $classname) {
            Notification::resolved(function (ChannelManager $service) use ($driver, $classname) {
                $service->extend($driver, function ($app) use ($classname) {
                    return $app->make($classname);
                });
            });
        }
    }
}
