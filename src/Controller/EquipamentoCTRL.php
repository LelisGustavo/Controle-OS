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
    public function GravarEquipamentoCTRL(EquipamentoVO $vo): int 
    {

        if (empty($vo->getTipoId()) || empty($vo->getModeloId() || empty($vo->getIdentificacao()) || empty($vo->getDescricao())))
            return 0;

        $vo->setFuncaoErro( !empty($vo->getId()) ? ALTERAR_EQUIPAMENTO : CADASTRAR_EQUIPAMENTO);

        return !empty($vo->getId()) ? $this->dao->AlterarEquipamentoDAO($vo) : $this->dao->CadastrarEquipamentoDAO($vo);

    }

    public function ConsultarEquipamentoCTRL($tipo = '', $modelo = '', $identificacao = ''): array 
    {

            return $this->dao->ConsultarEquipamentoDAO($tipo, $modelo, $identificacao);
        
    }

    public function ExcluirEquipamentoCTRL(EquipamentoVO $vo): int 
    {

        if (empty($vo->getId())) 
        return 0;

        $vo->setFuncaoErro(EXCLUIR_EQUIPAMENTO);

        return $this->dao->ExcluirEquipamentoDAO($vo);

    }

    public function DetalharEquipamentoCTRL(int $id)
    {

        return $this->dao->DetalharEquipamentoDAO($id);

    }

}