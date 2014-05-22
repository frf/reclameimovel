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
// SwiftMailer
// See http://silex.sensiolabs.org/doc/providers/swiftmailer.html
$app['swiftmailer.options'] = array(
    'transport'=>'gmail',
    'username' => 'contato@reclameimovel.com.br',
    'password' => 'ch4ng3m3',
);
