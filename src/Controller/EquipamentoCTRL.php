<?php

namespace Src\Controller;

use Src\Model\EquipamentoDAO;
use Src\VO\AlocarVO;
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

        // Uso de um ternario para saber se é uma alteração ou um cadastro e mandar para o LogErro (Se der um erro)
        $vo->setFuncaoErro(!empty($vo->getId()) ? ALTERAR_EQUIPAMENTO : CADASTRAR_EQUIPAMENTO);

        // Uso de um ternario no return para poder alterar ou cadastrar um novo equipamento
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

    public function AlocarEquipamentoCTRL(AlocarVO $vo): int 
    {

        if (empty($vo->getIdSetor()) || empty($vo->getIdEquipamento()))
            return 0;

        $vo->setSituacao(SITUACAO_ALOCADO);
        $vo->setFuncaoErro(ALOCAR_EQUIPAMENTO);

        return $this->dao->AlocarEquipamentoDAO($vo);

    }

    public function SelecionarEquipamentosNaoAlocadosCTRL(): array 
    {

        return $this->dao->SelecionarEquipamentosNaoAlocadosDAO(SITUACAO_REMOVIDO);

    }

    public function RemoverEquipamentoSetorCTRL(AlocarVO $vo): int 
    {

        if (empty($vo->getId()))
            return 0;

        $vo->setSituacao(SITUACAO_REMOVIDO);
        $vo->setFuncaoErro(REMOVER_EQUIPAMENTO_SETOR);

        return $this->dao->RemoverEquipamentoSetorDAO($vo);

    }

    public function SelecionarEquipamentosAlocadosCTRL(int $id_setor): array 
    {

        return $this->dao->SelecionarEquipamentosAlocadosDAO($id_setor, SITUACAO_REMOVIDO);

    }

    public function ConsultarEquipamentoSetorCTRL($setor = ''): array 
    {

        return $this->dao->ConsultarEquipamentoSetorDAO($setor);
        
    }

}