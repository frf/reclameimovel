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
        $id = $request->get("id");

        $oEmp = $app['repository.empreendimento']->findIdNome($ide);

        if($oEmp){
            
            if($id){
                $aLista         = $app['repository.reclamacao']->find($id);
                $currentPage    = 0;
                $numPages       = 0;
            }else{
                // Perform pagination logic.
                $limit = 20;
                $total = $app['repository.reclamacao']->getCount();
                $numPages = ceil($total / $limit);
                $currentPage = $request->query->get('page', 1);
                $offset = ($currentPage - 1) * $limit;
                $aLista = $app['repository.reclamacao']->findAll($limit, $offset);                
            }
            
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

            return $app['twig']->render('reclamacoes.html.twig', $data);
        }else{
            return $app['twig']->render('index.html.twig');
        }
    }
    public function viewAction(Request $request, Application $app)
    {        
        $ide = $request->get("ide");
        $id = $request->get("id");

        $oEmp = $app['repository.empreendimento']->findIdNome($ide);

        if($oEmp){
            
            if($id){
                $aLista         = $app['repository.reclamacao']->find($id);
                $currentPage    = 0;
                $numPages       = 0;
            }
            
            $titulo = ucwords(str_replace("-"," ",$ide));
            $sub_titulo = ucwords($oEmp->getBairro());
                
            $data = array(
                'reclamacao' => $aLista,
                'titulo_empreendimento' => $titulo,
                'sub_titulo' => $sub_titulo,       
                'ide' => $ide,
                'id' => $id,
            );
           return $app['twig']->render('view.html.twig', $data);
        }else{
            return $app['twig']->render('index.html.twig');
        }
        
    }
    public function moradorAction(Request $request, Application $app)
    {        
        return $app['twig']->render('morador.html.twig');
        
    }
    public function construtoraAction(Request $request, Application $app)
    {        
        return $app['twig']->render('construtora.html.twig');
        
    }
}
