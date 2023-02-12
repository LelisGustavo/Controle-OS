<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\GerenciarEquipamentoSQL;
use Src\VO\EquipamentoVO;

class EquipamentoDAO extends Conexao 
{

    private $conexao;

    public function __construct()
    {

        $this->conexao = parent::retornarConexao();

    }

    public function CadastrarEquipamentoDAO(EquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::INSERIR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getIdentificacao());
        $sql->bindValue($i++, $vo->getDescricao());
        $sql->bindValue($i++, $vo->getModeloId());
        $sql->bindValue($i++, $vo->getTipoId());

        try {

            $sql->execute();

            return 1;

        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
            
        }

    }
    public function AlterarEquipamentoDAO(EquipamentoVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::ALTERAR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getIdentificacao());
        $sql->bindValue($i++, $vo->getDescricao());
        $sql->bindValue($i++, $vo->getModeloId());
        $sql->bindValue($i++, $vo->getTipoId());
        $sql->bindValue($i++, $vo->getId());

        try {

            $sql->execute();

            return 1;

        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
            
        }
        
    }

    public function ConsultarEquipamentoDAO(string $nome = ''): array 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::CONSULTAR_EQUIPAMENTO($nome));
        if(empty($nome)) {
            $sql->bindValue(1, '%' . $nome . '%');
        }
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }


}