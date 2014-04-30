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
        /*
        $limit = 4;
        $offset = 0;
        $likedOrderBy = array('likes' => 'DESC');
        $newestOrderBy = array('created_at' => 'DESC');
        $likedArtists = $app['repository.artist']->findAll($limit, $offset, $likedOrderBy);
        $newestArtists = $app['repository.artist']->findAll($limit, $offset, $newestOrderBy);
        // Divide artists into groups of 2.
        $groupSize = 2;
        $groupedLikedArtists = array();
        $groupedNewestArtists = array();
        $progress = 0;
        while ($progress < $limit) {
            $groupedLikedArtists[] = array_slice($likedArtists, $progress, $groupSize);
            $groupedNewestArtists[] = array_slice($newestArtists, $progress, $groupSize);
            $progress += $groupSize;
        }

        $data = array(
            'groupedLikedArtists' => $groupedLikedArtists,
            'groupedNewestArtists' => $groupedNewestArtists,
        );*/
        
        $aLista = array(1,2,3,4,5,6,7);
        
       
        
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
                'numPages' => $numPages,
                'here' => $app['url_generator']->generate('artists'),
            );
        
            return $app['twig']->render('lista_reclamacao.html.twig', $data);
        }else{
            return $app['twig']->render('index.html.twig');
        }
    }
}
