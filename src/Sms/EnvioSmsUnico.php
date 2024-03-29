<?php

/**
 * Exemplo de como enviar um sms pela API módulo de sms
 * Author: Team Developers DirectCall
 * Data: 2013-03-14
 * Referencia: http://teste2.directcallsoft.com:8090/pages/viewpage.action?pageId=524534
 */

// URL que será feita a requisição
$urlSms = "http://api.directcallsoft.com/sms/send";

// Numero de origem
$origem = "5521992220009";

// Numero de destino
$destino = "5521992220009";

// Tipo de envio, podendo ser "texto" ou "voz"
$tipo = "texto"; 

// Texto a ser enviado
$texto = "Olá Mundo!";

// Incluir o RequisitarToken.php para pegar o access_token
include("RequisitarToken.php");

// Formato do retorno, pode ser JSON ou XML
$format = "JSON";

// Dados em formato QUERY_STRING
$data = http_build_query(array('origem'=>$origem, 'destino'=>$destino, 'tipo'=>$tipo, 'access_token'=>$access_token, 'texto'=>$texto));

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
		echo "API: ".			$dados['api']."\n";
		echo "MODULO: ".		$dados['modulo']."\n";
		echo "STATUS: ".		$dados['status']."\n";
		echo "CODIGO: ".		$dados['codigo']."\n";
		echo "MENSAGEM: ".		$dados['msg']."\n";
		echo "CALLERID: ".		$dados['callerid']."\n";
