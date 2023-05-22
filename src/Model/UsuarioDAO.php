<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\GerenciarUsuarioSQL;
use Src\VO\UsuarioVO;

class UsuarioDAO extends Conexao
{

    private $conexao;

    public function __construct()
    {

        $this->conexao = parent::retornarConexao();
    }

    public function CadastrarUsuairoDAO($vo): int
    {

        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_USUARIO());
        $i = 1;
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getEmail());
        $sql->bindValue($i++, $vo->getTelefone());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getStatus());

        $this->conexao->beginTransaction();

        try {

            // Executa a inserção do Usuario
            $sql->execute();

            // Recupera o ID do último cadastrado
            $id_user = $this->conexao->lastInsertId();

            // Logica para cadastrar o endereço
            // 1º passo: Verifica se o estado existe
            $sql = $this->conexao->prepare(GerenciarUsuarioSQL::SELECIONAR_ESTADO());
            $sql->bindValue(1, $vo->getSigla());
            $sql->execute();

            // Armazena a execução do SQL
            $existe_estado = $sql->fetchAll();

            // Verifica se encontrou
            if (count($existe_estado) > 0) {

                $id_estado = $existe_estado[0]['id'];
            } else { // Não encontrou

                $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_ESTADO());
                $sql->bindValue(1, $vo->getNomeEstado());
                $sql->bindValue(2, $vo->getSigla());
                $sql->execute();
                $id_estado = $this->conexao->lastInsertId();
            }

            // 2º passo: Verificar se a cidade existe
            $sql = $this->conexao->prepare(GerenciarUsuarioSQL::SELECIONAR_CIDADE());
            $sql->bindValue(1, $vo->getSigla());
            $sql->bindValue(2, $vo->getNomeCidade());
            $sql->execute();

            // Armazena a execução do SQL
            $existe_cidade = $sql->fetchAll();

            // Verifica se encontrou
            if (count($existe_cidade) > 0) {

                $id_cidade = $existe_cidade[0]['id'];
            } else { // Não encontrou

                $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_CIDADE());
                $sql->bindValue(1, $vo->getNomeCidade());
                $sql->bindValue(2, $id_estado);
                $sql->execute();
                $id_cidade = $this->conexao->lastInsertId();
            }

            // 3º passo: cadastra o endereço
            $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_ENDERECO());
            $i = 1;
            $sql->bindValue($i++, $vo->getRua());
            $sql->bindValue($i++, $vo->getBairro());
            $sql->bindValue($i++, $vo->getCep());
            $sql->bindValue($i++, $vo->getComplemento());
            $sql->bindValue($i++, $id_cidade);
            $sql->bindValue($i++, $id_user);
            // Cadastra o endereço
            $sql->execute();

            switch ($vo->getTipo()) {
                case PERFIL_TECNICO:

                    $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_TECNICO());
                    $i = 1;
                    $sql->bindValue($i++, $id_user);
                    $sql->bindValue($i++, $vo->getNomeEmpresa());
                    // Cadastra o técnico
                    $sql->execute();

                    break;

                case PERFIL_FUNCIONARIO:

                    $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_FUNCIONARIO());
                    $i = 1;
                    $sql->bindValue($i++, $id_user);
                    $sql->bindValue($i++, $vo->getIdSetor());
                    // Cadastra o funcionário
                    $sql->execute();

                    break;
            }
            // Confirma o processo
            $this->conexao->commit();
            return 1;
        } catch (\Exception $ex) {

            $this->conexao->rollBack();
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);

            return -1;
        }
    }

    public function VerificarEmailDuplicadoDAO(int $id, string $email): bool
    {

        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::VERIFICAR_EMAIL_DUPLICADO($id));
        $i = 1;
        $sql->bindValue($i++, $email);
        if ($id > 0) {
            $sql->bindValue($i++, $id);
        }
        $sql->execute();

        // É vazia a busca no banco de dado (se sim é uma alteração e returna false)/(se não é um cadastro e returna true)
        return empty($sql->fetch(\PDO::FETCH_ASSOC)['contar']) ? false : true;
    }

    public function FiltrarUsuarioDAO(string $nome, bool $ultimos_cad, ?int $qtd_reg): array
    {

        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::FILTRAR_USUARIOS($ultimos_cad));
        $i = 1;
        $sql->bindValue($i++, '%' . $nome . '%');
        if ($ultimos_cad) {
            $sql->bindValue($i++, $qtd_reg, \PDO::PARAM_INT); //3º Parametro não obrigatorio do bindValue, forçando o $qtd_reg ser INT
        }
        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function AlterarStatusUsuarioDAO(UsuarioVO $vo): int
    {

        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::ALTERAR_STATUS_USUARIO());
        $i = 1;
        $sql->bindValue($i++, $vo->getStatus());
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

    public function DetalharUsuarioDAO(int $id): array|bool
    {

        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::DETALHAR_USUARIO());
        $sql->bindValue(1, $id);
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);

    }

    public function AlterarUsuarioDAO($vo): int
    {

        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::ALTERAR_USUARIO());
        $i = 1;
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getEmail());
        $sql->bindValue($i++, $vo->getTelefone());
        $sql->bindValue($i++, $vo->getId());

        $this->conexao->beginTransaction();

        try {

            // Executa a atualização do Usuario
            $sql->execute();

            // Logica para cadastrar o endereço
            // 1º passo: Verifica se o estado existe
            $sql = $this->conexao->prepare(GerenciarUsuarioSQL::SELECIONAR_ESTADO());
            $sql->bindValue(1, $vo->getSigla());
            $sql->execute();

            // Armazena a execução do SQL
            $existe_estado = $sql->fetchAll();

            // Verifica se encontrou
            if (count($existe_estado) > 0) {

                $id_estado = $existe_estado[0]['id'];
            } else { // Não encontrou

                $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_ESTADO());
                $sql->bindValue(1, $vo->getNomeEstado());
                $sql->bindValue(2, $vo->getSigla());
                $sql->execute();
                $id_estado = $this->conexao->lastInsertId();
            }

            // 2º passo: Verificar se a cidade existe
            $sql = $this->conexao->prepare(GerenciarUsuarioSQL::SELECIONAR_CIDADE());
            $sql->bindValue(1, $vo->getSigla());
            $sql->bindValue(2, $vo->getNomeCidade());
            $sql->execute();

            // Armazena a execução do SQL
            $existe_cidade = $sql->fetchAll();

            // Verifica se encontrou
            if (count($existe_cidade) > 0) {

                $id_cidade = $existe_cidade[0]['id'];
            } else { // Não encontrou

                $sql = $this->conexao->prepare(GerenciarUsuarioSQL::INSERIR_CIDADE());
                $sql->bindValue(1, $vo->getNomeCidade());
                $sql->bindValue(2, $id_estado);
                $sql->execute();
                $id_cidade = $this->conexao->lastInsertId();
            }

            // 3º passo: atualiza o endereço
            $sql = $this->conexao->prepare(GerenciarUsuarioSQL::ALTERAR_ENDERECO());
            $i = 1;
            $sql->bindValue($i++, $vo->getRua());
            $sql->bindValue($i++, $vo->getBairro());
            $sql->bindValue($i++, $vo->getCep());
            $sql->bindValue($i++, $vo->getComplemento());
            $sql->bindValue($i++, $id_cidade);
            $sql->bindValue($i++, $vo->getIdEndereco());
            // Atualiza o endereço
            $sql->execute();

            switch ($vo->getTipo()) {
                case PERFIL_TECNICO:

                    $sql = $this->conexao->prepare(GerenciarUsuarioSQL::ALTERAR_TECNICO());
                    $i = 1;
                    $sql->bindValue($i++, $vo->getNomeEmpresa());
                    $sql->bindValue($i++, $vo->getId());
                    // Atualiza o técnico
                    $sql->execute();

                    break;

                case PERFIL_FUNCIONARIO:

                    $sql = $this->conexao->prepare(GerenciarUsuarioSQL::ALTERAR_FUNCIONARIO());
                    $i = 1;
                    $sql->bindValue($i++, $vo->getIdSetor());
                    $sql->bindValue($i++, $vo->getId());
                    // Atualiza o funcionário
                    $sql->execute();

                    break;
            }
            // Confirma o processo
            $this->conexao->commit();
            return 1;
        } catch (\Exception $ex) {

            $this->conexao->rollBack();
            $vo->setMsgErro($ex->getMessage());
            parent::GravarErroLog($vo);

            return -1;
        }
        
    }

    public function ValidarLoginDAO(string $login, int $status): array
    {
        
        $sql = $this->conexao->prepare(GerenciarUsuarioSQL::VALIDAR_LOGIN());
        $sql->bindValue(1, $login);
        $sql->bindValue(2, $status);
        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);

    }
}
