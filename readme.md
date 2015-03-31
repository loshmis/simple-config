## Simple Config

[![Build Status](https://travis-ci.org/loshmis/simple-config.svg?branch=master)](https://travis-ci.org/loshmis/simple-config)

Simple Config provides a convinient and classy way to load multiple configuration files from config directory and it is
inspired by Laravel 5 configuration loading (it actually use illuminate/config package for providing access to config
data). It is mainly created to be used with Slim Framework, but it can be used with any PHP application.

----

## Installation

You can install it via composer by typing the following

```json
composer require loshmis/simple-config
```

or you can include it to your composer.json file 

```json
"require": {
    "loshmis/simple-config": "~1.0"
}
```

----

## Usage with Slim

If you want to use it with Slim PHP Framework, you can do it like this (I'm placing it in my index.php file where I instantiate my Slim application, but you can place it 
anywhere you want, just make sure that you have provided correct configuration path)

```php
//index.php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

//path to your config directory
define('CONFIG_PATH', __DIR__ . '/config');

$app->container->singleton('config.loader', function($c) {
    return new \Loshmis\SimpleConfig\Loader (
        CONFIG_PATH,
        new Symfony\Component\Finder\Finder
    );
});

$app->container->singleton('config', function($c) {
    return new \Loshmis\SimpleConfig\Config($c['config.loader']);
});
```

And you can then manipulate with your configuration the same way yo do in Laravel 5 (and 4) application.

Let's assume that you have file called app.php inside your config directory and inside that file you have the following PHP code:

```php
<?php
return [
    'name' => 'Test'
];
```

Now, if you want to get the value for name from that configuration file, you can do it like this

```php
$appName = $app->config->get('app.name');
```

You can find all available methods by visiting [Laravel API Documentation](http://laravel.com/api/5.0/Illuminate/Config/Repository.html).
 
## Helper method for Slim

If you want, you can create an helper function so you can easily manipulate with configuration data. 

You can define the function like this (function is taken from Laravel's source code and slightly modified to be used with Slim framework):

```php

function config($key = null, $default = null)
{
    $app = \Slim\Slim::getInstance();
    
    if (is_null($key)) return $app->config;

    if (is_array($key)) {
        return $app->config->set($key);
    }

    return $app->config->get($key, $default);
}

```

Using the defined helper function, you can access to configuration data ***anywhere inside your application** by simply calling

```php

// to get some configuration data
$appName = config('app.name');

// to set some data
config(['app.name' => 'Simple Config'])

```




    
    
