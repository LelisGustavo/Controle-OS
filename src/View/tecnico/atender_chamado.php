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
                            <h1>Atender Chamado</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Faça os atendimentos aqui</h3>
                    </div>
                    <div class="card-body">
                        <form action="atender_chamado.php" method="post">                           
                                <div class="form-group">
                                    <label>Data</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="data_chamado" id="data_chamado">
                                </div>
                                <div class="form-group">
                                    <label>Setor</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="setor_chamado" id="setor_chamado">
                                </div>                           
                            <div class="form-group">
                                <label>Funcionário</label>
                                <input class="form-control" placeholder="Digite aqui..." name="funcionario_chamado" id="funcionario_chamado">
                            </div>
                            <div class="form-group">
                                <label>Equipamento</label>
                                <input class="form-control" placeholder="Digite aqui..." name="equipamento_chamado" id="equipamento_chamado">
                            </div>
                            <div class="form-group">
                                <label>Descrição do problema</label>
                                <textarea class="form-control" rows="3" placeholder="Digite aqui..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Laudo</label>
                                <textarea class="form-control" rows="3" placeholder="Digite aqui..."></textarea>
                            </div>
                            <button class="btn btn-outline-success" name="btn_finalizar">Finalizar</button>
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