<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\CidadeVO;

class EnderecoVO extends CidadeVO
{
    private $id;
    private $rua;
    private $bairro;
    private $cep;
    private $complemento;
    private $id_cidade;
    private $id_usuario;

    // GET e SET ID
    public function setIdEndereco($p_id): void
    {
        $this->id = $p_id;
    }
    public function getIdEndereco(): int
    {
        return $this->id;
    }

    // GET e SET RUA
    public function setRua($p_rua): void
    {
        $this->rua = Util::RemoverTags($p_rua);
    }
    public function getRua(): string
    {
        return $this->rua;
    }

    // GET e SET BAIRRO
    public function setBairro($p_bairro): void
    {
        $this->bairro = Util::RemoverTags($p_bairro);
    }
    public function getBairro(): string
    {
        return $this->bairro;
    }

    // GET e SET CEP
    public function setCep($p_cep): void
    {
        $this->cep = Util::TirarCaracteresEspeciais($p_cep);
    }
    public function getCep(): string
    {
        return $this->cep;
    }

    // GET e SET COMPLEMENTO
    public function setComplemento($p_complemento): void
    {
        $this->complemento = Util::RemoverTags($p_complemento);
    }
    public function getComplemento(): string
    {
        return $this->complemento;
    }

    // GET e SET ID CIDADE
    public function setCidade($p_cidade): void
    {
        $this->id_cidade = $p_cidade;
    }
    public function getCidade()
    {
        return $this->id_cidade;
    }

    // GET e SET ID USUARIO
    public function setUsuario($p_usuario): void
    {
        $this->id_usuario = $p_usuario;
    }
    public function getUsuario()
    {
        return $this->id_usuario;
    }
}

