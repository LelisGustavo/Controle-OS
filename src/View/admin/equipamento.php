<?php
use Src\Controller\ModeloEquipamentoCTRL;
use Src\Controller\TipoEquipamentoCTRL;
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_equipamento-dataview.php';


$obj_tipo = new TipoEquipamentoCTRL();
$tipos = $obj_tipo->ConsultarEquipamentoCTRL();

$obj_modelo = new ModeloEquipamentoCTRL();
$modelos = $obj_modelo->ConsultarModeloEquipamentoCTRL();
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
                            <h1><?= $acao ?> Equipamento</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você poderá cadastrar seus equipamentos</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_cad" action="equipamento.php" method="post">
                            <div class="form-group">
                                <label>Tipo do equipamento</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="tipo_equipamento"
                                    id="tipo_equipamento">
                                    <option value="">Selecione</option>
                                    <?php foreach ($tipos as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['nome'] ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Modelo</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="modelo_equipamento"
                                    id="modelo_equipamento">
                                    <option value="">Selecione</option>
                                    <?php foreach ($modelos as $item) { ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Identificação</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="identificacao"
                                    id="identificacao">
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control obg" rows="3" placeholder="Digite aqui..."
                                    name="descricao" id="descricao"></textarea>
                            </div>
                            <button class="btn btn-outline-success" name="btn_cadastrar"
                                onclick="return CadastrarEquipamento('form_cad')"><?= $acao ?></button>
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
    include_once PATH_URL . '/Template/_includes/_msg.php';
    ?>
    <script src="../../Resource/ajax/equipamento-ajx.js"></script>
</body>

</html>