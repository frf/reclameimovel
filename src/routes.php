<?php

// Register route converters.
// Each converter needs to check if the $id it received is actually a value,
// as a workaround for https://github.com/silexphp/Silex/pull/768.
// Register routes.

$app->match('/login', 'Condominio\Controller\UserController::loginAction')->bind('login');
$app->get('/logout', 'Condominio\Controller\UserController::logoutAction')->bind('logout');

$app->get('/morador', 'Condominio\Controller\MoradorController::indexAction')->bind('morador');
$app->get('/construtora', 'Condominio\Controller\IndexController::construtoraAction')->bind('construtora');
$app->get('/cadastro', 'Condominio\Controller\IndexController::cadastroAction')->bind('cadastro');
$app->get('/{pageName}', 'Condominio\Controller\IndexController::indexAction')->value('pageName',false);