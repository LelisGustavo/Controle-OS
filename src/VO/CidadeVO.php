<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\EstadoVO;
class CidadeVO extends EstadoVO
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
    public function setNomeCidade($p_nome): void
    {
        $this->nome = Util::TratarDadosGeral($p_nome);
    }
    public function getNomeCidade(): string
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