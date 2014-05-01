<?php

// Register route converters.
// Each converter needs to check if the $id it received is actually a value,
// as a workaround for https://github.com/silexphp/Silex/pull/768.
// Register routes.
/*

$app->match('/auth', 'Condominio\Controller\LoginController::authAction')->bind('auth');
$app->get('/logout', 'Condominio\Controller\LoginController::logoutAction')->bind('logout');
*/

$app->get('/login', 'Condominio\Controller\LoginController::loginAction')->bind('login');
$app->match('/logout', function () {})->bind('logout');
/*
$app->get('/login', function () use ($app) {
    $services = array_keys($app['oauth.services']);

    return $app['twig']->render('login.html.twig', array(
        'login_paths' => array_map(function ($service) use ($app) {
            return $app['url_generator']->generate('_auth_service', array(
                'service' => $service,
                '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('oauth')
            ));
        }, array_combine($services, $services)),
        'logout_path' => $app['url_generator']->generate('logout', array(
            '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('logout')
        ))
    ));
});
$app->match('/logout', function () {})->bind('logout');
*/

$app->get('/morador', 'Condominio\Controller\MoradorController::indexAction')->bind('morador');
$app->get('/construtora', 'Condominio\Controller\IndexController::construtoraAction')->bind('construtora');
$app->get('/cadastro', 'Condominio\Controller\IndexController::cadastroAction')->bind('cadastro');
$app->get('/{pageName}', 'Condominio\Controller\IndexController::indexAction')->value('pageName',false);