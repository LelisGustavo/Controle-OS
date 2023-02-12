<?php

namespace Src\Controller;

use Src\Model\ModeloEquipamentoDAO;
use Src\VO\ModeloEquipamentoVO;

class ModeloEquipamentoCTRL
{

    private $dao;

    public function __construct()
    {

        $this->dao = new ModeloEquipamentoDAO;

    }

    public function CadastrarModeloEquipamentoCTRL(ModeloEquipamentoVO $vo): int
    {

        if (empty($vo->getNome()))
            return 0;

        //Configurar o log
        $vo->setFuncaoErro(CADASTRAR_MODELO);

        return $this->dao->CadastrarModeloEquipamentoDAO($vo);

    }

    public function AlterarModeloEquipamentoCTRL(ModeloEquipamentoVO $vo): int
    {

        if (empty($vo->getNome()))
            return 0;

        $vo->setFuncaoErro(ALTERAR_MODELO);

        return $this->dao->AltererModeloEquipamentoDAO($vo);

    }

    public function ExcluirModeloEquipamentoCTRL(ModeloEquipamentoVO $vo): int
    {

        if (empty($vo->getId()))
            return 0;

        $vo->setFuncaoErro(EXCLUIR_MODELO);

        return $this->dao->ExcluirModeloEquipamentoDAO($vo);

    }

    public function ConsultarModeloEquipamentoCTRL(string $nome = ''): array 
    {

        return $this->dao->ConsultarModeloEquipamentoDAO($nome);

    }

}