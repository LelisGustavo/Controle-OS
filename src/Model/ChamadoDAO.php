<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\GerenciarChamadoSQL;
use Src\VO\ChamadoVO;

class ChamadoDAO extends Conexao 
{

    private $conexao;

    public function __construct()
    {

        $this->conexao = parent::retornarConexao();

    }

    public function ListarEquipamentosChamadoSetorDAO(ChamadoVO $vo)
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::LISTAR_EQUIPAMENTOS_CHAMADO_SETOR());
        $i = 1;
        $sql->bindValue($i++, $vo->getIdSetor());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

}
