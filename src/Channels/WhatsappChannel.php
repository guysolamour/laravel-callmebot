<?php

namespace Guysolamour\Callmebot\Channels;

use Illuminate\Notifications\Notification;
use Guysolamour\Callmebot\Facades\Whatsapp;


class WhatsappChannel extends BaseChannel
{
    /**
     * Used for validation
     *
     * @return string
     */
    protected function channel() :string
    {
        return 'whatsapp';
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $this->validate($notifiable, $notification);

        // Check if phone number exists
        throw_unless(
            method_exists($notifiable, 'routeNotificationForCbWHatsapp'),
            sprintf("The [%s] notifiable class must implement [routeNotificationForCbWHatsapp] method.", get_class($notifiable))
        );

        $message = $this->getNotificationMessage($notifiable, $notification);

        if (!$message){
            return;
        }

        Whatsapp::apikey($notifiable->callmebotApiKeys($this->channel()))->phone($notifiable->routeNotificationForCbWHatsapp())->message($message)->send();
    }

}
