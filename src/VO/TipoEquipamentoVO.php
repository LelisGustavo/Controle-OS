<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\LogErroVO;
class TipoEquipamentoVO extends LogErroVO
{
    private $id;
    private $nome;

    //GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    //GET e SET NOME
    public function setNome($p_nome): void
    {
        $this->nome = Util::TratarDadosGeralComEspacos($p_nome);
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}