<?php

namespace Src\Controller;

use Src\Model\TipoEquipamentoDAO;
use Src\VO\TipoEquipamentoVO;

class TipoEquipamentoCTRL
{
    private $dao;

    public function __construct()
    {

        $this->dao = new TipoEquipamentoDAO;

    }

    public function CadastrarTipoEquipamentoCTRL(TipoEquipamentoVO $vo): int
    {

        // Validação das propriedades obrigatórias
        if (empty($vo->getNome()))
            return 0;

        // Setar as propriedades do LogErro
        $vo->setFuncaoErro(CADASTRAR_TIPO);

        return $this->dao->CadastrarTipoEquipamentoDAO($vo);

    }

    public function AlterarTipoEquipamentoCTRL(TipoEquipamentoVO $vo): int 
    {

        if (empty($vo->getNome()))
            return 0;

        $vo->setFuncaoErro(ALTERAR_TIPO);

        return $this->dao->AlterarTipoEquipamentoDAO($vo);

    }

    public function ExcluirTipoEquipamentoCTRL(TipoEquipamentoVO $vo): int 
    {

        if (empty($vo->getId()))
            return 0;

        $vo->setFuncaoErro(EXCLUIR_TIPO);

        return $this->dao->ExcluirTipoEquipamentoDAO($vo);

    }

    public function ConsultarEquipamentoCTRL(string $nome = ''): array 
    {

        return $this->dao->ConsultarTipoEquipamentoDAO($nome);

    }
    
}