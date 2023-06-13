<?php

namespace Guysolamour\Callmebot\Channels;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notification;


abstract class BaseChannel
{

    abstract protected function channel(): string;


    protected function getNotificationMethod(): string
    {
        return Str::ucfirst('toCb' . $this->channel());
    }

    protected function getNotificationMessage($notifiable, Notification $notification): ?string
    {
        $methodName = $this->getNotificationMethod();

        return $notification->$methodName($notifiable);
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    protected function validate($notifiable, Notification $notification)
    {
        if (
            method_exists($notifiable, 'enableCallmebotNotification') &&
            $notifiable->enableCallmebotNotification() === false
        ) {
            return;
        }

        if (!method_exists($notification, $this->getNotificationMethod())) {
            return;
        }

        // check if api key exists
        throw_unless(
            method_exists($notifiable, 'callmebotApiKeys'),
            sprintf("The [%s] notifiable class must implement [callmebotApiKeys] method.", get_class($notifiable))
        );
    }
}
