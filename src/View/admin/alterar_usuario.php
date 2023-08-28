<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_usuario-dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include_once PATH_URL . '/Template/_includes/_head.php';
    ?>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <?php
        include_once PATH_URL . '/Template/_includes/_topo.php';
        include_once PATH_URL . '/Template/_includes/_menu.php';
        ?>

        <div class="content-wrapper">

            <section class="content-header">

                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Alterar Usuário</h1>
                        </div>
                    </div>
                </div>

            </section>

            <section class="content">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Aqui você altera um usuário cadastrado</h3>
                    </div>

                    <div class="card-body">

                        <form id="form_cad" action="alterar_usuario.php" method="post">

                            <!-- Verifica o perfil(tipo), o id do usuário e do endereço que será alterado -->
                            <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $user['usuario_id'] ?>">
                            <input type="hidden" name="tipo" id="tipo" value="<?= $user['tipo'] ?>">
                            <input type="hidden" name="endereco_id" id="endereco_id" value="<?= $user['endereco_id'] ?>">

                            <div class="form-group">
                                <label>Nome completo</label>
                                <input class="form-control obg" name="nome_usuario" id="nome_usuario" placeholder="Digite aqui..." value="<?= $user['nome_usuario'] ?>">
                            </div>

                            <!-- Class row para formatar os campos (E-mail e Telefone) com col-md-6 -->
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control obg" onblur="ValidarEmailDuplicado()" placeholder="Digite aqui..." name="email_usuario" id="email_usuario" value="<?= $user['email'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefone</label>
                                    <input class="form-control obg tel num" placeholder="Digite aqui..." name="telefone_usuario" id="telefone_usuario" value="<?= $user['tel'] ?>">
                                </div>

                            </div>

                            <!-- Class row para formatar os campos (CEP e Rua) com col-md-6 -->
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>CEP</label>
                                    <input onblur="BuscarCep()" class="form-control obg cep num" placeholder="Digite aqui..." name="cep_usuario" id="cep_usuario" value="<?= $user['cep'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Rua</label>
                                    <input class="form-control obg" placeholder="Digite aqui..." name="rua_usuario" id="rua_usuario" value="<?= $user['nome_rua'] ?>">
                                </div>

                            </div>

                            <!-- Class row para formatar os campos (Bairro e Complemento) com col-md-6 -->
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>Bairro</label>
                                    <input class="form-control obg" placeholder="Digite aqui..." name="bairro_usuario" id="bairro_usuario" value="<?= $user['nome_bairro'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Complemento</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="complemento_usuario" id="complemento_usuario" value="<?= $user['complemento'] ?>">
                                </div>

                            </div>

                            <!-- Class row para formatar os campos (Estado e Cidade) com col-md-6 -->
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>Cidade</label>
                                    <input readonly class="form-control obg" placeholder="Este campo será preenchido automáticamente após digitar o CEP..." name="cidade_usuario" id="cidade_usuario" value="<?= $user['nome_cidade'] ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Estado</label>
                                    <input readonly class="form-control obg" placeholder="Este campo será preenchido automáticamente após digitar o CEP..." name="estado_usuario" id="estado_usuario" value="<?= $user['sigla'] ?>">
                                </div>

                            </div>

                            <?php if ($user['tipo'] == PERFIL_FUNCIONARIO) { ?>

                                <!-- Mostra o resultado dos setores cadastrados do banco de dados via AJAX -->
                                <div class="form-group">

                                    <label>Setor</label>
                                    <select class="form-control obg" name="setor" id="setor">
                                        <?php foreach($setores as $item) { ?>
                                            <option value="<?= $item['id'] ?>" <?= $item['id'] == $user['setor_id'] ? 'selected' : '' ?>> <?= $item['nome'] ?> </option>
                                        <?php } ?>
                                    </select>

                                </div>

                            <?php } ?>

                            <?php if ($user['tipo'] == PERFIL_TECNICO) { ?>

                                <!-- Cadastramento da empresa do técnico tercerizado -->
                                <div class="form-group">

                                    <label>Nome da empresa técnico</label>
                                    <input class="form-control obg" placeholder="Digite aqui..." name="nome_empresa_tec" id="nome_empresa_tec" value="<?= $user['nome_empresa_tec'] ?>">

                                </div>

                            <?php } ?>

                            <button class="btn btn-outline-success" id="btn_alterar" name="btn_alterar" onclick="return NotificarCampos('form_cad')">Alterar</button>

                        </form>

                        <!-- Só vai ativar quando estiver em load a tela -->
                        <div id="divLoad">
                            <!-- Load -->
                        </div>

                    </div>

                </div>

            </section>

        </div>

        <?php
        include_once PATH_URL . '/Template/_includes/_footer.php';
        ?>

    </div>

    <?php
    include_once PATH_URL . '/Template/_includes/_scripts.php';
    include_once PATH_URL . 'Template/_includes/_msg.php';
    ?>

    <script src="../../Resource/ajax/usuario-ajx.js"></script>
    <script src="../../Template/dist/js/jquery.mask.min.js"></script>
    <script src="../../Template/dist/js/mask.js"></script>

</body>

</html>