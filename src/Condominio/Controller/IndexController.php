<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Form\Type\EmpreendimentoType;
use Condominio\Entity\Empreendimento;


use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\GraphLocation;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookCanvasLoginHelper;

class IndexController {

    public function indexAction(Request $request, Application $app) {
        $idnome = $request->get("idnome");
        $page = $request->get("page", 1);
        $busca = $request->get("busca");

        if($app['token']){
            var_dump($app['token']->accessToken->getAcessToken());
        }
        
        /*$session = new FacebookSession('access-token-here');
        
        FacebookSession::setDefaultApplication('237093413164290', '8f94031a4b4a962543c33747c1a2e6e7');
        
        $helper = new FacebookCanvasLoginHelper();
        try {
          $session = $helper->getSession();
        } catch(FacebookRequestException $ex) {
          // When Facebook returns an error
        } catch(\Exception $ex) {
          // When validation fails or other local issues
        }
        
        var_dump($session);
        
        
        if ($session) {
          // Logged in
            var_dump($session);
        }
*/
        exit;
        if ($idnome != "buscar" && $idnome != "") {
            $oEmp = $app['repository.empreendimento']->findIdNome($idnome);
        }
        
        /*
         * Pegar id da sessao
         */
        if($app['token']){
            $uid = $app['token']->getUid();
            $validBemVindo = $app['repository.user']->bemVindo($uid);
            
             if ($validBemVindo) {                
                /*
                * Enviar email
                */
                $body = $app['twig']->render('emailBemVindo.html.twig',
                        array(
                            'name' => $validBemVindo->getName(),
                            'mail' => $validBemVindo->getEmail(),
                        ));

                $message = \Swift_Message::newInstance()
                                ->setSubject('[Reclame Imóvel] Parabéns pelo cadastro. ')
                                ->setFrom(array('contato@reclameimovel.com.br'=>'Reclame Imóvel'))
                                ->setTo(array($validBemVindo->getEmail()=>$validBemVindo->getName()))
                                ->setBody($body)
                                ->setContentType("text/html");

                $app['mailer']->send($message);                        
                $app['repository.user']->updateBemVindo($uid);
            }
        
        }
        
        

        if ($oEmp) {
            $app['repository.empreendimento']->updateVisita($oEmp->getId());

            $nome_empresa = $oEmp->getEmpresa()->getNome();
            $nome_emp = $oEmp->getNome();
            $ide = $oEmp->getId();

            $limit = 5;

            $total = $app['repository.reclamacao']->getCountReclamacao($ide);
            $totalSolucao = $app['repository.reclamacao']->getCountSolucao($ide);

            $numPages = ceil($total / $limit);
            $currentPage = $page;
            $offset = ($currentPage - 1) * $limit;

            $aLista = $app['repository.reclamacao']->findReclamacaoEmpreendimento($limit, $offset, array(), $ide);

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
                'here' => $idnome,
                'adjacentes' => 2,
                'uri' => '/empreendimento'
            );

            return $app['twig']->render('reclamacoes.html.twig', $data);
            
        } else {
            if ($busca) {
                $limit = 5;
                $total = $app['repository.empreendimento']->getCountBusca($busca);
                $numPages = ceil($total / $limit);
                $currentPage = $page;
                $offset = ($currentPage - 1) * $limit;
                $aLista = $app['repository.empreendimento']->findAllWhere($limit, $offset, array(), $busca);
            }
            $aEmpMaisProcurados = $app['repository.empreendimento']->findAllWhere(5);

            $data = array(
                'idnome' => $idnome,
                'metaDescription' => "Busca os empreendimentos",
                'busca' => $busca,
                'aEmpMaisProcurados' => $aEmpMaisProcurados,
                'currentPage' => $currentPage,
                'numPages' => $numPages,
                'here' => "buscar",
                'adjacentes' => 1,
                'uri' => '/empreendimento'
            );

            $data['aLista'] = $aLista;
            $data['exibeErro'] = false;
            
            return $app['twig']->render('index.html.twig', $data);
        }
    }

    public function buscarAction(Request $request, Application $app) {

        $busca = $request->get("busca", "");
        $page = $request->get("page", 1);

        $limit = 5;
        $total = $app['repository.empreendimento']->getCountBusca($busca);
        $numPages = ceil($total / $limit);
        $currentPage = $request->query->get('page', 1);
        $offset = ($currentPage - 1) * $limit;

        $aLista = $app['repository.empreendimento']->findAllWhere($limit, $offset, array(), $busca);
        $aEmpMaisProcurados = $app['repository.empreendimento']->findAll(5);

        $data = array(
            'metaDescription' => $metaDescription,
            'busca' => $busca,
            'aEmpMaisProcurados' => $aEmpMaisProcurados,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'here' => "buscar",
            'adjacentes' => 1,
            'uri' => '/empreendimento'
        );

        if ($aLista) {
            $data['aLista'] = $aLista;
            $data['exibeErro'] = false;
        } else {
            $data['aLista'] = false;
            $data['exibeErro'] = true;
        }

        return $app['twig']->render('index.html.twig', $data);
    }

    public function viewAction(Request $request, Application $app) {
        $ide = $request->get("ide");
        $id = $request->get("id");

        if (is_numeric($ide)) {
            $oEmp = $app['repository.empreendimento']->find($ide);
        } else {
            $oEmp = $app['repository.empreendimento']->findIdNome($ide);
        }

        if ($oEmp) {
            if ($id) {
                $oReclamacao = $app['repository.reclamacao']->find($id);

                $app['repository.reclamacao']->updateVisita($id);

                $titulo = ucwords(str_replace("-", " ", $ide));
                $sub_titulo = ucwords($oEmp->getBairro());
                $nome_empresa = $oEmp->getEmpresa()->getNome();
                $nome_emp = $oEmp->getNome();
                $descricao = $oReclamacao->getDescricao();
                $titulo_reclamacao = $oReclamacao->getTitulo();
                $imagem = $oReclamacao->getImagem();

                $txtReclamacao = substr("$nome_empresa - $nome_emp, $titulo_reclamacao -  $descricao", 0, 155);

		$aYoutube = explode("=",$oReclamacao->getYoutube());

                $data = array(
                    'youtube' => $aYoutube[1],
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
            } else {
                return $app->redirect("/$ide");
            }
        }
        return false;
    }




    public function moradorAction(Request $request, Application $app) {
        return $app['twig']->render('morador.html.twig');
    }
    public function emailbemvindoAction(Request $request, Application $app) {
        
        $data = array(
            'mail'=>'fabio@fabiofarias.com.br',
            'name'=>'Fabio'
        );
        
        return $app['twig']->render('emailCadastroReclamacao.html.twig',$data);
    }

    public function construtoraAction(Request $request, Application $app) {
        return $app['twig']->render('construtora.html.twig');
    }
    public function termoAction(Request $request, Application $app) {
        return $app['twig']->render('termo.html.twig',array('metaDescription'=>'Termo de uso do Reclame Imóvel'));
    }
    public function quemsomosAction(Request $request, Application $app) {
        return $app['twig']->render('quemsomos.html.twig',array('metaDescription'=>'Quem somos?'));
    }

    public function empNovoAction(Request $request, Application $app) {

        $emp = new Empreendimento();

        if ($app['token']) {
            $uid = $app['token']->getUid();
            $user = $app['repository.user']->find($uid);
        } else {
            $uid = 1;
        }

        $emp->setIdu($uid);

        $form = $app['form.factory']->create(new EmpreendimentoType(), $emp);

        $data = array(
            'metaDescription' => '',
            'form' => $form->createView(),
        );

        return $app['twig']->render('emp.html.twig', $data);
    }

    public function empCadastrarAction(Request $request, Application $app) {

        $emp = new Empreendimento();

        if ($app['token']) {
            $uid = $app['token']->getUid();
            $user = $app['repository.user']->find($uid);
        } else {
            $uid = 1;
        }

        $emp->setIdu($uid);

        $form = $app['form.factory']->create(new EmpreendimentoType(), $emp);

        if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {
                $app['repository.empreendimento']->saveTmp($emp);

                $message = 'Informações adicionadas com sucesso. Em até 24hs entraremos em contato para liberar cadastro das reclamações do seu empreendimento.';
                $app['session']->getFlashBag()->add('success', $message);
                // Redirect to the edit page.
                $redirect = $app['url_generator']->generate('principal');

                return $app->redirect($redirect);
            }

            return false;
        }
    }

}
