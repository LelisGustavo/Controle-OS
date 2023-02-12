<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\GerenciarTipoEquipamentoSQL;
use Src\VO\ModeloEquipamentoVO;
use Src\Model\SQL\GerenciarModeloEquipamentoSQL;

class ModeloEquipamentoDAO extends Conexao
{

    private $conexao;

    public function __construct()
    {

        $this->conexao = parent::retornarConexao();

    }

    public function CadastrarModeloEquipamentoDAO(ModeloEquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarModeloEquipamentoSQL::INSERIR_MODELO_EQUIPAMENTO());
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

    public function AltererModeloEquipamentoDAO(ModeloEquipamentoVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarModeloEquipamentoSQL::ALTERAR_MODELO_EQUIPAMENTO());
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

    public function ExcluirModeloEquipamentoDAO(ModeloEquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarModeloEquipamentoSQL::EXCLUIR_MODELO_EQUIPAMENTO());
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

    public function ConsultarModeloEquipamentoDAO(string $nome = ''): array 
    {

        $sql = $this->conexao->prepare(GerenciarModeloEquipamentoSQL::CONSULTAR_MODELO_EQUIPAMENTO($nome));
        if (!empty($nome)) {
            $sql->bindValue(1, '%' . $nome . '%');
        }
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

}