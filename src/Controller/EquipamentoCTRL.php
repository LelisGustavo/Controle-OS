<?php

namespace Src\Controller;

use Src\Model\EquipamentoDAO;
use Src\VO\EquipamentoVO;

class EquipamentoCTRL
{

    private $dao;

    public function __construct()
    {

        $this->dao = new EquipamentoDAO();

    }


    //Servirá tanto para inserir quanto para alterar
    public function CadastrarEquipamentoCTRL(EquipamentoVO $vo)
    {

        if (empty($vo->getTipoId()) || empty($vo->getModeloId() || empty($vo->getIdentificacao()) || empty($vo->getDescricao())))
            return 0;

        $vo->setFuncaoErro(CADASTRAR_EQUIPAMENTO);

        return $this->dao->CadastrarEquipamentoDAO($vo);

    }

    public function ConsultarEquipamentoCTRL(string $nome = ''): array 
    {

        return $this->dao->ConsultarEquipamentoDAO($nome);

    }

}