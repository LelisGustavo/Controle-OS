<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\EnderecoVO;

class UsuarioVO extends EnderecoVO
{

    private $id;
    private $tipo;
    private $nome;
    private $email;
    private $tel;
    private $senha;
    private $status;

    // GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int 
    {
        return $this->id;
    }

    //GET e SET TIPO
    public function setTipo($p_tipo): void
    {
        $this->tipo = $p_tipo;
    }
    public function getTipo(): int
    {
        return $this->tipo;
    }

    //GET e SET NOME
    public function setNome($p_nome): void
    {
        $this->nome = Util::TratarDadosGeralComEspacos($p_nome);
    }
    public function getNome(): string
    {
        return $this->nome;
    }

    //GET e SET EMAIL
    public function setEmail($p_email): void
    {
        $this->email = Util::RemoverTags($p_email);
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    //GET e SET TELEFONE
    public function setTelefone($p_tel): void
    {
        $this->tel = Util::TirarCaracteresEspeciais($p_tel);
    }
    public function getTelefone(): string
    {
        return $this->tel;
    }

    //GET e SET SENHA
    public function setSenha($p_senha): void
    {
        $this->senha = Util::RemoverTags($p_senha);
    }
    public function getSenha()
    {
        return $this->senha;
    }

    //GET e SET STATUS
    public function setStatus($p_status): void
    {
        $this->status = $p_status;
    }
    public function getStatus(): int
    {
        return $this->status;
    }
    
}
