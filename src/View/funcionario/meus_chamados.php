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
                            <h1>Meus Chamados</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Consulte todos seus chamados e acompanhe os atendimentos</h3>
                    </div>
                    <div class="card-body">
                        <form action="meus_chamados.php" method="post">
                            <div class="form-group">
                                <label>Escolha a situação</label>
                                <select class="form-control select2" style="width: 100%;" name="situacao" id="situacao">
                                    <option value="">Selecione</option>
                                </select>
                            </div>
                            <button class="btn btn-outline-info" name="btn_procurar">Procurar</button>
                    </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Resultado encontrado</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ação</th>
                                            <th>Data Abertura</th>
                                            <th>Funcionário</th>
                                            <th>Equipamento</th>
                                            <th>Problema</th>
                                            <th>Data Atendimento</th>
                                            <th>Técnico</th>
                                            <th>Data Encerramento</th>
                                            <th>Laudo</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-outline-info btn-sm">Ver Mais</a>
                                            </td>
                                            <td>(abertura)</td>
                                            <td>(funcionário)</td>
                                            <td>(equipamento)</td>
                                            <td>(problema)</td>
                                            <td>(atendimento)</td>
                                            <td>(técnico)</td>
                                            <td>(encerramento)</td>
                                            <td>(laudo)</td>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
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