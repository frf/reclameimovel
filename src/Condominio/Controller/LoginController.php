<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class LoginController
{
    public function loginAction(Request $request, Application $app)
    {
        
        $services = array_keys($app['oauth.services']);

        return $app['twig']->render('login.html.twig', array(
            'login_paths' => array_map(function ($service) use ($app) {
                return $app['url_generator']->generate('_auth_service', array(
                    'service' => $service,
                    '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('oauth')
                ));
            }, array_combine($services, $services)),
            'logout_path' => $app['url_generator']->generate('logout', array(
                '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('logout')
            ))
        ));
        
        /*$form = $app['form.factory']->createBuilder('form')
            ->add('idface', 'text', array('label' => 'Idface','data' => $app['session']->get('_security.last_idface')))
            ->add('login', 'submit')
            ->getForm();

        $data = array(
            'form'  => $form->createView(),
            'error' => $app['security.last_error']($request),
        );
        return $app['twig']->render('login.html.twig', $data);*/
    }
    
}
