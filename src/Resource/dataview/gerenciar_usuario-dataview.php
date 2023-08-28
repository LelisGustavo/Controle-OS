<?php

// Requerimento do autoload
require_once '_include_autoload.php';

use Src\Controller\SetorCTRL;
use Src\_Public\Util;
use Src\Controller\UsuarioCTRL;
use Src\VO\UsuarioVO;
use Src\VO\TecnicoVO;
use Src\VO\FuncionarioVO;

$ctrl = new UsuarioCTRL();

if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {

    $user = $ctrl->DetalharUsuarioCTRL($_GET['usuario_id']);

    if (empty($user)) {
        Util::ChamarPagina('consultar_usuario');
    }

    if ($user['tipo'] == PERFIL_FUNCIONARIO) {

        $setores = (new SetorCTRL)->ConsultarSetorCTRL();

    }
    
}

else if (isset($_POST['btn_cadastrar'])) {

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

else if (isset($_POST['filtrar_usuario'])  && $_POST['filtrar_usuario'] == 'ajx') {

    $nome_filtro = $_POST['nome_filtro'];
    // 1 se ele for a primeira vez (acabou de abrir a página)
    $primeira_vez = $_POST['primeira_vez'] == '1' ? true : (empty($nome_filtro) ? true : false);
    // Retorno da busca no BD dos usuários cadastrados
    $usuarios = $ctrl->FiltrarUsuarioCTRL($nome_filtro, $primeira_vez);

    $total_encontrado = count($usuarios);
    $titulo = '';

    if ($primeira_vez || empty($nome_filtro)) {

        $titulo = $total_encontrado . ' últimos usuários cadastrados';
    } else {

        switch ($total_encontrado) {

            case 1:
                $titulo = 'Foi encontrado somente 1 usuário';
                break;

            case 0:
                $titulo = 'Não foi encontrado nenhum usuário';
                break;

            default:
                $titulo = 'Foram encontrados ' . $total_encontrado . ' usuários';
                break;
        }
    }

?>

    <div class="card-header">

        <h3 class="card-title">
            <?= $titulo ?>
        </h3>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover" id="tableResult">

            <thead>

                <tr>
                    <th>Ação / Status</th>
                    <th>Nome</th>
                    <th>Perfil</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($usuarios as $item) { ?>
                    <tr>

                        <td>
                            <a href="alterar_usuario.php?usuario_id=<?= $item['id'] ?>" class="btn btn-outline-warning btn-sm">Alterar</a>

                            <button onclick="AlterarStatus('<?= $item['id'] ?>', '<?= $item['status'] ?>')" class="btn btn-outline-<?= $item['status'] == ATIVO ? 'success' : 'danger' ?> btn-sm"><?= $item['status'] == ATIVO ? 'Ativo' : 'Inativo' ?></button>
                        </td>
                        <td><?= $item['nome'] ?></td>
                        <td class="text-info">
                            <?= Util::RetornarTipo($item['tipo']) ?>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>

        </table>

    </div>

<?php }

else if (isset($_POST['btn_alterar_status'])) {

    $vo = new UsuarioVO();
    $vo->setId($_POST['id_user']);
    $vo->setStatus($_POST['status']);

    $ret = $ctrl->AlterarStatusUsuarioCTRL($vo);

    if ($_POST['btn_alterar_status'] == 'ajx') {
        echo $ret;
    }
}

else if (isset($_POST['btn_alterar'])) {

    switch ($_POST['tipo']) {

        case PERFIL_ADM:

            $vo = new UsuarioVO();
            // Dados do usuario administrador
            $vo->setId($_POST['usuario_id']);
            $vo->setTipo($_POST['tipo']);
            $vo->setNome($_POST['nome_usuario']);
            $vo->setEmail($_POST['email_usuario']);
            $vo->setTelefone($_POST['telefone_usuario']);

            break;

        case PERFIL_FUNCIONARIO:

            $vo = new FuncionarioVO();
            // Dados do usuario funcionário
            $vo->setId($_POST['usuario_id']);
            $vo->setTipo($_POST['tipo']);
            $vo->setNome($_POST['nome_usuario']);
            $vo->setEmail($_POST['email_usuario']);
            $vo->setTelefone($_POST['telefone_usuario']);
            $vo->setIdSetor($_POST['setor']);

            break;

        case PERFIL_TECNICO:

            $vo = new TecnicoVO();
            // Dados do usuario técnico
            $vo->setId($_POST['usuario_id']);
            $vo->setTipo($_POST['tipo']);
            $vo->setNome($_POST['nome_usuario']);
            $vo->setEmail($_POST['email_usuario']);
            $vo->setTelefone($_POST['telefone_usuario']);
            $vo->setNomeEmpresa($_POST['nome_empresa_tec']);

            break;
    }

    // Dados do endereço
    $vo->setIdEndereco($_POST['endereco_id']);
    $vo->setCep($_POST['cep_usuario']);
    $vo->setRua($_POST['rua_usuario']);
    $vo->setBairro($_POST['bairro_usuario']);
    $vo->setComplemento($_POST['complemento_usuario']);
    $vo->setNomeCidade($_POST['cidade_usuario']);
    $vo->setSigla($_POST['estado_usuario']);

    $ret = $ctrl->AlterarUsuarioCTRL($vo);

    Util::ChamarPaginaParametros('consultar_usuario', "ret=$ret&nome_filtro=".$vo->getNome());

}

else if (isset($_POST['btn_acessar'])) {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $ret = $ctrl->ValidarLoginCTRL($login, $senha, PERFIL_ADM);

}

