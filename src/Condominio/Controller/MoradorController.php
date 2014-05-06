<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Entity\Empreendimento;
use Condominio\Form\Type\ReclamacaoType;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;

class MoradorController {

    public function indexAction(Request $request, Application $app) {

        // Perform pagination logic.
        $limit = 20;
        $total = $app['repository.reclamacao']->getCount();
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;
        $aLista = $app['repository.reclamacao']->findAll($limit, $offset);

        $data = array(
            'active' => 'morador',
            'aLista' => $aLista,
            'currentPage' => $currentPage,
            'numPages' => $numPages
        );

        return $app['twig']->render('minhas_rec.html.twig', $data);
    }

    public function adicionarAction(Request $request, Application $app) {
        $ide = $request->get("ide");
        $oEmp = $app['repository.empreendimento']->findIdNome($ide);
        
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
        $reclamacao->setIdu($app['token']->getUid());

        $form = $app['form.factory']->create(new ReclamacaoType(), $reclamacao);

        if ($request->isMethod('POST')) {
            $token = $app['token']->getAccessToken()->getAccessToken();
            $session = new FacebookSession($token);            
            
            if($session) {

              try {
                $request = new FacebookRequest($session, 'GET', '/me/feed',array('link' => 'www.fabiofarias.com.br',
                                    'message' => 'User provided message'));
                $response = $request->execute();
                $graphObject = $response->getGraphObject();
                
              } catch(FacebookRequestException $e) {

                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();

              }   

            }


            $form->bind($request);

            if ($form->isValid()) {
                $app['repository.reclamacao']->save($reclamacao);
                $message = 'Reclamação salva com sucesso.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('principal');
                
                return $app->redirect($redirect);
            }

            return false;
        } else {
            $sub_titulo = ucwords(str_replace("-", " ", $ide) . " - " . $oEmp->getBairro());

            $data = array(
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
