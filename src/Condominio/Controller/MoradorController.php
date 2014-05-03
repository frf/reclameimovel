<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Reclamacao;
use Condominio\Form\Type\ReclamacaoType;

class MoradorController
{
    public function indexAction(Request $request, Application $app)
    {
      
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
  
    
    public function adicionarAction(Request $request, Application $app)
    {
        $reclamacao = new Reclamacao();
        $form = $app['form.factory']->create(new ReclamacaoType(), $reclamacao);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $app['repository.reclamacao']->save($reclamacao);
                $message = 'The reclamacao ' . $reclamacao->getTitulo() . ' has been saved.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('reclamacao_add', array('reclamacao' => 1));
                return $app->redirect($redirect);
            }
        }

        $data = array(
            'form' => $form->createView(),
            'title' => 'Nova reclamação',
        );
        return $app['twig']->render('form.html.twig', $data);
    }

    public function editAction(Request $request, Application $app)
    {
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

    public function deleteAction(Request $request, Application $app)
    {
        $reclamacao = $request->attributes->get('reclamacao');
        if (!$reclamacao) {
            $app->abort(404, 'The requested reclamacao was not found.');
        }

        $app['repository.reclamacao']->delete($reclamacao);
        return $app->redirect($app['url_generator']->generate('admin_reclamacaos'));
    }
}
