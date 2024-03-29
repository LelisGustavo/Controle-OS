<?php

namespace Src\Resource\api\Classe;

class ApiRequest
{

    private $method_avaliable = ['POST'];
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function CheckMethod($method)
    {
        return in_array($method, $this->method_avaliable);
    }

    # GET E SET do METHOD
    public function SetMethod($m)
    {
        $this->data['method'] = $m;
    }
    public function GetMethod()
    {
        return $this->data['method'];
    }

    # GET E SET do endpoint
    public function SetEndPoint($p)
    {
        $this->data['endpoint'] = $p;
    }
    public function GetEndPoint()
    {
        return $this->data['endpoint'];
    }

    public function SendResponse()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
        exit;
    }

    public function SendData($msg = '', $result, $status)
    {
        $this->data = [
            'status' => $status,
            'message' => $msg,
            'result' => $result
        ];
        $this->SendResponse();
    }

}
