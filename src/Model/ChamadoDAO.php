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

    public function AbrirChamadoDAO(ChamadoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::ABRIR_CHAMADO());
        $i = 1;
        $sql->bindValue($i++, $vo->getProblema());
        $sql->bindValue($i++, $vo->getDataAbertura());
        $sql->bindValue($i++, $vo->getHoraAbertura());
        $sql->bindValue($i++, $vo->getIdFuncionario());
        $sql->bindValue($i++, $vo->getIdAlocar());

        $this->conexao->beginTransaction();

        try {
            // Insere o chamado
            $sql->execute();

            // Atualizar a situação do alocamento
            $sql = $this->conexao->prepare(GerenciarChamadoSQL::ATUALIZAR_SITUACAO());
            $i = 1;
            $sql->bindValue($i++, $vo->getSituacao());
            $sql->bindValue($i++, $vo->getIdAlocar());
            $sql->execute();

            $this->conexao->commit();
            return 1;
        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);

            $this->conexao->rollBack();
            return -1;
        }
    }

    public function FiltrarChamadoDAO(int $situacao, ?int $id_setor, int $tipo_user): array|bool
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::FILTRAR_CHAMADO($situacao, $tipo_user));
        if ($tipo_user == PERFIL_FUNCIONARIO) {
            $sql->bindValue(1, $id_setor);
        }
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function DetalharChamadoIDDAO(int $id_chamado): array
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::DETALHAR_CHAMADO_ID());
        $sql->bindValue(1, $id_chamado);
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function AtenderChamadoDAO(ChamadoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::ATENDER_CHAMADO());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataAtendimento());
        $sql->bindValue($i++, $vo->getHoraAtendimento());
        $sql->bindValue($i++, $vo->getTecnicoAtendimento());
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

    public function FinalizarChamadoDAO(ChamadoVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::FINALIZAR_CHAMADO());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataEncerramento());
        $sql->bindValue($i++, $vo->getHoraEncerramento());
        $sql->bindValue($i++, $vo->getTecnicoEncerramento());
        $sql->bindValue($i++, $vo->getLaudo());
        $sql->bindValue($i++, $vo->getId());

        $this->conexao->beginTransaction();

        try {

            $sql->execute();

            $sql = $this->conexao->prepare(GerenciarChamadoSQL::ATUALIZAR_SITUACAO());
            $i = 1;
            $sql->bindValue($i++, $vo->getSituacao());
            $sql->bindValue($i++, $vo->getIdAlocar());
            $sql->execute();

            $this->conexao->commit();
            return 1;

        } catch (\Exception $ex) {

            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);

            $this->conexao->rollBack();
            return -1;

        }

    }

    public function MostrarDadosTempoRealChamadosDAO(): array 
    {

        $sql = $this->conexao->prepare(GerenciarChamadoSQL::NUMERO_TEMPO_REAL_CHAMADOS());
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);

    }
}
