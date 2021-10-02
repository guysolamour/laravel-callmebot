<?php

namespace Guysolamour\Callmebot\Channels;

use Guysolamour\Callmebot\Facades\Facebook;
use Illuminate\Notifications\Notification;


class FacebookChannel extends BaseChannel
{
    /**
     * Used for validation
     *
     * @return string
     */
    protected function channel(): string
    {
        return 'facebook';
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

        $message = $this->getNotificationMessage($notifiable, $notification);

        if (!$message) {
            return;
        }

        Facebook::apikey($notifiable->callmebotApiKeys('facebook'))->message($message)->send();
    }

}
