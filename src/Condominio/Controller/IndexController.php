<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class IndexController
{
    public function indexAction(Request $request, Application $app)
    {
        $empreendimento = $request->get("pageName");
              
        if($empreendimento){
            // Perform pagination logic.
            $limit = 20;
            $total = $app['repository.reclamacao']->getCount();
            $numPages = ceil($total / $limit);
            $currentPage = $request->query->get('page', 1);
            $offset = ($currentPage - 1) * $limit;
            $aLista = $app['repository.reclamacao']->findAll($limit, $offset);
        
            
            $empreendimento = ucwords(str_replace("-"," ",$empreendimento));
            $data = array(
                'aLista' => $aLista,
                'titulo_empreendimento' => $empreendimento,
                'currentPage' => $currentPage,
                'numPages' => $numPages
            );
        
            return $app['twig']->render('lista_reclamacao.html.twig', $data);
        }else{
            return $app['twig']->render('index.html.twig');
        }
    }
    public function cadastroAction(Request $request, Application $app)
    {        
        return $app['twig']->render('cadastro.html.twig');
        
    }
    public function moradorAction(Request $request, Application $app)
    {        
        return $app['twig']->render('morador.html.twig');
        
    }
    public function contrutoraAction(Request $request, Application $app)
    {        
        return $app['twig']->render('construtora.html.twig');
        
    }
}
