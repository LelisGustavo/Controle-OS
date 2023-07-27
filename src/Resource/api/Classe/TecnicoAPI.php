<?php

namespace Src\Resource\api\Classe;

use Src\Controller\UsuarioCTRL;
use Src\Controller\ChamadoCTRL;
use Src\Resource\api\Classe\ApiRequest;
use Src\VO\TecnicoVO;
use Src\VO\ChamadoVO;
use Src\VO\UsuarioVO;

class TecnicoAPI extends ApiRequest
{

    private $ctrl_user;

    public function __construct()
    {
        $this->ctrl_user = new UsuarioCTRL();
    }
    private $params;

    public function AddParameters($p)
    {
        $this->params = $p;
    }

    public function CheckEndPoint($endpoint)
    {
        return method_exists($this, $endpoint);
    }


    public function DetalharUsuario()
    {
        return $this->ctrl_user->DetalharUsuarioCTRL($this->params['id_user']);
    }

    public function AlterarUsuario()
    {

        $vo = new TecnicoVO();
        // Dados do usuario técnico
        $vo->setId($this->params['usuario_id']);
        $vo->setTipo($this->params['tipo']);
        $vo->setNome($this->params['nome_usuario']);
        $vo->setEmail($this->params['email_usuario']);
        $vo->setTelefone($this->params['telefone_usuario']);
        $vo->setNomeEmpresa($this->params['nome_empresa_tec']);

        // Dados do endereço
        $vo->setIdEndereco($this->params['endereco_id']);
        $vo->setCep($this->params['cep_usuario']);
        $vo->setRua($this->params['rua_usuario']);
        $vo->setBairro($this->params['bairro_usuario']);
        $vo->setComplemento($this->params['complemento_usuario']);
        $vo->setNomeCidade($this->params['cidade_usuario']);
        $vo->setSigla($this->params['estado_usuario']);

        return $this->ctrl_user->AlterarUsuarioCTRL($vo);

    }

    public function ChecarSenhaUsuario()
    {

        return $this->ctrl_user->ChecarSenhaUsuarioCTRL($this->params['id_user'], $this->params['senha_digitada']);

    }

    public function AlterarSenhaUsuario()
    {

        $vo = new UsuarioVO();
        // Dados do usuario funcionário (Senha)
        $vo->setId($this->params['usuario_id']);
        $vo->setSenha($this->params['nova_senha_digitada']);
        $vo->setRepetirSenha($this->params['repetir_nova_senha_digitada']);

        return $this->ctrl_user->AlterarSenhaUsuarioCTRL($vo);

    }

}
