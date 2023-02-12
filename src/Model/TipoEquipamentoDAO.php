<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\VO\TipoEquipamentoVO;
use Src\Model\SQL\GerenciarTipoEquipamentoSQL;

class TipoEquipamentoDAO extends Conexao
{
    private $conexao;
    public function __construct()
    {

        $this->conexao = parent::retornarConexao();
        
    }
    public function CadastrarTipoEquipamentoDAO(TipoEquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarTipoEquipamentoSQL::INSERIR_TIPO_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getNome());

        try {

            $sql->execute();

            return 1;

        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;

        }

    }

    public function AlterarTipoEquipamentoDAO(TipoEquipamentoVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarTipoEquipamentoSQL::ALTERAR_TIPO_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getNome());
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

    public function ExcluirTipoEquipamentoDAO(TipoEquipamentoVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarTipoEquipamentoSQL::EXCLUIR_TIPO_EQUIPAMENTO());
        $i = 1;
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

    public function ConsultarTipoEquipamentoDAO(string $nome = ''): array 
    {

        $sql = $this->conexao->prepare(GerenciarTipoEquipamentoSQL::CONSULTAR_TIPO_EQUIPAMENTO($nome));
        if(!empty($nome)) {
            $sql->bindValue(1, '%' . $nome . '%');
        }
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

}