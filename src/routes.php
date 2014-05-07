<?php

$app->get('/login', 'Condominio\Controller\LoginController::loginAction')->bind('login');
$app->match('/logout', function () {})->bind('logout');
$app->get('/morador', 'Condominio\Controller\MoradorController::indexAction')->bind('morador');
$app->get('/adicionar/{ide}', 'Condominio\Controller\MoradorController::adicionarAction')->bind('reclamacao_add')->value('ide',false);
$app->get('/construtora', 'Condominio\Controller\IndexController::construtoraAction')->bind('construtora');
$app->get('/{ide}', 'Condominio\Controller\IndexController::indexAction')->bind('principal')->value('ide',false);
$app->get('/view/{ide}/{id}', 'Condominio\Controller\IndexController::viewAction')->bind('view')->value('ide',false)->value('id',false);
$app->get('/api/empreendimento', 'Condominio\Controller\EmpreendimentoController::apiAction')->bind('api_emp');
$app->post('/adicionar', 'Condominio\Controller\MoradorController::adicionarAction');
