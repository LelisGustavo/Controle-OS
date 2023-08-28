<?php

namespace Src\Controller;

use Src\Model\ChamadoDAO;
use Src\VO\ChamadoVO;

class ChamadoCTRL
{

    private $dao;

    public function __construct()
    {

        $this->dao = new ChamadoDAO();

    }

    public function ListarEquipamentosChamadoSetorCTRL(ChamadoVO $vo)
    {

        $vo->setSituacao(SITUACAO_ALOCADO);

        return $this->dao->ListarEquipamentosChamadoSetorDAO($vo);

    }

    public function AbrirChamadoCTRL(ChamadoVO $vo): int 
    {

        if (empty($vo->getIdAlocar()) || empty($vo->getProblema()) || empty($vo->getIdFuncionario())) {
            return 0;
        }

        $vo->setFuncaoErro(ABRIR_CHAMADO);
        $vo->setSituacao(SITUACAO_MANUTENCAO);

        return $this->dao->AbrirChamadoDAO($vo);

    }

    public function FiltrarChamadoCTRL(int $situacao, ?int $id_setor, int $tipo_user): array|bool 
    {

        return $this->dao->FiltrarChamadoDAO($situacao, $id_setor, $tipo_user);

    }

    public function DetalharChamadoIDCTRL(int $id_chamado): array 
    {

        return $this->dao->DetalharChamadoIDDAO($id_chamado);

    }

    public function AtenderChamadoCTRL(ChamadoVO $vo): int
    {

        if (empty($vo->getId()) || empty($vo->getTecnicoAtendimento())) {
            return 0;
        }

        return $this->dao->AtenderChamadoDAO($vo);

    }

    public function FinalizarChamadoCTRL(ChamadoVO $vo): int
    {

        if (empty($vo->getId()) || empty($vo->getTecnicoEncerramento()) || empty($vo->getLaudo())) {
            return 0;
        }

        $vo->setSituacao(SITUACAO_ALOCADO);
        return $this->dao->FinalizarChamadoDAO($vo);

    }

    public function MostrarDadosTempoRealChamadosCTRL(): array 
    {

        return $this->dao->MostrarDadosTempoRealChamadosDAO();

    }

}