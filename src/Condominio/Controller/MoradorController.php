<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Entity\Empreendimento;
use Condominio\Entity\Imagem;
use Condominio\Form\Type\ReclamacaoType;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;


class MoradorController {

    public function indexAction(Request $request, Application $app) {
        
        $data = array(
            'active'=>'morador',
            'metaDescription'=>'',
        );
        
        return $app['twig']->render('morador.html.twig',$data);
    }
    public function minhasReclamacoesAction(Request $request, Application $app) {

        // Perform pagination logic.
        $limit = 2;
        $total = $app['repository.reclamacao']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        
        $offset = ($currentPage - 1) * $limit;
        
        $aLista = $app['repository.reclamacao']->findAll($limit, $offset);

        $data = array(
            'active'=>'minhas_reclamacoes',
            'metaDescription' => '',
            'active' => 'minhas_reclamacoes',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => $app['url_generator']->generate('minhas_reclamacoes'),
        );

        return $app['twig']->render('minhas_rec.html.twig', $data);
    }
    public function adicionarAction(Request $request, Application $app) {
        #$request = $app['request'];

        $idnome = $request->get("idnome");
        $oEmp = $app['repository.empreendimento']->findIdNome($idnome);
        
        $reclamacao = new Reclamacao();
        
        if ($request->isMethod('GET')) {
            if (!$oEmp) {
                $message = 'Nenhum empreendimento foi escolhido por favor efetue uma busca e clique nele para adicionar.';
                $app['session']->getFlashBag()->add('warning', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('principal');
                return $app->redirect($redirect);
            }
            /*
             * Pegar id do banco de dados
             */
            $reclamacao->setIde($oEmp->getId());
        }
        
        /*
         * Pegar id da sessao
         */
        if($app['token']){
            $uid = $app['token']->getUid();
        }else{
            $uid = 1;
        }
        
        $reclamacao->setIdu($uid);
        
        $form = $app['form.factory']->create(new ReclamacaoType(), $reclamacao);

        if ($request->isMethod('POST')) {
            
            $form->bind($request);

            $reclamacao->setFiles($request->files);
      
            if ($form->isValid()) {
                $app['repository.reclamacao']->save($reclamacao);
                
                //$this->imagemRepository
                if(count($reclamacao->getFiles())){
                    $oImagens = $request->files->get('reclamacao');

                    foreach($oImagens as $File){
                        $newFile = $app['repository.imagem']->handleFileUpload($File);
                        if($newFile){
                            $imagem = new Imagem();
                            $imagem->setFile($newFile);
                            $imagem->setIdr($reclamacao->getId());
                            $app['repository.imagem']->save($imagem);
                        }
                        
                    }
                }
          
                $message = 'Reclamação salva com sucesso.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('view');
                
                return $app->redirect($redirect."/".$reclamacao->getIde()."/".$reclamacao->getId());
            }

            return false;
        } else {
            $nome_empresa   = $oEmp->getEmpresa()->getNome();
            $nome_emp       = $oEmp->getNome();
            $bairro         = $oEmp->getBairro();
            
            $sub_titulo     = $nome_empresa. " - " . $nome_emp . " - " . $bairro;

            $data = array(
                'metaDescription' => '',
                'form' => $form->createView(),
                'title' => 'Nova reclamação',
                'sub_titulo' => $sub_titulo,
            );
            return $app['twig']->render('form.html.twig', $data);
        }
    }

    public function editAction(Request $request, Application $app) {
        $reclamacao = $request->attributes->get('reclamacao');

        if (!$reclamacao) {
            $app->abort(404, 'The requested reclamacao was not found.');
        }
        $form = $app['form.factory']->create(new ArtistType(), $reclamacao);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.reclamacao']->save($reclamacao);
                $message = 'The reclamacao ' . $reclamacao->getName() . ' has been saved.';
                $app['session']->getFlashBag()->add('success', $message);
            }
        }

        $data = array(
            'form' => $form->createView(),
            'title' => 'Edit reclamacao ' . $reclamacao->getName(),
        );
        return $app['twig']->render('form.html.twig', $data);
    }

    public function deleteAction(Request $request, Application $app) {
        $reclamacao = $request->attributes->get('reclamacao');
        if (!$reclamacao) {
            $app->abort(404, 'The requested reclamacao was not found.');
        }

        $app['repository.reclamacao']->delete($reclamacao);
        return $app->redirect($app['url_generator']->generate('admin_reclamacaos'));
    }

}
