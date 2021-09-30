<?php

namespace Guysolamour\Callmebot\Channels;

use Illuminate\Notifications\Notification;
use Guysolamour\Callmebot\Facades\Whatsapp;


class WhatsappChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (
            method_exists($notifiable, 'enableCallmebotNotification') &&
            $notifiable->enableCallmebotNotification() === false
            ){
            return ;
        }



        if (!method_exists($notification, 'toCbWhatsapp')){
            return;
        }

        // dd($notifiable, 'ififi');


        $message = $notification->toCbWhatsapp($notifiable);

        // dd($message);

        if (!$message){
            return;
        }

        // check if apikey exists
        throw_unless(
            method_exists($notifiable, 'callmebotApiKeys'),
            sprintf("The [%s] notifiable class must implement [callmebotApiKeys] method.", get_class($notifiable))
        );

        throw_unless(
            $key = $notifiable->callmebotApiKeys('whatsapp'),
            sprintf("The [%s] notifiable whatsapp api key is not valid.", get_class($notifiable))
        );


        // Check if phone number exists
        throw_unless(
            method_exists($notifiable, 'routeNotificationForCbWHatsapp'),
            sprintf("The [%s] notifiable class must implement [routeNotificationForCbWHatsapp] method.", get_class($notifiable))
        );

        Whatsapp::apikey($notifiable->callmebotApiKeys('whatsapp'))->phone($notifiable->routeNotificationForCbWHatsapp())->message($message)->send();
    }

}
