<?php

require_once dirname(__DIR__, 3) . '\vendor\autoload.php';

use Src\Resource\api\Classe\TecnicoAPI;

$api = new TecnicoAPI();

//Seta o verbo a ser enviado
$api->SetMethod($_SERVER['REQUEST_METHOD']);

if (!$api->CheckMethod($api->GetMethod())) {
    $api->SendData('METHOD INVALID', -1, 'ERROR');
}

//Recupera o cabeçalho
$get_data = getallheaders();

//Verifica se veio em JSON
$json = str_contains($get_data['Content-Type'], 'application/json') ? true : false;

//recupera a informação
if ($json) {

    $dados = file_get_contents('php://input');
    $dados = json_decode($dados, true);
} else {

    $dados = $_POST;
}

//--------------------------------

$api->SetEndPoint($dados['endpoint']);

if (!$api->CheckEndPoint($api->GetEndPoint())) {
    $api->SendData('ENDPOINT INVALID', -1, 'ERROR');
}

$api->AddParameters($dados);

$result = $api->{$api->GetEndPoint()}();

$api->SendData('Resultado', $result, 1);


