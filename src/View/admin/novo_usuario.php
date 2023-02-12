<?php
require_once dirname(__DIR__, 3) . '\vendor\autoload.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include_once PATH_URL . '/Template/_includes/_head.php';
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php
        include_once PATH_URL . '/Template/_includes/_topo.php';
        include_once PATH_URL . '/Template/_includes/_menu.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Novo Usuário</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você insere um novo usuário</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_cad" action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="tipo" id="tipo">
                                    <option value="">Selecione</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Setor</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="setor" id="setor">
                                    <option value="">Selecione</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="nome_usuario" id="nome_usuario">
                            </div>
                            <div class="form-group">
                                <label>Sobrenome</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="sobrenome_usuario" id="sobrenome_usuario">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="email_usuario" id="email_usuario">
                            </div>
                            <div class="form-group">
                                <label>Telefone</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="telefone_usuario" id="telefone_usuario">
                            </div>
                            <div class="form-group">
                                <label>Endereço</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="endereco_usuario" id="endereco_usuario">
                            </div>
                            <button class="btn btn-outline-success" name="btn_cadastrar" onclick="return NotificarCampos('form_cad')">Cadastrar</button>
                        </form>
                    </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include_once PATH_URL . '/Template/_includes/_footer.php';
        ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php
    include_once PATH_URL . '/Template/_includes/_scripts.php';
    include_once PATH_URL . 'Template/_includes/_msg.php';
    ?>
</body>

</html>