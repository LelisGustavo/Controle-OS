<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\GerenciarSetorSQL;
use Src\VO\SetorVO;

class SetorDAO extends Conexao
{

    private $conexao;

    public function __construct()
    {

        $this->conexao = parent::retornarConexao();

    }

    public function CadastrarSetorDAO(SetorVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarSetorSQL::INSERIR_SETOR());
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

    public function AlterarSetorDAO(SetorVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarSetorSQL::ALTERAR_SETOR());
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

    public function ExcluirSetorDAO(SetorVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarSetorSQL::EXCLUIR_SETOR());
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

    public function ConsultarSetorDAO(string $nome = ''): array 
    {

        $sql = $this->conexao->prepare(GerenciarSetorSQL::CONSULTAR_SETOR($nome));
        if(!empty($nome)) {
            $sql->bindValue(1, '%' . $nome . '%');
        }
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

}