<?php

namespace Src\Controller;

use Src\Model\SetorDAO;
use Src\VO\SetorVO;

class SetorCTRL
{

    private $dao;

    public function __construct()
    {

        $this->dao = new SetorDAO;

    }

    public function CadastrarSetorCTRL(SetorVO $vo): int
    {

        if (empty($vo->getNome()))
            return 0;

        $vo->setFuncaoErro(CADASTRAR_SETOR);

        return $this->dao->CadastrarSetorDAO($vo);

    }

    public function AlterarSetorCTRL(SetorVO $vo): int 
    {

        if (empty($vo->getNome()))
            return 0;

        $vo->setFuncaoErro(ALTERAR_SETOR);

        return $this->dao->AlterarSetorDAO($vo);

    }

    public function ExcluirSetorCTRL(SetorVO $vo): int 
    {

        if (empty($vo->getId()))
            return 0;

        $vo->setFuncaoErro(EXCLUIR_SETOR);

        return $this->dao->ExcluirSetorDAO($vo);

    }

    public function ConsultarSetorCTRL(string $nome = ''): array 
    {

        return $this->dao->ConsultarSetorDAO($nome);

    }
}