<?php

// Requerimento do autoload
require_once '_include_autoload.php';

use Src\Controller\UsuarioCTRL;
use Src\VO\UsuarioVO;
use Src\VO\TecnicoVO;
use Src\VO\FuncionarioVO;

$ctrl = new UsuarioCTRL();

if (isset($_POST['btn_cadastrar'])) {

    switch ($_POST['tipo']) {

        case PERFIL_ADM:

            $vo = new UsuarioVO();
            // Dados do usuario administrador
            $vo->setTipo($_POST['tipo']);
            $vo->setNome($_POST['nome_usuario']);
            $vo->setEmail($_POST['email_usuario']);
            $vo->setTelefone($_POST['telefone_usuario']);

            break;

        case PERFIL_FUNCIONARIO:

            $vo = new FuncionarioVO();
            // Dados do usuario funcionário
            $vo->setTipo($_POST['tipo']);
            $vo->setNome($_POST['nome_usuario']);
            $vo->setEmail($_POST['email_usuario']);
            $vo->setTelefone($_POST['telefone_usuario']);
            $vo->setIdSetor($_POST['setor']);

            break;

        case PERFIL_TECNICO:

            $vo = new TecnicoVO();
            // Dados do usuario técnico
            $vo->setTipo($_POST['tipo']);
            $vo->setNome($_POST['nome_usuario']);
            $vo->setEmail($_POST['email_usuario']);
            $vo->setTelefone($_POST['telefone_usuario']);
            $vo->setNomeEmpresa($_POST['nome_empresa_tec']);

            break;
    }

    // Dados do endereço
    $vo->setCep($_POST['cep_usuario']);
    $vo->setRua($_POST['rua_usuario']);
    $vo->setBairro($_POST['bairro_usuario']);
    $vo->setComplemento($_POST['complemento_usuario']);
    $vo->setNomeCidade($_POST['cidade_usuario']);
    $vo->setSigla($_POST['estado_usuario']);

    $ret = $ctrl->CadastrarUsuarioCTRL($vo);

} 

else if (isset($_POST['verificar_email'])) {

    $id_user = $_POST['id_user'];
    $email_usuario = $_POST['email_usuario'];

    $existe_email = $ctrl->VerificarEmailDuplicadoCTRL($id_user, $email_usuario);

    // Verifica se existe o email, antes de poder ser cadastrado ou alterado
    echo $existe_email ? 1 : 0;
}
