<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_tipo_equipamento-dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
  <?php
  include_once PATH_URL . 'Template/_includes/_head.php';
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php
    include_once PATH_URL . 'Template/_includes/_topo.php';
    include_once PATH_URL . 'Template/_includes/_menu.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tipo de Equipamento</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Gerencie os tipos de equipamento nesta página</h3>
          </div>
          
          <div class="card-body">

            <form id="form_cad" action="tipo_equipamento.php" method="post">
              <div class="form-group">
                <label>Tipo do equipamento</label>
                <input class="form-control obg" placeholder="Digite aqui..." name="nome_tipo" id="nome_tipo">
              </div>

              <button class="btn btn-outline-success" name="btn_cadastrar"
                onclick="return CadastrarTipoEquipamento('form_cad')">Cadastrar</button>
          </div>

          </form>
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
                    <input type="text" onkeyup="ConsultarTipoEquipamento()" name="nome_filtro" id="nome_filtro"
                      class="form-control float-right" placeholder="Filtrar...">

                    <div class="input-group-append">
                      <button type="button" onclick="ConsultarTipoEquipamento()" class="btn btn-default"><i
                          class="fas fa-search"></i></button>
                    </div>

                  </div>
                </div>

                <div id="divLoad">
                  <!-- Só vai ativar quando estiver em load a tela -->
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableResult">

                </table>
              </div>

              <form id="form_alt" action="tipo_equipamento.php" method="post">
                <?php
                include_once 'modals/_tipo_equipamento_alterar.php';
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
    include_once PATH_URL . 'Template/_includes/_footer.php';
    ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php
  include_once PATH_URL . 'Template/_includes/_scripts.php';
  include_once PATH_URL . 'Template/_includes/_msg.php';
  ?>
  <script src="../../Resource/ajax/tipo_equipamento-ajx.js"></script>
  <script>
    ConsultarTipoEquipamento()
  </script>

</body>

</html>