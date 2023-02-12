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
                            <h1>Minha Senha</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Altere sua senha aqui</h3>
                    </div>
                    <div class="card-body">
                        <form action="mudar_senha.php" method="post">
                            <div class="form-group">
                                <label>Senha atul</label>
                                <input class="form-control" placeholder="Digite aqui..." name="senha_usuario" id="senha_usuario">
                            </div>
                            <div class="form-group">
                                <label>Nova senha</label>
                                <input class="form-control" placeholder="Digite aqui..." name="nova_senha_usuario" id="nova_senha_usuario">
                            </div>
                            <div class="form-group">
                                <label>Repetir senha</label>
                                <input class="form-control" placeholder="Digite aqui..." name="repetir_senha_usuario" id="repetir_senha_usuario">
                            </div>
                            <button class="btn btn-outline-info" name="btn_cadastrar">Cadastrar</button>
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
    ?>
</body>

</html>