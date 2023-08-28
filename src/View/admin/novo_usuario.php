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
                            <h1>Novo Usuário</h1>
                        </div>

                    </div>

                </div>

            </section>

            <section class="content">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Aqui você insere um novo usuário</h3>
                    </div>

                    <div class="card-body">

                        <form id="form_cad" action="novo_usuario.php" method="post">

                            <!-- Verifica se é um cadastro ou uma alteração dependendo do value -->
                            <input type="hidden" id="id_user" value="">
                            <!-- Renderiza o select option do setor (COMBO) -->
                            <input type="hidden" id="componente" value="<?= COMPONENTE_COMBO ?>">

                            <!-- Altera o formulário baseado no que foi selecionado no select option -->
                            <div class="form-group">
                                <label>Selecione o Tipo de Usuário</label>
                                <select class="form-control select2" name="tipo" id="tipo" onchange="SelecionarTipoUsuario(this.value)">
                                    <option value="">Selecione</option>
                                    <option value="<?= PERFIL_ADM ?>">Administrador</option>
                                    <option value="<?= PERFIL_FUNCIONARIO ?>">Funcionário</option>
                                    <option value="<?= PERFIL_TECNICO ?>">Técnico
                                    </option>
                                </select>
                            </div>

                            <div id="divTipoGeral" class="ocultar">

                                <div class="form-group">
                                    <label>Nome completo</label>
                                    <input class="form-control obg" placeholder="Digite aqui..." name="nome_usuario" id="nome_usuario">
                                </div>

                                <!-- Class row para formatar os campos (E-mail e Telefone) com col-md-6 -->
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control obg" onblur="ValidarEmailDuplicado()" placeholder="Digite aqui..." name="email_usuario" id="email_usuario">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Telefone</label>
                                        <input class="form-control obg tel num" placeholder="Digite aqui..." name="telefone_usuario" id="telefone_usuario">
                                    </div>

                                </div>

                                <!-- Class row para formatar os campos (CEP e Rua) com col-md-6 -->
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>CEP</label>
                                        <input onblur="BuscarCep()" class="form-control obg cep num" placeholder="Digite aqui..." name="cep_usuario" id="cep_usuario">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Rua</label>
                                        <input class="form-control obg" placeholder="Digite aqui..." name="rua_usuario" id="rua_usuario">
                                    </div>

                                </div>

                                <!-- Class row para formatar os campos (Bairro e Complemento) com col-md-6 -->
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Bairro</label>
                                        <input class="form-control obg" placeholder="Digite aqui..." name="bairro_usuario" id="bairro_usuario">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Complemento</label>
                                        <input class="form-control" placeholder="Digite aqui..." name="complemento_usuario" id="complemento_usuario">
                                    </div>

                                </div>

                                <!-- Class row para formatar os campos (Estado e Cidade) com col-md-6 -->
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Cidade</label>
                                        <input readonly class="form-control obg" placeholder="Este campo será preenchido automáticamente após digitar o CEP..." name="cidade_usuario" id="cidade_usuario">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Estado</label>
                                        <input readonly class="form-control obg" placeholder="Este campo será preenchido automáticamente após digitar o CEP..." name="estado_usuario" id="estado_usuario">
                                    </div>

                                </div>

                            </div>

                            <div id="divTipoFuncionario" class="ocultar">

                                <!-- Mostra o resultado dos setores cadastrados do banco de dados via AJAX -->
                                <div class="form-group">
                                    <label>Setor</label>
                                    <select class="form-control select2 obg" name="setor" id="tableResult">
                                    </select>
                                </div>

                            </div>

                            <div id="divTipoTecnico" class="ocultar">

                                <!-- Cadastramento da empresa do técnico tercerizado -->
                                <div class="form-group">
                                    <label>Nome da empresa técnico</label>
                                    <input class="form-control obg" placeholder="Digite aqui..." name="nome_empresa_tec" id="nome_empresa_tec">
                                </div>

                            </div>

                            <button class="btn btn-outline-success ocultar" id="btn_cadastrar" name="btn_cadastrar" onclick="return NotificarCampos('form_cad')">Cadastrar</button>

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

    <script src="../../Resource/ajax/gerenciar_setores-ajx.js"></script>
    <script src="../../Resource/ajax/usuario-ajx.js"></script>
    <script src="../../Template/dist/js/jquery.mask.min.js"></script>
    <script src="../../Template/dist/js/mask.js"></script>

    <script>
        ConsultarSetor();
    </script>

</body>

</html>