<?php
/*
$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});
*/
$app->get('/login', 'Condominio\Controller\LoginController::loginAction')->bind('login');
$app->match('/logout', function () {})->bind('logout');
$app->get('/morador', 'Condominio\Controller\MoradorController::indexAction')->bind('morador');
$app->get('/morador/minhas-reclamacoes/{page}', 'Condominio\Controller\MoradorController::minhasReclamacoesAction')->bind('minhas_reclamacoes')->value('page',1);
$app->get('/morador/dados-complementares', 'Condominio\Controller\MoradorController::dadosAction')->bind('dados_usuario');
$app->get('/empreendimento/novo', 'Condominio\Controller\IndexController::empNovoAction')->bind('emp_novo');

$app->get('/adicionar/{idnome}', 'Condominio\Controller\MoradorController::adicionarAction')->bind('reclamacao_add')->value('idnome',false);
$app->get('/construtora', 'Condominio\Controller\ConstrutoraController::indexAction')->bind('construtora');
$app->get('/email/bemvindo', 'Condominio\Controller\IndexController::emailbemvindoAction')->bind('emailbemvindo');
$app->get('/reclameimovel/sugestao', 'Condominio\Controller\IndexController::sugestaoAction')->bind('sugestao');
$app->get('/empreendimento/{idnome}/{page}', 'Condominio\Controller\IndexController::indexAction')->bind('principalemp')
                                                                                    ->value('idnome',false)
                                                                                    ->value('page',1);
$app->get('/morador/update/{idnome}', 'Condominio\Controller\EmpreendimentoController::updateUsuarioAction')->bind('empupuser')
                                                                                    ->value('idnome',false);

$app->get('/empreendimento/buscar/{page}/{busca}', 'Condominio\Controller\IndexController::indexAction')->bind('principalbuscar')
                                                                                                ->value('page',1)
                                                                                                ->value('busca',0);

$app->get('/','Condominio\Controller\IndexController::indexAction')->bind('principal');
$app->get('/termo-de-uso','Condominio\Controller\IndexController::termoAction')->bind('termo');
$app->get('/quemsomos','Condominio\Controller\IndexController::quemsomosAction')->bind('quemsomos');
$app->get('/empreendimento/view/{ide}/{id}', 'Condominio\Controller\IndexController::viewAction')->bind('view')->value('ide',false)->value('id',false);
$app->get('/api/empreendimento', 'Condominio\Controller\EmpreendimentoController::apiAction')->bind('api_emp');

$app->post('/buscar', 'Condominio\Controller\IndexController::buscarAction')->bind('buscar');

$app->post('/adicionar', 'Condominio\Controller\MoradorController::adicionarAction');
$app->post('/adicionar/foto', 'Condominio\Controller\MoradorController::adicionarFotoAction');
$app->post('/morador/dados-update', 'Condominio\Controller\MoradorController::dadosUpdateAction')->bind('dados_usuario_add');
$app->post('/empeendimento/cadastrar', 'Condominio\Controller\IndexController::empCadastrarAction')->bind('emp_cad');




