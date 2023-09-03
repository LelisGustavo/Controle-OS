<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\GerenciarEquipamentoSQL;
use Src\VO\AlocarVO;
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

    public function ConsultarEquipamentoDAO($tipo = '', $modelo = '', $identificacao = ''): array 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::CONSULTAR_EQUIPAMENTO($tipo, $modelo, $identificacao));

        $i = 1;

        if (!empty($tipo) && empty($modelo)) {
            
            $sql->bindValue($i++, $tipo);

            if (!empty($identificacao)) {
                $sql->bindValue($i++, '%' . $identificacao . '%');
            }

        }

        elseif (empty($tipo) && !empty($modelo)) {
            
            $sql->bindValue($i++, $modelo);

            if (!empty($identificacao)) {
                $sql->bindValue($i++, '%' . $identificacao . '%');
            }

        }

        elseif (!empty($tipo) && !empty($modelo)) {
            
            $sql->bindValue($i++, $tipo);
            $sql->bindValue($i++, $modelo);

            if (!empty($identificacao)) {
                $sql->bindValue($i++, '%' . $identificacao . '%');
            }

        }

        elseif (empty($tipo) && empty($modelo) && !empty($identificacao)) {

            $sql->bindValue($i++, '%' . $identificacao . '%');

        }  

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function ListarTodosEquipamentosDAO(): array
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::LISTAR_TODOS_EQUIPAMENTOS());
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function ExcluirEquipamentoDAO(EquipamentoVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::EXCLUIR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getId());

        try {

            $sql->execute();

            return 1;

        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());

            return -1;

        }

    }

    public function DetalharEquipamentoDAO(int $id)
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::DETALHAR_EQUIPAMENTO());
        $sql->bindValue(1, $id);
        
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);        

    }

    public function AlocarEquipamentoDAO(AlocarVO $vo): int 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::ALOCAR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataAlocar());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->bindValue($i++, $vo->getIdEquipamento());
        $sql->bindValue($i++, $vo->getIdSetor());

        try {

            $sql->execute();
            return 1;

        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;

        }

    }

    public function SelecionarEquipamentosNaoAlocadosDAO(int $situacao): array 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::SELECIONAR_EQUIPAMENTOS_NAO_ALOCADOS());
        $i = 1;
        $sql->bindValue($i++, $situacao);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function RemoverEquipamentoSetorDAO(AlocarVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::REMOVER_EQUIPAMENTO_SETOR());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataRemover());
        $sql->bindValue($i++, $vo->getSituacao());
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

    public function SelecionarEquipamentosAlocadosDAO(int $id_setor, int $situacao): array
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::SELECIONAR_EQUIPAMENTOS_ALOCADOS());
        $i = 1;
        $sql->bindValue($i++, $id_setor);
        $sql->bindValue($i++, $situacao);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function ConsultarEquipamentoSetorDAO($setor = ''): array 
    {

        $sql = $this->conexao->prepare(GerenciarEquipamentoSQL::CONSULTAR_EQUIPAMENTO_SETOR());
        $sql->bindValue(1, $setor);
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);

    }

}