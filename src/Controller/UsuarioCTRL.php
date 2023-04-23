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

}