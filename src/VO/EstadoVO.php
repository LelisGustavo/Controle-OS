<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\LogErroVO;
class EstadoVO extends LogErroVO
{
    private $id;
    private $nome;
    private $sigla;

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
    public function setNomeEstado($p_nome): void
    {
        $this->nome = Util::TratarDadosGeral($p_nome);
    }
    public function getNomeEstado(): string
    {
        return $this->nome ?? null;
    }

    // GET e SET SIGLA
    public function setSigla($p_sigla): void
    {
        $this->sigla = Util::TratarDadosGeral($p_sigla);
    }
    public function getSigla(): string
    {
        return $this->sigla;
    }
}