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

}