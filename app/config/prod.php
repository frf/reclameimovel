<?php

// Timezone.
date_default_timezone_set('Europe/Paris');

// Cache
$app['cache.path'] = __DIR__ . '/../cache';
$app['session.path'] = __DIR__ . '/../session';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'] . '/twig';

// Emails.
$app['admin_email'] = 'noreply@musicbox.nothing';
$app['site_email'] = 'noreply@musicbox.nothing';

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'dbname'   => 'condominio',
    'user'     => 'condominio',
    'password' => 'datasus',
);



