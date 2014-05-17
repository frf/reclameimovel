<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

$app['view_path'] = 'http://reclameimovel.com.br/view';

$app['repository.empresa'] = $app->share(function ($app) {
    return new Condominio\Repository\EmpresaRepository($app['db']);
});  
$app['repository.user'] = $app->share(function ($app) {
    return new Condominio\Repository\UserRepository($app['db']);
});  
$app['repository.empreendimento'] = $app->share(function ($app) {
    return new Condominio\Repository\EmpreendimentoRepository($app['db'],$app['repository.empresa']);
});  
$app['repository.imagem'] = $app->share(function ($app) {
    return new Condominio\Repository\ImagemRepository($app['db']);
});
$app['repository.reclamacao'] = $app->share(function ($app) {
    return new Condominio\Repository\ReclamacaoRepository($app['db'],$app['repository.empreendimento'],$app['repository.imagem']);
});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.options' => array(
        'cache' => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true,
    ),
    'twig.form.templates' => array('form_div_layout.html.twig', 'common/form_div_layout.html.twig'),
    'twig.path' => array(__DIR__ . '/../app/views')    
));

$app['title_layout'] = 'Reclame Imóvel - Soluções para os seus problemas, divulgue já.';

$app->before(function (Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $token = $app['security']->getToken();
    $app['user'] = null;
    $app['token'] = null;

    $services = array_keys($app['oauth.services']);
	$app['login'] = array(
        'login_paths' => array_map(function ($service) use ($app) {
            return $app['url_generator']->generate('_auth_service', array(
                'service' => $service,
                '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('oauth')
            ));
        }, array_combine($services, $services)),
        'logout_path' => $app['url_generator']->generate('logout', array(
            '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('logout')
        )));
        if ($token && !$app['security.trust_resolver']->isAnonymous($token)) {
            $app['user'] = $token->getUser();
            $app['token'] = $token;
        }
    $protected = array(
        #'/morador' => 'ROLE_USER',
        #'/adicionar' => 'ROLE_USER',
        #'/minhas-reclamacoes' => 'ROLE_USER',
    );
    $path = $request->getPathInfo();

    foreach ($protected as $protectedPath => $role) {
        if (strpos($path, $protectedPath) !== FALSE && !$app['security']->isGranted($role)) {
            throw new AccessDeniedException();
        }
    }

});

// Register the error handler.
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $data = array('metaDescription'=>'Reclame Imóvel, página não encontrada.',
                            'mensagem' => ' Desculpe o transtorno, estamos trabalhando para poder atender você melhor.',
                            'titulo'=>'Página não encontrada','tipo'=>'danger');
           
            $message = $app['twig']->render('erro.html.twig',$data, 404);
            break;
        default:
            $data = array('metaDescription'=>'Reclame Imóvel, página não encontrada.',
                            'mensagem' => ' Desculpe o transtorno, estamos trabalhando para poder atender você melhor.',
                            'titulo'=>'Erro','tipo'=>'warning');
           
            $message = $app['twig']->render('erro.html.twig',$data);
    }

    return new Response($message, $code);
});

$app->before(function (Request $request) use ($app)
{

    if($app['token']){
        $idu = $app['token']->getUid();
        
        if(!$app['repository.user']->isDados($idu) && $request->get('_route') != "dados_usuario"){
           $redirect = $app['url_generator']->generate('dados_usuario');
           return $app->redirect($redirect);
        }
    }

});
return $app;
