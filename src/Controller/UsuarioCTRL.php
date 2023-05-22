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

        $this-> dao = new UsuarioDAO;

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

    // public function ValidarLoginCTRL(string $login, string $senha): array|int 
    // {
        
        // if (empty($login) || empty($senha)) {
        //     return 0;
        // }

        // $user = $this->dao->ValidarLoginDAO($login, ATIVO);

        // Teste para verificar se o login OU senha está inválido
        // if (empty($user) || !Util::VerificarSenha($senha, $user['senha'])) {
        //     return -4;
        // }

        //tratamento da sessão e outros

    // }

}