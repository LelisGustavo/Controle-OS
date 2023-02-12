<?php

namespace Src\VO;

use Src\_Public\Util;

class LogVO
{
    private $id;
    private $data;
    private $ip;
    private $id_usuario;


    //GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    //GET e SET DATA
    public function getData(): string
    {
        return Util::DataHoraAtual();
    }

    //GET e SET IP
    public function setIp($p_ip): void
    {
        $this->ip = Util::TirarCaracteresEspeciais($p_ip);
    }

    public function getIp(): string 
    {
        return $this->ip;
    }

    //GET e SET ID USUARIO
    public function setUsuario($p_id_usuario): void
    {
        $this->id_usuario = $p_id_usuario;
    }

    public function getUsuario(): int 
    {
        return $this->id_usuario;
    }
}