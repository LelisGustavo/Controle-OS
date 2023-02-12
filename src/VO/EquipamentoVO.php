<?php

namespace Src\VO;

use Src\_Public\Util;
class EquipamentoVO extends LogErroVO
{
    private $id;
    private $identificacao;
    private $descricao;
    private $id_modelo;
    private $id_tipo;

    // GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // GET e SET IDENTIFICAÇÃO
    public function setIdentificacao($p_identificacao): void
    {
        $this->identificacao = Util::RemoverTags($p_identificacao);
    }
    public function getIdentificacao(): string
    {
        return $this->identificacao;
    }

    // GET e SET DESCRIÇÃO
    public function setDescricao($p_descricao): void
    {
        $this->descricao = Util::RemoverTags($p_descricao);
    }
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    //GET e SET ID MODELO
    public function setTModeloId($p_modelo_id): void
    {
        $this->id_modelo = $p_modelo_id;
    }
    public function getModeloId(): string 
    {
        return $this->id_modelo;
    }

    //GET e SET ID TIPO
    public function setTipoId($p_tipo): void
    {
        $this->id_tipo = $p_tipo;
    }
    public function getTipoId(): string 
    {
        return $this->id_tipo;
    }
}