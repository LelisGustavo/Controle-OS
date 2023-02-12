<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_equipamento-dataview.php';
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
              <h1>Consultar Equipamento</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Aqui você faz a consulta dos seus equipamentos</h3>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Filtrar pelo Tipo</label>
                  <select class="form-control select2 obg" style="width: 100%;" name="tipo_equipamento"
                    id="tipo_equipamento">
                    <option value="">- SEM FILTRO -</option>
                    <?php foreach ($tipos as $item) { ?>
                      <option value="<?= $item['id'] ?>"><?= $item['nome'] ?>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Filtrar pelo Modelo</label>
                  <select class="form-control select2 obg" style="width: 100%;" name="modelo_equipamento"
                    id="modelo_equipamento">
                    <option value="">- SEM FILTRO -</option>
                    <?php foreach ($modelos as $item) { ?>
                      <option value="<?= $item['id'] ?>"><?= $item['nome'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Equipamentos Cadastrados</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="nome_filtro" id="nome_filtro" class="form-control float-right" placeholder="Filtrar...">

                    <div class="input-group-append">
                      <button type="button" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableResult">

                </table>
              </div>
              <form id="form_alt" action="consultar_equipamento.php" method="post">
                <?php
                include_once 'modals/_consultar_equipamento_alterar.php';
                include_once 'modals/_excluir.php';
                ?>
              </form>
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
  include_once PATH_URL . '/Template/_includes/_msg.php';
  ?>
  <script src="../../Resource/ajax/equipamento-ajx.js"></script>
  <script>ConsultarEquipamento()</script>
</body>

</html>