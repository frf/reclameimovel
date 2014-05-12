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
            $app['repository.empreendimento']->updateVisita($oEmp->getId());
            
            if($id){                
                $aLista         = $app['repository.reclamacao']->find($id);
                 
                $currentPage    = 0;
                $numPages       = 0;
            }else{
                $nome_empresa = $oEmp->getEmpresa()->getNome();
                $nome_emp = $oEmp->getNome();
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
                'nome_emp' => $nome_emp,
                'nome_empresa' => $nome_empresa,
                'titulo_empreendimento' => $titulo,
                'sub_titulo' => $sub_titulo,
                'currentPage' => $currentPage,
                'numPages' => $numPages,                
                'ide' => $ide,
            );

            return $app['twig']->render('reclamacoes.html.twig', $data);
            
        }else{
            $limit = 5;
            
            $aEmpMaisProcurados = $app['repository.empreendimento']->findAll($limit);  
          
            $data = array(
                'aEmpMaisProcurados' => $aEmpMaisProcurados,
                'aLista' => array(),
                'currentPage' => 1,
                'numPages' => 0,
                'here' => $app['url_generator']->generate('principal'),
            );
            
            return $app['twig']->render('index.html.twig',$data);
        }
    }
    public function buscarAction(Request $request, Application $app)
    {

        $limit = 5;
        $total = $app['repository.empreendimento']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $busca = $request->get("busca");

        $aLista = $app['repository.empreendimento']->findAllWhere($limit,$offset,array(),$like);
        
        $aEmpMaisProcurados = $app['repository.empreendimento']->findAll(5);  
        
        $data = array(
            'aLista' => $aLista,
            'aEmpMaisProcurados' => $aEmpMaisProcurados,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('principal'),
        );
        return $app['twig']->render('index.html.twig',$data);
        
    }
    
    public function viewAction(Request $request, Application $app)
    {        
        $ide = $request->get("ide");
        $id = $request->get("id");

        $oEmp = $app['repository.empreendimento']->findIdNome($ide);

        if($oEmp){            
            if($id){
                $aLista = $app['repository.reclamacao']->find($id);
            
                $app['repository.reclamacao']->updateVisita($id);

                $titulo = ucwords(str_replace("-"," ",$ide));
                $sub_titulo = ucwords($oEmp->getBairro());
                $nome_empresa = $oEmp->getEmpresa()->getNome();
                $nome_emp = $oEmp->getNome();

                $data = array(
                    'nome_emp' => $nome_emp,
                    'nome_empresa' => $nome_empresa,
                    'reclamacao' => $aLista,
                    'titulo_empreendimento' => $titulo,
                    'sub_titulo' => $sub_titulo,       
                    'ide' => $ide,
                    'id' => $id,
                );
                return $app['twig']->render('view.html.twig', $data);
               
            }else{
                return $app->redirect("/$ide");
            }
        }
        return false;
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
