<?php

$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});

$app->get('/login', 'Condominio\Controller\LoginController::loginAction')->bind('login');
$app->match('/logout', function () {})->bind('logout');
$app->get('/morador', 'Condominio\Controller\MoradorController::indexAction')->bind('morador');
$app->get('/morador/minhas-reclamacoes', 'Condominio\Controller\MoradorController::minhasReclamacoesAction')->bind('minhas_reclamacoes');
$app->get('/morador/dados-complementares/{user}', 'Condominio\Controller\MoradorController::dadosAction')->bind('dados_usuario')->value('user');

$app->get('/adicionar/{idnome}', 'Condominio\Controller\MoradorController::adicionarAction')->bind('reclamacao_add')->value('idnome',false);
$app->get('/construtora', 'Condominio\Controller\ConstrutoraController::indexAction')->bind('construtora');
$app->get('/{idnome}', 'Condominio\Controller\IndexController::indexAction')->bind('principal')->value('idnome',false);

$app->get('/view/{ide}/{id}', 'Condominio\Controller\IndexController::viewAction')->bind('view')->value('ide',false)->value('id',false);
$app->get('/api/empreendimento', 'Condominio\Controller\EmpreendimentoController::apiAction')->bind('api_emp');

$app->post('/buscar', 'Condominio\Controller\IndexController::buscarAction')->bind('buscar');
$app->post('/adicionar', 'Condominio\Controller\MoradorController::adicionarAction');
$app->post('/adicionar/foto', 'Condominio\Controller\MoradorController::adicionarFotoAction');
$app->post('/morador/dados-complementares/adicionar', 'Condominio\Controller\MoradorController::dadosAction')->bind('dados_usuario_add');

