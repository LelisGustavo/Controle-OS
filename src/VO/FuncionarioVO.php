<?php

namespace Src\VO;

use Src\VO\UsuarioVO;

class FuncionarioVO extends UsuarioVO
{

    private $id_setor;

    //GET e SET ID SETOR
    public function setIdSetor($p_id_setor): void
    {
        $this->id_setor = $p_id_setor;
    }
    public function getIdSetor(): int
    {
        return $this->id_setor;
    }

}
