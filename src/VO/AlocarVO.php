<?php

namespace Src\VO;

use Src\_Public\Util;

class AlocarVO extends LogErroVO
{

    private $id;
    private $situacao;
    private $id_setor;
    private $id_equipamento;

    // GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    //GET e SET DATA ALOCAR
    public function getDataAlocar(): string
    {
        return Util::DataHoraAtual();
    }

    //GET e SET DATA REMOVER
    public function getDataRemover(): string
    {
        return Util::DataHoraAtual();
    }

    //GET e SET SITUAÇÃO
    public function setSituacao($p_situacao): void
    {
        $this->situacao = $p_situacao;
    }
    public function getSituacao(): string 
    {
        return $this->situacao;
    }

    //GET e SET ID EQUIPAMENTO
    public function setIdEquipamento($p_id_equipamento): void
    {
        $this->id_equipamento = $p_id_equipamento;
    }
    public function getIdEquipamento(): string
    {
        return $this->id_equipamento;
    }

    //GET e SET ID SETOR
    public function setIdSetor($p_id_setor): void
    {
        $this->id_setor = $p_id_setor;
    }
    public function getIdSetor(): string 
    {
        return $this->id_setor;
    }

}