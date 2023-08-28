<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\Model\UsuarioDAO;
use Src\VO\UsuarioVO;

class UsuarioCTRL
{

    private $dao;

    public function __construct()
    {

        $this->dao = new UsuarioDAO;
    }

    public function CadastrarUsuarioCTRL($vo)
    {

        if (
            empty($vo->getNome()) || empty($vo->getTelefone()) || empty($vo->getEmail()) || empty($vo->getTipo())
            || empty($vo->getCep()) || empty($vo->getRua()) || empty($vo->getBairro()) || empty($vo->getSigla())
            || empty($vo->getNomeCidade())
        )
            return 0;


        if ($vo->getTipo() == PERFIL_TECNICO && empty($vo->getNomeEmpresa()))
            return 0;


        if ($vo->getTipo() == PERFIL_FUNCIONARIO && empty($vo->getIdSetor()))
            return 0;

        // Setar propriedades do usuario
        $vo->setStatus(ATIVO);
        $senha = explode('@', $vo->getEmail())[0];
        $vo->setSenha(Util::CriptografarSenha($senha));
        // Setar as propriedades do LogErro
        $vo->setFuncaoErro(CADASTRAR_USUARIO);

        return $this->dao->CadastrarUsuairoDAO($vo);
    }

    public function VerificarEmailDuplicadoCTRL(int $id, string $email): bool
    {

        return $this->dao->VerificarEmailDuplicadoDAO($id, $email);
    }

    public function FiltrarUsuarioCTRL(string $nome, bool $ultimos_cad): array
    {

        return $this->dao->FiltrarUsuarioDAO($nome, $ultimos_cad, $ultimos_cad ? QTD_ULTIMOS_CADASTRADOS : null);
    }

    public function AlterarStatusUsuarioCTRL(UsuarioVO $vo): int
    {

        if (empty($vo->getId()) || $vo->getStatus() === '')
            return 0;

        $vo->setStatus($vo->getStatus() == ATIVO ? INATIVO : ATIVO);

        $vo->setFuncaoErro(ALTERAR_STATUS_USUARIO);

        return $this->dao->AlterarStatusUsuarioDAO($vo);
    }

    public function DetalharUsuarioCTRL(int $id): array|bool
    {

        return $this->dao->DetalharUsuarioDAO($id);
    }

    public function AlterarUsuarioCTRL($vo)
    {

        if (
            empty($vo->getNome()) || empty($vo->getTelefone()) || empty($vo->getEmail()) || empty($vo->getTipo())
            || empty($vo->getCep()) || empty($vo->getRua()) || empty($vo->getBairro()) || empty($vo->getSigla())
            || empty($vo->getNomeCidade())
        )
            return 0;


        if ($vo->getTipo() == PERFIL_TECNICO && empty($vo->getNomeEmpresa()))
            return 0;


        if ($vo->getTipo() == PERFIL_FUNCIONARIO && empty($vo->getIdSetor()))
            return 0;

        // Setar as propriedades do LogErro
        $vo->setFuncaoErro(ALTERAR_USUARIO);

        return $this->dao->AlterarUsuarioDAO($vo);
    }

    public function ValidarLoginCTRL(string $login, string $senha, int $tipo): int|string|null
    {

        if (empty($login) || empty($senha)) {
            return 0;
        }

        $user = $this->dao->ValidarLoginDAO($login, ATIVO, $tipo);

        // Teste para verificar se o login OU senha está inválido
        if (empty($user) || !Util::VerificarSenha($senha, $user['senha'])) {
            return -4;
        }

        if ($tipo == PERFIL_ADM) {

            Util::CriarSessao($user['id'], $user['nome']);
            Util::ChamarPagina('inicial_adm');
        } else {

            if ($tipo == PERFIL_FUNCIONARIO) 

                $dados_user = [
                    'id_logado' => $user['id'],
                    'nome_logado' => $user['nome'],
                    'setor_id' => $user['setor_id']
                ];
            else 

                $dados_user = [
                    'id_logado' => $user['id'],
                    'nome_logado' => $user['nome']
                ];
            
            $token = Util::CreateTokenAuthentication($dados_user);  
            return $token;
            
        }

    }

    public function ChecarSenhaUsuarioCTRL(int $id, string $senha_digitada): int
    {

        if (Util::AuthenticationTokenAccess()) {

            $senha_hash = $this->dao->RecuperarSenhaUsuarioDAO($id);

            return Util::VerificarSenha($senha_digitada, $senha_hash) ? 1 : -1;
        } else {
            return NAO_AUTORIZADO;
        }
    }

    public function AlterarSenhaUsuarioCTRL(UsuarioVO $vo)
    {

        if (empty($vo->getId()) || $vo->getSenha() === '')
            return 0;

        if (strlen($vo->getSenha()) < 6)
            return -5;

        if ($vo->getSenha() != $vo->getRepetirSenha())
            return -6;

        $criptografar_senha = $vo->getSenha();
        $vo->setSenha(Util::CriptografarSenha($criptografar_senha));

        $vo->setFuncaoErro(ALTERAR_SENHA_USUARIO);

        return $this->dao->AlterarSenhaUsuarioDAO($vo);
    }
}
