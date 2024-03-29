<?php

namespace Src\Resource\api\Classe;

use Src\_Public\Util;
use Src\Controller\ChamadoCTRL;
use Src\Controller\UsuarioCTRL;
use Src\Resource\api\Classe\ApiRequest;
use Src\VO\ChamadoVO;
use Src\VO\FuncionarioVO;
use Src\VO\UsuarioVO;

class FuncionarioAPI extends ApiRequest
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
        if (Util::AuthenticationTokenAccess()) {
            return $this->ctrl_user->DetalharUsuarioCTRL($this->params['id_user']);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function AlterarUsuario()
    {

        if (Util::AuthenticationTokenAccess()) {

            $vo = new FuncionarioVO();
            // Dados do usuario funcionário
            $vo->setId($this->params['usuario_id']);
            $vo->setTipo($this->params['tipo']);
            $vo->setNome($this->params['nome_usuario']);
            $vo->setEmail($this->params['email_usuario']);
            $vo->setTelefone($this->params['telefone_usuario']);
            $vo->setIdSetor($this->params['setor']);

            // Dados do endereço
            $vo->setIdEndereco($this->params['endereco_id']);
            $vo->setCep($this->params['cep_usuario']);
            $vo->setRua($this->params['rua_usuario']);
            $vo->setBairro($this->params['bairro_usuario']);
            $vo->setComplemento($this->params['complemento_usuario']);
            $vo->setNomeCidade($this->params['cidade_usuario']);
            $vo->setSigla($this->params['estado_usuario']);

            return $this->ctrl_user->AlterarUsuarioCTRL($vo);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function ChecarSenhaUsuario()
    {

        if (Util::AuthenticationTokenAccess()) {
            return $this->ctrl_user->ChecarSenhaUsuarioCTRL($this->params['id_user'], $this->params['senha_digitada']);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function AlterarSenhaUsuario()
    {

        if (Util::AuthenticationTokenAccess()) {

            $vo = new UsuarioVO();
            // Dados do usuario funcionário (Senha)
            $vo->setId($this->params['usuario_id']);
            $vo->setSenha($this->params['nova_senha_digitada']);
            $vo->setRepetirSenha($this->params['repetir_nova_senha_digitada']);

            return $this->ctrl_user->AlterarSenhaUsuarioCTRL($vo);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function ListarEquipamentoChamadoSetor()
    {

        if (Util::AuthenticationTokenAccess()) {

            $vo = new ChamadoVO;
            $vo->setIdSetor($this->params['setor_id']);

            return (new ChamadoCTRL)->ListarEquipamentosChamadoSetorCTRL($vo);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function AbrirChamado()
    {

        if (Util::AuthenticationTokenAccess()) {

            $vo = new ChamadoVO();

            $vo->setIdFuncionario($this->params['id_user']);
            $vo->setIdAlocar($this->params['id_alocar']);
            $vo->setProblema($this->params['problema']);

            return (new ChamadoCTRL)->AbrirChamadoCTRL($vo);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function FiltrarChamado()
    {

        if (Util::AuthenticationTokenAccess()) {
            
            return (new ChamadoCTRL)->FiltrarChamadoCTRL($this->params['situacao'], $this->params['id_setor'], PERFIL_FUNCIONARIO);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function DetalharChamadoID()
    {

        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCTRL)->DetalharChamadoIDCTRL($this->params['id_chamado']);
        } else {
            NAO_AUTORIZADO;
        }
    }

    public function Autenticar()
    {

        return $this->ctrl_user->ValidarLoginCTRL($this->params['email'], $this->params['senha'], PERFIL_FUNCIONARIO);
    }
}
