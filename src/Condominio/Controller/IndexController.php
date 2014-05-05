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
        $ide = $request->get("ide");

        $oEmp = $app['repository.empreendimento']->findIdNome($ide);
            
        if($oEmp){
            
            // Perform pagination logic.
            $limit = 20;
            $total = $app['repository.reclamacao']->getCount();
            $numPages = ceil($total / $limit);
            $currentPage = $request->query->get('page', 1);
            $offset = ($currentPage - 1) * $limit;
            $aLista = $app['repository.reclamacao']->findAll($limit, $offset);

            $titulo = ucwords(str_replace("-"," ",$ide));
            $sub_titulo = ucwords($oEmp->getBairro());
            
            $data = array(
                'aLista' => $aLista,
                'titulo_empreendimento' => $titulo,
                'sub_titulo' => $sub_titulo,
                'currentPage' => $currentPage,
                'numPages' => $numPages,                
                'ide' => $ide,
            );
        
            return $app['twig']->render('lista_reclamacao.html.twig', $data);
        }else{
            return $app['twig']->render('index.html.twig');
        }
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
