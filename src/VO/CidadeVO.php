<?php

namespace Src\VO;

use Src\_Public\Util;
class CidadeVO extends LogErroVO
{
    private $id;
    private $nome;
    private $id_estado;

    // GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // GET e SET NOME
    public function setNome($p_nome): void
    {
        $this->nome = Util::TratarDadosGeral($p_nome);
    }
    public function getNome(): string
    {
        return $this->nome;
    }

    // GET e SET ID ESTADO
    public function setEstado($p_estado): void
    {
        $this->id_estado = $p_estado;
    }
    public function getEstado(): string
    {
        return $this->id_estado;
    }
}