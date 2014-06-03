<?php
/*
	Autor:FabioRocha
*/
namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Noticia;

class NoticiaController {

    public function indexAction(Request $request, Application $app) {
        $categoria  = $request->get("categoria");

        $aNoticia = $app['repository.noticia']->findAllWhere($categoria);

        $data = array(
            'metaDescription' => "",
            'oNoticia' => $aNoticia
        );
        
        return $app['twig']->render('lista-noticia.html.twig', $data);
        
    }
    public function viewAction(Request $request, Application $app) {
        $id  = $request->get("id");

        $oNoticia = $app['repository.noticia']->find($id);

        if(!$oNoticia){
            $message = 'Nenhuma informação encontrada desculpe.';
            $app['session']->getFlashBag()->add('success', $message);
            // Redirect to the edit page.
            $redirect = $app['url_generator']->generate('principal');
            
            return $app->redirect($redirect);
        }
        $data = array(
            'metaDescription' => substr($oNoticia->getDescricao() . " - Dicas e notícias para poder lhe ajudar, advogados, pintores, manutenção e tudo que procura em um só lugar.",0,250),
            'oNoticia' => $oNoticia
        );
        
        return $app['twig']->render('noticia.html.twig', $data);
        
    }

}
