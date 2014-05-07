<?php

namespace Condominio\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Condominio\Entity\Empreendimento;

class EmpreendimentoController {

    public function apiAction(Request $request, Application $app) {

        $limit = $request->query->get('limit', 20);
        $offset = $request->query->get('offset', 0);
        $emps = $app['repository.empreendimento']->findAll($limit, $offset);
        $data = array();
        foreach ($emps as $emp) {
            $data[] = array(
                'id' => $emp->getId(),
                'nome' => $emp->getNome(),
            );
        }
        return $app->json($data);
    }

}
