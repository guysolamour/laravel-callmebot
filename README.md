# Laravel Callmebot

[![Packagist](https://img.shields.io/packagist/v/guysolamour/laravel-callmebot.svg)](https://packagist.org/packages/guysolamour/laravel-callmebot)
[![Packagist](https://poser.pugx.org/guysolamour/laravel-callmebot/d/total.svg)](https://packagist.org/packages/guysolamour/laravel-callmebot)
[![Packagist](https://img.shields.io/packagist/l/guysolamour/laravel-callmebot.svg)](https://packagist.org/packages/guysolamour/laravel-callmebot)


## Installation

Install via composer
```bash
composer require guysolamour/laravel-callmebot
```

## Usage

### Whatsapp

#### Send message
```php
Guysolamour\Callmebot\Facades\Whatsapp::apikey($apikey)->phone($phone)->message($message)->send();

// or

Guysolamour\Callmebot\Facades\Whatsapp::send([
  'apikey'   => $apikey,
  'phone'    => $phone,
  'text'     => $message,
]);

```

#### Send notification

```php
// in Notification file

/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return ['cbwhatsapp']; // or ['Guysolamour\Callmebot\Channels\WhatsappChannel::class']
}

/**
 * Get the array representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function toCbWhatsapp($notifiable)
{
    return "Message ...";
}

// in Notifiable model
public function enableCallmebotNotification() :bool
{
    return true;
}

public function routeNotificationForCbWHatsapp()
{
    return 0102030405;
}

/**
 * Get callmebot api keys
 *
 * @param string|null $client
 * @return string|array
 */
public function callmebotApiKeys(?string $client = null)
{
    $client_keys =  [
        'whatsapp' => 012345,
    ];

    if (is_null($client)){
        return $client_keys;
    }

    return Arr::get($client_keys, $client);
}
```
## Security

If you discover any security related issues, please email rolandassale@gmail.com
instead of using the issue tracker.

## Credits

- [Guy-roland ASSALE](https://github.com/guysolamour/laravel-callmebot)
- [All contributors](https://github.com/guysolamour/laravel-callmebot/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
