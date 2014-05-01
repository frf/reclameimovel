<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

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
}
