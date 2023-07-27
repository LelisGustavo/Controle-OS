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

    public function FiltrarChamadoCTRL(int $situacao, int $id_setor): array|bool 
    {

        return $this->dao->FiltrarChamadoDAO($situacao,$id_setor);

    }

    public function DetalharChamadoIDCTRL(int $id_chamado): array 
    {

        return $this->dao->DetalharChamadoIDDAO($id_chamado);

    }

}