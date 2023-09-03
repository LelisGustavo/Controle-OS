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
              <h1>Consultar Equipamento</h1>
            </div>

          </div>

        </div>

      </section>

      <section class="content">

        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Aqui você faz a consulta dos seus equipamentos</h3>
          </div>

          <div class="card-body">

            <div class="row">

              <div class="form-group col-md-6">

                <label>Filtrar pelo Tipo</label>
                <select class="form-control select2 obg" style="width: 100%;" onchange="ConsultarEquipamento()" name="tipo_filtro" id="tipo_filtro">
                  <option value="">- SEM FILTRO -</option>
                  <?php foreach ($tipos as $item) { ?>
                    <option value="<?= $item['id'] ?>"><?= $item['nome'] ?>
                    <?php } ?>
                </select>

              </div>

              <div class="form-group col-md-6">

                <label>Filtrar pelo Modelo</label>
                <select class="form-control select2 obg" style="width: 100%;" onchange="ConsultarEquipamento()" name="modelo_filtro" id="modelo_filtro">
                  <option value="">- SEM FILTRO -</option>
                  <?php foreach ($modelos as $item) { ?>
                    <option value="<?= $item['id'] ?>"><?= $item['nome'] ?></option>
                  <?php } ?>
                </select>

              </div>

            </div>

            <center>
              <a href="pdf_listar_equipamentos.php?pdf-equipamentos" class="btn btn-outline-info">Gerar PDF</a>
            </center>

          </div>

        </div>

        <hr>

        <div class="row">

          <div class="col-12">

            <div class="card">

              <div class="card-header">

                <h3 class="card-title">Equipamentos Cadastrados</h3>

                <div class="card-tools">

                  <div class="input-group input-group-sm" style="width: 250px;">

                    <input type="text" onkeyup="ConsultarEquipamento()" name="identificacao_filtro" id="identificacao_filtro" class="form-control float-right" placeholder="Filtrar pela identificação..." value="<?= isset($_GET['identificacao']) ? ($_GET['identificacao']) : '' ?>">

                    <div class="input-group-append">

                      <button type="button" onclick="ConsultarEquipamento()" class="btn btn-default"><i class="fas fa-search"></i></button>

                    </div>

                  </div>

                </div>

              </div>

              <div id="divLoad">
                <!-- Só vai ativar quando estiver em load a tela -->
              </div>

              <div class="card-body table-responsive p-0">

                <table class="table table-hover" id="tableResult">

                </table>

              </div>

              <form id="form_alt" action="consultar_equipamento.php" method="post">
                <?php
                include_once 'modals/_excluir.php';
                ?>
              </form>

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
  include_once PATH_URL . '/Template/_includes/_msg.php';
  ?>

  <script src="../../Resource/ajax/equipamento-ajx.js"></script>

  <script>
    ConsultarEquipamento()
  </script>

</body>

</html>