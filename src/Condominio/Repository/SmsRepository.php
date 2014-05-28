<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\User;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * User repository
 */
class SmsRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
        
    }
    public function geraToken(){
        // URL que será feita a requisição
        $url = "http://api.directcallsoft.com/request_token";

        // CLIENT_ID que é fornecido pela DirectCall
        $client_id = "fabio@fsitecnologia.com.br";

        // CLIENT_SECRET que é fornecido pela DirectCall
        $client_secret = "1223649";

        // Dados em formato QUERY_STRING
        $data = http_build_query(array('client_id'=>$client_id, 'client_secret'=>$client_secret));

        $ch = 	curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($ch);

        curl_close($ch);

        // Converte os dados de JSON para ARRAY
        $dados = json_decode($return, true);

        //Token
        $access_token = $dados['access_token'];

        return $access_token;
    }
    public function sendSms($idu,$telCelular="",$texto="Seja bem vindo ao ReclameImovel.com.br"){
        
        // URL que será feita a requisição
        $urlSms = "http://api.directcallsoft.com/sms/send";

        // Numero de origem
        $origem = "5521992220009";

        // Numero de destino
        //$destino = "5521992220009";

        // Tipo de envio, podendo ser "texto" ou "voz"
        $tipo = "texto"; 

        // Texto a ser enviado
        //$texto = "Olá Mundo!";

        // Formato do retorno, pode ser JSON ou XML
        $format = "JSON";

        // Dados em formato QUERY_STRING
        $data = http_build_query(array('origem'=>$origem, 'destino'=>$telCelular, 'tipo'=>$tipo, 'access_token'=>$this->geraToken(), 'texto'=>$texto));

        $ch = 	curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $urlSms);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($ch);

        curl_close($ch);

        // Converte os dados de JSON para ARRAY
        $dados = json_decode($return, true);

        // Imprime o retorno
        /*echo "API: ".			$dados['api']."\n";
        echo "MODULO: ".		$dados['modulo']."\n";
        echo "STATUS: ".		$dados['status']."\n";
        echo "CODIGO: ".		$dados['codigo']."\n";
        echo "MENSAGEM: ".		$dados['msg']."\n";
        echo "CALLERID: ".		$dados['callerid']."\n";*/
        
        $userData = array(
            'idu'=>$idu,
            'status'=>$dados['status'],
            'codigo'=>$dados['codigo'],
            'msg'=>$dados['msg'],
            'telCelular'=>$telCelular,
            'dtCadastro'=>date('Y-m-d H:i:s')
        );
        
        $this->db->insert("sms",$data);
    }
    public function save($user)
    {       
    }
    public function delete($id)
    {
    }
    public function getCount() {       
    }
    public function find($id)
    {
    }
    public function bemVindo($id)
    {
    }
    public function updateBemVindo($id)
    {
    }
    public function updateMeuCondominio($id,$userData)
    {
    }    
    public function isDados($id)
    {
    }    
    public function saveAdicional($user)
    {
    }
    public function findAll($limit, $offset = 0, $orderBy = array())
    {        
    }
    protected function buildUser($userData)
    {
    }
    

}
