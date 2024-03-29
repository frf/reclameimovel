<?php

define('COND_PUBLIC_ROOT', __DIR__);

list($consumerKey, $consumerSecret) = include __DIR__ . '/../app/config/credentials.conf.php';

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__.'/../app/config/dev.php';
require __DIR__.'/../src/register.php';
require __DIR__.'/../src/app.php';
require __DIR__.'/../src/routes.php';

$app->run();
