<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Form\Type\EmpreendimentoType;

class IndexController
{
    public function indexAction(Request $request, Application $app)
    {
        $idnome = $request->get("idnome");
        
        $oEmp = $app['repository.empreendimento']->findIdNome($idnome);
        
        
        if($oEmp){
            $app['repository.empreendimento']->updateVisita($oEmp->getId());
            
            $nome_empresa = $oEmp->getEmpresa()->getNome();
            $nome_emp = $oEmp->getNome();
            $ide = $oEmp->getId();
            
            $limit = 5;
            
            $total = $app['repository.reclamacao']->getCountReclamacao($ide);
            $totalSolucao = $app['repository.reclamacao']->getCountSolucao($ide);
            
            $numPages = ceil($total / $limit);
            $currentPage = $request->query->get('page', 1);
            $offset = ($currentPage - 1) * $limit;
            
            $aLista = $app['repository.reclamacao']->findReclamacaoEmpreendimento($limit, $offset,array(),$ide);                
            
            $data = array(
                'metaDescription' => "",
                'idnome' => $idnome,
                'busca' => "",
                'total' => $total,
                'solucao' => $totalSolucao,
                'aLista' => $aLista,
                'nome_emp' => $nome_emp,
                'nome_empresa' => $nome_empresa,
                'currentPage' => $currentPage,
                'numPages' => $numPages, 
                'here' => $app['url_generator']->generate('principal'),
            );

            return $app['twig']->render('reclamacoes.html.twig', $data);
            
        }else{
            
            $limit = 5;
            
            $aEmpMaisProcurados = $app['repository.empreendimento']->findAll($limit);  
          
            $data = array(
                'idnome' => $idnome,
                'metaDescription' => "",
                'busca' => "",
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

        $aLista = $app['repository.empreendimento']->findAllWhere($limit,$offset,array(),$busca);
        
        $aEmpMaisProcurados = $app['repository.empreendimento']->findAll(5);  
        
        $data = array(
            'metaDescription' => $metaDescription,
            'busca' => $busca,
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

        if(is_numeric($ide)){
            $oEmp = $app['repository.empreendimento']->find($ide);
        }else{
            $oEmp = $app['repository.empreendimento']->findIdNome($ide);    
        }

        if($oEmp){            
            if($id){
                $oReclamacao = $app['repository.reclamacao']->find($id);
            
                $app['repository.reclamacao']->updateVisita($id);

                $titulo             = ucwords(str_replace("-"," ",$ide));
                $sub_titulo         = ucwords($oEmp->getBairro());
                $nome_empresa       = $oEmp->getEmpresa()->getNome();
                $nome_emp           = $oEmp->getNome();
                $descricao          = $oReclamacao->getDescricao();
                $titulo_reclamacao  = $oReclamacao->getTitulo();
                $imagem             = $oReclamacao->getImagem();
                
                $txtReclamacao = substr("$nome_empresa - $nome_emp, $titulo_reclamacao -  $descricao", 0, 155);
                
                $data = array(
                    'metaDescription' => $txtReclamacao,
                    'nome_emp' => $nome_emp,
                    'descricao' => $descricao,
                    'nome_empresa' => $nome_empresa,
                    'reclamacao' => $oReclamacao,
                    'titulo_empreendimento' => $titulo,
                    'sub_titulo' => $sub_titulo,       
                    'ide' => $ide,
                    'id' => $id,
                    'imagem' => $imagem,
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
    
    public function empNovoAction(Request $request, Application $app) {
        
        /*
         * Pegar id da sessao
         */
        
        $form = $app['form.factory']->create(new EmpreendimentoType());

        $data = array(
            'metaDescription' => '',
            'form' => $form->createView(),
        );
        
        return $app['twig']->render('emp.html.twig', $data);
      
    }
    public function empCadastrarAction(Request $request, Application $app) {
        
        /*
         * Pegar id da sessao
         */
        if($app['token']){
            $uid = $app['token']->getUid();
            $user = $app['repository.user']->find($uid);
        }
        if (!$user) {
            $app->abort(404, 'Erro nenhum usuário encontrado.');
        }

        $user->setIdu($uid);
        
        $form = $app['form.factory']->create(new UserType(), $user);

        if ($request->isMethod('POST')) {
            
            $form->bind($request);
      
            if ($form->isValid()) {
                $app['repository.user']->saveAdicional($user);
                
                $message = 'Informações adicionadas com sucesso. Você já esta liberado para reclamar.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('principal');
                
                return $app->redirect($redirect);
            }

            return false;
            
        } 
    }
}
