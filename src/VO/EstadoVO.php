<?php

namespace Src\VO;

use Src\_Public\Util;
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
    public function setNome($p_nome): void
    {
        $this->nome = Util::TratarDadosGeral($p_nome);
    }
    public function getNome(): string
    {
        return $this->nome;
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